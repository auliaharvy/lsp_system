<template>
  <el-container class="app-container">
    <el-header>
      <el-steps :active="active" finish-status="success" simple>
        <el-step title="Profil Peserta" />
        <el-step title="Dokumen Portofolio" />
        <el-step title="Asesmen Mandiri" />
      </el-steps>
    </el-header>
    <el-main>
      <div v-if="active === 0" class="form">
        <el-form
          ref="form"
          v-loading="loading"
          :rules="rules"
          :model="dataTrx"
          label-width="250px"
          :label-position="labelPosition"
        >
          <el-form-item :label="$t('jadwal.table.jadwal')" prop="id_jadwal">
            <el-select
              v-model="dataTrx.id_jadwal"
              filterable
              clearable
              class="filter-item full"
              :placeholder="$t('jadwal.table.jadwal')"
              @change="onJadwalSelect()"
            >
              <el-option
                v-for="item in listJadwal"
                :key="item.id"
                :label=" item.jadwal + ' / ' + item.start_date + ' - ' + item.nama_skema"
                :value="item.id"
              />
            </el-select>
          </el-form-item>

          <el-form-item :label="$t('skema.table.skema')" prop="skema_id">
            <el-select
              v-model="dataTrx.id_skema"
              filterable
              clearable
              class="filter-item full"
              :placeholder="$t('skema.table.skema')"
            >
              <el-option
                v-for="item in listSkema"
                :key="item.id"
                :label="item.skema_sertifikasi"
                :value="item.id"
                disabled
              />
            </el-select>
          </el-form-item>

          <el-form-item label="Tempat Uji Kompetensi" prop="id_tuk">
            <el-select
              v-model="dataTrx.id_tuk"
              filterable
              clearable
              class="filter-item full"
              placeholder="Pilih TUK"
            >
              <el-option
                v-for="item in listTuk"
                :key="item.id"
                :label="item.nama"
                :value="item.id"
                disabled
              />
            </el-select>
          </el-form-item>

          <el-form-item label="NIK">
            <el-input v-model="dataTrx.nik" />
          </el-form-item>
          <el-form-item label="Nama Lengkap" prop="nama_lengkap">
            <el-input v-model="dataTrx.nama_lengkap" />
          </el-form-item>
          <el-form-item label="Nama Sekolah">
            <el-input v-model="dataTrx.nama_sekolah" />
          </el-form-item>
          <el-form-item label="Tempat - Tanggal Lahir">
            <el-col :span="11">
              <el-input v-model="dataTrx.tempat_lahir" />
            </el-col>
            <el-col class="line" :span="2">-</el-col>
            <el-col :span="11">
              <el-date-picker
                v-model="dataTrx.tanggal_lahir"
                type="date"
                placeholder="Pick a date"
                style="width: 100%"
              />
            </el-col>
          </el-form-item>
          <el-form-item label="Jenis Kelamin">
            <el-radio-group v-model="dataTrx.jenis_kelamin">
              <el-radio v-model="dataTrx.jenis_kelamin" label="Laki - Laki" />
              <el-radio v-model="dataTrx.jenis_kelamin" label="Perempuan" />
            </el-radio-group>
          </el-form-item>
          <el-form-item label="Alamat">
            <el-input v-model="dataTrx.alamat" type="textarea" />
          </el-form-item>
          <el-form-item label="Kode Pos">
            <el-input v-model="dataTrx.kode_pos" />
          </el-form-item>
          <el-form-item label="No HP">
            <el-input v-model="dataTrx.no_hp" />
          </el-form-item>
          <el-form-item label="Email" prop="email">
            <el-input v-model="dataTrx.email" />
          </el-form-item>
          <el-form-item label="Tingkatan Kelas">
            <el-select
              v-model="dataTrx.tingkatan"
              placeholder="pilih tingkatan kelas"
            >
              <el-option label="X" value="x" />
              <el-option label="XI" value="xi" />
              <el-option label="XII" value="xii" />
            </el-select>
          </el-form-item>
        </el-form>
      </div>

      <div v-if="active === 1" class="form">
        <h3>UPLOAD BUKTI PENDUKUNG</h3>
        <p>
          Cantumkan satu atau beberapa bukti pendukung (portofolio, sertifikat,
          ijazah dll) yang terkait dengan skema atau unit kompetensi yang telah
          diambil. Kemudian jika dimungkinkan scan dan upload dokumen tersebut
          kedalam sistem ini
        </p>
        <el-divider />

        <el-table
          v-loading="loading"
          :data="selectedSkema.children"
          border
          fit
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center' }"
        >
          <el-table-column align="center" label="Kode Unit">
            <template slot-scope="scope">
              <span>{{ scope.row.kode_unit }}</span>
            </template>
          </el-table-column>

          <el-table-column
            align="left"
            label="Judul Unit Kompetensi"
            min-width="200px"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.unit_kompetensi }}</span>
            </template>
          </el-table-column>
        </el-table>
        <br>
        <el-card class="box-card">
          <p>
            Pada bagian ini, anda diminta untuk memilih bukti-bukti pendukung
            yang anda anggap relevan terhadap setiap elemen/KUK unit kompetensi.
            Pilihan dapat lebih dari 1(Satu) bukti pendukung.
          </p>
        </el-card>
        <br>
        <el-form
          ref="form"
          :model="dataTrx"
          label-width="250px"
          :label-position="labelPosition"
        >
          <el-form-item :label="$t('jadwal.table.foto')" prop="foto">
            <el-upload
              class="upload-demo"
              action="https://jsonplaceholder.typicode.com/posts/"
              :limit="1"
              :before-upload="beforeAvatarUpload"
              :on-success="handleFotoSuccess"
              :file-list="dataTrx.foto"
            >
              <el-button size="small" type="primary">Click to upload</el-button>
              <div slot="tip" class="el-upload__tip">jpg/png files with a size less than 2MB</div>
            </el-upload>
          </el-form-item>

          <el-form-item :label="$t('jadwal.table.identitas')" prop="identitas">
            <el-upload
              class="upload-demo"
              :limit="1"
              :before-upload="beforeAvatarUpload"
              :on-success="handleIdentitasSuccess"
              :file-list="dataTrx.identitas"
            >
              <el-button size="small" type="primary">Click to upload</el-button>
              <div slot="tip" class="el-upload__tip">jpg/png files with a size less than 2MB</div>
            </el-upload>
          </el-form-item>

          <el-form-item :label="$t('jadwal.table.raport')" prop="identitas">
            <el-upload
              class="upload-demo"
              :limit="1"
              :before-upload="beforeAvatarUpload"
              :on-success="handleRaportSuccess"
              :file-list="dataTrx.raport"
            >
              <el-button size="small" type="primary">Click to upload</el-button>
              <div slot="tip" class="el-upload__tip">jpg/png files with a size less than 2MB</div>
            </el-upload>
          </el-form-item>

          <el-form-item :label="$t('jadwal.table.sertifikat')" prop="identitas">
            <el-upload
              class="upload-demo"
              :limit="1"
              :before-upload="beforeAvatarUpload"
              :on-success="handleSertifikatSuccess"
              :file-list="dataTrx.sertifikat"
            >
              <el-button size="small" type="primary">Click to upload</el-button>
              <div slot="tip" class="el-upload__tip">jpg/png files with a size less than 2MB</div>
            </el-upload>
          </el-form-item>
        </el-form>
        <br>
      </div>

      <div v-if="active === 2" class="form">
        <h3>FR-APL 02 ASESMEN MANDIRI</h3>
        <p>
          Pastikan anda kompeten sesuai dengan elemen dan kuk yang ada pada setiap unit-unit kompetensi berikuti ini.
          Pasangkan elemen/kuk dengan bukti pendukung yang telah anda sebutkan sebelumnya.
        </p>
        <el-divider />

        <el-table
          v-loading="loading"
          :data="listKuk"
          border
          fit
          highlight-current-row
          row-key="index"
          default-expand-all
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center' }"
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
            label="K / BK"
            min-width="80px"
          >
            <template slot="header">
              <span>K / BK</span>
              <el-select v-model="kompeten" class="filter-item" placeholder="B/BK" @change="allKompeten()">
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
            label="Bukti Pendukung"
            min-width="80px"
          >
            <template slot-scope="scope">
              <el-select
                v-if="scope.row.type === 'kuk'"
                v-model="scope.row.bukti_pendukung"
                placeholder="pilih tingkatan kelas"
                disabled
              >
                <el-option label="Raport" value="raport" />
                <el-option label="KTP" value="ktp" />
                <el-option label="Sertifikat" value="sertifikat" />
              </el-select>
            </template>
          </el-table-column>
        </el-table>
        <br>
        <br>
      </div>
      <el-button @click="back">Prev</el-button>
      <el-button v-if="active !== 2" type="primary" @click="onSubmit">Next</el-button>
      <el-button v-else type="primary" @click="sendData">Submit</el-button>
      <router-link :to="{ name: 'homepage' }">
        <el-button style="margin-top: 12px">back to home</el-button>
      </router-link>
    </el-main>
  </el-container>
