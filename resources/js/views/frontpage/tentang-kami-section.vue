<template>
  <div>
    <el-collapse-transition>
      <el-row type="flex" class="content" justify="center">
        <el-col :span="getColumnSpan() === 6 ? 12 : getColumnSpan()">
          <h1 class="heading-1">Lembaga Sertifikasi Profesi <br> SMKN 2 Cikarang Barat</h1>
          <h2 class="heading-1">Mengapa Kami?</h2>
          <p class="heading-1">Karena komitmen kami untuk meningkatkan kebertrimaan Sertifikat Kompetensi oleh industri baik di tingkat nasional maupun internasional.</p>
        </el-col>
      </el-row>
    </el-collapse-transition>
    <el-row :span="12" type="flex" class="card-mengapa-kami" justify="center">
      <el-col v-for="(item, index) in cardMengapaKami" :key="index" :span="getColumnSpan()" style="text-align: center;">
        <div v-html="item.icon" />
        <h3>{{ item.title }}</h3>
        <span>{{ item.content }}</span>
      </el-col>
    </el-row>
    <el-row :span="getColumnSpan() === 6 ? 12 : getColumnSpan()" type="flex" class="content" justify="center">
      <el-col :span="getColumnSpan() === 6 ? 12 : getColumnSpan()">
        <h3 class="heading-1">Daftar Skema Sertifikasi</h3>
      </el-col>
    </el-row>
    <el-row type="flex" justify="center" class="container-carousel">
      <el-col :span="getColumnSpan() === 6 ? 12 : getColumnSpan()" class="for-carousel">
        <el-tabs v-if="listKategori" v-model="activeName" @tab-click="handleClickSertifikasi">
          <el-tab-pane
            v-for="item in listKategori"
            :key="item.id"
            :label="item.nama"
            :name="item.nama"
          >
            <el-row type="flex" justify="center">
              <el-col :span="24">
                <el-carousel v-if="isMobile" :interval="4000" height="440px" arrow="always">
                  <el-carousel-item v-for="itemSkema in listSkema" :key="itemSkema.id">
                    <el-card style="height: 100%;">
                      <img src="https://cdn.siasat.com/wp-content/uploads/2019/03/online-store.png" class="image">
                      <div style="padding-inline: 14px;">
                        <h4>{{ itemSkema.kode_skema }}</h4>
                      </div>
                      <div style="padding-inline: 14px;">
                        <span>{{ itemSkema.skema_sertifikasi }}</span>
                        <div class="bottom clearfix">
                          <router-link to="/login"><el-button type="text" class="button">Selengkapnya</el-button></router-link>
                        </div>
                      </div>
                    </el-card>
                  </el-carousel-item>
                </el-carousel>
                <el-carousel v-else :interval="4000" type="card" height="430px">
                  <el-carousel-item v-for="itemSkema in listSkema" :key="itemSkema.id">
                    <el-card style="height: 100%;">
                      <img src="https://cdn.siasat.com/wp-content/uploads/2019/03/online-store.png" class="image">
                      <div style="padding-inline: 14px;">
                        <h4>{{ itemSkema.kode_skema }}</h4>
                      </div>
                      <div style="padding-inline: 14px;">
                        <span>{{ itemSkema.skema_sertifikasi }}</span>
                        <div class="bottom clearfix">
                          <router-link to="/login"><el-button type="text" class="button">Selengkapnya</el-button></router-link>
                        </div>
                      </div>
                    </el-card>
                  </el-carousel-item>
                </el-carousel>
              </el-col>
            </el-row>
          </el-tab-pane>
        </el-tabs>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import Resource from '@/api/resource';
