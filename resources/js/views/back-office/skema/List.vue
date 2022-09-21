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

    <el-table v-loading="loading" :data="list" border fit highlight-current-row style="width: 100%" :header-cell-style="{ background: '#C0C0C0', color: 'white' }">
      <el-table-column label="Skema Sertifikasi">
        <el-table-column align="center" label="No" width="80">
          <template slot-scope="scope">
            <span>{{ scope.row.index }}</span>
          </template>
        </el-table-column>

        <el-table-column type="expand">
          <template slot-scope="scope">
            <br>
            <div class="filter-container">
              <el-button v-waves :loading="downloading" class="filter-item" type="primary" icon="el-icon-download" @click="handleDownloadTemplateElemen(scope.row.children)">
                {{ $t('table.export') }} Template
              </el-button>
              <el-button v-waves :loading="downloading" class="filter-item" type="primary" icon="el-icon-upload2" @click="handleUpload(scope.row, 'elemen')">
                Upload Elemen Unit Kompetensi
              </el-button>
            </div>

            <el-table v-loading="loading" :data="scope.row.children" border fit highlight-current-row style="width: 80%" :header-cell-style="{ background: '#C0C0C0', color: 'white' }" class="table-child">
              <el-table-column label="Unit Kompetensi">
                <el-table-column type="expand">
                  <template slot-scope="row">
                    <br>
                    <div class="filter-container">
                      <el-button v-waves :loading="downloading" class="filter-item" type="primary" icon="el-icon-download" @click="handleDownloadTemplateKuk(row.row.elemen)">
                        {{ $t('table.export') }} Template
                      </el-button>
                      <el-button v-waves :loading="downloading" class="filter-item" type="primary" icon="el-icon-upload2" @click="handleUpload(scope.row, 'kuk')">
                        Upload KUK Elemen
                      </el-button>
                    </div>

                    <el-table v-loading="loading" :data="row.row.elemen" border fit highlight-current-row style="width: 80%" :header-cell-style="{ background: '#C0C0C0', color: 'white' }" class="table-child">
                      <el-table-column label="Elemen Unit Kompetensi">

                        <el-table-column type="expand">
                          <template slot-scope="elemen">
                            <el-table v-loading="loading" :data="elemen.row.kuk" border fit highlight-current-row style="width: 80%" :header-cell-style="{ background: '#C0C0C0', color: 'white' }" class="table-child">
                              <el-table-column label="KUK">

                                <el-table-column align="center" label="KUK">
                                  <template slot-scope="kuk">
                                    <span>{{ kuk.row.kuk }}</span>
                                  </template>
                                </el-table-column>

                                <el-table-column align="center" label="Pertanyaan KUK">
                                  <template slot-scope="kuk">
                                    <span>{{ kuk.row.pertanyaan_kuk }}</span>
                                  </template>
                                </el-table-column>

                                <el-table-column align="center" label="Bukti">
                                  <template slot-scope="kuk">
                                    <span>{{ kuk.row.bukti }}</span>
                                  </template>
                                </el-table-column>

                              </el-table-column>
                            </el-table>
                          </template>
                        </el-table-column>

                        <el-table-column align="center" label="Elemen">
                          <template slot-scope="elemen">
                            <span>{{ elemen.row.nama_elemen }}</span>
                          </template>
                        </el-table-column>

                      </el-table-column>
                    </el-table>
                  </template>
                </el-table-column>
                <el-table-column align="center" label="Kode Unit">
                  <template slot-scope="row">
                    <span>{{ row.row.kode_unit }}</span>
                  </template>
                </el-table-column>
                <el-table-column align="center" label="Unit Kompetensi">
                  <template slot-scope="row">
                    <span>{{ row.row.unit_kompetensi }}</span>
                  </template>
                </el-table-column>
              </el-table-column>
            </el-table>

          </template>
        </el-table-column>

        <el-table-column align="center" :label="$t('skema.table.code')">
          <template slot-scope="scope">
            <span>{{ scope.row.kode_skema }}</span>
          </template>
        </el-table-column>

        <el-table-column align="center" :label="$t('skema.table.skema')">
          <template slot-scope="scope">
            <span>{{ scope.row.skema_sertifikasi }}</span>
          </template>
        </el-table-column>

        <el-table-column align="center" :label="$t('skema.table.category')" min-width="150px">
          <template slot-scope="scope">
            <span>{{ scope.row.nama_kategori }}</span>
          </template>
        </el-table-column>

        <el-table-column align="center" :label="$t('skema.table.unit_qty')">
          <template slot-scope="scope">
            <span>{{ scope.row.jumlah_unit_count }}</span>
          </template>
        </el-table-column>

        <el-table-column align="center" :label="$t('skema.table.kblui')">
          <template slot-scope="scope">
            <span>{{ scope.row.kblui }}</span>
          </template>
        </el-table-column>

        <el-table-column align="center" :label="$t('skema.table.kbji')">
          <template slot-scope="scope">
            <span>{{ scope.row.kbji }}</span>
          </template>
        </el-table-column>

        <el-table-column align="center" :label="$t('skema.table.jenjang')">
          <template slot-scope="scope">
            <span>{{ scope.row.jenjang }}</span>
          </template>
        </el-table-column>

        <el-table-column align="center" :label="$t('skema.table.sector_code')">
          <template slot-scope="scope">
            <span>{{ scope.row.kode_sektor }}</span>
          </template>
        </el-table-column>

        <el-table-column align="center" :label="$t('skema.table.visibility')">
          <template slot-scope="scope">
            <span>{{ scope.row.visibilitas }}</span>
          </template>
        </el-table-column>

        <el-table-column align="center" label="Actions" min-width="120">
          <template slot-scope="scope">
            <el-button-group>
              <el-tooltip class="item" effect="dark" content="Upload Unit Kompetensi" placement="top-end">
                <el-button v-permission="['manage user']" type="success" size="small" icon="el-icon-upload2" @click="handleUpload(scope.row, 'unit')" />
              </el-tooltip>
              <el-tooltip class="item" effect="dark" content="Update" placement="top-end">
                <el-button v-permission="['manage user']" type="primary" size="small" icon="el-icon-edit-outline" @click="handleUpdate(scope.row)" />
              </el-tooltip>
            </el-button-group>
          </template>
        </el-table-column>
      </el-table-column>
    </el-table>

    <pagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" @pagination="getList" />

    <el-dialog :title="$t('skema.dialog.addNew')" :visible.sync="dialogFormVisible">
      <div v-loading="creating" class="form-container">
        <el-form ref="skemaForm" :rules="rules" :model="newSkema" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item :label="$t('skema.table.code')" prop="kode_skema">
            <el-input v-model="newSkema.kode_skema" />
          </el-form-item>
          <el-form-item :label="$t('skema.table.skema')" prop="skema_sertifikasi">
            <el-input v-model="newSkema.skema_sertifikasi" />
          </el-form-item>
          <el-form-item :label="$t('skema.table.category')" prop="kategori_id">
            <el-select v-model="newSkema.kategori_id" filterable clearable class="filter-item full" :placeholder="$t('skema.table.category')">
              <el-option v-for="item in kategori" :key="item.id" :label="item.nama" :value="item.id" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('skema.table.unit_qty')" prop="jumlah_unit">
            <el-input v-model="newSkema.jumlah_unit" />
          </el-form-item>
          <el-form-item :label="$t('skema.table.kblui')" prop="kblui">
            <el-input v-model="newSkema.kblui" />
          </el-form-item>
          <el-form-item :label="$t('skema.table.kbji')" prop="kbji">
            <el-input v-model="newSkema.kbji" />
          </el-form-item>
          <el-form-item :label="$t('skema.table.jenjang')" prop="jenjang">
            <el-input v-model="newSkema.jenjang" />
          </el-form-item>
          <el-form-item :label="$t('skema.table.sector_code')" prop="kode_sektor">
            <el-input v-model="newSkema.kode_sektor" />
          </el-form-item>
          <el-form-item :label="$t('skema.table.visibility')" prop="visibilitas">
            <el-input v-model="newSkema.visibilitas" />
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button type="primary" @click="createSkema()">
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>

    <el-dialog :title="$t('skema.dialog.edit') + ' ' + editedSkema.skema_sertifikasi" :visible.sync="dialogFormUpdateVisible">
      <div v-loading="creating" class="form-container">
        <el-form ref="skemaForm" :rules="rules" :model="editedSkema" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item :label="$t('skema.table.code')" prop="kode_skema">
            <el-input v-model="editedSkema.kode_skema" />
          </el-form-item>
          <el-form-item :label="$t('skema.table.skema')" prop="skema_sertifikasi">
            <el-input v-model="editedSkema.skema_sertifikasi" />
          </el-form-item>
          <el-form-item :label="$t('skema.table.category')" prop="kategori_id">
            <el-select v-model="editedSkema.kategori_id" filterable clearable class="filter-item full" :placeholder="$t('skema.table.category')">
              <el-option v-for="item in kategori" :key="item.id" :label="item.nama" :value="item.id" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('skema.table.unit_qty')" prop="jumlah_unit">
            <el-input v-model="editedSkema.jumlah_unit" />
          </el-form-item>
          <el-form-item :label="$t('skema.table.kblui')" prop="kblui">
            <el-input v-model="editedSkema.kblui" />
          </el-form-item>
          <el-form-item :label="$t('skema.table.kbji')" prop="kbji">
            <el-input v-model="editedSkema.kbji" />
          </el-form-item>
          <el-form-item :label="$t('skema.table.jenjang')" prop="jenjang">
            <el-input v-model="editedSkema.jenjang" />
          </el-form-item>
          <el-form-item :label="$t('skema.table.sector_code')" prop="kode_sektor">
            <el-input v-model="editedSkema.kode_sektor" />
          </el-form-item>
          <el-form-item :label="$t('skema.table.visibility')" prop="visibilitas">
            <el-input v-model="editedSkema.visibilitas" />
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button type="primary" @click="updateData()">
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>

    <el-dialog :title="$t('skema.dialog.upload') + ' Unit Skema'" :visible.sync="dialogUploadUnitVisible" fullscreen>
      <div class="app-container">
        <el-row :gutter="20">
          <el-col :span="10">
            <div class="grid-content bg-purple">
              <el-descriptions title="Skema Sertifikasi">
                <el-descriptions-item label="Kode Skema">{{ editedSkema.kode_skema }}</el-descriptions-item>
                <el-descriptions-item label="Skema">{{ editedSkema.skema_sertifikasi }}</el-descriptions-item>
                <el-descriptions-item label="Kategori">{{ editedSkema.nama_kategori }}</el-descriptions-item>
                <el-descriptions-item label="KBLUI">{{ editedSkema.kblui }}</el-descriptions-item>
                <el-descriptions-item label="KBJI">{{ editedSkema.kbji }}</el-descriptions-item>
                <el-descriptions-item label="Jenjang">{{ editedSkema.jenjang }}</el-descriptions-item>
                <el-descriptions-item label="Kode Sektor">{{ editedSkema.kode_sektor }}</el-descriptions-item>
              </el-descriptions>
            </div>
          </el-col>
          <el-col :span="10">
            <div class="grid-content bg-purple">
              <upload-excel-component :on-success="handleSuccess" :before-upload="beforeUpload" />
            </div>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :span="10">
            <div class="grid-content bg-purple">
              <el-button type="primary" @click="uploadData()">Upload</el-button>
            </div>
          </el-col>
        </el-row>
        <span>{{ uploadTableData[0] }}</span>
        <el-table :data="uploadTableData" border highlight-current-row style="width: 100%;margin-top:20px;">
          <el-table-column v-for="item of uploadTableHeader" :key="item" :prop="item" :label="item" />
        </el-table>
      </div>
    </el-dialog>

  </div>
