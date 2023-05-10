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

      <el-table-column align="center" :label="$t('MUK')">
        <template slot-scope="scope">
          <span>{{ scope.row.muk }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Actions" width="120">
        <template slot-scope="scope">
          <el-button-group>
            <el-tooltip class="item" effect="dark" content="Delete" placement="top-end">
              <el-button v-permission="['manage user']" type="danger" size="small" icon="el-icon-delete" @click="handleDelete(scope.row)" />
            </el-tooltip>
          </el-button-group>
        </template>
      </el-table-column>

    </el-table>

    <pagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" @pagination="getList" />

    <el-dialog :title="$t('tuk.dialog.addNew')" :visible.sync="dialogFormVisible">
      <div v-loading="mapa2Creating" class="form-container">
        <el-form ref="mapa2Form" :rules="rules" :model="newMapa2" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item :label="$t('table.muk')" prop="nama">
            <el-input v-model="newMapa2.muk" />
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button type="primary" @click="createMapa2()">
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>

    <el-dialog :title="$t('tuk.dialog.addNew') + ' ' + editedMapa2.nama" :visible.sync="dialogFormUpdateVisible">
      <div v-loading="mapa2Creating" class="form-container">
        <el-form ref="mapa2Form" :rules="rules" :model="editedMapa2" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item :label="$t('table.name')" prop="MUK">
            <el-input v-model="editedMapa2.nama" />
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
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import permission from '@/directive/permission'; // Permission directive

const mapa2Resource = new Resource('mapa2');
const deleteResource = new Resource('del-mapa2');

export default {
  name: 'Mapa2List',
  components: { Pagination },
  directives: { waves, permission },
  data() {
    return {
      list: null,
      total: 0,
      loading: true,
      downloading: false,
      mapa2Creating: false,
      dialogFormVisible: false,
      dialogFormUpdateVisible: false,
      newMapa2: {
        muk: '',
      },
      editedMapa2: {
        id: 0,
        nama: '',
      },
      query: {
        page: 1,
        limit: 15,
        keyword: '',
        role: '',
      },
      rules: {
        muk: [{ required: true, message: 'MUK is required', trigger: 'blur' }],
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
      const { data, meta } = await mapa2Resource.list(this.query);
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
    resetnewMapa2() {
      this.newMapa2 = {};
    },
    handleCreate() {
      this.resetnewMapa2();
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs['mapa2Form'].clearValidate();
      });
    },
    handleDelete(data) {
      // this.$confirm('This will permanently delete ' + muk + '. Continue?', 'Warning', {
      //   confirmButtonText: 'OK',
      //   cancelButtonText: 'Cancel',
      //   type: 'warning',
      // }).then(() => {
      //   mapa2Resource.destroy(id).then(response => {
      //     this.$message({
      //       type: 'success',
      //       message: 'Delete completed',
      //     });
      //     this.handleFilter();
      //   }).catch(error => {
      //     console.log(error);
      //   });
      // }).catch(() => {
      //   this.$message({
      //     type: 'info',
      //     message: 'Delete canceled',
      //   });
      // });
      var deleteData = data;
      this.$confirm('This will permanently delete "' + deleteData.muk + '".Continue?', 'Warning', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(() => {
        deleteResource.store(deleteData).then(response => {
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
    createMapa2() {
      this.loading = true;
      this.$refs['mapa2Form'].validate((valid) => {
        if (valid) {
          this.mapa2Creating = true;
          mapa2Resource
            .store(this.newMapa2)
            .then(response => {
              this.$message({
                message: 'New MUK ' + this.newMapa2.muk + ' has been created successfully.',
                type: 'success',
                duration: 5 * 1000,
              });
              this.resetnewMapa2();
              this.dialogFormVisible = false;
              this.handleFilter();
            })
            .catch(error => {
              console.log(error);
            })
            .finally(() => {
              this.loading = true;
              this.mapa2Creating = false;
            });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    handleUpdate(tuk) {
      this.editedMapa2 = tuk;
      this.dialogFormUpdateVisible = true;
      console.log(this.editedMapa2);
    },
    updateData() {
      this.loading = true;
      mapa2Resource.update(this.editedMapa2.id, this.editedMapa2).then(() => {
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
          this.mapa2Creating = false;
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
