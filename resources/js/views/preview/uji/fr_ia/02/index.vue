<template>
  <el-container v-if="$route.params.ia02 == null" class="app-container">
    <el-header>
      <el-page-header content="FORM FR.IA.02 BELUM DIISI" @back="$router.back()" />
    </el-header>
    <el-button-group>
      <router-link :to="{name: 'preview-ia-01', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ia01: dataPreview.id_ia_01 }}"><el-button type="primary" icon="el-icon-arrow-left">Previous Page</el-button></router-link>
      <router-link :to="{name: 'preview-ia-03', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ia03: dataPreview.id_ia_03 }}"><el-button type="primary" icon="el-icon-arrow-right">Next Page</el-button></router-link>
    </el-button-group>
  </el-container>
  <el-container v-else class="app-container">
    <el-header>
      <el-page-header content="FR.IA.02 TUGAS PRAKTIK DEMONSTRASI" @back="$router.back()" />
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
          <el-table-column align="left" min-width="30px">
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
          <el-table-column align="left" width="150px">
            <template slot-scope="scope">
              <span>{{ scope.row.col1 }}</span>
            </template>
          </el-table-column>
          <el-table-column align="left" width="120px">
            <template slot-scope="scope">
              <span>{{ scope.row.col2 }}</span>
            </template>
          </el-table-column>
          <el-table-column align="left">
            <template slot-scope="scope">
              <ul>
                <li v-for="item in scope.row.col3" :key="item">
                  {{ item }}
                </li>
              </ul>
            </template>
          </el-table-column>
        </el-table>

        <br>
        <br>
        <a target="_blank" :href="'/' + dataSoal">
          <el-button type="primary">
            Klik untuk melihat soal
          </el-button>
        </a>
        <br>
        <br>
        <a v-if="dataPreview.id_ia_02" target="_blank" :href="'/' + detail.file">
          <el-button type="primary">
            Klik untuk melihat jawaban
          </el-button>
        </a>
        <br>
        <br>
        <el-form
          ref="form"
          :model="dataTrx"
          label-width="250px"
          label-position="left"
        >
          <el-form-item v-if="!dataPreview.id_ia_02" label="Upload File Jawaban" prop="file">
            <input type="file" @change="handleUploadSuccess">
          </el-form-item>
          <el-form-item v-if="role !== 'user'" label="Rekomendasi Assesor" prop="rekomendasi_asesor">
            <span>{{ dataTrx.rekomendasi_asesor }}</span>
            <!-- <el-radio v-model="dataTrx.rekomendasi_asesor" label="Kompeten" border>Kompeten</el-radio>
            <el-radio v-model="dataTrx.rekomendasi_asesor" label="Belum Kompeten" border>Belum Kompeten</el-radio> -->
          </el-form-item>
        </el-form>
        <el-button-group>
          <router-link :to="{name: 'preview-ia-01', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ia01: dataPreview.id_ia_01 }}"><el-button type="primary" icon="el-icon-arrow-left">Previous Page</el-button></router-link>
          <router-link :to="{name: 'preview-ia-03', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ia03: dataPreview.id_ia_03 }}"><el-button type="primary" icon="el-icon-arrow-right">Next Page</el-button></router-link>
        </el-button-group>
      </div>
      <br>

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
const ia02NilaiResource = new Resource('uji-komp-ia-02-nilai');
const mstIa02Resource = new Resource('mst-ia02-get');
const ia02Detail = new Resource('detail/ia-02');
const previewResource = new Resource('detail/preview');

