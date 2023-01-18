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

      <el-table-column align="center" :label="$t('asesor.table.no')">
        <template slot-scope="scope">
          <span>{{ scope.row.no_reg }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('asesor.table.name')">
        <template slot-scope="scope">
          <span>{{ scope.row.nama }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('asesor.table.email')" min-width="150px">
        <template slot-scope="scope">
          <span>{{ scope.row.email }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('asesor.table.hp')">
        <template slot-scope="scope">
          <span>{{ scope.row.hp }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('asesor.table.status')">
        <template slot-scope="scope">
          <span>{{ scope.row.status_asesor }}</span>
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

    <el-dialog :title="$t('asesor.dialog.addNew')" :visible.sync="dialogFormVisible">
      <div v-loading="asesorCreating" class="form-container">
        <el-form ref="assesorForm" :rules="rules" :model="newAssesor" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item :label="$t('asesor.table.no')" prop="no_reg">
            <el-input v-model="newAssesor.no_reg" />
          </el-form-item>
          <el-form-item :label="$t('asesor.table.name')" prop="nama">
            <el-input v-model="newAssesor.nama" />
          </el-form-item>
          <el-form-item :label="$t('asesor.table.email')" prop="email">
            <el-input v-model="newAssesor.email" />
          </el-form-item>
          <el-form-item :label="$t('asesor.table.hp')" prop="hp">
            <el-input v-model="newAssesor.hp" />
          </el-form-item>
          <el-form-item :label="$t('asesor.table.status')" prop="status_assesor">
            <el-select v-model="newAssesor.status_asesor" class="filter-item" placeholder="Please select Status">
              <el-option v-for="item in statusAssesor" :key="item" :label="item | uppercaseFirst" :value="item" />
            </el-select>
          </el-form-item>
          <!-- <el-form-item :label="$t('tuk.table.email')" prop="email">
            <el-input v-model="newAssesor.email" />
          </el-form-item> -->
          <!-- <el-form-item
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
          </el-form-item> -->
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button type="primary" @click="createAssesor()">
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>

    <el-dialog :title="$t('asesor.dialog.update') + ' ' + editedAssesor" :visible.sync="dialogFormUpdateVisible">
      <div v-loading="asesorCreating" class="form-container">
        <el-form ref="tukForm" :rules="rules" :model="editedAssesor" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item :label="$t('asesor.table.code')" prop="no_reg">
            <el-input v-model="editedAssesor.no_reg" />
          </el-form-item>
          <el-form-item :label="$t('asesor.table.name')" prop="nama">
            <el-input v-model="editedAssesor.nama" />
          </el-form-item>
          <el-form-item :label="$t('asesor.table.email')" prop="email">
            <el-input v-model="editedAssesor.email" disabled />
          </el-form-item>
          <el-form-item :label="$t('asesor.table.hp')" prop="hp">
            <el-input v-model="editedAssesor.hp" />
          </el-form-item>
          <el-form-item :label="$t('asesor.table.status')" prop="status_assesor">
            <el-select v-model="editedAssesor.status_asesor" class="filter-item" placeholder="Please select Status">
              <el-option v-for="item in statusAssesor" :key="item" :label="item | uppercaseFirst" :value="item" />
            </el-select>
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
// import vueSignature from 'vue-signature';
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import UserResource from '@/api/user';
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import permission from '@/directive/permission'; // Permission directive

const userResource = new UserResource();
const assesorResource = new Resource('assesor');

export default {
  name: 'UserList',
  components: { Pagination },
  directives: { waves, permission },
  data() {
    return {
      list: null,
      total: 0,
      loading: true,
      downloading: false,
      asesorCreating: false,
      dialogFormVisible: false,
      dialogFormUpdateVisible: false,
      newAssesor: {},
      statusAssesor: ['Assesor Tetap', 'Assesor Tidak Tetap'],
      editedAssesor: {
        id: 0,
        no_reg: '',
        nama: '',
        email: '',
        hp: '',
        status_asesor: '',
      },
      query: {
        page: 1,
        limit: 15,
        keyword: '',
        role: '',
      },
      rules: {
        no_reg: [{ required: true, message: 'Nomor Registrasi is required', trigger: 'change' }],
        nama: [{ required: true, message: 'Nama Assesor is required', trigger: 'blur' }],
        status_asesor: [{ required: true, message: 'Status Asesor is required', trigger: 'blur' }],
        hp: [{ required: true, message: 'No HP is required', trigger: 'blur' }],
        email: [
          { required: true, message: 'Email is required', trigger: 'blur' },
          { type: 'email', message: 'Please input correct email address', trigger: ['blur', 'change'] },
        ],
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
      const { data, meta } = await assesorResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.total = meta.total;
      this.loading = false;
    },
    handleFilter() {
      this.query.page = 1;
      this.getList();
    },
    resetNewAssesor() {
      this.newAssesor = {};
    },
    handleCreate() {
      this.resetNewAssesor();
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs['assesorForm'].clearValidate();
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
    createAssesor() {
      this.loading = true;
      this.$refs['assesorForm'].validate((valid) => {
        if (valid) {
          this.asesorCreating = true;
          // this.newAssesor.signature = this.$refs.signature.save();
          const formData = new FormData();
          formData.append('no_reg', this.newAssesor.no_reg);
          formData.append('nama', this.newAssesor.nama);
          formData.append('email', this.newAssesor.email);
          formData.append('hp', this.newAssesor.hp);
          formData.append('status_asesor', this.newAssesor.status_asesor);
          // formData.append('signature', this.newAssesor.signature);
          assesorResource
            .store(formData)
            .then(response => {
              this.$message({
                message: 'New Assesor ' + this.newAssesor.nama + ' has been created successfully.',
                type: 'success',
                duration: 5 * 1000,
              });
              this.resetNewAssesor();
              this.dialogFormVisible = false;
              this.handleFilter();
            })
            .catch(error => {
              console.log(error);
              this.asesorCreating = false;
            })
            .finally(() => {
              this.loading = true;
              this.asesorCreating = false;
            });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    handleUpdate(tuk) {
      this.editedAssesor = tuk;
      this.dialogFormUpdateVisible = true;
      console.log(this.editedAssesor);
    },
    updateData() {
      this.loading = true;
      assesorResource.update(this.editedAssesor.id, this.editedAssesor).then(() => {
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
          this.asesorCreating = false;
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
