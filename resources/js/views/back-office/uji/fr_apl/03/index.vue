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
      @hasStartedGeneration="hasStartedGeneration()"
      @hasGenerated="hasGenerated($event)"
    >
      <section slot="pdf-content">
        <el-main>
          <div>
            <section slot="pdf-item">
              <h3>FR.APL.01 PERMOHONAN SERTIFIKASI KOMPETENSI</h3>
              <h4>Bagian 1 : Rincian Data Pemohon Sertifikasi</h4>
              <span>Pada bagian ini, cantumlah data pribadi, data pendidikan formal serta data pekerjaan anda pada saat ini.</span>
              <br>
              <h5>a. Data Pribadi</h5>
              <el-table
                v-loading="loading"
                :data="headerTable"
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
              <h5>b. Data Pekerjaan</h5>
              <el-table
                v-loading="loading"
                :data="dataPekerjaanTable"
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

            <div class="html2pdf__page-break" />

            <section slot="pdf-item">
              <h4>Bagian 2 : Data Sertifikasi</h4>
              <span>Tuliskan Judul dan Nomor Skema Sertifikasi yang anda ajukan berikut Daftar Unit Kompetensi sesuai kemasan pada skema sertifikasi untuk mendapatkan pengakuan sesuai dengan latar belakang pendidikan, pelatihan serta pengalaman kerja yang anda miliki.</span>
              <br>
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
                :data="listKodeUnit"
                fit
                border
                highlight-current-row
                style="width: 750px"
                :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
              >
                <el-table-column align="center" min-width="10px" label="No">
                  <template slot-scope="scope">
                    <span>{{ scope.row.index }}</span>
                  </template>
                </el-table-column>
                <el-table-column align="left" width="200px" label="Kode Unit">
                  <template slot-scope="scope">
                    <span>{{ scope.row.kode_unit }}</span>
                  </template>
                </el-table-column>
                <el-table-column align="left" label="Unit Kompetensi">
                  <template slot-scope="scope">
                    <span>{{ scope.row.unit_kompetensi }}</span>
                  </template>
                </el-table-column>
              </el-table>

            </section>

            <div class="html2pdf__page-break" />

            <section slot="pdf-item">
              <h4>Bagian 3 : Bukti Kelengkapan Pemohon</h4>
              <el-table
                v-loading="loading"
                :data="buktiKelengkapanTable"
                fit
                border
                highlight-current-row
                style="width: 750px"
                :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
              >
                <el-table-column align="left" width="200px" label="Bukti persyaratan Dasar">
                  <template slot-scope="scope">
                    <span>{{ scope.row.title }}</span>
                  </template>
                </el-table-column>
                <el-table-column align="center" width="20px">
                  <span> : </span>
                </el-table-column>
                <el-table-column align="left" label="Ada / Tidak">
                  <template slot-scope="scope">
                    <a v-if="scope.row.content !== ''" target="_blank" :href="scope.row.content">
                      <i class="el-icon-check" style="color: green;" />
                    </a>
                    <i v-else class="el-icon-close" style="color: red;" />
                  </template>
                </el-table-column>
              </el-table>
              <br>
              <el-table
                v-loading="loading"
                :data="ttdTable"
                fit
                border
                highlight-current-row
                style="width: 750px"
                :header-cell-style="{ 'text-align': 'center', 'display': 'none' }"
              >
                <el-table-column align="left">
                  <template slot-scope="scope">
                    <template v-if="scope.row.no === 2">
                      Tanda Tangan Asesi :
                      <br>
                      <img v-if="ttdAsesi" :src="'/uploads/users/signature/' + ttdAsesi" class="sidebar-logo">
                    </template>
                    <span>{{ scope.row.title }}</span>
                  </template>
                </el-table-column>
                <el-table-column align="center" width="20px">
                  <span> : </span>
                </el-table-column>
                <el-table-column align="left">
                  <template slot-scope="scope">
                    <template v-if="scope.row.no === 2">
                      Tanda Tangan Admin Jurusan:
                      <br>
                      <img v-if="ttdAdmin" :src="'/uploads/users/signature/' + ttdAdmin" class="sidebar-logo">
                    </template>
                  </template>
                </el-table-column>
              </el-table>
            </section>
          </div>
        </el-main>
      </section>
    </vue-html2pdf>

    <el-header>
      <el-page-header content="FR.APL.01 PERMOHONAN SERTIFIKASI KOMPETENSI" @back="$router.back()" />
    </el-header>
    <el-main v-loading="loading">
      <div>
        <h4>Bagian 1 : Rincian Data Pemohon Sertifikasi</h4>
        <span>Pada bagian ini, cantumlah data pribadi, data pendidikan formal serta data pekerjaan anda pada saat ini.</span>
        <br>
        <h5>a. Data Pribadi</h5>
        <el-table
          v-loading="loading"
          :data="headerTable"
          fit
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
        <h5>b. Data Pekerjaan</h5>
        <el-table
          v-loading="loading"
          :data="dataPekerjaanTable"
          fit
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

        <h4>Bagian 2 : Data Sertifikasi</h4>
        <span>Tuliskan Judul dan Nomor Skema Sertifikasi yang anda ajukan berikut Daftar Unit Kompetensi sesuai kemasan pada skema sertifikasi untuk mendapatkan pengakuan sesuai dengan latar belakang pendidikan, pelatihan serta pengalaman kerja yang anda miliki.</span>
        <br>
        <el-table
          v-loading="loading"
          :data="judulSertifikasiTable"
          fit
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
          :data="listKodeUnit"
          fit
          border
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="left" min-width="10px" label="No">
            <template slot-scope="scope">
              <span>{{ scope.row.index }}</span>
            </template>
          </el-table-column>
          <el-table-column align="left" width="200px" label="Kode Unit">
            <template slot-scope="scope">
              <span>{{ scope.row.kode_unit }}</span>
            </template>
          </el-table-column>
          <el-table-column align="left" label="Unit Kompetensi">
            <template slot-scope="scope">
              <span>{{ scope.row.unit_kompetensi }}</span>
            </template>
          </el-table-column>
        </el-table>

        <br>

        <h4>Bagian 3 : Bukti Kelengkapan Pemohon</h4>
        <br>
        <el-table
          v-loading="loading"
          :data="buktiKelengkapanTable"
          fit
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="left" width="200px" label="Bukti persyaratan Dasar">
            <template slot-scope="scope">
              <span>{{ scope.row.title }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" width="20px">
            <span> : </span>
          </el-table-column>
          <el-table-column align="left" label="Ada / Tidak">
            <template slot-scope="scope">
              <a v-if="scope.row.content !== ''" target="_blank" :href="scope.row.content">
                <i class="el-icon-check" style="color: green;" />
              </a>
              <i v-else class="el-icon-close" style="color: red;" />
            </template>
          </el-table-column>
        </el-table>
        <br>
        <br>
        <el-table
          v-loading="loading"
          :data="ttdTable"
          fit
          border
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'display': 'none' }"
        >
          <el-table-column align="left">
            <template slot-scope="scope">
              <template v-if="scope.row.no === 2">
                Tanda Tangan Asesi :
                <br>
                <img v-if="ttdAsesi" :src="'/uploads/users/signature/' + ttdAsesi" class="sidebar-logo">
              </template>
              <span>{{ scope.row.title }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" width="20px">
            <span> : </span>
          </el-table-column>
          <el-table-column align="left">
            <template slot-scope="scope">
              <template v-if="scope.row.no === 1">
                <el-select v-model="pilihanTerima" class="filter-item" placeholder="T/TT" value-key="status">
                  <el-option :key="0" label="Terima / Tidak Terima" :value="0" />
                  <el-option :key="1" label="Terima" :value="1" />
                  <el-option :key="2" label="Tidak Terima" :value="2" />
                </el-select>
              </template>

              <template v-if="scope.row.no === 2">
                Tanda Tangan Admin Jurusan:
                <br>
                <div v-if="!ttdAdmin">
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
                <div v-else>
                  {{ namaAdmin }}
                  <br>
                  <img :src="'/uploads/users/signature/' + ttdAdmin" class="sidebar-logo">
                </div>
              </template>
            </template>
          </el-table-column>
        </el-table>

      </div>
    </el-main>
    <el-button v-if="dataAsesi.status === 0" @click="onSubmit">Submit</el-button>
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
const apl01UpdateResource = new Resource('uji-komp-apl-01');
const skemaResource = new Resource('skema-get');

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
      listKuk: [],
      listUji: [],
      namaAdmin: null,
      listKodeUnit: [],
      selectedSkema: {},
      selectedUji: {},
      ttdAsesi: null,
      ttdAdmin: null,
      pilihanTerima: 0,
      dataTrx: {},
      testPng: null,
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
      ttdTable: [
        {
          no: 1,
          title: 'Rekomendasi (diisi oleh LSP): Berdasarkan ketentuan persyaratan dasar, maka pemohon: Diterima/ Tidak diterima *) sebagai peserta  sertifikasi coret yang tidak sesuai',
          content: 'Catatan',
        },
        {
          no: 2,
          title: '',
          content: '',
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
    this.getListSkema().then((value) => {
      this.onJadwalSelect();
    });
    this.getApl01();
    console.log(this.$route.params.id_apl_01);
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
      await html2pdf().set(options).from(pdfContent).toPdf().get('pdf').then((pdf) => {
        const totalPages = pdf.internal.getNumberOfPages();
        for (let i = 1; i <= totalPages; i++) {
          pdf.setPage(i);
          pdf.setFontSize(10);
          pdf.setTextColor(150);
          pdf.text('Page ' + i + ' of ' + totalPages, (pdf.internal.pageSize.getWidth() * 0.88), (pdf.internal.pageSize.getHeight() - 0.3));
        }
      }).save();
    },
    async getApl01() {
      this.loading = true;
      this.dataTrx.id_apl_01 = this.$route.params.id_apl_01;
      const data = await apl01Resource.get(this.$route.params.id_apl_01);
      const ttl = data.tempat_lahir + ' / ' + moment(data.tanggal_lahir).format('DD-MM-YYYY');
      const pendidikan = data.nama_sekolah + ' (' + data.tingkatan + ')';
      this.fileName = 'APL.01 - ' + data.nama_lengkap + ' - ' + data.kode_skema;
      this.headerTable[0].content = data.nama_lengkap;
      this.headerTable[1].content = data.nik;
      this.headerTable[2].content = ttl;
      this.headerTable[3].content = data.jenis_kelamin;
      this.headerTable[4].content = data.alamat;
      this.headerTable[5].content = data.no_hp;
      this.headerTable[6].content = data.email;
      this.headerTable[7].content = pendidikan;

      if (data.status === 0) {
        this.ttdTable[0].title = 'Rekomendasi (diisi oleh LSP): Berdasarkan ketentuan persyaratan dasar, maka pemohon: Diterima / Tidak diterima *) sebagai peserta  sertifikasi coret yang tidak sesuai';
      } if (data.status === 1) {
        this.ttdTable[0].title = 'Rekomendasi (diisi oleh LSP): Berdasarkan ketentuan persyaratan dasar, maka pemohon: Diterima sebagai peserta  sertifikasi';
      } if (data.status === 2) {
        this.ttdTable[0].title = 'Rekomendasi (diisi oleh LSP): Berdasarkan ketentuan persyaratan dasar, maka pemohon: Ditolak sebagai peserta  sertifikasi';
      }
      this.dataAsesi.sign = '/uploads/users/signature/' + data.signature;
      this.ttdAsesi = data.signature;
      this.ttdAdmin = data.ttd_admin;
      this.dataAsesi.ttd_admin = '/uploads/users/signature/' + data.ttd_admin;
      this.namaAdmin = data.nama_admin;
      this.dataAsesi.nama = data.nama_lengkap;
      this.dataAsesi.status = data.status;
      this.pilihanTerima = data.status;
      console.log(data);
      if (data.foto !== ''){
        this.buktiKelengkapanTable[0].content = '/uploads/users/foto/' + data.foto;
      }
      if (data.sertifikat !== ''){
        this.buktiKelengkapanTable[1].content = '/uploads/users/sertifikat/' + data.sertifikat;
      }
      if (data.identitas !== ''){
        this.buktiKelengkapanTable[2].content = '/uploads/users/identitas/' + data.identitas;
      }
      if (data.raport !== ''){
        this.buktiKelengkapanTable[3].content = '/uploads/users/raport/' + data.raport;
      }
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
      const formData = new FormData();
      formData.append('id_apl_01', this.dataTrx.id_apl_01);
      formData.append('signature', this.dataTrx.signature);
      formData.append('user_id', this.dataTrx.userId);
      formData.append('email', this.headerTable[6].content);
      formData.append('status', this.dataTrx.status);
      apl01UpdateResource
        .store(formData)
        .then(response => {
          this.$message({
            message: 'FR APL 01 has been Submited successfully.',
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
.sidebar-logo {
        width: 200px;
        height: 120px;
        vertical-align: middle;
        margin-right: 12px;
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
