<template>
  <div class="app-container">
    <div class="filter-container">
      <h3>Perangkat IA 02 TUGAS PRAKTIK DEMONSTRASI</h3>
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
      <el-table-column align="center" :label="$t('skema.perangkat.pertanyaan')">
        <template slot-scope="scope">
          <el-tooltip class="item" effect="dark" content="Liat Soal" placement="top-end">
            <a :href="'/' + scope.row.soal" target="_blank">
              {{ scope.row.namaSoal }}
            </a>
          </el-tooltip>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('skema.perangkat.jawaban')">
        <template slot-scope="scope">
          <el-tooltip class="item" effect="dark" content="Liat Jawaban" placement="top-end">
            <a :href="'/' + scope.row.jawaban" target="_blank">
              {{ scope.row.namaJawaban }}
            </a>
          </el-tooltip>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Actions" width="120">
        <template slot-scope="scope">
          <el-button-group>
            <el-tooltip class="item" effect="dark" content="Update" placement="top-end">
              <el-button v-permission="['manage user']" type="success" size="small" icon="el-icon-edit" @click="handleUpdate(scope.row)" />
            </el-tooltip>
            <el-tooltip class="item" effect="dark" content="Delete" placement="top-end">
              <el-button v-permission="['manage user']" type="danger" size="small" icon="el-icon-delete" @click="handleDelete(scope.row)" />
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
          <el-form-item :label="$t('skema.perangkat.soal')" prop="soal">
            <input type="file" @change="handleUploadSoalSuccess">
          </el-form-item>
          <el-form-item :label="$t('skema.perangkat.jawaban')" prop="jawaban">
            <input type="file" @change="handleUploadJawabanSuccess">
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
    <el-dialog :title="$t('skema.dialog.edit')" :visible.sync="dialogFormUpdateIsVisible">
      <div v-loading="creating" class="form-container">
        <el-form ref="ia02Form" :rules="rules" :model="editedIa02" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item :label="$t('perangkat.dialog.soal')" prop="nama">
            <el-upload
              ref="upload_path_edit_soal"
              class="upload-demo"
              action=""
              :auto-upload="false"
              :on-change="handleUploadSuccessEditSoal"
            >
              <el-button slot="trigger" size="small" type="primary">select file</el-button>
              <div v-if="isSelect" slot="tip" class="el-upload__tip">Kosongkan bila tidak ingin diubah</div>
            </el-upload>
          </el-form-item>
          <el-form-item :label="$t('perangkat.dialog.jawaban')" prop="nama">
            <el-upload
              ref="upload_path_edit_jawaban"
              class="upload-demo"
              action=""
              :auto-upload="false"
              :on-change="handleUploadSuccessEditJawaban"
            >
              <el-button slot="trigger" size="small" type="primary">select file</el-button>
              <div v-if="isSelect" slot="tip" class="el-upload__tip">Kosongkan bila tidak ingin diubah</div>
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

