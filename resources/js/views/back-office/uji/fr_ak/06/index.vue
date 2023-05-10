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
                <el-checkbox v-if="scope.row.item !== 'Prosedur asesmen :'" v-model="scope.row.validitas" />
              </template>
            </el-table-column>
            <el-table-column align="center" label="Reliabel">
              <template slot-scope="scope">
                <el-checkbox v-if="scope.row.item !== 'Prosedur asesmen :'" v-model="scope.row.reliabel" />
              </template>
            </el-table-column>
            <el-table-column align="center" label="Fleksibel">
              <template slot-scope="scope">
                <el-checkbox v-if="scope.row.item !== 'Prosedur asesmen :'" v-model="scope.row.fleksibel" />
              </template>
            </el-table-column>
            <el-table-column align="center" label="Adil">
              <template slot-scope="scope">
                <el-checkbox v-if="scope.row.item !== 'Prosedur asesmen :'" v-model="scope.row.adil" />
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
                <el-input v-model="scope.row.taskManagement" type="textarea" />
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
          <el-table-column align="center" label="Nama Asesor">
            <template slot-scope="scope">
              <span>{{ scope.row.nama }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Tanggal">
            <template slot-scope="scope">
              <span>{{ scope.row.tanggal }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Tanda Tangan Asesor">
            <template slot-scope="scope">
              <el-image
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
        <el-button @click="onSubmit">Submit</el-button>
      </div>
    </el-main>
  </el-container>
</template>

<script>
import Resource from '@/api/resource';
const jadwalResource = new Resource('jadwal-get');
const skemaResource = new Resource('skema-get');
const tukResource = new Resource('tuk-get');
const ujiKomResource = new Resource('uji-komp-get');
const mstAk03Resource = new Resource('mst-ak-03-get');
const ak06Resource = new Resource('uji-komp-ak-06');
// const apl01Resource = new Resource('detail/apl-01');

export default {
  components: {},
  data() {
    return {
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
          title: 'TUK',
          content: '',
        },
        {
          title: 'Skema Sertifikasi',
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
          taskManagement: '',
          contigency: '',
          jobRole: '',
          transferSkill: '',
        },
      ],
      rekomendasi: [
        {
          item: 'Rekomendasi untuk peningkatan :',
          rekomendasi: '',
        },
      ],
      rekomendasiPemenuhan: [
        {
          item: 'Rekomendasi untuk peningkatan :',
          rekomendasi: '',
        },
      ],
      form: {
        namaAsesi: '',
        rekomendasi: '',
        keterangan: '',
        aspek: '',
        catatanPenolakan: '',
        saranPerbaikan: '',
      },
      ttdTable: [
        {
          no: 1,
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
  beforeDestroy() {
    window.removeEventListener('resize', this.onResize);
  },
  mounted() {
    window.addEventListener('resize', this.onResize);
    this.onResize();
  },
  created() {
    this.getApl01();
    this.getListSkema().then((value) => {
      this.onJadwalSelect();
    });
    this.getListUji().then((value) => {
      this.getUjiKompDetail();
    });
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
    async getApl01() {
      this.loading = true;
      // const data = await apl01Resource.get(this.$route.params.id_apl_01);
      // this.ttdTable[0].nama = this.$route.params.asesor;
    },
    async getListPertanyaan() {
      this.loading = true;
      const { data } = await mstAk03Resource.list({ id_skema: this.$route.params.id_skema });
      this.listSoal = data;
      this.listSoal.forEach((element, index) => {
        element['index'] = index + 1;
      });
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
    getUjiKompDetail() {
      var id_uji = this.$route.params.id_uji;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      var ujiDetail = this.listUji.find((x) => x.id === id_uji);
      this.selectedUji = ujiDetail;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.headerTable[0].content = ujiDetail.nama_peserta;
      this.headerTable[1].content = ujiDetail.asesor;
      this.headerTable[2].content = ujiDetail.nama_tuk;
      this.headerTable[3].content = ujiDetail.skema_sertifikasi;
      this.headerTable[4].content = ujiDetail.mulai;
      this.ttdTable[0].nama = ujiDetail.asesor;
      this.ttdTable[0].tanggal = ujiDetail.mulai;
    },
    onJadwalSelect() {
      var id_skema = this.$route.params.id_skema;
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
      console.log(this.listKodeUnit);
      // var elemen = unitKomp.elemen;
      // var kuk = elemen.kuk;
      this.listKuk = kuk;
    },
    onSubmit() {
      this.loading = true;
      ak06Resource
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
