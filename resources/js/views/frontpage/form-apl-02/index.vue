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
              style="width: 100%"
              @change="onJadwalSelect()"
            >
              <el-option
                v-for="item in listJadwal"
                :key="item.id"
                :label="item.jadwal + ' / ' + item.nama_asesor + ' / ' + item.start_date"
                :value="item.id"
              />
            </el-select>
          </el-form-item>

          <el-form-item :label="$t('skema.table.skema')" prop="skema_id">
            <el-select
              v-model="dataTrx.id_skema"
              disabled
              class="filter-item full"
              :placeholder="$t('skema.table.skema')"
              style="width: 100%"
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
              disabled
              class="filter-item full"
              placeholder="Pilih TUK"
              style="width: 100%"
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

          <el-form-item label="NIK" prop="nik">
            <el-input v-model="dataTrx.nik" />
            <br>
            <el-button icon="el-icon-search" type="primary" @click="findNik(dataTrx.nik)" />
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
                format="yyyy-MM-dd"
                value-format="yyyy-MM-dd"
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
          <el-form-item label="No HP" prop="no_hp">
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
          :rules="rules"
          label-width="250px"
          :label-position="labelPosition"
        >
          <el-form-item :label="$t('jadwal.table.foto')" prop="foto">
            <input type="file" @change="handleFotoSuccess">
          </el-form-item>
          <el-form-item :label="$t('jadwal.table.identitas')" prop="identitas">
            <input type="file" @change="handleIdentitasSuccess">
          </el-form-item>
          <el-form-item :label="$t('jadwal.table.raport')" prop="raport">
            <input type="file" @change="handleRaportSuccess">
          </el-form-item>
          <el-form-item :label="$t('jadwal.table.sertifikat')" prop="sertifikat">
            <input type="file" @change="handleSertifikatSuccess">
          </el-form-item>
        </el-form>
        <br>
      </div>

      <div v-if="active === 2" v-loading="loading" class="form">
        <h3>FR-APL 02 ASESMEN MANDIRI</h3>
        <p>
          Pastikan anda kompeten sesuai dengan elemen dan kuk yang ada pada
          setiap unit-unit kompetensi berikuti ini. Pasangkan elemen/kuk dengan
          bukti pendukung yang telah anda sebutkan sebelumnya.
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

          <el-table-column align="center" label="K / BK" min-width="80px">
            <template slot="header">
              <span>K / BK</span>
              <el-select
                v-model="kompeten"
                class="filter-item"
                placeholder="B/BK"
                @change="allKompeten()"
              >
                <el-option :key="0" label="Kompeten" :value="0" />
                <el-option :key="1" label="Belum Kompeten" :value="1" />
              </el-select>
            </template>
            <template slot-scope="scope">
              <el-select
                v-if="scope.row.type === 'kuk'"
                v-model="scope.row.is_kompeten"
                class="filter-item"
                placeholder="B/BK"
              >
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
        <img :src="testPng">
      </div>
      <el-button @click="back">Prev</el-button>
      <el-button v-if="active !== 2" type="primary" @click="onSubmit">Next</el-button>
      <el-button v-else type="primary" @click="checkUser">Submit</el-button>
      <!-- <el-button type="primary" @click="checkUser">Save</el-button> -->
      <router-link :to="{ name: 'homepage' }">
        <el-button style="margin-top: 12px">back to home</el-button>
      </router-link>
    </el-main>
    <el-dialog :title="'Create new user'" :visible.sync="dialogNewUser">
      <div v-loading="loading" class="form-container">
        <el-form
          ref="userForm"
          :rules="rules"
          :model="dataTrx"
          label-position="left"
          label-width="150px"
          style="max-width: 500px"
        >
          <el-form-item :label="$t('user.name')" prop="name">
            <el-input v-model="dataTrx.nama_lengkap" />
          </el-form-item>
          <el-form-item :label="$t('user.email')" prop="email">
            <el-input v-model="dataTrx.email" />
          </el-form-item>
          <el-form-item :label="$t('user.password')" prop="password">
            <el-input v-model="dataTrx.password" show-password />
          </el-form-item>
          <el-form-item :label="$t('user.confirmPassword')" prop="confirmPassword">
            <el-input v-model="dataTrx.confirmPassword" show-password />
          </el-form-item>
          <el-form-item
            label="Tanda Tangan"
          >
            <vueSignature
              ref="signature"
              :sig-option="option"
              :w="'300px'"
              :h="'150px'"
              :disabled="false"
              style="border-style: outset"
            />
            <el-button size="small" @click="clear">Clear</el-button>
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button v-loading="loading" type="primary" :disbled="loading" @click="newUser()">
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>
  </el-container>
