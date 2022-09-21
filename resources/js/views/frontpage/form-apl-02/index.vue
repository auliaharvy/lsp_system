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
      <div class="form">
        <el-form
          ref="form"
          :model="form"
          label-width="250px"
          :label-position="labelPosition"
        >
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
              />
            </el-select>
          </el-form-item>
          <el-form-item label="NIK">
            <el-input v-model="dataTrx.nik" />
          </el-form-item>
          <el-form-item label="Nama Lengkap">
            <el-input v-model="dataTrx.nama_lengkap" />
          </el-form-item>
          <el-form-item label="Nama Sekolah">
            <el-input v-model="dataTrx.nama_sekolah" />
          </el-form-item>
          <el-form-item label="Tempat - Tanggal Lahir">
            <el-col :span="11">
              <el-input v-model="dataTrx.tempal_lahir" />
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
              <el-radio label="Laki - Laki" />
              <el-radio label="Perempuan" />
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
          <el-form-item label="Email">
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
              />
            </el-select>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" @click="onSubmit">Create</el-button>
            <el-button>Cancel</el-button>
          </el-form-item>
        </el-form>
      </div>
      <router-link :to="{ name: 'homepage' }">
        <el-button style="margin-top: 12px">back to home</el-button>
      </router-link>
    </el-main>
  </el-container>
</template>

<script>
import Resource from '@/api/resource';
const skemaResource = new Resource('skema-get');
const tukResource = new Resource('tuk-get');

export default {
  components: {},
  data() {
    return {
      listSkema: null,
      listTuk: null,
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
    this.getListSkema();
    this.getListTuk();
  },
  methods: {
    async getListSkema() {
      const { data } = await skemaResource.list();
      this.listSkema = data;
    },
    async getListTuk() {
      const { data } = await tukResource.list();
      this.listTuk = data;
    },
    onSubmit() {
      if (this.active++ > 2) {
        this.active = 0;
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
