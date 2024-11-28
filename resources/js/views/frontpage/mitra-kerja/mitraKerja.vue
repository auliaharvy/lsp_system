<template>
  <div class="container custom pt-5 text-center">
    <div class="row gx-lg-8 gx-xl-12">
      <!-- Bagian Gambar Full Width -->
      <div class="col-12 px-0">
        <h1 class="text-start fw-bold text-uppercase mb-4 mt-0">Mitra Kerja</h1>
        <div class="text-center py-3">
          <img :src="bannerLsp" alt="Mitra Kerja" class="img-fluid w-100">
        </div>
      </div>

      <!-- Bagian Mitra Kerja -->
      <div class="px-0 col-12 d-flex align-items-center justify-content-center pt-5">
        <div class="text-start">
          <p class="mb-4">
            Lembaga Sertifikasi Profesi (LSP) bekerja sama dengan berbagai mitra kerja untuk memastikan kualitas dan relevansi sertifikasi yang diberikan. Mitra kerja ini termasuk <strong>asosiasi industri</strong>, <strong>lembaga pendidikan</strong>, serta <strong>organisasi pemerintah</strong> yang berperan dalam pengembangan dan evaluasi skema sertifikasi. <strong>Asosiasi industri</strong> berkontribusi dengan memberikan informasi terkait kebutuhan keterampilan yang sedang berkembang, sehingga LSP dapat memastikan bahwa sertifikasi yang diberikan sesuai dengan kebutuhan pasar tenaga kerja. <strong>Lembaga pendidikan</strong> membantu dalam mempersiapkan individu dengan pelatihan dan pendidikan yang sesuai dengan standar sertifikasi. Sementara itu, <strong>organisasi pemerintah</strong> berperan dalam memberikan regulasi dan kebijakan yang mendukung jalannya program sertifikasi dengan baik. Dengan kolaborasi ini, LSP dapat terus memperbarui dan menyesuaikan skema sertifikasinya agar tetap relevan di berbagai sektor industri.
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
