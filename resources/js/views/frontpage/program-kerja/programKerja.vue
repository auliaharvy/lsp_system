<template>
  <div class="container custom pt-5 text-center">
    <div class="row gx-lg-8 gx-xl-12">
      <!-- Bagian Gambar Full Width -->
      <div class="col-12 px-0">
        <h1 class="text-start fw-bold text-uppercase mb-4 mt-0">Program Kerja</h1>
        <div class="text-center py-3">
          <img :src="bannerLsp" alt="Program Kerja" class="img-fluid w-100">
        </div>
      </div>

      <!-- Bagian Program Kerja -->
      <div class="px-0 col-12 d-flex align-items-center justify-content-center pt-5">
        <div class="text-start">
          <p class="mb-4">
            Lembaga Sertifikasi Profesi (LSP) memiliki berbagai program kerja yang bertujuan untuk memastikan kualitas kompetensi tenaga kerja Indonesia sesuai dengan standar nasional dan internasional. Salah satu program utamanya adalah <strong>penyelenggaraan sertifikasi kompetensi</strong>, yang dilakukan melalui proses penilaian keterampilan sesuai skema yang telah disahkan oleh Badan Nasional Sertifikasi Profesi (BNSP). Selain itu, LSP juga melakukan <strong>pelatihan assessor dan tenaga penguji</strong> untuk memastikan mereka memiliki kapasitas yang cukup dalam menilai keterampilan peserta sertifikasi. Program lain yang dijalankan termasuk <strong>pengembangan skema sertifikasi baru</strong> yang relevan dengan perkembangan industri, serta <strong>kerja sama dengan sektor industri dan pendidikan</strong> untuk memperbarui standar sertifikasi yang ada. Melalui program-program tersebut, LSP berperan aktif dalam meningkatkan daya saing tenaga kerja Indonesia di kancah global.
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
