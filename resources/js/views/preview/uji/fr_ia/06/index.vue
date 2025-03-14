<template>
  <el-container
    v-if="dataPreview.id_ia_06 == null"
    v-loading="loading"
    class="app-container"
  >
    <el-header>
      <el-page-header
        content="FORM FR.IA.06 BELUM DIISI"
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
        <router-link :to="{name: 'preview-ia-05', params: { iduji: $route.params.iduji, asesor: $route.params.asesor }}">
          <el-button
            type="primary"
            icon="el-icon-arrow-left"
          >
            Previous
          </el-button>
        </router-link>
        <router-link :to="{name: 'preview-ia-07', params: { iduji: $route.params.iduji, asesor: $route.params.asesor }}">
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
          content="FR.IA.06 PERTANYAAN TERTULIS ESAI"
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
          <router-link :to="{name: 'preview-ia-05', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ia05: dataPreview.id_ia_05 }}"><el-button
            type="primary"
            icon="el-icon-arrow-left"
          >Previous</el-button></router-link>
          <router-link :to="{name: 'preview-ia-07', params: { iduji: $route.params.iduji, idskema: $route.params.idskema, asesor: $route.params.asesor, ia07: dataPreview.id_ia_07}}"><el-button
            type="primary"
            icon="el-icon-arrow-right"
          >Next Page</el-button></router-link>
        </el-button-group>
      </span>
    </el-header>
    <el-main>
      <div>
        <el-table
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
            align="center"
            min-width="20px"
            label="No"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.index }}</span>
            </template>
          </el-table-column>
          <el-table-column
            align="left"
            min-width="150px"
            label="Unit Kompetensi"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.kode_unit }}</span>
              <br>
              <span>{{ scope.row.unit_kompetensi }}</span>
            </template>
          </el-table-column>
          <el-table-column
            align="left"
            min-width="150px"
            label="Pertanyaan"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.pertanyaan }}</span>
            </template>
          </el-table-column>
          <el-table-column
            align="center"
            min-width="100px"
            label="Jawaban"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.jawaban }}</span>
            </template>
          </el-table-column>
          <el-table-column
            v-if="checkRole(['assesor'])"
            align="center"
            min-width="80px"
            label="Kunci Jawaban"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.kunci_jawaban }}</span>
            </template>
          </el-table-column>
          <el-table-column
            v-if="checkRole(['assesor', 'admin'])"
            align="center"
            min-width="80px"
            label="Rekomendasi"
          >
            <template slot-scope="scope">
              <div v-if="scope.row.is_kompeten === 'kompeten'">
                Kompeten
              </div>
              <div v-else-if="scope.row.is_kompeten === 'belum kompeten'">
                Belum Kompeten
              </div>
              <div v-else>
                Belum Penilaian
              </div>
              <!-- <div v-if="scope.row.is_kompeten === 'belum penilaian'">Belum Penilaian</div> -->
              <!-- <el-select v-model="scope.row.is_kompeten" class="filter-item" placeholder="B/BK">
                <el-option key="kompeten" label="Kompeten" value="kompeten" />
                <el-option key="belum kompeten" label="Belum Kompeten" value="belum kompeten" />
                <el-option key="belum penilaian" label="Belum Penilaian" value="belum penilaian" />
              </el-select> -->
            </template>
          </el-table-column>
        </el-table>
        <br>
        <br>
        <el-table
          v-if="ttdTable1"
          v-loading="loading"
          :data="ttdTable1"
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
              <span>{{ scope.row.nama }}</span>
            </template>
          </el-table-column>
          <el-table-column
            align="center"
            label="Umpan balik untuk asesi"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.umpan_balik ? scope.row.umpan_balik : 'Belum Penilaian' }}</span>
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
                <h3>FR.IA 06 belum di tanda tangan</h3>
              </div>
            </template>
          </el-table-column>
        </el-table>
        <br>
        <el-table
          v-if="ttdTable2"
          v-loading="loading"
          :data="ttdTable2"
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
              <span>{{ scope.row.nama }}</span>
            </template>
          </el-table-column>
          <el-table-column
            align="center"
            label="Rekomendasi Asesor"
          >
            <template slot-scope="scope">
              <span v-if="scope.row.rekomendasi_asesor === 'Kompeten'">Kompeten</span>
              <span v-else-if="scope.row.rekomendasi_asesor === 'Belum Kompeten'">Belum Kompeten</span>
              <span v-else>Belum Penilaian</span>
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
                <h3>FR.IA 06 belum di tanda tangan</h3>
              </div>
            </template>
          </el-table-column>
        </el-table>
        <el-table
          v-if="ttdTable"
          v-loading="loading"
          :data="ttdTable"
          fit
          border
          style="width: 100%"
          :header-cell-style="{ 'text-align': 'center' }"
        >
          <el-table-column
            align="center"
            label="Nama"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.nama }}</span>
            </template>
          </el-table-column>
          <el-table-column
            align="center"
            label="Jabatan"
          >
            <template slot-scope="scope">
              <span>{{ scope.row.jabatan }}</span>
            </template>
          </el-table-column>
          <el-table-column
            align="center"
            label="Tanda Tangan"
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
                <h3>Belum di tanda tangani</h3>
              </div>
            </template>
          </el-table-column>
        </el-table>
      </div>
    </el-main>
  </el-container>
