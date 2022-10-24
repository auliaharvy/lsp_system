<template>
  <el-container class="app-container">
    <el-header>
      <el-page-header content="FR.AK.04 BANDING ASESMEN" @back="$router.back()" />
    </el-header>
    <el-main>
      <div>
        <br>
        <el-form
          ref="form"
          :model="form"
          label-width="250px"
          label-position="left"
        >
          <el-form-item label="Nama Asesi" prop="namaAsesi">
            <el-input v-model="dataSend.namaAsesi" placeholder="nama asesi" />
          </el-form-item>

          <el-form-item label="Nama Asesor" prop="namaAsesor">
            <el-input v-model="dataSend.namaAsesor" placeholder="nama asesor" />
          </el-form-item>

          <el-form-item label="Apakah proses banding telah dijelaskan kepada anda?" prop="proses">
            <el-select v-model="dataSend.prosesBanding" class="filter-item" placeholder="ya/tidak">
              <el-option label="Ya" value="ya" />
              <el-option label="Tidak" value="tidak" />
            </el-select>
          </el-form-item>

          <el-form-item label="Apakah anda telah mendiskusikan banding dengan asesor?" prop="diskusi">
            <el-select v-model="dataSend.diskusiBanding" class="filter-item" placeholder="ya/tidak">
              <el-option label="Ya" value="ya" />
              <el-option label="Tidak" value="tidak" />
            </el-select>
          </el-form-item>

          <el-form-item label="Apakah anda mau melibatkan 'Orang Lain' membantu anda dalam proses banding?" prop="bantuBanding">
            <el-select v-model="dataSend.membantuBanding" class="filter-item" placeholder="ya/tidak">
              <el-option label="Ya" value="ya" />
              <el-option label="Tidak" value="tidak" />
            </el-select>
          </el-form-item>

          <el-form-item label="Skema Sertifikasi" prop="skema">
            <el-input v-model="dataSend.skema" placeholder="skema sertifikasi" />
          </el-form-item>

          <el-form-item label="No Skema" prop="noSkema">
            <el-input v-model="dataSend.noSkema" placeholder="nomor skema sertifikasi" />
          </el-form-item>

          <el-form-item label="Alasan banding" prop="alasanBanding">
            <el-input v-model="dataSend.alasanBanding" type="textarea" :rows="3" placeholder="Isi Komentar" />
          </el-form-item>
        </el-form>
        <br>

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
      dataSend: {
        namaAsesi: '',
        namaAsesor: '',
        tanggalAsesmen: '',
        prosesBanding: '',
        diskusiBanding: '',
        membantuBanding: '',
        skema: '',
        noSkema: '',
        alasanBanding: '',
      },
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
      console.log(ujiDetail);
      this.dataSend.skema = ujiDetail.skema_sertifikasi;
      this.dataSend.namaAsesor = ujiDetail.nama_asesor;
      this.dataSend.namaAsesi = ujiDetail.nama_peserta;
      this.dataSend.noSkema = ujiDetail.kode_skema;
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
        kuk.push(element);
        this.unitKompetensiTable[0].col3.push(element['kode_unit']);
        this.unitKompetensiTable[1].col3.push(element['unit_kompetensi']);
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
      if (this.active++ > 2) {
        this.active = 0;
      }
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
