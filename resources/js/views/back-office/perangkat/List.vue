<template>
  <div class="app-container">
    <div class="filter-container">
      <el-form ref="newForm" :rules="rules" :model="idSkema" label-position="top" label-width="150px" style="max-width: 100%;">
        <el-form-item label="Pilih Skema" prop="unit">
          <el-select
            v-model="idSkema"
            filterable
            clearable
            class="filter-item full"
            style="width:100%"
            :placeholder="$t('skema.table.skema')"
            @change="getList"
          >
            <el-option
              v-for="item in listSkema"
              :key="item.id"
              :label="item.skema_sertifikasi"
              :value="item.id"
            />
          </el-select>
        </el-form-item>
      </el-form>
    </div>
    <div v-if="idSkema">
      <Ia02 :id-skema="idSkema" :user-id="userId" />
      <Ia03 :id-skema="idSkema" :user-id="userId" />
      <Ia05 :id-skema="idSkema" :user-id="userId" />
      <Ia06 :id-skema="idSkema" :user-id="userId" />
      <Ia07 :id-skema="idSkema" :user-id="userId" />
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import UserResource from '@/api/user';
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import permission from '@/directive/permission'; // Permission directive
import Ia02 from './ia02.vue';
import Ia03 from './ia03.vue';
import Ia05 from './ia05.vue';
import Ia06 from './ia06.vue';
import Ia07 from './ia07.vue';

const userResource = new UserResource();
const perangkatAsesmenResource = new Resource('perangkat-asesmen');
const skemaResource = new Resource('skema');

export default {
  name: 'PerangkatAsemenList',
  components: { Ia02, Ia03, Ia05, Ia06, Ia07 },
  directives: { waves, permission },
  data() {
    return {
      list: null,
      idSkema: null,
      listSkema: null,
      total: 0,
      loading: true,
      downloading: false,
      creating: false,
      dialogFormVisible: false,
      dialogFormUpdateVisible: false,
      newData: {},
      editedData: {
        id: 0,
        kode_tuk: '',
        nama: '',
        alamat: '',
        no_telp: '',
        email: '',
      },
      query: {
        page: 1,
        limit: 1000,
        keyword: '',
        role: '',
      },
      rules: {
        kode_perangkat: [{ required: true, message: 'Kode Perangkat is required', trigger: 'change' }],
        nama_perangkat: [{ required: true, message: 'Nama Perangkat is required', trigger: 'blur' }],
        id_skema: [{ required: true, message: 'Skema Sertifikasi is required', trigger: 'blur' }],
      },
    };
  },
  computed: {
    ...mapGetters([
      'username',
      'userId',
    ]),
  },
  created() {
    this.getList();
  },
  methods: {
    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      // get data skema
      const dataSkema = await skemaResource.list(this.query);
      this.listSkema = dataSkema.data;
      // this.idSkema = this.listSkema[0].id;
      // get data perangkat / list table
      const { data, meta } = await perangkatAsesmenResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.total = meta.total;
      this.loading = false;
    },
    async changeSkema() {
      this.loading = true;
      // get data skema
      // get data perangkat / list table
      this.loading = false;
    },
    handleFilter() {
      this.query.page = 1;
      this.getList();
    },
    resetnewData() {
      this.newData = {};
    },
    handleCreate() {
      this.resetnewData();
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs['dataForm'].clearValidate();
      });
    },
    handleDelete(id, name) {
      this.$confirm('This will permanently delete user ' + name + '. Continue?', 'Warning', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(() => {
        userResource.destroy(id).then(response => {
          this.$message({
            type: 'success',
            message: 'Delete completed',
          });
          this.handleFilter();
        }).catch(error => {
          console.log(error);
        });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: 'Delete canceled',
        });
      });
    },
    create() {
      this.loading = true;
      this.newData.author = this.userId;
      this.$refs['dataForm'].validate((valid) => {
        if (valid) {
          this.creating = true;
          perangkatAsesmenResource
            .store(this.newData)
            .then(response => {
              this.$message({
                message: 'New TUK ' + this.newData.nama + ' has been created successfully.',
                type: 'success',
                duration: 5 * 1000,
              });
              this.resetnewData();
              this.dialogFormVisible = false;
              this.handleFilter();
            })
            .catch(error => {
              console.log(error);
            })
            .finally(() => {
              this.loading = true;
              this.creating = false;
            });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    handleUpdate(tuk) {
      this.editedData = tuk;
      this.dialogFormUpdateVisible = true;
      console.log(this.editedData);
    },
    updateData() {
      this.loading = true;
      perangkatAsesmenResource.update(this.editedData.id, this.editedData).then(() => {
        this.getList();
        this.dialogFormUpdateVisible = false;
        this.$notify({
          title: 'Success',
          message: 'Updated successfully',
          type: 'success',
          duration: 2000,
        });
      })
        .catch(error => {
          console.log(error);
        })
        .finally(() => {
          this.loading = true;
          this.creating = false;
        });
    },
    handleDownload() {
      this.downloading = true;
      import('@/vendor/Export2Excel').then(excel => {
        const tHeader = ['Kode', 'Nama', 'Alamat', 'No telp', 'Email'];
        const filterVal = ['kode_tuk', 'nama', 'alamat', 'no_telp', 'email'];
        const data = this.formatJson(filterVal, this.list);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: 'tuk-list',
        });
        this.downloading = false;
      });
    },
    formatJson(filterVal, jsonData) {
      return jsonData.map(v => filterVal.map(j => v[j]));
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
  .block {
    float: left;
    min-width: 250px;
  }
  .clear-left {
    clear: left;
  }
}
</style>
