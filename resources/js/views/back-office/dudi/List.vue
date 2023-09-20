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
      <el-button v-waves :loading="downloading" class="filter-item" type="primary" icon="el-icon-download" @click="handleDownload">
        {{ $t('table.export') }}
      </el-button>
    </div>

    <el-table v-loading="loading" :data="list" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="No" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.index }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('dudi.table.namaPerusahaan')">
        <template slot-scope="scope">
          <span>{{ scope.row.nama_perusahaan }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('dudi.table.tahunKerjaSama')">
        <template slot-scope="scope">
          <span>{{ scope.row.tahun_kerjasama }}</span>
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

    <el-dialog :title="$t('dudi.dialog.addNew')" :visible.sync="dialogFormVisible">
      <div v-loading="dudiCreating" class="form-container">
        <el-form ref="dudiForm" :rules="rules" :model="newDudi" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item :label="$t('dudi.table.namaPerusahaan')" prop="nama_perusahaan">
            <el-input v-model="newDudi.nama_perusahaan" />
          </el-form-item>
          <el-form-item :label="$t('dudi.table.tahunKerjaSama')" prop="tahun_kerjasama">
            <el-input v-model="newDudi.tahun_kerjasama" />
          </el-form-item>
          <el-form-item :label="$t('dudi.table.uploadPath')" prop="image">
            <el-upload
              ref="upload_image_create"
              class="upload-demo"
              action=""
              :auto-upload="false"
              :on-change="handleUploadSuccess"
            >
              <el-button slot="trigger" size="small" type="primary">select file</el-button>
              <div slot="tip" class="el-upload__tip">Ukuran foto direkomendasikan 300x300</div>
              <div slot="tip" style="font-size: 12px; color: rgba(255, 0, 0, 0.8);">{{ fileIsRequired }}</div>
              <div slot="tip" style="font-size: 12px; color: rgba(255, 0, 0, 0.8);">{{ fileIsImage }}</div>
            </el-upload>
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button type="primary" @click="createDudi()">
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>

    <el-dialog :title="$t('dudi.dialog.edit')" :visible.sync="dialogFormUpdateIsVisible">
      <div v-loading="dudiCreating" class="form-container">
        <el-form ref="dudiForm" :rules="rules" :model="editedDudi" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item :label="$t('dudi.table.namaPerusahaan')" prop="nama_perusahaan">
            <el-input v-model="editedDudi.nama_perusahaan" />
          </el-form-item>
          <el-form-item :label="$t('dudi.table.tahunKerjaSama')" prop="tahun_kerjasama">
            <el-input v-model="editedDudi.tahun_kerjasama" />
          </el-form-item>
          <el-form-item :label="$t('dudi.table.uploadPath')" prop="image">
            <el-upload
              ref="upload_image_edit"
              class="upload-demo"
              action=""
              :auto-upload="false"
              :on-change="handleUploadSuccessEdit"
            >
              <el-button slot="trigger" size="small" type="primary">select file</el-button>
              <div slot="tip" style="font-size: 12px; color: rgba(255, 0, 0, 0.8);">{{ fileIsRequired }}</div>
              <div slot="tip" style="font-size: 12px; color: rgba(255, 0, 0, 0.8);">{{ fileIsImage }}</div>
              <div v-if="isSelect" slot="tip" class="el-upload__tip">Select file untuk mengganti file KKNI</div>
              <div slot="tip" class="el-upload__tip">Ukuran foto direkomendasikan 300x300</div>
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

const dudiResource = new Resource('dudi');
const dudiUpdateResource = new Resource('dudi/update');

export default {
  name: 'UserList',
  components: { Pagination },
  directives: { waves, permission },
  data() {
    return {
      fileIsRequired: '',
      fileIsImage: '',
      isSelect: true,
      list: null,
      total: 0,
      loading: true,
      downloading: false,
      dudiCreating: false,
      dialogFormVisible: false,
      dialogFormUpdateIsVisible: false,
      newDudi: {
        id: 0,
        nama_perusahaan: '',
        tahun_kerjasama: '',
        image: '',
      },
      editedDudi: {
        id: 0,
        nama_perusahaan: '',
        tahun_kerjasama: '',
        image: '',
      },
      query: {
        page: 1,
        limit: 15,
        keyword: '',
        role: '',
      },
      rules: {
        nama_perusahaan: [{ required: true, message: 'Nama Perusahaan is required', trigger: 'change' }],
        tahun_kerjasama: [{ required: true, message: 'Tahun Kerja Sama is required', trigger: 'change' }],
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
      const { data, meta } = await dudiResource.list(this.query);
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
    resetNewDudi() {
      this.newDudi = {};
    },
    resetEditedDudi() {
      this.editedDudi = {};
    },
    handleCreate() {
      this.resetNewDudi();
      this.dialogFormVisible = true;
      if (this.$refs.upload_image_create) {
        const length = this.$refs.upload_image_create.uploadFiles.length;
        this.$refs.upload_image_create.uploadFiles.splice(0, length);
      }
      this.$nextTick(() => {
        this.$refs['dudiForm'].clearValidate();
      });
    },
    handleDelete(data) {
      var deleteData = data;
      console.log(deleteData);
      this.$confirm('This will permanently delete ' + deleteData.nama_perusahaan + ', Continue?', 'Warning', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(() => {
        dudiResource.destroy(deleteData.id).then(response => {
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
    createDudi() {
      this.loading = true;
      this.$refs['dudiForm'].validate((valid) => {
        if (valid) {
          const uploadData = new FormData();
          uploadData.append('nama_perusahaan', this.newDudi.nama_perusahaan);
          uploadData.append('tahun_kerjasama', this.newDudi.tahun_kerjasama);
          uploadData.append('file', this.newDudi.image);
          this.dudiCreating = true;
          if (this.$refs.upload_image_create.uploadFiles.length === 0) {
            this.fileIsRequired = 'File is required';
            this.dudiCreating = false;
            this.loading = false;
          } else {
            dudiResource
              .store(uploadData)
              .then(() => {
                this.$message({
                  message: 'New File ' + this.newDudi.nama_perusahaan + ' has been created successfully.',
                  type: 'success',
                  duration: 5 * 1000,
                });
                this.resetNewDudi();
                this.$refs.upload_image_create.handleRemove();
                this.dialogFormVisible = false;
                this.handleFilter();
              })
              .catch(error => {
                console.log(error);
              })
              .finally(() => {
                this.loading = false;
                this.dudiCreating = false;
              });
          }
        } else {
          this.loading = false;
          // console.log('error submit!!');
          return false;
        }
      });
    },
    handleUpdate(dudi) {
      this.isSelect = true;
      this.editedDudi = dudi;
      console.log(this.editedDudi);
      if (this.$refs.upload_image_edit) {
        const length = this.$refs.upload_image_edit.uploadFiles.length;
        this.$refs.upload_image_edit.uploadFiles.splice(0, length);
      }
      this.dialogFormUpdateIsVisible = true;
    },
    dialogFormUpdateVisible(){
      this.dialogFormUpdateIsVisible = false;
      this.getList();
    },
    updateData() {
      this.loading = true;
      const uploadData = new FormData();
      uploadData.append('id', this.editedDudi.id);
      uploadData.append('nama_perusahaan', this.editedDudi.nama_perusahaan);
      uploadData.append('tahun_kerjasama', this.editedDudi.tahun_kerjasama);
      uploadData.append('file', this.editedDudi.image);
      console.log(this.editedDudi);
      this.dudiCreating = true;
      dudiUpdateResource
        .store(uploadData)
        .then((response) => {
          // console.log(response);
          this.getList();
          this.resetEditedDudi();
          this.dialogFormUpdateIsVisible = false;
          this.$notify({
            title: 'Success',
            message: 'Updated successfully',
            type: 'success',
            duration: 2000,
          });
          this.$refs.upload_image_edit.handleRemove();
        })
        .catch(error => {
          console.log(error);
        })
        .finally(() => {
          this.loading = true;
          this.dudiCreating = false;
        });
    },
    handleUploadSuccess(e) {
      this.fileIsRequired = '';
      const length = this.$refs.upload_image_create.uploadFiles.length;
      if (length === 2) {
        this.$refs.upload_image_create.uploadFiles.splice(0, 1);
        this.newDudi.image = this.$refs.upload_image_create.uploadFiles[0].raw;
      } else {
        this.newDudi.image = this.$refs.upload_image_create.uploadFiles[0].raw;
      }
      if (this.newDudi.image.type === 'image/jpeg' || this.newDudi.image.type === 'image/png' || this.newDudi.image.type === 'image/jpg') {
        this.fileIsImage = '';
      } else {
        this.fileIsImage = 'File type must be image/jpeg/jpg/png';
        this.$refs.upload_image_create.uploadFiles.splice(0, length);
      }
      console.log(this.newDudi.image);
    },
    handleUploadSuccessEdit(e) {
      const length = this.$refs.upload_image_edit.uploadFiles.length;
      if (length === 2) {
        this.$refs.upload_image_edit.uploadFiles.splice(0, 1);
        this.editedDudi.image = this.$refs.upload_image_edit.uploadFiles[0].raw;
      } else {
        this.editedDudi.image = this.$refs.upload_image_edit.uploadFiles[0].raw;
      }
      if (this.editedDudi.image.type === 'image/jpeg' || this.editedDudi.image.type === 'image/png' || this.editedDudi.image.type === 'image/jpg') {
        this.fileIsImage = '';
      } else {
        this.fileIsImage = 'File type must be image/jpeg/jpg/png';
        this.$refs.upload_image_edit.uploadFiles.splice(0, length);
      }
      this.isSelect = false;
      console.log(this.editedDudi.image);
    },
    handleDownload() {
      this.downloading = true;
      import('@/vendor/Export2Excel').then(excel => {
        const tHeader = ['Nama Perusahaan', 'Tahun Kerja Sama'];
        const filterVal = ['Nama Perusahaan', 'Tahun Kerja Sama'];
        const data = this.formatJson(filterVal, this.list);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: 'dudi-list',
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
