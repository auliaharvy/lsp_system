<template>
  <el-container class="app-container">
    <el-header>
      <el-page-header content="FR.AK.01 PERSETUJUAN ASESMEN DAN KERAHASIAAN" @back="$router.back()" />
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
              <span v-if="checkRole(['assesor', 'admin'])">{{ scope.row.title === 'Tanda Tangan Asesi' ? '' : scope.row.title }}</span>
              <span v-if="checkRole(['user'])">{{ scope.row.title === 'Tanda Tangan Asesor' ? '' : scope.row.title }}</span>

            </template>
          </el-table-column>
          <el-table-column align="left">
            <template slot-scope="scope">
              <template v-if="scope.row.content !== '.'">
                <template v-if="scope.row.content === '-'">
                  <el-checkbox v-model="verifikasi_portofolio" :disabled="!checkRole(['assesor', 'admin'])">TL : Verifikasi Portofolio</el-checkbox>
                  <el-checkbox v-model="observasi_langsung" :disabled="!checkRole(['assesor', 'admin'])">L : Observasi Langsung</el-checkbox>
                  <el-checkbox v-model="hasil_tes_tulis" :disabled="!checkRole(['assesor', 'admin'])">T : Hasil Tes Tulis</el-checkbox>
                  <el-checkbox v-model="hasil_tes_lisan" :disabled="!checkRole(['assesor', 'admin'])">T : Hasil Tes Lisan</el-checkbox>
                  <el-checkbox v-model="hasil_tes_wawancara" :disabled="!checkRole(['assesor', 'admin'])">T : Hasil Tes Wawancara</el-checkbox>
                </template>
                <template v-else-if="scope.row.no === 11">
                  <div v-if="checkRole(['assesor', 'admin'])">
                    <img v-if="scope.row.content" :src="scope.row.content" class="sidebar-logo">
                    <div v-else>
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
                  </div>
                </template>
                <template v-else-if="scope.row.no === 12">
                  <div v-if="!checkRole(['assesor', 'admin'])">
                    <img v-if="scope.row.content" :src="scope.row.content" class="sidebar-logo">
                    <div v-else>
                      <vueSignature
                        ref="signature1"
                        :sig-option="option"
                        :w="'300px'"
                        :h="'150px'"
                        :disabled="false"
                        style="border-style: outset"
                      />
                      <el-button size="small" @click="clear1">Clear</el-button>
                    </div>
                  </div>
                </template>
                <span v-else>{{ scope.row.content }}</span>
              </template>
              <template v-else>
                Tanggal dan Waktu :
                <template v-if="$route.params.id_ak_01 !== null">
                  {{ hari + ', ' + tanggal + '-' + bulan + '-' + tahun + ' Jam ' + jam }}
                </template>
                <template v-else>
                  <el-form
                    :model="dataTrx"
                    label-width="0px"
                    :label-position="labelPosition"
                  >
                    <el-form-item>
                      <el-date-picker
                        v-if="!checkRole(['assesor', 'admin'])"
                        v-model="dataTrx.date"
                        :disabled="true"
                        type="datetime"
                        placeholder="Pick a date"
                        style="width: 100%"
                        format="dd/MM/yyyy HH:mm"
                        @change="getDate"
                      />
                      <el-date-picker
                        v-if="checkRole(['assesor', 'admin'])"
                        v-model="dataTrx.date"
                        type="datetime"
                        placeholder="Pick a date"
                        style="width: 100%"
                        format="dd/MM/yyyy HH:mm"
                        @change="getDate"
                      />
                    </el-form-item>
                  </el-form>
                </template>
                <br>
                TUK : {{ headerTable[2].content }}
              </template>
            </template>
          </el-table-column>
        </el-table>

        <br>

        <!-- <el-button v-if="$route.params.id_ak_01 === null" @click="onSubmit">Submit Asesor</el-button>
        <el-button v-else>Print</el-button> -->
        <el-button v-if="checkRole(['assesor'])" @click="onSubmit">Submit Asesor</el-button>
        <el-button v-if="checkRole(['admin'])" @click="onSubmit">Submit Admin</el-button>
        <el-button v-if="!checkRole(['assesor', 'admin'])" @click="onSubmitAsesi">Submit Asesi</el-button>
        <!-- <el-button v-if="!checkRole(['assesor', 'admin'])" @click="onSubmitAsesi">Submit</el-button> -->
        <br>
        <br>
      </div>
    </el-main>
  </el-container>
</template>

