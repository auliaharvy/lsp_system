<template>
  <div>
    <div class="container-judul">
      <h1>Daftar Article</h1>
    </div>
    <div style="margin-top: 15px;">
      <el-row type="flex" justify="center" class="container-row">
        <el-col class="container-col">
          <el-row class="container-row2">
            <el-col class="container-col2">
              <div class="filter-container">
                <el-input v-model="query.keyword" :placeholder="$t('table.keyword')" @input="handleFilter">
                  <el-button slot="append" v-waves class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter" />
                </el-input>
              </div>
            </el-col>
          </el-row>
        </el-col>
      </el-row>
    </div>
    <el-row class="container-row">
      <el-col class="container-col">
        <el-carousel :interval="4000" arrow="always" indicator-position="none" class="carousel">
          <el-carousel-item
            v-for="item in listArticles"
            :key="item.id"
            class="carousel-item"
          >
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
              <div class="kategori">
                <el-tag class="tag">{{ item.kategori }}</el-tag>
              </div>
              <div class="judul">
                <h4>{{ item.judul }}</h4>
              </div>
              <div class="description">
                <span>{{ item.description }}</span>
                <div class="bottom clearfix">
                  <router-link :to="'/kegiatan/' + item.slug "><el-button type="primary" class="button">Baca Selengkapnya</el-button></router-link>
                </div>
              </div>
            </el-card>
          </el-carousel-item>
        </el-carousel>
      </el-col>
    </el-row>
  </div>
