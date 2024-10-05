<template>
  <div class="container custom pt-5 text-center">
    <div class="row gx-lg-8 gx-xl-12">
      <!-- Bagian Gambar Full Width -->
      <div class="col-12 px-0">
        <h1 class="text-start fw-bold text-uppercase mb-4 mt-0">Rencana Strategis</h1>
        <div class="text-center py-3">
          <img :src="bannerLsp" alt="Rencana Strategis" class="img-fluid w-100">
        </div>
      </div>

      <!-- Bagian Rencana Strategis -->
      <div class="px-0 col-12 d-flex align-items-center justify-content-center pt-5">
        <div class="text-start">
          <p class="mb-4">
            Lembaga Sertifikasi Profesi (LSP) menetapkan rencana strategis yang berfokus pada pengembangan dan peningkatan kualitas sertifikasi untuk menghadapi tantangan global. Salah satu tujuan utama dalam rencana strategis ini adalah memastikan bahwa setiap skema sertifikasi yang diterbitkan selaras dengan perkembangan industri, termasuk dalam bidang teknologi dan digitalisasi. LSP juga berupaya memperluas cakupan sertifikasi dengan mengembangkan skema baru yang relevan dengan kebutuhan pasar tenaga kerja. Dalam rangka meningkatkan daya saing, LSP bekerja sama dengan berbagai stakeholder, baik dari pemerintah, industri, maupun lembaga pendidikan, untuk memastikan pelatihan yang diberikan sesuai dengan standar kompetensi internasional. Selain itu, LSP berkomitmen untuk terus memperbaiki sistem penilaian dan infrastruktur teknologi guna memudahkan proses sertifikasi yang lebih efisien dan akuntabel.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import bannerLsp from '@/assets/img/banner-lsp.png';
export default {
  data() {
    return {
      bannerLsp: bannerLsp,
    };
  },
};
</script>

<style lang="scss" scoped>
.container.custom {
    max-width: 1025px !important;
}
</style>
