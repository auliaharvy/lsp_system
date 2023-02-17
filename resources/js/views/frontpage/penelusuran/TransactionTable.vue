<template>
  <div>
    <div class="filter-container">
      <el-input v-model="query.keyword" :placeholder="$t('table.keyword')" style="width: 200px;" class="filter-item" @keyup.enter.native="handleFilter" />
      <el-button v-waves class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter">
        {{ $t('table.search') }}
      </el-button>
      <!-- <el-button class="filter-item" style="margin-left: 10px;" type="primary" icon="el-icon-plus" @click="handleCreate">
        {{ $t('table.add') }}
      </el-button> -->
      <el-button v-waves :loading="downloading" class="filter-item" type="primary" icon="el-icon-download" @click="handleDownload">
        {{ $t('table.export') }}
      </el-button>
    </div>
    <el-table
      v-loading="loading"
      :data="list"
      border
      fit
      style="width: 100%;"
      :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
    >
      <el-table-column label="No" width="50" align="center">
        <template slot-scope="scope">
          {{ scope.row.index }}
        </template>
      </el-table-column>
      <el-table-column align="left" label="NIK" min-width="100px">
        <template slot-scope="scope">
          <span> {{ scope.row.nik }} </span>
        </template>
      </el-table-column>

      <el-table-column align="left" label="Nama" min-width="100px">
        <template slot-scope="scope">
          <span> {{ scope.row.nama_lengkap }} </span>
        </template>
      </el-table-column>

      <el-table-column align="left" label="Jenis Kelamin" min-width="100px">
        <template slot-scope="scope">
          <span> {{ scope.row.jenis_kelamin }} </span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="keahlian" min-width="80px">
        <template slot-scope="scope">
          {{ scope.row.keahlian }}
        </template>
      </el-table-column>

      <el-table-column align="left" label="Bulan" min-width="80px">
        <template slot-scope="scope">
          <span>{{ scope.row.bulan }} </span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Tahun" min-width="80px">
        <template slot-scope="scope">
          <span> {{ scope.row.tahun }} </span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Status" min-width="80px">
        <template slot-scope="scope">
          <span> {{ scope.row.status }} </span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Tempat" min-width="80px">
        <template slot-scope="scope">
          <span> {{ scope.row.tempat }} </span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="sebagai" min-width="80px">
        <template slot-scope="scope">
          <span> {{ scope.row.sebagai }} </span>
        </template>
      </el-table-column>

    </el-table>
    <pagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" @pagination="getList" />
    <router-link :to="{ name: 'homepage' }">
      <el-button style="margin-top: 12px">back to home</el-button>
    </router-link>

    <!-- <el-dialog title="Tambah Rekam Catatan" :visible.sync="dialogFormVisible">
      <div v-loading="asesorCreating" class="form-container">
        <el-form ref="assesorForm" :rules="rules" :model="newData" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item label="$NIK" prop="nik">
            <el-input v-model="newData.no_reg" />
          </el-form-item>
          <el-form-item :label="$t('asesor.table.name')" prop="nama">
            <el-input v-model="newData.nama" />
          </el-form-item>
          <el-form-item :label="$t('asesor.table.email')" prop="email">
            <el-input v-model="newData.email" />
          </el-form-item>
          <el-form-item :label="$t('asesor.table.hp')" prop="hp">
            <el-input v-model="newData.hp" />
          </el-form-item>
          <el-form-item :label="$t('asesor.table.status')" prop="status_assesor">
            <el-select v-model="newData.status_asesor" class="filter-item" placeholder="Please select Status">
              <el-option v-for="item in statusAssesor" :key="item" :label="item | uppercaseFirst" :value="item" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('tuk.table.email')" prop="email">
            <el-input v-model="newData.email" />
          </el-form-item>
          <el-form-item
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
          </el-form-item>
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
    </el-dialog> -->
  </div>
</template>
<script>
import { mapGetters } from 'vuex';
import Pagination from '@/components/Pagination';
import Resource from '@/api/resource';

const listResource = new Resource('tamatan');
const skemaResource = new Resource('skema');

export default {
  components: { Pagination },
  filters: {
    statusFilter(status) {
      const statusMap = {
        success: 'success',
        pending: 'danger',
      };
      return statusMap[status];
    },
    orderNoFilter(str) {
      return str;
    },
  },
  data() {
    return {
      list: null,
      loading: true,
      dialog: false,
      newData: null,
      query: {
        page: 1,
        limit: 5,
        keyword: '',
        role: '',
        user_id: null,
      },
    };
  },
  computed: {
    ...mapGetters([
      'username',
      'userId',
      'roles',
      'user',
    ]),
  },
  mounted() {
    this.getList();
  },
  created() {
    this.getList();
  },
  methods: {
    async getList() {
      this.query.role = this.roles[0];
      this.query.user_id = this.userId;
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
  },
};
</script>
