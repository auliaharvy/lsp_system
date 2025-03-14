<template>
  <el-container
    v-if="dataPreview.id_ak_07 == null"
    v-loading="loading"
    class="app-container"
  >
    <el-header>
      <el-page-header
        content="FORM FR.AK 07 BELUM DIISI"
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
        <router-link :to="{name: 'preview-ak-06', params: { iduji: $route.params.iduji, asesor: $route.params.asesor }}">
          <el-button
            type="primary"
            icon="el-icon-arrow-left"
          >
            Previous Page
          </el-button>
        </router-link>
        <router-link :to="{name: 'preview-va', params: { iduji: $route.params.iduji, asesor: $route.params.asesor }}">
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
      <el-page-header
        content="FR.AK.07.CEKLIS PENYESUAIAN YANG WAJAR dan BERALASAN"
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
        <router-link :to="{name: 'preview-ak-06', params: { iduji: $route.params.iduji, asesor: $route.params.asesor }}">
          <el-button
            type="primary"
            icon="el-icon-arrow-left"
          >
            Previous Page
          </el-button>
        </router-link>
        <router-link :to="{name: 'preview-va', params: { iduji: $route.params.iduji, asesor: $route.params.asesor }}">
          <el-button
            type="primary"
            icon="el-icon-arrow-right"
          >
            Next Page
          </el-button>
        </router-link>
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
          <el-table-column
            align="left"
            label="PANDUAN BAGI ASESOR"
          >
            <ol>
              <li
                v-for="item in panduanAsesor"
                :key="item"
              >
                {{ item }}
              </li>
            </ol>
          </el-table-column>
        </el-table>
        <br>
        <br>
        <el-table
          v-loading="loading"
          :data="listPotensiAsesi"
          fit
          border
          highlight-current-row
          :span-method="objectSpanMethodPotensiAsesi"
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column align="center">
            <template slot-scope="scope">
              <span>Potensi Asesi</span>
            </template>
          </el-table-column>
          <el-table-column align="center">
            <template slot-scope="scope">
              <span v-if="scope.row.potensi == 1"><i class="el-icon-success ceklist-icon" /></span>
            </template>
          </el-table-column>
          <el-table-column align="left">
            <template slot-scope="scope">
              <span>{{ scope.row.komponen }}</span>
            </template>
          </el-table-column>
        </el-table>
        <br>
        <br>
        <el-table
          v-loading="loading"
          :data="listPersyaratan"
          fit
          border
          highlight-current-row
          :span-method="objectSpanMethodPersyaratan"
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column
            align="center"
            label="Mengidentifikasi Persyaratan Modifikasi dan Kotekstualisasi (karakteristik asesi)"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.parent_component }}</span>
            </template>
          </el-table-column>
          <el-table-column
            align="left"
            label="Keterangan"
          >
            <el-table-column align="center">
              <template slot-scope="scope">
                <span v-if="scope.row.keterangan == 1"><i class="el-icon-success ceklist-icon" /></span>
              </template>
            </el-table-column>
            <el-table-column align="left">
              <template slot-scope="scope">
                <span>{{ scope.row.child_component }}</span>
              </template>
            </el-table-column>
          </el-table-column>
        </el-table>
        <br>
        <br>
        <el-table
          v-loading="loading"
          :data="listAsesmen"
          fit
          border
          highlight-current-row
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
        >
          <el-table-column
            align="center"
            label="Hasil Penyesuaian yang wajar dan beralasan disepakati menggunakan :"
          >
            <el-table-column align="left">
              <template slot-scope="scope">
                <span>{{ scope.row.quest }}</span>
              </template>
            </el-table-column>
            <el-table-column align="left">
              <template slot-scope="scope">
                <span>{{ scope.row.answer }}</span>
              </template>
            </el-table-column>
          </el-table-column>
        </el-table>
        <br>
        <el-table
          v-loading="loading"
          :data="[listTtd[0]]"
          fit
          border
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center' }"
        >
          <el-table-column
            align="center"
            label="Nama Asesor"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.name }}</span>
            </template>
          </el-table-column>
          <el-table-column
            align="center"
            label="Tanda Tangan Asesor"
          >
            <template slot-scope="scope">
              <div v-if="scope.row.ttd">
                <el-image
                  style="width: 200px; height: 100px"
                  :src="scope.row.ttd"
                  fit="contain"
                />
              </div>
              <div v-else>
                <span>FR.AK 07 belum di tanda tangan</span>
              </div>
            </template>
          </el-table-column>
        </el-table>
        <br>
        <el-table
          v-loading="loading"
          :data="[listTtd[1]]"
          fit
          border
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center' }"
        >
          <el-table-column
            align="center"
            label="Nama Asesi"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.name }}</span>
            </template>
          </el-table-column>
          <el-table-column
            align="center"
            label="Tanda Tangan Asesi"
          >
            <template slot-scope="scope">
              <div v-if="scope.row.ttd">
                <el-image
                  style="width: 200px; height: 100px"
                  :src="scope.row.ttd"
                  fit="contain"
                />
              </div>
              <div v-else>
                <span>FR.AK 07 belum di tanda tangan</span>
              </div>
            </template>
          </el-table-column>
        </el-table>
        <br>
        <br>
      </div>
    </el-main>
  </el-container>
</template>

