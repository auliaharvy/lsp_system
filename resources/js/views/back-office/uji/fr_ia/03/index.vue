<template>
  <el-container class="app-container">
    <el-header>
      <el-page-header
        content="FR.IA.03 PERTANYAAN UNTUK MENDUKUNG OBSERVASI"
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
                  :key="item"
                >
                  {{ item }}
                </li>
              </ul>
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
          <el-table-column
            align="center"
            min-width="20px"
            label="No"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.index }}</span>
            </template>
          </el-table-column>
          <el-table-column
            align="left"
            min-width="150px"
            label="Pertanyaan"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.pertanyaan }}</span>
            </template>
          </el-table-column>
          <el-table-column
            align="left"
            min-width="200px"
            label="Tanggapan"
          >
            <template slot-scope="scope">
              <el-input
                v-model="scope.row.tanggapan"
                type="textarea"
                :rows="3"
                placeholder="Isi Tanggapan"
                label="Tanggapan"
              />
            </template>
          </el-table-column>
          <el-table-column
            v-if="roles[0] !== 'user'"
            align="center"
            min-width="80px"
            label="Rekomendasi"
          >
            <template slot-scope="scope">
              <el-select
                v-model="scope.row.is_kompeten"
                class="filter-item"
                placeholder="B/BK"
              >
                <el-option
                  key="kompeten"
                  label="Kompeten"
                  value="kompeten"
                />
                <el-option
                  key="belum kompeten"
                  label="Belum Kompeten"
                  value="belum kompeten"
                />
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
          <el-form-item
            v-if="roles[0] !== 'user'"
            label="Rekomendasi Assesor"
          >
            <el-radio
              v-model="form.rekomendasi_asesor"
              label="Kompeten"
              border
            >
              Kompeten
            </el-radio>
            <el-radio
              v-model="form.rekomendasi_asesor"
              label="Belum Kompeten"
              border
            >
              Belum Kompeten
            </el-radio>
          </el-form-item>
          <el-form-item
            v-if="roles[0] !== 'user'"
            label="Umpan balik untuk asesi"
          >
            <el-input
              v-model="form.umpanBalikAsesi"
              type="textarea"
              :rows="3"
              placeholder="Isi umpan balik untuk asesi"
              label="Umpan Balik Untuk Ases"
            />
          </el-form-item>
        </el-form>
        <br>

        <el-button
          v-if="!$route.params.id_ia_03"
          @click="onSubmit"
        >
          Submit
        </el-button>
        <el-button
          v-if="$route.params.id_ia_03 && roles[0] !== 'user'"
          @click="nilai"
        >
          Submit Asesor
        </el-button>
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
const ia03Resource = new Resource('uji-komp-ia-03');
const ia03NilaiResource = new Resource('uji-komp-ia-03-nilai');
const ia03Detail = new Resource('detail/ia-03');

export default {
  components: {},
  data() {
    return {
      umpanBalikAsesi: '',
      kompeten: null,
      loading: false,
      listSoal: null,
      listSkema: null,
      listTuk: null,
      listJadwal: null,
      ia03: null,
      listKodeUnit: [],
      listJudulUnit: [],
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
          col1: '',
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
          content: '20 - 12 -2022',
        },
      ],
      panduan: [
        'Formulir ini di isi oleh asesor kompetensi dapat sebelum, pada saat atau setelah melakukan asesmen dengan methode observasi demonstrasi',
        'Pertanyaan dibuat dengan tujuan untuk menggali, dapat berisi pertanyaan yang berkaitan dengan dimensi kompetensi, batasan variabel dan aspek kritis yang relevan dengan skenario tugas dan praktik demonstrasi',
        'Jika pertanyaan disampaikan sebelum asesi melakukan praktik demonstrasi, maka pertanyaan dibuat berkaitan dengan aspek K3L, SOP, penggunaan peralatasn dan perlengkapan.',
        'Jika pada saat observasi adalah hal yang perlu dikonfirmasi sedangkan di instrumen daftar pertanyaan pendukung observasi tidak ada, maka asesor dapat memberikan pertanyaan dengan syarat pertanyaan harus berkaitan dengan tugas praktek demonstrasi. jika dilakukan, asesor harus mencatat dalam instrumen pertanyaan pendukung observasi.',
        'Tanggapan asesi ditulis pada kolom tanggapan'
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
    this.getUjiKompDetail();
    // });
    this.getListPertanyaan().then((value) => {
      this.getIa03();
    });
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
      this.listSoal.forEach((element, index) => {
        element['index'] = index + 1;
      });
      const dataia03 = await ia03Detail.get(this.$route.params.id_ia_03);
      this.ia03 = dataia03;
      this.loading = false;
    },
    getIa03() {
      if (this.$route.params.id_ia_03 !== null) {
        this.loading = true;
        this.listSoal.forEach((element, index) => {
          var foundIndex = this.ia03.detail.findIndex(x => x.id_perangkat_ia_03 === element['id']);
          element['tanggapan'] = this.ia03.detail[foundIndex].tanggapan;
          element['id'] = this.ia03.detail[foundIndex].id;
        });
        // console.log(this.listSoal);
        this.loading = false;
      }
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
      // this.headerTable[0].content = ujiDetail.skema_sertifikasi;
      // this.headerTable[1].content = ujiDetail.nama_tuk;
      // this.headerTable[2].content = ujiDetail.asesor;
      // this.headerTable[3].content = ujiDetail.nama_peserta;
      // this.headerTable[4].content = ujiDetail.mulai;

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
      // var elemen = unitKomp.elemen;
      // var kuk = elemen.kuk;
      this.listKuk = kuk;
    },
    onSubmit() {
      this.loading = true;
      this.listSoal.forEach((element, index) => {
        // element['is_kompeten'] = element['is_kompeten'] ? element['is_kompeten'] : 'belum penilaian';
        element['is_kompeten'];
      });
      this.form.detail_ia_03 = this.listSoal;
      this.form.user_id = this.userId;
      this.form.id_uji_komp = this.$route.params.id_uji;
      this.form.id_skema = this.$route.params.id_skema;
      this.form.rekomendasi_asesor = this.form.rekomendasi_asesor ? this.form.rekomendasi_asesor : 'belum penilaian';
      this.form.umpanBalikAsesi = this.form.umpanBalikAsesi ? this.form.umpanBalikAsesi : 'belum penilaian';

      // console.log(this.form.detail_ia_03);
      ia03Resource
        .store(this.form)
        .then(response => {
          this.$message({
            message: 'FR IA 03 has been created successfully.',
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
      // console.log(this.listSoal);
      this.form.detail_ia_03 = this.listSoal;
      this.form.user_id = this.userId;
      this.form.id_uji_komp = this.$route.params.id_uji;
      this.form.id_skema = this.$route.params.id_skema;
      this.form.id_ia_03 = this.$route.params.id_ia_03;
      this.form.rekomendasi_asesor = this.form.rekomendasi_asesor ? this.form.rekomendasi_asesor : 'belum penilaian';
      this.form.umpanBalikAsesi = this.form.umpanBalikAsesi ? this.form.umpanBalikAsesi : 'belum penilaian';

      ia03NilaiResource
        .store(this.form)
        .then(response => {
          this.$message({
            message: 'FR IA 03 has been created successfully.',
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
