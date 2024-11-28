<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input
        v-model="query.keyword"
        :placeholder="$t('table.keyword')"
        style="width: 200px;"
        class="filter-item"
        @keyup.enter.native="handleFilter"
      />
      <el-button
        v-waves
        class="filter-item"
        type="primary"
        icon="el-icon-search"
        @click="handleFilter"
      >
        {{ $t('table.search') }}
      </el-button>
      <el-button
        class="filter-item"
        style="margin-left: 10px;"
        type="primary"
        icon="el-icon-plus"
        @click="handleCreate"
      >
        {{ $t('table.add') }}
      </el-button>
      <el-button
        v-waves
        :loading="downloading"
        class="filter-item"
        type="primary"
        icon="el-icon-download"
        @click="handleDownload"
      >
        {{ $t('table.export') }}
      </el-button>
    </div>

    <el-table
      v-loading="loading"
      :data="list"
      border
      fit
      highlight-current-row
      style="width: 100%"
    >
      <el-table-column
        align="center"
        label="No"
        width="80"
      >
        <template slot-scope="scope">
          <span>{{ scope.row.index }}</span>
        </template>
      </el-table-column>

      <el-table-column
        align="center"
        :label="$t('tuk.table.code')"
      >
        <template slot-scope="scope">
          <span>{{ scope.row.kode_tuk }}</span>
        </template>
      </el-table-column>

      <el-table-column
        align="center"
        :label="$t('tuk.table.name')"
      >
        <template slot-scope="scope">
          <span>{{ scope.row.nama }}</span>
        </template>
      </el-table-column>

      <el-table-column
        align="center"
        :label="$t('tuk.table.address')"
        min-width="150px"
      >
        <template slot-scope="scope">
          <span>{{ scope.row.alamat }}</span>
        </template>
      </el-table-column>

      <el-table-column
        align="center"
        :label="$t('tuk.table.telp')"
      >
        <template slot-scope="scope">
          <span>{{ scope.row.no_telp }}</span>
        </template>
      </el-table-column>

      <el-table-column
        align="center"
        :label="$t('tuk.table.email')"
      >
        <template slot-scope="scope">
          <span>{{ scope.row.email }}</span>
        </template>
      </el-table-column>

      <el-table-column
        align="center"
        label="Actions"
        width="120"
      >
        <template slot-scope="scope">
          <el-button-group>
            <el-tooltip
              class="item"
              effect="dark"
              content="Update"
              placement="top-end"
            >
              <el-button
                v-permission="['manage user']"
                type="success"
                size="small"
                icon="el-icon-edit"
                @click="handleUpdate(scope.row)"
              />
            </el-tooltip>
          </el-button-group>
        </template>
      </el-table-column>
    </el-table>

    <pagination
      v-show="total>0"
      :total="total"
      :page.sync="query.page"
      :limit.sync="query.limit"
      @pagination="getList"
    />

    <el-dialog
      :title="$t('tuk.dialog.addNew')"
      :visible.sync="dialogFormVisible"
    >
      <div
        v-loading="tukCreating"
        class="form-container"
      >
        <el-form
          ref="tukForm"
          :rules="rules"
          :model="newTuk"
          label-position="left"
          label-width="150px"
          style="max-width: 500px;"
        >
          <el-form-item
            :label="$t('tuk.table.code')"
            prop="kode_tuk"
          >
            <el-input v-model="newTuk.kode_tuk" />
          </el-form-item>
          <el-form-item
            :label="$t('table.name')"
            prop="nama"
          >
            <el-input v-model="newTuk.nama" />
          </el-form-item>
          <el-form-item
            :label="$t('tuk.table.address')"
            prop="alamat"
          >
            <el-input v-model="newTuk.alamat" />
          </el-form-item>
          <el-form-item
            :label="$t('tuk.table.telp')"
            prop="no_telp"
          >
            <el-input v-model="newTuk.no_telp" />
          </el-form-item>
          <el-form-item
            :label="$t('tuk.table.email')"
            prop="email"
          >
            <el-input v-model="newTuk.email" />
          </el-form-item>
        </el-form>
        <div
          slot="footer"
          class="dialog-footer"
        >
          <el-button @click="dialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button
            type="primary"
            @click="createTuk()"
          >
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>

    <el-dialog
      :title="$t('tuk.dialog.addNew') + ' ' + editedTuk.nama"
      :visible.sync="dialogFormUpdateVisible"
    >
      <div
        v-loading="tukCreating"
        class="form-container"
      >
        <el-form
          ref="tukForm"
          :rules="rules"
          :model="editedTuk"
          label-position="left"
          label-width="150px"
          style="max-width: 500px;"
        >
          <el-form-item
            :label="$t('tuk.table.code')"
            prop="kode_tuk"
          >
            <el-input v-model="editedTuk.kode_tuk" />
          </el-form-item>
          <el-form-item
            :label="$t('table.name')"
            prop="nama"
          >
            <el-input v-model="editedTuk.nama" />
          </el-form-item>
          <el-form-item
            :label="$t('tuk.table.address')"
            prop="alamat"
          >
            <el-input v-model="editedTuk.alamat" />
          </el-form-item>
          <el-form-item
            :label="$t('tuk.table.telp')"
            prop="no_telp"
          >
            <el-input v-model="editedTuk.no_telp" />
          </el-form-item>
          <el-form-item
            :label="$t('tuk.table.email')"
            prop="email"
          >
            <el-input v-model="editedTuk.email" />
          </el-form-item>
        </el-form>
        <div
          slot="footer"
          class="dialog-footer"
        >
          <el-button @click="dialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button
            type="primary"
            @click="updateData()"
          >
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
      // :headers="['First', 'Last', 'Handle']"
      // :rows="[
      //   ['Mark', 'Otto', '@mdo'],
      //   ['Jacob', 'Thornton', '@fat'],
      //   ['Larry', 'the Bird', '@twitter']
      // ]"

