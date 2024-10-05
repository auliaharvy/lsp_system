<template>
  <div class="container custom pt-5 text-center">
    <div class="row gx-lg-8 gx-xl-12">
      <!-- Bagian Gambar Full Width -->
      <div class="col-12 px-0">
        <h1 class="text-start fw-bold text-uppercase mb-4 mt-0">Visi Misi Instansi</h1>
        <img :src="imgVisimisi" alt="Visi Misi" class="img-fluid w-100">
      </div>

      <!-- Bagian Visi Misi -->
      <div class="px-0 col-12 d-flex align-items-center justify-content-center pt-5">
        <div class="text-start">
          <p class="mb-0">
            Lembaga Sertifikasi Profesi (LSP) berfungsi untuk meningkatkan kualitas tenaga kerja di berbagai sektor industri. Visi lembaga ini adalah mencetak tenaga kerja yang bersertifikat dengan standar internasional, yang mampu bersaing di pasar kerja global. LSP juga bertujuan untuk menjamin bahwa setiap sertifikasi yang dikeluarkan sesuai dengan kebutuhan pasar dan perkembangan teknologi. Misi mereka termasuk menyediakan sertifikasi yang kredibel, transparan, dan relevan, bekerja sama dengan asosiasi industri dan profesi terkait.
          </p>
        </div>
      </div>

      <!-- Bagian Visi -->
      <div class="px-0 col-12 d-flex align-items-center justify-content-center pt-5">
        <div class="text-start">
          <h2 class="fw-bold text-uppercase mb-4">Visi</h2>
          <p class="mb-0">
            Visi LSP adalah memastikan bahwa setiap individu yang tersertifikasi memiliki kompetensi yang diakui baik di tingkat nasional maupun internasional. Dengan tujuan ini, LSP berkomitmen untuk menciptakan standar kompetensi yang tinggi, yang sesuai dengan tuntutan pasar global. LSP juga bertekad untuk mengurangi kesenjangan keterampilan yang ada di dunia industri dan berusaha memastikan bahwa tenaga kerja Indonesia dapat bersaing di tingkat internasional. Dengan standar kompetensi yang terus berkembang, LSP mendukung tenaga kerja yang mampu beradaptasi dengan perubahan teknologi dan industri. Visi ini juga mencakup keberlanjutan profesionalisme dalam berbagai sektor industri dan mempromosikan inovasi dalam menghadapi tantangan di masa depan.
          </p>
        </div>
      </div>

      <!-- Bagian Misi -->
      <div class="px-0 col-12 d-flex align-items-center justify-content-center py-5">
        <div class="text-start">
          <h2 class="fw-bold text-uppercase mb-4">Misi</h2>
          <p class="mb-0">
            Misi LSP adalah menyelenggarakan proses sertifikasi yang adil dan transparan, memastikan setiap individu yang tersertifikasi memiliki keterampilan yang dibutuhkan oleh industri saat ini. LSP bekerja sama dengan asosiasi industri dan profesi untuk menjaga relevansi dan kualitas sertifikasi. LSP juga memastikan bahwa sertifikasi yang dikeluarkan sesuai dengan perkembangan teknologi dan kebutuhan tenaga kerja masa depan. Dengan pendekatan yang inovatif, LSP terus memperbarui skema sertifikasi agar mencakup berbagai bidang industri yang berkembang, termasuk teknologi informasi dan digitalisasi. Selain itu, LSP berkomitmen untuk membantu tenaga kerja meningkatkan daya saingnya di pasar global melalui sertifikasi yang diakui di tingkat internasional.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import visimisi from '@/assets/img/visi-misi.png';
export default {
  data() {
    return {
      imgVisimisi: visimisi,
    };
  },
};
</script>

<style lang="scss" scoped>
.container.custom {
    max-width: 1025px !important;
}
</style>
