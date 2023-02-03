<template>
  <div>
    <el-tabs tab-position="left" style="height: 100%;">
      <el-tab-pane label="FR.APL">AP</el-tab-pane>
      <el-tab-pane label="FR.MAPA">Mapa</el-tab-pane>
      <el-tab-pane label="Skema">Skmea</el-tab-pane>
      <el-tab-pane label="FR.AK">AK</el-tab-pane>
      <el-tab-pane label="FR.IA">IA</el-tab-pane>
      <el-tab-pane label="FR.VA">VA</el-tab-pane>
    </el-tabs>
  </div>
</template>
<!-- <script>
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
</script> -->
