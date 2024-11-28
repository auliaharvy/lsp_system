<template v-loading="loading">
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
            <h3>FR.IA.01 CEKLIS OBSERVASI AKTIVITAS DI TEMPAT KERJA ATAU TEMPAT KERJA SIMULASI</h3>
            <el-table
              v-loading="loading"
              :data="headerTable"
              fit
              highlight-current-row
              style="width: 100%"
              :header-cell-style="{ 'text-align': 'center' }"
            >
              <el-table-column
                align="left"
                min-width="30px"
              >
                <template slot-scope="scope">
                  <span>{{ scope.row.title }}</span>
                </template>
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
              :data="['-']"
              fit
              border
              highlight-current-row
              style="width: 750px"
              :header-cell-style="{ 'text-align': 'left', 'background': '#324157', 'color': 'white' }"
            >
              <el-table-column
                align="left"
                label="PANDUAN BAGI ASESOR"
              >
                <ul>
                  <li
                    v-for="item in panduan"
                    :key="item"
                  >
                    {{ item }}
                  </li>
                </ul>
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
              style="width: 750px"
              :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
            >
              <el-table-column
                align="center"
                label="No"
                width="50px"
              >
                <template slot-scope="scope">
                  <span>{{ scope.row.index }}</span>
                </template>
              </el-table-column>

              <el-table-column
                align="center"
                label="Kode Unit"
              >
                <template slot-scope="scope">
                  <span>{{ scope.row.kode_unit }}</span>
                </template>
              </el-table-column>

              <el-table-column
                align="left"
                label="Judul Unit Kompetensi / Elemen Kompetensi / Kriteria Unjuk Kerja(KUK)"
                min-width="300px"
              >
                <template slot-scope="scope">
                  <span v-if="scope.row.type === 'unitKomp'"><b>{{ scope.row.unit_kompetensi }}</b></span>
                  <span v-else-if="scope.row.type === 'elemen'"><b>{{ scope.row.nama_elemen }}</b></span>
                  <span v-else>{{ scope.row.kuk }}</span>
                </template>
              </el-table-column>

              <el-table-column
                align="center"
                label="Benchmark (SOP / Spesifikasi Produk Industri)"
                min-width="100px"
              >
                <template slot-scope="scope">
                  <span><b>{{ scope.row.benchmark }}</b></span>
                </template>
              </el-table-column>

              <el-table-column
                align="left"
                label="K / BK"
                min-width="150px"
              >
                <template slot="header">
                  <span>K / BK</span>
                  <el-select
                    v-model="kompeten"
                    class="filter-item"
                    placeholder="B/BK"
                    :key-value="kompeten"
                    @change="allKompeten"
                  >
                    <el-option
                      :key="0"
                      label="Kompeten"
                      :value="0"
                    />
                    <el-option
                      :key="1"
                      label="Belum Kompeten"
                      :value="1"
                    />
                  </el-select>
                </template>
                <template slot-scope="scope">
                  <template v-if="scope.row.type === 'kuk'">
                    <el-radio
                      v-model="scope.row.is_kompeten"
                      :label="0"
                    >
                      Kompeten
                    </el-radio>
                    <el-radio
                      v-model="scope.row.is_kompeten"
                      :label="1"
                    >
                      Belum Kompeten
                    </el-radio>
                  </template>
                </template>
              </el-table-column>

              <el-table-column
                align="center"
                label="Penilaian Lanjut"
                min-width="80px"
              >
                <template slot-scope="scope">
                  <el-input
                    v-if="scope.row.type === 'kuk'"
                    v-model="scope.row.penilaian_lanjut"
                    type="textarea"
                    :rows="2"
                    placeholder="Please input"
                  />
                </template>
              </el-table-column>
            </el-table>

            <br>

            <el-form
              ref="form"
              :model="form"
              label-width="250px"
              label-position="left"
            >
              <el-form-item
                label="Apakah Asesi Kompeten?"
                prop="kompeten"
              >
                <el-select
                  v-model="form.status"
                  class="filter-item"
                  placeholder="B/BK"
                >
                  <el-option
                    :key="0"
                    label="Kompeten"
                    :value="0"
                  />
                  <el-option
                    :key="1"
                    label="Belum Kompeten"
                    :value="1"
                  />
                </el-select>
              </el-form-item>
              <el-form-item
                label="Umpan Balik untuk Asesi"
                prop="umpanBalik"
              >
                <el-input
                  v-model="form.note"
                  placeholder="Isi umpan balik untuk asesi"
                />
              </el-form-item>
            </el-form>

            <br>

            <el-button @click="onSubmit">
              Submit
            </el-button>
          </div>
        </el-main>
      </section>
    </vue-html2pdf>
    <el-header>
      <el-page-header
        content="FR.IA.01 CEKLIS OBSERVASI AKTIVITAS DI TEMPAT KERJA ATAU TEMPAT KERJA SIMULASI"
        @back="$router.back()"
      />
    </el-header>
    <el-main v-loading="loading">
      <div>
        <el-table
          v-loading="loading"
          :data="headerTable"
          fit
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center' }"
        >
          <el-table-column
            align="left"
            min-width="30px"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.title }}</span>
            </template>
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
          :data="['-']"
          fit
          border
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'left', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column
            align="left"
            label="PANDUAN BAGI ASESOR"
          >
            <ul>
              <li
                v-for="item in panduan"
                :key="item"
              >
                {{ item }}
              </li>
            </ul>
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
          <el-table-column
            align="center"
            label="No"
            width="50px"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.index }}</span>
            </template>
          </el-table-column>

          <el-table-column
            align="center"
            label="Kelompok Pekerjaan"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.kelompokPekerjaan }}</span>
            </template>
          </el-table-column>

          <el-table-column
            align="center"
            label="Kode Unit"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.kode_unit }}</span>
            </template>
          </el-table-column>

          <el-table-column
            align="left"
            label="Judul Unit Kompetensi / Elemen Kompetensi / Kriteria Unjuk Kerja(KUK)"
            min-width="300px"
          >
            <template slot-scope="scope">
              <span v-if="scope.row.type === 'unitKomp'"><b>{{ scope.row.unit_kompetensi }}</b></span>
              <span v-else-if="scope.row.type === 'elemen'"><b>{{ scope.row.nama_elemen }}</b></span>
              <span v-else>{{ scope.row.kuk }}</span>
            </template>
          </el-table-column>

          <el-table-column
            align="center"
            label="Benchmark (SOP / Spesifikasi Produk Industri)"
            min-width="100px"
          >
            <template slot-scope="scope">
              <span><b>{{ scope.row.benchmark }}</b></span>
            </template>
          </el-table-column>

          <el-table-column
            align="left"
            label="K / BK"
            min-width="80px"
          >
            <template slot="header">
              <span>K / BK</span>
              <el-select
                v-model="kompeten"
                class="filter-item"
                placeholder="B/BK"
                @change="allKompeten"
              >
                <el-option
                  :key="0"
                  label="Kompeten"
                  :value="0"
                />
                <el-option
                  :key="1"
                  label="Belum Kompeten"
                  :value="1"
                />
              </el-select>
            </template>
            <template slot-scope="scope">
              <template v-if="scope.row.type === 'kuk'">
                <el-radio
                  v-model="scope.row.is_kompeten"
                  :label="0"
                >
                  Kompeten
                </el-radio>
                <el-radio
                  v-model="scope.row.is_kompeten"
                  :label="1"
                >
                  Belum Kompeten
                </el-radio>
              </template>
              <!-- <el-select v-if="scope.row.type === 'kuk'" v-model="scope.row.is_kompeten" class="filter-item" placeholder="B/BK">
                <el-option :key="0" label="Kompeten" :value="0" />
                <el-option :key="1" label="Belum Kompeten" :value="1" />
              </el-select> -->
            </template>
          </el-table-column>

          <el-table-column
            align="center"
            label="Penilaian Lanjut"
            min-width="80px"
          >
            <template slot-scope="scope">
              <el-input
                v-if="scope.row.type === 'kuk'"
                v-model="scope.row.penilaian_lanjut"
                type="textarea"
                :rows="2"
                placeholder="Please input"
              />
            </template>
          </el-table-column>
        </el-table>

        <br>

        <el-form
          ref="form"
          :model="form"
          label-width="250px"
          label-position="left"
        >
          <el-form-item
            label="Apakah Asesi Kompeten?"
            prop="kompeten"
          >
            <el-select
              v-if="$route.params.id_ia_01 === null"
              v-model="form.status"
              class="filter-item"
              placeholder="B/BK"
            >
              <el-option
                :key="0"
                label="Kompeten"
                :value="0"
              />
              <el-option
                :key="1"
                label="Belum Kompeten"
                :value="1"
              />
            </el-select>
            <div v-else>
              <span v-if="ia01.status === 0">Kompeten</span>
              <span v-if="ia01.status === 1">Belum Kompeten</span>
            </div>
          </el-form-item>
          <el-form-item
            label="Umpan Balik untuk Asesi"
            prop="umpanBalik"
          >
            <el-input
              v-if="$route.params.id_ia_01 === null"
              v-model="form.note"
              placeholder="Isi umpan balik untuk asesi"
            />
            <span v-else>{{ ia01.note }}</span>
          </el-form-item>
          <el-form-item label="Tanda Tangan Asesor">
            <div v-if="$route.params.id_ia_01 === null">
              <vueSignature
                ref="signature"
                :sig-option="option"
                :w="'300px'"
                :h="'150px'"
                :disabled="false"
                style="border-style: outset"
              />
              <el-button
                size="small"
                @click="clear"
              >
                Clear
              </el-button>
            </div>
            <el-image
              v-else
              style="width: 200px; height: 100px"
              :src="ttdAsesor"
              fit="contain"
            />
          </el-form-item>
          <el-form-item label="Tanda Tangan Asesi">
            <div v-if="$route.params.id_ia_01 === null">
              <vueSignature
                ref="signature1"
                :sig-option="option"
                :w="'300px'"
                :h="'150px'"
                :disabled="false"
                style="border-style: outset"
              />
              <el-button
                size="small"
                @click="clear1"
              >
                Clear
              </el-button>
            </div>
            <el-image
              v-else
              style="width: 200px; height: 100px"
              :src="ttdAsesi"
              fit="contain"
            />
          </el-form-item>
        </el-form>

        <br>

        <el-button
          v-if="$route.params.id_ia_01 !== null"
          @click="generateReport"
        >
          Print
        </el-button>
        <el-button
          v-else
          @click="onSubmit"
        >
          Submit
        </el-button>
      </div>
    </el-main>
  </el-container>
