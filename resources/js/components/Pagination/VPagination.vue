<template>
  <!-- eslint-disable -->
  <div class="pagination-wrapper d-flex flex-column flex-md-row">
    <div class="pagination-info">
      Showing {{ startEntry }} to {{ endEntry }} of {{ totalEntries }} Entries
    </div>    
    <div class="pagination-controls pt-md-0">
      <button
      class="btn btn-primary w-button"
      :class="[currentPage === 1 && 'disabled']"
      @click="goToPreviousPage"
      >
      <span v-if="loading && goToPageActive === 'prev'" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
      <span v-else>Sebelumnya</span>
      </button>
      <button
        class="btn btn-primary w-button"
        :class="[currentPage === totalPages && 'disabled']"
        @click="goToNextPage"
      >
        <span v-if="loading && goToPageActive === 'next'" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span v-else>Selanjutnya</span>
      </button>
    </div>
  </div>
</template>

<script>
// eslint-disable
export default {
  name: "VPagination",
  props: {
    totalEntries: {
      type: Number,
      required: true,
    },
    perPage: {
      type: Number,
      default: 10,
    },
    loading: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      currentPage: 1,
      goToPageActive: ''
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.totalEntries / this.perPage);
    },
    startEntry() {
      return (this.currentPage - 1) * this.perPage + 1;
    },
    endEntry() {
      return Math.min(this.currentPage * this.perPage, this.totalEntries);
    },
  },
  methods: {
    goToNextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage = this.currentPage + 1
        this.goToPageActive = 'next'
        this.$emit('handleChangePage', this.currentPage); // Emit event ke parent dengan halaman baru
      }
    },
    goToPreviousPage() {
      if (this.currentPage > 1) {
        this.currentPage = this.currentPage - 1
        this.goToPageActive = 'prev'
        this.$emit('handleChangePage', this.currentPage); // Emit event ke parent dengan halaman baru
      }
    },
  },
};
</script>

<style scoped>
/* eslint-disable */
.pagination-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
}

.pagination-info {
  font-size: 14px;
}

.pagination-controls button {
  margin-left: 10px;
}

.btn-primary{
  background-color: #4034d4 !important;
  border-color: #4034d4 !important;
}
.w-button{ width: 109.63px !important;}
</style>
