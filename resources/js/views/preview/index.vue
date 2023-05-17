<template>
  <div>
    <!-- <router-view :iduji="$route.params.id_uji" :idskema="$route.params.id_skema" :asesor="$route.params.asesor" /> -->
    <router-view :iduji="id_uji" :idskema="id_skema" :asesor="nama_asesor" :idapl01="idapl01" />
    <!-- <el-row :gutter="20">
      <apl_01 v-if="$route.params.id_apl_01 !== null" :idapl01="$route.params.id_apl_01" :iduji="$route.params.id_uji" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.APL.01 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row> -->
    <!--
    <el-row :gutter="20">
      <apl_02 v-if="$route.params.id_apl_02 !== null" :iduji="$route.params.id_uji" :idapl01="$route.params.id_apl_01" :idapl02="$route.params.id_apl_02" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.APL.02 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row>
    <el-row :gutter="20">
      <mapa_02 v-if="$route.params.id_mapa_02 !== null" :iduji="$route.params.id_uji" :idmapa02="$route.params.id_mapa_02" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.MAPA.02 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row>
    <el-row :gutter="20">
      <ak_01 v-if="$route.params.id_ak_01 !== null" :iduji="$route.params.id_uji" :idak01="$route.params.id_ak_01" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.AK.01 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row>
    <el-row :gutter="20">
      <ak_04 v-if="$route.params.id_ak_04 !== null" :iduji="$route.params.id_uji" :idak04="$route.params.id_ak_04" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.AK.04 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row>
    <el-row :gutter="20">
      <ia_01 v-if="$route.params.id_ia_01 !== null" :iduji="$route.params.id_uji" :idia01="$route.params.id_ia_01" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.IA.01 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row>
    <el-row :gutter="20">
      <ia_02 v-if="$route.params.id_ia_02 !== null" :iduji="$route.params.id_uji" :idia02="$route.params.id_ia_02" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.IA.02 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row>
    -->
    <!-- <el-row :gutter="20">
      <ia_03 v-if="$route.params.id_ia_03 !== null" :iduji="$route.params.id_uji" :idia03="$route.params.id_ia_03" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.IA.03 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row> -->
    <!--
    <el-row :gutter="20">
      <ia_05 v-if="$route.params.id_ia_05 !== null" :iduji="$route.params.id_uji" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.IA.05 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row>
    <el-row :gutter="20">
      <ia_06 v-if="$route.params.id_ia_06 !== null" :iduji="$route.params.id_uji" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.IA.06 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row>
    <el-row :gutter="20">
      <ia_07 v-if="$route.params.id_ia_07 !== null" :iduji="$route.params.id_uji" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.IA.07 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row>
    <el-row :gutter="20">
      <ia_11 v-if="$route.params.id_ia_11 !== null" :iduji="$route.params.id_uji" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.IA.11 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row>
    <el-row :gutter="20">
      <ak_02 v-if="$route.params.id_ak_02 !== null" :iduji="$route.params.id_uji" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.AK.02 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row>
    <el-row :gutter="20">
      <ak_03 v-if="$route.params.id_ak_03 !== null" :iduji="$route.params.id_uji" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.AK.03 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row>
    <el-row :gutter="20">
      <ak_05 v-if="$route.params.id_ak_05 !== null" :iduji="$route.params.id_uji" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.AK.05 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row>
    <el-row :gutter="20">
      <ak_06 v-if="$route.params.id_ak_06 !== null" :iduji="$route.params.id_uji" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.AK.06 BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row>
    <el-row :gutter="20">
      <va v-if="$route.params.id_va !== null" :iduji="$route.params.id_uji" :asesor="$route.params.asesor" :idskema="$route.params.id_skema" />
      <el-container v-else class="app-container">
        <el-header>
          <el-page-header content="FORM FR.VA BELUM DIISI" @back="$router.back()" />
        </el-header>
      </el-container>
    </el-row> -->
    <el-button-group>
      <el-button type="primary" icon="el-icon-arrow-left" :disabled="!hasPreviousPage" @click="goToPreviousPage">Previous Page</el-button>
      <el-button type="primary" icon="el-icon-arrow-right" :disabled="!hasNextPage" @click="goToNextPage">Next Page</el-button>
    </el-button-group>
  </div>
</template>
<script>
import Resource from '@/api/resource';
const previewResource = new Resource('detail/preview');

