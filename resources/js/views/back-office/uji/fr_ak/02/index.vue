<template>
  <el-container class="app-container">
    <el-header>
      <el-page-header content="FR.AK.02 FORMULIR REKAMAN ASESMEN KOMPETENSI" @back="$router.back()" />
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
          :data="listJudulUnit"
          border
          fit
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="left" min-width="80px" label="Unit Kompetensi">
            <template slot-scope="scope">
              <span>{{ scope.row.unit_kompetensi }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" min-width="30px" label="Observasi Demonstrasi">
            <template slot-scope="scope">
              <el-checkbox v-model="scope.row.observasi_demonstrasi" />
            </template>
          </el-table-column>
          <el-table-column align="center" min-width="30px" label="Portofolio">
            <template slot-scope="scope">
              <el-checkbox v-model="scope.row.portofolio" />
            </template>
          </el-table-column>
          <el-table-column align="center" min-width="30px" label="Pernyataan Pihak Ketiga Pertanyaan Wawancara">
            <template slot-scope="scope">
              <el-checkbox v-model="scope.row.pernyataan_pihak_3" />
            </template>
          </el-table-column>
          <el-table-column align="center" min-width="30px" label="Pernyataan Lisan">
            <template slot-scope="scope">
              <el-checkbox v-model="scope.row.pernyataan_lisan" />
            </template>
          </el-table-column>
          <el-table-column align="center" min-width="30px" label="Pernyataan Tertulis">
            <template slot-scope="scope">
              <el-checkbox v-model="scope.row.pernyataan_tertulis" />
            </template>
          </el-table-column>
          <el-table-column align="center" min-width="30px" label="Proyek Kerja">
            <template slot-scope="scope">
              <el-checkbox v-model="scope.row.proyek_kerja" />
            </template>
          </el-table-column>
          <el-table-column align="center" min-width="30px" label="Lainnya">
            <template slot-scope="scope">
              <el-checkbox v-model="scope.row.lainnya" />
            </template>
          </el-table-column>
        </el-table>
        <br>
        <el-form
          ref="form"
          :model="dataSend"
          label-width="250px"
          label-position="left"
        >
          <el-form-item label="Rekomendasi Assesor" prop="rekomendasi_asesor">
            <el-radio v-model="dataSend.status" label="Kompeten">Kompeten</el-radio>
            <el-radio v-model="dataSend.status" label="Belum Kompeten">Belum Kompeten</el-radio>
          </el-form-item>
          <el-form-item label="Tindak Lanjut Yang di butuhkan" prop="rekomendasi_asesor">
            <el-input v-model="dataSend.tindakLanjut" type="textarea" :rows="3" placeholder="Isi Tindak lanjut" />
          </el-form-item>
          <el-form-item label="Komentar Observasi Oleh Asesor" prop="rekomendasi_asesor">
            <el-input v-model="dataSend.komentar" type="textarea" :rows="2" placeholder="Isi Komentar" />
          </el-form-item>
        </el-form>
        <br>

        <!-- <el-button @click="onSubmit">Submit</el-button> -->
        <el-button v-if="$route.params.id_ak_02 !== null" @click="generateReport">Print</el-button>
        <el-button v-else @click="onSubmit">Submit</el-button>

      </div>
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
const mstIa03Resource = new Resource('mst-ia03-get');
const ak02Resource = new Resource('uji-komp-ak-02');

export default {
  components: {},
  data() {
    return {
      dataSend: {},
      dataCheckbox: [],
      umpanBalikAsesi: '',
      checkList: [],
      kompeten: null,
      loading: false,
      listSoal: null,
      listSkema: null,
      listTuk: null,
      listJadwal: null,
      listKodeUnit: [],
      listJudulUnit: [],
      listKuk: [],
      listUji: [],
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
          title: 'Nama Asesi',
          content: '',
        },
        {
          title: 'Nama Asesor',
          content: '',
        },
        {
          title: 'Skema Sertifikasi',
          content: '',
        },
        {
          title: 'Tanggal Mulai Asesmen',
          content: '-',
        },
        {
          title: 'Tanggal Selesai Asesmen',
          content: '-',
        },
      ],
      panduan: [
        'Lengkapi nama unit kompetensi, elemen, kriteria unjuk kerja sesuai kolom dalam tabel.',
        'Istilah Acuan Pembanding dengan SOP / spesifikasi produk dari industri / orginasi dari tempat kerja atau simulasi tempat kerja',
        'Beri tanda centang pada kolom K jika Anda yakin asesi dapat melakukan/mendemonstrasikan tugas seuai KUK, atau centang pada kolom BK bila sebaliknya.',
        'Penilaian lanjut diisi bila hasil belum dapat disimpulkan, untuk itu gunakan metode lain sehingga keputusan dapat dibuat',
      ],
      form: {
        name: '',
        region: '',
        date1: '',
        date2: '',
        delivery: false,
        type: [],
        resource: '',
        desc: '',
      },
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
    // this.getListSkema().then((value) => {
    this.onJadwalSelect();
    // });
    // this.getListUji().then((value) => {
    this.getUjiKompDetail();
    // });
    this.getListPertanyaan();
  },
  methods: {
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
      const { data } = await mstIa03Resource.list({ id_skema: this.$route.params.id_skema });
      this.listSoal = data;
      // this.listSoal.forEach((element, index) => {
      //   element['index'] = index + 1;
      //   element['observasi_demonstrasi'] = true;
      //   element['portofolio'] = true;
      //   element['pernyataan_pihak_3'] = true;
      //   element['pernyataan_lisan'] = true;
      //   element['pernyataan_tertulis'] = true;
      //   element['proyek_kerja'] = true;
      //   element['lainnya'] = true;
      // });
      this.loading = false;
    },
    async getListSkema() {
      const { data } = await skemaResource.list();
      this.listSkema = data;
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
    async getUjiKompDetail() {
      // var id_uji = this.$route.params.id_uji;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      // var ujiDetail = this.listUji.find((x) => x.id === id_uji);
      // this.selectedUji = ujiDetail;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      // this.headerTable[2].content = ujiDetail.skema_sertifikasi;
      // this.headerTable[1].content = ujiDetail.asesor;
      // this.headerTable[0].content = ujiDetail.nama_peserta;
      // this.headerTable[3].content = ujiDetail.mulai;
      // this.headerTable[4].content = ujiDetail.selesai;

      var id_apl_01 = this.$route.params.id_apl_01;
      console.log(this.$route.params.id_apl_01);
      this.listUji = await ujiKomResource.list({ idapl01: id_apl_01 });
      console.log(this.listUji);
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      // var ujiDetail = this.listUji.find((x) => x.id === id_uji);
      // this.selectedUji = ujiDetail;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.headerTable[0].content = this.listUji.data[0].nama_peserta;
      this.headerTable[1].content = this.listUji.data[0].asesor;
      this.headerTable[2].content = this.listUji.data[0].skema_sertifikasi;
      this.headerTable[3].content = this.listUji.data[0].mulai;
      this.headerTable[4].content = this.listUji.data[0].selesai;
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
      console.log(skemaId);
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
        // console.log(element);
        element['type'] = 'unitKomp';
        element['index'] = number++;
        kuk.push(element);
        this.unitKompetensiTable[0].col3.push(element['kode_unit']);
        this.unitKompetensiTable[1].col3.push(element['unit_kompetensi']);
        this.listJudulUnit.push(element);
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
      // console.log(this.listJudulUnit);
      // var elemen = unitKomp.elemen;
      // var kuk = elemen.kuk;
      this.listKuk = kuk;
    },
    onSubmit() {
      this.loading = true;
      this.dataTrx.id_uji_komp = this.$route.params.id_uji;
      this.dataTrx.komentar = this.dataSend.komentar;
      this.dataTrx.tindak_lanjut = this.dataSend.tindakLanjut;
      this.dataTrx.rekomendasi_asesor = this.dataSend.status;
      this.dataTrx.nama_asesi = this.headerTable[0].content;
      this.dataTrx.nama_asesor = this.headerTable[1].content;
      // this.dataTrx.detail = this.listSoal;

      this.listJudulUnit.forEach((element, index) => {
        element['index'] = index + 1;
        element['id'];
        element['observasi_demonstrasi'] = element['observasi_demonstrasi'] ? 1 : 0;
        element['portofolio'] = element['portofolio'] ? 1 : 0;
        element['pernyataan_pihak_3'] = element['pernyataan_pihak_3'] ? 1 : 0;
        element['pernyataan_lisan'] = element['pernyataan_lisan'] ? 1 : 0;
        element['pernyataan_tertulis'] = element['pernyataan_tertulis'] ? 1 : 0;
        element['proyek_kerja'] = element['proyek_kerja'] ? 1 : 0;
        element['lainnya'] = element['lainnya'] ? 1 : 0;
      });

      this.dataTrx.detail = this.listJudulUnit;
      this.dataTrx.userId = this.userId;
      ak02Resource
        .store(this.dataTrx)
        .then(response => {
          this.$message({
            message: 'FR AK 02 has been created successfully.',
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
