<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input v-model="query.keyword" :placeholder="$t('table.keyword')" style="width: 200px;" class="filter-item" @keyup.enter.native="handleFilter" />
      <el-button v-waves class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter">
        {{ $t('table.search') }}
      </el-button>
      <el-button class="filter-item" style="margin-left: 10px;" type="primary" icon="el-icon-plus" @click="handleCreate">
        {{ $t('table.add') }}
      </el-button>
    </div>

    <el-table v-loading="loading" :data="list" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="No" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.index }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('kkni.table.nama')">
        <template slot-scope="scope">
          <span>{{ scope.row.nama }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('kkni.table.jurusan')">
        <template slot-scope="scope">
          <span>{{ scope.row.jurusan }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('kkni.table.tahun')">
        <template slot-scope="scope">
          <span>{{ scope.row.tahun }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Actions" width="120">
        <template slot-scope="scope">
          <el-button-group>
            <el-tooltip class="item" effect="dark" content="Update" placement="top-end">
              <el-button v-permission="['manage user']" type="success" size="small" icon="el-icon-edit" @click="handleUpdate(scope.row)" />
            </el-tooltip>
          </el-button-group>
          <el-button-group>
            <el-tooltip class="item" effect="dark" content="Delete" placement="top-end">
              <el-button v-permission="['manage user']" type="danger" size="small" icon="el-icon-delete" @click="handleDelete(scope.row)" />
            </el-tooltip>
          </el-button-group>
        </template>
      </el-table-column>

    </el-table>

    <pagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" @pagination="getList" />

    <el-dialog :title="$t('kkni.dialog.addNew')" :visible.sync="dialogFormVisible">
      <div v-loading="kkniCreating" class="form-container">
        <el-form ref="newForm" :rules="rules" :model="dataTrx" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item :label="$t('kkni.table.nama')" prop="nama">
            <el-input v-model="dataTrx.nama" />
          </el-form-item>
          <el-form-item :label="$t('kkni.table.jurusan')" prop="jurusan">
            <el-input v-model="dataTrx.jurusan" />
          </el-form-item>
          <el-form-item :label="$t('kkni.table.tahun')" prop="tahun">
            <el-input v-model="dataTrx.tahun" />
          </el-form-item>
          <el-form-item :label="$t('kkni.table.uploadPath')" prop="upload_path">
            <el-upload
              ref="upload_path_create"
              class="upload-demo"
              action=""
              :auto-upload="false"
              :on-change="handleUploadSuccess"
            >
              <el-button slot="trigger" size="small" type="primary">select file</el-button>
              <div slot="tip" style="font-size: 12px; color: rgba(255, 0, 0, 0.8);">{{ fileIsRequired }}</div>
              <div slot="tip" style="font-size: 12px; color: rgba(255, 0, 0, 0.8);">{{ fileIsPdf }}</div>
            </el-upload>
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

    <el-dialog :title="$t('kkni.dialog.edit') + ' ' + editedKkni.nama" :visible.sync="dialogFormUpdateIsVisible">
      <div v-loading="kkniCreating" class="form-container">
        <el-form ref="kkniForm" :rules="rules" :model="editedKkni" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item :label="$t('kkni.table.nama')" prop="nama">
            <el-input v-model="editedKkni.nama" />
          </el-form-item>
          <el-form-item :label="$t('kkni.table.jurusan')" prop="jurusan">
            <el-input v-model="editedKkni.jurusan" />
          </el-form-item>
          <el-form-item :label="$t('kkni.table.tahun')" prop="tahun">
            <el-input v-model="editedKkni.tahun" />
          </el-form-item>
          <el-form-item :label="$t('kkni.table.uploadPath')" prop="upload_path">
            <el-upload
              ref="upload_path_edit"
              class="upload-demo"
              action=""
              :auto-upload="false"
              :on-change="handleUploadSuccessEdit"
            >
              <el-button slot="trigger" size="small" type="primary">select file</el-button>
              <div slot="tip" style="font-size: 12px; color: rgba(255, 0, 0, 0.8);">{{ fileIsRequired }}</div>
              <div slot="tip" style="font-size: 12px; color: rgba(255, 0, 0, 0.8);">{{ fileIsPdf }}</div>
              <div v-if="isSelect" slot="tip" class="el-upload__tip">Select file untuk mengganti file KKNI</div>
            </el-upload>
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormUpdateVisible()">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button type="primary" @click="updateData()">
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import permission from '@/directive/permission'; // Permission directive

const kkniResource = new Resource('kkni');
const kkniUpdateResource = new Resource('kkni/update');

export default {
  name: 'UserList',
  components: { Pagination },
  directives: { waves, permission },
  data(){
    return {
      list: null,
      fileIsRequired: '',
      fileIsPdf: '',
      isSelect: true,
      filename: '',
      total: 0,
      loading: true,
      downloading: false,
      kkniCreating: false,
      dialogFormVisible: false,
      dialogFormUpdateIsVisible: false,
      pdf: null,
      dataTrx: {},
      editedKkni: {
        id: 0,
        nama: '',
        jurusan: '',
        tahun: '',
        upload_path: '',
      },
      query: {
        page: 1,
        limit: 15,
        keyword: '',
        role: '',
      },
      rules: {
        nama: [{ required: true, message: 'Nama is required', trigger: 'change' }],
        jurusan: [{ required: true, message: 'Jurusan is required', trigger: 'blur' }],
        tahun: [{ required: true, message: 'Tahun is required', trigger: 'blur' }],
      },
    };
  },
  created() {
    this.getList();
  },
  methods: {
    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      const { data, meta } = await kkniResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.total = meta.total;
      this.loading = false;
      // console.log(this.list);
    },
    handleFilter() {
      this.query.page = 1;
      this.getList();
    },
    resetdataTrx() {
      this.dataTrx = {};
    },
    resetEditedKkni(){
      this.editedKkni = {};
    },
    handleCreate() {
      this.resetdataTrx();
      this.fileIsRequired = '';
      this.fileIsPdf = '';
      this.dialogFormVisible = true;
      if (this.$refs.upload_path_create) {
        const length = this.$refs.upload_path_create.uploadFiles.length;
        this.$refs.upload_path_create.uploadFiles.splice(0, length);
      }
      this.$nextTick(() => {
        this.$refs['newForm'].clearValidate();
      });
    },
    handleDelete(data) {
      var deleteData = data;
      this.$confirm('This will permanently delete ' + deleteData.nama + ', Continue?', 'Warning', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(() => {
        kkniResource.destroy(deleteData.id).then(response => {
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
          message: 'Delete canceled',
        });
      });
    },
    dialogFormUpdateVisible(){
      this.dialogFormUpdateIsVisible = false;
      this.getList();
    },
    submit(){
      this.loading = true;
      this.$refs['newForm'].validate((valid) => {
        if (valid) {
          const uploadData = new FormData();
          uploadData.append('nama', this.dataTrx.nama);
          uploadData.append('jurusan', this.dataTrx.jurusan);
          uploadData.append('tahun', this.dataTrx.tahun);
          uploadData.append('file', this.dataTrx.upload_path);
          this.kkniCreating = true;
          if (this.$refs.upload_path_create.uploadFiles.length === 0) {
            this.fileIsRequired = 'File is required';
            this.kkniCreating = false;
            this.loading = false;
          } else {
            kkniResource
              .store(uploadData)
              .then(() => {
                // console.log(this.dataTrx);
                this.$message({
                  message: 'New File ' + this.dataTrx.nama + ' has been created successfully.',
                  type: 'success',
                  duration: 5 * 1000,
                });
                this.resetdataTrx();
                this.$refs.upload_path_create.handleRemove();
                this.dialogFormVisible = false;
                this.handleFilter();
              })
              .catch(error => {
                console.log(error);
              })
              .finally(() => {
                this.loading = false;
                this.kkniCreating = false;
              });
          }
        } else {
          this.loading = false;
          // console.log(this.dataTrx);
          // console.log('error submit!!');
          return false;
        }
      });
    },
    handleUpdate(kkni) {
      this.isSelect = true;
      this.editedKkni = kkni;
      if (this.$refs.upload_path_edit) {
        const length = this.$refs.upload_path_edit.uploadFiles.length;
        this.$refs.upload_path_edit.uploadFiles.splice(0, length);
      }
      this.dialogFormUpdateIsVisible = true;
    },
    updateData() {
      this.loading = true;
      const uploadData = new FormData();
      uploadData.append('id', this.editedKkni.id);
      uploadData.append('nama', this.editedKkni.nama);
      uploadData.append('jurusan', this.editedKkni.jurusan);
      uploadData.append('tahun', this.editedKkni.tahun);
      uploadData.append('file', this.editedKkni.upload_path);
      // console.log(this.editedKkni);
      this.kkniCreating = true;
      kkniUpdateResource
        .store(uploadData)
        .then((response) => {
          // console.log(response);
          this.getList();
          this.resetEditedKkni();
          this.dialogFormUpdateIsVisible = false;
          this.$notify({
            title: 'Success',
            message: 'Updated successfully',
            type: 'success',
            duration: 2000,
          });
          this.$refs.upload_path_edit.handleRemove();
        })
        .catch(error => {
          console.log(error);
        })
        .finally(() => {
          this.loading = true;
          this.kkniCreating = false;
        });
    },
    handleUploadSuccess(e) {
      this.fileIsRequired = '';
      const length = this.$refs.upload_path_create.uploadFiles.length;
      if (length === 2) {
        this.$refs.upload_path_create.uploadFiles.splice(0, 1);
        this.dataTrx.upload_path = this.$refs.upload_path_create.uploadFiles[0].raw;
      } else {
        this.dataTrx.upload_path = this.$refs.upload_path_create.uploadFiles[0].raw;
      }
      if (this.dataTrx.upload_path.type !== 'application/pdf') {
        this.fileIsPdf = 'File type must be pdf';
        this.$refs.upload_path_create.uploadFiles.splice(0, length);
      } else {
        this.fileIsPdf = '';
      }
      console.log(this.dataTrx.upload_path);
    },
    handleUploadSuccessEdit(e) {
      const length = this.$refs.upload_path_edit.uploadFiles.length;
      console.log(this.$refs.upload_path_edit.uploadFiles);
      if (length === 2) {
        this.$refs.upload_path_edit.uploadFiles.splice(0, 1);
        this.editedKkni.upload_path = this.$refs.upload_path_edit.uploadFiles[0].raw;
      } else {
        this.editedKkni.upload_path = this.$refs.upload_path_edit.uploadFiles[0].raw;
      }
      if (this.editedKkni.upload_path.type !== 'application/pdf') {
        this.fileIsPdf = 'File type must be pdf';
        this.$refs.upload_path_edit.uploadFiles.splice(0, length);
      } else {
        this.fileIsPdf = '';
      }
      this.isSelect = false;
    },
    handleDownload() {
      this.downloading = true;
      import('@/vendor/Export2Excel').then(excel => {
        const tHeader = ['Nama', 'Jurusan', 'Tahun', 'Upload File'];
        const filterVal = ['Nama', 'Jurusan', 'Tahun', 'Upload File'];
        const data = this.formatJson(filterVal, this.list);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: 'kkni-list',
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
