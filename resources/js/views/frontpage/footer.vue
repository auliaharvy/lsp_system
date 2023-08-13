<template>
  <div class="container-footer">
    <div class="content-footer">
      <div class="mitra-lsp">
        <h2 style="color: #edecec">Mitra LSP</h2>
        <div style="background-color: #6c757d; width: 100%; height: 1px;" />
        <div class="content-mitra-lsp">
          <ul>
            <li><a href="#">LSP MIGAS</a></li>
            <li><a href="#">LSP Manajemen Resiko</a></li>
            <li><a href="#">LSP STP Bandung</a></li>
            <li><a href="#">LSP Kimia Industri</a></li>
            <li><a href="#">Indonesia Kompeten</a></li>
            <li><a href="#">BNSP</a></li>
            <li><a href="#">KOMINFO</a></li>
            <li><a href="#">KEMNAKER Bandung</a></li>
            <li><a href="#">LSP Teknologi</a></li>
            <li><a href="#">LSP Alfabank</a></li>
            <li><a href="#">Islamic Boarding School</a></li>
          </ul>
        </div>
      </div>
      <div class="link-popular">
        <h2 style="color: #edecec">Link Popular</h2>
        <div style="background-color: #6c757d; width: 100%; height: 1px;" />
        <div class="content-link-popular">
          <ul>
            <li><a href="#">Training Online</a></li>
            <li><a href="#">Pelatihan Asesor BNSP</a></li>
            <li><a href="#">Sertifikasi Digital Marketing</a></li>
            <li><a href="#">Registrasi Sertifikasi</a></li>
            <li><a href="#">Pemegang Sertifikat</a></li>
            <li><a href="#">Tempat Uji Kompetensi</a></li>
            <li><a href="#">Pertanyaan Populer</a></li>
            <li><a href="#">PSKK BNSP</a></li>
            <li><a href="#">Event Terkini</a></li>
            <li><a href="#">Download Dokumen</a></li>
          </ul>
        </div>
      </div>
      <div class="contact">
        <h2 style="color: #edecec">Kontak</h2>
        <div style="background-color: #6c757d; width: 100%; height: 1px;" />
        <div class="content-contact">
          <div class="item-contact-alamat">
            <div style="display: inline-block; width: 25px; padding-right: 10px;">
              <i class="el-icon-map-location size-icon-phone" />
            </div>
            <div style="padding-left: 10px;">Jl. Fatahillah No. 1A RW 04 Kalijaya Cikarang Barat Bekasi Jawa Barat,
              Kalijaya, Kec. Cikarang Bar., Kabupaten Bekasi, Jawa Barat 17530</div>
          </div>
          <div class="item-contact">
            <i class="el-icon-s-promotion size-icon-phone" />
            info@smkn2cikbar.id
          </div>
          <div class="item-contact">
            <i class="el-icon-phone size-icon-phone" />
            085329489247
          </div>
          <div class="item-contact">
            <i class="el-icon-phone size-icon-phone" />
            082122064698
          </div>
          <div class="item-contact">
            <i class="el-icon-phone size-icon-phone" />
            081213355783
          </div>
        </div>
      </div>
      <!-- <instagram-embed
        :url="'https://www.instagram.com/p/CuxtD2eS7xO/'"
        :max-width=500
      /> -->
    </div>
    <div>
      <div style="background-color: #6c757d; width: 100%; height: 1px;" />
      <p style="text-align: center;">© Copyright 2023 - LSP SMKN 2 Cikarang Barat</p>
    </div>
  </div>
</template>
<script>

// import InstagramEmbed from 'vue-instagram-embed';
// import embedInstagram from './embedInstagram.vue';

export default {
  name: 'LspFooter',
  components: {
    // InstagramEmbed
  },
};
</script>

<style lang="scss" scoped>/* Untuk perangkat dengan lebar layar maksimum 600px */
@media (min-width: 765px) {
  .content-footer {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    font-size: 14px;
  }

  .mitra-lsp,
  .link-popular,
  .contact {
    width: 48%;
  }
}

@media(min-width: 990px) {
  .content-footer {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    font-size: 14px;
  }

  .mitra-lsp,
  .link-popular,
  .contact {
    width: 25%;
  }
}

.container-footer {
  font-size: 14px;
  color: #889aa4;
  padding: 17px 20px;
  background-color: #314151;
}

.content-link-popular {
  list-style-type: none;
}

.content-link-popular ul,
.content-mitra-lsp ul {
  padding: 0px;
  list-style-type: none;
}

.content-link-popular ul li,
.content-contact .item-contact,
.content-mitra-lsp ul li {
  line-height: 35px;
}

.content-contact .item-contact-alamat {
  display: flex;
  line-height: 25px;
  padding-bottom: 10px;
}

.content-contact {
  padding-top: 20px;
  padding-bottom: 20px;
}

.size-icon-phone {
  font-size: 20px;
  padding-right: 10px;
}

a:hover {
  color: #edecec;
  cursor: pointer;
}</style>
