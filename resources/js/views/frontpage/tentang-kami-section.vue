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
        <el-col v-for="(item, index) in cardMengapaKami" :key="index" class="pb-5">
          <div class="container-sda " :class="[item.class && item.class]">
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
const kkni = new Resource('kkni');
const dudi = new Resource('dudi');
const ujiKomp = new Resource('uji');
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
      jumlahDudi: '',
      jumlahSdm: '',
      activeName: 'first',
      currentDate: new Date(),
      itemKategori: null,
      cardMengapaKami: [
        {
          title: '',
          content: 'Skema / Profesi / Jabatan / Pekerjaan di bidang-bidang strategis sektor Teknologi Informasi dan Komunikasi.',
          icon: `<svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M75.1666 53.605L81.1416 65.1769L93.9166 67.0331L84.5416 75.48L86.951 87.98L75.1666 80.9487L63.3823 87.98L65.7916 75.48L56.4166 67.0331L69.5416 65.1769L75.1666 53.605ZM18.9166 50.48H37.6666V56.73H18.9166V50.48ZM18.9166 37.98H50.1666V44.23H18.9166V37.98ZM18.9166 25.48H50.1666V31.73H18.9166V25.48Z" fill="#223F4D"/>
                  <path d="M50.1666 81.73H12.6666V19.23H87.6666V50.48H93.9166V19.23C93.9166 17.5724 93.2581 15.9827 92.086 14.8106C90.9139 13.6385 89.3242 12.98 87.6666 12.98H12.6666C11.009 12.98 9.41931 13.6385 8.24721 14.8106C7.07511 15.9827 6.41663 17.5724 6.41663 19.23V81.73C6.41663 83.3876 7.07511 84.9773 8.24721 86.1494C9.41931 87.3215 11.009 87.98 12.6666 87.98H50.1666V81.73Z" fill="#223F4D"/>
                </svg>`,
          class: 'pe-lg-4',
        },
        {
          title: '',
          content: 'Perusahaan mitra LSP yang siap untuk menerima profesional bidang IT yang telah tersertifikasi, kompeten dan sesuai bidang keahliannya.',
          icon: '<i class="el-icon-office-building icon-card-mengapa-kami" style="font-size: 100px; " />',
          class: 'px-lg-4',
        },
        {
          title: '',
          content: 'Daftar tenaga kerja profesional yang telah tersertifikasi oleh LSP SMKN 2 Cikarang Barat. Siap untuk menjawab kebutuhan industri.',
          icon: `<svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M34.5833 12.98C30.2735 12.98 26.1402 14.692 23.0928 17.7395C20.0453 20.787 18.3333 24.9202 18.3333 29.23C18.3333 33.5397 20.0453 37.673 23.0928 40.7205C26.1402 43.7679 30.2735 45.48 34.5833 45.48C38.893 45.48 43.0263 43.7679 46.0737 40.7205C49.1212 37.673 50.8333 33.5397 50.8333 29.23C50.8333 24.9202 49.1212 20.787 46.0737 17.7395C43.0263 14.692 38.893 12.98 34.5833 12.98ZM8.33325 60.48C8.33325 57.8278 9.38682 55.2843 11.2622 53.4089C13.1375 51.5336 15.6811 50.48 18.3333 50.48H50.8333C52.5745 50.4786 54.286 50.9319 55.7983 51.795C52.6781 54.3731 50.1667 57.6093 48.444 61.2718C46.7212 64.9344 45.8297 68.9325 45.8333 72.98C45.8366 74.9633 46.0383 76.885 46.4383 78.745C43.2183 79.83 39.3133 80.48 34.5833 80.48C22.0183 80.48 15.2483 75.88 11.7433 70.81C9.89774 68.1211 8.74682 65.017 8.39325 61.775C8.36473 61.484 8.34472 61.1922 8.33325 60.9V60.48ZM85.8333 32.98C85.8333 36.2952 84.5163 39.4746 82.1721 41.8188C79.8279 44.163 76.6485 45.48 73.3333 45.48C70.018 45.48 66.8386 44.163 64.4944 41.8188C62.1502 39.4746 60.8333 36.2952 60.8333 32.98C60.8333 29.6648 62.1502 26.4854 64.4944 24.1411C66.8386 21.7969 70.018 20.48 73.3333 20.48C76.6485 20.48 79.8279 21.7969 82.1721 24.1411C84.5163 26.4854 85.8333 29.6648 85.8333 32.98ZM95.8333 72.98C95.8333 78.9473 93.4627 84.6703 89.2431 88.8899C85.0236 93.1095 79.3006 95.48 73.3333 95.48C67.3659 95.48 61.6429 93.1095 57.4234 88.8899C53.2038 84.6703 50.8333 78.9473 50.8333 72.98C50.8333 67.0126 53.2038 61.2896 57.4234 57.0701C61.6429 52.8505 67.3659 50.48 73.3333 50.48C79.3006 50.48 85.0236 52.8505 89.2431 57.0701C93.4627 61.2896 95.8333 67.0126 95.8333 72.98ZM85.8283 67.44H78.1033L75.7132 59.785C75.5688 59.2647 75.2579 58.8061 74.8281 58.4793C74.3982 58.1526 73.8732 57.9757 73.3333 57.9757C72.7933 57.9757 72.2683 58.1526 71.8384 58.4793C71.4086 58.8061 71.0977 59.2647 70.9533 59.785L68.5683 67.44H60.8333C58.4133 67.44 57.4033 70.675 59.3633 72.16L65.6133 76.895L63.2283 84.555C62.4783 86.955 65.1183 88.955 67.0783 87.47L73.3282 82.735L79.5782 87.47C81.5382 88.955 84.1782 86.955 83.4282 84.555L81.0433 76.895L87.2933 72.16C89.2533 70.675 88.2432 67.44 85.8232 67.44" fill="#223F4D"/>
                </svg>`,
          class: 'ps-lg-4',
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
      const kkniResource = await kkni.list();
      const dudiResource = await dudi.list();
      const ujiKompResource = await ujiKomp.list();
      this.jumlahSkema = kkniResource.data.length;
      this.jumlahDudi = dudiResource.data.length;
      this.jumlahSdm = ujiKompResource.data.length;
      this.cardMengapaKami[0].title = this.jumlahSkema + ' Skema Sertifikasi';
      this.cardMengapaKami[1].title = this.jumlahDudi + ' Link Dudi';
      this.cardMengapaKami[2].title = this.jumlahSdm + ' SDM Tersertifikasi';
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