</template>

<script>
import UploadExcelComponent from '@/components/UploadExcel/index.vue';
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import UserResource from '@/api/user';
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import permission from '@/directive/permission'; // Permission directive

const userResource = new UserResource();
const skemaResource = new Resource('skema');
const kategoriResource = new Resource('skema/kategori');
const uploadUnitResource = new Resource('skema/upload/unit');
const uploadElemenUnitResource = new Resource('skema/upload/elemen');
const uploadKukResource = new Resource('skema/upload/kuk');

export default {
  name: 'SkemaList',
  components: { Pagination, UploadExcelComponent },
  directives: { waves, permission },
  data() {
    return {
      list: null,
      total: 0,
      loading: true,
      downloading: false,
      creating: false,
      dialogFormVisible: false,
      dialogFormUpdateVisible: false,
      dialogUploadUnitVisible: false,
      jenisUpload: false,
      kategori: [],
      uploadTableData: [],
      uploadTableHeader: [],
      newSkema: {},
      editedSkema: {
        id: 0,
        kode_skema: '',
        skema_sertifikasi: '',
        kategori_id: '',
        jumlah_unit: '',
        kblui: '',
        kbji: '',
        jenjang: '',
        kode_sektor: '',
        visibilitas: '',
      },
      query: {
        page: 1,
        limit: 15,
        keyword: '',
      },
      rules: {
        kode_skema: [{ required: true, message: 'Kode Skema is required', trigger: 'change' }],
        skema_sertifikasi: [{ required: true, message: 'Skema Sertifikasi is required', trigger: 'blur' }],
        kategori_id: [{ required: true, message: 'Kategori Skema is required', trigger: 'blur' }],
        jumlah_unit: [{ required: true, message: 'Jumlah Unit is required', trigger: 'blur' }],
        kblui: [{ required: true, message: 'KBLUI is required', trigger: 'blur' }],
        kbji: [{ required: true, message: 'KBJI is required', trigger: 'blur' }],
        jenjang: [{ required: true, message: 'Jenjang is required', trigger: 'blur' }],
        kode_sektor: [{ required: true, message: 'Kode Sektor is required', trigger: 'blur' }],
        visibilitas: [{ required: true, message: 'Visibilitas is required', trigger: 'blur' }],
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
      this.loading = true;
      const { data, meta } = await skemaResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.total = meta.total;
      this.loading = false;
    },
    async getListKategori() {
      const { limit, page } = this.query;
      this.loading = true;
      const { data } = await kategoriResource.list();
      this.kategori = data;
      this.kategori.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.loading = false;
    },
    beforeUpload(file) {
      const isLt1M = file.size / 1024 / 1024 < 1;

      if (isLt1M) {
        return true;
      }

      this.$message({
        message: 'Please do not upload files larger than 1m in size.',
        type: 'warning',
      });
      return false;
    },
    handleSuccess({ results, header }) {
      this.uploadTableData = results;
      this.uploadTableHeader = header;
    },
    handleFilter() {
      this.query.page = 1;
      this.getList();
    },
    resetNewSkema() {
      this.newSkema = {};
    },
    resetUpload() {
      this.uploadTableData = [];
      this.uploadTableHeader = [];
      this.editedSkema = {};
    },
    handleCreate() {
      this.resetNewSkema();
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs['skemaForm'].clearValidate();
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
    createSkema() {
      this.loading = true;
      this.$refs['skemaForm'].validate((valid) => {
        if (valid) {
          this.creating = true;
          skemaResource
            .store(this.newSkema)
            .then(response => {
              this.$message({
                message: 'New Skema ' + this.newSkema.nama + ' has been created successfully.',
                type: 'success',
                duration: 5 * 1000,
              });
              this.resetNewSkema();
              this.dialogFormVisible = false;
              this.handleFilter();
            })
            .catch(error => {
              console.log(error);
            })
            .finally(() => {
              this.loading = false;
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
    handleUpload(skema, jenis) {
      this.jenisUpload = jenis;
      this.editedSkema = skema;
      this.dialogUploadUnitVisible = true;
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
          this.loading = false;
          this.creating = false;
        });
    },
    uploadData() {
      this.loading = true;
      if (this.jenisUpload === 'unit') {
        var uploadData = {
          id_skema: this.editedSkema.id,
          unit: this.uploadTableData,
        };
        uploadUnitResource.store(uploadData).then(() => {
          this.getList();
          this.dialogUploadUnitVisible = false;
          this.resetUpload();
          this.$notify({
            title: 'Success',
            message: 'Upload successfully',
            type: 'success',
            duration: 2000,
          });
        })
          .catch(error => {
            console.log(error);
          })
          .finally(() => {
            this.loading = false;
            this.creating = false;
          });
      }
      if (this.jenisUpload === 'elemen') {
        uploadElemenUnitResource.store(this.uploadTableData).then(() => {
          this.getList();
          this.dialogUploadUnitVisible = false;
          this.resetUpload();
          this.$notify({
            title: 'Success',
            message: 'Upload successfully',
            type: 'success',
            duration: 2000,
          });
        })
          .catch(error => {
            console.log(error);
          })
          .finally(() => {
            this.loading = false;
            this.creating = false;
          });
      }
      if (this.jenisUpload === 'kuk') {
        uploadKukResource.store(this.uploadTableData).then(() => {
          this.getList();
          this.dialogUploadUnitVisible = false;
          this.resetUpload();
          this.$notify({
            title: 'Success',
            message: 'Upload successfully',
            type: 'success',
            duration: 2000,
          });
        })
          .catch(error => {
            console.log(error);
          })
          .finally(() => {
            this.loading = false;
            this.creating = false;
          });
      }
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
    handleDownloadTemplateElemen(list) {
      this.downloading = true;
      import('@/vendor/Export2Excel').then(excel => {
        const tHeader = ['kode_unit', 'unit_kompetensi', 'nama_elemen'];
        const filterVal = ['kode_unit', 'unit_kompetensi'];
        const data = this.formatJson(filterVal, list);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: 'Template Upload Elemen unit skema',
        });
        this.downloading = false;
      });
    },
    handleDownloadTemplateKuk(list) {
      console.log(list);
      this.downloading = true;
      import('@/vendor/Export2Excel').then(excel => {
        const tHeader = ['id_elemen', 'nama_elemen', 'kuk', 'pertanyaan_kuk', 'jumlah_bukti', 'jenis_bukti', 'bukti'];
        const filterVal = ['id_elemen', 'nama_elemen'];
        const data = this.formatJson(filterVal, list);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: 'Template Upload Elemen unit skema',
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
.table-child {
  align-items: center;
  text-align: center;
}
.grid-content {
  border-radius: 4px;
  min-height: 36px;
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
  .block {
    float: left;
    min-width: 250px;
  }
  .clear-left {
    clear: left;
  }
}
</style>
