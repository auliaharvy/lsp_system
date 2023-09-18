<template>
  <div>
    <el-row type="flex" class="content" justify="center">
      <el-col class="container-col">
        <div>
          <img v-if="article.image" :src="'uploads/article/' + article.image" class="image">
        </div>
        <div class="created-article">
          <span class="child-created-article">
            <el-button icon="el-icon-date" class="icon-article" />
            <span>{{ article.waktu }}</span>
          </span>
          <span class="child-created-article">
            <el-button icon="el-icon-user-solid" class="icon-article" />
            <span>Eko Khannedy</span>
          </span>
        </div>
        <div>
          <article>
            <div v-html="article.content" />
          </article>
        </div>
      </el-col>
    </el-row>
  </div>
</template>
<script>
import Resource from '@/api/resource';
const articleResource = new Resource('article/detail');
export default {
  name: 'SkemaList',
  data() {
    return {
      input3: null,
      select: null,
      listArticles: [],
      article: {},
      filteredArticles: [],
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
          item.title.toLowerCase().includes(keyword) ||
          item.content.toLowerCase().includes(keyword)
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
      const data = await articleResource.get(this.$route.params.slug);
      this.article = data;
      this.article.waktu = this.ubahFormatTanggal(data.created_at);
    },
  },
};
</script>
<style>
  @media(min-width: 990px){

    .container-col{
      width: 60%;
    }

    .image{
      width: 100%;
      object-fit: cover;
      object-position: 100% 0;
      background-position:fixed;
      background-repeat:no-repeat;
      height: 300px;
      -webkit-background-size: 100% 100%;
      -moz-background-size: 100% 100%;
      -o-background-size: 100% 100%;
      background-size: 100% 100%;
    }

    article {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 16px;
      max-width: 800px;
      margin: 0 auto;
      text-align: left;
      color: #333;
      background-color: #fff;
      line-height: 1.5;
    }

    h1 {
      font-size: 32px;
      font-weight: bold;
      color: #333;
    }

    h2 {
      font-size: 20px;
      font-weight: bold;
      color: #555;
    }

    p {
      margin-bottom: 1.5em;
    }

    .icon-article{
      border: none;
      padding: 0;
    }

    .created-article{
      display: flex;
      justify-content: space-between;
      font-size: 11px;
      padding-top: 10px;
    }

  }

  @media(min-width: 769px) and (max-width: 989px) {

    .container-col{
      width: 70%;
    }

    .image{
      width: 100%;
      object-fit: cover;
      object-position: 100% 0;
      background-position:fixed;
      background-repeat:no-repeat;
      height: 300px;
      -webkit-background-size: 100% 100%;
      -moz-background-size: 100% 100%;
      -o-background-size: 100% 100%;
      background-size: 100% 100%;
    }

    article {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 16px;
      max-width: 800px;
      margin: 0 auto;
      text-align: left;
      color: #333;
      background-color: #fff;
      line-height: 1.5;
    }

    h1 {
      font-size: 32px;
      font-weight: bold;
      color: #333;
    }

    h2 {
      font-size: 20px;
      font-weight: bold;
      color: #555;
    }

    p {
      margin-bottom: 1.5em;
    }

    .icon-article{
      border: none;
      padding: 0;
    }

    .created-article{
      display: flex;
      justify-content: space-between;
      font-size: 11px;
      padding-top: 10px;
    }

  }

  @media(min-width: 540px) and (max-width: 768px){

    .container-col{
      width: 88%;
    }

    .image{
      width: 100%;
      object-fit: cover;
      object-position: 100% 0;
      background-position:fixed;
      background-repeat:no-repeat;
      height: 300px;
      -webkit-background-size: 100% 100%;
      -moz-background-size: 100% 100%;
      -o-background-size: 100% 100%;
      background-size: 100% 100%;
    }

    article {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 16px;
      max-width: 800px;
      margin: 0 auto;
      text-align: left;
      color: #333;
      background-color: #fff;
      line-height: 1.5;
    }

    h1 {
      font-size: 32px;
      font-weight: bold;
      color: #333;
    }

    h2 {
      font-size: 20px;
      font-weight: bold;
      color: #555;
    }

    p {
      margin-bottom: 1.5em;
    }

    .icon-article{
      border: none;
      padding: 0;
    }

    .created-article{
      display: flex;
      justify-content: space-between;
      font-size: 11px;
      padding-top: 10px;
    }

  }

  @media(min-width: 359px) and (max-width: 539px){

    .container-col{
      width: 90%;
    }

    .image{
      width: 100%;
      object-fit: cover;
      object-position: 100% 0;
      background-position:fixed;
      background-repeat:no-repeat;
      height: 200px;
      -webkit-background-size: 100% 100%;
      -moz-background-size: 100% 100%;
      -o-background-size: 100% 100%;
      background-size: 100% 100%;
    }

    article {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 16px;
      max-width: 800px;
      margin: 0 auto;
      text-align: left;
      color: #333;
      background-color: #fff;
      line-height: 1.5;
    }

    h1 {
      font-size: 24px;
      font-weight: bold;
      color: #333;
    }

    h2 {
      font-size: 20px;
      font-weight: bold;
      color: #555;
    }

    p {
      margin-bottom: 1.5em;
    }

    .icon-article{
      border: none;
      padding: 0;
    }

    .created-article{
      display: flex;
      justify-content: space-between;
      font-size: 11px;
      padding-top: 10px;
    }

  }
  @media(max-width: 358px){

    .container-col{
      width: 100%;
    }

    .image{
      width: 100%;
      object-fit: cover;
      object-position: 50% 0;
      background-position:fixed;
      background-repeat:no-repeat;
      height: 170px;
      -webkit-background-size: 100% 100%;
      -moz-background-size: 100% 100%;
      -o-background-size: 100% 100%;
      background-size: 100% 100%;
    }

    .child-created-article{
      display: block;
      padding-bottom: 10px;
    }

    .created-article{
      font-size: 11px;
      padding-top: 10px;
    }

    .icon-article{
      border: none;
      padding: 0;
    }

    article {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 14px;
      max-width: 800px;
      margin: 0 auto;
      text-align: left;
      color: #333;
      background-color: #fff;
      line-height: 1.5;
    }

    h1 {
      font-size: 24px;
      font-weight: bold;
      color: #333;
    }

    h2 {
      font-size: 20px;
      font-weight: bold;
      color: #555;
    }

    p {
      margin-bottom: 1.5em;
    }

  }
</style>
