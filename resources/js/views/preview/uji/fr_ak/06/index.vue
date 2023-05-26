<template>
  <el-container v-if="dataPreview.id_ak_06 == null" v-loading="loading" class="app-container">
    <el-header>
      <el-page-header content="FORM FR.AK 06 BELUM DIISI" @back="$router.back()" />
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
        <router-link :to="{name: 'preview-ak-05', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ia05: dataPreview.id_ia_05 }}"><el-button type="primary" icon="el-icon-arrow-left">Previous Page</el-button></router-link>
        <router-link :to="{name: 'preview-va', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, va: dataPreview.id_va }}"><el-button type="primary" icon="el-icon-arrow-right">Next Page</el-button></router-link>
      </el-button-group>
    </el-header>
  </el-container>
  <el-container v-else class="app-container">
    <el-header>
      <el-page-header content="FR.AK.06 MENINJAU LAPORAN ASESMEN" @back="$router.back()" />
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
        <router-link :to="{name: 'preview-ak-05', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ia05: dataPreview.id_ia_05 }}"><el-button type="primary" icon="el-icon-arrow-left">Previous Page</el-button></router-link>
        <router-link :to="{name: 'preview-va', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, va: dataPreview.id_va }}"><el-button type="primary" icon="el-icon-arrow-right">Next Page</el-button></router-link>
      </el-button-group>
    </el-header>
    <el-main>
      <div>
        <el-table
          v-loading="loading"
          :data="headerTable"
          fit
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="left" min-width="30px">
            <template slot-scope="scope">
              <span>{{ scope.row.title }}</span>

            </template>
          </el-table-column>
          <el-table-column align="left">
            <template slot-scope="scope">
              <span>{{ scope.row.content }}</span>
            </template>
          </el-table-column>
        </el-table>
        <br>

        <el-table
          v-loading="loading"
          :data="['-']"
          fit
          border
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'left', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="left" label="Penjelasan">
            <ol>
              <li v-for="item in penjelasan" :key="item">
                {{ item }}
              </li>
            </ol>
          </el-table-column>
        </el-table>

        <br>

        <el-table
          v-loading="loading"
          :data="aspek"
          fit
          border
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="left" label="Aspek Yang Ditinjau">
            <template slot-scope="scope">
              <span>{{ scope.row.item }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Kesesuaian dengan prinsip asesmen">
            <el-table-column align="center" label="Validitas">
              <template slot-scope="scope">
                <span v-if="scope.row.item !== 'Prosedur asesmen :' && scope.row.validitas === 1"><i class="el-icon-success ceklist-icon" /></span>
              </template>
            </el-table-column>
            <el-table-column align="center" label="Reliabel">
              <template slot-scope="scope">
                <span v-if="scope.row.item !== 'Prosedur asesmen :' && scope.row.reliable === 1"><i class="el-icon-success ceklist-icon" /></span>
              </template>
            </el-table-column>
            <el-table-column align="center" label="Fleksibel">
              <template slot-scope="scope">
                <span v-if="scope.row.item !== 'Prosedur asesmen :' && scope.row.fleksibel === 1"><i class="el-icon-success ceklist-icon" /></span>
              </template>
            </el-table-column>
            <el-table-column align="center" label="Adil">
              <template slot-scope="scope">
                <span v-if="scope.row.item !== 'Prosedur asesmen :' && scope.row.adil === 1"><i class="el-icon-success ceklist-icon" /></span>
              </template>
            </el-table-column>
          </el-table-column>
        </el-table>
        <el-table
          v-loading="loading"
          :data="rekomendasi"
          fit
          border
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center'}"
        >
          <el-table-column align="left" width="150px">
            <template slot-scope="scope">
              <span>{{ scope.row.item }}</span>
            </template>
          </el-table-column>
          <el-table-column align="left">
            <template slot-scope="scope">
              <span>{{ scope.row.rekomendasi }}</span>
            </template>
          </el-table-column>
        </el-table>
        <br>

        <el-table
          v-loading="loading"
          :data="aspekPemenuhan"
          fit
          border
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="left" label="Aspek Yang Ditinjau">
            <template slot-scope="scope">
              <span>{{ scope.row.item }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Pemenuhan Dimensi Kompetensi">
            <el-table-column align="center" label="Task Skills">
              <template slot-scope="scope">
                <span>{{ scope.row.taskSkill }}</span>
              </template>
            </el-table-column>
            <el-table-column align="center" label="Task Management Skills">
              <template slot-scope="scope">
                <span>{{ scope.row.taskManagement }}</span>
              </template>
            </el-table-column>
            <el-table-column align="center" label="Contingency Management Skills">
              <template slot-scope="scope">
                <span>{{ scope.row.contigency }}</span>
              </template>
            </el-table-column>
            <el-table-column align="center" label="Job Role / Environment Skills">
              <template slot-scope="scope">
                <span>{{ scope.row.jobRole }}</span>
              </template>
            </el-table-column>
            <el-table-column align="center" label="Transfer Skills">
              <template slot-scope="scope">
                <span>{{ scope.row.transferSkill }}</span>
              </template>
            </el-table-column>
          </el-table-column>
        </el-table>
        <el-table
          v-loading="loading"
          :data="rekomendasiPemenuhan"
          fit
          border
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center'}"
        >
          <el-table-column align="left" width="150px">
            <template slot-scope="scope">
              <span>{{ scope.row.item }}</span>
            </template>
          </el-table-column>
          <el-table-column align="left">
            <template slot-scope="scope">
              <span>{{ scope.row.rekomendasi }}</span>
            </template>
          </el-table-column>
        </el-table>

        <br>

        <el-table
          v-if="ttdTable"
          v-loading="loading"
          :data="ttdTable"
          fit
          border
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center' }"
        >
          <el-table-column align="center" label="Nama Asesor">
            <template slot-scope="scope">
              <span>{{ scope.row.nama }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Tanggal">
            <template slot-scope="scope">
              <span>{{ scope.row.tanggal }}</span>
            </template>
          </el-table-column>
          <el-table-column align="center" label="Tanda Tangan Asesor">
            <template slot-scope="scope">
              <el-image
                style="width: 200px; height: 100px"
                :src="scope.row.ttd"
                fit="contain"
              />
            </template>
          </el-table-column>
          <el-table-column align="center" label="Komentar">
            <template slot-scope="scope">
              <span>{{ scope.row.komentar }}</span>
            </template>
          </el-table-column>
        </el-table>
        <br>
      </div>
    </el-main>
  </el-container>
</template>

<script>
import Resource from '@/api/resource';
const indexPreview = new Resource('detail/indexPreview');
const ak06Detail = new Resource('detail/ak-06');

export default {
  components: {},
  data() {
    return {
      loading: false,
      headerTable: [
        {
          title: 'Nama Asesi',
          content: '',
        },
        {
          title: 'Nama Asesor',
          content: '',
        },
        {
          title: 'TUK',
          content: '',
        },
        {
          title: 'Skema Sertifikasi',
          content: '',
        },
        {
          title: 'Tanggal',
          content: '',
        },
      ],
      penjelasan: [
        'Peninjauan seharusnya dilakukan oleh asesor yang mensupervisi implementasi asesmen.',
        'Jika tinjauan di lakukan oleh asesor lain, tinjauan akan di lakukan setelah seluruh proses implementasi asesmen telah selesai',
        'Peninjauan dapat dilakukan secara terpadu dalam skema sertifikasi dan / atau peserta kelompok yang homogen.',
      ],
      aspek: [
        {
          item: 'Prosedur asesmen :',
          validitas: ' ',
          reliabel: ' ',
          fleksibel: ' ',
          adil: ' ',
        },
        {
          item: '- Rencana Asesmen',
          validitas: 0,
          reliabel: 0,
          fleksibel: 0,
          adil: 0,
        },
        {
          item: '- Persiapan Asesmen',
          validitas: 0,
          reliabel: 0,
          fleksibel: 0,
          adil: 0,
        },
        {
          item: '- Implementasi Asesmen',
          validitas: 0,
          reliabel: 0,
          fleksibel: 0,
          adil: 0,
        },
        {
          item: '- Keputusan Asesmen',
          validitas: 0,
          reliabel: 0,
          fleksibel: 0,
          adil: 0,
        },
        {
          item: '- Umpan Balik Asesmen',
          validitas: 0,
          reliabel: 0,
          fleksibel: 0,
          adil: 0,
        },
      ],
      aspekPemenuhan: [
        {
          item: 'Konsistensi keputusan asesmen Bukti dari berbagai asesmen diperiksa untuk konsistensi dimensi kompetensi',
          taskSkill: '',
          taskManagement: '',
          contigency: '',
          jobRole: '',
          transferSkill: '',
        },
      ],
      rekomendasi: [
        {
          item: 'Rekomendasi untuk peningkatan :',
          rekomendasi: '',
        },
      ],
      rekomendasiPemenuhan: [
        {
          item: 'Rekomendasi untuk peningkatan :',
          rekomendasi: '',
        },
      ],
      form: {
        namaAsesi: '',
        rekomendasi: '',
        keterangan: '',
        aspek: '',
        catatanPenolakan: '',
        saranPerbaikan: '',
      },
      ttdTable: [
        {
          no: 1,
          nama: 'Nama Asesor',
          tanggal: '12-2-2002',
          ttd: '',
          komentar: '',
        },
      ],
      active: 0,
      isWide: true,
      labelPosition: 'left',
      dataPreview: '',
      ak06Preview: '',
    };
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
      this.getHeaderTable();
      this.getAspekPemenuhan();
      this.getTtdTable();
      this.getAspekProsedur();
    });
  },
  methods: {
    async getDataUjiPreview(){
      this.loading = true;
      const data = await indexPreview.get(this.$route.params.iduji);
      this.dataPreview = data.data[0];
      if (this.dataPreview.id_ak_06 !== null){
        const dataAk06 = await ak06Detail.get(this.dataPreview.id_ak_06);
        this.ak06Preview = dataAk06;
      }
      this.loading = false;
    },
    async getHeaderTable(){
      this.loading = true;
      this.headerTable[0].content = this.dataPreview.nama_peserta;
      this.headerTable[1].content = this.dataPreview.asesor;
      this.headerTable[2].content = this.dataPreview.nama_tuk;
      this.headerTable[3].content = this.dataPreview.skema_sertifikasi;
      this.headerTable[4].content = this.dataPreview.mulai;
      this.loading = false;
    },
    async getAspekPemenuhan(){
      this.loading = true;
      this.aspekPemenuhan[0].taskSkill = this.ak06Preview.task_skill;
      this.aspekPemenuhan[0].taskManagement = this.ak06Preview.task_management_skill;
      this.aspekPemenuhan[0].contigency = this.ak06Preview.contigency_management_skill;
      this.aspekPemenuhan[0].jobRole = this.ak06Preview.job_role;
      this.aspekPemenuhan[0].transferSkill = this.ak06Preview.transfer_skill;
      this.rekomendasiPemenuhan[0].rekomendasi = this.ak06Preview.rekomendasi_konsistensi;
      this.loading = false;
    },
    async getTtdTable(){
      this.loading = true;
      this.ttdTable[0].nama = this.dataPreview.asesor;
      this.ttdTable[0].tanggal = this.dataPreview.mulai;
      this.ttdTable[0].ttd = this.ak06Preview.ttd_asesor;
      this.ttdTable[0].komentar = this.ak06Preview.komentar;
      this.loading = false;
    },
    async getAspekProsedur(){
      this.loading = true;
      this.aspek[1].validitas = this.ak06Preview.rencana_asesmen_validitas;
      this.aspek[1].reliable = this.ak06Preview.rencana_asesmen_reliable;
      this.aspek[1].fleksibel = this.ak06Preview.rencana_asesmen_fleksibel;
      this.aspek[1].adil = this.ak06Preview.rencana_asesmen_adil;
      this.aspek[2].validitas = this.ak06Preview.persiapan_asesmen_validitas;
      this.aspek[2].reliable = this.ak06Preview.persiapan_asesmen_reliable;
      this.aspek[2].fleksibel = this.ak06Preview.persiapan_asesmen_fleksibel;
      this.aspek[2].adil = this.ak06Preview.persiapan_asesmen_adil;
      this.aspek[3].validitas = this.ak06Preview.implementasi_asesmen_validitas;
      this.aspek[3].reliable = this.ak06Preview.implementasi_asesmen_reliable;
      this.aspek[3].fleksibel = this.ak06Preview.implementasi_asesmen_fleksibel;
      this.aspek[3].adil = this.ak06Preview.implementasi_asesmen_adil;
      this.aspek[4].validitas = this.ak06Preview.keputusan_asesmen_validitas;
      this.aspek[4].reliable = this.ak06Preview.keputusan_asesmen_reliable;
      this.aspek[4].fleksibel = this.ak06Preview.keputusan_asesmen_fleksibel;
      this.aspek[4].adil = this.ak06Preview.keputusan_asesmen_adil;
      this.aspek[5].validitas = this.ak06Preview.umpan_balik_asesmen_validitas;
      this.aspek[5].reliable = this.ak06Preview.umpan_balik_asesmen_reliable;
      this.aspek[5].fleksibel = this.ak06Preview.umpan_balik_asesmen_fleksibel;
      this.aspek[5].adil = this.ak06Preview.umpan_balik_asesmen_adil;
      this.rekomendasi[0].rekomendasi = this.ak06Preview.rekomendasi_prosedur;

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
