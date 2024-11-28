<template>
  <div class="container">
    <h1 class="fw-bold text-center text-uppercase">
      Jadwal Assesmen
    </h1>
    <VTable
      search-placeholder="Cari Jadwal Asesmen"
      :headers="headers"
      :rows="dataJadwalAssesmen"
      :page="query.page"
      :limit="query.limit"
      @handleSearch="handleSearch"
      @handleChangeSort="handleChangeSort"
    />
    <VPagination
      :total-entries="total"
      :per-page="query.limit"
      :loading="loading"
      @handleChangePage="handleChangePage"
    />
  </div>
</template>
 
 <script>
  import VTable from '@/components/Table/VTable';
  import VPagination from '@/components/Pagination/VPagination';
  import Resource from '@/api/resource';
  import waves from '@/directive/waves';
  import permission from '@/directive/permission';
  import { debounce } from 'lodash';
  
  const jadwalResource = new Resource('jadwal-get-list');
 
  export default {
    name: 'JadwalResource',
    components: { VTable, VPagination },
    directives: { waves, permission },
    data() {
      return {
          headers: [
            { field: "jadwal", name: "Nama Jadwal" },
            { field: "nama_skema", name: "Skema Sertifikasi" },
            { field: "nama_asesor", name: "Assesor" },
            { field: "start_date", name: "Tanggal Mulai" },
            // { field: "email", name: "" },
          ],
          dataJadwalAssesmen: [],
          loading: false,
          total: 0,
          query: {
            page: 1,
            limit: 10,
            keyword: '',
            role: '',
            order_type: 'desc',
            for_list_apl_02: false
          },
      };
    },
    created() {
      this.fetchDataJadwal();
    },
    methods: {
      async fetchDataJadwal() {
        this.loading = true;
        const { data, meta } = await jadwalResource.list(this.query);
        this.dataJadwalAssesmen = data;
        this.dataJadwalAssesmen.forEach((element, index) => {
          element['index'] = (this.query.page - 1) * this.query.limit + index + 1;
        });
        this.total = !isNaN(meta.total) ? (typeof meta.total === 'string' ? Number(meta.total) : meta.total) : 1;
        this.query.page = !isNaN(meta.current_page) ? (typeof meta.current_page === 'string' ? Number(meta.current_page) : meta.current_page) : 1;
        this.query.limit = !isNaN(meta.per_page) ? (typeof meta.per_page === 'string' ? Number(meta.per_page) : meta.per_page) : 1;
        this.loading = false;
      },
      handleSearch: debounce(function (keyword) {
        this.query.keyword = keyword
        this.fetchDataJadwal();
      }, 500),
      handleChangePage: debounce(function (newPage) {
        this.query.page = newPage
        this.fetchDataJadwal()
      }, 500),
      handleChangeSort: debounce(function (order_type) {
        this.query.order_type = order_type
        this.fetchDataJadwal();
      }, 500),
    },
  };
 </script>
 