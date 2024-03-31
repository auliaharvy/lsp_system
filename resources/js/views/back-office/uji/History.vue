<template>
  <div class="app-container">
    <div class="filter-container">
      <el-select
        v-model="query.id_jadwal"
        filterable
        clearable
        class="filter-item full"
        placeholder="pilih jadwal"
      >
        <el-option
          v-for="item in listJadwal"
          :key="item.id"
          :label="item.jadwal + ' / ' + item.nama_asesor + ' / ' + item.start_date"
          :value="item.id"
        />
      </el-select>
      <el-select
        v-model="query.id_skema"
        filterable
        clearable
        class="filter-item full"
        placeholder="pilih skema"
      >
        <el-option
          v-for="item in listSkema"
          :key="item.id"
          :label="item.skema_sertifikasi"
          :value="item.id"
        />
      </el-select>
      <el-input v-model="query.keyword" :placeholder="$t('table.keyword')" style="width: 200px;" class="filter-item" @keyup.enter.native="handleFilter" />
      <el-button v-waves class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter">
        {{ $t('table.search') }}
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
      <el-table-column label="No" width="50" align="center">{
        <template slot-scope="scope">
          {{ scope.$index + 1 }}
        </template>
      </el-table-column>
      <el-table-column align="left" :label="$t('uji.table.schedule')" min-width="100px">
        <template slot-scope="scope">
          <span> {{ scope.row.jadwal }} </span>
        </template>
      </el-table-column>
      <el-table-column align="left" :label="$t('uji.table.skema')" min-width="150px">
        <template slot-scope="scope">
          <span> {{ scope.row.kode_skema }} / {{ scope.row.skema_sertifikasi }} </span>
        </template>
      </el-table-column>

      <el-table-column align="left" :label="$t('jadwal.table.asesor')">
        <template slot-scope="scope">
          {{ scope.row.asesor }}
        </template>
      </el-table-column>

      <el-table-column align="left" :label="$t('uji.table.asesi')">
        <template slot-scope="scope">
          <span>{{ scope.row.nama_peserta }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('uji.table.mulai')">
        <template slot-scope="scope">
          <span> {{ scope.row.mulai }} </span>
        </template>
      </el-table-column>
      <el-table-column v-if="checkRole(['admin'])" align="center" label="Action">
        <template slot-scope="scope">
          <router-link :to="{ name: 'preview-apl-01', params:{ iduji: scope.row.id, asesor: scope.row.asesor }}">
            <el-button type="primary" icon="el-icon-view">Preview</el-button>
          </router-link>
        </template>
      </el-table-column>}
    </el-table>
    <pagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" @pagination="getList" />
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import Resource from '@/api/resource';
import checkRole from '@/utils/role';

const listResource = new Resource('history');
const skemaResource = new Resource('skema');
const jadwalResource = new Resource('jadwal-get');

export default {
  components: { Pagination },
  data() {
    return {
      query: {
        page: 1,
        limit: 10,
        keyword: '',
        role: '',
        user_id: null,
        id_jadwal: null,
        id_skema: null,
      },
      loading: true,
      list: null,
      listJadwal: null,
      listSkema: null,
      total: 0,
    };
  },
  computed: {
    ...mapGetters([
      'roles',
    ]),
  },
  created() {
    this.getList();
    this.getListJadwal();
    this.getListSkema();
  },
  methods: {
    checkRole,
    handleFilter() {
      this.query.page = 1;
      this.getList();
    },
    async getList() {
      this.query.role = this.roles[0];
      this.query.user_id = this.userId;
      const { limit, page } = this.query;
      this.loading = true;
      listResource.list(this.query).then((res) => {
        this.list = res.data;
        this.list.forEach((element, index) => {
          element['index'] = (page - 1) * limit + index + 1;
        });
        this.total = res.total;
        this.loading = false;
      });
    },
    async getListJadwal() {
      const { data } = await jadwalResource.list({ limit: 1000 });
      this.listJadwal = data;
    },
    async getListSkema() {
      const { data } = await skemaResource.list({ limit: 1000 });
      this.listSkema = data;
    },
  },
};
</script>