const listResource = new Resource('mst-ia02-get');
// const deleteResource = new Resource('del-mst-ia-02');
// const postResource = new Resource('new-mst-ia-02');
const deleteResourceSoal = new Resource('del-mst-ia-02-detail');
const postResourceSoal = new Resource('new-mst-ia-02-detail');
const editResource = new Resource('mst-ia02-update');
// const deleteResourceJawaban = new Resource('del-mst-ia-02-jawaban');
// const postResourceJawaban = new Resource('new-mst-ia-02-jawaban');
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
      fileIsRequired: '',
      total: 0,
      loading: true,
      downloading: false,
      creating: false,
      dialogFormVisible: false,
      dialogFormUpdateIsVisible: false,
      kategori: [],
      dataTrx: {},
      editedIa02: {
        id: 0,
        soal: '',
        jawaban: '',
        updated_by: '',
      },
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
        soal: [{ required: true, message: 'Soal is required', trigger: 'blur' }],
        jawaban: [{ required: true, message: 'Jawaban is required', trigger: 'blur' }],
      },
    };
  },
  watch: {
    idSkema: {
      deep: true,
      handler() {
        this.getList();
      },
    },
  },
  created() {
    this.getList();
  },
  methods: {
    handleUploadSuccessEditSoal(e) {
      const length = this.$refs.upload_path_edit_soal.uploadFiles.length;
      console.log(this.$refs.upload_path_edit_soal.uploadFiles);
      if (length === 2) {
        this.$refs.upload_path_edit_soal.uploadFiles.splice(0, 1);
        this.editedIa02.soal = this.$refs.upload_path_edit_soal.uploadFiles[0].raw;
      } else {
        this.editedIa02.soal = this.$refs.upload_path_edit_soal.uploadFiles[0].raw;
      }
      this.isSelect = false;
    },
    handleUploadSuccessEditJawaban(e) {
      const length = this.$refs.upload_path_edit_jawaban.uploadFiles.length;
      console.log(this.$refs.upload_path_edit_jawaban.uploadFiles);
      if (length === 2) {
        this.$refs.upload_path_edit_jawaban.uploadFiles.splice(0, 1);
        this.editedIa02.jawaban = this.$refs.upload_path_edit_jawaban.uploadFiles[0].raw;
      } else {
        this.editedIa02.jawaban = this.$refs.upload_path_edit_jawaban.uploadFiles[0].raw;
      }
      this.isSelect = false;
    },
    resetEditedIa02(){
      this.editedIa02 = {};
    },
    dialogFormUpdateVisible(){
      this.dialogFormUpdateIsVisible = false;
      this.getList();
    },
    filename(teks) {
      const regex = new RegExp('uploads/perangkat/file/');
      teks.replace(regex, '');
      const again = /^([^\-]+\-[^\-]+\-[^\-]+\-)/;
      return teks.replace(again, '');
    },
    async getList() {
      const { limit, page } = this.query;
      this.query.id_skema = this.idSkema;
      this.loading = true;
      const { data, meta } = await listResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
        if (element['soal'] !== null){
          element['namaSoal'] = this.filename(element['soal']);
        }
        if (element['jawaban'] !== null){
          element['namaJawaban'] = this.filename(element['jawaban']);
        }
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
    handleUploadSoalSuccess(e) {
      const files = e.target.files;
      const rawFile = files[0]; // only use files[0]
      this.dataTrx.soal = rawFile;
    },
    handleUploadJawabanSuccess(e) {
      const files = e.target.files;
      const rawFile = files[0]; // only use files[0]
      this.dataTrx.jawaban = rawFile;
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
    handleDelete(data) {
      var deleteData = data;
      this.$confirm('This will permanently delete IA 02, Continue?', 'Warning', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(() => {
        deleteResourceSoal.store(deleteData).then(response => {
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
          uploadData.append('soal', this.dataTrx.soal);
          uploadData.append('jawaban', this.dataTrx.jawaban);
          uploadData.append('user_id', this.userId);
          this.creating = true;
          postResourceSoal
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
    updateData() {
      this.loading = true;
      const uploadData = new FormData();
      uploadData.append('id', this.editedIa02.id_mst_ia_02_detail);
      uploadData.append('soal', this.editedIa02.soal);
      uploadData.append('jawaban', this.editedIa02.jawaban);
      uploadData.append('updated_by', this.userId);
      // console.log(this.editedKkni);
      this.creating = true;
      editResource
        .store(uploadData)
        .then((response) => {
          // console.log(response);
          this.getList();
          this.resetEditedIa02();
          this.dialogFormUpdateIsVisible = false;
          this.$notify({
            title: 'Success',
            message: 'Updated successfully',
            type: 'success',
            duration: 2000,
          });
          this.$refs.upload_path_edit_soal.handleRemove();
          this.$refs.upload_path_edit_jawaban.handleRemove();
        })
        .catch(error => {
          console.log(error);
        })
        .finally(() => {
          this.loading = true;
          this.creating = false;
        });
    },
    handleUpdate(ia02) {
      this.isSelect = true;
      this.editedIa02 = ia02;
      console.log(this.editedIa02);
      if (this.$refs.upload_path_edit_soal) {
        const length = this.$refs.upload_path_edit_soal.uploadFiles.length;
        this.$refs.upload_path_edit_soal.uploadFiles.splice(0, length);
      }
      if (this.$refs.upload_path_edit_jawaban) {
        const length = this.$refs.upload_path_edit_jawaban.uploadFiles.length;
        this.$refs.upload_path_edit_jawaban.uploadFiles.splice(0, length);
      }
      this.dialogFormUpdateIsVisible = true;
    },
    // updateData() {
    //   this.loading = true;
    //   skemaResource.update(this.editedSkema.id, this.editedSkema).then(() => {
    //     this.getList();
    //     this.dialogFormUpdateVisible = false;
    //     this.$notify({
    //       title: 'Success',
    //       message: 'Updated successfully',
    //       type: 'success',
    //       duration: 2000,
    //     });
    //   })
    //     .catch(error => {
    //       console.log(error);
    //     })
    //     .finally(() => {
    //       this.loading = true;
    //       this.creating = false;
    //     });
    // },
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
