<template>
  <div>
    <div class="container-judul">
      <h1>ARTIKEL</h1>
    </div>
    <div style="margin-top: 15px;">
      <el-row type="flex" justify="center" class="container-carousel">
        <el-col :span="getColumnSpan() === 6 ? 12 : getColumnSpan()" class="for-carousel">
          <el-input v-model="input3" placeholder="Please input" class="input-with-select" @input="filterArticles">
            <el-button slot="append" icon="el-icon-search" />
          </el-input>
        </el-col>
      </el-row>
      <el-row type="flex" justify="center" class="container-carousel">
        <el-col :span="getColumnSpan() === 6 ? 12 : getColumnSpan()" class="for-carousel">
          <el-tabs v-if="listArticles" v-model="activeName">
            <el-row type="flex" justify="center">
              <el-col :span="24">
                <el-carousel v-if="isMobile" :interval="4000" height="440px" arrow="always">
                  <el-carousel-item v-for="item in filteredArticles" :key="item.id">
                    <el-card style="height: 100%;">
                      <img :src="item.image_uri" class="image">
                      <div style="padding-inline: 14px;">
                        <div class="created-article">
                          <span>
                            <el-button icon="el-icon-date" class="icon-article" />
                            <span>11 September 2023</span>
                          </span>
                          <span>
                            <el-button icon="el-icon-user-solid" class="icon-article" />
                            <span>John Wick</span>
                          </span>
                        </div>
                        <h4>{{ item.title }}</h4>
                      </div>
                      <div style="padding-inline: 14px;">
                        <span>{{ item.content }}</span>
                        <div class="bottom clearfix">
                          <router-link to="/"><el-button type="text" class="button">Selengkapnya</el-button></router-link>
                        </div>
                      </div>
                    </el-card>
                  </el-carousel-item>
                </el-carousel>
                <el-carousel v-else :interval="4000" type="card" height="430px">
                  <el-carousel-item v-for="item in filteredArticles" :key="item.id">
                    <el-card style="height: 100%;">
                      <img :src="item.image_uri" class="image">
                      <div style="padding-inline: 14px;">
                        <div class="created-article">
                          <span>
                            <el-button icon="el-icon-date" class="icon-article" />
                            <span>11 September 2023</span>
                          </span>
                          <span>
                            <el-button icon="el-icon-user-solid" class="icon-article" />
                            <span>John Wick</span>
                          </span>
                        </div>
                        <h4>{{ item.title }}</h4>
                      </div>
                      <div style="padding-inline: 14px;">
                        <span>{{ item.content }}</span>
                        <div class="bottom clearfix">
                          <router-link to="/"><el-button type="text" class="button">Selengkapnya</el-button></router-link>
                        </div>
                      </div>
                    </el-card>
                  </el-carousel-item>
                </el-carousel>
              </el-col>
            </el-row>
          </el-tabs>
        </el-col>
      </el-row>
    </div>
  </div>
</template>
<script>
import Resource from '@/api/resource';
const articleResource = new Resource('articles');
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
    async getListArticle() {
      const { data } = await articleResource.list();
      this.listArticles = data.items;
      this.filteredArticles = this.listArticles;
      console.log(this.listArticles);
    },
  },
};
</script>
<style>
  @media(min-width: 990px){
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
  }

</style>
