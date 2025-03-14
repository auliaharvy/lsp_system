<template>
  <el-container
    v-if="dataPreview.id_va == null"
    v-loading="loading"
    class="app-container"
  >
    <el-header>
      <el-page-header
        content="FORM FR.VA BELUM DIISI"
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
      <!-- TODO Penyesuain dengan form -->
      <span>
        <el-page-header
          content="FR.VA MEMBERIKAN KONTRIBUSI DALAM VALIDASI ASESMEN"
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
          <router-link :to="{name: 'preview-ak-06', params: { iduji: $route.params.iduji, asesor: $route.params.asesor }}"><el-button
            type="primary"
            icon="el-icon-arrow-left"
          >Previous Page</el-button></router-link>
          <router-link :to="{name: 'preview-va', params: { iduji: $route.params.iduji, asesor: $route.params.asesor }}"><el-button
            type="primary"
            icon="el-icon-arrow-right"
          >Next Page</el-button></router-link>
        </el-button-group>
      </span>
    </el-header>
    <el-main>
      <div>
        <el-row :gutter="20">
          <el-col
            :sm="24"
            :md="24"
            :lg="12"
          >
            <el-form
              ref="form"
              :model="dataTrx"
              label-width="120px"
            >
              <el-form-item label="Tim Validasi 1">
                <span>: {{ dataTrx.tim_validasi_1 }}</span>
              </el-form-item>
              <el-form-item label="Tim Validasi 2">
                <span>: {{ dataTrx.tim_validasi_2 }}</span>
              </el-form-item>
            </el-form>
          </el-col>
          <el-col
            :sm="24"
            :md="24"
            :lg="12"
          >
            <el-form
              ref="form"
              :model="dataTrx"
              label-width="120px"
            >
              <el-form-item label="Hari / Tanggal">
                <!-- <span>{{ dataTrx.hari }} / {{ dataTrx.tanggal }} - {{ dataTrx.bulan }} - {{ dataTrx.tahun }}</span> -->
                <span>: {{ dataTrx.date }}</span>
              </el-form-item>
              <el-form-item label="Tempat">
                <span>: {{ dataTrx.tempat }}</span>
                <!-- <el-date-picker v-model="dataTrx.date" type="date" placeholder="Pilih hari dan tanggal" style="width: 100%;" /> -->
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col
            :sm="24"
            :md="24"
            :lg="24"
          >
            <el-form
              ref="form"
              :model="dataTrx"
              label-width="120px"
            >
              <el-form-item label="Periode">
                <span>: {{ dataTrx.periode }}</span>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col
            :sm="24"
            :md="24"
            :lg="24"
          >
            <el-form
              ref="form"
              :model="dataTrx"
              label-width="120px"
            >
              <el-form-item label="Nama Skema">
                <span>: {{ dataTrx.namaSkema }}</span>
              </el-form-item>
              <el-form-item label="No Skema">
                <span>: {{ dataTrx.noSkema }}</span>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <h4>Bagian 1 : Menyiapkan proses validasi</h4>
        <br>
        <el-row :gutter="20">
          <el-col
            :sm="24"
            :md="24"
            :lg="24"
          >
            <el-form
              ref="form"
              :model="dataTrx"
              label-width="200px"
            >
              <el-form-item label="Tujuan dan fokus validasi">
                <span>: {{ dataTrx.tujuan_dan_fokus_validasi }}</span>
              </el-form-item>
              <el-form-item label="Konteks validasi">
                <span>: {{ dataTrx.konteks_validasi }}</span>
              </el-form-item>
              <el-form-item label="Pendekatan validasi">
                <span>: {{ dataTrx.pendekatan_validasi }}</span>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col
            :sm="24"
            :md="24"
            :lg="24"
          >
            <el-table
              v-loading="loading"
              :data="tableOrangRelevan"
              border
              fit
              highlight-current-row
              style="width: 100%"
              :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white'}"
            >
              <el-table-column
                align="left"
                min-width="80px"
                label="Orang yang relevan"
              >
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
              <el-table-column
                align="left"
                min-width="200px"
                label="Nama"
              >
                <template slot-scope="scope">
                  <template v-if="scope.row.no === 1">
                    <el-form
                      ref="form"
                      :model="dataTrx"
                      label-width="20px"
                    >
                      <el-form-item label="1">
                        <span>{{ dataTrx.asesor_1 }}</span>
                      </el-form-item>
                      <el-form-item label="2">
                        <span>{{ dataTrx.asesor_2 }}</span>
                      </el-form-item>
                      <el-form-item label="3">
                        <span>{{ dataTrx.asesor_2 }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 2">
                    <el-form
                      ref="form"
                      :model="dataTrx"
                      label-width="20px"
                    >
                      <el-form-item>
                        <span>{{ dataTrx.nama_lead_asesor }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 3">
                    <el-form
                      ref="form"
                      :model="dataTrx"
                      label-width="20px"
                    >
                      <el-form-item>
                        <span>{{ dataTrx.manager }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 4">
                    <el-form
                      ref="form"
                      :model="dataTrx"
                      label-width="20px"
                    >
                      <el-form-item>
                        <span>{{ dataTrx.tenaga_ahli }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 5">
                    <el-form
                      ref="form"
                      :model="dataTrx"
                      label-width="20px"
                    >
                      <el-form-item>
                        <span>{{ dataTrx.koordinator_pelatihan }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 6">
                    <el-form
                      ref="form"
                      :model="dataTrx"
                      label-width="20px"
                    >
                      <el-form-item>
                        <span>{{ dataTrx.anggota_asosiasi }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                </template>
              </el-table-column>
              <el-table-column
                align="left"
                min-width="200px"
                label="Hasil Konfirmasi/diskusi tujuan, fokus & konteks"
              >
                <template slot-scope="scope">
                  <template v-if="scope.row.no === 1">
                    <el-form
                      ref="form"
                      :model="dataTrx"
                      label-width="20px"
                    >
                      <el-form-item label="1">
                        <span>{{ dataTrx.hasil_konfirmasi_asesor_1 }}</span>
                      </el-form-item>
                      <el-form-item label="2">
                        <span>{{ dataTrx.hasil_konfirmasi_asesor_2 }}</span>
                      </el-form-item>
                      <el-form-item label="3">
                        <span>{{ dataTrx.hasil_konfirmasi_asesor_3 }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 2">
                    <el-form
                      ref="form"
                      :model="dataTrx"
                      label-width="20px"
                    >
                      <el-form-item>
                        <span>{{ dataTrx.hasil_konfirmasi_lead_asesor }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 3">
                    <el-form
                      ref="form"
                      :model="dataTrx"
                      label-width="20px"
                    >
                      <el-form-item>
                        <span>{{ dataTrx.hasil_konfirmasi_manager }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 4">
                    <el-form
                      ref="form"
                      :model="dataTrx"
                      label-width="20px"
                    >
                      <el-form-item>
                        <span>{{ dataTrx.hasil_konfirmasi_tenaga_ahli }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 5">
                    <el-form
                      ref="form"
                      :model="dataTrx"
                      label-width="20px"
                    >
                      <el-form-item>
                        <span>{{ dataTrx.hasil_konfirmasi_koordinator_pelatihan }}</span>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 6">
                    <el-form
                      ref="form"
                      :model="dataTrx"
                      label-width="20px"
                    >
                      <el-form-item>
                        <span>{{ dataTrx.hasil_konfirmasi_anggota_asosiasi }}</span>
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
          <el-col
            :sm="24"
            :md="24"
            :lg="24"
          >
            <el-form
              ref="form"
              :model="dataTrx"
              label-width="200px"
            >
              <el-form-item label="Acuan Pembanding">
                <span>: {{ dataTrx.acuan_pembanding }}</span>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col
            :sm="24"
            :md="24"
            :lg="24"
          >
            <el-form
              ref="form"
              :model="dataTrx"
              label-width="200px"
            >
              <el-form-item label="Dokumen Terkait dan Bahan - Bahan">
                <span>: {{ dataTrx.dokumen_terkait }}</span>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <h4>Bagian 2 : Memberikan kontribusi dalam proses validasi</h4>
        <br>
        <el-row :gutter="20">
          <el-col
            :sm="24"
            :md="24"
            :lg="24"
          >
            <el-form
              ref="form"
              :model="dataTrx"
              label-width="200px"
            >
              <el-form-item label="Keterampilan Komunikasi">
                <span>: {{ dataTrx.keterampilan_komunikasi }}</span>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col
            :sm="24"
            :md="24"
            :lg="24"
          >
            <el-table
              v-loading="loading"
              :data="masterData.aspekAspekKegiatan"
              border
              fit
              highlight-current-row
              style="width: 100%"
              :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
            >
              <el-table-column
                align="left"
                min-width="80px"
                label="Aspek-Aspek Dalam Kegiatan Validasi (Meninjau, Membandingkan, Mengevaluasi)"
              >
                <template slot-scope="scope">
                  <span>{{ scope.row.item }}</span>
                </template>
              </el-table-column>
              <el-table-column label="Pemenuhan terhadap:">
                <el-table-column label="Aturan Bukti">
                  <el-table-column
                    align="left"
                    min-width="10px"
                    label="V"
                  >
                    <template slot-scope="scope">
                      <span v-if="scope.row.aturan_v == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                  <el-table-column
                    align="left"
                    min-width="10px"
                    label="A"
                  >
                    <template slot-scope="scope">
                      <span v-if="scope.row.aturan_a == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                  <el-table-column
                    align="left"
                    min-width="10px"
                    label="T"
                  >
                    <template slot-scope="scope">
                      <span v-if="scope.row.aturan_t == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                  <el-table-column
                    align="left"
                    min-width="10px"
                    label="M"
                  >
                    <template slot-scope="scope">
                      <span v-if="scope.row.aturan_m == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                </el-table-column>
                <el-table-column label="Prinsip Asesmen">
                  <el-table-column
                    align="left"
                    min-width="10px"
                    label="V"
                  >
                    <template slot-scope="scope">
                      <span v-if="scope.row.prinsip_v == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                  <el-table-column
                    align="left"
                    min-width="10px"
                    label="R"
                  >
                    <template slot-scope="scope">
                      <span v-if="scope.row.prinsip_r == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                  <el-table-column
                    align="left"
                    min-width="10px"
                    label="F"
                  >
                    <template slot-scope="scope">
                      <span v-if="scope.row.prinsip_f == 1"><i class="el-icon-success ceklist-icon" /></span>
                    </template>
                  </el-table-column>
                  <el-table-column
                    align="left"
                    min-width="10px"
                    label="F"
                  >
                    <template slot-scope="scope">
                      <span v-if="scope.row.prinsip_f_2 == 1"><i class="el-icon-success ceklist-icon" /></span>
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
          <el-col
            :sm="24"
            :md="24"
            :lg="24"
          >
            <el-table
              v-loading="loading"
              :data="listTemuanValidasi"
              border
              fit
              highlight-current-row
              style="width: 100%"
              :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
            >
              <el-table-column
                align="left"
                min-width="80px"
                label="Temuan-temuan validasi :"
              >
                <template slot-scope="{row}">
                  <span>{{ row.temuan }}</span>
                </template>
              </el-table-column>
              <el-table-column
                align="left"
                min-width="80px"
                label="Rekomendasi-rekomendasi untuk meningkatkan praktek asesmen"
              >
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
          <el-col
            :sm="24"
            :md="24"
            :lg="24"
          >
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
                <el-table-column
                  align="left"
                  min-width="80px"
                  label="Kegiatan Perbaikan sesuai Rekomendasi"
                >
                  <template slot-scope="{row}">
                    <span>{{ row.kegiatan }}</span>
                  </template>
                </el-table-column>
                <el-table-column
                  align="left"
                  min-width="80px"
                  label="Waktu Penyelesaian"
                >
                  <template slot-scope="{row}">
                    <span>{{ row.waktu }}</span>
                  </template>
                </el-table-column>
                <el-table-column
                  align="left"
                  min-width="80px"
                  label="Penanggungjawab"
                >
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
import masterDataVa from './masterDataVa.json';
const jadwalResource = new Resource('jadwal-get');
const skemaResource = new Resource('skema-get');
const tukResource = new Resource('tuk-get');
const ujiKomResource = new Resource('uji-komp-get');
const apl01Resource = new Resource('detail/apl-01');
const vaResource = new Resource('uji-komp-va');
const asesorResource = new Resource('assesor');
const print = new Resource('detail/preview');
const dataVa = new Resource('detail/va');
const delay = ms => new Promise(res => setTimeout(res, ms));

export default {
  data() {
    return {
      masterData: masterDataVa,
      dataAsesi: {},
      dataAdmin: {},
      kompeten: null,
      fileName: null,
      loading: false,
      listSkema: null,
      listTuk: null,
      listAsesor: null,
      listJadwal: null,
      listKodeUnit: [],
      listJudulUnit: [],
      listKuk: [],
      listUji: [],
      listTemuanValidasi: [],
      listRencanaImplementasi: [],
      detail: {},
      selectedSkema: {},
      selectedUji: {},
      dataTrx: {
        tim_validasi_1: null,
        tim_validasi_2: null,
        date: null,
        tempat: null,
        periode: null,
        namaSkema: null,
        noSkema: null,
        tujuan_dan_fokus_validasi: null,
        konteks_validasi: null,
        pendekatan_validasi: null,
        asesor_1: null,
        asesor_2: null,
        asesor_3: null,
        nama_lead_asesor: null,
        hasil_konfirmasi_asesor_1: null,
        hasil_konfirmasi_asesor_2: null,
        hasil_konfirmasi_asesor_3: null,
        lead_asesor: null,
        hasil_konfirmasi_lead_asesor: null,
        manager: null,
        hasil_konfirmasi_manager: null,
        tenaga_ahli: null,
        hasil_konfirmasi_tenaga_ahli: null,
        koordinator_pelatihan: null,
        hasil_konfirmasi_koordinator_pelatihan: null,
        anggota_asosiasi: null,
        hasil_konfirmasi_anggota_asosiasi: null,
        acuan_pembanding: null,
        dokumen_terkait: null,
        keterampilan_komunikasi: null,
      },
      unitKompetensiTable: [],
      buktiTable: [],
      tableOrangRelevan: [
        {
          no: 1,
          asesorKompetensi: '',
        },
        {
          no: 2,
          leadAsesor: '',
        },
        {
          no: 3,
          managerSupervisor: '',
        },
        {
          no: 4,
          tenagaAhli: '',
        },
        {
          no: 5,
          koordinator: '',
        },
        {
          no: 6,
          anggotaAsosiasi: '',
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
      this.getApl01();
      this.getVa();
    });
    this.getListSkema().then((value) => {
      this.onJadwalSelect();
    });
    this.getListUji().then((value) => {
      this.getUjiKompDetail();
      this.getListAsesor();
      this.getListTuk();
      this.getListJadwal();
      this.getDate();
    });
    // this.getApl01();
  },
  methods: {
    async getDataPreview(){
      this.loading = true;

      const data = await print.get(this.$route.params.iduji);
      this.dataPreview = data;
      console.log(this.dataPreview);

      this.loading = false;
    },
    async getVa(){
      this.loading = true;

      if (this.dataPreview.id_va !== null){
        const data = await dataVa.get(this.dataPreview.id_va);
        console.log(data.dataVa[0]);
        const tanggalObj = new Date(data.dataVa[0].created_at);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const tanggalFormatted = tanggalObj.toLocaleDateString('id-ID', options);

        const jamFormatted = tanggalObj.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

        const waktuUjian = `${tanggalFormatted} - Jam ${jamFormatted}`;

        this.dataTrx.tim_validasi_1 = data.dataVa[0].tim_validasi_1;
        this.dataTrx.tim_validasi_2 = data.dataVa[0].tim_validasi_2;
        this.dataTrx.date = waktuUjian;
        this.dataTrx.periode = data.dataVa[0].periode;
        this.dataTrx.tujuan_dan_fokus_validasi = data.dataVa[0].tujuan_dan_fokus_validasi;
        this.dataTrx.konteks_validasi = data.dataVa[0].tujuan_dan_fokus_validasi;
        this.dataTrx.konteks_validasi = data.dataVa[0].konteks_validasi;
        this.dataTrx.pendekatan_validasi = data.dataVa[0].pendekatan_validasi;

        this.dataTrx.asesor_1 = data.dataVa[0].nama_asesor_1;
        this.dataTrx.asesor_2 = data.dataVa[0].nama_asesor_2;
        this.dataTrx.asesor_3 = data.dataVa[0].nama_asesor_3;
        this.dataTrx.nama_lead_asesor = data.dataVa[0].nama_lead_asesor;
        this.dataTrx.hasil_konfirmasi_asesor_1 = data.dataVa[0].hasil_konfirmasi_asesor_1;
        this.dataTrx.hasil_konfirmasi_asesor_2 = data.dataVa[0].hasil_konfirmasi_asesor_2;
        this.dataTrx.hasil_konfirmasi_asesor_3 = data.dataVa[0].hasil_konfirmasi_asesor_3;
        this.dataTrx.lead_asesor = data.dataVa[0].lead_asesor;
        this.dataTrx.hasil_konfirmasi_lead_asesor = data.dataVa[0].hasil_konfirmasi_lead_asesor;
        this.dataTrx.manager = data.dataVa[0].manager;
        this.dataTrx.hasil_konfirmasi_manager = data.dataVa[0].hasil_konfirmasi_manager;
        this.dataTrx.tenaga_ahli = data.dataVa[0].tenaga_ahli;
        this.dataTrx.hasil_konfirmasi_tenaga_ahli = data.dataVa[0].hasil_konfirmasi_tenaga_ahli;
        this.dataTrx.koordinator_pelatihan = data.dataVa[0].koordinator_pelatihan;
        this.dataTrx.hasil_konfirmasi_koordinator_pelatihan = data.dataVa[0].hasil_konfirmasi_koordinator_pelatihan;
        this.dataTrx.anggota_asosiasi = data.dataVa[0].anggota_asosiasi;
        this.dataTrx.hasil_konfirmasi_anggota_asosiasi = data.dataVa[0].hasil_konfirmasi_anggota_asosiasi;

        this.dataTrx.acuan_pembanding = data.dataVa[0].acuan_pembanding;
        this.dataTrx.dokumen_terkait = data.dataVa[0].dokumen_terkait;
        this.dataTrx.keterampilan_komunikasi = data.dataVa[0].keterampilan_komunikasi;

        this.listTemuanValidasi = data.temuan;
        this.listRencanaImplementasi = data.rencana;
        this.masterData.aspekAspekKegiatan = data.aspek;
      }
      this.loading = false;
    },
    async getListAsesor() {
      const { data } = await asesorResource.list();
      this.listAsesor = data;
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
    getUjiKompDetail() {
      var id_uji = this.dataPreview.id;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      var ujiDetail = this.listUji.find((x) => x.id === id_uji);
      this.selectedUji = ujiDetail;
      this.dataTrx.tempat = this.selectedUji.nama_tuk;
      this.dataTrx.namaSkema = this.selectedUji.skema_sertifikasi;
      this.dataTrx.noSkema = this.selectedUji.kode_skema;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
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
      // document.write(tanggal+"-"+arrbulan[bulan]+"-"+tahun+"<br/>"+jam+" : "+menit+" : "+detik+"."+millisecond);
    },
    async generateReport() {
      this.loading = true;
      await delay(3000);
      this.$router.push({ name: 'uji-komp-list' });
      this.loading = false;
      // this.$refs.html2Pdf.generatePdf();
    },
    async beforeDownload({ html2pdf, options, pdfContent }) {
      await html2pdf().set(options).from(pdfContent).toPdf().get('pdf').then((pdf) => {
        const totalPages = pdf.internal.getNumberOfPages();
        for (let i = 1; i <= totalPages; i++) {
          pdf.setPage(i);
          pdf.setFontSize(10);
          pdf.setTextColor(150);
          pdf.text('Page ' + i + ' of ' + totalPages, (pdf.internal.pageSize.getWidth() * 0.88), (pdf.internal.pageSize.getHeight() - 0.3));
        }
      }).save();
    },
    async getApl01() {
      const data = await apl01Resource.get(this.dataPreview.id_apl_01);
      this.fileName = 'APL.01 - ' + data.nama_lengkap + ' - ' + data.kode_skema;
    },
    onJadwalSelect() {
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
      var kuk = [];
      unitKomp.forEach((element, index) => {
        element['type'] = 'unitKomp';
        element['index'] = number++;
        kuk.push(element);
        // this.headerTable[3].content.push(element['unit_kompetensi']);
        this.listKodeUnit.push(element);
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
      // var elemen = unitKomp.elemen;;
      // var kuk = elemen.kuk;
      this.listKuk = kuk;
    },
    search(nameKey, myArray){
      for (var i = 0; i < myArray.length; i++) {
        if (myArray[i].status === nameKey) {
          return myArray[i];
        }
      }
    },
    onSubmit() {
      this.loading = true;
      this.dataTrx.aspek = this.masterData.aspekAspekKegiatan;
      this.dataTrx.temuan = this.listTemuanValidasi;
      this.dataTrx.rencana = this.listRencanaImplementasi;
      this.dataTrx.user_id = this.userId;
      this.dataTrx.id_uji_komp = this.$route.params.id_uji;
      this.dataTrx.id_skema = this.$route.params.id_skema;
      vaResource
        .store(this.dataTrx)
        .then(response => {
          this.$message({
            message: 'FR VA has been created successfully.',
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
    onResize() {
      const width = document.body.clientWidth;
      this.isWide = width > 800;
      if (this.isWide) {
        this.labelPosition = 'left';
      } else {
        this.labelPosition = 'top';
      }
    },
    addTemuan(){
      this.listTemuanValidasi.push({ temuan: '', rekomendasi: '' });
    },
    addRencanaImplementasi(){
      this.listRencanaImplementasi.push({ kegiatan: '', waktu: '', penanggungJawab: '' });
    },
    deleteTemuan(row){
      const deleteIndex = this.listTemuanValidasi.findIndex(item => item.temuan === row.temuan && item.rekomendasi === row.rekomendasi);
      if (deleteIndex > -1) {
        this.listTemuanValidasi.splice(deleteIndex, 1);
      }
    },
    deleteRencanaImplementasi(row){
      const deleteIndex = this.listRencanaImplementasi.findIndex(item => item.kegiatan === row.kegiatan && item.waktu === row.waktu && item.penanggungJawab === row.penanggungJawab);
      if (deleteIndex > -1) {
        this.listRencanaImplementasi.splice(deleteIndex, 1);
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