const userResource = new UserResource();
const tukResource = new Resource('tuk');

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
      tukCreating: false,
      dialogFormVisible: false,
      dialogFormUpdateVisible: false,
      newTuk: {},
      editedTuk: {
        id: 0,
        kode_tuk: '',
        nama: '',
        alamat: '',
        no_telp: '',
        email: '',
      },
      query: {
        page: 1,
        limit: 15,
        keyword: '',
        role: '',
      },
      rules: {
        kode_tuk: [{ required: true, message: 'Kode TUK is required', trigger: 'change' }],
        nama: [{ required: true, message: 'Nama TUK is required', trigger: 'blur' }],
        alamat: [{ required: true, message: 'Alamat TUK is required', trigger: 'blur' }],
        no_telp: [{ required: true, message: 'No Telephone is required', trigger: 'blur' }],
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
      const { data, meta } = await tukResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.total = meta.total;
      this.loading = false;
      console.log(this.list);
    },
    handleFilter() {
      this.query.page = 1;
      this.getList();
    },
    resetNewTuk() {
      this.newTuk = {};
    },
    handleCreate() {
      this.resetNewTuk();
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs['tukForm'].clearValidate();
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
    createTuk() {
      this.loading = true;
      this.$refs['tukForm'].validate((valid) => {
        if (valid) {
          this.tukCreating = true;
          tukResource
            .store(this.newTuk)
            .then(response => {
              this.$message({
                message: 'New TUK ' + this.newTuk.nama + ' has been created successfully.',
                type: 'success',
                duration: 5 * 1000,
              });
              this.resetNewTuk();
              this.dialogFormVisible = false;
              this.handleFilter();
            })
            .catch(error => {
              console.log(error);
            })
            .finally(() => {
              this.loading = true;
              this.tukCreating = false;
            });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    handleUpdate(tuk) {
      this.editedTuk = tuk;
      this.dialogFormUpdateVisible = true;
      console.log(this.editedTuk);
    },
    updateData() {
      this.loading = true;
      tukResource.update(this.editedTuk.id, this.editedTuk).then(() => {
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
          this.tukCreating = false;
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
