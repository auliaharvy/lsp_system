<template>
  <el-container v-if="dataPreview.id_ak_04 == null" class="app-container">
    <el-header>
      <el-page-header content="FORM FR.AK.04 BELUM DIISI" @back="$router.back()" />
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
        <router-link :to="{name: 'preview-ak-01', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ak01: dataPreview.id_ak_01 }}"><el-button type="primary" icon="el-icon-arrow-left">Previous Page</el-button></router-link>
        <router-link :to="{name: 'preview-ia-01', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ia01: dataPreview.id_ia_01 }}"><el-button type="primary" icon="el-icon-arrow-right">Next Page</el-button></router-link>
      </el-button-group>
    </el-header>
  </el-container>
  <el-container v-else class="app-container">
    <el-header>
      <span>
        <el-page-header content="FR.AK.04 BANDING ASESMEN" @back="$router.back()" />
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
          <router-link :to="{name: 'preview-ak-01', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ak01: dataPreview.id_ak_01 }}"><el-button type="primary" icon="el-icon-arrow-left">Previous Page</el-button></router-link>
          <router-link :to="{name: 'preview-ia-01', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ia01: dataPreview.id_ia_01 }}"><el-button type="primary" icon="el-icon-arrow-right">Next Page</el-button></router-link>
        </el-button-group>
      </span>
    </el-header>
    <el-main>
      <div>
        <br>
        <el-form
          ref="form"
          :model="dataSend"
          label-width="250px"
          label-position="left"
        >
          <el-form-item label="Nama Asesi" prop="namaAsesi">
            <div>{{ dataSend.nama_asesi }}</div>
          </el-form-item>

          <el-form-item label="Nama Asesor" prop="namaAsesor">
            <div>{{ dataSend.nama_asesor }}</div>
          </el-form-item>

          <el-form-item label="Apakah proses banding telah dijelaskan kepada anda?" prop="proses">
            <div>{{ dataSend.penjelasan ? 'Tidak' : 'Ya' }}</div>
          </el-form-item>

          <el-form-item label="Apakah anda telah mendiskusikan banding dengan asesor?" prop="diskusi">
            <div>{{ dataSend.diskusi ? 'Tidak' : 'Ya' }}</div>
          </el-form-item>

          <el-form-item label="Apakah anda mau melibatkan 'Orang Lain' membantu anda dalam proses banding?" prop="bantuBanding">
            <div>{{ dataSend.melibatkan ? 'Tidak' : 'Ya' }}</div>
          </el-form-item>

          <el-form-item label="Skema Sertifikasi" prop="skema">
            <div>{{ dataSend.skema }}</div>
          </el-form-item>

          <el-form-item label="No Skema" prop="noSkema">
            <div>{{ dataSend.no_skema }}</div>
          </el-form-item>

          <el-form-item label="Alasan banding" prop="alasanBanding">
            <div>{{ dataSend.alasan_banding }}</div>
          </el-form-item>
        </el-form>
        <br>
      </div>
    </el-main>
  </el-container>
</template>

<script>
import Resource from '@/api/resource';
const jadwalResource = new Resource('jadwal-get');
const skemaResource = new Resource('skema-get');
const tukResource = new Resource('tuk-get');
const ujiKomResource = new Resource('uji-komp-get');
const mstAk03Resource = new Resource('mst-ak-03-get');
const ak04Resource = new Resource('uji-komp-ak-04');
const previewResource = new Resource('detail/preview');
const previewAk04 = new Resource('preview/ak-04');

