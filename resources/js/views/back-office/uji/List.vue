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

      <el-table-column type="expand">
        <template slot-scope="scope">
          <el-row :gutter="20">
            <el-col class="table-expand" :span="8">
              <div class="grid-content">
                <h3>Progress Uji Kompetensi</h3>
                <el-progress type="dashboard" :percentage="scope.row.persentase" :color="colors" />
              </div>
            </el-col>
            <el-col class="table-expand" :span="4">
              <div class="grid-content">
                <ul>
                  <li class="list-progress">
                    <el-tooltip class="item" effect="dark" content="View FR-APL-01" placement="top-start">
                      <router-link :to="{ name: 'form-ia-01', params: { id_apl_01: scope.row.id_apl_01 }}">
                        <span class="link">APL 01  <i v-if="scope.row.id_apl_01 !== null" type="success" class="el-icon-check" /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    APL 02  <i v-if="scope.row.id_apl_02 !== null" type="success" class="el-icon-check" />
                  </li>
                  <li class="list-progress">
                    MAPA 01  <i v-if="scope.row.id_mapa_01 !== null" type="success" class="el-icon-check" />
                  </li>
                  <li class="list-progress">
                    Skema  <i v-if="scope.row.id_skema !== null" type="success" class="el-icon-check" />
                  </li>
                  <li class="list-progress">
                    MAPA 02  <i v-if="scope.row.id_mapa_02 !== null" type="success" class="el-icon-check" />
                  </li>
                  <li class="list-progress">
                    <el-tooltip class="item" effect="dark" content="View FR-IA-01" placement="top-start">
                      <router-link :to="{ name: 'form-ak-01', params: { id_ak_01: scope.row.id_ak_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">AK 01  <i v-if="scope.row.id_ak_01 !== null" type="success" class="el-icon-check" /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    <router-link :to="{ name: 'form-ak-04', params: { id_ak_04: scope.row.id_ak_04, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                      <span class="link">AK 04  <i v-if="scope.row.id_ak_03!== null" type="success" class="el-icon-check" /></span>
                    </router-link>
                  </li>
                  <li class="list-progress">
                    <el-tooltip class="item" effect="dark" content="View FR-IA-01" placement="top-start">
                      <router-link :to="{ name: 'form-ia-01', params: { id_ia_01: scope.row.id_ia_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">IA 01  <i v-if="scope.row.id_ia_01 !== null" type="success" class="el-icon-check" /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    <el-tooltip class="item" effect="dark" content="View FR-IA-02" placement="top-start">
                      <router-link :to="{ name: 'form-ia-02', params: { id_ia_02: scope.row.id_ia_02, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">IA 02  <i v-if="scope.row.id_ia_02 !== null" type="success" class="el-icon-check" /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                </ul>
              </div>
            </el-col>
            <el-col class="table-expand" :span="4">
              <div class="grid-content">
                <ul>
                  <li class="list-progress">
                    <el-tooltip class="item" effect="dark" content="View FR-IA-01" placement="top-start">
                      <router-link :to="{ name: 'form-ia-03', params: { id_ia_03: scope.row.id_ia_03, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">IA 03  <i v-if="scope.row.id_ia_03 !== null" type="success" class="el-icon-check" /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    IA 05  <i v-if="scope.row.id_ia_05 !== null" type="success" class="el-icon-check" />
                  </li>
                  <li class="list-progress">
                    IA 06  <i v-if="scope.row.id_ia_06 !== null" type="success" class="el-icon-check" />
                  </li>
                  <li class="list-progress">
                    IA 07  <i v-if="scope.row.id_ia_07!== null" type="success" class="el-icon-check" />
                  </li>
                  <li class="list-progress">
                    <el-tooltip class="item" effect="dark" content="View FR-IA-11" placement="top-start">
                      <router-link :to="{ name: 'form-ia-11', params: { id_ia_11: scope.row.id_ia_11, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">IA 11  <i v-if="scope.row.id_ia_11!== null" type="success" class="el-icon-check" /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    <el-tooltip class="item" effect="dark" content="View FR-AK-02" placement="top-start">
                      <router-link :to="{ name: 'form-ak-02', params: { id_ak_02: scope.row.id_ak_02, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">AK 02  <i v-if="scope.row.id_ak_02!== null" type="success" class="el-icon-check" /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    <el-tooltip class="item" effect="dark" content="View FR-AK-03" placement="top-start">
                      <router-link :to="{ name: 'form-ak-03', params: { id_ak_03: scope.row.id_ak_03, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">AK 03  <i v-if="scope.row.id_ak_03!== null" type="success" class="el-icon-check" /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    <el-tooltip class="item" effect="dark" content="View FR-AK-05" placement="top-start">
                      <router-link :to="{ name: 'form-ak-05', params: { id_ak_05: scope.row.id_ak_05, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">AK 05  <i v-if="scope.row.id_ak_05 !== null" type="success" class="el-icon-check" /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    <el-tooltip class="item" effect="dark" content="View FR-AK-06" placement="top-start">
                      <router-link :to="{ name: 'form-ak-06', params: { id_ak_06: scope.row.id_ak_06, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">AK 06  <i v-if="scope.row.id_ak_06 !== null" type="success" class="el-icon-check" /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    VA  <i v-if="scope.row.id_va !== null" type="success" class="el-icon-check" />
                  </li>
                </ul>
              </div>
            </el-col>
          </el-row>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('uji.table.schedule')">
        <template slot-scope="scope">
          <span>{{ scope.row.mulai }} - {{ scope.row.selesai }} / {{ scope.row.skema_sertifikasi }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('uji.table.asesi')">
        <template slot-scope="scope">
          <span>{{ scope.row.nama_peserta }} ({{ scope.row.email_peserta }})</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Status">
        <template slot-scope="scope">
          <el-tag v-if="scope.row.status === 1" type="success" effect="dark"> Selesai </el-tag>
          <el-tag v-if="scope.row.status === 0" type="danger" effect="dark"> Belum Selesai </el-tag>
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
          <el-form-item :label="$t('perangkat.table.skema')" prop="id_skema">
            <el-select v-model="newData.id_skema" filterable clearable class="filter-item full" :placeholder="$t('perangkat.table.skema')">
              <el-option v-for="item in listSkema" :key="item.id" :label="item.skema_sertifikasi" :value="item.id" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('perangkat.table.name')" prop="nama_perangkat">
            <el-input v-model="newData.nama_perangkat" />
          </el-form-item>
          <el-form-item :label="$t('perangkat.table.code')" prop="kode_perangkat">
            <el-input v-model="newData.kode_perangkat" />
          </el-form-item>
          <el-form-item :label="$t('perangkat.table.versi')" prop="versi">
            <el-input v-model="newData.versi" />
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
const listResource = new Resource('uji-komp-get');
const skemaResource = new Resource('skema');

export default {
  name: 'PerangkatAsemenList',
  components: { Pagination },
  directives: { waves, permission },
  data() {
    return {
      list: null,
      listSkema: null,
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
        kode_perangkat: [{ required: true, message: 'Kode Perangkat is required', trigger: 'change' }],
        nama_perangkat: [{ required: true, message: 'Nama Perangkat is required', trigger: 'blur' }],
        id_skema: [{ required: true, message: 'Skema Sertifikasi is required', trigger: 'blur' }],
      },
      colors: [
        { color: '#f56c6c', percentage: 20 },
        { color: '#e6a23c', percentage: 40 },
        { color: '#5cb87a', percentage: 60 },
        { color: '#1989fa', percentage: 80 },
        { color: '#6f7ad3', percentage: 100 },
      ],
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
      const dataSkema = await skemaResource.list();
      this.listSkema = dataSkema.data;
      // get data perangkat / list table
      const { data, meta } = await listResource.list(this.query);
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
          listResource
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
      listResource.update(this.editedData.id, this.editedData).then(() => {
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
.table-expand {
  text-align: center;
  margin-left: 20px;
}
.list-progress {
  text-align: left;
  margin-left: 20px;
}
.el-icon-check {
  font-size: 20px;
  color: green;
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

  .el-row {
    margin-bottom: 20px;
    &:last-child {
      margin-bottom: 0;
    }
  }
  .link {
    color: #1890ff;
  }
  .el-col {
    border-radius: 4px;
  }
  .bg-purple-dark {
    background: #99a9bf;
  }
  .bg-purple {
    background: #d3dce6;
  }
  .bg-purple-light {
    background: #e5e9f2;
  }
  .grid-content {
    border-radius: 4px;
    min-height: 36px;
  }
  .row-bg {
    padding: 10px 0;
    background-color: #f9fafc;
  }
}
</style>
