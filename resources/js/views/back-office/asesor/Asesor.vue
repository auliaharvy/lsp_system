<template>
  <div>
    <div class="container-judul">
      <h1>Daftar Asesor</h1>
    </div>
    <div style="margin-top: 15px;">
      <el-row type="flex" justify="center" class="container-row">
        <el-col class="container-column">
          <el-row class="container-row2">
            <el-col class="container-col2">
              <div class="filter-container">
                <el-input v-model="query.keyword" :placeholder="$t('table.keyword')" @input="handleFilter">
                  <el-button slot="append" v-waves class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter" />
                </el-input>
              </div>
            </el-col>
          </el-row>
          <el-row type="flex" justify="center">
            <el-col>
              <div v-if="isMobile" :interval="4000" height="440px" arrow="always" style="width: 100%;">
                <div class="container-card">
                  <el-card v-for="(item, index) in list" :key="index" class="card">
                    <div style="padding-bottom: 15px;">
                      <!-- <img :src="'/uploads/assesor/' + item.image" class="image"> -->
                      <img :src="'/uploads/assesor/default.png'" class="image">
                      <h4 style="word-wrap: break-word; padding: 5px 0px;">{{ item.nama }}</h4>
                      <div class="created-article">
                        <div style="padding-bottom: 10px;">
                          <div class="kategori">
                            <el-tag class="tag">{{ item.status_asesor === "Assesor Tetap" ? item.status_asesor : 'Assesor Pinjam' }}</el-tag>
                          </div>
                          <div style="padding-bottom: 5px;">No Registrasi : </div>
                          <el-button icon="el-icon-date" class="icon-article" />
                          <span>{{ item.no_reg }}</span>
                        </div>
                        <div>
                          <div style="padding-bottom: 5px;">Email : </div>
                          <el-button icon="el-icon-person" class="icon-article" />
                          <span>{{ item.email }}</span>
                        </div>
                      </div>
                    </div>
                    <!-- <div>
                      <div class="bottom clearfix">
                        <router-link to="/"><el-button type="text" class="button">Selengkapnya</el-button></router-link>
                      </div>
                    </div> -->
                  </el-card>
                </div>
              </div>
              <div v-else class="container-main-card">
                <div class="container-card">
                  <el-card v-for="(item, index) in list" :key="index" class="card">
                    <div style="padding-bottom: 15px;">
                      <!-- <img :src="'/uploads/assesor/' + item.image" class="image"> -->
                      <img :src="'/uploads/assesor/default.png'" class="image">
                      <h4 style="word-wrap: break-word; margin: 0px 0px 5px 0px;">{{ item.nama }}</h4>
                      <div class="created-article">
                        <div style="padding-bottom: 10px;">
                          <div class="kategori">
                            <el-tag class="tag">{{ item.status_asesor === "Assesor Tetap" ? item.status_asesor : 'Assesor Pinjam' }}</el-tag>
                          </div>
                          <div style="padding: 5px 0px;">No Registrasi : </div>
                          <el-button icon="el-icon-date" class="icon-article" />
                          <span>{{ item.no_reg }}</span>
                        </div>
                        <div>
                          <div style="padding: 5px 0px;">Email : </div>
                          <el-button icon="el-icon-person" class="icon-article" />
                          <span>{{ item.email }}</span>
                        </div>
                      </div>
                    </div>
                    <!-- <div>
                      <div class="bottom clearfix">
                        <router-link to="/"><el-button type="text" class="button">Selengkapnya</el-button></router-link>
                      </div>
                    </div> -->
                  </el-card>
                </div>
              </div>
              <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
                <secondPagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" class="pagination" @pagination="getList" />
              </div>
            </el-col>
          </el-row>
        </el-col>
      </el-row>
    </div>
  </div>
</template>
<script>
import SecondPagination from '@/components/SecondPagination'; // Secondary package based on el-pagination
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
const assesorResource = new Resource('assesor');

