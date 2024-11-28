<template>
  <div class="container custom pt-5 text-center">
    <div class="row gx-lg-8 gx-xl-12">
      <!-- Bagian Gambar Full Width -->
      <div class="col-12 px-0">
        <h1 class="text-start fw-bold text-uppercase mb-4 mt-0">Struktur Organisasi</h1>
        <div class="text-center py-3">
          <img :src="imgStrukturOrganisasi" alt="Struktur Organisasi" class="img-fluid w-100">
        </div>
      </div>

      <!-- Bagian Struktur Organisasi -->
      <div class="px-0 col-12 d-flex align-items-center justify-content-center pt-5">
        <div class="text-start">
          <p class="mb-4">
            Struktur organisasi ini mencerminkan kolaborasi dari berbagai peran penting dalam tim. <strong>Ketua Divisi</strong>, <strong>Ketut Susilo</strong>, memimpin tim dengan bertanggung jawab atas pengambilan keputusan strategis dan pengawasan keseluruhan jalannya divisi. <strong>Juliana Silva</strong> sebagai <strong>Wakil Ketua Divisi</strong> mendukung ketua dalam mengkoordinasikan aktivitas sehari-hari serta memastikan kelancaran operasional. Selain itu, terdapat tiga anggota yang berperan penting: <strong>Cahaya Dewi</strong>, <strong>Rosa Maria A.</strong>, dan <strong>Mohammad Patel</strong>, yang masing-masing bertanggung jawab dalam melaksanakan tugas divisi sesuai dengan kompetensi dan perannya. Mereka bekerja sama untuk mencapai target divisi dan memastikan kelancaran operasional. Struktur ini memastikan bahwa setiap peran, dari ketua hingga anggota, bekerja secara sinergis untuk mencapai tujuan organisasi.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import strukturOrganisasi from '@/assets/img/struktur-organisasi.png';
export default {
  data() {
    return {
      imgStrukturOrganisasi: strukturOrganisasi,
    };
  },
};
</script>

<style lang="scss" scoped>
.container.custom {
    max-width: 1025px !important;
}
</style>
