<template>
  <div>
    <el-row :span="getColumnSpan() === 6 ? 12 : getColumnSpan()" type="flex" class="content" justify="center">
      <el-col :span="getColumnSpan() === 6 ? 12 : getColumnSpan()">
        <div class="container-judul">
          <h1>Daftar Artikel</h1>
        </div>
      </el-col>
    </el-row>
    <el-row type="flex" justify="center">
      <el-col :span="getColumnSpan() === 6 ? 12 : getColumnSpan()" class="for-carousel">
        <el-row type="flex" justify="center">
          <el-col :span="24" class="container-carousel">
            <el-carousel v-if="isMobile" :interval="4000" arrow="always" class="carousel">
              <el-carousel-item v-for="item in listArticles" :key="item.id" class="carousel-item">
                <el-card class="card">
                  <div class="container-image">
                    <img :src="'uploads/article/' + item.image" height="200" style="width: 100%; object-fit: cover; object-position: 50% 0;">
                  </div>
                  <div class="created-article">
                    <span class="child-created-article">
                      <el-button icon="el-icon-date" class="icon-article" />
                      <span>{{ item.waktu }}</span>
                    </span>
                    <span class="child-created-article">
                      <el-button icon="el-icon-user-solid" class="icon-article" />
                      <span>Eko Khannedy</span>
                    </span>
                  </div>
                  <div class="judul">
                    <h4>{{ item.judul }}</h4>
                  </div>
                  <div class="description">
                    <span>{{ item.description }}</span>
                    <div class="bottom clearfix">
                      <router-link :to="'/kegiatan/' + item.slug "><el-button type="text" class="button">Baca Selengkapnya</el-button></router-link>
                    </div>
                  </div>
                </el-card>
              </el-carousel-item>
            </el-carousel>
            <el-carousel v-else :interval="4000" type="card" arrow="always" class="carousel">
              <el-carousel-item v-for="item in listArticles" :key="item.id" class="carousel-item">
                <el-card class="card">
                  <img :src="'uploads/article/' + item.image" height="200" style="width: 100%; object-fit: cover; object-position: 50% 0;">
                  <div class="created-article">
                    <span class="child-created-article">
                      <el-button icon="el-icon-date" class="icon-article" />
                      <span>{{ item.waktu }}</span>
                    </span>
                    <span class="child-created-article">
                      <el-button icon="el-icon-user-solid" class="icon-article" />
                      <span>Eko Khannedy</span>
                    </span>
                  </div>
                  <div class="judul">
                    <h4>{{ item.judul }}</h4>
                  </div>
                  <div class="description">
                    <span>{{ item.description }}</span>
                    <div class="bottom clearfix">
                      <router-link :to="'/kegiatan/' + item.slug "><el-button type="text" class="button">Baca Selengkapnya</el-button></router-link>
                    </div>
                  </div>
                </el-card>
              </el-carousel-item>
            </el-carousel>
          </el-col>
        </el-row>
      </el-col>
    </el-row>
  </div>

</template>
<script>
import Resource from '@/api/resource';
const articleResource = new Resource('article');
export default {
  name: 'SkemaList',
  data() {
    return {
      input3: null,
      select: null,
      asesorKompetensi: null,
      pemegangSertifikat: null,
      listArticles: [],
      filteredArticles: [],
      tableData: [
        {
          title: 'Nama',
          tiua: ':',
          content: '',
        },
        {
          title: 'Kode',
          tiua: ':',
          content: '',
        },
        {
          title: 'Unit Kompetensi',
          tiua: ':',
          content: '',
        },
      ],
      listSkema: [
        {
          judul: 'Unit Kompetensi',
          content: [],
        },
      ],
      listUnitKompetensi: [],
      activeName: 'Unit Kompetensi',
      isMobile: false,
      isTablet: false,
      isLaptop: false,
      isTabletToLaptop: false,
    };
  },
  created(){
    this.getListArticle();
  },
  mounted(){
    this.handleResize();
    window.addEventListener('resize', this.handleResize);
  },
  beforeDestroy(){
    window.removeEventListener('resize', this.handleResize);
  },
  methods: {
    filterArticles() {
      const keyword = this.input3.toLowerCase(); // Konversi kata kunci pencarian ke huruf kecil
      this.filteredArticles = this.listArticles.filter((item) => {
        return (
          item.judul.toLowerCase().includes(keyword) ||
          item.description.toLowerCase().includes(keyword)
        );
      });
    },
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
    ubahFormatTanggal(tanggalAwal) {
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      const tanggal = new Date(tanggalAwal.replace('Z', ''));
      return tanggal.toLocaleDateString('id-ID', options);
    },
    async getListArticle() {
      const { data } = await articleResource.list();

      this.listArticles = data;

      this.filteredArticles = this.listArticles;

      this.filteredArticles.forEach((element, index) => {
        const waktu = this.ubahFormatTanggal(element.created_at);
        element['waktu'] = waktu;
      });
    },
  },
};
</script>
<style>
  @media(min-width: 990px){

    .container-judul{
      text-align: center;
    }

    .carousel{
      height: 500px;
    }

    .carousel-item{
      height: 500px;
      padding-bottom: 5px;
    }

    .created-article{
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .judul, .description{
      font-size: 14px;
    }

    .child-created-article{
      padding-bottom: 5px;
    }

  }

  @media(min-width: 769px) and (max-width: 989px) {

    .container-judul{
      text-align: center;
    }

    .carousel{
      height: 500px;
    }

    .carousel-item{
      height: 500px;
      padding-bottom: 5px;
    }

    .created-article{
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .judul, .description{
      font-size: 14px;
    }

    .child-created-article{
      padding-bottom: 5px;
    }
 }

  @media(min-width: 540px) and (max-width: 768px){

    .container-judul{
      text-align: center;
    }

    .container-carousel{
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .carousel{
      height: 500px;
      width: 80%;
    }

    .carousel-item{
      height: 500px;
      padding-bottom: 5px;
    }

    .created-article{
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .child-created-article{
      padding-bottom: 5px;
    }

    .judul, .description{
      font-size: 14px;
    }
 }

  @media(min-width: 359px) and (max-width: 539px){

    .container-judul{
      text-align: center;
    }

    .carousel{
      height: 500px;
    }

    .carousel-item{
      height: 500px;
      padding-bottom: 5px;
    }

    .image{
      width: 100%;
      height: 200px;
      object-fit: cover;
      object-position: 50% 0;
    }

    .judul, .description{
      font-size: 14px;
    }

  }

  @media(max-width: 360px){

    .container-judul{
      text-align: center;
    }

    .carousel{
      height: 500px;
    }

    .carousel-item{
      height: 500px;
      padding-bottom: 5px;
    }

    .judul, .description{
      font-size: 14px;
    }
  }

</style>