// import Apl_01 from './uji/fr_apl/01/index';
// import Apl_02 from './uji/fr_apl/02/index';
// import Mapa_02 from './uji/fr_mapa/02/index';
// import Ak_01 from './uji/fr_ak/01/index';
// import Ak_04 from './uji/fr_ak/04/index';
// import Ia_01 from './uji/fr_ia/01/index';
// import Ia_02 from './uji/fr_ia/02/index';
// import Ia_03 from './uji/fr_ia/03/index';
// import Ia_05 from './uji/fr_ia/05/index';
// import Ia_06 from './uji/fr_ia/06/index';
// import Ia_07 from './uji/fr_ia/07/index';
// import Ia_11 from './uji/fr_ia/11/index';
// import Ak_02 from './uji/fr_ak/02/index';
// import Ak_03 from './uji/fr_ak/03/index';
// import Ak_05 from './uji/fr_ak/05/index';
// import Ak_06 from './uji/fr_ak/06/index';
// import Va from './uji/fr_va/index';

export default {
  name: 'IndexPreview',
  components: {
    // 'apl_01': Apl_01,
    // 'apl_02': Apl_02,
    // 'mapa_02': Mapa_02,
    // 'ak_01': Ak_01,
    // 'ak_04': Ak_04,
    // 'ia_01': Ia_01,
    // 'ia_02': Ia_02,
    // 'ia_03': Ia_03,
    // 'ia_05': Ia_05,
    // 'ia_06': Ia_06,
    // 'ia_07': Ia_07,
    // 'ia_11': Ia_11,
    // 'ak_02': Ak_02,
    // 'ak_03': Ak_03,
    // 'ak_05': Ak_05,
    // 'ak_06': Ak_06,
    // 'va': Va,:w
  },
  data(){
    return {
      data_uji_komp: '',
      id_uji: this.$route.params.iduji,
      id_skema: this.$route.params.idskema,
      nama_asesor: this.$route.params.asesor,
      idapl01: '',
      allPage: [
        'preview-apl-01',
        'preview-apl-02',
        'preview-mapa-02',
        'preview-ak-01',
        'preview-ak-04',
        'preview-ia-01',
        'preview-ia-02',
        'preview-ia-03',
        // this.$router.push({ name: 'preview-apl-01', params: { id_uji: this.id_uji, id_skema: this.id_skema, asesor: this.nama_asesor }}),
        // this.$router.push({ name: 'preview-apl-02', params: { id_uji: this.id_uji, id_skema: this.id_skema, asesor: this.nama_asesor }}),
        // this.$router.push({ name: 'preview-mapa-02', params: { id_uji: this.id_uji, id_skema: this.id_skema, asesor: this.nama_asesor }}),
        // this.$router.push({ name: 'preview-ak-01', params: { id_uji: this.id_uji, id_skema: this.id_skema, asesor: this.nama_asesor }}),
        // this.$router.push({ name: 'preview-ak-04', params: { id_uji: this.id_uji, id_skema: this.id_skema, asesor: this.nama_asesor }}),
        // this.$router.push({ name: 'preview-ia-01', params: { id_uji: this.id_uji, id_skema: this.id_skema, asesor: this.nama_asesor }}),
        // this.$router.push({ name: 'preview-ia-02', params: { id_uji: this.id_uji, id_skema: this.id_skema, asesor: this.nama_asesor }}),
        // this.$router.push({ name: 'preview-ia-03', params: { id_uji: this.id_uji, id_skema: this.id_skema, asesor: this.nama_asesor }}),
      ],
      currentPage: 0,
    };
  },
  computed: {
    hasPreviousPage(){
      return this.$route.meta.previousPage !== undefined;
    },
    hasNextPage(){
      return this.$route.meta.nextPage !== undefined;
    },
  },
  created(){
    this.previewResource();
    console.log(this.data_uji_komp);
  },
  methods: {
    async previewResource(){
      this.data_uji_komp = await previewResource.get(this.id_uji);
      this.idapl01 = this.data_uji_komp.id_apl_01;
    },
    // goToPreviousPage(){
    //   if (this.hasPreviousPage){
    //     this.$router.push({ name: this.$route.meta.prekviousPage, params: { iduji: this.id_uji, idskema: this.id_skema, asesor: this.nama_asesor, dataujikomp: this.data_uji_komp }});
    //   }
    // },
    // goToNextPage(){
    //   if (this.hasNextPage){
    //     this.$router.push({ name: this.$route.meta.nextPage, params: { iduji: this.id_uji, idskema: this.id_skema, asesor: this.nama_asesor, dataujikomp: this.data_uji_komp }});
    //   }
    // },
  },
};
</script>
