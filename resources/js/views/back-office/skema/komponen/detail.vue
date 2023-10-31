<template>
  <div>
    <div class="container-judul">
      <h1>{{ $route.params.kategori.toUpperCase() }}</h1>
      <el-button type="primary">DAFTAR UJI KOMPETENSI</el-button>
      <el-button type="primary" plain>PRE TEST</el-button>
    </div>
    <div class="container-info">
      <div class="card">
        <span>{{ asesorKompetensi }}</span>
        <div><h4>ASESOR KOMPETENSI</h4></div>
      </div>
      <div class="card">
        <span>{{ pemegangSertifikat }}</span>
        <div><h4>PEMEGANG SERTIFIKAT</h4></div>
      </div>
      <div class="card">
        <span>10+</span>
        <div><h4>LOWONGAN PEKERJAAN</h4></div>
      </div>
    </div>
    <div class="container-bio">
      <div class="container-second-bio">
        <el-table
          :data="tableData"
          class="el-table"
        >
          <el-table-column
            prop="title"
            width="125"
            class="title"
          />
          <el-table-column
            prop="tiua"
            width="10"
            class="tiua"
          />
          <el-table-column
            prop="content"
            class="content"
          />
        </el-table>
      </div>
    </div>
    <el-row type="flex" justify="center" class="container-carousel">
      <el-col :span="getColumnSpan() === 6 ? 12 : getColumnSpan()" class="for-carousel">
        <el-tabs v-model="activeName">
          <el-tab-pane
            v-for="item in listSkema"
            :key="item.judul"
            :label="item.judul"
            :name="item.judul"
          >
            <el-table
              :data="listUnitKompetensi"
              height="400"
              style="width: 100%; margin-bottom: 30px;"
            >
              <el-table-column
                prop="no"
                label="No"
                :min-width="60"
                class="column-no"
              />
              <el-table-column
                prop="kode_unit"
                label="Kode Unit"
                :min-width="150"
                class="column-kode-unit"
              />
              <el-table-column
                prop="unit_kompetensi"
                label="Unit Kompetensi"
                :min-width="200"
                class="column-unit-kompetensi"
              />
            </el-table>
          </el-tab-pane>
        </el-tabs>
      </el-col>
    </el-row>
  </div>
</template>
<script>
import Resource from '@/api/resource';
const skemaResource = new Resource('skema-get');
const jadwalAsesmen = new Resource('detail/jadwal-asesmen');
export default {
  name: 'SkemaList',
  data() {
    return {
      asesorKompetensi: null,
      pemegangSertifikat: null,
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
    this.getSkema();
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
    async getSkema(){
      const skema = await skemaResource.list({ id_skema: this.$route.params.id });
      const asesmen = await jadwalAsesmen.get(this.$route.params.id);
      this.tableData[0].content = skema.data[0].skema_sertifikasi;
      this.tableData[1].content = skema.data[0].kode_skema;
      this.tableData[2].content = skema.data[0].children.length;

      this.listSkema[0].content = skema.data[0].children;

      let i = 1;
      skema.data[0].children.forEach(element => {
        const dataSkema = {};
        dataSkema.no = i;
        dataSkema.kode_unit = element.kode_unit;
        dataSkema.unit_kompetensi = element.unit_kompetensi;
        this.listUnitKompetensi.push(dataSkema);
        i++;
      });
      this.asesorKompetensi = asesmen.jumlah_asesor;
      this.pemegangSertifikat = asesmen.jumlah_pemegang_sertifikat;
    },
  },
};
</script>
<style scoped>
  @media(min-width: 990px){
    .container-info{
      display: flex;
      margin-top: 40px;
    }

    .card{
      display: inline-block;
      text-align: center;
      height: 80px;
      width: 33%;
    }

    .container-info .card span{
      margin-top: 20px;
      font-size: 30px;
      color: #223f4d;
      font-weight: 900;
    }

    .container-bio{
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 30px;
    }

    .container-second-bio{
      width: 80%;
    }
  }

  .container-judul {
    display: block;
    text-align: center;
  }
  .container-judul h1{
    word-wrap: break-word;
  }

  .container-info{
    display: block;
  }

  .container-info .card{
    text-align: center;
    height: 80px;
    margin-top: 20px;
  }

  .container-info .card span{
    font-size: 30px;
    color: #223f4d;
    font-weight: 900;
  }

  .card div h4{
    color: #23252a;
    font-size: 15px;
  }

  .title{
    word-wrap: break-word;
    font-weight: 900;
  }

  .container-bio{
    margin-bottom: 30px;
  }

  .column-no{
    width: 5%;
  }

  .column-kode-unit{
    width: 15%;
  }

  .column-unit-kompetensi{
    width: 80%;
  }
</style>
