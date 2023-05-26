<template>
  <el-container v-if="dataPreview.id_va == null" v-loading="loading" class="app-container">
    <el-header>
      <el-page-header content="FORM FR.VA BELUM DIISI" @back="$router.back()" />
      <el-dropdown split-button type="primary">
        {{ $route.name }}
        <el-dropdown-menu slot="dropdown">
          <el-dropdown-item><router-link :to="{ name: 'preview-apl-01', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">APL 01</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-apl-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">APL 02</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-mapa-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">MAPA 02</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-ak-01', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">AK 01</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-ak-04', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">AK 04</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-ia-01', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">IA 01</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-ia-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">IA 02</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-ia-03', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">IA 03</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-ia-05', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">IA 05</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-ia-06', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">IA 06</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-ia-07', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">IA 07</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-ia-11', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">IA 11</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-ak-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">AK 02</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-ak-03', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">AK 03</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-ak-05', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">AK 05</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-ak-06', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">AK 06</router-link></el-dropdown-item>
          <el-dropdown-item><router-link :to="{ name: 'preview-va', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">VA</router-link></el-dropdown-item>
        </el-dropdown-menu>
      </el-dropdown>
      <el-button-group>
        <router-link :to="{name: 'preview-ak-6', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ia03: dataPreview.id_ia_03 }}"><el-button type="primary" icon="el-icon-arrow-left">Previous Page</el-button></router-link>
        <router-link :to="{name: '', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ia06: dataPreview.id_ia_06 }}"><el-button type="primary" icon="el-icon-arrow-right">Next Page</el-button></router-link>
      </el-button-group>
    </el-header>
  </el-container>
  <el-container v-else class="app-container">
    <el-header>
      <!-- TODO Penyesuain dengan form -->
      <span>
        <el-page-header content="FR.VA MEMBERIKAN KONTRIBUSI DALAM VALIDASI ASESMEN" @back="$router.back()" />
      </span>
      <span>
        <el-dropdown split-button type="primary">
          {{ $route.name }}
          <el-dropdown-menu slot="dropdown">
            <el-dropdown-item><router-link :to="{ name: 'preview-apl-01', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">APL 01</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-apl-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">APL 02</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-mapa-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">MAPA 02</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ak-01', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">AK 01</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ak-04', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">AK 04</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ia-01', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">IA 01</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ia-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">IA 02</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ia-03', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">IA 03</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ia-05', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">IA 05</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ia-06', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">IA 06</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ia-07', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">IA 07</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ia-11', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">IA 11</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ak-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">AK 02</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ak-03', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">AK 03</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ak-05', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">AK 05</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ak-06', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">AK 06</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-va', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: $route.params.apl01, apl02: $route.params.apl02, mapa02: $route.params.mapa02, ak01: $route.params.ak01, ak04: $route.params.ak04, ia01: $route.params.ia01, ia02: $route.params.ia02, ia03: dataPreview.id_ia_03, ia05: $route.params.ia05, id06: $route.params.ia06, ia07: $route.params.ia07, ia11: $route.params.ia11, ak02: $route.params.ak02, ak03: $route.params.ak03, ak05: $route.params.ak05, ak06: dataPreview.id_ak_06, va: dataPreview.id_va }}">VA</router-link></el-dropdown-item>
          </el-dropdown-menu>
        </el-dropdown>
      </span>
      <span>
        <el-button-group>
          <router-link :to="{name: 'preview-ak-06', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ia03: dataPreview.id_ia_03 }}"><el-button type="primary" icon="el-icon-arrow-left">Previous Page</el-button></router-link>
          <router-link :to="{name: '', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ia06: dataPreview.id_ia_06 }}"><el-button type="primary" icon="el-icon-arrow-right">Next Page</el-button></router-link>
        </el-button-group>
      </span>
    </el-header>
    <el-main>
      <div>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="12">
            <el-form ref="form" label-width="120px">
              <el-form-item label="Tim Validasi 1">
                <span>: {{ informasiValidasiAsesmen.tim_validasi_1 }}</span>
              </el-form-item>
              <el-form-item label="Tim Validasi 2">
                <span>: {{ informasiValidasiAsesmen.tim_validasi_2 }}</span>
              </el-form-item>
            </el-form>
          </el-col>
          <el-col :sm="24" :md="24" :lg="12">
            <el-form ref="form" label-width="120px">
              <el-form-item label="Hari / Tanggal">
                <span>: {{ informasiValidasiAsesmen.hari_tanggal }}</span>
              </el-form-item>
              <el-form-item label="Tempat">
                <span>: {{ informasiValidasiAsesmen.tempat }}</span>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-form ref="form" label-width="120px">
              <el-form-item label="Periode">
                <span v-if="informasiValidasiAsesmen.periode === 1">: Sebelum asesmen</span>
                <span v-if="informasiValidasiAsesmen.periode === 2">: Pada saat asesmem</span>
                <span v-if="informasiValidasiAsesmen.periode === 3">: Setelah asesmen</span>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-form ref="form" label-width="120px">
              <el-form-item label="Nama Skema">
                <span>: {{ informasiValidasiAsesmen.nama_skema }}</span>
              </el-form-item>
              <el-form-item label="No Skema">
                <span>: {{ informasiValidasiAsesmen.no_skema }}</span>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <h4>Bagian 1 : Menyiapkan proses validasi</h4>
        <br>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-form ref="form" label-width="200px">
              <el-form-item label="Tujuan dan fokus validasi">
                <span>: {{ informasiValidasiAsesmen.tujuan_dan_fokus_validasi ? informasiValidasiAsesmen.tujuan_dan_fokus_validasi : '' }}</span>
              </el-form-item>
              <el-form-item label="Konteks validasi">
                <span>: {{ informasiValidasiAsesmen.tujuan_dan_fokus_validasi ? informasiValidasiAsesmen.konteks_validasi : '' }}</span>
              </el-form-item>
              <el-form-item label="Pendekatan validasi">
                <span>: {{ informasiValidasiAsesmen.tujuan_dan_fokus_validasi ? informasiValidasiAsesmen.pendekatan_validasi : '' }}</span>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-table
              v-loading="loading"
              :data="tableOrangRelevan"
              border
              fit
              highlight-current-row
              style="width: 100%"
              :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white'}"
            >
              <el-table-column align="left" min-width="80px" label="Orang yang relevan">
                <template slot-scope="scope">
                  <template v-if="scope.row.no === 1">
                    <span>Asesor Kompetensi</span>
                  </template>
                  <template v-if="scope.row.no === 2">
                    <span>Lead Asesor</span>
                  </template>
                  <template v-if="scope.row.no === 3">
                    <span>Manager, Supervisor</span>
                  </template>
                  <template v-if="scope.row.no === 4">
                    <span>Tenaga Ahli di bidangnya</span>
                  </template>
                  <template v-if="scope.row.no === 5">
                    <span>Koordinator Pelatihan</span>
                  </template>
                  <template v-if="scope.row.no === 6">
                    <span>Anggota Asosiasi industri/profesi</span>
                  </template>
                </template>
              </el-table-column>
              <el-table-column align="left" min-width="200px" label="Nama">
                <template slot-scope="scope">
                  <template v-if="scope.row.no === 1">
                    <el-form label-width="20px">
                      <el-form-item label="1">
                        <span>{{ tableOrangRelevan[0].asesor.asesor_1 }}</span>
                      </el-form-item>
                      <el-form-item label="2">
                        <span>{{ tableOrangRelevan[0].asesor.asesor_2 }}</span>
                      </el-form-item>
                      <el-form-item label="3">
                        <span>{{ tableOrangRelevan[0].asesor.asesor_3 }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 2">
                    <el-form label-width="20px">
                      <el-form-item>
                        <span>{{ tableOrangRelevan[1].lead_asesor }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 3">
                    <el-form label-width="20px">
                      <el-form-item>
                        <span>{{ tableOrangRelevan[2].manager }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 4">
                    <el-form label-width="20px">
                      <el-form-item>
                        <span>{{ tableOrangRelevan[3].tenaga_ahli }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 5">
                    <el-form label-width="20px">
                      <el-form-item>
                        <span>{{ tableOrangRelevan[4].koordinator_pelatihan }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 6">
                    <el-form label-width="20px">
                      <el-form-item>
                        <span>{{ tableOrangRelevan[5].anggota_asosiasi }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                </template>
              </el-table-column>
              <el-table-column align="left" min-width="200px" label="Hasil Konfirmasi/diskusi tujuan, fokus & konteks">
                <template slot-scope="scope">
                  <template v-if="scope.row.no === 1">
                    <el-form label-width="20px">
                      <el-form-item label="1">
                        <span>{{ tableOrangRelevan[0].hasil_konfirmasi.hasil_konfirmasi_asesor_1 }}</span>
                      </el-form-item>
                      <el-form-item label="2">
                        <span>{{ tableOrangRelevan[0].hasil_konfirmasi.hasil_konfirmasi_asesor_2 }}</span>
                      </el-form-item>
                      <el-form-item label="3">
                        <span>{{ tableOrangRelevan[0].hasil_konfirmasi.hasil_konfirmasi_asesor_3 }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 2">
                    <el-form label-width="20px">
                      <el-form-item>
                        <span>{{ tableOrangRelevan[1].hasil_konfirmasi_lead_asesor }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 3">
                    <el-form label-width="20px">
                      <el-form-item>
                        <span>{{ tableOrangRelevan[2].hasil_konfirmasi_manager }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 4">
                    <el-form label-width="20px">
                      <el-form-item>
                        <span>{{ tableOrangRelevan[3].hasil_konfirmasi_tenaga_ahli }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 5">
                    <el-form label-width="20px">
                      <el-form-item>
                        <span>{{ tableOrangRelevan[4].hasil_konfirmasi_koordinator_pelatihan }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 6">
                    <el-form label-width="20px">
                      <el-form-item>
                        <span>{{ tableOrangRelevan[5].hasil_konfirmasi_anggota_asosiasi }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                </template>
              </el-table-column>
            </el-table>
          </el-col>
        </el-row>
        <br>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-form ref="form" label-width="200px">
              <el-form-item label="Acuan Pembanding">
                <span>: {{ informasiValidasiAsesmen.acuan_pembanding ? informasiValidasiAsesmen.acuan_pembanding : '' }}</span>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-form label-width="200px">
              <el-form-item label="Dokumen Terkait dan Bahan - Bahan">
                <span>: {{ informasiValidasiAsesmen.dokumen_terkait ? informasiValidasiAsesmen.dokumen_terkait : '' }}</span>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <h4>Bagian 2 : Memberikan kontribusi dalam proses validasi</h4>
        <br>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-form label-width="200px">
              <el-form-item label="Keterampilan Komunikasi">
                <span>{{ aspekKegiatan[0].keterampilan_komunikasi }}</span>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-table
              v-loading="loading"
              :data="aspekKegiatan[1].listAspek"
              border
              fit
              highlight-current-row
              style="width: 100%"
              :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
            >
              <el-table-column align="left" min-width="80px" label="Aspek-Aspek Dalam Kegiatan Validasi (Meninjau, Membandingkan, Mengevaluasi)">
                <template slot-scope="{row}">
                  <span>{{ row.item }}</span>
                </template>
              </el-table-column>
              <el-table-column label="Pemenuhan terhadap:">
                <el-table-column label="Aturan Bukti">
                  <el-table-column align="center" min-width="10px" label="V">
                    <template slot-scope="{row}">
                      <span v-if="row.aturan_v == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                  <el-table-column align="center" min-width="10px" label="A">
                    <template slot-scope="{row}">
                      <span v-if="row.aturan_a == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                  <el-table-column align="center" min-width="10px" label="T">
                    <template slot-scope="{row}">
                      <span v-if="row.aturan_t == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                  <el-table-column align="center" min-width="10px" label="M">
                    <template slot-scope="{row}">
                      <span v-if="row.aturan_m == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                </el-table-column>
                <el-table-column label="Prinsip Asesmen">
                  <el-table-column align="center" min-width="10px" label="V">
                    <template slot-scope="{row}">
                      <span v-if="row.prinsip_m == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                  <el-table-column align="center" min-width="10px" label="R">
                    <template slot-scope="{row}">
                      <span v-if="row.prinsip_r == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                  <el-table-column align="center" min-width="10px" label="F">
                    <template slot-scope="{row}">
                      <span v-if="row.prinsip_f == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                  <el-table-column align="center" min-width="10px" label="F">
                    <template slot-scope="{row}">
                      <span v-if="row.prinsip_f_2 == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                </el-table-column>
              </el-table-column>
            </el-table>
          </el-col>
        </el-row>
        <h4>Bagian 3 : Memberikan kontribusi untuk hasil asesmen</h4>
        <br>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-table
              v-loading="loading"
              :data="listTemuanValidasi"
              border
              fit
              highlight-current-row
              style="width: 100%"
              :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
            >
              <el-table-column align="left" min-width="80px" label="Temuan-temuan validasi :">
                <template slot-scope="{row}">
                  <span>{{ row.temuan }}</span>
                </template>
              </el-table-column>
              <el-table-column align="left" min-width="80px" label="Rekomendasi-rekomendasi untuk meningkatkan praktek asesmen">
                <template slot-scope="{row}">
                  <span>{{ row.rekomendasi }}</span>
                </template>
              </el-table-column>
            </el-table>
          </el-col>
        </el-row>
        <h4>Rencana Implementasi  perubahan/perbaikan pelaksanaan asesmen :</h4>
        <br>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-table
              v-loading="loading"
              :data="listRencanaImplementasi"
              border
              fit
              highlight-current-row
              style="width: 100%"
              :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
            >
              <el-table-column label="Rencana Implementasi  perubahan/perbaikan pelaksanaan asesmen :">
                <el-table-column align="left" min-width="80px" label="Kegiatan Perbaikan sesuai Rekomendasi">
                  <template slot-scope="{row}">
                    <span>{{ row.kegiatan }}</span>
                  </template>
                </el-table-column>
                <el-table-column align="left" min-width="80px" label="Waktu Penyelesaian">
                  <template slot-scope="{row}">
                    <span>{{ row.waktu }}</span>
                  </template>
                </el-table-column>
                <el-table-column align="left" min-width="80px" label="Penanggungjawab">
                  <template slot-scope="{row}">
                    <span>{{ row.penanggung_jawab }}</span>
                  </template>
                </el-table-column>
              </el-table-column>
            </el-table>
          </el-col>
        </el-row>
      </div>
    </el-main>
  </el-container>
</template>

<script>
import { mapGetters } from 'vuex';
import Resource from '@/api/resource';
const indexPreview = new Resource('detail/indexPreview');
const vaDetail = new Resource('detail/va');

export default {
  data() {
    return {
      loading: false,
      informasiValidasiAsesmen: {
        tim_validasi_1: '',
        tim_validasi_2: '',
        periode: '',
        nama_skema: '',
        no_skema: '',
        hari_tanggal: '',
        tempat: '',
        tujuan_dan_fokus_validasi: '',
        konteks_validasi: '',
        pendekatan_validasi: '',
        acuan_pembanding: '',
        dokumen_terkait: '',
      },
      tableOrangRelevan: [
        {
          no: 1,
          asesor: {
            asesor_1: '',
            asesor_2: '',
            asesor_3: '',
          },
          hasil_konfirmasi: {
            hasil_konfirmasi_asesor_1: '',
            hasil_konfirmasi_asesor_2: '',
            hasil_konfirmasi_asesor_3: '',
          },
        },
        {
          no: 2,
          lead_asesor: '',
          hasil_konfirmasi_lead_asesor: '',
        },
        {
          no: 3,
          manager: '',
          hasil_konfirmasi_manager: '',
        },
        {
          no: 4,
          tenaga_ahli: '',
          hasil_konfirmasi_tenaga_ahli: '',
        },
        {
          no: 5,
          koordinator_pelatihan: '',
          hasil_konfirmasi_koordinator_pelatihan: '',
        },
        {
          no: 6,
          anggota_asosiasi: '',
          hasil_konfirmasi_anggota_asosiasi: '',
        },
      ],
      aspekKegiatan: [
        {
          keterampilan_komunikasi: '',
        },
        {
          listAspek: [],
        },
      ],
      listTemuanValidasi: [],
      listRencanaImplementasi: [],
      panduan: [
        'Lengkapi nama unit kompetensi, elemen, kriteria unjuk kerja sesuai kolom dalam tabel.',
        'Istilah Acuan Pembanding dengan SOP / spesifikasi produk dari industri / orginasi dari tempat kerja atau simulasi tempat kerja',
        'Beri tanda centang pada kolom K jika Anda yakin asesi dapat melakukan/mendemonstrasikan tugas seuai KUK, atau centang pada kolom BK bila sebaliknya.',
        'Penilaian lanjut diisi bila hasil belum dapat disimpulkan, untuk itu gunakan metode lain sehingga keputusan dapat dibuat',
      ],
      form: {},
      active: 0,
      isWide: true,
      labelPosition: 'left',
      dataPreview: '',
      previewInformasi: '',
      previewTableAspek: '',
      previewTemuan: '',
      previewRencanaImplementasi: '',
    };
  },
  computed: {
    ...mapGetters([
      'userId',
    ]),
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.onResize);
  },
  mounted() {
    window.addEventListener('resize', this.onResize);
    this.onResize();
  },
  created() {
    this.getDataUjiPreview().then(() => {
      this.getInformasiValidasiAsesmen();
      this.getTableOrangRelevan();
      this.getAspek();
      this.getTemuan();
      this.getRencanaImplementasi();
    });
  },
  methods: {
    async getDataUjiPreview(){
      this.loading = true;
      const result = await indexPreview.get(this.$route.params.iduji);
      this.dataPreview = result.data[0];
      if (this.dataPreview.id_va !== null){
        const data = await vaDetail.get(this.dataPreview.id_va);
        this.previewInformasi = data.dataVa[0];
        this.previewTableAspek = data.aspek;
        this.previewTemuan = data.temuan;
        this.previewRencanaImplementasi = data.rencana;
      }
      this.loading = false;
    },
    async getInformasiValidasiAsesmen(){
      this.loading = true;
      this.informasiValidasiAsesmen.tim_validasi_1 = this.previewInformasi.tim_validasi_1;
      this.informasiValidasiAsesmen.tim_validasi_2 = this.previewInformasi.tim_validasi_2;
      this.informasiValidasiAsesmen.tempat = this.previewInformasi.nama_tuk;
      this.informasiValidasiAsesmen.periode = this.previewInformasi.periode;
      this.informasiValidasiAsesmen.nama_skema = this.previewInformasi.skema_sertifikasi;
      this.informasiValidasiAsesmen.no_skema = this.previewInformasi.kode_skema;
      this.informasiValidasiAsesmen.hari_tanggal = this.previewInformasi.waktu;
      this.informasiValidasiAsesmen.tujuan_dan_fokus_validasi = this.previewInformasi.tujuan_dan_fokus_validasi;
      this.informasiValidasiAsesmen.konteks_validasi = this.previewInformasi.konteks_validasi;
      this.informasiValidasiAsesmen.pendekatan_validasi = this.previewInformasi.pendekatan_validasi;
      this.informasiValidasiAsesmen.acuan_pembanding = this.previewInformasi.acuan_pembanding;
      this.informasiValidasiAsesmen.dokumen_terkait = this.previewInformasi.dokumen_terkait;

      this.loading = false;
    },
    async getTableOrangRelevan(){
      this.loading = true;
      this.tableOrangRelevan[0].asesor.asesor_1 = this.previewInformasi.nama_asesor_1;
      this.tableOrangRelevan[0].asesor.asesor_2 = this.previewInformasi.nama_asesor_2;
      this.tableOrangRelevan[0].asesor.asesor_3 = this.previewInformasi.nama_asesor_3;
      this.tableOrangRelevan[0].hasil_konfirmasi.hasil_konfirmasi_asesor_1 = this.previewInformasi.hasil_konfirmasi_asesor_1;
      this.tableOrangRelevan[0].hasil_konfirmasi.hasil_konfirmasi_asesor_2 = this.previewInformasi.hasil_konfirmasi_asesor_2;
      this.tableOrangRelevan[0].hasil_konfirmasi.hasil_konfirmasi_asesor_3 = this.previewInformasi.hasil_konfirmasi_asesor_3;
      this.tableOrangRelevan[1].lead_asesor = this.previewInformasi.nama_lead_asesor;
      this.tableOrangRelevan[1].hasil_konfirmasi_lead_asesor = this.previewInformasi.hasil_konfirmasi_lead_asesor;
      this.tableOrangRelevan[2].manager = this.previewInformasi.manager;
      this.tableOrangRelevan[2].hasil_konfirmasi_manager = this.previewInformasi.hasil_konfirmasi_manager;
      this.tableOrangRelevan[3].tenaga_ahli = this.previewInformasi.tenaga_ahli;
      this.tableOrangRelevan[3].hasil_konfirmasi_tenaga_ahli = this.previewInformasi.hasil_konfirmasi_tenaga_ahli;
      this.tableOrangRelevan[4].koordinator_pelatihan = this.previewInformasi.koordinator_pelatihan;
      this.tableOrangRelevan[4].hasil_konfirmasi_koordinator_pelatihan = this.previewInformasi.hasil_konfirmasi_koordinator_pelatihan;
      this.tableOrangRelevan[5].anggota_asosiasi = this.previewInformasi.anggota_asosiasi;
      this.tableOrangRelevan[5].hasil_konfirmasi_anggota_asosiasi = this.previewInformasi.hasil_konfirmasi_anggota_asosiasi;
    },
    async getAspek(){
      this.loading = true;
      this.aspekKegiatan[0].keterampilan_komunikasi = this.previewInformasi.keterampilan_komunikasi;
      this.aspekKegiatan[1].listAspek = this.previewTableAspek;
      this.loading = false;
    },
    async getTemuan(){
      this.loading = true;
      this.listTemuanValidasi = this.previewTemuan;
      console.log(this.listTemuanValidasi);
      this.loading = false;
    },
    async getRencanaImplementasi(){
      this.loading = true;
      this.listRencanaImplementasi = this.previewRencanaImplementasi;
      console.log(this.listRencanaImplementasi);
      this.loading = false;
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
  },
};
</script>

<style lang="scss" scoped>
.ceklist-icon{
  color: #67C23A;
}
.form {
  padding-right: 50px;
  padding-left: 50px;
}
.edit-input {
  padding-right: 100px;
}
.cancel-btn {
  position: absolute;
  right: 15px;
  top: 10px;
}
.dialog-footer {
  text-align: left;
  padding-top: 0;
  margin-left: 150px;
}
.app-container {
  flex: 1;
  justify-content: space-between;
  font-size: 14px;
  padding-right: 8px;
  padding-bottom: 8px;
  .block {
    float: left;
    min-width: 250px;
  }
  .clear-left {
    clear: left;
  }
}
</style>
