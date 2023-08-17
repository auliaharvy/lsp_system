<template>
  <el-container class="app-container">
    <el-header>
      <el-page-header content="FR.AK.06 MENINJAU LAPORAN ASESMEN" @back="$router.back()" />
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
          :data="['-']"
          fit
          border
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'left', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="left" label="Penjelasan">
            <ol>
              <li v-for="item in penjelasan" :key="item">
                {{ item }}
              </li>
            </ol>
          </el-table-column>
        </el-table>

        <br>

        <el-table
          v-loading="loading"
          :data="aspek"
          fit
          border
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="left" label="Aspek Yang Ditinjau">
            <template slot-scope="scope">
              <span>{{ scope.row.item }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Kesesuaian dengan prinsip asesmen">
            <el-table-column align="center" label="Validitas">
              <template slot-scope="scope">
                <el-checkbox v-model="scope.row.validitas" />
              </template>
            </el-table-column>
            <el-table-column align="center" label="Reliabel">
              <template slot-scope="scope">
                <el-checkbox v-model="scope.row.reliabel" />
              </template>
            </el-table-column>
            <el-table-column align="center" label="Fleksibel">
              <template slot-scope="scope">
                <el-checkbox v-if="scope.row.item === '- Umpan Balik Asesmen'" v-model="scope.row.fleksibel" :disabled="true" />
                <el-checkbox v-else-if="scope.row.item === '- Keputusan Asesmen'" v-model="scope.row.fleksibel" :disabled="true" />
                <el-checkbox v-else v-model="scope.row.fleksibel" />

                <!-- <el-checkbox v-model="scope.row.fleksibel" /> -->
              </template>
            </el-table-column>
            <el-table-column align="center" label="Adil">
              <template slot-scope="scope">
                <el-checkbox v-model="scope.row.adil" />
              </template>
            </el-table-column>
          </el-table-column>
        </el-table>
        <el-table
          v-loading="loading"
          :data="rekomendasi"
          fit
          border
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center'}"
        >
          <el-table-column align="left" width="150px">
            <template slot-scope="scope">
              <span>{{ scope.row.item }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center">
            <template slot-scope="scope">
              <el-input v-model="scope.row.rekomendasi" type="textarea" />
            </template>
          </el-table-column>
        </el-table>
        <br>

        <el-table
          v-loading="loading"
          :data="aspekPemenuhan"
          fit
          border
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="left" label="Aspek Yang Ditinjau">
            <template slot-scope="scope">
              <span>{{ scope.row.item }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Pemenuhan Dimensi Kompetensi">
            <el-table-column align="center" label="Task Skills">
              <template slot-scope="scope">
                <el-input v-model="scope.row.taskSkill" type="textarea" />
              </template>
            </el-table-column>
            <el-table-column align="center" label="Task Management Skills">
              <template slot-scope="scope">
                <el-input v-model="scope.row.taskManagementSkill" type="textarea" />
              </template>
            </el-table-column>
            <el-table-column align="center" label="Contingency Management Skills">
              <template slot-scope="scope">
                <el-input v-model="scope.row.contigency" type="textarea" />
              </template>
            </el-table-column>
            <el-table-column align="center" label="Job Role / Environment Skills">
              <template slot-scope="scope">
                <el-input v-model="scope.row.jobRole" type="textarea" />
              </template>
            </el-table-column>
            <el-table-column align="center" label="Transfer Skills">
              <template slot-scope="scope">
                <el-input v-model="scope.row.transferSkill" type="textarea" />
              </template>
            </el-table-column>
          </el-table-column>
        </el-table>
        <el-table
          v-loading="loading"
          :data="rekomendasiPemenuhan"
          fit
          border
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center'}"
        >
          <el-table-column align="left" width="150px">
            <template slot-scope="scope">
              <span>{{ scope.row.item }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center">
            <template slot-scope="scope">
              <el-input v-model="scope.row.rekomendasi" type="textarea" />
            </template>
          </el-table-column>
        </el-table>

        <br>

        <el-table
          v-if="ttdTable"
          v-loading="loading"
          :data="ttdTable"
          fit
          border
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center' }"
        >
          <el-table-column align="center" label="Nama Peninjau">
            <template slot-scope="scope">
              <span>{{ scope.row.nama }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Tanggal">
            <template slot-scope="scope">
              <span>{{ scope.row.tanggal }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Tanda Tangan Peninjau">
            <template slot-scope="scope">
              <div v-if="!$route.params.id_ak_06">
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
                :src="scope.row.ttd"
                fit="contain"
              />
            </template>
          </el-table-column>
          <el-table-column align="center" label="Komentar">
            <template slot-scope="scope">
              <el-input v-model="scope.row.komentar" type="textarea" />
            </template>
          </el-table-column>
        </el-table>
        <br>
        <!-- <el-button v-if="!$route.params.id_ak_06" @click="onSubmit">Submit</el-button> -->
        <el-button v-if="$route.params.id_ak_06 !== null" @click="generateReport">Print</el-button>
        <el-button v-else @click="onSubmit">Submit</el-button>
      </div>
    </el-main>
  </el-container>
</template>

<script>
import { mapGetters } from 'vuex';
import vueSignature from 'vue-signature/src/components/vueSignature.vue';
import Resource from '@/api/resource';
const jadwalResource = new Resource('jadwal-get');
const skemaResource = new Resource('skema-get');
const tukResource = new Resource('tuk-get');
const ujiKomResource = new Resource('uji-komp-get');
const ak06Resource = new Resource('uji-komp-ak-06');
const showAk06Resource = new Resource('ak-06');

export default {
  components: {
    vueSignature,
  },
  data() {
    return {
      option: {
        penColor: 'rgb(0, 0, 0)',
        backgroundColor: 'rgb(255,255,255)',
      },
      umpanBalikAsesi: '',
      checkList: [],
      kompeten: null,
      loading: false,
      listSoal: null,
      listSkema: null,
      listTuk: null,
      listJadwal: null,
      listAspek: [],
      listKodeUnit: [],
      listJudulUnit: [],
      listKuk: [],
      listUji: [],
      selectedSkema: {},
      selectedUji: {},
      dataTrx: [],
      headerTable: [
        {
          title: 'Skema Sertifikasi',
          content: '',
        },
        {
          title: 'TUK',
          content: '',
        },
        {
          title: 'Nama Asesor',
          content: '',
        },

        {
          title: 'Tanggal',
          content: '',
        },
      ],
      penjelasan: [
        'Peninjauan seharusnya dilakukan oleh asesor yang mensupervisi implementasi asesmen.',
        'Jika tinjauan di lakukan oleh asesor lain, tinjauan akan di lakukan setelah seluruh proses implementasi asesmen telah selesai',
        'Peninjauan dapat dilakukan secara terpadu dalam skema sertifikasi dan / atau peserta kelompok yang homogen.',
      ],
      aspek: [
        {
          item: 'Prosedur asesmen :',
          validitas: ' ',
          reliabel: ' ',
          fleksibel: ' ',
          adil: ' ',
        },
        {
          item: '- Rencana Asesmen',
          validitas: false,
          reliabel: false,
          fleksibel: false,
          adil: false,
        },
        {
          item: '- Persiapan Asesmen',
          validitas: false,
          reliabel: false,
          fleksibel: false,
          adil: false,
        },
        {
          item: '- Implementasi Asesmen',
          validitas: false,
          reliabel: false,
          fleksibel: false,
          adil: false,
        },
        {
          item: '- Keputusan Asesmen',
          validitas: false,
          reliabel: false,
          fleksibel: false,
          adil: false,
        },
        {
          item: '- Umpan Balik Asesmen',
          validitas: false,
          reliabel: false,
          fleksibel: false,
          adil: false,
        },
      ],
      aspekPemenuhan: [
        {
          item: 'Konsistensi keputusan asesmen Bukti dari berbagai asesmen diperiksa untuk konsistensi dimensi kompetensi',
          taskSkill: '',
          taskManagementSkill: '',
          contigency: '',
          jobRole: '',
          transferSkill: '',
        },
      ],
      rekomendasi: [
        {
          item: 'Rekomendasi untuk peningkatan',
          rekomendasi: '',
        },
      ],
      rekomendasiPemenuhan: [
        {
          item: 'Rekomendasi untuk peningkatan :',
          rekomendasi: '',
        },
      ],
      ttdTable: [
        {
          nama: 'Nama Asesor',
          tanggal: '12-2-2002',
          ttd: '',
          komentar: '',
        },
      ],
      active: 0,
      isWide: true,
      labelPosition: 'left',
    };
  },
  computed: {
    ...mapGetters(['userId']),
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
    this.getAk06();
  },
  methods: {
    clear() {
      this.$refs.signature.clear();
    },
    saveSign() {
      var _this = this;
      this.testPng = _this.$refs.signature.save();
    },
    allKompeten() {
      for (var i = 0; i < this.listKuk.length; i++) {
        var kuk = this.kukList[i];
        if (kuk.type === 'kuk'){
          // kuk.is_kompeten = this.kompeten;
        }
      }
    },
    async getAk06() {
      const { data } = await showAk06Resource.get(this.$route.params.id_ak_06);
      this.ttdTable[0].komentar = data[0].ttdTable.komentar;
      // console.log(data[0].ttdTable.komentar);
      // console.log(data);
      this.aspek = data[0]['aspek'];
      // console.log(this.aspek);
      this.aspek.forEach((element, index) => {
        if (index === 0) {
          element.validitas = element.validitas === 1;
          element.reliabel = element.reliabel === 1;
          element.fleksibel = element.fleksibel === 1;
          element.adil = element.adil === 1;
        } else if (index === 1){
          element.validitas = element.validitas === 1;
          element.reliabel = element.reliabel === 1;
          element.fleksibel = element.fleksibel === 1;
          element.adil = element.adil === 1;
        } else if (index === 2){
          element.validitas = element.validitas === 1;
          element.reliabel = element.reliabel === 1;
          element.fleksibel = element.fleksibel === 1;
          element.adil = element.adil === 1;
        } else if (index === 3){
          element.validitas = element.validitas === 1;
          element.reliabel = element.reliabel === 1;
          element.fleksibel = element.fleksibel === 1;
          element.adil = element.adil === 1;
        } else if (index === 4){
          element.validitas = element.validitas === 1;
          element.reliabel = element.reliabel === 1;
          element.fleksibel = element.fleksibel === 1;
          element.adil = element.adil === 1;
        } else if (index === 5){
          element.validitas = element.validitas === 1;
          element.reliabel = element.reliabel === 1;
          element.fleksibel = element.fleksibel === 1;
          element.adil = element.adil === 1;
        }
      });
      this.aspekPemenuhan[0].item = data[0].aspekPemenuhan.item;
      this.aspekPemenuhan[0].taskSkill = data[0].aspekPemenuhan.taskSkill;
      this.aspekPemenuhan[0].taskManagementSkill = data[0].aspekPemenuhan.taskManagementSkill;
      this.aspekPemenuhan[0].contigency = data[0].aspekPemenuhan.contigency;
      this.aspekPemenuhan[0].jobRole = data[0].aspekPemenuhan.jobRole;
      this.aspekPemenuhan[0].transferSkill = data[0].aspekPemenuhan.transferSkill;
      this.rekomendasi[0].item = data[0].rekomendasi.item;
      this.rekomendasi[0].rekomendasi = data[0].rekomendasi.rekomendasi;
      this.rekomendasiPemenuhan[0].item = data[0].rekomendasiPemenuhan.item;
      this.rekomendasiPemenuhan[0].rekomendasi = data[0].rekomendasiPemenuhan.rekomendasi;
      const dt = new Date(data[0].ttdTable.waktu);
      const date = dt.toLocaleDateString('id-ID', {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric',
        // hour: 'numeric',
        // minute: 'numeric',
      });
      this.ttdTable[0].tanggal = date;
      if (data[0].ttdTable.ttd){
        this.ttdTable[0].ttd = '/uploads/users/signature/' + data[0].ttdTable.ttd;
      } else {
        this.ttdTable[0].ttd = null;
      }

      // this.ttdTable[0].ttd = '/uploads/users/signature/' + data[0].ttdTable.ttd;
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
      // var id_uji = this.$route.params.id_uji;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      // var ujiDetail = this.listUji.find((x) => x.id === id_uji);
      // this.selectedUji = ujiDetail;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      var id_apl_01 = this.$route.params.id_apl_01;
      this.listUji = await ujiKomResource.list({ idapl01: id_apl_01 });
      this.headerTable[0].content = this.listUji.data[0].skema_sertifikasi;
      this.headerTable[1].content = this.listUji.data[0].nama_tuk;
      this.headerTable[2].content = this.listUji.data[0].asesor;
      this.headerTable[3].content = this.listUji.data[0].mulai;
      this.ttdTable[0].nama = this.listUji.data[0].asesor;
      this.ttdTable[0].tanggal = this.listUji.data[0].mulai;
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
        // this.headerTable[3].content.push(element['unit_kompetensi']);
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
      // console.log(this.listKodeUnit);
      // var elemen = unitKomp.elemen;
      // var kuk = elemen.kuk;
      this.listKuk = kuk;
    },
    onSubmit() {
      this.loading = true;
      var sign = this.$refs.signature.save();
      this.ttdTable[0].ttd = sign;
      // var nama = this.$route.params.asesor;
      // this.ttdTable[0].nama = nama;
      var data = {
        'id_uji': this.$route.params.id_uji,
        'submitBy': this.userId,
        'dataAspek': this.aspek,
        'aspekPemenuhan': this.aspekPemenuhan,
        'rekomendasi': this.rekomendasi,
        'rekomendasiPemenuhan': this.rekomendasiPemenuhan,
        'ttdTable': this.ttdTable,
      };
      // console.log(data);
      ak06Resource.store(data)
        .then(response => {
          this.$message({
            message: 'FR AK 06 has been Submited successfully.',
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
