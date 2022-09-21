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

      <el-table-column align="center" :label="$t('perangkat.table.code')">
        <template slot-scope="scope">
          <span>{{ scope.row.kode_perangkat }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('perangkat.table.name')">
        <template slot-scope="scope">
          <span>{{ scope.row.nama_perangkat }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('perangkat.table.detailName')" min-width="150px">
        <template slot-scope="scope">
          <span>{{ scope.row.nama }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('perangkat.table.versi')">
        <template slot-scope="scope">
          <span>{{ scope.row.versi }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('perangkat.table.type')">
        <template slot-scope="scope">
          <span>{{ scope.row.jenis }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('perangkat.table.qty')">
        <template slot-scope="scope">
          <span>{{ scope.row.jumlah_soal }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('perangkat.table.duration')">
        <template slot-scope="scope">
          <span>{{ scope.row.waktu_pengerjaan }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('perangkat.table.desc')">
        <template slot-scope="scope">
          <span>{{ scope.row.description }}</span>
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

    <el-dialog :title="$t('perangkat  .dialog.addNew')" :visible.sync="dialogFormVisible">
      <div v-loading="creating" class="form-container">
        <el-form ref="dataForm" :rules="rules" :model="newData" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item :label="$t('perangkat.table.master')" prop="id_perangkat">
            <el-select v-model="newData.id_perangkat" filterable clearable class="filter-item full" :placeholder="$t('perangkat.table.master')">
              <el-option v-for="item in listPerangkat" :key="item.id" :label="item.nama_perangkat" :value="item.id" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('perangkat.table.detailName')" prop="nama">
            <el-input v-model="newData.nama" />
          </el-form-item>
          <el-form-item :label="$t('perangkat.table.code')" prop="kode">
            <el-input v-model="newData.kode" />
          </el-form-item>
          <el-form-item :label="$t('perangkat.table.type')" prop="id_jenis_perangkat">
            <el-select v-model="newData.id_jenis_perangkat" filterable clearable class="filter-item full" :placeholder="$t('perangkat.table.type')">
              <el-option v-for="item in listJenis" :key="item.id" :label="item.nama" :value="item.id" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('perangkat.table.versi')" prop="versi">
            <el-input v-model="newData.versi" />
          </el-form-item>
          <el-form-item :label="$t('perangkat.table.qty')" prop="jumlah_soal">
            <el-input v-model="newData.jumlah_soal" />
          </el-form-item>
          <el-form-item :label="$t('perangkat.table.duration')" prop="waktu_pengerjaan">
            <el-input v-model="newData.waktu_pengerjaan" />
          </el-form-item>
          <el-form-item :label="$t('perangkat.table.desc')" prop="description">
            <el-input v-model="newData.description" type="textarea" />
          </el-form-item>
          <!-- <el-form-item :label="$t('perangkat.table.browse')" prop="browse">
            <el-input v-model="newData.browse" />
          </el-form-item> -->
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button type="primary" @click="create()">
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>

    <el-dialog :title="$t('tuk.dialog.addNew') + ' ' + editedData.nama" :visible.sync="dialogFormUpdateVisible">
      <div v-loading="creating" class="form-container">
        <el-form ref="dataForm" :rules="rules" :model="editedData" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item :label="$t('tuk.table.code')" prop="kode_tuk">
            <el-input v-model="editedData.kode_tuk" />
          </el-form-item>
          <el-form-item :label="$t('table.name')" prop="nama">
            <el-input v-model="editedData.nama" />
          </el-form-item>
          <el-form-item :label="$t('tuk.table.address')" prop="alamat">
            <el-input v-model="editedData.alamat" />
          </el-form-item>
          <el-form-item :label="$t('tuk.table.telp')" prop="no_telp">
            <el-input v-model="editedData.no_telp" />
          </el-form-item>
          <el-form-item :label="$t('tuk.table.email')" prop="email">
            <el-input v-model="editedData.email" />
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
import { mapGetters } from 'vuex';
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import UserResource from '@/api/user';
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import permission from '@/directive/permission'; // Permission directive

const userResource = new UserResource();
const detailPerangkatAsesmenResource = new Resource('detail-perangkat-asesmen');
const perangkatAsesmenResource = new Resource('perangkat-asesmen');
const jenisResource = new Resource('jenis-perangkat');

export default {
  name: 'DetailPerangkatAsemenList',
  components: { Pagination },
  directives: { waves, permission },
  data() {
    return {
      list: null,
      listPerangkat: null,
      listJenis: null,
      total: 0,
      loading: true,
      downloading: false,
      creating: false,
      dialogFormVisible: false,
      dialogFormUpdateVisible: false,
      newData: {},
      editedData: {
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
        nama: [{ required: true, message: 'Nama Detail Perangkat is required', trigger: 'blur' }],
        kode: [{ required: true, message: 'Kode Detail Perangkat is required', trigger: 'blur' }],
        id_perangkat: [{ required: true, message: 'Master Perangkat is required', trigger: 'blur' }],
      },
    };
  },
  computed: {
    ...mapGetters([
      'username',
      'userId',
    ]),
  },
  created() {
    this.getList();
  },
  methods: {
    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      // get data skema
      const dataPerangkat = await perangkatAsesmenResource.list();
      this.listPerangkat = dataPerangkat.data;
      // get data skema
      const dataJenis = await jenisResource.list();
      this.listJenis = dataJenis.data;
      // get data perangkat / list table
      const { data, meta } = await detailPerangkatAsesmenResource.list(this.query);
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
    resetnewData() {
      this.newData = {};
    },
    handleCreate() {
      this.resetnewData();
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs['dataForm'].clearValidate();
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
    create() {
      this.loading = true;
      this.newData.author = this.userId;
      this.$refs['dataForm'].validate((valid) => {
        if (valid) {
          this.creating = true;
          detailPerangkatAsesmenResource
            .store(this.newData)
            .then(response => {
              this.$message({
                message: 'New TUK ' + this.newData.nama + ' has been created successfully.',
                type: 'success',
                duration: 5 * 1000,
              });
              this.resetnewData();
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
    handleUpdate(tuk) {
      this.editedData = tuk;
      this.dialogFormUpdateVisible = true;
      console.log(this.editedData);
    },
    updateData() {
      this.loading = true;
      detailPerangkatAsesmenResource.update(this.editedData.id, this.editedData).then(() => {
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
