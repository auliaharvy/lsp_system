<template>
  <div class="app-container">
    <div class="filter-container">
      <h3>Perangkat IA 02</h3>
      <el-button class="filter-item" style="margin-left: 10px;" type="primary" icon="el-icon-plus" @click="handleCreate">
        {{ $t('table.add') }}
      </el-button>
    </div>

    <el-table v-loading="loading" :data="list" border fit highlight-current-row style="width: 100%" :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }">
      <el-table-column align="center" label="No" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.index }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('skema.perangkat.filename')">
        <template slot-scope="scope">
          <span>{{ scope.row.filename }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('skema.perangkat.version')">
        <template slot-scope="scope">
          <span>{{ scope.row.versi }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Actions" width="120">
        <template slot-scope="scope">
          <el-button-group>
            <el-tooltip class="item" effect="dark" content="Update" placement="top-end">
              <el-button v-permission="['manage user']" type="success" size="small" icon="el-icon-edit" @click="handleUpdate(scope.row)" />
            </el-tooltip>
            <el-tooltip class="item" effect="dark" content="Liat File" placement="top-end">
              <a :href="'/' + scope.row.file" target="_blank">
                <el-button v-permission="['manage user']" type="primary" size="small" icon="el-icon-view" />
              </a>
            </el-tooltip>
          </el-button-group>
        </template>
      </el-table-column>

    </el-table>

    <pagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" @pagination="getList" />

    <el-dialog :title="$t('skema.dialog.addNew')" :visible.sync="dialogFormVisible">
      <div v-loading="creating" class="form-container">
        <el-form ref="newForm" :rules="rules" :model="dataTrx" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item :label="$t('skema.perangkat.filename')" prop="filename">
            <el-input v-model="dataTrx.filename" />
          </el-form-item>
          <el-form-item :label="$t('skema.perangkat.file')" prop="file">
            <input type="file" @change="handleUploadSuccess">
          </el-form-item>
          <el-form-item :label="$t('skema.perangkat.versi')" prop="versi">
            <el-input v-model="dataTrx.versi" />
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button type="primary" @click="submit()">
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>

  </div>
</template>

<script>
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import UserResource from '@/api/user';
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import permission from '@/directive/permission'; // Permission directive

const userResource = new UserResource();
const listResource = new Resource('mst-ia02-get');
const postResource = new Resource('new-mst-ia-02');
const skemaResource = new Resource('skema');

export default {
  name: 'MstIa02',
  components: { Pagination },
  directives: { waves, permission },
  props: {
    idSkema: {
      type: Number,
      default: 1,
    },
    userId: {
      type: Number,
      default: 1,
    },
  },
  data() {
    return {
      list: null,
      listSkema: null,
      total: 0,
      loading: true,
      downloading: false,
      creating: false,
      dialogFormVisible: false,
      dialogFormUpdateVisible: false,
      kategori: [],
      dataTrx: {},
      editedSkema: {
        id: 0,
        id_skema: '',
        file: '',
        filename: '',
        versi: '',
      },
      query: {
        page: 1,
        limit: 15,
        keyword: '',
      },
      rules: {
        filename: [{ required: true, message: 'Filename is required', trigger: 'blur' }],
        version: [{ required: true, message: 'Versi is required', trigger: 'blur' }],
        file: [{ required: true, message: 'File is required', trigger: 'blur' }],
      },
    };
  },
  created() {
    this.getList();
    this.getListKategori();
  },
  methods: {
    async getList() {
      const { limit, page } = this.query;
      this.query.id_skema = this.idSkema;
      this.loading = true;
      const { data, meta } = await listResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.total = meta.total;
      this.loading = false;
    },
    async getListSkema() {
      this.loading = true;
      const { data } = await skemaResource.list();
      this.listSkema = data;
      this.loading = false;
    },
    handleUploadSuccess(e) {
      const files = e.target.files;
      const rawFile = files[0]; // only use files[0]
      this.dataTrx.file = rawFile;
    },
    handleFilter() {
      this.query.page = 1;
      this.getList();
    },
    resetdataTrx() {
      this.dataTrx = {};
    },
    handleCreate() {
      this.resetdataTrx();
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs['newForm'].clearValidate();
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
    submit() {
      this.loading = true;
      this.dataTrx.id_skema = this.idSkema;
      this.$refs['newForm'].validate((valid) => {
        if (valid) {
          const uploadData = new FormData();
          uploadData.append('id_skema', this.idSkema);
          uploadData.append('versi', this.dataTrx.versi);
          uploadData.append('filename', this.dataTrx.filename);
          uploadData.append('file', this.dataTrx.file);
          uploadData.append('user_id', this.userId);
          this.creating = true;
          postResource
            .store(uploadData)
            .then(response => {
              this.$message({
                message: 'New File ' + this.dataTrx.filename + ' has been created successfully.',
                type: 'success',
                duration: 5 * 1000,
              });
              this.resetdataTrx();
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
    handleUpdate(skema) {
      this.editedSkema = skema;
      this.dialogFormUpdateVisible = true;
      console.log(this.editedSkema);
    },
    updateData() {
      this.loading = true;
      skemaResource.update(this.editedSkema.id, this.editedSkema).then(() => {
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