</template>

<script>
import Resource from '@/api/resource';
const ujiKompResource = new Resource('uji-komp-post');
const jadwalResource = new Resource('jadwal-get');
const skemaResource = new Resource('skema-get');
const tukResource = new Resource('tuk-get');

export default {
  components: {},
  data() {
    return {
      kompeten: 0,
      loading: true,
      listSkema: null,
      listTuk: null,
      listJadwal: null,
      listKuk: [],
      selectedSkema: {},
      dataTrx: {},
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
      rules: {
        id_jadwal: [{ required: true, message: 'Jadwal is required', trigger: 'change' }],
        nama_lengkap: [{ required: true, message: 'Nama Lengkap is required', trigger: 'blur' }],
        email: [
          { required: true, message: 'Email is required', trigger: 'blur' },
          { type: 'email', message: 'Please input correct email address', trigger: ['blur', 'change'] },
        ],
      },
    };
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.onResize);
  },
  mounted() {
    window.addEventListener('resize', this.onResize);
    this.onResize();
    this.allKompeten();
  },
  created() {
    this.loading = true;
    this.getListSkema();
    this.getListTuk();
    this.getListJadwal();
    this.loading = false;
  },
  methods: {
    allKompeten() {
      this.loading = true;
      this.listKuk.forEach((element, index) => {
        element['is_kompeten'] = this.kompeten;
      });
      // for (var i = 0; i < this.listKuk.length; i++) {
      //   if (this.listKuk[i].type === 'kuk'){
      //     this.listKuk[i].is_kompeten = data;
      //     console.log(this.listKuk[i].is_kompeten);
      //     console.log(data);
      //   }
      // }
      this.loading = false;
    },
    async getListSkema() {
      const { data } = await skemaResource.list();
      this.listSkema = data;
    },
    async getListTuk() {
      const { data } = await tukResource.list();
      this.listTuk = data;
    },
    async getListJadwal() {
      const { data } = await jadwalResource.list();
      this.listJadwal = data;
    },
    onJadwalSelect() {
      var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      var skemaId = this.listSkema.find((x) => x.id === jadwal.id_skema);
      this.selectedSkema = skemaId;
      var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.dataTrx.id_skema = skemaId.id;
      this.dataTrx.id_tuk = tukId.id;
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
            element['is_kompeten'] = 0;
            element['bukti_pendukung'] = 'raport';
            kuk.push(element);
          });
        });
      });
      // var elemen = unitKomp.elemen;
      // var kuk = elemen.kuk;
      this.listKuk = kuk;
      console.log(this.listKuk);
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
    reset() {
      this.dataTrx = {};
    },
    sendData() {
      this.loading = true;
      this.dataTrx.detail_apl_02 = this.listKuk;
      console.log(this.dataTrx);
      ujiKompResource
        .store(this.dataTrx)
        .then(response => {
          this.$message({
            message: 'New Uji Kompetensi ' + this.dataTrx.nama_lengkap + ' has been created successfully.',
            type: 'success',
            duration: 5 * 1000,
          });
          this.reset();
          this.$router.push({ name: 'home' });
        })
        .catch(error => {
          console.log(error);
          this.loading = false;
        })
        .finally(() => {
          this.loading = false;
        });
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