</template>
<script>
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
const articleResource = new Resource('article');
export default {
  name: 'SkemaList',
  directives: { waves },
  data() {
    return {
      input3: null,
      select: null,
      asesorKompetensi: null,
      pemegangSertifikat: null,
      query: {
        page: 1,
        limit: 9,
        keyword: '',
        role: '',
      },
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
    };
  },
  created(){
    this.getListArticle();
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
    ubahFormatTanggal(tanggalAwal) {
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      const tanggal = new Date(tanggalAwal.replace('Z', ''));
      return tanggal.toLocaleDateString('id-ID', options);
    },
    async getListArticle() {
      const { data } = await articleResource.list(this.query);

      this.listArticles = data;

      this.listArticles.forEach((element, index) => {
        const waktu = this.ubahFormatTanggal(element.created_at);
        element['waktu'] = waktu;
      });
    },

    handleFilter() {
      const keyword = this.query.keyword.toLowerCase(); // Konversi kata kunci pencarian ke huruf kecil
      this.list = this.listArticles.filter((item) => {
        return (
          item.judul.toLowerCase().includes(keyword)
        );
      });
      this.getListArticle();
    },

  },
};
</script>
<style>
  @media(min-width: 990px){
    .container-judul{
      text-align: center;
    }

    .container-row{
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container-col{
      display: flex;
      justify-content: center;
      align-items: center;
      width: 80%;
    }

    .carousel{
      width: 60%;
      height: 450px;
    }

    .carousel-item{
      width: 100%;
      height: 450px;
    }

    .judul, .description{
      font-size: 14px;
    }

    .card{
      width: 100%;
      height: 100%;
    }

    .kategori{
      padding: 8px 0px;
    }

    .judul{
      display: flex;
      align-items: center;
      width: 100%;
      height: 30px;
    }

    .judul h4{
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .description{
      height: 100px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .description span{
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

  }

  @media(min-width: 769px) and (max-width: 989px) {
    .container-judul{
      text-align: center;
    }

    .container-row{
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container-col{
      display: flex;
      justify-content: center;
      align-items: center;
      width: 80%;
    }

    .carousel{
      width: 80%;
      height: 450px;
    }

    .carousel-item{
      width: 100%;
      height: 450px;
    }

    .judul, .description{
      font-size: 14px;
    }

    .card{
      width: 100%;
      height: 100%;
    }

    .kategori{
      padding: 8px 0px;
    }

    .judul{
      display: flex;
      align-items: center;
      width: 100%;
      height: 30px;
    }

    .judul h4{
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .description{
      height: 100px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .description span{
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

  }

  @media(min-width: 540px) and (max-width: 768px){
    .container-judul{
      text-align: center;
    }

    .container-row{
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container-col{
      display: flex;
      justify-content: center;
      align-items: center;
      width: 80%;
    }

    .carousel{
      width: 80%;
      height: 450px;
    }

    .carousel-item{
      width: 100%;
      height: 450px;
    }

    .judul, .description{
      font-size: 14px;
    }

    .card{
      width: 100%;
      height: 100%;
    }

    .kategori{
      padding: 8px 0px;
    }

    .judul{
      display: flex;
      align-items: center;
      width: 100%;
      height: 30px;
    }

    .judul h4{
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .description{
      height: 100px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .description span{
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

  }

  @media(min-width: 451px) and (max-width: 539px){
    .container-judul{
      text-align: center;
    }

    .container-row{
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container-col{
      display: flex;
      justify-content: center;
      align-items: center;
      width: 80%;
    }

    .carousel{
      width: 80%;
      height: 450px;
    }

    .carousel-item{
      width: 100%;
      height: 450px;
    }

    .judul, .description{
      font-size: 14px;
    }

    .card{
      width: 100%;
      height: 100%;
    }

    .kategori{
      padding: 8px 0px;
    }

    .judul{
      display: flex;
      align-items: center;
      width: 100%;
      height: 30px;
    }

    .judul h4{
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .description{
      height: 100px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .description span{
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

  }

  @media(min-width: 361px) and (max-width: 450px){
    .container-judul{
      text-align: center;
    }

    .container-row{
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container-col{
      display: flex;
      justify-content: center;
      align-items: center;
      width: 80%;
    }

    .carousel{
      width: 100%;
      height: 385px;
    }

    .carousel-item{
      width: 100%;
      height: 385px;
    }

    .container-image img{
      height: 150px;
    }

    .created-article .child-created-article{
      padding-bottom: 5px;
    }

    .judul, .description{
      font-size: 14px;
    }

    .card{
      width: 100%;
      height: 100%;
    }

    .kategori{
      padding-bottom: 5px;
    }

    .judul{
      display: flex;
      align-items: center;
      width: 100%;
      height: 30px;
    }

    .judul h4{
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .description{
      height: 93px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      font-size: 12px;
    }

    .description span{
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .button{
      font-size: 12px;
      padding: 8px;
    }

  }

  @media(min-width: 259px) and (max-width: 360px){
    .container-judul{
      text-align: center;
    }

    .container-row{
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container-col{
      display: flex;
      justify-content: center;
      align-items: center;
      width: 80%;
    }

    .carousel{
      width: 100%;
      height: 395px;
    }

    .carousel-item{
      width: 100%;
      height: 395px;
    }

    .container-image img{
      height: 150px;
    }

    .created-article .child-created-article{
      padding-bottom: 5px;
    }

    .judul, .description{
      font-size: 14px;
    }

    .card{
      width: 100%;
      height: 100%;
    }

    .kategori{
      padding-bottom: 5px;
    }

    .judul{
      display: flex;
      align-items: center;
      width: 100%;
      height: 30px;
    }

    .judul h4{
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .description{
      height: 93px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      font-size: 12px;
    }

    .description span{
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .button{
      font-size: 12px;
      padding: 8px;
    }

  }

  @media(min-width: 0px) and (max-width: 260px){
    .container-judul{
      text-align: center;
    }

    .container-row{
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container-col{
      display: flex;
      justify-content: center;
      align-items: center;
      width: 80%;
    }

    .carousel{
      width: 100%;
      height: 395px;
    }

    .carousel-item{
      width: 100%;
      height: 395px;
    }

    .container-image img{
      height: 145px;
    }

    .created-article .child-created-article{
      padding-bottom: 5px;
    }

    .judul, .description{
      font-size: 14px;
    }

    .card{
      width: 100%;
      height: 100%;
    }

    .kategori .tag{
      padding: 0px;
    }

    .judul{
      display: flex;
      align-items: center;
      width: 100%;
      height: 30px;
    }

    .judul h4{
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .description{
      height: 93px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      font-size: 12px;
    }

    .description span{
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .button{
      font-size: 12px;
      padding: 8px;
    }

  }

</style>
