<template>
  <div>
    <el-table
      v-loading="loading"
      :data="list"
      border
      fit
      style="width: 100%;padding-top: 15px;"
      :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
    >
      <el-table-column label="No" width="50" align="center">
        <template slot-scope="scope">
          {{ scope.row.index }}
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
          <span>{{ scope.row.nama_peserta }} ({{ scope.row.email_peserta }})</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('uji.table.mulai')">
        <template slot-scope="scope">
          <span> {{ scope.row.mulai }} </span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Status">
        <template slot-scope="scope">
          <el-progress type="dashboard" :percentage="scope.row.persentase" :color="colors" />
          <br>
          <el-tag v-if="scope.row.status === 1" type="success" effect="dark"> Selesai </el-tag>
          <el-tag v-if="scope.row.status === 0" type="danger" effect="dark"> Belum Selesai </el-tag>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Act">
        <template slot-scope="scope">
          <el-button icon="el-icon-search" circle @click="dialog = true" />
          <el-dialog :title="scope.row.jadwal + ' / ' + scope.row.nama_peserta" :visible.sync="dialog">
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
                        <router-link :to="{ name: 'form-apl-01', params: { id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                          <span class="link">APL 01  <i v-if="scope.row.id_apl_01 !== null" type="success" class="el-icon-check" /></span>
                        </router-link>
                      </el-tooltip>
                    </li>
                    <li class="list-progress">
                      <el-tooltip class="item" effect="dark" content="View FR-APL-02" placement="top-start">
                        <router-link :to="{ name: 'form-apl-02', params: { asesor: scope.row.asesor ,id_apl_01: scope.row.id_apl_01, id_apl_02: scope.row.id_apl_02, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                          <span class="link">APL 02  <i v-if="scope.row.id_apl_02 !== null" type="success" class="el-icon-check" /></span>
                        </router-link>
                      </el-tooltip>
                    </li>
                    <li class="list-progress">
                      MAPA 01  <i v-if="scope.row.id_mapa_01 !== null" type="success" class="el-icon-check" />
                    </li>
                    <li class="list-progress">
                      Skema  <i v-if="scope.row.id_skema !== null" type="success" class="el-icon-check" />
                    </li>
                    <li class="list-progress">
                      <el-tooltip class="item" effect="dark" content="View FR-MAPA-02" placement="top-start">
                        <router-link :to="{ name: 'form-mapa-02', params: { id_mapa_02: scope.row.id_mapa_02, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                          <span class="link">MAPA 02  <i v-if="scope.row.id_mapa_02 !== null" type="success" class="el-icon-check" /></span>
                        </router-link>
                      </el-tooltip>
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
                        <span class="link">AK 04  <i v-if="scope.row.id_ak_04!== null" type="success" class="el-icon-check" /></span>
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
                      <el-tooltip class="item" effect="dark" content="View FR-IA-05" placement="top-start">
                        <router-link :to="{ name: 'form-ia-05', params: { id_ia_05: scope.row.id_ia_05, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                          <span class="link">IA 05  <i v-if="scope.row.id_ia_05!== null" type="success" class="el-icon-check" /></span>
                        </router-link>
                      </el-tooltip>
                    </li>
                    <li class="list-progress">
                      <el-tooltip class="item" effect="dark" content="View FR-IA-06" placement="top-start">
                        <router-link :to="{ name: 'form-ia-06', params: { id_ia_06: scope.row.id_ia_06, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                          <span class="link">IA 06  <i v-if="scope.row.id_ia_06!== null" type="success" class="el-icon-check" /></span>
                        </router-link>
                      </el-tooltip>
                    </li>
                    <li class="list-progress">
                      <el-tooltip class="item" effect="dark" content="View FR-IA-07" placement="top-start">
                        <router-link :to="{ name: 'form-ia-07', params: { id_ia_07: scope.row.id_ia_07, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                          <span class="link">IA 07  <i v-if="scope.row.id_ia_07!== null" type="success" class="el-icon-check" /></span>
                        </router-link>
                      </el-tooltip>
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
                      <el-tooltip class="item" effect="dark" content="View FR-VA" placement="top-start">
                        <router-link :to="{ name: 'form-va', params: { id_va: scope.row.id_va, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                          <span class="link">VA  <i v-if="scope.row.id_va !== null" type="success" class="el-icon-check" /></span>
                        </router-link>
                      </el-tooltip>
                    </li>
                  </ul>
                </div>
              </el-col>
            </el-row>
          </el-dialog>
        </template>
      </el-table-column>
    </el-table>
    <pagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" @pagination="getList" />
  </div>
</template>
<script>
import { mapGetters } from 'vuex';
import Pagination from '@/components/Pagination';
import { fetchList } from '@/api/order';
import Resource from '@/api/resource';

const listResource = new Resource('uji-komp-get');
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
      query: {
        page: 1,
        limit: 5,
        keyword: '',
        role: '',
        user_id: null,
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
      'roles',
      'user',
    ]),
  },
  created() {
    this.fetchData();
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
    async fetchData() {
      const { data } = await fetchList();
      this.list = data.items.slice(0, 8);
      this.loading = false;
    },
  },
};
</script>
