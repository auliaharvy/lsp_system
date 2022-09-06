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
          <span>{{ scope.row.jumlah_unit }}</span>
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

      <el-table-column align="center" label="Actions" width="120">
        <template slot-scope="scope">
          <el-button-group>
            <el-tooltip class="item" effect="dark" content="Update" placement="top-end">
              <el-button v-permission="['manage user']" type="success" size="small" icon="el-icon-edit" @click="handleUpdate(scope.row)" />
            </el-tooltip>
          </el-button-group>
        </template>
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

    <el-dialog :title="$t('tuk.dialog.addNew') + ' ' + editedSkema.skema_sertifikasi" :visible.sync="dialogFormUpdateVisible">
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

  </div>
</template>

<script>
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import UserResource from '@/api/user';
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import permission from '@/directive/permission'; // Permission directive

const userResource = new UserResource();
const skemaResource = new Resource('skema');
const kategoriResource = new Resource('skema/kategori');

export default {
  name: 'SkemaList',
  components: { Pagination },
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
      kategori: [],
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
    handleFilter() {
      this.query.page = 1;
      this.getList();
    },
    resetNewSkema() {
      this.newSkema = {};
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
