<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input
        v-model="query.keyword"
        :placeholder="$t('table.keyword')"
        style="width: 200px"
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
        style="margin-left: 10px"
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
      <el-table-column align="center" label="No" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.index }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('jadwal.table.skema')">
        <template slot-scope="scope">
          <span>{{ scope.row.nama_skema }}</span>
        </template>
      </el-table-column>

      <el-table-column align="left" :label="$t('jadwal.table.asesor')">
        <template slot-scope="scope">
          <div
            v-for="(asesor, i) in scope.row.asesor"
            :key="asesor.nama_asesor"
          >
            {{ i + 1 + '. ' + asesor.nama_asesor }}
          </div>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('jadwal.table.tuk')">
        <template slot-scope="scope">
          <span>{{ scope.row.nama_tuk }}</span>
        </template>
      </el-table-column>

      <el-table-column
        align="center"
        :label="$t('jadwal.table.start')"
        min-width="150px"
      >
        <template slot-scope="scope">
          <span>{{ scope.row.start_date }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('jadwal.table.end')">
        <template slot-scope="scope">
          <span>{{ scope.row.end_date }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Actions" width="120">
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
      v-show="total > 0"
      :total="total"
      :page.sync="query.page"
      :limit.sync="query.limit"
      @pagination="getList"
    />

    <el-dialog
      :title="$t('jadwal.dialog.addNew')"
      :visible.sync="dialogFormVisible"
    >
      <div v-loading="creating" class="form-container">
        <el-form
          ref="dataForm"
          :rules="rules"
          :model="newData"
          label-position="left"
          label-width="150px"
          style="max-width: 500px"
        >
          <el-form-item :label="$t('jadwal.table.skema')" prop="id_skema">
            <el-select
              v-model="newData.id_skema"
              filterable
              clearable
              class="filter-item full"
              :placeholder="$t('jadwal.table.skema')"
            >
              <el-option
                v-for="item in listSkema"
                :key="item.id"
                :label="item.skema_sertifikasi"
                :value="item.id"
              />
            </el-select>
          </el-form-item>

          <el-form-item :label="$t('jadwal.table.tuk')" prop="id_tuk">
            <el-select
              v-model="newData.id_tuk"
              filterable
              clearable
              class="filter-item full"
              :placeholder="$t('jadwal.table.tuk')"
            >
              <el-option
                v-for="item in listTuk"
                :key="item.id"
                :label="item.nama"
                :value="item.id"
              />
            </el-select>
          </el-form-item>

          <el-form-item :label="$t('jadwal.table.start')" prop="start_date">
            <el-date-picker
              v-model="newData.start_date"
              type="date"
              placeholder="Pick a day"
            />
          </el-form-item>

          <el-form-item
            :label="$t('jadwal.table.persyaratan')"
            prop="persyaratan"
          >
            <el-input v-model="newData.persyaratan" type="textarea" />
          </el-form-item>

          <el-form-item :label="$t('jadwal.table.end')" prop="end_date">
            <el-date-picker
              v-model="newData.end_date"
              type="date"
              placeholder="Pick a day"
            />
          </el-form-item>

          <el-form-item :label="$t('jadwal.table.asesor')" prop="asesor">
            <el-select v-model="newData.asesor" multiple placeholder="Select">
              <el-option
                v-for="item in listAsesor"
                :key="item.id"
                :label="item.nama"
                :value="item.id"
              />
            </el-select>
          </el-form-item>

          <el-form-item
            :label="$t('jadwal.table.perangkat')"
            prop="id_perangkat"
          >
            <el-select
              v-model="newData.id_perangkat"
              filterable
              clearable
              class="filter-item full"
              :placeholder="$t('jadwal.table.perangkat')"
            >
              <el-option
                v-for="item in listPerangkat"
                :key="item.id"
                :label="item.nama"
                :value="item.id"
              />
            </el-select>
          </el-form-item>
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

    <el-dialog
      :title="$t('tuk.dialog.addNew') + ' ' + editedData.nama"
      :visible.sync="dialogFormUpdateVisible"
    >
      <div v-loading="creating" class="form-container">
        <el-form
          ref="dataForm"
          :rules="rules"
          :model="editedData"
          label-position="left"
          label-width="150px"
          style="max-width: 500px"
        >
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
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import permission from '@/directive/permission'; // Permission directive

const jadwalResource = new Resource('jadwal');
const skemaResource = new Resource('skema');
const tukResource = new Resource('tuk');
const perangkatResource = new Resource('perangkat-asesmen');
const asesorResource = new Resource('assesor');

export default {
  name: 'JadwalList',
  components: { Pagination },
  directives: { waves, permission },
  data() {
    return {
      list: null,
      listSkema: null,
      listTuk: null,
      listAsesor: null,
      listPerangkat: null,
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
        kode_perangkat: [
          {
            required: true,
            message: 'Kode Perangkat is required',
            trigger: 'change',
          },
        ],
        nama_perangkat: [
          {
            required: true,
            message: 'Nama Perangkat is required',
            trigger: 'blur',
          },
        ],
        id_skema: [
          {
            required: true,
            message: 'Skema Sertifikasi is required',
            trigger: 'blur',
          },
        ],
      },
    };
  },
  computed: {
    ...mapGetters(['username', 'userId']),
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
      // get data tuk
      const dataTuk = await tukResource.list();
      this.listTuk = dataTuk.data;
      // get data asesor
      const dataAsesor = await asesorResource.list();
      this.listAsesor = dataAsesor.data;
      // get data perangkat
      const dataPerangkat = await perangkatResource.list();
      this.listPerangkat = dataPerangkat.data;
      // get data jadwal / list table
      const { data, meta } = await jadwalResource.list(this.query);
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
      this.$confirm(
        'This will permanently delete user ' + name + '. Continue?',
        'Warning',
        {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning',
        }
      )
        .then(() => {
          jadwalResource
            .destroy(id)
            .then((response) => {
              this.$message({
                type: 'success',
                message: 'Delete completed',
              });
              this.handleFilter();
            })
            .catch((error) => {
              console.log(error);
            });
        })
        .catch(() => {
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
          jadwalResource
            .store(this.newData)
            .then((response) => {
              this.$message({
                message:
                  'New Jadwal ' +
                  this.newData.nama +
                  ' has been created successfully.',
                type: 'success',
                duration: 5 * 1000,
              });
              this.resetnewData();
              this.dialogFormVisible = false;
              this.handleFilter();
            })
            .catch((error) => {
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
      jadwalResource
        .update(this.editedData.id, this.editedData)
        .then(() => {
          this.getList();
          this.dialogFormUpdateVisible = false;
          this.$notify({
            title: 'Success',
            message: 'Updated successfully',
            type: 'success',
            duration: 2000,
          });
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loading = true;
          this.creating = false;
        });
    },
    handleDownload() {
      this.downloading = true;
      import('@/vendor/Export2Excel').then((excel) => {
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
      return jsonData.map((v) => filterVal.map((j) => v[j]));
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
