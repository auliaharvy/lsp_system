<template>
  <!-- eslint-disable -->
  <div class="container pt-16 pb-14 pt-md-14 pb-md-14 text-center">
    <div class="row gx-lg-8 gx-xl-12">
      <!-- Sidebar navigation -->
      <div class="col-12 col-lg-4 pt-lg-7 sticky-top">
        <div class="card border-0">
          <div class="card-body border-0 p-0">
            <ul class="nav nav-pills flex-column" id="navTabs">
              <li class="nav-item mb-lg-1">
                <a class="nav-link text-dark-2 d-flex justify-content-between p-1 text-dark mb-lg-0 mb-1 flex-grow-1 text-uppercase active"
                  href="#about-section">Tentang LSP</a>
              </li>
              <li class="nav-item mb-lg-1">
                <a class="nav-link text-dark-2 d-flex justify-content-between p-1 text-dark mb-lg-0 mb-1 flex-grow-1 text-uppercase"
                  href="#support-section">Dukungan Asosiasi Profesi</a>
              </li>
              <li class="nav-item mb-lg-1">
                <a class="nav-link text-dark-2 d-flex justify-content-between p-1 text-dark mb-lg-0 mb-1 flex-grow-1 text-uppercase"
                  href="#certificate-section">Lembaga Sertifikasi Profesi</a>
              </li>
              <li class="nav-item mb-lg-1">
                <a class="nav-link text-dark-2 d-flex justify-content-between p-1 text-dark mb-lg-0 mb-1 flex-grow-1 text-uppercase"
                  href="#scope-section">Ruang Lingkup Skema</a>
              </li>
              <li class="nav-item mb-lg-1">
                <a class="nav-link text-dark-2 d-flex justify-content-between p-1 text-dark mb-lg-0 mb-1 flex-grow-1 text-uppercase"
                  href="#development-section">Pengembangan Ruang Lingkup</a>
              </li>
              <li class="nav-item mb-lg-1">
                <a class="nav-link text-dark-2 d-flex justify-content-between p-1 text-dark mb-lg-0 mb-1 flex-grow-1 text-uppercase"
                  href="#partners-section">Mitra Kerja</a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Content section -->
      <div class="col-12 col-lg-8">
        <!-- Tentang LSP Section -->
        <div id="about-section">
          <div class="col-12">
            <h2 class="text-start text-dark-2 my-4 fw-bold text-uppercase">Tentang LSP</h2>
            <p class="text-start text-dark-2 mb-0">
              LSP adalah Lembaga Sertifikasi Profesi yang berfungsi sebagai lembaga independen yang melakukan sertifikasi terhadap tenaga kerja profesional dalam berbagai sektor industri. 
              Tujuannya adalah untuk memastikan bahwa setiap individu yang terlibat dalam industri memiliki standar kompetensi yang memadai, diakui baik secara nasional maupun internasional. 
              Dalam proses sertifikasi, LSP bekerja sama dengan berbagai pihak seperti asosiasi profesi, lembaga pendidikan, dan pelaku industri. Sertifikasi kompetensi yang diberikan oleh LSP bertujuan untuk meningkatkan daya saing tenaga kerja. 
              Dengan memiliki sertifikat profesi dari LSP, individu dapat membuktikan bahwa mereka memiliki keterampilan dan keahlian yang dibutuhkan oleh dunia kerja.
            </p>
          </div>
        </div>

        <!-- Sertifikat Section dengan Gambar -->
        <div id="certificate-image" class="section text-start pt-5">
          <img :src="imgCertificate" alt="Certificate" class="img-fluid" style="max-width: 400px;">
        </div>

        <!-- Dukungan Asosiasi Section -->
        <div id="support-section">
          <div class="col-12">
            <h2 class="text-start text-dark-2 my-4 fw-bold text-uppercase">Dukungan Asosiasi Profesi dan Asosiasi Industri</h2>
            <p class="text-start text-dark-2 mb-0">
              LSP didukung oleh berbagai asosiasi profesi yang aktif dalam pengembangan standar kompetensi. Dukungan ini memastikan bahwa skema sertifikasi yang ditawarkan sesuai dengan kebutuhan industri.
              Selain itu, asosiasi industri turut berperan dalam memberikan input terkait perkembangan teknologi dan kebutuhan tenaga kerja di masa depan. Melalui kolaborasi ini, LSP dapat memastikan bahwa setiap skema sertifikasi yang diberikan relevan dengan dinamika pasar. 
              Dukungan dari asosiasi ini juga membantu mempromosikan pentingnya sertifikasi kompetensi di kalangan pelaku industri.
            </p>
          </div>
        </div>

        <!-- Lembaga Sertifikasi Section -->
        <div id="certificate-section">
          <div class="col-12">
            <h2 class="text-start text-dark-2 my-4 fw-bold text-uppercase">Lembaga Sertifikasi Profesi sebagai Sertifikator</h2>
            <p class="text-start text-dark-2 mb-0">
              Sebagai lembaga sertifikator, LSP memiliki kewenangan untuk menguji dan memberikan sertifikat kompetensi kepada para tenaga kerja yang memenuhi standar tertentu. 
              Proses sertifikasi melibatkan serangkaian ujian dan asesmen yang bertujuan untuk mengevaluasi kemampuan dan keahlian individu dalam bidang profesi mereka. 
              Dengan demikian, LSP memastikan bahwa tenaga kerja yang disertifikasi memiliki keterampilan yang sesuai dengan tuntutan pasar kerja.
              Sertifikasi ini memberikan jaminan kualitas bagi industri dan menjadi bukti kompetensi bagi tenaga kerja.
            </p>
          </div>
        </div>

        <!-- Ruang Lingkup Section -->
        <div id="scope-section">
          <div class="col-12">
            <h2 class="text-start text-dark-2 my-4 fw-bold text-uppercase">Ruang Lingkup Skema yang Terlisensi BNSP</h2>
            <p class="text-start text-dark-2 mb-0">
              LSP memiliki berbagai skema sertifikasi yang telah terlisensi oleh BNSP (Badan Nasional Sertifikasi Profesi), mencakup beragam bidang profesi seperti teknologi informasi, kesehatan, konstruksi, hingga pariwisata. 
              Setiap skema dirancang untuk memastikan bahwa tenaga kerja memiliki kompetensi yang sesuai dengan standar nasional maupun internasional. Skema-skema ini disusun berdasarkan kebutuhan industri dan diakui oleh berbagai pemangku kepentingan di dunia kerja.
            </p>
          </div>
        </div>

        <!-- Pengembangan Ruang Lingkup Section -->
        <div id="development-section">
          <div class="col-12">
            <h2 class="text-start text-dark-2 my-4 fw-bold text-uppercase">Pengembangan Ruang Lingkup</h2>
            <p class="text-start text-dark-2 mb-0">
              LSP secara aktif mengembangkan ruang lingkup skema sertifikasi untuk menjawab kebutuhan pasar tenaga kerja yang terus berkembang. Pengembangan ini mencakup penambahan skema baru di bidang teknologi yang sedang berkembang, seperti kecerdasan buatan dan analisis data. 
              Selain itu, LSP juga memperbarui skema yang ada agar tetap relevan dengan perubahan regulasi dan standar industri. 
              Hal ini memastikan bahwa tenaga kerja yang disertifikasi selalu siap menghadapi tantangan dunia kerja global.
            </p>
          </div>
        </div>

        <!-- Mitra Kerja Section -->
        <div id="partners-section" class="py-5">
          <div class="col-12">
            <h2 class="text-start text-dark-2 my-4 fw-bold text-uppercase">Mitra Kerja</h2>
            <p class="text-start text-dark-2 mb-0">
              LSP bekerja sama dengan berbagai mitra kerja, mulai dari lembaga pendidikan, lembaga pelatihan, hingga perusahaan swasta dan pemerintah. Kolaborasi ini bertujuan untuk meningkatkan kualitas tenaga kerja melalui sertifikasi yang diakui oleh industri. 
              Mitra kerja juga berperan dalam memberikan feedback terkait kebutuhan kompetensi yang diinginkan oleh pasar kerja. Dengan kerja sama yang kuat, LSP dapat memastikan proses sertifikasi berjalan sesuai dengan standar yang telah ditetapkan dan memberikan manfaat nyata bagi tenaga kerja dan industri.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>
<script>
import certificate from '@/assets/img/certificate.png';
export default {
  data() {
    return {
      imgCertificate: certificate,
    };
  },
  mounted() {
    const navLinks = document.querySelectorAll('#navTabs .nav-link');

    navLinks.forEach(link => {
      link.addEventListener('click', function() {
        // Hapus kelas 'active' dari semua link
        navLinks.forEach(nav => nav.classList.remove('active'));

        // Tambahkan kelas 'active' ke link yang diklik
        this.classList.add('active');
      });
    });
  },
};
</script>
<style scoped>
html {
  scroll-behavior: smooth; /* Enables smooth scrolling */
}

img {
  max-width: 100%; /* Gambar responsive */
  height: auto;
}
.sticky-top {
  position: -webkit-sticky;
  position: sticky;
  top: 3rem;
  height: 100%;
  z-index: 1;
}

.border-0{
  border: none !important;
}
.nav-pills .nav-link.active {
  color: #17A2B8 !important;
  font-weight: bold;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: var(--bs-nav-pills-link-active-color);
    background: none !important;
}
</style>