export default {
  name: 'SkemaList',
  components: { SecondPagination },
  directives: { waves },
  data() {
    return {
      list: {},
      isWide: true,
      activeName: 'Unit Kompetensi',
      isMobile: false,
      isTablet: false,
      isLaptop: false,
      isTabletToLaptop: false,
      query: {
        page: 1,
        limit: 9,
        keyword: '',
        role: '',
      },
    };
  },
  computed(){

  },
  created(){
    this.getList();
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

    onResize() {
      const width = document.body.clientWidth;
      this.isWide = width > 800;
      if (this.isWide) {
        this.labelPosition = 'left';
      } else {
        this.labelPosition = 'top';
      }
    },

    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      const { data, meta } = await assesorResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      console.log(this.list);
      this.total = meta.total;
      this.loading = false;
      console.log(this.list);
    },
    handleFilter() {
      const keyword = this.query.keyword.toLowerCase(); // Konversi kata kunci pencarian ke huruf kecil
      this.list = this.list.filter((item) => {
        return (
          item.nama.toLowerCase().includes(keyword) ||
          item.no_reg.toLowerCase().includes(keyword)
        );
      });
      this.getList();
    },
  },
};
</script>
<style scoped>
  @media(min-width: 990px){

    .container-main-card {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container-card {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
      width: 80%;
    }

    .card {
      width: 28%;
    }

    .image{
      width: 100%;
      height: 100%;
      object-fit: fill;
    }

    .container-col2{
      display: flex;
      justify-content: center;
      align-content: center;
    }

    .container-content{
      width: 200px;
    }

    .filter-container{
      min-width: 400px;
    }

    .container-judul{
      text-align: center;
    }

    .icon-article{
      border: none;
      padding: 0;
    }

    .created-article{
      font-size: 11px;
    }
    .card div h4{
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .kategori{
      margin-bottom: 10px;
    }

  }

  @media(min-width: 769px) and (max-width: 989px) {

    .container-main-card {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container-card {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
      width: 80%;
    }

    .card {
      width: 28%;
    }

    .image{
      width: 100%;
      height: 100%;
      object-fit: fill;
    }

    .container-judul{
      text-align: center;
    }

    .container-col2{
      display: flex;
      justify-content: center;
      align-content: center;
    }

    .icon-article{
      border: none;
      padding: 0;
    }

    .created-article{
      font-size: 11px;
      padding-bottom: 10px;
    }

    .filter-container{
      min-width: 500px;
    }
    .card div h4{
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .kategori{
      margin-bottom: 10px;
    }

  }

  @media(min-width: 540px) and (max-width: 768px){

    .container-main-card {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container-card {
      display: flex;
      flex-wrap: wrap;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 10px;
    }

    .card {
      width: 50%;
    }

    .image{
      width: 100%;
      height: 100%;
      object-fit: fill;
    }

    .container-judul {
      text-align: center;
    }

    .container-col2{
      display: flex;
      justify-content: center;
      align-content: center;
    }

    .container-judul h1{
      word-wrap: break-word;
    }

    .filter-container{
      width: 500px;
    }

    .icon-article{
      border: none;
      padding: 0;
    }

    .created-article{
      font-size: 11px;
      padding-bottom: 10px;
    }
    .card div h4{
      margin: 0px;
      padding: 0px;
    }

    .kategori{
      margin-bottom: 15px;
    }

  }
  @media(max-width: 539px){

    .container-main-card {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container-card {
      display: flex;
      flex-wrap: wrap;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 10px;
    }

    .card {
      width: 100%;
    }

    .image{
      width: 100%;
      height: 100%;
      object-fit: fill;
    }

    .container-judul {
      text-align: center;
    }

    .container-col2{
      display: flex;
      justify-content: center;
      align-content: center;
    }

    .container-judul h1{
      word-wrap: break-word;
    }

    .filter-container{
      width: 500px;
    }

    .icon-article{
      border: none;
      padding: 0;
    }

    .created-article{
      font-size: 11px;
      padding-bottom: 10px;
    }
    .card div h4{
      margin: 0px;
      padding: 0px;
    }

    .kategori{
      margin-bottom: 15px;
    }
  }
</style>
