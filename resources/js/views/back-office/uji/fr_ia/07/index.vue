<template>
  <el-container class="app-container">
    <el-header>
      <!-- TODO buat penyesuaian halaman dengan form -->
      <el-page-header content="FR.IA.07 PERTANYAAN LISAN" @back="$router.back()" />
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
          :data="listSoal"
          border
          fit
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="center" min-width="20px" label="No">
            <template slot-scope="scope">
              <span>{{ scope.row.index }}</span>
            </template>
          </el-table-column>
          <el-table-column align="left" min-width="150px" label="Unit Kompetensi">
            <template slot-scope="scope">
              <span>{{ scope.row.kode_unit }}</span>
              <br>
              <span>{{ scope.row.unit_kompetensi }}</span>
            </template>
          </el-table-column>
          <el-table-column align="left" min-width="150px" label="Pertanyaan">
            <template slot-scope="scope">
              <span>{{ scope.row.pertanyaan }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" min-width="100px" label="Jawaban">
            <template slot-scope="scope">
              <el-input v-model="scope.row.jawaban" type="textarea" />
            </template>
          </el-table-column>
          <el-table-column v-if="roles[0] !== 'user'" align="center" min-width="80px" label="Rekomendasi">
            <template slot-scope="scope">
              <el-select v-model="scope.row.is_kompeten" class="filter-item" placeholder="B/BK">
                <el-option key="kompeten" label="Kompeten" value="kompeten" />
                <el-option key="belum kompeten" label="Belum Kompeten" value="belum kompeten" />
              </el-select>
            </template>
          </el-table-column>
        </el-table>
        <br>
        <br>
        <el-form
          ref="form"
          :model="form"
          label-width="250px"
          label-position="left"
        >
          <el-form-item v-if="roles[0] !== 'user'" label="Rekomendasi Assesor" prop="rekomendasi_asesor">
            <el-radio v-model="form.rekomendasi_asesor" label="Kompeten" border>Kompeten</el-radio>
            <el-radio v-model="form.rekomendasi_asesor" label="Belum Kompeten" border>Belum Kompeten</el-radio>
          </el-form-item>
          <el-form-item v-if="roles[0] !== 'user'" label="Umpan balik untuk asesi" prop="feedback">
            <el-input v-model="form.umpanBalikAsesi" type="textarea" :rows="3" placeholder="Isi umpan balik untuk asesi" label="Umpan Balik Untuk Ases" />
          </el-form-item>
        </el-form>
        <br>

        <el-button v-if="!$route.params.id_ia_07" @click="onSubmit">Submit</el-button>
        <el-button v-if="$route.params.id_ia_07 && roles[0] !== 'user'" @click="nilai">Submit Asesor</el-button>
      </div>
    </el-main>
  </el-container>
</template>

<script>
import { mapGetters } from 'vuex';
import Resource from '@/api/resource';
import role from '@/directive/role';
import checkRole from '@/utils/role';
const jadwalResource = new Resource('jadwal-get');
const skemaResource = new Resource('skema-get');
const tukResource = new Resource('tuk-get');
const ujiKomResource = new Resource('uji-komp-get');
const mstResource = new Resource('mst-ia07-get');
const postResource = new Resource('uji-komp-ia-07');
const ia07Detail = new Resource('detail/ia-07');
const ia07NilaiResource = new Resource('uji-komp-ia-07-nilai');

export default {
  components: {},
  directives: { role },
  data() {
    return {
      umpanBalikAsesi: '',
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
      ia07: null,
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
    // });
    this.getUjiKompDetail();
    this.getListPertanyaan().then((value) => {
      this.getIa07();
    });
    this.getDate();
    this.getIa07();
  },
  methods: {
    checkRole,
    getDate() {
      var arrbulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      var arrHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
      var date = new Date();
      // var millisecond = date.getMilliseconds();
      // var detik = date.getSeconds();
      var menit = date.getMinutes();
      var jam = date.getHours();
      var hari = date.getDay();
      var tanggal = date.getDate();
      var bulan = date.getMonth();
      var tahun = date.getFullYear();
      this.dataTrx.jam = jam;
      this.dataTrx.menit = menit;
      this.dataTrx.tanggal = tanggal;
      this.dataTrx.bulan = arrbulan[bulan];
      this.dataTrx.tahun = tahun;
      this.dataTrx.hari = arrHari[hari];
      this.headerTable[4].content = arrHari[hari] + ', ' + tanggal + '-' + arrbulan[bulan] + '-' + tahun;
      // document.write(tanggal+"-"+arrbulan[bulan]+"-"+tahun+"<br/>"+jam+" : "+menit+" : "+detik+"."+millisecond);
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
      const { data } = await mstResource.list({ id_skema: this.$route.params.id_skema });
      this.listSoal = data;
      // console.log(this.listSoal);
      console.log(this.listKuk);
      this.listSoal.forEach((element, index) => {
        element['index'] = index + 1;
      });
      const dataia07 = await ia07Detail.get(this.$route.params.id_ia_07);
      this.ia07 = dataia07;
      this.loading = false;
    },
    getIa07() {
      // console.log(this.$route.params.id_ia_07);
      if (this.$route.params.id_ia_07 !== null) {
        this.loading = true;
        // console.log(this.ia07);
        this.listSoal.forEach((element, index) => {
          var foundIndex = this.ia07.detail.findIndex(x => x.id_perangkat_ia_07 === element['id']);
          element['jawaban'] = this.ia07.detail[foundIndex].jawaban;
          element['id'] = this.ia07.detail[foundIndex].id;

          // if (this.ia07.detail[foundIndex]){
          //   element['jawaban'] = this.ia07.detail[foundIndex].jawaban;
          //   element['id'] = this.ia07.detail[foundIndex].id;
          // } else {
          //   element['jawaban'];
          //   element['id'];
          // }
        });
        this.loading = false;
      }
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
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      // this.headerTable[0].content = ujiDetail.skema_sertifikasi;
      // this.headerTable[1].content = ujiDetail.nama_tuk;
      // this.headerTable[2].content = ujiDetail.asesor;
      // this.headerTable[3].content = ujiDetail.nama_peserta;
      // this.dataTrx.nama_asesor = ujiDetail.asesor;
      // this.dataTrx.nama_asesi = ujiDetail.nama_peserta;
      // var id_uji = this.$route.params.id_uji;
      var id_apl_01 = this.$route.params.id_apl_01;
      this.listUji = await ujiKomResource.list({ idapl01: id_apl_01 });
      console.log(this.listUji);
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      // var ujiDetail = this.listUji.find((x) => x.id === id_uji);
      // this.selectedUji = ujiDetail;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
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
      // console.log(this.listKodeUnit);
      // var elemen = unitKomp.elemen;
      // var kuk = elemen.kuk;
      this.listKuk = kuk;
    },
    onSubmit() {
      this.loading = true;
      this.form.detail_ia_07 = this.listSoal;
      this.form.user_id = this.userId;
      this.form.id_uji_komp = this.$route.params.id_uji;
      this.form.id_skema = this.$route.params.id_skema;
      this.form.rekomendasi_asesor = this.form.rekomendasi_asesor ? this.form.rekomendasi_asesor : 'belum penilaian';
      this.form.umpanBalikAsesi = this.form.umpanBalikAsesi ? this.form.umpanBalikAsesi : 'belum penilaian';

      postResource
        .store(this.form)
        .then(response => {
          // console.log(response);
          this.$message({
            message: 'FR IA 07 has been created successfully.',
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
    nilai() {
      this.loading = true;
      this.form.detail_ia_07 = this.listSoal;
      this.form.user_id = this.userId;
      this.form.id_uji_komp = this.$route.params.id_uji;
      this.form.id_ia_07 = this.$route.params.id_ia_07;
      this.form.id_skema = this.$route.params.id_skema;
      this.form.rekomendasi_asesor = this.form.rekomendasi_asesor ? this.form.rekomendasi_asesor : 'belum penilaian';
      this.form.umpanBalikAsesi = this.form.umpanBalikAsesi ? this.form.umpanBalikAsesi : 'belum penilaian';

      // console.log(this.form);

      ia07NilaiResource
        .store(this.form)
        .then(response => {
          this.$message({
            message: 'FR IA 07 has been created successfully.',
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
