<template>
  <el-container
    v-if="dataPreview.id_ak_03 == null"
    v-loading="loading"
    class="app-container"
  >
    <el-header>
      <el-page-header
        content="FORM FR.AK.03 BELUM DIISI"
        @back="$router.back()"
      />
      <el-dropdown
        split-button
        type="primary"
      >
        {{ $route.name }}
        <el-dropdown-menu slot="dropdown">
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-apl-01', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              APL 01
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-apl-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              APL 02
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-mapa-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              MAPA 02
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-ak-01', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              AK 01
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-ak-04', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              AK 04
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-ia-01', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              IA 01
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-ia-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              IA 02
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-ia-03', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              IA 03
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-ia-05', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              IA 05
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-ia-06', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              IA 06
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-ia-07', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              IA 07
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-ia-11', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              IA 11
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-ak-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              AK 02
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-ak-03', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              AK 03
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-ak-05', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              AK 05
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-ak-06', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              AK 06
            </router-link>
          </el-dropdown-item>
          <el-dropdown-item>
            <router-link :to="{ name: 'preview-va', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">
              VA
            </router-link>
          </el-dropdown-item>
        </el-dropdown-menu>
      </el-dropdown>
      <el-button-group>
        <router-link :to="{name: 'preview-ak-02', params: { iduji: $route.params.iduji, asesor: $route.params.asesor }}">
          <el-button
            type="primary"
            icon="el-icon-arrow-left"
          >
            Previous Page
          </el-button>
        </router-link>
        <router-link :to="{name: 'preview-ak-05', params: { iduji: $route.params.iduji, asesor: $route.params.asesor }}">
          <el-button
            type="primary"
            icon="el-icon-arrow-right"
          >
            Next Page
          </el-button>
        </router-link>
      </el-button-group>
    </el-header>
  </el-container>
  <el-container
    v-else
    class="app-container"
  >
    <el-header>
      <span>
        <el-page-header
          content="FR.AK.03 UMPAN BALIK DAN CATATAN ASESMEN"
          @back="$router.back()"
        />
      </span>
      <span>
        <el-dropdown
          split-button
          type="primary"
        >
          {{ $route.name }}
          <el-dropdown-menu slot="dropdown">
            <el-dropdown-item><router-link :to="{ name: 'preview-apl-01', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">APL 01</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-apl-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">APL 02</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-mapa-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">MAPA 02</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ak-01', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">AK 01</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ak-04', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">AK 04</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ia-01', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">IA 01</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ia-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">IA 02</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ia-03', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">IA 03</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ia-05', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">IA 05</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ia-06', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">IA 06</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ia-07', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">IA 07</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ia-11', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">IA 11</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ak-02', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">AK 02</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ak-03', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">AK 03</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ak-05', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">AK 05</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-ak-06', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">AK 06</router-link></el-dropdown-item>
            <el-dropdown-item><router-link :to="{ name: 'preview-va', params:{ iduji: $route.params.iduji, idskema: dataPreview.id_skema, asesor: $route.params.asesor, apl01: dataPreview.id_apl_01, apl02: dataPreview.id_apl_02, mapa02: dataPreview.id_mapa_02, ak01: dataPreview.id_ak_01, ak04: dataPreview.id_ak_04, ia01: dataPreview.id_ia_01, ia02: dataPreview.id_ia_02, ia03: dataPreview.id_ia_03, ia05: dataPreview.id_ia_05, id06: dataPreview.id_ia_06, ia07: dataPreview.id_ia_07, ia11: dataPreview.id_ia_11, ak02: dataPreview.id_ak_02, ak03: dataPreview.id_ak_03, ak05: dataPreview.id_ak_05, ak06: dataPreview.id_ak_06, ak07: dataPreview.id_ak_07, va: dataPreview.id_va }}">VA</router-link></el-dropdown-item>
          </el-dropdown-menu>
        </el-dropdown>
      </span>
      <span>
        <el-button-group>
          <router-link :to="{name: 'preview-ak-02', params: { iduji: $route.params.iduji, asesor: $route.params.asesor }}"><el-button
            type="primary"
            icon="el-icon-arrow-left"
          >Previous Page</el-button></router-link>
          <router-link :to="{name: 'preview-ak-05', params: { iduji: $route.params.iduji, asesor: $route.params.asesor }}"><el-button
            type="primary"
            icon="el-icon-arrow-right"
          >Next Page</el-button></router-link>
        </el-button-group>
      </span>
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
          <el-table-column
            align="left"
            min-width="30px"
          >
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
          :data="listSoal"
          border
          fit
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column
            align="left"
            min-width="80px"
            label="Komponen"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.komponen }}</span>
            </template>
          </el-table-column>
          <el-table-column
            align="center"
            min-width="30px"
            label="Hasil"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.hasil == 1 ? 'Tidak' : 'Ya' }}</span>
              <!-- <el-select v-model="scope.row.hasil" placeholder="Select">
                <el-option label="Ya" value="ya" />
                <el-option label="Tidak" value="tidak" />
              </el-select> -->
            </template>
          </el-table-column>
          <el-table-column
            align="center"
            min-width="30px"
            label="Catatan / Komentar asesi"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.catatan }}</span>
              <!-- <el-input v-model="scope.row.komentar" type="textarea" :rows="2" placeholder="Isi Komentar" /> -->
            </template>
          </el-table-column>
        </el-table>
        <br>
        <el-form
          ref="form"
          :model="dataSend"
          label-width="250px"
          label-position="left"
        >
          <el-form-item
            label="Catatan / Komentar lainnya (Apabila ada)"
            prop="rekomendasi_asesor"
          >
            <!-- <el-input v-model="dataSend.komentar" type="textarea" :rows="3" placeholder="Isi Komentar" /> -->
            <div>: {{ dataSend.komentar }}</div>
          </el-form-item>
        </el-form>
        <br>
        <br>
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
const ak03Resource = new Resource('uji-komp-ak-03');
const detailAk03 = new Resource('detail/ak-03');
const preview = new Resource('detail/preview');

