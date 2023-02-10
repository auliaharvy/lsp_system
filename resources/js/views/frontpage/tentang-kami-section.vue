<template>
  <div>
    <el-collapse-transition>
      <el-row type="flex" class="content" justify="center">
        <el-col :span="12">
          <h1 class="heading-1">Lembaga Sertifikasi Profesi <br> SMKN 2 Cikarang Barat</h1>
          <h2 class="heading-1">Mengapa Kami?</h2>
          <h3 class="heading-1">Karena komitmen kami untuk meningkatkan kebertrimaan Sertifikat Kompetensi oleh industri baik di tingkat nasional maupun internasional.</h3>
        </el-col>
      </el-row>
    </el-collapse-transition>
    <!-- Icon -->
    <!-- <el-row :span="12" type="flex" class="content" justify="center">
      <el-col v-for="(o, index) in 3" :key="o" :offset="index > 0 ? 2 : 0" :span="4" style="text-align: center;">
        <i class="el-icon-edit" style="font-size: 100px; " />
        <h3>100 Skema Sertifikasi</h3>
        <span>Skema / Profesi / Jabatan / Pekerjaan di bidang-bidang strategis sektor Teknologi Informasi dan Komunikasi.</span>
      </el-col>
    </el-row> -->
    <el-row :span="12" type="flex" class="content" justify="center">
      <el-col :span="12">
        <h3 class="heading-1">Daftar Skema Sertifikasi</h3>
      </el-col>
    </el-row>
    <el-row type="flex" class="content" justify="center">
      <el-col :span="12">
        <el-tabs v-if="listKategori" v-model="activeName" @tab-click="handleClick">
          <el-tab-pane
            v-for="item in listKategori"
            :key="item.id"
            :label="item.nama"
            :name="item.nama"
          >
            <el-row type="flex" justify="center">
              <el-col :span="24">
                <el-carousel :interval="4000" type="card" height="420px">
                  <el-carousel-item v-for="i in 6" :key="i">
                    <el-card style="height: 100%;">
                      <img src="https://cdn.siasat.com/wp-content/uploads/2019/03/online-store.png" class="image">
                      <div style="padding-inline: 14px;">
                        <h4>Network Administrator Muda</h4>
                      </div>
                      <div style="padding-inline: 14px;">
                        <span>Profesi terkait skema ini antara lain Network Engineer, Sys admin, IT Network, IT Infrastructure dsb ...</span>
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
export default {
  name: 'TentangKamiSection',
  data() {
    return {
      listKategori: null,
      activeName: 'first',
      currentDate: new Date(),
    };
  },
  created() {
    this.getListKategori();
  },
  methods: {
    async getListKategori() {
      const { data } = await kategoriResource.list();
      this.listKategori = data;
      this.activeName = this.listKategori[0].nama;
    },
    handleClick(tab, event) {
      console.log(tab, event);
    },
  },
};
</script>

<style>
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
