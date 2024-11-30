<template>
  <el-container class="app-container">
    <el-header>
      <el-page-header
        content="FR.IA.02 TUGAS PRAKTIK DEMONSTRASI"
        @back="$router.back()"
      />
    </el-header>
    <el-main>
      <div>
        <el-table
          v-loading="loading"
          :data="headerTable"
          fit
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
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
          :data="unitKompetensiTable"
          border
          fit
          highlight-current-row
          :span-method="objectSpanMethod"
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column
            align="left"
            width="150px"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.col1 }}</span>
            </template>
          </el-table-column>
          <el-table-column
            align="left"
            width="120px"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.col2 }}</span>
            </template>
          </el-table-column>
          <el-table-column align="left">
            <template slot-scope="scope">
              <ul>
                <li
                  v-for="item in scope.row.col3"
                  :key="item.filename"
                >
                  {{ item }}
                </li>
              </ul>
            </template>
          </el-table-column>
        </el-table>

        <el-table
          v-loading="loading"
          :data="soalJawaban"
          border
          fit
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <!-- <el-table-column align="left" width="120px">
            <template slot-scope="scope">
              <span>{{ scope.row.col1 }}</span>
            </template>
          </el-table-column> -->
          <el-table-column
            align="left"
            width="120px"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.col2 }}</span>
            </template>
          </el-table-column>
          <el-table-column align="left">
            <template slot-scope="scope">
              <ul>
                <li
                  v-for="item in scope.row.col3"
                  :key="item.filename"
                  style="margin-bottom: 10px;"
                >
                  <a
                    target="_blank"
                    :href="'/' + item.link"
                  >
                    {{ item.filename }}
                  </a>
                </li>
              </ul>
            </template>
          </el-table-column>
        </el-table>

        <el-form
          ref="form"
          :model="dataTrx"
          label-width="250px"
          label-position="left"
        >
          <el-form-item
            v-if="role !== 'assesor' && showUpload"
            label="Upload File Jawaban"
            prop="file"
          >
            <input
              ref="inputFile"
              type="file"
              @change="handleUploadSuccess"
            >
          </el-form-item>
          <el-form-item
            v-if="role !== 'user'"
            label="Rekomendasi Assesor"
            prop="rekomendasi_asesor"
            style="margin-top: 15px"
          >
            <el-radio
              v-model="dataTrx.rekomendasi_asesor"
              label="Kompeten"
              border
            >
              Kompeten
            </el-radio>
            <el-radio
              v-model="dataTrx.rekomendasi_asesor"
              label="Belum Kompeten"
              border
            >
              Belum Kompeten
            </el-radio>
          </el-form-item>
        </el-form>
      </div>
      <br>
      <el-button
        v-if="showUpload"
        @click="onSubmit"
      >
        Submit
      </el-button>
      <el-button
        v-if="$route.params.id_ia_02 && role !== 'user'"
        @click="onSubmitAsesor"
      >
        Submit Asesor
      </el-button>
    </el-main>
  </el-container>
</template>

<script>
import { mapGetters } from 'vuex';
import Resource from '@/api/resource';
const jadwalResource = new Resource('jadwal-get');
const skemaResource = new Resource('skema-get');
const tukResource = new Resource('tuk-get');
const ujiKomResource = new Resource('uji-komp-get');
const ia02Resource = new Resource('uji-komp-ia-02');
const ia02DetailResource = new Resource('uji-komp-ia-02-detail');
const ia02NilaiResource = new Resource('uji-komp-ia-02-nilai');
const mstIa02Resource = new Resource('mst-ia02-get');
const mstIa02DetailResource = new Resource('mst-ia02-get-detail');
const ia02Detail = new Resource('detail/ia-02');
const preview = new Resource('detail/preview');

