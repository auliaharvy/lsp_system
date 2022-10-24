<template>
  <el-container class="app-container">
    <el-header>
      <el-page-header content="FR.IA.01 CEKLIS OBSERVASI AKTIVITAS DI TEMPAT KERJA ATAU TEMPAT KERJA SIMULASI" @back="$router.back()" />
    </el-header>
    <el-main>
      <div>
        <el-table
          v-loading="loading"
          :data="headerTable"
          fit
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center' }"
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
          :data="['-']"
          fit
          border
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'left', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="left" label="PANDUAN BAGI ASESOR">
            <ul>
              <li v-for="item in panduan" :key="item">
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

          <el-table-column
            align="center"
            label="Benchmark (SOP / Spesifikasi Produk Industri)"
            min-width="200px"
          >
            <template slot-scope="scope">
              <span><b>{{ scope.row.benchmark }}</b></span>
            </template>
          </el-table-column>

          <el-table-column
            align="center"
            label="K / BK"
            min-width="80px"
          >
            <template slot="header">
              <span>K / BK</span>
              <el-select v-model="kompeten" class="filter-item" placeholder="B/BK">
                <el-option :key="0" label="Kompeten" :value="0" />
                <el-option :key="1" label="Belum Kompeten" :value="1" />
              </el-select>
            </template>
            <template slot-scope="scope">
              <el-select v-if="scope.row.type === 'kuk'" v-model="scope.row.is_kompeten" class="filter-item" placeholder="B/BK">
                <el-option :key="0" label="Kompeten" :value="0" />
                <el-option :key="1" label="Belum Kompeten" :value="1" />
              </el-select>
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
          <el-form-item label="Apakah Asesi Kompeten?" prop="kompeten">
            <el-select v-model="form.status" class="filter-item" placeholder="B/BK">
              <el-option :key="0" label="Kompeten" :value="0" />
              <el-option :key="1" label="Belum Kompeten" :value="1" />
            </el-select>
          </el-form-item>
          <el-form-item label="Umpan Balik untuk Asesi" prop="umpanBalik">
            <el-input v-model="form.note" placeholder="Isi umpan balik untuk asesi" />
          </el-form-item>

        </el-form>

        <br>

        <el-button @click="onSubmit">Submit</el-button>
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
const ia01Resource = new Resource('uji-komp-ia-01');

export default {
  components: {},
  data() {
    return {
      kompeten: null,
      loading: false,
      listSkema: null,
      listTuk: null,
      listJadwal: null,
      listKuk: [],
      listUji: [],
      selectedSkema: {},
      selectedUji: {},
      dataTrx: {},
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
    this.getListUji().then((value) => {
      this.getUjiKompDetail();
    });
  },
  methods: {
    allKompeten() {
      for (var i = 0; i < this.listKuk.length; i++) {
        var kuk = this.kukList[i];
        if (kuk.type === 'kuk'){
          kuk.is_kompeten = this.kompeten;
        }
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
    getUjiKompDetail() {
      var id_uji = this.$route.params.id_uji;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      var ujiDetail = this.listUji.find((x) => x.id === id_uji);
      this.selectedUji = ujiDetail;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.headerTable[0].content = ujiDetail.skema_sertifikasi;
      this.headerTable[1].content = ujiDetail.nama_tuk;
      this.headerTable[2].content = ujiDetail.nama_asesor;
      this.headerTable[3].content = ujiDetail.nama_peserta;
      this.headerTable[4].content = ujiDetail.mulai;
    },
    onJadwalSelect() {
      var id_skema = this.$route.params.id_skema;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      console.log(this.listSkema);
      var skemaId = this.listSkema.find((x) => x.id === id_skema);
      this.selectedSkema = skemaId;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.dataTrx.id_skema = skemaId.id;
      // this.dataTrx.id_tuk = tukId.id;
      console.log(this.selectedSkema);
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
      this.form.detail_ia_01 = this.listKuk;
      this.form.user_id = this.userId;
      this.form.id_uji_komp = this.$route.params.id_uji;
      this.form.id_skema = this.$route.params.id_skema;
      ia01Resource
        .store(this.form)
        .then(response => {
          this.$message({
            message: 'FR IA 01 has been created successfully.',
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
