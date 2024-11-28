<template>
  <div class="container custom pt-5 text-center">
    <div class="row gx-lg-8 gx-xl-12">
      <!-- Bagian Gambar Full Width -->
      <div class="col-12 px-0">
        <h1 class="text-start fw-bold text-uppercase mb-4 mt-0">KOMITMEN KETIDAKBERPIHAKAN</h1>
        <div class="text-center py-3">
          <img :src="bannerLsp" alt="Komitmen Ketidakberpihakan" class="img-fluid w-100">
        </div>
      </div>

      <!-- Bagian Komitmen Ketidakberpihakan -->
      <div class="px-0 col-12 d-flex align-items-center justify-content-center pt-5">
        <div class="text-start">
          <p class="mb-4">
            Lembaga Sertifikasi Profesi (LSP) berkomitmen untuk menjaga ketidakberpihakan dalam setiap aspek operasionalnya. Komitmen ini penting untuk memastikan bahwa proses sertifikasi dilakukan dengan transparansi, objektivitas, dan tanpa pengaruh dari kepentingan eksternal. LSP menerapkan kebijakan yang ketat untuk mencegah terjadinya konflik kepentingan di semua tingkatan, mulai dari tim sertifikasi hingga pengambilan keputusan manajemen. Selain itu, kebijakan ini menjamin bahwa penilaian kompetensi dilakukan secara adil berdasarkan standar yang telah ditetapkan, tanpa diskriminasi terhadap individu atau kelompok tertentu. Dengan demikian, LSP memastikan integritas dan kepercayaan dalam setiap sertifikasi yang diterbitkan. Ketidakberpihakan menjadi fondasi utama dalam memberikan layanan sertifikasi yang kredibel dan diakui secara luas.
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