const kategoriResource = new Resource('skema-kategori-get');
const skemaResource = new Resource('skema-get');
const skemaCount = new Resource('jumlah-skema');
export default {
  name: 'TentangKamiSection',
  data() {
    return {
      isMobile: false,
      isTablet: false,
      isLaptop: false,
      isTabletToLaptop: false,
      carouselCardTabletActive: false,
      carouselArrowsMobileActive: false,
      listKategori: null,
      listSkema: null,
      querySkema: null,
      jumlahSkema: '',
      activeName: 'first',
      currentDate: new Date(),
      itemKategori: null,
      cardMengapaKami: [
        {
          title: '',
          content: 'Skema / Profesi / Jabatan / Pekerjaan di bidang-bidang strategis sektor Teknologi Informasi dan Komunikasi.',
          icon: '<i class="el-icon-s-order icon-card-mengapa-kami" style="font-size: 100px; " />',
        },
        {
          title: '300++ Link DUDI',
          content: 'Perusahaan mitra LSP yang siap untuk menerima profesional bidang IT yang telah tersertifikasi, kompeten dan sesuai bidang keahliannya.',
          icon: '<i class="el-icon-office-building icon-card-mengapa-kami" style="font-size: 100px; " />',
        },
        {
          title: '1000++ SDM Tersertifikasi',
          content: 'Daftar tenaga kerja profesional yang telah tersertifikasi oleh LSP SMKN 2 Cikarang Barat. Siap untuk menjawab kebutuhan industri.',
          icon: '<i class="el-icon-s-custom icon-card-mengapa-kami" style="font-size: 100px; " />',
        },
      ],
      listContentKategori: [
        {
          kategori: 'Animasi',
          title: 'Animator 2D atau 3D',
          content: 'Profesi terkait skema ini antara lain Desainer Karakter, Editor Video dan Efek Visual, Ilustrator, Desainer Grafis, dan Art Director',
        },
        {
          kategori: 'BDP',
          title: 'Digital Marketer',
          content: 'Profesi terkait skema ini antara lain E-commerce Specialist, Manajer Penjualan dan Pemasaran, Spesialis Media Sosial, Analis Riset Pasar, Manajer Branding',
        },
        {
          kategori: 'OTKP',
          title: 'Resepsionis',
          content: 'Profesi terkait skema ini antara lain E-commerce Specialist, Manajer Penjualan dan Pemasaran, Spesialis Media Sosial, Analis Riset Pasar, Manajer Branding',
        },
        {
          kategori: 'MM',
          title: 'Desainer Multimedia',
          content: 'Profesi terkait skema ini antara lain Pengembang Situs Web, Videographer dan Editor Video, Desainer Interaktif, Pengembang Aplikasi Perangkat Lunak',
        },
        {
          kategori: 'TKJ',
          title: 'Teknisi Jaringan Komputer',
          content: 'Profesi terkait skema ini antara lain Administrator Jaringan Sistem Komputer, Support Teknis TI, Spesialis Keamanan Jaringan, Teknisi Perangkat Lunak dan Perangkat Keras, Network Engineer',
        },
        {
          kategori: 'AKL',
          title: 'Akuntan',
          content: 'Profesi terkait skema ini antara lain Analis Keuangan, Pengelola Keuangan, Spesialis Pajak, Penasehat Keuangan',
        },
      ],
    };
  },
  watch: {
    activeName(newValue, oldValue){
      if (this.querySkema !== null){
        const index = this.querySkema.findIndex((item) => item.nama === newValue);
        this.listSkema = this.querySkema[index][newValue];
      }
    },
    carouselCardTabletActive(newValue, oldValue){
      if (this.getColumnSpan() > 768) {
        return true;
      } else {
        return false;
      }
    },
    carouselArrowsMobileActive(newValue, oldValue){
      const screenWidth = window.innerWidth;
      if (screenWidth < 768) {
        return screenWidth;
      } else {
        return false;
      }
    },
  },
  created() {
    this.getListKategori().then(() => {
      this.getListSkema();
    });
  },
  mounted(){
    this.handleResize();
    window.addEventListener('resize', this.handleResize);
  },
  beforeDestroy(){
    window.removeEventListener('resize', this.handleResize);
  },
  methods: {
    getColumnSpan(){
      if (this.isMobile) {
        return 24;
      } else if (this.isTablet) {
        return 16;
      } else if (this.isLaptop) {
        return 6;
      } else {
        return 12;
      }
    },
    handleResize(){
      const screenWidth = window.innerWidth;
      this.isMobile = screenWidth < 768;
      this.isTablet = screenWidth >= 768 && screenWidth < 1024;
      this.isLaptop = screenWidth >= 1024;
    },
    async getListKategori() {
      const { data } = await kategoriResource.list();
      const countSkemaResult = await skemaCount.list();
      this.jumlahSkema = countSkemaResult;
      this.cardMengapaKami[0].title = this.jumlahSkema + ' Skema Sertifikasi';
      this.listKategori = data;
      this.activeName = this.listKategori[0].nama;
    },
    async getListSkema(){
      const { data } = await skemaResource.list();

      this.querySkema = this.listKategori;
      this.querySkema.forEach((elemen, indek) => {
        elemen[`${elemen['nama']}`] = [];
        data.forEach((element, index) => {
          if (element['nama_kategori'] === elemen['nama']){
            elemen[`${elemen['nama']}`].push(element);
          }
        });
      });
      const firstName = this.querySkema[0].nama;
      const index = this.querySkema.findIndex((item) => item.nama === firstName);
      this.listSkema = this.querySkema[index][this.querySkema[index].nama];
    },
    handleClickSertifikasi(tab, event) {
      // console.log(tab, event);
      // console.log(tab.name);
    },

    handleClickSkema(tab, event) {
      var kategori = this.listContentKategori.find((x) => x.kategori === tab.name);
      this.itemKategori = kategori;
    },
  },
};
</script>

<style>
  /* @media(max-width: 1000px) {
    .carousel-card-mode{
      display: none;
    }
    .carousel-arrows{
      display: block;
    }
  }

  @media(min-width: 999px) {
    .carousel-card-mode{
      display: block;
    }
    .carousel-arrows{
      display: none;
    }
  } */

  @media(max-width: 990px){
    .card-mengapa-kami{
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
  }

  @media(max-width: 768px){
    .container-carousel{
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .for-carousel{
      max-width: 420px;
    }
    .content h1{
      font-size: 30px;
    }
    .content h2{
      font-size: 25px;
    }
    .content p{
      font-size: 18px;
      font-weight: 500;
    }
  }
  .icon-card-mengapa-kami{
    color: #223f4d;
  }

  .heading {
    margin-top: 50px;
    text-align: center;
  }
  .heading-1 {
    margin-top: 20px;
    text-align: center;
  }
  .content {
    margin-top: 20px;
    color: #23252a;
  }
  .time {
    font-size: 13px;
    color: #999;
  }
  .bottom {
    margin-top: 13px;
    line-height: 12px;
  }

  .button {
    padding: 0;
    float: right;
  }

  .image {
    width: 100%;
  }

  .clearfix:before,
  .clearfix:after {
      display: table;
      content: "";
  }
  .clearfix:after {
      clear: both
  }

</style>