export default {
  components: {},
  data() {
    return {
      dataSend: {},
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
          title: 'Skema Sertifikasi',
          content: '',
        },
        {
          title: 'Hari / Tanggal',
          content: '',
        },
      ],
      panduan: [
        'Lengkapi nama unit kompetensi, elemen, kriteria unjuk kerja sesuai kolom dalam tabel.',
        'Istilah Acuan Pembanding dengan SOP / spesifikasi produk dari industri / orginasi dari tempat kerja atau simulasi tempat kerja',
        'Beri tanda centang pada kolom K jika Anda yakin asesi dapat melakukan/mendemonstrasikan tugas seuai KUK, atau centang pada kolom BK bila sebaliknya.',
        'Penilaian lanjut diisi bila hasil belum dapat disimpulkan, untuk itu gunakan metode lain sehingga keputusan dapat dibuat',
      ],
      form: {
        name: '',
        region: '',
        date1: '',
        date2: '',
        delivery: false,
        type: [],
        resource: '',
        desc: '',
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
    this.getDataPreview().then((value) => {
      this.getListPertanyaan();
    });
    this.getListSkema().then((value) => {
      this.onJadwalSelect();
    });
    this.getListUji().then((value) => {
      this.getUjiKompDetail();
    });
    // this.getListPertanyaan();
    this.getDate();
  },
  methods: {
    async getDataPreview(){
      const data = await preview.get(this.$route.params.iduji);
      this.dataPreview = data;
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
      const { data } = await mstAk03Resource.list({ id_skema: this.dataPreview.id_skema });
      if (this.dataPreview.id_ak_03 !== null){
        const result = await detailAk03.get(this.dataPreview.id_ak_03);
        console.log(result);
        const tanggalObj = new Date(result.ak_03.created_at);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const tanggalFormatted = tanggalObj.toLocaleDateString('id-ID', options);

        const jamFormatted = tanggalObj.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

        const waktuUjian = `${tanggalFormatted} - Jam ${jamFormatted}`;
        this.headerTable[3].content = waktuUjian;

        this.listSoal = data;
        this.listSoal.forEach((element, index) => {
          element['index'] = index + 1;
          element['hasil'] = result.detail[index].hasil;
          element['catatan'] = result.detail[index].catatan;
        });
        this.dataSend.komentar = result.ak_03.komentar;
      }
      this.loading = false;
    },
    getDate() {
      var arrbulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      var arrHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
      var date = new Date();
      // var millisecond = date.getMilliseconds();
      // var detik = date.getSeconds();;
      var menit = date.getMinutes();
      var jam = date.getHours();
      var hari = date.getDay();
      var tanggal = date.getDate();
      var bulan = date.getMonth();
      var tahun = date.getFullYear();
      this.dataTrx.jam = jam;
      this.dataTrx.menit = menit;
      this.dataTrx.tanggal = tanggal;
      this.dataTrx.bulan = arrbulan[bulan];
      this.dataTrx.tahun = tahun;
      this.dataTrx.hari = arrHari[hari];
      if (menit < 10){
        this.headerTable[3].content = arrHari[hari] + ', ' + tanggal + '-' + arrbulan[bulan] + '-' + tahun + ' pukul ' + jam + ':0' + menit;
      } else {
        this.headerTable[3].content = arrHari[hari] + ', ' + tanggal + '-' + arrbulan[bulan] + '-' + tahun + ' pukul ' + jam + ':' + menit;
      }
      // document.write(tanggal+"-"+arrbulan[bulan]+"-"+tahun+"<br/>"+jam+" : "+menit+" : "+detik+"."+millisecond);
    },
    getUjiKompDetail() {
      var id_uji = this.dataPreview.id;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      var ujiDetail = this.listUji.find((x) => x.id === id_uji);
      this.selectedUji = ujiDetail;

      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      this.headerTable[0].content = ujiDetail.nama_peserta;
      this.headerTable[1].content = ujiDetail.asesor;
      this.headerTable[2].content = ujiDetail.skema_sertifikasi;
      this.dataTrx.nama_asesor = ujiDetail.asesor;
      this.dataTrx.nama_asesi = ujiDetail.nama_peserta;
    },
    async getListSkema() {
      const { data } = await skemaResource.list();
      this.listSkema = data;
    },
    async getListUji() {
      const { data } = await ujiKomResource.list();
      this.listUji = data;
    },
    async getListTuk() {
      const { data } = await tukResource.list();
      this.listTuk = data;
    },
    async getListJadwal() {
      const { data } = await jadwalResource.list();
      this.listJadwal = data;
    },
    onJadwalSelect() {
      var id_skema = this.dataPreview.id_skema;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);;
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
      // var elemen = unitKomp.elemen;
      // var kuk = elemen.kuk;
      this.listKuk = kuk;
    },
    onSubmit() {
      this.loading = true;
      this.dataTrx.id_uji_komp = this.$route.params.id_uji;
      this.dataTrx.komentar = this.dataSend.komentar;
      this.dataTrx.nama_asesi = this.headerTable[0].content;
      this.dataTrx.nama_asesor = this.headerTable[1].content;
      this.dataTrx.detail = this.listSoal;
      ak03Resource
        .store(this.dataTrx)
        .then(response => {
          this.$message({
            message: 'FR AK 03 has been created successfully.',
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
