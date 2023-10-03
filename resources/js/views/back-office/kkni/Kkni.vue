<template>
  <div>
    <div class="container-judul">
      <h1>Daftar KKNI</h1>
    </div>
    <div style="margin-top: 15px;">
      <el-row type="flex" justify="center" class="container-carousel">
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
              <div v-if="isMobile" :interval="4000" height="440px" arrow="always" class="container-main-card">
                <div class="container-card">
                  <el-card v-for="(item, index) in list" :key="index" class="card">
                    <div style="padding-bottom: 15px;">
                      <h4>{{ item.nama }}</h4>
                      <div class="created-article">
                        <div>
                          <el-button icon="el-icon-date" class="icon-article" />
                          <span>{{ item.tahun }}</span>
                        </div>
                        <div style="padding-top: 10px;">
                          <el-button icon="el-icon-star-on" class="icon-article" />
                          <span>{{ item.jurusan }}</span>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div class="bottom clearfix">
                        <a target="_blank" :href="'/uploads/kkni/' + item.upload_path">
                          <el-button type="primary">
                            Detail
                          </el-button>
                        </a>
                      </div>
                    </div>
                  </el-card>
                </div>
              </div>
              <div v-else class="container-main-card">
                <div class="container-card">
                  <el-card v-for="(item, index) in list" :key="index" class="card">
                    <div style="padding-bottom: 15px;">
                      <h4>{{ item.nama }}</h4>
                      <div class="created-article">
                        <div>
                          <el-button icon="el-icon-date" class="icon-article" />
                          <span>{{ item.tahun }}</span>
                        </div>
                        <div style="padding-top: 10px;">
                          <el-button icon="el-icon-star-on" class="icon-article" />
                          <span>{{ item.jurusan }}</span>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div class="bottom clearfix">
                        <a target="_blank" :href="'/uploads/kkni/' + item.upload_path">
                          <el-button type="primary">
                            Detail
                          </el-button>
                        </a>
                      </div>
                    </div>
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
const kkniResource = new Resource('kkni');
export default {
  name: 'SkemaList',
  components: { SecondPagination },
  directives: { waves },
  data() {
    return {
      list: {},
      activeName: 'Unit Kompetensi',
      isMobile: false,
      isTablet: false,
      isLaptop: false,
      isTabletToLaptop: false,
      query: {
        page: 1,
        limit: 15,
        keyword: '',
        role: '',
      },
    };
  },
  created() {
    this.getList();
  },
  mounted() {
    this.handleResize();
    window.addEventListener('resize', this.handleResize);
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.handleResize);
  },
  methods: {
    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      const { data, meta } = await kkniResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.total = meta.total;
      this.loading = false;
      console.log(this.list);
    },
    getColumnSpan() {
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
    handleResize() {
      const screenWidth = window.innerWidth;
      this.isMobile = screenWidth < 768;
      this.isTablet = screenWidth >= 768 && screenWidth < 1024;
      this.isLaptop = screenWidth >= 1024;
    },

    handleFilter() {
      const keyword = this.query.keyword.toLowerCase(); // Konversi kata kunci pencarian ke huruf kecil
      this.list = this.list.filter((item) => {
        return (
          item.nama.toLowerCase().includes(keyword)
        );
      });
      this.getList();
    },
  },
};
</script>
<style scoped>
@media(min-width: 990px) {

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
    width: 30%;
  }

  .container-col2 {
    display: flex;
    justify-content: center;
    align-content: center;
  }

  .container-judul {
    text-align: center;
  }

  .icon-article {
    border: none;
    padding: 0;
  }

  .created-article {
    font-size: 11px;
    padding-top: 10px;
  }

  .filter-container {
    min-width: 400px;
  }

  .card {
    width: 32.5%
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
    width: 30%;
  }

  .container-col2 {
    display: flex;
    justify-content: center;
    align-content: center;
  }

  .container-judul {
    text-align: center;
  }

  .icon-article {
    border: none;
    padding: 0;
  }

  .created-article {
    font-size: 11px;
    padding-top: 10px;
  }

  .filter-container {
    min-width: 500px;
  }
}

@media(max-width: 768px) {

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
  }

  .card {
    width: 100%;
  }

  .container-card {
    width: 400px;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .container-col2 {
    display: flex;
    justify-content: center;
    align-content: center;
  }

  .container-judul {
    text-align: center;
  }

  .icon-article {
    border: none;
    padding: 0;
  }

  .created-article {
    font-size: 11px;
    padding-top: 10px;
  }

  .filter-container {
    width: 500px;
  }

}
</style>
