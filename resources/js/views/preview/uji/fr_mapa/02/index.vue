<template>
  <el-container v-if="$route.params.mapa02 == null" class="app-container">
    <el-header>
      <el-page-header content="FORM FR.MAPA.02 BELUM DIISI" @back="$router.back()" />
    </el-header>
    <el-button-group>
      <router-link :to="{name: 'preview-apl-02', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02 }}"><el-button type="primary" icon="el-icon-arrow-left">Previous Page</el-button></router-link>
      <router-link :to="{name: 'preview-ak-01', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ak01: dataPreview.id_ak_01 }}"><el-button type="primary" icon="el-icon-arrow-right">Next Page</el-button></router-link>
    </el-button-group>
  </el-container>
  <el-container v-else class="app-container">
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
        <!-- tambahan 07-05-2023 -->
        <el-table
          v-loading="loading"
          :data="listMuk"
          border
          fit
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="center" min-width="10px" label="No">
            <template slot-scope="scope">
              <span>{{ scope.row.index }}</span>
            </template>
          </el-table-column>
          <el-table-column align="left" min-width="150px" label="MUK">
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
      <el-button-group>
        <router-link :to="{name: 'preview-apl-02', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02 }}"><el-button type="primary" icon="el-icon-arrow-left">Previous Page</el-button></router-link>
        <router-link :to="{name: 'preview-ak-01', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ak01: dataPreview.id_ak_01 }}"><el-button type="primary" icon="el-icon-arrow-right">Next Page</el-button></router-link>
      </el-button-group>
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
const mapa2Resource = new Resource('mapa2');
const previewResource = new Resource('detail/preview');

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
      dataPreview: '',
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
    this.getDataPreview();
    this.getListSkema().then((value) => {
      this.onJadwalSelect();
    });
    this.getListUji().then((value) => {
      this.getUjiKompDetail();
    });
    this.getMuk();
  },
  methods: {
    async getDataPreview(){
      this.dataPreview = await previewResource.get(this.$route.params.iduji);
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
      const { data } = await mapa2Resource.list();
      this.listMuk = data;
      this.listMuk.forEach((element, index) => {
        element['index'] = index + 1;
      });
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
      this.headerTable[1].content = ujiDetail.kode_skema;
      // this.headerTable[2].content = ujiDetail.nama_asesor;
      // this.headerTable[3].content = ujiDetail.nama_peserta;
      // this.headerTable[4].content = ujiDetail.mulai;
    },
    onJadwalSelect() {
      var id_skema = this.$route.params.idskema;
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
      this.form.user_id = this.userId;
      this.form.id_uji_komp = this.$route.params.id_uji;
      this.form.id_skema = this.$route.params.idskema;
      ia02Resource
        .store(this.form)
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
