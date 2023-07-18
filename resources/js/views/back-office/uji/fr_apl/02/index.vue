<template>
  <el-container class="app-container">
    <vue-html2pdf
      ref="html2Pdf"
      :show-layout="false"
      :float-layout="true"
      :enable-download="true"
      :preview-modal="true"
      :paginate-elements-by-height="1100"
      :filename="fileName"
      :pdf-quality="2"
      :manual-pagination="true"
      pdf-format="a4"
      pdf-orientation="portrait"
      pdf-content-width="100%"
      @progress="onProgress($event)"
      @hasStartedGeneration="hasStartedGeneration()"
      @hasGenerated="hasGenerated($event)"
    >
      <section slot="pdf-content">
        <el-main>
          <div>
            <section slot="pdf-item">
              <h3>FR.APL.02 ASESMEN MANDIRI</h3>
              <el-table
                v-loading="loading"
                :data="judulSertifikasiTable"
                fit
                border
                highlight-current-row
                style="width: 100%"
                :header-cell-style="{ 'text-align': 'center', 'display': 'none' }"
              >
                <el-table-column align="left" width="200px">
                  <template slot-scope="scope">
                    <span>{{ scope.row.title }}</span>
                  </template>
                </el-table-column>
                <el-table-column align="center" width="20px">
                  <span> : </span>
                </el-table-column>
                <el-table-column align="left">
                  <template slot-scope="scope">
                    <span>{{ scope.row.content }}</span>
                  </template>
                </el-table-column>
              </el-table>
            </section>

            <section slot="pdf-item">
              <el-table
                v-loading="loading"
                :data="listKuk"
                border
                fit
                highlight-current-row
                row-key="index"
                default-expand-all
                style="width: 750px"
                :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
              >
                <el-table-column align="center" label="No" width="50px">
                  <template slot-scope="scope">
                    <span>{{ scope.row.index }}</span>
                  </template>
                </el-table-column>

                <el-table-column align="center" label="Kode Unit">
                  <template slot-scope="scope">
                    <span>{{ scope.row.kode_unit }}</span>
                  </template>
                </el-table-column>

                <el-table-column
                  align="left"
                  label="Judul Unit Kompetensi / Elemen Kompetensi / Kriteria Unjuk Kerja(KUK)"
                  min-width="200px"
                >
                  <template slot-scope="scope">
                    <span v-if="scope.row.type === 'unitKomp'"><b>{{ scope.row.unit_kompetensi }}</b></span>
                    <span v-else-if="scope.row.type === 'elemen'"><b>{{ scope.row.nama_elemen }}</b></span>
                    <span v-else>{{ scope.row.kuk }}</span>
                  </template>
                </el-table-column>

                <el-table-column align="center" label="K / BK" min-width="80px">
                  <template slot-scope="scope">
                    <template v-if="scope.row.type === 'kuk'">
                      <span v-if="scope.row.is_kompeten === 0"><i class="el-icon-close" style="color: red;" /> <b>Belum Kompeten</b></span>
                      <span v-else><i class="el-icon-check" style="color: green;" /> <b>Kompeten</b></span>
                    </template>
                  </template>
                </el-table-column>

              </el-table>

              <br>
              <el-table
                v-loading="loading"
                :data="ttdTable1"
                fit
                border
                style="width: 750px"
                :header-cell-style="{ 'text-align': 'center' }"
              >
                <el-table-column align="center" label="Nama Asesi">
                  <template slot-scope="scope">
                    <span>{{ scope.row.nama }}</span>
                  </template>
                </el-table-column>
                <el-table-column align="center" label="Tanggal">
                  <template slot-scope="scope">
                    <span>{{ scope.row.tanggal }}</span>
                  </template>
                </el-table-column>
                <el-table-column align="center" label="Tanda Tangan Asesi">
                  <template slot-scope="scope">
                    <el-image
                      style="width: 200px; height: 100px"
                      :src="scope.row.ttd"
                      fit="contain"
                    />
                  </template>
                </el-table-column>
              </el-table>
              <br>
              <el-table
                v-if="ttdTable2"
                v-loading="loading"
                :data="ttdTable2"
                fit
                border
                style="width: 750px"
                :header-cell-style="{ 'text-align': 'center' }"
              >
                <el-table-column align="center" label="Nama Asesor">
                  <template slot-scope="scope">
                    <span>{{ scope.row.nama }}</span>
                  </template>
                </el-table-column>
                <el-table-column align="center" label="Rekomendasi Asesor">
                  <template v-if="initStatus === 0">
                    <el-select v-model="status" class="filter-item" placeholder="T/TT" value-key="status">
                      <el-option :key="0" label="Belum di cek" :value="0" />
                      <el-option :key="1" label="Asesmen dapat dilanjutkan" :value="1" />
                      <el-option :key="2" label="Asesmen tidak dapat dilanjutkan" :value="2" />
                    </el-select>
                  </template>
                  <span v-else-if="initStatus === 1"> Asesmen dapat dilanjutkan</span>
                  <span v-else-if="initStatus === 2"> Asesmen tidak dapat dilanjutkan</span>
                </el-table-column>
                <el-table-column align="center" label="Tanda Tangan Asesor">
                  <template v-if="initStatus">
                    <div v-if="initStatus === 0">
                      <vueSignature
                        ref="signature"
                        :sig-option="option"
                        :w="'300px'"
                        :h="'150px'"
                        :disabled="false"
                        style="border-style: outset"
                      />
                      <el-button size="small" @click="clear">Clear</el-button>
                    </div>
                    <el-image
                      v-else
                      style="width: 200px; height: 100px"
                      :src="ttdAsesor"
                      fit="contain"
                    />
                  </template>
                </el-table-column>
              </el-table>
            </section>

          </div>
        </el-main>
      </section>
    </vue-html2pdf>

    <el-header>
      <el-page-header content="FR.APL.02 ASESMEN MANDIRI" @back="$router.back()" />
    </el-header>
    <el-main v-loading="loading">
      <div>
        <el-table
          v-loading="loading"
          :data="judulSertifikasiTable"
          fit
          border
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'display': 'none' }"
        >
          <el-table-column align="left" width="200px">
            <template slot-scope="scope">
              <span>{{ scope.row.title }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" width="20px">
            <span> : </span>
          </el-table-column>
          <el-table-column align="left">
            <template slot-scope="scope">
              <span>{{ scope.row.content }}</span>
            </template>
          </el-table-column>
        </el-table>

        <br>

        <el-table
          v-loading="loading"
          :data="listKuk"
          border
          fit
          highlight-current-row
          row-key="index"
          default-expand-all
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="center" label="No" width="50px">
            <template slot-scope="scope">
              <span>{{ scope.row.index }}</span>
            </template>
          </el-table-column>

          <el-table-column align="center" label="Kode Unit">
            <template slot-scope="scope">
              <span>{{ scope.row.kode_unit }}</span>
            </template>
          </el-table-column>

          <el-table-column
            align="left"
            label="Judul Unit Kompetensi / Elemen Kompetensi / Kriteria Unjuk Kerja(KUK)"
            min-width="200px"
          >
            <template slot-scope="scope">
              <span v-if="scope.row.type === 'unitKomp'"><b>{{ scope.row.unit_kompetensi }}</b></span>
              <span v-else-if="scope.row.type === 'elemen'"><b>{{ scope.row.nama_elemen }}</b></span>
              <span v-else>{{ scope.row.kuk }}</span>
            </template>
          </el-table-column>

          <el-table-column align="center" label="K / BK" min-width="80px">
            <template slot-scope="scope">
              <template v-if="scope.row.type === 'kuk'">
                <span v-if="scope.row.is_kompeten === 1"><i class="el-icon-close" style="color: red;" /> <b>Belum Kompeten</b></span>
                <span v-else><i class="el-icon-check" style="color: green;" /> <b>Kompeten</b></span>
              </template>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Bukti Yang Relevan" min-width="80px">
            <!-- <template slot-scope="scope">
              <div v-if="scope" style="text-align: center;">Test Bukti</div>
            </template> -->
          </el-table-column>
        </el-table>
        <br>
        <el-table
          v-loading="loading"
          :data="ttdTable1"
          fit
          border
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center' }"
        >
          <el-table-column align="center" label="Nama Asesi">
            <template slot-scope="scope">
              <span>{{ scope.row.nama }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Tanggal">
            <template slot-scope="scope">
              <span>{{ scope.row.tanggal }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Tanda Tangan Asesi">
            <template slot-scope="scope">
              <el-image
                style="width: 200px; height: 100px"
                :src="scope.row.ttd"
                fit="contain"
              />
            </template>
          </el-table-column>
        </el-table>
        <br>
        <el-table
          v-if="ttdTable2"
          v-loading="loading"
          :data="ttdTable2"
          fit
          border
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center' }"
        >
          <el-table-column align="center" label="Nama Asesor">
            <template slot-scope="scope">
              <span>{{ scope.row.nama }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Rekomendasi Asesor">
            <template slot-scope="scope">
              <template v-if="initStatus === 0">
                <el-select v-model="scope.row.status" class="filter-item" placeholder="T/TT" value-key="status">
                  <el-option :key="0" label="Belum di cek" :value="0" />
                  <el-option :key="1" label="Asesmen dapat dilanjutkan" :value="1" />
                  <el-option :key="2" label="Asesmen tidak dapat dilanjutkan" :value="2" />
                </el-select>
              </template>
              <span v-else-if="initStatus === 1"> Asesmen dapat dilanjutkan</span>
              <span v-else-if="initStatus === 2"> Asesmen tidak dapat dilanjutkan</span>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Tanda Tangan Asesor">
            <div v-if="initStatus === 0">
              <vueSignature
                ref="signature"
                :sig-option="option"
                :w="'300px'"
                :h="'150px'"
                :disabled="false"
                style="border-style: outset"
              />
              <el-button size="small" @click="clear">Clear</el-button>
            </div>
            <el-image
              v-else
              style="width: 200px; height: 100px"
              :src="ttdAsesor"
              fit="contain"
            />
          </el-table-column>
        </el-table>
      </div>
    </el-main>
    <el-button v-if="initStatus === 0" @click="onSubmit">Submit</el-button>
    <el-button v-else @click="generateReport">Print</el-button>
  </el-container>
</template>

<script>
import vueSignature from 'vue-signature';
import { mapGetters } from 'vuex';
import Resource from '@/api/resource';
import VueHtml2pdf from 'vue-html2pdf';
import moment from 'moment';
const apl01Resource = new Resource('detail/apl-01');
const apl02Resource = new Resource('detail/apl-02');
const apl02UpdateResource = new Resource('uji-komp-apl-02');
const skemaResource = new Resource('skema-get');
const signature = new Resource('detail/signature');

export default {
  components: {
    VueHtml2pdf,
    vueSignature,
  },
  data() {
    return {
      option: {
        penColor: 'rgb(0, 0, 0)',
        backgroundColor: 'rgb(255,255,255)',
      },
      dataAsesi: {},
      dataAdmin: {},
      kompeten: null,
      fileName: null,
      loading: false,
      listSkema: null,
      listTuk: null,
      listJadwal: null,
      listDetailApl02: null,
      listKuk: [],
      listUji: [],
      listKodeUnit: [],
      selectedSkema: {},
      selectedUji: {},
      namaAsesor: '',
      initStatus: null,
      status: 0,
      ttdAsesor: '',
      dataTrx: {},
      headerTable: [
        {
          title: 'Nama Lengkap',
          content: '',
        },
        {
          title: 'No KTP/NIK/Passpor',
          content: '',
        },
        {
          title: 'Tempat / Tanggal Lahir',
          content: '',
        },
        {
          title: 'Jenis Kelamin',
          content: '',
        },
        {
          title: 'Alamat Rumah',
          content: '',
        },
        {
          title: 'No HP',
          content: '',
        },
        {
          title: 'Email',
          content: '',
        },
        {
          title: 'Kualifikasi Pendidikan',
          content: '',
        },
      ],
      dataPekerjaanTable: [
        {
          title: 'Nama Institusi / Perusahaan',
          content: '',
        },
        {
          title: 'Jabatan',
          content: '',
        },
        {
          title: 'Alamat Kantor',
          content: '',
        },
        {
          title: 'No Telp',
          content: '',
        },
        {
          title: 'Email',
          content: '',
        },
        {
          title: 'Fax',
          content: '',
        },
      ],
      judulSertifikasiTable: [
        {
          title: 'Judul Skema Sertifikasi',
          content: '',
        },
        {
          title: 'Nomor Skema Sertifikasi',
          content: '',
        },
        {
          title: 'Tujuan Asesmen',
          content: 'Sertifikasi',
        },
      ],
      buktiKelengkapanTable: [
        {
          title: 'Pas Foto 3x4',
          content: '',
        },
        {
          title: 'Sertifikat PKL',
          content: '',
        },
        {
          title: 'KK/KTP/Kartu Pelajar',
          content: '',
        },
        {
          title: 'Raport Semester 1 - 4',
          content: '',
        },
      ],
      ttdTable1: [
        {
          no: 1,
          nama: 'Nama Asesi',
          tanggal: 'Catatan',
          ttd: '',
        },
      ],
      ttdTable2: [
        {
          no: 1,
          nama: 'Nama Asesor',
          status: 0,
          tanggal: 'Catatan',
          ttd: '',
        },
      ],
      unitKompetensiTable: [],
      buktiTable: [],
      panduan: [
        'Lengkapi nama unit kompetensi, elemen, kriteria unjuk kerja sesuai kolom dalam tabel.',
        'Istilah Acuan Pembanding dengan SOP / spesifikasi produk dari industri / orginasi dari tempat kerja atau simulasi tempat kerja',
        'Beri tanda centang pada kolom K jika Anda yakin asesi dapat melakukan/mendemonstrasikan tugas seuai KUK, atau centang pada kolom BK bila sebaliknya.',
        'Penilaian lanjut diisi bila hasil belum dapat disimpulkan, untuk itu gunakan metode lain sehingga keputusan dapat dibuat',
      ],
      form: {},
      active: 0,
      isWide: true,
      labelPosition: 'left',
    };
  },
  computed: {
    ...mapGetters([
      'userId',
    ]),
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.onResize);
  },
  mounted() {
    window.addEventListener('resize', this.onResize);
    this.onResize();
  },
  created() {
    this.getApl01();
    this.getListSkema().then((value) => {
      this.onJadwalSelect();
    });
    this.getApl02().then((value) => {
      this.insertDetailAPl02();
    });
  },
  methods: {
    clear() {
      this.$refs.signature.clear();
    },
    saveSign() {
      var _this = this;
      this.testPng = _this.$refs.signature.save();
    },
    async getListSkema() {
      const { data } = await skemaResource.list();
      this.listSkema = data;
    },
    generateReport() {
      this.loading = true;
      this.$refs.html2Pdf.generatePdf();
      this.loading = false;
    },
    async beforeDownload({ html2pdf, options, pdfContent }) {
      this.loading = true;
      await html2pdf().set(options).from(pdfContent).toPdf().get('pdf').then((pdf) => {
        const totalPages = pdf.internal.getNumberOfPages();
        for (let i = 1; i <= totalPages; i++) {
          pdf.setPage(i);
          pdf.setFontSize(10);
          pdf.setTextColor(150);
          pdf.text('Page ' + i + ' of ' + totalPages, (pdf.internal.pageSize.getWidth() * 0.88), (pdf.internal.pageSize.getHeight() - 0.3));
        }
      }).save();
      this.loading = false;
    },
    async getApl01() {
      this.loading = true;
      const data = await apl01Resource.get(this.$route.params.id_apl_01);
      this.fileName = 'APL.02 - ' + data.apl_01.nama_lengkap + ' - ' + data.apl_01.kode_skema;
      this.ttdTable1[0].nama = data.apl_01.nama_lengkap;
      this.ttdTable1[0].tanggal = moment(data.apl_01.created_at).format('DD-MM-YYYY');
      const signatures = await signature.list({ asesi: data.apl_01.nama_lengkap });
      this.ttdTable1[0].ttd = '/uploads/users/signature/' + signatures.asesi;

      // this.ttdTable2.push(this.$route.params.asesor);
      this.ttdTable2[0].nama = this.$route.params.asesor;
    },
    async getApl02() {
      this.loading = true;
      const data = await apl02Resource.get(this.$route.params.id_apl_02);
      this.listDetailApl02 = data;
      this.initStatus = this.listDetailApl02.apl_02.status;
      this.ttdTable2[0].status = this.listDetailApl02.apl_02.status;
      this.initStatus = this.listDetailApl02.apl_02.status;
      this.ttdAsesor = '/uploads/users/signature/' + this.listDetailApl02.apl_02.ttd_asesor;
      this.listKuk.forEach((element, index) => {
        if (element['type'] === 'kuk') {
          var foundIndex = data.detail.findIndex(x => x.id_kuk_elemen === element['id']);
          element['is_kompeten'] = data.detail[foundIndex].is_kompeten;
        }
      });
      this.loading = false;
    },
    async insertDetailAPl02() {
      this.loading = true;
      const dataApl02 = this.listDetailApl02.detail;
      this.listKuk.forEach((element, index) => {
        if (element['type'] === 'kuk') {
          var foundIndex = dataApl02.findIndex(x => x.id_kuk_elemen === element['id']);
          element['is_kompeten'] = dataApl02[foundIndex].is_kompeten;
        }
      });
      this.loading = false;
    },
    onJadwalSelect() {
      var id_skema = this.$route.params.id_skema;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      var skemaId = this.listSkema.find((x) => x.id === id_skema);
      this.selectedSkema = skemaId;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.dataTrx.id_skema = skemaId.id;
      this.judulSertifikasiTable[0].content = skemaId.skema_sertifikasi;
      this.judulSertifikasiTable[1].content = skemaId.kode_skema;
      // this.dataTrx.id_tuk = tukId.id;
      this.getKuk();
    },
    getKuk(){
      var number = 1;
      var unitKomp = this.selectedSkema.children;
      var kuk = [];
      unitKomp.forEach((element, index) => {
        element['type'] = 'unitKomp';
        element['index'] = number++;
        kuk.push(element);
        // this.headerTable[3].content.push(element['unit_kompetensi']);
        this.listKodeUnit.push(element);
        element.elemen.forEach((element, index) => {
          element['type'] = 'elemen';
          kuk.push(element);
          element.kuk.forEach((element, index) => {
            element['type'] = 'kuk';
            element['bukti_pendukung'] = 'raport';
            kuk.push(element);
          });
        });
      });
      // var elemen = unitKomp.elemen;
      // var kuk = elemen.kuk;
      this.listKuk = kuk;
      // console.log(this.listKuk);
      // this.insertDetailAPl02();
    },
    search(nameKey, myArray){
      for (var i = 0; i < myArray.length; i++) {
        if (myArray[i].status === nameKey) {
          return myArray[i];
        }
      }
    },
    onSubmit() {
      this.loading = true;
      this.dataTrx.userId = this.userId;
      this.dataTrx.status = this.pilihanTerima;
      this.dataTrx.signature = this.$refs.signature.save();
      this.dataTrx.nama_asesor = this.ttdTable2[0].nama;
      const formData = new FormData();
      formData.append('id_apl_02', this.$route.params.id_apl_02);
      formData.append('signature', this.dataTrx.signature);
      formData.append('nama_asesor', this.dataTrx.nama_asesor);
      formData.append('user_id', this.dataTrx.userId);
      formData.append('status', this.ttdTable2[0].status);
      apl02UpdateResource
        .store(formData)
        .then(response => {
          this.$message({
            message: 'FR APL 02 has been Submited successfully.',
            type: 'success',
            duration: 5 * 1000,
          });
          this.$router.push({ name: 'uji-komp-list' });
        })
        .catch(error => {
          console.log(error);
          this.loading = false;
        })
        .finally(() => {
          this.loading = false;
        });
    },
    onResize() {
      const width = document.body.clientWidth;
      this.isWide = width > 800;
      if (this.isWide) {
        this.labelPosition = 'left';
      } else {
        this.labelPosition = 'top';
      }
    },
    handleFotoSuccess(res, file) {
      this.dataTrx.foto = URL.createObjectURL(file.raw);
    },
    handleIdentitasSuccess(res, file) {
      this.dataTrx.identitas = URL.createObjectURL(file.raw);
    },
    handleRaportSuccess(res, file) {
      this.dataTrx.raport = URL.createObjectURL(file.raw);
    },
    handleSertifikatSuccess(res, file) {
      this.dataTrx.sertifikat = URL.createObjectURL(file.raw);
    },
    beforeAvatarUpload(file) {
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!isLt2M) {
        this.$message.error('Document size can not exceed 2MB!');
      }
      return isLt2M;
    },
  },
};
</script>

<style lang="scss" scoped>
.form {
  padding-right: 50px;
  padding-left: 50px;
}
.edit-input {
  padding-right: 100px;
}
.cancel-btn {
  position: absolute;
  right: 15px;
  top: 10px;
}
.dialog-footer {
  text-align: left;
  padding-top: 0;
  margin-left: 150px;
}
.app-container {
  flex: 1;
  justify-content: space-between;
  font-size: 14px;
  padding-right: 8px;
  padding-bottom: 8px;
  .block {
    float: left;
    min-width: 250px;
  }
  .clear-left {
    clear: left;
  }
}
</style>