<script>
import vueSignature from 'vue-signature';
import Resource from '@/api/resource';
import checkRole from '@/utils/role';
const jadwalResource = new Resource('jadwal-get');
const skemaResource = new Resource('skema-get');
const tukResource = new Resource('tuk-get');
const ujiKomResource = new Resource('uji-komp-get');
const ak01Resource = new Resource('uji-komp-ak-01');
const ak01AsesiResource = new Resource('uji-komp-ak-01-asesi');
const ak01Detail = new Resource('detail/ak-01');

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
      now: null,
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
      verifikasi_portofolio: false,
      observasi_langsung: false,
      hasil_tes_tulis: false,
      hasil_tes_lisan: false,
      hasil_tes_wawancara: false,
      hari: null,
      tanggal: null,
      bulan: null,
      tahun: null,
      jam: null,
      menit: null,
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
          no: 1,
          title: 'Skema Sertifikasi',
          content: 'SKEMA SKNNI KLASIFIKASI II BISNIS DARING PEMASARAN',
        },
        {
          no: 2,
          title: 'Kode Skema',
          content: '0000',
        },
        {
          no: 3,
          title: 'TUK',
          content: 'TUK BDP',
        },
        {
          no: 4,
          title: 'Nama Asesor',
          content: 'AULIA HARVY',
        },
        {
          no: 5,
          title: 'Nama Asesi',
          content: 'INDAH',
        },
        {
          no: 6,
          title: 'Bukti yang di kumpulkan',
          content: '-',
        },
        {
          no: 7,
          title: 'Pelaksanaan Asesmen disepakati pada',
          content: '.',
        },
        {
          no: 8,
          title: 'Asesor',
          content: 'Menyatakan tidak akan membuka hasil pekerjaan yang saya peroleh karena penugasan saya sebagai asesor dalam pekerjaan asesmen kepada siapapun atau organisasi apapun selain kepada pihak yang berwenang sehubungan dengan kewajiban saya sebagai asesor yang di tugaskan oleh LSP.',
        },
        {
          no: 9,
          title: 'Asesi',
          content: 'Bahwa Saya Sudah Mendapatkan Penjelasan Hak dan Prosedur Banding Oleh Asesor.',
        },
        {
          no: 10,
          title: 'Asesi',
          content: 'Saya setuju mengkuti asesmen dengan pemahaman bahwa informasi yang di kumpulkan hanya digunakan untuk pengembangan profesional dan hanya dapat diakses oleh orang tertentu saja.',
        },
        {
          no: 11,
          title: 'Tanda Tangan Asesor',
          content: '',
        },
        {
          no: 12,
          title: 'Tanda Tangan Asesi',
          content: '',
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
    this.getAk01();
  },
  methods: {
    checkRole,
    clear() {
      this.$refs.signature.clear();
    },
    clear1() {
      this.$refs.signature1.clear();
    },
    async getAk01() {
      if (this.$route.params.id_ak_01 !== null) {
        this.loading = true;
        const data = await ak01Detail.get(this.$route.params.id_ak_01);
        if (data.verifikasi_portofolio === 0) {
          this.verifikasi_portofolio = false;
        } else {
          this.verifikasi_portofolio = true;
        }
        if (data.observasi_langsung === 0) {
          this.observasi_langsung = false;
        } else {
          this.observasi_langsung = true;
        }
        if (data.hasil_tes_tulis === 0) {
          this.hasil_tes_tulis = false;
        } else {
          this.hasil_tes_tulis = true;
        }
        if (data.hasil_tes_lisan === 0) {
          this.hasil_tes_lisan = false;
        } else {
          this.hasil_tes_lisan = true;
        }
        if (data.hasil_tes_wawancara === 0) {
          this.hasil_tes_wawancara = false;
        } else {
          this.hasil_tes_wawancara = true;
        }
        this.hari = data.hari;
        this.tanggal = data.tanggal;
        this.bulan = data.bulan;
        this.tahun = data.tahun;
        this.jam = data.jam;
        this.headerTable[10].content = '/uploads/users/signature/' + data.tanda_tangan_asesor;
        // this.headerTable[11].content = '/uploads/users/signature/' + data.tanda_tangan_asesi;
        console.log(this.headerTable[11].content);
        this.loading = false;
      } else {
        this.loading = true;
        this.verifikasi_portofolio = false;
        this.observasi_langsung = false;
        this.hasil_tes_tulis = false;
        this.hasil_tes_lisan = false;
        this.hasil_tes_wawancara = false;
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
      // console.log(ujiDetail);
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      var id_apl_01 = this.$route.params.id_apl_01;
      this.listUji = await ujiKomResource.list({ idapl01: id_apl_01 });
      console.log(this.listUji);

      this.headerTable[0].content = this.listUji.data[0].skema_sertifikasi;
      this.headerTable[1].content = this.listUji.data[0].kode_skema;
      this.headerTable[2].content = this.listUji.data[0].nama_tuk;
      this.headerTable[3].content = this.listUji.data[0].asesor;
      this.headerTable[4].content = this.listUji.data[0].nama_peserta;
      this.dataTrx.tuk = this.listUji.data[0].nama_tuk;
      this.dataTrx.nama_asesor = this.listUji.data[0].asesor;
      this.dataTrx.tanda_tangan_asesor = this.listUji.data[0].ttd_asesor;
      this.dataTrx.email_asesi = this.listUji.data[0].email_peserta;
      this.dataTrx.nama_asesi = this.listUji.data[0].nama_peserta;
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
    onSubmitAsesi() {
      this.loading = true;
      this.dataTrx.id_uji_komp = this.$route.params.id_uji;
      this.dataTrx.id_ak_01 = this.$route.params.id_ak_01;
      this.dataTrx.signature_asesi = this.$refs.signature1.save();
      this.dataTrx.pernyataan_asesor = this.headerTable[7].content;
      this.dataTrx.pernyataan_asesi = this.headerTable[8].content;
      // console.log(this.dataTrx);
      ak01AsesiResource
        .store(this.dataTrx)
        .then(response => {
          this.$message({
            message: 'FR AK 01 has been submitted successfully.',
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
    onSubmit() {
      this.loading = true;
      this.dataTrx.id_uji_komp = this.$route.params.id_uji;
      this.dataTrx.signature_asesor = this.$refs.signature.save();
      this.dataTrx.pernyataan_asesor = this.headerTable[7].content;
      this.dataTrx.pernyataan_asesi = this.headerTable[8].content;
      if (this.verifikasi_portofolio === false) {
        this.dataTrx.verifikasi_portofolio = 0;
      } else {
        this.dataTrx.verifikasi_portofolio = 1;
      }
      if (this.observasi_langsung === false) {
        this.dataTrx.observasi_langsung = 0;
      } else {
        this.dataTrx.observasi_langsung = 1;
      }
      if (this.hasil_tes_tulis === false) {
        this.dataTrx.hasil_tes_tulis = 0;
      } else {
        this.dataTrx.hasil_tes_tulis = 1;
      }
      if (this.hasil_tes_lisan === false) {
        this.dataTrx.hasil_tes_lisan = 0;
      } else {
        this.dataTrx.hasil_tes_lisan = 1;
      }
      if (this.hasil_tes_wawancara === false) {
        this.dataTrx.hasil_tes_wawancara = 0;
      } else {
        this.dataTrx.hasil_tes_wawancara = 1;
      }
      const formData = new FormData();
      formData.append('id_uji_komp', this.dataTrx.id_uji_komp);
      formData.append('nama_asesi', this.dataTrx.nama_asesi);
      formData.append('email_asesi', this.dataTrx.email_asesi);
      formData.append('nama_asesor', this.dataTrx.nama_asesor);
      formData.append('verifikasi_portofolio', this.dataTrx.verifikasi_portofolio);
      formData.append('observasi_langsung', this.dataTrx.observasi_langsung);
      formData.append('hasil_tes_tulis', this.dataTrx.hasil_tes_tulis);
      formData.append('hasil_tes_lisan', this.dataTrx.hasil_tes_lisan);
      formData.append('hasil_tes_wawancara', this.dataTrx.hasil_tes_wawancara);
      formData.append('hari', this.dataTrx.hari);
      formData.append('tanggal', this.dataTrx.tanggal);
      formData.append('bulan', this.dataTrx.bulan);
      formData.append('tahun', this.dataTrx.tahun);
      formData.append('jam', this.dataTrx.jam);
      formData.append('tuk', this.dataTrx.tuk);
      formData.append('pernyataan_asesor', this.dataTrx.pernyataan_asesor);
      formData.append('pernyataan_asesi', this.dataTrx.pernyataan_asesi);
      formData.append('signature_asesor', this.dataTrx.signature_asesor);
      ak01Resource
        .store(formData)
        .then(response => {
          this.$message({
            message: 'FR AK 01 has been created successfully.',
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
    getDate() {
      var arrbulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      var arrHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
      // var date = this.dataTrx.date;
      var date = new Date(this.dataTrx.date);
      // var millisecond = date.getMilliseconds();
      // var detik = date.getSeconds();
      var menit = date.getMinutes();
      var jam = date.getHours();
      var hari = date.getDay();
      var tanggal = date.getDate();
      var bulan = date.getMonth();
      var tahun = date.getFullYear();

      var resultMenit = menit > 9 ? menit : '0' + menit;
      this.dataTrx.menit = resultMenit;
      var resultJam = jam > 9 ? jam + ':' + resultMenit : '0' + jam + ':' + resultMenit;
      this.dataTrx.jam = resultJam;
      this.dataTrx.tanggal = tanggal;
      this.dataTrx.bulan = arrbulan[bulan];
      this.dataTrx.tahun = tahun;
      this.dataTrx.hari = arrHari[hari];
      console.log(`${this.dataTrx.hari}, ${this.dataTrx.tanggal}/${this.dataTrx.bulan}/${this.dataTrx.tahun} - Jam ${this.dataTrx.jam}`);
      // document.write(tanggal+"-"+arrbulan[bulan]+"-"+tahun+"<br/>"+jam+" : "+menit+" : "+detik+"."+millisecond);
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
  .sidebar-logo {
        width: 200px;
        height: 120px;
        vertical-align: middle;
        margin-right: 12px;
      }
  .clear-left {
    clear: left;
  }
}
</style>
