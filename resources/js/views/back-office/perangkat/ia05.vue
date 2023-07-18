<template>
  <div class="app-container">
    <div class="filter-container">
      <h3>Perangkat IA 05 PERTANYAAN TERTULIS PILIHAN GANDA</h3>
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

      <el-table-column align="center" :label="$t('skema.perangkat.unit')">
        <template slot-scope="scope">
          <span>{{ scope.row.kode_unit }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('skema.perangkat.pertanyaan')">
        <template slot-scope="scope">
          <span>{{ scope.row.pertanyaan }}</span>
        </template>
      </el-table-column>

      <el-table-column align="left" :label="$t('skema.perangkat.jawaban')">
        <template slot-scope="scope">
          <div v-for="item in scope.row.list_jawaban" :key="item.id">
            {{ item.no_jawaban + '. ' + item.jawaban }}
          </div>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('skema.perangkat.kunci_jawaban')">
        <template slot-scope="scope">
          <span>{{ scope.row.no_kunci_jawaban + '. ' + scope.row.isi_kunci_jawaban }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Actions" width="120">
        <template slot-scope="scope">
          <el-button-group>
            <el-tooltip class="item" effect="dark" content="Tambah Jawaban" placement="top-end">
              <el-button v-permission="['manage user']" type="success" size="small" icon="el-icon-plus" @click="handleAddJawaban(scope.row.id_perangkat)" />
            </el-tooltip>
            <el-tooltip class="item" effect="dark" content="Delete" placement="top-end">
              <el-button v-permission="['manage user']" type="danger" size="small" icon="el-icon-delete" @click="handleDelete(scope.row)" />
            </el-tooltip>
            <!-- <el-tooltip class="item" effect="dark" content="Update" placement="top-end">
              <el-button v-permission="['manage user']" type="success" size="small" icon="el-icon-edit" @click="handleUpdate(scope.row)" />
            </el-tooltip> -->
          </el-button-group>
        </template>
      </el-table-column>

    </el-table>

    <pagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" @pagination="getList" />

    <el-dialog title="Buat Jawaban" :visible.sync="dialogFormJawabanVisible">
      <div v-loading="creating" class="form-container">
        <el-form ref="newJawaban" :rules="rules" :model="dataTrxJawaban" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item label="Pertanyaan" prop="unit">
            <el-select
              v-model="dataTrxJawaban.id_mst_ia_05"
              filterable
              clearable
              class="filter-item full"
              placeholder="Pertanyaan"
              :disabled="true"
            >
              <el-option
                v-for="item in list"
                :key="item.id_perangkat"
                :label="item.pertanyaan"
                :value="item.id_perangkat"
              />
            </el-select>
          </el-form-item>
          <el-form-item label="No" prop="no">
            <el-input v-model="dataTrxJawaban.no_jawaban" />
          </el-form-item>
          <el-form-item :label="$t('skema.perangkat.jawaban')" prop="jawaban">
            <el-input v-model="dataTrxJawaban.jawaban" />
          </el-form-item>
          <el-form-item label="Kunci Jawaban?" prop="unit">
            <el-select
              v-model="dataTrxJawaban.kunci_jawaban"
              filterable
              clearable
              class="filter-item full"
              placeholder="Unik Komptensi"
            >
              <el-option label="Tidak" :value="0" />
              <el-option label="Ya" :value="1" />
            </el-select>
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button type="primary" @click="submitJawaban()">
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>

    <el-dialog :title="$t('skema.dialog.addNew')" :visible.sync="dialogFormVisible">
      <div v-loading="creating" class="form-container">
        <el-form ref="newForm" :rules="rules" :model="dataTrx" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item label="Unit Kompetensi" prop="unit">
            <el-select
              v-model="dataTrx.id_unit_komp"
              filterable
              clearable
              class="filter-item full"
              placeholder="Unit Kompetensi"
            >
              <el-option
                v-for="item in listUnit"
                :key="item.id"
                :label="item.kode_unit"
                :value="item.id"
              />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('skema.perangkat.pertanyaan')" prop="pertanyaan">
            <el-input v-model="dataTrx.pertanyaan" />
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
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import permission from '@/directive/permission'; // Permission directive

const listResource = new Resource('mst-ia05-get');
const deleteResource = new Resource('del-mst-ia-05');
const postResource = new Resource('new-mst-ia-05');
const postDetailResource = new Resource('detail-mst-ia-05');
const skemaResource = new Resource('skema');
const unitKompResource = new Resource('unit-kompetensi-get');

export default {
  name: 'MstIa05',
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
      listUnit: null,
      total: 0,
      loading: true,
      downloading: false,
      creating: false,
      dialogFormVisible: false,
      dialogFormJawabanVisible: false,
      dialogFormUpdateVisible: false,
      kategori: [],
      dataTrx: {},
      dataTrxJawaban: {},
      editedSkema: {
        id: 0,
        id_skema: '',
        pertanyaan: '',
        kunci_jawaban: '',
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
      const queryUnit = await unitKompResource.list(this.query);
      this.listUnit = queryUnit.data;
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
    handleAddJawaban(id) {
      this.dataTrxJawaban.id_mst_ia_05 = id;
      this.dialogFormJawabanVisible = true;
    },
    resetdataTrx() {
      this.dataTrx = {};
      this.dataTrxJawaban = {};
    },
    handleCreate() {
      this.resetdataTrx();
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs['newForm'].clearValidate();
      });
    },
    handleDelete(data) {
      this.$confirm('This will permanently delete IA 05, Continue?', 'Warning', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(() => {
        deleteResource.store(data).then(response => {
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
      this.dataTrx.updated_by = this.userId;
      this.$refs['newForm'].validate((valid) => {
        if (valid) {
          this.creating = true;
          postResource
            .store(this.dataTrx)
            .then(response => {
              this.$message({
                message: 'New Pertanyaan ' + this.dataTrx.pertanyaan + ' has been created successfully.',
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
          // console.log('error submit!!');
          return false;
        }
      });
    },
    submitJawaban() {
      this.loading = true;
      this.dataTrxJawaban.id_skema = this.idSkema;
      this.dataTrxJawaban.updated_by = this.userId;
      this.$refs['newJawaban'].validate((valid) => {
        if (valid) {
          this.creating = true;
          postDetailResource
            .store(this.dataTrxJawaban)
            .then(response => {
              this.$message({
                message: 'New Jawaban for ' + this.dataTrx.pertanyaan + ' has been created successfully.',
                type: 'success',
                duration: 5 * 1000,
              });
              this.resetdataTrx();
              this.dialogFormJawabanVisible = false;
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
          // console.log('error submit!!');
          return false;
        }
      });
    },
    handleUpdate(skema) {
      this.editedSkema = skema;
      this.dialogFormUpdateVisible = true;
      // console.log(this.editedSkema);
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
