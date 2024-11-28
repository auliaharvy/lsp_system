<template>
  <div class="container">
    <h1 class="fw-bold text-center text-uppercase">
      Daftar Pemegang Sertifikasi
    </h1>
    <VTable
      search-placeholder="Cari Berdasarkan Nama"
      :headers="headers"
      :rows="dataPemegangSertifikat"
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

const pemegangSertifikatResource = new Resource('pemegang-sertifikat');

export default {
  name: 'PemegangSertifikat',
  components: { VTable, VPagination },
  directives: { waves, permission },
  data() {
    return {
      headers: [
        { field: "nama", name: "Nama" },
        { field: "no_registrasi", name: "No Registrasi" },
        { field: "skema_sertifikasi", name: "Skema Sertifikasi" },
        { field: "no_sertifikat", name: "No Sertifikat" },
        { field: "masa_berlaku", name: "Masa Berlaku" }
      ],
      dataPemegangSertifikat: [],
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
    this.fetchDataPemegangSertifikat();
  },
  methods: {
    async fetchDataPemegangSertifikat() {
      this.loading = true;
      const { data, meta } = await pemegangSertifikatResource.list(this.query);
      this.dataPemegangSertifikat = data;
      this.dataPemegangSertifikat.forEach((element, index) => {
        element['index'] = (this.query.page - 1) * this.query.limit + index + 1;
      });
      this.total = !isNaN(meta.total) ? (typeof meta.total === 'string' ? Number(meta.total) : meta.total) : 1;
      this.query.page = !isNaN(meta.current_page) ? (typeof meta.current_page === 'string' ? Number(meta.current_page) : meta.current_page) : 1;
      this.query.limit = !isNaN(meta.per_page) ? (typeof meta.per_page === 'string' ? Number(meta.per_page) : meta.per_page) : 1;
      this.loading = false;
    },
    handleSearch: debounce(function (keyword) {
      this.query.keyword = keyword
      this.fetchDataPemegangSertifikat();
    }, 500),
    handleChangePage: debounce(function (newPage) {
      this.query.page = newPage
      this.fetchDataPemegangSertifikat()
    }, 500),
    handleChangeSort: debounce(function (order_type) {
      this.query.order_type = order_type
      this.fetchDataPemegangSertifikat();
    }, 500),
  },  
};
</script>