<script>
import { mapGetters } from 'vuex';
import vueSignature from 'vue-signature/src/components/vueSignature.vue';
import Resource from '@/api/resource';
const previewResource = new Resource('detail/indexPreview');
const potensiAsesiResource = new Resource('preview-ak-07-potensi-asesi');
const persyaratanResource = new Resource('preview-ak-07-persyaratan');
const ak07Resource = new Resource('ak-07');

export default {
  components: {
    vueSignature,
  },
  data() {
    return {
      listPotensiAsesi: [],
      listPersyaratan: [],
      listAsesmen: [
        {quest: 'Acuan Pembanding Asesmen: (tuliskan nama acuan pembanding)', answer: ''},
        {quest: 'Metode Asesmen: (tuliskan nama acuan pembanding)', answer: ''},
        {quest: 'Instrumen Asesmen: (tuliskan nama formulir instrumen asesmen)', answer: ''}
      ],
      listTtd: [
        {name: '', ttd: ''},
        {name: '', ttd: ''}
      ],
      panduanAsesor: [
        "Formulir ini digunakan pada saat pelaksanaan pra asesmen, jika ada asesi yang mempunyai keterbatasan sesuai karakteristik yang dimilikinya sehingga diperlukan penyesuaian yang wajar dan beralasan dan atau ada penyesuaian rencana asesmen, jika tidak sesuai dengan acuan pembanding, potensi asesi dan konteks asesi.",
        "Coretlah pada tanda * yang tidak sesuai.",
        "Berilah tanda √ pada kotak [] pada kolom potensi asesi.",
        "Berilah tanda √ Ya atau Tidak pada tanda * sesuai pilihan, jika jawaban Ya selanjutnya pada kolom keterangan berilah tanda √ di kotak [] yang tersedia, pilihan boleh lebih dari satu."
      ],
      headerTable: [
        { title: 'Skema Sertifikasi', content: '' },
        { title: 'TUK', content: '' },
        { title: 'Nama Asesor', content: '' },
        { title: 'Nama Asesi', content: '' },
        { title: 'Tanggal', content: '' },
      ],
      isWide: true,
      labelPosition: 'left',
      id_uji_komp: null,
      dataPreview: null,
    };
  },
  computed: {
    ...mapGetters(['userId']),
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.onResize);
    localStorage.removeItem('id_uji_komp')
  },
  mounted() {
    window.addEventListener('resize', this.onResize);
    this.onResize();
  },
  created() {
    this.id_uji_komp = localStorage.getItem('id_uji_komp') || this.$route.params.iduji
    localStorage.setItem('id_uji_komp', this.id_uji_komp)
    this.getUjiKompDetail();
    this.getPotensiAsesi();
    this.getPersyaratan();
    this.getAk07();
  },
  methods: {
    async getUjiKompDetail() {
      this.dataPreview = await previewResource.get(this.id_uji_komp);
      this.dataPreview = this.dataPreview.data[0]
      console.log(this.dataPreview)
      this.headerTable[0].content = this.dataPreview.skema_sertifikasi;
      this.headerTable[1].content = this.dataPreview.nama_tuk;
      this.headerTable[2].content = this.dataPreview.asesor;
      this.headerTable[3].content = this.dataPreview.nama_peserta;
      this.headerTable[4].content = this.dataPreview.mulai;
      this.listTtd[0].name = this.dataPreview.asesor;
      this.listTtd[1].name = this.dataPreview.nama_peserta;
    },
    async getPotensiAsesi() {
      let data = await potensiAsesiResource.get(this.id_uji_komp);
      this.listPotensiAsesi = data.data
    },
    async getPersyaratan() {
      let data = await persyaratanResource.get(this.id_uji_komp);
      this.listPersyaratan = data.data
    },
    async getAk07() {
      let data = await ak07Resource.get(this.id_uji_komp);
      this.listAsesmen[0].answer = data.data[0].acuan_pembanding
      this.listAsesmen[1].answer = data.data[0].metode_asesmen
      this.listAsesmen[2].answer = data.data[0].instrumen_asesmen
      this.listTtd[0].ttd = '/uploads/users/signature/' + data.data[0].ttd_asesor;
      this.listTtd[1].ttd = '/uploads/users/signature/' + data.data[0].ttd_asesi;
    },
    clear() {
      this.$refs.signature.clear();
    },
    saveSign() {
      var _this = this;
      this.testPng = _this.$refs.signature.save();
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
    objectSpanMethodPotensiAsesi({ row, column, rowIndex, columnIndex }) {
      if (columnIndex === 0) {
        if (rowIndex % this.listPotensiAsesi.length === 0) {
          return { rowspan: this.listPotensiAsesi.length, colspan: 1 };
        } else {
          return { rowspan: 0, colspan: 0 };
        }
      }
      return { rowspan: 1, colspan: 1 };
    },
    objectSpanMethodPersyaratan({ row, column, rowIndex, columnIndex }) {
      if (columnIndex === 0) {
        if (rowIndex % this.listPersyaratan.length === 0) {
          return { rowspan: this.listPersyaratan.length, colspan: 1 };
        } else {
          return { rowspan: 0, colspan: 0 };
        }
      }
      return { rowspan: 1, colspan: 1 };
    }
  },
};
</script>

<style lang="scss" scoped>
.ceklist-icon{
  color: #67C23A;
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