export default {
  components: {},
  data() {
    return {
      radio1: 'Kompeten',
      role: null,
      showUpload: false,
      kompeten: null,
      loading: false,
      listSkema: null,
      listTuk: null,
      listJadwal: null,
      listKodeUnit: [],
      listJudulUnit: [],
      listKuk: [],
      listUji: [],
      detail: {},
      dataSoal: null,
      selectedSkema: {},
      selectedUji: {},
      dataTrx: {},
      soalJawaban: [
        {
          col1: '',
          col2: 'Soal',
          col3: [],
        },
        {
          col1: '',
          col2: 'Jawaban',
          col3: [],
        },
        {
          col1: '',
          col2: 'Jawaban Asesi',
          col3: [],
        },
      ],
      unitKompetensiTable: [
        {
          col1: '',
          col2: 'Kelompok Pekerjaan',
          col3: [],
        },
        {
          col1: 'Unit Kompetensi',
          col2: 'Kode Unit',
          col3: [],
        },
        {
          col1: '',
          col2: 'Judul Unit',
          col3: [],
        },
      ],
      headerTable: [
        {
          title: 'Skema Sertifikasi',
          content: 'SKEMA SKNNI KLASIFIKASI II BISNIS DARING PEMASARAN',
        },
        {
          title: 'TUK',
          content: 'TUK BDP',
        },
        {
          title: 'Nama Asesor',
          content: 'AULIA HARVY',
        },
        {
          title: 'Nama Asesi',
          content: 'INDAH',
        },
        {
          title: 'Tanggal',
          content: '20 - 12 -2022',
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
      dataPreview: '',
      soal: [],
      jawaban: [],
      jawabanAsesi: [],
    };
  },
  computed: {
    ...mapGetters([
      'userId',
      'roles',
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
    // this.getListSkema().then((value) => {
    this.onJadwalSelect();
    // });
    // this.getListUji().then((value) => {
    //   this.getUjiKompDetail();
    //   this.getListPertanyaan();
    //   this.getIa02();
    // });

    this.getDataPreview();
    this.getUjiKompDetail();
    this.getListSoal();
    this.getIa02();
  },
  methods: {
    async getDataPreview(){
      this.loading = true;
      const data = await preview.get(this.$route.params.id_uji);
      this.dataPreview = data;
      this.loading = false;
    },
    async getIa02() {
      this.role = this.roles[0];
      if (this.$route.params.id_ia_02 !== null) {
        this.loading = true;
        const data = await ia02Detail.get(this.$route.params.id_ia_02);
        this.detail = data;
        // this.dataTrx.rekomendasi_asesor = data.rekomendasi_asesor;
        this.loading = false;
      }
    },
    allKompeten() {
      for (var i = 0; i < this.listKuk.length; i++) {
        var kuk = this.kukList[i];
        if (kuk.type === 'kuk'){
          // kuk.is_kompeten = this.kompeten;
        }
      }
    },
    filename(teks) {
      const regexfirst = new RegExp('uploads/perangkat/file/', 'i');
      const perangkatMatch = regexfirst.test(teks);
      if (perangkatMatch){
        const again = /^([^\-]+\-[^\-]+\-[^\-]+\-)/;
        return teks.replace(again, '');
      }
      const regexsecond = new RegExp('uploads/ia-02/jawaban/', 'i');
      const ia02DetailMatch = regexsecond.test(teks);
      if (ia02DetailMatch){
        const again = /^([^\-]+\-[^\-]+\-[^\-]+\-[^\-]+\-)/;
        return teks.replace(again, '');
      }
    },
    async getListSoal() {
      this.loading = true;
      const { data } = await mstIa02Resource.list({ id_skema: this.$route.params.id_skema });
      // console.log(await mstIa02Resource.list({ id_skema: this.$route.params.id_skema }));
      // console.log(this.$route.params.id_skema);
      const id_mst_ia_02 = data[0].id;
      this.listSoal = data;

      if (this.dataPreview.id_ia_02) {
        const { data: dataIa02Detail } = await ia02DetailResource.list({ id_trx_ia_02: this.dataPreview.id_ia_02 });
        const { data: dataMstIa02Detail } = await mstIa02DetailResource.list({ id_mst_ia_02 });
        // console.log(dataIa02Detail);
        const countingJawaban = dataIa02Detail.length;
        const countingSoal = dataMstIa02Detail.length;

        if (countingJawaban < countingSoal){
          this.showUpload = true;
          for (let i = 0; i <= countingJawaban; i++) {
            if (this.listSoal[i].soal !== null){
              this.soal.push({ link: this.listSoal[i].soal, filename: this.filename(this.listSoal[i].soal) });
              // console.log(this.soal);
              this.soalJawaban[0].col3.push(this.soal[i]);
              // console.log(this.soalJawaban[0]);
            }
          }

          for (let i = 0; i < countingJawaban; i++) {
            if (this.listSoal[i].jawaban !== null){
              this.jawaban.push({ link: this.listSoal[i].jawaban, filename: this.filename(this.listSoal[i].jawaban) });
              // console.log(this.jawaban[i]);
              this.soalJawaban[1].col3.push(this.jawaban[i]);
              // console.log(this.soalJawaban[1]);
            }

            if (dataIa02Detail[i].jawaban !== null){
              this.jawabanAsesi.push({ link: dataIa02Detail[i].jawaban, filename: this.filename(dataIa02Detail[i].jawaban) });
              // console.log(this.jawabanAsesi[i]);
              this.soalJawaban[2].col3.push(this.jawabanAsesi[i]);
              // console.log(this.soalJawaban[2]);
            }
          }
        }

        if (countingJawaban === countingSoal){
          for (let i = 0; i < countingJawaban; i++) {
            if (this.listSoal[i].soal !== null){
              this.soal.push({ link: this.listSoal[i].soal, filename: this.filename(this.listSoal[i].soal) });
              // console.log(this.soal);
              this.soalJawaban[0].col3.push(this.soal[i]);
            }

            if (this.listSoal[i].jawaban !== null){
              this.jawaban.push({ link: this.listSoal[i].jawaban, filename: this.filename(this.listSoal[i].jawaban) });
              // console.log(this.jawaban);
              // console.log(this.soalJawaban[1]);
            }

            if (dataIa02Detail[i].jawaban !== null){
              this.jawabanAsesi.push({ link: dataIa02Detail[i].jawaban, filename: this.filename(dataIa02Detail[i].jawaban) });
              // console.log(this.jawabanAsesi);
              this.soalJawaban[2].col3.push(this.jawabanAsesi[i]);
            }
          }
          this.jawaban.forEach((element, index) => {
            this.soalJawaban[1].col3.push(element);
          });
        }
      } else {
        this.showUpload = true;

        if (this.listSoal[0].soal !== null){
          this.soal.push({ link: this.listSoal[0].soal, filename: this.filename(this.listSoal[0].soal) });
          // console.log(this.soal);
          this.soalJawaban[0].col3.push(this.soal[0]);
        }
      }
      this.loading = false;
    },
    async getListSkema() {
      const { data } = await skemaResource.list();
      this.listSkema = data;
    },
    handleUploadSuccess(e) {
      const files = e.target.files;
      const rawFile = files[0]; // only use files[0]
      this.dataTrx.file = rawFile;
    },
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
      // var id_uji = this.$route.params.id_uji;
      var id_apl_01 = this.$route.params.id_apl_01;
      this.listUji = await ujiKomResource.list({ idapl01: id_apl_01 });
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      // var ujiDetail = this.listUji.find((x) => x.id === id_uji);
      // this.selectedUji = ujiDetail;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      // console.log(this.listUji);
      this.headerTable[0].content = this.listUji.data[0].skema_sertifikasi;
      this.headerTable[1].content = this.listUji.data[0].nama_tuk;
      this.headerTable[2].content = this.listUji.data[0].asesor;
      this.headerTable[3].content = this.listUji.data[0].nama_peserta;
      this.headerTable[4].content = this.listUji.data[0].mulai;
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
      // console.log(skemaId);
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.dataTrx.id_skema = skemaId.id;
      // this.dataTrx.id_tuk = tukId.id;
      this.getKuk();
    },
    getKuk(){
      var number = 1;
      var unitKomp = this.selectedSkema.children;
      // console.log(unitKomp);
      var kuk = [];
      unitKomp.forEach((element, index) => {
        element['type'] = 'unitKomp';
        element['index'] = number++;
        kuk.push(element);
        this.unitKompetensiTable[0].col3 = Array.from(new Set([...this.unitKompetensiTable[0].col3, element['kelompok_pekerjaan']]));
        this.unitKompetensiTable[1].col3.push(element['kode_unit']);
        this.unitKompetensiTable[2].col3.push(element['unit_kompetensi']);
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
      // console.log(this.listKodeUnit);
      // var elemen = unitKomp.elemen;
      // var kuk = elemen.kuk;
      this.listKuk = kuk;
    },
    async detectAsesiIsDone(){
      const { data } = await mstIa02Resource.list({ id_skema: this.$route.params.id_skema });
      const id_mst_ia_02 = data[0].id;
      const { data: dataIa02Detail } = await ia02DetailResource.list({ id_trx_ia_02: this.dataPreview.id_ia_02 });
      const { data: dataMstIa02Detail } = await mstIa02DetailResource.list({ id_mst_ia_02 });
      console.log(dataIa02Detail);
      console.log(dataMstIa02Detail);
      const countingJawaban = dataIa02Detail.length;
      const countingSoal = dataMstIa02Detail.length;
      console.log(countingJawaban);
      console.log(countingSoal);

      if (countingJawaban === countingSoal){
        this.$router.push({ name: 'uji-komp-list' }).catch(() => {});
      } else {
        location.reload();
      }
    },
    onSubmit() {
      this.loading = true;
      const uploadData = new FormData();
      uploadData.append('role', this.roles[0]);
      uploadData.append('id_skema', this.$route.params.id_skema);
      uploadData.append('id_uji_komp', this.$route.params.id_uji);
      uploadData.append('user_id', this.userId);
      uploadData.append('file', this.dataTrx.file);
      uploadData.append('rekomendasi_asesor', this.dataTrx.rekomendasi_asesor);

      ia02Resource
        .store(uploadData)
        .then(response => {
          this.detectAsesiIsDone();
          this.$message({
            message: 'FR IA 02 has been created successfully.',
            type: 'success',
            duration: 5 * 1000,
          });
        })
        .catch(error => {
          console.log(error);
          this.loading = false;
        })
        .finally(() => {
          this.loading = false;
        });
    },
    onSubmitAsesor() {
      this.loading = true;
      const uploadData = new FormData();
      uploadData.append('role', this.roles[0]);
      uploadData.append('id_ia_02', this.$route.params.id_ia_02);
      uploadData.append('id_uji_komp', this.$route.params.id_uji);
      uploadData.append('user_id', this.userId);

      const rekomendasiAsesor = this.dataTrx.rekomendasi_asesor ? this.dataTrx.rekomendasi_asesor : 'Belum Penilaian';
      uploadData.append('rekomendasi_asesor', rekomendasiAsesor);

      ia02NilaiResource
        .store(uploadData)
        .then(response => {
          this.$message({
            message: 'FR IA 02 has been created successfully.',
            type: 'success',
            duration: 5 * 1000,
          });
        })
        .catch(error => {
          console.log(error);
          this.loading = false;
        })
        .finally(() => {
          this.loading = false;
        });
    },
    back() {
      if (this.active-- < 0) {
        this.active = 2;
      }
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
    objectSpanMethod({ row, column, rowIndex, columnIndex }) {
      if(rowIndex == 0 && columnIndex == 1) {return {rowspan: 1, colspan: 2 }}
      if (columnIndex === 0) {
        if (rowIndex == 1) {
          return {
            rowspan: 2,
            colspan: 1,
          };
        } else {
          return {
            rowspan: 0,
            colspan: 0,
          };
        }
      }
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