</template>

<script>
import vueSignature from 'vue-signature';
import Resource from '@/api/resource';
const ujiKompResource = new Resource('uji-komp-post');
const nikResource = new Resource('find-nik');
const jadwalResource = new Resource('jadwal-get');
const skemaResource = new Resource('skema-get');
const tukResource = new Resource('tuk-get');
const checkUserResource = new Resource('check-user-uji');
const newUserResource = new Resource('new-user-uji');

export default {
  components: {
    vueSignature,
  },
  data() {
    var validateConfirmPassword = (rule, value, callback) => {
      if (value !== this.dataTrx.password) {
        callback(new Error('Password is mismatched!'));
      } else {
        callback();
      }
    };
    return {
      option: {
        penColor: 'rgb(0, 0, 0)',
        backgroundColor: 'rgb(255,255,255)',
      },
      dataUrl: 'https://avatars2.githubusercontent.com/u/17644818?s=460&v=4',
      kompeten: 0,
      loading: false,
      listSkema: null,
      listTuk: null,
      listJadwal: null,
      listKuk: [],
      selectedSkema: {},
      dataTrx: {},
      testPng: null,
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
      dialogImageUrl: null,
      dialogImageVisible: false,
      active: 0,
      isWide: true,
      dialogNewUser: false,
      labelPosition: 'left',
      rules: {
        id_jadwal: [
          { required: true, message: 'Jadwal is required', trigger: 'change' },
        ],
        nik: [
          { required: true, message: 'Nik is required', trigger: 'change' },
        ],
        no_hp: [
          { required: true, message: 'No HP is required', trigger: 'change' },
        ],
        nama_lengkap: [
          {
            required: true,
            message: 'Nama Lengkap is required',
            trigger: 'blur',
          },
        ],
        email: [
          { required: true, message: 'Email is required', trigger: 'blur' },
          {
            type: 'email',
            message: 'Please input correct email address',
            trigger: ['blur', 'change'],
          },
        ],
        password: [
          { required: true, message: 'Password is required', trigger: 'blur' },
        ],
        confirmPassword: [
          { validator: validateConfirmPassword, trigger: 'blur' },
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
    // this.allKompeten();
  },
  created() {
    this.loading = true;
    this.getListSkema();
    this.getListTuk();
    this.getListJadwal();
    this.loading = false;
  },
  methods: {
    async findNik(nik) {
      this.loading = true;
      await nikResource.list({ nik: nik })
        .then((response) => {
          this.dataTrx.nama_lengkap = response.nama_lengkap;
          this.dataTrx.nama_sekolah = response.nama_sekolah;
          this.dataTrx.tempat_lahir = response.tempat_lahir;
          this.dataTrx.tanggal_lahir = response.tanggal_lahir;
          this.dataTrx.jenis_kelamin = response.jenis_kelamin;
          this.dataTrx.alamat = response.alamat;
          this.dataTrx.no_hp = response.no_hp;
          this.dataTrx.email = response.email;
          this.dataTrx.kode_pos = response.kode_pos;
          this.dataTrx.tingkatan_kelas = response.tingkatan_kelas;
          // this.dialogNewUser = false;
        })
        .catch((error) => {
          console.log(error);
          this.dataTrx.nama_lengkap = '';
          this.dataTrx.nama_sekolah = '';
          this.dataTrx.tempat_lahir = '';
          this.dataTrx.tanggal_lahir = '';
          this.dataTrx.jenis_kelamin = '';
          this.dataTrx.alamat = '';
          this.dataTrx.kode_pos = '';
          this.dataTrx.no_hp = '';
          this.dataTrx.email = '';
          this.dataTrx.tingkatan_kelas = '';
        })
        .finally(() => {
          this.loading = false;
        });
    },
    saveSign() {
      var _this = this;
      var png = _this.$refs.signature.save();
      this.testPng = _this.$refs.signature.save();
      var jpeg = _this.$refs.signature.save('image/jpeg');
      var svg = _this.$refs.signature.save('image/svg+xml');
      console.log(png);
      console.log(jpeg);
      console.log(svg);
    },
    allKompeten() {
      for (var i = 0; i < this.listKuk.length; i++) {
        this.loading = true;
        if (this.listKuk[i].type === 'kuk'){
          this.listKuk[i].is_kompeten = this.kompeten;
          console.log(this.listKuk[i]);
        }
        this.loading = false;
      }
    },
    handlePictureCardPreview(file) {
      this.dialogImageUrl = file.url;
      this.dialogImageVisible = true;
    },
    async getListSkema() {
      const { data } = await skemaResource.list({ limit: 1000 });
      this.listSkema = data;
    },
    async getListTuk() {
      const { data } = await tukResource.list({ limit: 1000 });
      this.listTuk = data;
    },
    async getListJadwal() {
      const { data } = await jadwalResource.list({ limit: 1000 });
      this.listJadwal = data;
    },
    onJadwalSelect() {
      this.loading = true;
      var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      var skemaId = this.listSkema.find((x) => x.id === jadwal.id_skema);
      this.selectedSkema = skemaId;
      var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.dataTrx.id_skema = skemaId.id;
      this.dataTrx.id_tuk = tukId.id;
      this.getKuk();
      this.loading = false;
    },
    getKuk() {
      this.loading = true;
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
      this.loading = false;
    },
    onSubmit() {
      this.$refs.form.validate(valid => {
        if (valid) {
          if (this.active++ > 2) {
            this.active = 0;
            return;
          }
        } else {
          return;
        }
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
    handleFotoSuccess(e) {
      const files = e.target.files;
      const rawFile = files[0]; // only use files[0]
      this.dataTrx.foto = rawFile;
    },
    handleIdentitasSuccess(e) {
      const files = e.target.files;
      const rawFile = files[0]; // only use files[0]
      this.dataTrx.identitas = rawFile;
    },
    handleRaportSuccess(e) {
      const files = e.target.files;
      const rawFile = files[0]; // only use files[0]
      this.dataTrx.raport = rawFile;
    },
    handleSertifikatSuccess(e) {
      const files = e.target.files;
      const rawFile = files[0]; // only use files[0]
      this.dataTrx.sertifikat = rawFile;
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
    newUser() {
      this.loading = true;
      this.dataTrx.signature = this.$refs.signature.save();
      const formData = new FormData();
      formData.append('id_skema', this.dataTrx.id_skema);
      formData.append('id_tuk', this.dataTrx.id_tuk);
      formData.append('id_jadwal', this.dataTrx.id_jadwal);
      formData.append('nik', this.dataTrx.nik);
      formData.append('nama_lengkap', this.dataTrx.nama_lengkap);
      formData.append('nama_sekolah', this.dataTrx.nama_sekolah);
      formData.append('tempat_lahir', this.dataTrx.tempat_lahir);
      formData.append('tanggal_lahir', this.dataTrx.tanggal_lahir);
      formData.append('jenis_kelamin', this.dataTrx.jenis_kelamin);
      formData.append('alamat', this.dataTrx.alamat);
      formData.append('kode_pos', this.dataTrx.kode_pos);
      formData.append('no_hp', this.dataTrx.no_hp);
      formData.append('email', this.dataTrx.email);
      formData.append('tingkatan', this.dataTrx.tingkatan);
      // formData.append('detail_apl_02', this.dataTrx.detail_apl_02);
      formData.append('foto', this.dataTrx.foto);
      formData.append('identitas', this.dataTrx.identitas);
      formData.append('raport', this.dataTrx.raport);
      formData.append('sertifikat', this.dataTrx.sertifikat);
      formData.append('password', this.dataTrx.password);
      formData.append('confirmPassowrd', this.dataTrx.confirmPassowrd);
      formData.append('signature', this.dataTrx.signature);
      console.log(formData);
      // newUserResource
      //   .store(formData)
      //   .then((response) => {
      //     this.sendData();
      //     // this.dialogNewUser = false;
      //   })
      //   .catch((error) => {
      //     console.log(error);
      //     this.loading = false;
      //   })
      //   .finally(() => {
      //     this.loading = false;
      //   });
      if (this.$refs.signature.isEmpty()){
        this.$message({
          message:
            'Tanda tangan tidak boleh kosong!',
          type: 'error',
          duration: 5 * 1000,
        });
        this.loading = false;
      } else {
        newUserResource
          .store(formData)
          .then((response) => {
            this.sendData();
            // this.dialogNewUser = false;
          })
          .catch((error) => {
            console.log(error);
            this.loading = false;
          })
          .finally(() => {
            this.loading = false;
          });
      }
    },
    checkUser() {
      this.loading = true;
      checkUserResource
        .store(this.dataTrx)
        .then((response) => {
          if (response.msg === 'User sudah terdaftar') {
            this.sendData(); // sekarang pendaftaran bisa duplikat email
          } else {
            this.dialogNewUser = true;
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
          this.loading = false;
        })
        .finally(() => {
          this.loading = false;
        });
    },
    clear() {
      var _this = this;
      _this.$refs.signature.clear();
    },
    sendData() {
      this.loading = true;
      this.dataTrx.detail_apl_02 = this.listKuk;
      const uploadData = new FormData();
      uploadData.append('id_skema', this.dataTrx.id_skema);
      uploadData.append('id_tuk', this.dataTrx.id_tuk);
      uploadData.append('id_jadwal', this.dataTrx.id_jadwal);
      uploadData.append('nik', this.dataTrx.nik);
      uploadData.append('nama_lengkap', this.dataTrx.nama_lengkap);
      uploadData.append('nama_sekolah', this.dataTrx.nama_sekolah);
      uploadData.append('tempat_lahir', this.dataTrx.tempat_lahir);
      uploadData.append('tanggal_lahir', this.dataTrx.tanggal_lahir);
      uploadData.append('jenis_kelamin', this.dataTrx.jenis_kelamin);
      uploadData.append('alamat', this.dataTrx.alamat);
      uploadData.append('kode_pos', this.dataTrx.kode_pos);
      uploadData.append('no_hp', this.dataTrx.no_hp);
      uploadData.append('email', this.dataTrx.email);
      uploadData.append('tingkatan', this.dataTrx.tingkatan);
      var arrayDetail = JSON.stringify(this.dataTrx.detail_apl_02);
      uploadData.append('detail_apl_02', arrayDetail);
      uploadData.append('foto', this.dataTrx.foto);
      uploadData.append('identitas', this.dataTrx.identitas);
      uploadData.append('raport', this.dataTrx.raport);
      uploadData.append('sertifikat', this.dataTrx.sertifikat);
      uploadData.append('password', this.dataTrx.password);
      uploadData.append('confirmPassowrd', this.dataTrx.confirmPassowrd);
      console.log(uploadData);
      ujiKompResource
        .store(uploadData)
        .then((response) => {
          this.$message({
            message:
              'New Uji Kompetensi ' +
              this.dataTrx.nama_lengkap +
              ' has been created successfully.',
            type: 'success',
            duration: 5 * 1000,
          });
          this.dialogNewUser = false;
          this.reset();
          this.$router.push({ name: 'login' });
        })
        .catch((error) => {
          console.log(error);
          this.$message({
            message: error,
            type: 'error',
            duration: 5 * 1000,
          });
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
.excel-upload-input{
  display: none;
  z-index: -9999;
}
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
