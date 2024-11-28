<template>
  <div class="container custom pt-5 text-center">
    <div class="row gx-lg-8 gx-xl-12">
      <!-- Bagian Gambar Full Width -->
      <div class="col-12 px-0">
        <h1 class="text-start fw-bold text-uppercase mb-4 mt-0">Stakeholder</h1>
        <div class="text-center py-3">
          <img :src="bannerLsp" alt="Struktur Organisasi" class="img-fluid w-100">
        </div>
      </div>

      <!-- Bagian Stakeholder -->
      <div class="px-0 col-12 d-flex align-items-center justify-content-center pt-5">
        <div class="text-start">
          <p class="mb-4">
            Stakeholder Lembaga Sertifikasi Profesi (LSP) terdiri dari berbagai pihak yang memiliki kepentingan langsung dalam proses sertifikasi kompetensi. Mereka termasuk asosiasi industri, asosiasi profesi, pemerintah, lembaga pendidikan, dan tenaga kerja profesional. Setiap stakeholder memiliki peran penting dalam memastikan bahwa skema sertifikasi yang dikeluarkan sesuai dengan standar yang dibutuhkan industri dan memenuhi persyaratan global. Lembaga ini bekerja sama dengan industri untuk memastikan bahwa setiap individu yang tersertifikasi memiliki keterampilan yang sesuai dengan perkembangan teknologi terbaru. Pemerintah juga memainkan peran penting dalam memberikan regulasi dan akreditasi bagi LSP, sementara asosiasi profesi membantu dalam pengembangan standar kompetensi yang relevan. Selain itu, tenaga kerja dan lembaga pendidikan berperan dalam memastikan bahwa pelatihan yang diberikan sesuai dengan kebutuhan pasar.
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