export default {
  components: {},
  data() {
    return {
      radio1: 'Kompeten',
      role: null,
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
      unitKompetensiTable: [
        {
          col1: 'Unit Kompetensi',
          col2: 'Kode Unit',
          col3: [],
        },
        {
          col1: 'Unit Kompetensi',
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
    this.getDataPreview();
    this.getListSkema().then((value) => {
      this.onJadwalSelect();
    });
    this.getListUji().then((value) => {
      this.getUjiKompDetail();
      this.getListPertanyaan();
      this.getIa02();
    });
  },
  methods: {
    async getDataPreview(){
      this.dataPreview = await previewResource.get(this.$route.params.iduji);
    },
    async getIa02() {
      this.role = this.roles[0];
      this.dataPreview = await previewResource.get(this.$route.params.iduji);
      console.log('id ia 02 : ' + this.dataPreview.id_ia_02);
      if (this.$route.params.ia02 !== null) {
        this.loading = true;
        const data = await ia02Detail.get(this.$route.params.ia02);
        this.detail = data;
        this.dataTrx.rekomendasi_asesor = data.rekomendasi_asesor;
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
    async getListPertanyaan() {
      this.loading = true;
      this.dataPreview = await previewResource.get(this.$route.params.iduji);
      const { data } = await mstIa02Resource.list({ id_skema: this.dataPreview.id_skema });
      this.listSoal = data;
      this.dataSoal = data[0].file;
      this.listSoal.forEach((element, index) => {
        element['index'] = index + 1;
      });
      console.log(this.listSoal);
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
    async getListUji() {
      const { data } = await ujiKomResource.list();
      this.listUji = data;
    },
    async getListTuk() {
      const { data } = await tukResource.list();
      this.listTuk = data;
    },
    async getListJadwal() {
      const { data } = await jadwalResource.list();
      this.listJadwal = data;
    },
    getUjiKompDetail() {
      var id_uji = this.$route.params.iduji;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      var ujiDetail = this.listUji.find((x) => x.id === id_uji);
      this.selectedUji = ujiDetail;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.headerTable[0].content = ujiDetail.skema_sertifikasi;
      this.headerTable[1].content = ujiDetail.nama_tuk;
      this.headerTable[2].content = ujiDetail.asesor;
      this.headerTable[3].content = ujiDetail.nama_peserta;
      this.headerTable[4].content = ujiDetail.mulai;
    },
    onJadwalSelect() {
      var id_skema = this.dataPreview.id_skema;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      var skemaId = this.listSkema.find((x) => x.id === id_skema);
      this.selectedSkema = skemaId;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.dataTrx.id_skema = skemaId.id;
      // this.dataTrx.id_tuk = tukId.id;
      this.getKuk();
    },
    getKuk(){
      var number = 1;
      var unitKomp = this.selectedSkema.children;
      console.log(unitKomp);
      var kuk = [];
      unitKomp.forEach((element, index) => {
        element['type'] = 'unitKomp';
        element['index'] = number++;
        kuk.push(element);
        this.unitKompetensiTable[0].col3.push(element['kode_unit']);
        this.unitKompetensiTable[1].col3.push(element['unit_kompetensi']);
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
      console.log(this.listKodeUnit);
      // var elemen = unitKomp.elemen;
      // var kuk = elemen.kuk;
      this.listKuk = kuk;
    },
    onSubmit() {
      this.loading = true;
      const uploadData = new FormData();
      uploadData.append('role', this.roles[0]);
      uploadData.append('id_skema', this.dataPreview.id_skema);
      uploadData.append('id_uji_komp', this.$route.params.iduji);
      uploadData.append('user_id', this.userId);
      uploadData.append('file', this.dataTrx.file);
      uploadData.append('rekomendasi_asesor', this.dataTrx.rekomendasi_asesor);

      ia02Resource
        .store(uploadData)
        .then(response => {
          this.$message({
            message: 'FR IA 02 has been created successfully.',
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
    onSubmitAsesor() {
      this.loading = true;
      const uploadData = new FormData();
      uploadData.append('role', this.roles[0]);
      uploadData.append('id_ia_02', this.dataPreview.id_ia_02);
      uploadData.append('id_uji_komp', this.$route.params.iduji);
      uploadData.append('user_id', this.$route.params.userId);
      uploadData.append('rekomendasi_asesor', this.dataTrx.rekomendasi_asesor);

      ia02NilaiResource
        .store(uploadData)
        .then(response => {
          this.$message({
            message: 'FR IA 02 has been created successfully.',
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
      if (columnIndex === 0) {
        if (rowIndex % 2 === 0) {
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