</template>

<script>
import { mapGetters } from 'vuex';
import Resource from '@/api/resource';
import role from '@/directive/role';
import checkRole from '@/utils/role';
const jadwalResource = new Resource('jadwal-get');
const skemaResource = new Resource('skema-get');
const tukResource = new Resource('tuk-get');
const ujiKomResource = new Resource('uji-komp-get');
const mstResource = new Resource('mst-ia06-get');
const postResource = new Resource('uji-komp-ia-06');
const ia06Detail = new Resource('detail/ia-06');
const ia06NilaiResource = new Resource('uji-komp-ia-06-nilai');
const preview = new Resource('detail/preview');
const signature = new Resource('detail/signature');
const apl02Resource = new Resource('detail/apl-02');

export default {
  components: {},
  directives: { role },
  data() {
    return {
      umpanBalikAsesi: '',
      kompeten: null,
      loading: false,
      listSoal: [
        {
          jawaban: '',
          is_kompeten: '',
        },
      ],
      listSkema: null,
      listTuk: null,
      listJadwal: null,
      listKodeUnit: [],
      listJudulUnit: [],
      listKuk: [],
      listUji: [],
      ia06: null,
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
          title: 'Skema Sertifikasi',
          content: '-',
        },
        {
          title: 'TUK',
          content: '-',
        },
        {
          title: 'Nama Asesor',
          content: '-',
        },
        {
          title: 'Nama Asesi',
          content: '-',
        },
        {
          title: 'Tanggal',
          content: '-',
        },
      ],
      ttdTable: [
        {
          nama: '',
          jabatan: 'Penyusun',
          ttd: '',
        },
        {
          nama: '',
          jabatan: 'Validator',
          ttd: '',
        },
      ],
      ttdTable1: [
        {
          nama: 'Nama Asesi',
          umpan_balik: '',
          ttd: '',
        },
      ],
      ttdTable2: [
        {
          nama: 'Nama Asesor',
          rekomendasi_asesor: '',
          ttd: '',
        },
      ],
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
    this.getDataPreview().then((value) => {
      this.getListPertanyaan().then((value) => {
        // this.getIa06();
      });
    });
    this.getListSkema().then((value) => {
      this.onJadwalSelect();
    });
    this.getListUji().then((value) => {
      this.getUjiKompDetail();
    });
    // this.getListPertanyaan().then((value) => {
    //   this.getIa06();
    // });
    this.getDate();
    // this.getIa06();
  },
  methods: {
    checkRole,
    async getDataPreview(){
      this.loading = true;
      const data = await preview.get(this.$route.params.iduji);
      this.dataPreview = data;
      this.loading = false;
    },
    getDate() {
      var arrbulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      var arrHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
      var date = new Date();
      // var millisecond = date.getMilliseconds();
      // var detik = date.getSeconds();
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
      this.headerTable[4].content = arrHari[hari] + ', ' + tanggal + '-' + arrbulan[bulan] + '-' + tahun;
      // document.write(tanggal+"-"+arrbulan[bulan]+"-"+tahun+"<br/>"+jam+" : "+menit+" : "+detik+"."+millisecond);
    },
    allKompeten() {
      for (var i = 0; i < this.listKuk.length; i++) {
        var kuk = this.kukList[i];
        if (kuk.type === 'kuk'){
          // kuk.is_kompeten = this.kompeten;;
        }
      }
    },
    async getListPertanyaan() {
      this.loading = true;
      if (this.dataPreview.id_ia_06 !== null) {
        const { data } = await mstResource.list({ id_skema: this.dataPreview.id_skema });
        // console.log(data);
        const dataia06 = await ia06Detail.get(this.dataPreview.id_ia_06);
        this.listSoal = data;
        this.ia06 = dataia06;
        // console.log(dataia06);
        this.listSoal.forEach((element, index) => {
          element['index'] = index + 1;
          element['jawaban'] = this.ia06.detail[index].jawaban;
          element['is_kompeten'] = this.ia06.detail[index].rekomendasi;
          // this.listSoal[index].is_kompeten = this.ia06.detail[index].rekomendasi;
        });

        const signatures = await signature.list({ asesor: this.$route.params.asesor, asesi: this.dataPreview.nama_peserta });
        const signatureAsesor = await apl02Resource.get(this.dataPreview.id_apl_02);
        console.log(signatureAsesor);

        if (signatures.asesi){
          this.ttdTable1[0].ttd = '/uploads/users/signature/' + signatures.asesi;
        } else {
          this.ttdTable1[0].ttd = null;
        }
        if (signatureAsesor.apl_02.ttd_asesor){
          this.ttdTable2[0].ttd = '/uploads/users/signature/' + signatureAsesor.apl_02.ttd_asesor;
        } else {
          this.ttdTable2[0].ttd = null;
        }

        this.ttdTable1[0].umpan_balik = dataia06.ia_06.umpan_balik;
        this.ttdTable2[0].rekomendasi_asesor = dataia06.ia_06.rekomendasi_asesor;
      }
      this.loading = false;
    },
    // getIa06() {
    //   if (this.dataPreview.id_ia_06 !== null) {
    //     this.loading = true;
    //     this.listSoal.forEach((element, index) => {
    //       var foundIndex = this.ia06.detail.findIndex(x => x.id_perangkat_ia_06 === element['id']);
    //       element['jawaban'] = this.ia06.detail[foundIndex].jawaban;
    //     });
    //     this.loading = false;
    //   }
    // },
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
    getUjiKompDetail() {
      this.loading = true;
      var id_uji = this.dataPreview.id;
      var ujiDetail = this.listUji.find((x) => x.id === id_uji);
      this.headerTable[0].content = ujiDetail.skema_sertifikasi;
      this.headerTable[1].content = ujiDetail.nama_tuk;
      this.headerTable[2].content = ujiDetail.asesor;
      this.headerTable[3].content = ujiDetail.nama_peserta;
      this.headerTable[4].content = ujiDetail.mulai;

      this.ttdTable1[0].nama = ujiDetail.nama_peserta;
      this.ttdTable2[0].nama = ujiDetail.asesor;
      this.loading = false;
    },
    onJadwalSelect() {
      var id_skema = this.dataPreview.id_skema;
      var skemaId = this.listSkema.find((x) => x.id === id_skema);
      this.selectedSkema = skemaId;
      this.dataTrx.id_skema = skemaId.id;
      this.getKuk();
    },
    getKuk(){
      var number = 1;
      var unitKomp = this.selectedSkema.children;
      // console.log(unitKomp);
      var kuk = [];
      unitKomp.forEach((element, index) => {
        element['type'] = 'unitKomp';
        element['index'] = number++;
        kuk.push(element);
        this.unitKompetensiTable[0].col3.push(element['kode_unit']);
        this.unitKompetensiTable[1].col3.push(element['unit_kompetensi']);
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
      this.listKuk = kuk;
    },
    onSubmit() {
      this.loading = true;
      this.form.detail_ia_06 = this.listSoal;
      this.form.user_id = this.userId;
      this.form.id_uji_komp = this.$route.params.id_uji;
      this.form.id_skema = this.$route.params.id_skema;
      postResource
        .store(this.form)
        .then(response => {
          this.$message({
            message: 'FR IA 06 has been created successfully.',
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
    delay(time) {
      return new Promise(resolve => setTimeout(resolve, time));
    },
    nilai() {
      this.loading = true;
      this.form.detail_ia_06 = this.listSoal;
      this.form.user_id = this.userId;
      this.form.id_uji_komp = this.$route.params.id_uji;
      this.form.id_ia_06 = this.$route.params.id_ia_06;
      this.form.id_skema = this.$route.params.id_skema;
      ia06NilaiResource
        .store(this.form)
        .then(response => {
          this.$message({
            message: 'FR IA 06 has been created successfully.',
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