</template>

<script>
import vueSignature from 'vue-signature';
import { mapGetters } from 'vuex';
import Resource from '@/api/resource';
import VueHtml2pdf from 'vue-html2pdf';
// import moment from 'moment';
const jadwalResource = new Resource('jadwal-get');
const skemaResource = new Resource('skema-get');
const tukResource = new Resource('tuk-get');
const ujiKomResource = new Resource('uji-komp-get');
const ia01Resource = new Resource('uji-komp-ia-01');
const ia01Detail = new Resource('detail/ia-01');

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
      kompeten: null,
      loading: false,
      listSkema: null,
      listTuk: null,
      listJadwal: null,
      listKuk: [],
      listUji: [],
      fileName: null,
      ttdAsesor: '',
      ttdAsesi: '',
      selectedSkema: {},
      selectedUji: {},
      dataTrx: {},
      ia01: null,
      listDetailIa01: null,
      headerTable: [
        {
          title: 'Skema Sertifikasi',
          content: '-',
        },
        {
          title: 'TUK',
          content: '-',
        },
        {
          title: 'Nama Asesor',
          content: '-',
        },
        {
          title: 'Nama Asesi',
          content: '-',
        },
        {
          title: 'Tanggal',
          content: '-',
        },
      ],
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
  watch: {
    kompeten: async function() {
      this.loading = true;
      for (var i = 0; i < this.listKuk.length; i++) {
        if (this.listKuk[i].type === 'kuk'){
          this.listKuk[i].is_kompeten = this.kompeten;
        }
      }
      this.loading = false;
    },
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.onResize);
  },
  mounted() {
    window.addEventListener('resize', this.onResize);
    this.onResize();
  },
  created() {
    // this.getListSkema().then((value) => {
    this.onJadwalSelect();
    // });
    // this.getListUji().then((value) => {
    this.getUjiKompDetail();
    // });
    this.getIa01();
  },
  methods: {
    clear() {
      this.$refs.signature.clear();
    },
    clear1() {
      this.$refs.signature1.clear();
    },
    async getIa01() {
      if (this.$route.params.id_ia_01 !== null) {
        this.loading = true;
        const data = await ia01Detail.get(this.$route.params.id_ia_01);
        this.listDetailIa01 = data.detail;
        this.ia01 = data.ia_01;
        this.ttdAsesor = '/uploads/users/signature/' + this.ia01.ttd_asesor;
        this.ttdAsesi = '/uploads/users/signature/' + this.ia01.ttd_asesi;
        this.listKuk.forEach((element, index) => {
          if (element['type'] === 'kuk') {
            var foundIndex = data.detail.findIndex(x => x.id_kuk_elemen === element['id']);
            element['is_kompeten'] = data.detail[foundIndex].is_kompeten;
            element['penilaian_lanjut'] = data.detail[foundIndex].penilaian_lanjut;
          }
        });
        this.loading = false;
      }
    },
    allKompeten() {
      this.loading = true;
      for (var i = 0; i < this.listKuk.length; i++) {
        if (this.listKuk[i].type === 'kuk'){
          this.listKuk[i].is_kompeten = this.kompeten;
        }
      }
      this.loading = false;
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
    // async getListSkema() {
    //   const { data } = await skemaResource.list();
    //   this.listSkema = data;
    // },
    // async getListUji() {
    //   const { data } = await ujiKomResource.list();
    //   this.listUji = data;
    // },
    async getListTuk() {
      const { data } = await tukResource.list();
      this.listTuk = data;
    },
    async getListJadwal() {
      const { data } = await jadwalResource.list();
      this.listJadwal = data;
    },
    async getUjiKompDetail() {
      this.loading = true;
      // var id_uji = this.$route.params.id_uji;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      // var ujiDetail = this.listUji.find((x) => x.id === id_uji);
      // this.selectedUji = ujiDetail;
      // this.selectedUji = ujiDetail;
      var id_apl_01 = this.$route.params.id_apl_01;
      this.listUji = await ujiKomResource.list({ idapl01: id_apl_01 });

      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.fileName = 'APL.02 - ' + this.listUji.data[0].nama_peserta + ' - ' + this.listUji.data[0].kode_skema;
      this.headerTable[0].content = this.listUji.data[0].skema_sertifikasi;
      this.headerTable[1].content = this.listUji.data[0].nama_tuk;
      this.headerTable[2].content = this.listUji.data[0].asesor;
      this.headerTable[3].content = this.listUji.data[0].nama_peserta;
      this.headerTable[4].content = this.listUji.data[0].mulai;
      this.loading = false;
    },
    async onJadwalSelect() {
      // var id_skema = this.$route.params.id_skema;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      // var skemaId = this.listSkema.find((x) => x.id === id_skema);
      // this.selectedSkema = skemaId;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      // this.dataTrx.id_skema = skemaId.id;
      // this.dataTrx.id_tuk = tukId.id;
      // this.getKuk();
      var idSkema = this.$route.params.id_skema;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      // var skemaId = this.listSkema.find((x) => x.id === id_skema);
      var skemaId = await skemaResource.list({ id_skema: idSkema });
      this.selectedSkema = skemaId.data[0];
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.dataTrx.id_skema = skemaId.id;
      // this.dataTrx.id_tuk = tukId.id;
      this.getKuk();
    },
    getKuk(){
      var number = 1;
      var unitKomp = this.selectedSkema.children;
      var kuk = [];
      let kelompokPekerjaan = ''

      unitKomp.forEach((element, index) => {
        if(index == 0) element['kelompokPekerjaan'] = element?.kelompok_pekerjaan
        if(kelompokPekerjaan != element?.kelompok_pekerjaan) {
          element['index'] = number++
          element['kelompokPekerjaan'] = element?.kelompok_pekerjaan
        }
        kelompokPekerjaan = element?.kelompok_pekerjaan
        element['type'] = 'unitKomp';
        kuk.push(element);
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
      this.form.signature_asesor = this.$refs.signature.save();
      this.form.signature_asesi = this.$refs.signature1.save();
      this.form.detail_ia_01 = this.listKuk;
      this.form.user_id = this.userId;
      this.form.id_uji_komp = this.$route.params.id_uji;
      this.form.id_skema = this.$route.params.id_skema;
      const formData = new FormData();
      formData.append('id_uji_komp', this.form.id_uji_komp);
      var arrayDetail = JSON.stringify(this.form.detail_ia_01);
      formData.append('detail_ia_01', arrayDetail);
      formData.append('user_id', this.form.id_skema);
      formData.append('status', this.form.status);
      formData.append('note', this.form.note);
      formData.append('ttd_asesor', this.form.signature_asesor);
      formData.append('ttd_asesi', this.form.signature_asesi);
      ia01Resource
        .store(formData)
        .then(response => {
          this.$message({
            message: 'FR IA 01 has been created successfully.',
            type: 'success',
            duration: 5 * 1000,
          });
          this.$router.push({ name: 'uji-komp-list' });
        })
        .catch(error => {
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