export default {
  data() {
    return {
      umpanBalikAsesi: '',
      checkList: [],
      kompeten: null,
      loading: false,
      listSoal: null,
      listSkema: null,
      listTuk: null,
      listJadwal: null,
      listKodeUnit: [],
      listJudulUnit: [],
      listKuk: [],
      listUji: [],
      selectedSkema: {},
      selectedUji: {},
      dataTrx: {},
      unitKompetensiTable: [
        {
          col1: 'Unit Kompetensi',
          col2: 'Kode Unit',
          col3: [],
        },
        {
          col1: 'Unit Kompetensi',
          col2: 'Judul Unit',
          col3: [],
        },
      ],
      dataSend: {
        nama_asesi: '',
        nama_asesor: '',
        tanggal_asesmen: '',
        proses_banding: '',
        diskusi_banding: '',
        membantu_banding: '',
        skema: '',
        no_skema: '',
        alasan_banding: '',
      },
      active: 0,
      isWide: true,
      labelPosition: 'left',
      dataPreview: '',
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
    this.getDataPreview();
    this.getListSkema().then((value) => {
      this.onJadwalSelect();
    });
    this.getAk04();
    this.getListPertanyaan();
  },
  methods: {
    async getDataPreview(){
      this.dataPreview = await previewResource.get(this.$route.params.iduji);
    },
    allKompeten() {
      for (var i = 0; i < this.listKuk.length; i++) {
        var kuk = this.kukList[i];
        if (kuk.type === 'kuk'){
          // kuk.is_kompeten = this.kompeten;
        }
      }
    },
    async getListPertanyaan() {
      this.loading = true;
      const { data } = await mstAk03Resource.list({ id_skema: this.idskema });
      this.listSoal = data[0];
      this.listSoal.forEach((element, index) => {
        element['index'] = index + 1;
      });
      this.loading = false;
    },
    async getListSkema() {
      const { data } = await skemaResource.list();
      this.listSkema = data[0];
    },
    async getListUji() {
      const { data } = await ujiKomResource.list();
      this.listUji = data[0];
    },
    async getListTuk() {
      const { data } = await tukResource.list();
      this.listTuk = data[0];
    },
    async getListJadwal() {
      const { data } = await jadwalResource.list();
      this.listJadwal = data[0];
    },
    async getAk04() {
      this.dataPreview = await previewResource.get(this.$route.params.iduji);
      const data = await previewAk04.get(this.dataPreview.id_ak_04);
      this.dataSend.skema = data[0].skema;
      this.dataSend.nama_asesor = this.$route.params.asesor;
      this.dataSend.nama_asesi = data[0].nama_asesi;
      this.dataSend.no_skema = data[0].no_skema;
      this.dataSend.tanggal_asesmen = data[0].tanggal_asesmen;
      this.dataSend.penjelasan = data[0].penjelasan;
      this.dataSend.diskusi = data[0].diskusi;
      this.dataSend.melibatkan = data[0].melibatkan;
      this.dataSend.alasan_banding = data[0].alasan_banding;
    },
    async onJadwalSelect() {
      this.dataPreview = await previewResource.get(this.$route.params.iduji);
      var id_skema = this.dataPreview.id_skema;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      var skemaId = this.listSkema.find((x) => x.id === id_skema);
      this.selectedSkema = skemaId;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.dataTrx.id_skema = skemaId.id;
      // this.dataTrx.id_tuk = tukId.id;
      this.getKuk();
    },
    getKuk(){
      var number = 1;
      var unitKomp = this.selectedSkema.children;
      console.log(unitKomp);
      var kuk = [];
      unitKomp.forEach((element, index) => {
        element['type'] = 'unitKomp';
        element['index'] = number++;
        kuk.push(element);
        this.unitKompetensiTable[0].col3.push(element['kode_unit']);
        this.unitKompetensiTable[1].col3.push(element['unit_kompetensi']);
        // this.headerTable[3].content.push(element['unit_kompetensi']);
        this.listJudulUnit.push(element);
        element.elemen.forEach((element, index) => {
          element['type'] = 'elemen';
          kuk.push(element);
          element.kuk.forEach((element, index) => {
            element['type'] = 'kuk';
            element['bukti_pendukung'] = 'raport';
            kuk.push(element);
          });
        });
      });
      console.log(this.listKodeUnit);
      // var elemen = unitKomp.elemen;
      // var kuk = elemen.kuk;
      this.listKuk = kuk;
    },
    onSubmit() {
      this.loading = true;
      this.dataSend.id_uji_komp = this.$route.params.iduji;
      console.log(this.dataSend);
      ak04Resource
        .store(this.dataSend)
        .then(response => {
          this.$message({
            message: 'FR AK 04 has been created successfully.',
            type: 'success',
            duration: 5 * 1000,
          });
          this.$router.push({ name: 'uji-komp-list' });
        })
        .catch(error => {
          console.log(error);
          this.loading = false;
        })
        .finally(() => {
          this.loading = false;
        });
    },
    back() {
      if (this.active-- < 0) {
        this.active = 2;
      }
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
    handleFotoSuccess(res, file) {
      this.dataTrx.foto = URL.createObjectURL(file.raw);
    },
    handleIdentitasSuccess(res, file) {
      this.dataTrx.identitas = URL.createObjectURL(file.raw);
    },
    handleRaportSuccess(res, file) {
      this.dataTrx.raport = URL.createObjectURL(file.raw);
    },
    handleSertifikatSuccess(res, file) {
      this.dataTrx.sertifikat = URL.createObjectURL(file.raw);
    },
    beforeAvatarUpload(file) {
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!isLt2M) {
        this.$message.error('Document size can not exceed 2MB!');
      }
      return isLt2M;
    },
    objectSpanMethod({ row, column, rowIndex, columnIndex }) {
      if (columnIndex === 0) {
        if (rowIndex % 2 === 0) {
          return {
            rowspan: 2,
            colspan: 1,
          };
        } else {
          return {
            rowspan: 0,
            colspan: 0,
          };
        }
      }
    },
  },
};
</script>

<style lang="scss" scoped>
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
