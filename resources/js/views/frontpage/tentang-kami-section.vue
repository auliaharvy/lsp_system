<template>
  <div>
    <el-row class="container-row">
      <el-col class="container-col">
        <h1>Lembaga Sertifikasi Profesi <br> SMKN 2 Cikarang Barat</h1>
        <h2>Mengapa Kami?</h2>
        <p>Karena komitmen kami untuk meningkatkan kebertrimaan Sertifikat Kompetensi oleh industri baik di tingkat nasional maupun internasional.</p>
      </el-col>
    </el-row>
    <el-row class="container-row row-sda">
      <el-row class="child-row-sda">
        <el-col v-for="(item, index) in cardMengapaKami" :key="index" class="container-col col-sda">
          <div class="container-sda">
            <div v-html="item.icon" />
            <h3>{{ item.title }}</h3>
            <span>{{ item.content }}</span>
          </div>
        </el-col>
      </el-row>
    </el-row>
    <el-row class="container-row">
      <el-col class="container-col">
        <h2>Daftar Skema Sertifikasi</h2>
      </el-col>
    </el-row>
    <el-row class="container-row">
      <el-col class="container-col">
        <el-tabs v-if="listKategori" v-model="activeName" class="row-tabs" @tab-click="handleClickSertifikasi">
          <el-tab-pane
            v-for="item in listKategori"
            :key="item.id"
            :label="item.nama"
            :name="item.nama"
          >
            <el-carousel :interval="4000" class="row-carousel" arrow="always" indicator-position="none">
              <el-carousel-item v-for="itemSkema in listSkema" :key="itemSkema.id" class="row-carousel-item">
                <el-card class="card">
                  <div class="container-image">
                    <img src="https://cdn.siasat.com/wp-content/uploads/2019/03/online-store.png" class="image">
                  </div>
                  <div class="kode_skema">
                    <h4>{{ itemSkema.kode_skema }} </h4>
                  </div>
                  <div class="skema_sertifikasi">
                    <span>{{ itemSkema.skema_sertifikasi }}</span>
                    <div class="bottom clearfix">
                      <router-link :to="'/skema/' + itemSkema.id + '/' + itemSkema.nama_kategori"><el-button type="text" class="button">Selengkapnya</el-button></router-link>
                    </div>
                  </div>
                </el-card>
              </el-carousel-item>
            </el-carousel>
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
  },
  created() {
    this.getListKategori().then(() => {
      this.getListSkema();
    });
  },
  methods: {
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

<style scoped>

  .container-row{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    padding-bottom: 30px;
  }

  .container-col{
    width: 80%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  .container-col h1,
  .container-col h2,
  .container-col p{
    width: 50%;
    text-align: center;
    margin: 20px 0px 0px 0px;
    color: #23252a;
  }
  .container-col h3{
    color: #23252a;
  }
  .container-row.row-sda{
    width: 100%;
    display: flex;
  }

  .child-row-sda{
    width: 80%;
    display: flex;
    gap: 10px;
  }
 .container-col.col-sda{
    width: 33.3%;
  }
  .container-sda div{
    color: #223f4d;
  }
  .container-sda{
    text-align: center;
  }

  .row-tabs{
    width: 40%;
  }
  .row-carousel{
    width: 100%;
    height: 330px;
  }

  .row-carousel-item{
    width: 100%;
    height: 330px;
  }

  .card{
    width: 100%;
    height: 100%;
  }
  .image{
    width: 100%;
    height: 200px;
  }
  .kode_skema{
    display: flex;
    align-items: center;
    width: 100%;
    height: 30px;
  }
 .kode_skema h4{
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .skema_sertifikasi span{
    font-size: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  @media(min-width: 761px) and (max-width: 990px){
  .container-row{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    padding-bottom: 30px;
  }

  .container-col{
    width: 80%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  .container-col h1,
  .container-col h2,
  .container-col p{
    width: 50%;
    text-align: center;
    margin: 20px 0px 0px 0px;
    color: #23252a;
  }
  .container-col h3{
    color: #23252a;
  }
  .container-row.row-sda{
    width: 100%;
    display: flex;
  }

  .child-row-sda{
    width: 80%;
    display: flex;
    gap: 10px;
  }
 .container-col.col-sda{
    width: 33.3%;
  }
  .container-sda div{
    color: #223f4d;
  }
  .container-sda{
    text-align: center;
  }

  .row-tabs{
    width: 60%;
  }
  .row-carousel{
    width: 100%;
    height: 330px;
  }

  .row-carousel-item{
    width: 100%;
    height: 330px;
  }

  .card{
    width: 100%;
    height: 330px;
  }
  .image{
    width: 100%;
    height: 200px;
  }

  }
  @media(min-width: 691px) and (max-width: 760px){
  .container-row{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    padding-bottom: 30px;
  }

  .container-col{
    width: 80%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  .container-col h1,
  .container-col h2,
  .container-col p{
    width: 50%;
    text-align: center;
    margin: 20px 0px 0px 0px;
    color: #23252a;
  }
  .container-col h3{
    color: #23252a;
  }
  .container-row.row-sda{
    width: 100%;
    display: flex;
  }

  .child-row-sda{
    width: 80%;
    display: flex;
    gap: 10px;
  }
 .container-col.col-sda{
    width: 33.3%;
  }
  .container-sda div{
    color: #223f4d;
  }
  .container-sda{
    text-align: center;
  }

  .row-tabs{
    width: 60%;
  }
  .row-carousel{
    width: 100%;
    height: 330px;
  }

  .row-carousel-item{
    width: 100%;
    height: 330px;
  }

  .card{
    width: 100%;
    height: 330px;
  }
  .image{
    width: 100%;
    height: 200px;
  }

  }

  @media(min-width: 471px) and (max-width: 690px){
    .container-col{
      width: 100%;
    }
    .container-col h1,
    .container-col h2,
    .container-col p{
      width: 100%;
      text-align: center;
      margin: 20px 0px 0px 0px;
      color: #23252a;
    }
    .container-row.row-sda{
      width: 100%;
    }
    .child-row-sda{
      width: 80%;
      display: flex;
      flex-direction: column;
    }
    .container-col.col-sda{
      display: block;
      width: 100%;
    }
    .card div h4{
      font-size: 15px;
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .row-tabs{
    width: 60%;
    }
  .row-carousel{
    width: 100%;
    height: 330px;
  }

  .row-carousel-item{
    width: 100%;
    height: 330px;
  }

  .card{
    width: 100%;
    height: 330px;
  }
    .card div span{
      font-size: 12px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
  }

  @media(min-width: 0px) and (max-width: 470px){
    .container-col{
      width: 100%;
    }
    .container-col h1,
    .container-col h2,
    .container-col p{
      width: 100%;
      text-align: center;
      margin: 20px 0px 0px 0px;
      color: #23252a;
    }
    .container-row.row-sda{
      width: 100%;
    }
    .child-row-sda{
      width: 80%;
      display: flex;
      flex-direction: column;
    }
    .container-col.col-sda{
      display: block;
      width: 100%;
    }
    .row-tabs{
    width: 100%;
    }
  .row-carousel{
    width: 100%;
    height: 330px;
  }

  .row-carousel-item{
    width: 100%;
    height: 330px;
  }

  .card{
    width: 100%;
    height: 100%;
  }

  .kode_skema{
    display: flex;
    align-items: center;
    width: 100%;
    height: 30px;
    padding: 10px 0px;
  }
 .kode_skema h4{
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-wrap:wrap;
  }
  .skema_sertifikasi span{
    font-size: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

}

</style>
