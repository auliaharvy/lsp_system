<template>
  <el-container class="app-container">
    <el-header>
      <el-page-header content="FR.MAPA.02 PETA INSTRUMEN ASESSMEN HASIL PENDEKATAN ASESMEN DAN PERENCANAAN ASESMEN" @back="$router.back()" />
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
          :span-method="objectSpanMethod1"
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
        <!-- tambahan 07-05-2023 -->
        <el-table
          v-loading="loading"
          :data="listMuk"
          :span-method="objectSpanMethod2"
          border
          fit
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="center" min-width="10px" label="No">
            <template slot-scope="scope">
              <span>{{ getScopeRowIndex(scope.row.index)  }}</span>
            </template>
          </el-table-column>
          <el-table-column align="left" min-width="150px" :label="getTitleMuk()">
            <template slot-scope="scope">
              <span>{{ scope.row.muk }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" min-width="10px" label="Potensi Asesi *)">
            <el-table-column align="center" min-width="15px" label="1">
              <template slot-scope="scope">
                <el-checkbox v-model="scope.row.potensi_asesi_1" />
              </template>
            </el-table-column>
            <el-table-column align="center" min-width="15px" label="2">
              <template slot-scope="scope">
                <el-checkbox v-model="scope.row.potensi_asesi_2" />
              </template>
            </el-table-column>
            <el-table-column align="center" min-width="15px" label="3">
              <template slot-scope="scope">
                <el-checkbox v-model="scope.row.potensi_asesi_3" />
              </template>
            </el-table-column>
            <el-table-column align="center" min-width="15px" label="4">
              <template slot-scope="scope">
                <el-checkbox v-model="scope.row.potensi_asesi_4" />
              </template>
            </el-table-column>
            <el-table-column align="center" min-width="15px" label="5">
              <template slot-scope="scope">
                <el-checkbox v-model="scope.row.potensi_asesi_5" />
              </template>
            </el-table-column>
          </el-table-column>
        </el-table>
      </div>
      <br>
      <el-table
        v-loading
        :data="['-']" fit
        border highlight-current-row style="width: 100%" :header-cell-style="{'text-align':'left', 'background':'#324157', 'color':'white'}"
      >
        <el-table-column align="left" label="*) Keterangan">
          <ol>
            <li v-for="item in keterangan" :key="item">
              {{ item }}
            </li>
          </ol>
        </el-table-column>
      </el-table>
      <br>
      <el-button v-if="!$route.params.id_mapa_02" @click="onSubmit">Submit</el-button>
      <!-- <el-button @click="onSubmit">Submit</el-button> -->
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
const ujiMapa02Resource = new Resource('uji-komp-mapa-02');
const mukMapa02Resource = new Resource('mapa2');
const mapa2Resource = new Resource('trx-mapa-02');

export default {
  components: {},
  data() {
    return {
      loading: false,
      listSkema: null,
      listTuk: null,
      listJadwal: null,
      listKodeUnit: [],
      listMuk: [],
      listKuk: [],
      listUji: [],
      selectedSkema: {},
      selectedUji: {},
      dataTrx: {},
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
          title: 'Nomor Skema',
          content: 'TUK BDP',
        },
      ],
      keterangan: [
        'Hasil pelatihan dan / atau pendidikan, dimana Kurikulum dan fasilitas praktek mampu telusur terhadap standar kompetensi.',
        'Hasil pelatihan dan / atau pendidikan, dimana kurikulum belum berbasis kompetensi.',
        'Pekerja berpengalaman, dimana berasal dari industri/tempat kerja yang dalam operasionalnya mampu telusur dengan standar kompetensi.',
        'Pekerja berpengalaman, dimana berasal dari industri/tempat kerja yang dalam operasionalnya belum berbasis kompetensi.',
        'Pelatihan / belajar mandiri atau otodidak.',
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
    // listMuk() {
    //   this.$forceUpdate
    // }
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
    this.getMuk();
  },
  methods: {
    getScopeRowIndex(index) {
      return this.listMuk[0]['versi'] == 2 ? (index > 5 ? (index - 1) : index) : index
    },
    getTitleMuk(){
      return this.listMuk[0]['versi'] == 2 ? 'INSTRUMEN ASESMEN' : 'MUK'
    },
    allKompeten() {
      for (var i = 0; i < this.listKuk.length; i++) {
        var kuk = this.kukList[i];
        if (kuk.type === 'kuk'){
          // kuk.is_kompeten = this.kompeten;
        }
      }
    },
    async getListSkema() {
      const { data } = await skemaResource.list();
      this.listSkema = data;
    },
    async getMuk() {
      if (this.$route.params.id_mapa_02 !== null) {
        this.loading = true;
        const { data } = await mapa2Resource.get(this.$route.params.id_uji);
        this.listMuk = data;
        this.listMuk.forEach((element, index) => {
          element['index'] = index + 1;
          element['potensi_asesi_1'] = element['potensi_asesi_1'] === 1;
          element['potensi_asesi_2'] = element['potensi_asesi_2'] === 1;
          element['potensi_asesi_3'] = element['potensi_asesi_3'] === 1;
          element['potensi_asesi_4'] = element['potensi_asesi_4'] === 1;
          element['potensi_asesi_5'] = element['potensi_asesi_5'] === 1;
        });
        this.loading = false;
      } else {
        this.loading = true;
        const { data } = await mukMapa02Resource.list({versi: 2});
        // console.log(data);
        this.listMuk = data;
        this.listMuk.forEach((element, index) => {
          element['index'] = index + 1;
          element['submit_by'] = this.userId;
          element['updated_by'] = this.userId;
          element['id_uji_komp'] = this.$route.params.id_uji;
        });
        this.loading = false;
      }
    },
    async getListUji() {
      const { data } = await ujiKomResource.list({idujikomp: this.$route.params.iduji});
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
      // this.headerTable[0].content = ujiDetail.skema_sertifikasi;
      // this.headerTable[1].content = ujiDetail.kode_skema;
      // var id_uji = this.$route.params.id_uji;
      var id_apl_01 = this.$route.params.id_apl_01;
      this.listUji = await ujiKomResource.list({ idapl01: id_apl_01 });
      console.log(this.listUji);
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      // var ujiDetail = this.listUji.find((x) => x.id === id_uji);
      // this.selectedUji = ujiDetail;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.headerTable[0].content = this.listUji.data[0].skema_sertifikasi;
      this.headerTable[1].content = this.listUji.data[0].kode_skema;
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
    onSubmit() {
      var dataKirim = {
        'listMuk': this.listMuk,
      };
      // console.log('listMuk');
      this.loading = true;
      ujiMapa02Resource
        .store(dataKirim)
        .then(response => {
          this.$message({
            message: 'FR Mapa 2 has been created successfully.',
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
    objectSpanMethod1({ row, column, rowIndex, columnIndex }) {
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
    objectSpanMethod2({ row, column, rowIndex, columnIndex }) {
      if (columnIndex === 0) {
        if (rowIndex === 4) {
          return {
            rowspan: 2,
            colspan: 1,
          };
        } else if (rowIndex === 5) {
          return {
            rowspan: 0,
            colspan: 0,
          };
        } else {
          return {
            rowspan: 1,
            colspan: 1,
          };
        }
      }
      return {
        rowspan: 1,
        colspan: 1,
      };
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
