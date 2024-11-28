<template>
  <div class="container">
    <h1 class="fw-bold text-center text-uppercase">
      Daftar Tuk
    </h1>
    <VTable
      search-placeholder="Cari Tuk"
      :headers="headers"
      :rows="dataTuk"
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
  
  const tukResource = new Resource('tuk');
 
  export default {
    name: 'TukResource',
    components: { VTable, VPagination },
    directives: { waves, permission },
    data() {
      return {
          headers: [
            { field: "kode_tuk", name: "Kode TUK" },
            { field: "nama", name: "Nama" },
            { field: "alamat", name: "Alamat" },
            { field: "no_telp", name: "Nomor Telepon" },
            { field: "email", name: "Email" },
            // { field: "link_maps", name: "Link Maps" }
          ],
          dataTuk: [],
          loading: false,
          total: 0,
          query: {
            page: 1,
            limit: 10,
            keyword: '',
            role: '',
            order_type: 'desc'
          },
      };
    },
    created() {
      this.fetchDataTuk();
    },
    methods: {
      async fetchDataTuk() {
        this.loading = true;
        const { data, meta } = await tukResource.list(this.query);
        this.dataTuk = data;
        this.dataTuk.forEach((element, index) => {
          element['index'] = (this.query.page - 1) * this.query.limit + index + 1;
        });
        this.total = !isNaN(meta.total) ? (typeof meta.total === 'string' ? Number(meta.total) : meta.total) : 1;
        this.query.page = !isNaN(meta.current_page) ? (typeof meta.current_page === 'string' ? Number(meta.current_page) : meta.current_page) : 1;
        this.query.limit = !isNaN(meta.per_page) ? (typeof meta.per_page === 'string' ? Number(meta.per_page) : meta.per_page) : 1;
        this.loading = false;
      },
      handleSearch: debounce(function (keyword) {
        this.query.keyword = keyword
        this.fetchDataTuk();
      }, 500),
      handleChangePage: debounce(function (newPage) {
        this.query.page = newPage
        this.fetchDataTuk()
      }, 500),
      handleChangeSort: debounce(function (order_type) {
        this.query.order_type = order_type
        this.fetchDataTuk();
      }, 500),
    },
  };
 </script>
 