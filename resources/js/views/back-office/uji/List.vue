<template>
  <div class="app-container">
    <div class="filter-container">
      <el-select
        v-model="query.id_jadwal"
        filterable
        clearable
        class="filter-item full"
        placeholder="pilih jadwal"
      >
        <el-option
          v-for="item in listJadwal"
          :key="item.id"
          :label="item.jadwal + ' / ' + item.nama_asesor + ' / ' + item.start_date"
          :value="item.id"
        />
      </el-select>
      <el-select
        v-model="query.id_skema"
        filterable
        clearable
        class="filter-item full"
        placeholder="pilih skema"
      >
        <el-option
          v-for="item in listSkema"
          :key="item.id"
          :label="item.skema_sertifikasi"
          :value="item.id"
        />
      </el-select>
      <!-- <span>{{ listJadwal }}</span> -->
      <el-input
        v-model="query.keyword"
        :placeholder="$t('table.keyword')"
        style="width: 200px;"
        class="filter-item"
        @keyup.enter.native="handleFilter"
      />
      <el-button
        v-waves
        class="filter-item"
        type="primary"
        icon="el-icon-search"
        @click="handleFilter"
      >
        {{ $t('table.search') }}
      </el-button>
      <!-- <el-button class="filter-item" style="margin-left: 10px;" type="primary" icon="el-icon-plus" @click="handleCreate">
        {{ $t('table.add') }}
      </el-button> -->
      <el-button
        v-waves
        :loading="downloading"
        class="filter-item"
        type="primary"
        icon="el-icon-download"
        @click="handleDownload"
      >
        {{ $t('table.export') }}
      </el-button>
    </div>

    <el-table
      v-loading="loading"
      :data="list"
      border
      fit
      highlight-current-row
      style="width: 100%"
      :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
    >
      <el-table-column
        align="center"
        label="No"
        width="80"
      >
        <template slot-scope="scope">
          <span>{{ scope.row.index }}</span>
        </template>
      </el-table-column>

      <el-table-column type="expand">
        <template slot-scope="scope">
          <el-row :gutter="20">
            <el-col
              class="table-expand"
              :span="8"
            >
              <div class="grid-content">
                <h3>Progress Uji Kompetensi</h3>
                <el-progress
                  type="dashboard"
                  :percentage="scope.row.persentase"
                  :color="colors"
                />
              </div>
            </el-col>
            <el-col
              class="table-expand"
              :span="4"
            >
              <div class="grid-content">
                <ul>
                  <li
                    v-if="query.role !== 'user'"
                    class="list-progress"
                  >
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-APL-01"
                      placement="top-start"
                    >
                      <router-link :to="{ name: 'form-apl-01', params: { id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">APL 01  <i
                          v-if="scope.row.id_apl_01 !== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li
                    v-if="query.role !== 'user'"
                    class="list-progress"
                  >
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-APL-02"
                      placement="top-start"
                    >
                      <router-link :to="{ name: 'form-apl-02', params: { asesor: scope.row.asesor ,id_apl_01: scope.row.id_apl_01, id_apl_02: scope.row.id_apl_02, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">APL 02  <i
                          v-if="scope.row.id_apl_02 !== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    MAPA 01  <i
                      v-if="scope.row.id_mapa_01 !== null"
                      type="success"
                      class="el-icon-check"
                    />
                  </li>
                  <li class="list-progress">
                    Skema  <i
                      v-if="scope.row.id_skema !== null"
                      type="success"
                      class="el-icon-check"
                    />
                  </li>
                  <li class="list-progress">
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-MAPA-02"
                      placement="top-start"
                    >
                      <router-link :to="{ name: 'form-mapa-02', params: { id_mapa_02: scope.row.id_mapa_02, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">MAPA 02  <i
                          v-if="scope.row.id_mapa_02 !== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-IA-01"
                      placement="top-start"
                    >
                      <router-link :to="{ name: 'form-ak-01', params: { id_ak_01: scope.row.id_ak_01, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">AK 01  <i
                          v-if="scope.row.id_ak_01 !== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    <router-link :to="{ name: 'form-ak-04', params: { id_ak_04: scope.row.id_ak_04, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                      <span class="link">AK 04  <i
                        v-if="scope.row.id_ak_04!== null"
                        type="success"
                        class="el-icon-check"
                      /></span>
                    </router-link>
                  </li>
                  <li
                    v-if="query.role !== 'user'"
                    class="list-progress"
                  >
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-IA-01"
                      placement="top-start"
                    >
                      <router-link :to="{ name: 'form-ia-01', params: { id_ia_01: scope.row.id_ia_01, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">IA 01  <i
                          v-if="scope.row.id_ia_01 !== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-IA-02"
                      placement="top-start"
                    >
                      <el-button
                        v-if="query.role === 'user'"
                        type="text"
                        @click="handleAkses('ia02', scope.row)"
                      >
                        IA 02 <i
                          v-if="scope.row.id_ia_02 !== null"
                          type="success"
                          class="el-icon-check"
                        />
                      </el-button>
                      <router-link
                        v-else
                        :to="{ name: 'form-ia-02', params: { id_ia_02: scope.row.id_ia_02, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}"
                      >
                        <span class="link">IA 02  <i
                          v-if="scope.row.id_ia_02 !== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                </ul>
              </div>
            </el-col>
            <el-col
              class="table-expand"
              :span="4"
            >
              <div class="grid-content">
                <ul>
                  <li class="list-progress">
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-IA-01"
                      placement="top-start"
                    >
                      <el-button
                        v-if="query.role === 'user'"
                        type="text"
                        @click="handleAkses('ia03', scope.row)"
                      >
                        IA 03 <i
                          v-if="scope.row.id_ia_03 !== null"
                          type="success"
                          class="el-icon-check"
                        />
                      </el-button>
                      <router-link
                        v-else
                        :to="{ name: 'form-ia-03', params: { id_ia_03: scope.row.id_ia_03, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}"
                      >
                        <span class="link">IA 03  <i
                          v-if="scope.row.id_ia_03 !== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-IA-05"
                      placement="top-start"
                    >
                      <el-button
                        v-if="query.role === 'user'"
                        type="text"
                        @click="handleAkses('ia05', scope.row)"
                      >
                        IA 05 <i
                          v-if="scope.row.id_ia_05 !== null"
                          type="success"
                          class="el-icon-check"
                        />
                      </el-button>
                      <router-link
                        v-else
                        :to="{ name: 'form-ia-05', params: { id_ia_05: scope.row.id_ia_05, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}"
                      >
                        <span class="link">IA 05  <i
                          v-if="scope.row.id_ia_05!== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-IA-06"
                      placement="top-start"
                    >
                      <el-button
                        v-if="query.role === 'user'"
                        type="text"
                        @click="handleAkses('ia06', scope.row)"
                      >
                        IA 06 <i
                          v-if="scope.row.id_ia_06 !== null"
                          type="success"
                          class="el-icon-check"
                        />
                      </el-button>
                      <router-link
                        v-else
                        :to="{ name: 'form-ia-06', params: { id_ia_06: scope.row.id_ia_06, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}"
                      >
                        <span class="link">IA 06  <i
                          v-if="scope.row.id_ia_06!== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-IA-07"
                      placement="top-start"
                    >
                      <el-button
                        v-if="query.role === 'user'"
                        type="text"
                        @click="handleAkses('ia07', scope.row)"
                      >
                        IA 07 <i
                          v-if="scope.row.id_ia_07 !== null"
                          type="success"
                          class="el-icon-check"
                        />
                      </el-button>
                      <router-link
                        v-else
                        :to="{ name: 'form-ia-07', params: { id_ia_07: scope.row.id_ia_07, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}"
                      >
                        <span class="link">IA 07  <i
                          v-if="scope.row.id_ia_07!== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li
                    v-if="query.role !== 'user'"
                    class="list-progress"
                  >
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-IA-11"
                      placement="top-start"
                    >
                      <router-link :to="{ name: 'form-ia-11', params: { id_ia_11: scope.row.id_ia_11, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">IA 11  <i
                          v-if="scope.row.id_ia_11!== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li
                    v-if="query.role !== 'user'"
                    class="list-progress"
                  >
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-AK-02"
                      placement="top-start"
                    >
                      <router-link :to="{ name: 'form-ak-02', params: { id_ak_02: scope.row.id_ak_02, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">AK 02  <i
                          v-if="scope.row.id_ak_02!== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li class="list-progress">
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-AK-03"
                      placement="top-start"
                    >
                      <router-link :to="{ name: 'form-ak-03', params: { id_ak_03: scope.row.id_ak_03, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">AK 03  <i
                          v-if="scope.row.id_ak_03!== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li
                    v-if="query.role !== 'user'"
                    class="list-progress"
                  >
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-AK-05"
                      placement="top-start"
                    >
                      <router-link :to="{ name: 'form-ak-05', params: { id_ak_05: scope.row.id_ak_05, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">AK 05  <i
                          v-if="scope.row.id_ak_05 !== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li
                    v-if="query.role !== 'user'"
                    class="list-progress"
                  >
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-AK-06"
                      placement="top-start"
                    >
                      <router-link :to="{ name: 'form-ak-06', params: { id_ak_06: scope.row.id_ak_06, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">AK 06  <i
                          v-if="scope.row.id_ak_06 !== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                  <li
                    class="list-progress"
                  >
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-AK-07"
                      placement="top-start"
                    >
                      <span
                        style="cursor: pointer;"
                        @click="handleUji('form-ak-07', scope.row)"
                      >
                        <span class="link">AK 07 <i
                          v-if="scope.row.id_ak_07 !== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </span>
                    </el-tooltip>
                  </li>
                  <li
                    v-if="query.role !== 'user'"
                    class="list-progress"
                  >
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="View FR-VA"
                      placement="top-start"
                    >
                      <router-link :to="{ name: 'form-va', params: { id_va: scope.row.id_va, id_apl_01: scope.row.id_apl_01, id_skema: scope.row.id_skema, id_uji: scope.row.id }}">
                        <span class="link">VA  <i
                          v-if="scope.row.id_va !== null"
                          type="success"
                          class="el-icon-check"
                        /></span>
                      </router-link>
                    </el-tooltip>
                  </li>
                </ul>
              </div>
            </el-col>
          </el-row>
        </template>
      </el-table-column>

      <el-table-column
        align="left"
        :label="$t('uji.table.schedule')"
        min-width="100px"
      >
        <template slot-scope="scope">
          <span> {{ scope.row.jadwal }} </span>
        </template>
      </el-table-column>

      <el-table-column
        align="left"
        :label="$t('uji.table.skema')"
        min-width="150px"
      >
        <template slot-scope="scope">
          <span> {{ scope.row.kode_skema }} / {{ scope.row.skema_sertifikasi }} </span>
        </template>
      </el-table-column>

      <el-table-column
        align="left"
        :label="$t('jadwal.table.asesor')"
      >
        <template slot-scope="scope">
          {{ scope.row.asesor }}
        </template>
      </el-table-column>

      <el-table-column
        align="left"
        :label="$t('uji.table.asesi')"
      >
        <template slot-scope="scope">
          <span>{{ scope.row.nama_peserta }}</span>
        </template>
      </el-table-column>

      <el-table-column
        align="center"
        :label="$t('uji.table.mulai')"
      >
        <template slot-scope="scope">
          <span> {{ scope.row.mulai }} </span>
        </template>
      </el-table-column>

      <el-table-column
        align="center"
        label="Status"
      >
        <template slot-scope="scope">
          <el-tag
            v-if="scope.row.status === 1"
            type="success"
            effect="dark"
          >
            Selesai
          </el-tag>
          <el-tag
            v-if="scope.row.status === 0"
            type="warning"
            effect="dark"
          >
            Belum Selesai
          </el-tag>
        </template>
      </el-table-column>

      <el-table-column
        align="center"
        label="Actions"
        width="120"
      >
        <template slot-scope="scope">
          <el-button-group>
            <el-tooltip
              class="item"
              effect="dark"
              content="Update"
              placement="top-end"
            >
              <el-button
                v-permission="['manage user']"
                type="success"
                size="small"
                icon="el-icon-edit"
                @click="handleUpdate(scope.row)"
              />
            </el-tooltip>
            <el-tooltip
              class="item"
              effect="dark"
              content="Update"
              placement="top-end"
            >
              <el-button
                v-permission="['manage user']"
                type="danger"
                size="small"
                icon="el-icon-delete"
                @click="handleDelete(scope.row)"
              />
            </el-tooltip>
            <el-tooltip
              class="item"
              effect="dark"
              content="Buat Sertifikat"
              placement="top-end"
            >
              <el-button
                v-if="query.role !== 'user' && scope.row.id_ak_05 !== null"
                type="primary"
                size="small"
                icon="el-icon-document-checked"
                @click="handleCreateSertifikat(scope.row)"
              />
            </el-tooltip>
            <el-tooltip
              class="item"
              effect="dark"
              content="Edit Sertifikat"
              placement="top-end"
            >
              <el-button
                v-if="query.role !== 'user' && scope.row.id_ak_05 !== null"
                type="warning"
                size="small"
                icon="el-icon-document-checked"
                @click="handleUpdateSertifikat(scope.row)"
              />
            </el-tooltip>
          </el-button-group>
        </template>
      </el-table-column>
    </el-table>

    <pagination
      v-show="total>0"
      :total="total"
      :page.sync="query.page"
      :limit.sync="query.limit"
      @pagination="getList"
    />

    <el-dialog
      :title="$t('sertifikat.dialog.new') + ' ' + newSertifikat.nama"
      :visible.sync="dialogFormSertifikatVisible"
    >
      <div
        v-loading="sertifikatCreating"
        class="form-container"
      >
        <el-form
          ref="newSertifikatForm"
          :rules="rulesSertifikat"
          :model="newSertifikat"
          label-position="left"
          label-width="150px"
          style="max-width: 500px;"
        >
          <el-form-item
            :label="$t('sertifikat.table.nama')"
            prop="nama"
          >
            <el-input
              v-model="newSertifikat.nama"
              disabled
            />
          </el-form-item>
          <el-form-item
            :label="$t('sertifikat.table.no_registrasi')"
            prop="no_registrasi"
          >
            <el-input v-model="newSertifikat.no_registrasi" />
          </el-form-item>
          <el-form-item
            :label="$t('sertifikat.table.skema_sertifikasi')"
            prop="skema_sertifikasi"
          >
            <el-input
              v-model="newSertifikat.skema_sertifikasi"
              disabled
            />
          </el-form-item>
          <el-form-item
            :label="$t('sertifikat.table.no_sertifikat')"
            prop="no_sertifikat"
          >
            <el-input v-model="newSertifikat.no_sertifikat" />
          </el-form-item>
          <el-form-item
            :label="$t('sertifikat.table.masa_berlaku')"
            prop="masa_berlaku"
          >
            <el-date-picker
              v-model="newSertifikat.masa_berlaku"
              type="date"
              format="yyyy-MM-dd"
              value-format="yyyy-MM-dd"
              placeholder="Pick a date"
              style="width: 100%"
            />
          </el-form-item>
        </el-form>
        <div
          slot="footer"
          class="dialog-footer"
        >
          <el-button @click="dialogFormSertifikatVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button
            type="primary"
            @click="submitNewSertifikat()"
          >
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>

    <el-dialog
      :title="$t('sertifikat.dialog.edit') + ' ' + editedSertifikat.nama"
      :visible.sync="dialogFormUpdateSertifikatVisible"
    >
      <div
        v-loading="sertifikatCreating"
        class="form-container"
      >
        <el-form
          ref="editedSertifikatForm"
          :rules="rulesSertifikat"
          :model="editedSertifikat"
          label-position="left"
          label-width="150px"
          style="max-width: 500px;"
        >
          <el-form-item
            :label="$t('sertifikat.table.nama')"
            prop="nama"
          >
            <el-input
              v-model="editedSertifikat.nama"
              disabled
            />
          </el-form-item>
          <el-form-item
            :label="$t('sertifikat.table.no_registrasi')"
            prop="no_registrasi"
          >
            <el-input v-model="editedSertifikat.no_registrasi" />
          </el-form-item>
          <el-form-item
            :label="$t('sertifikat.table.skema_sertifikasi')"
            prop="skema_sertifikasi"
          >
            <el-input
              v-model="editedSertifikat.skema_sertifikasi"
              disabled
            />
          </el-form-item>
          <el-form-item
            :label="$t('sertifikat.table.no_sertifikat')"
            prop="no_sertifikat"
          >
            <el-input v-model="editedSertifikat.no_sertifikat" />
          </el-form-item>
          <el-form-item
            :label="$t('sertifikat.table.masa_berlaku')"
            prop="masa_berlaku"
          >
            <el-date-picker
              v-model="editedSertifikat.masa_berlaku"
              type="date"
              format="yyyy-MM-dd"
              value-format="yyyy-MM-dd"
              placeholder="Pick a date"
              style="width: 100%"
            />
          </el-form-item>
        </el-form>
        <div
          slot="footer"
          class="dialog-footer"
        >
          <el-button @click="dialogFormUpdateSertifikatVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button
            type="primary"
            @click="updateDataSertifikat()"
          >
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>

    <el-dialog
      title="Silakan masukan password untuk akses form"
      :visible.sync="dialogFormVisible"
    >
      <div
        v-loading="creating"
        class="form-container"
      >
        <el-form
          ref="dataForm"
          :rules="rules"
          :model="aksesForm"
          label-position="top"
          label-width="150px"
          style="max-width: 100%;"
        >
          <el-form-item>
            <el-input
              v-model="aksesForm.password"
              placeholder="password"
              :type="pwdType"
            />
            <span
              class="show-pwd"
              @click="showPwd"
            >
              <svg-icon icon-class="eye" />
            </span>
          </el-form-item>
        </el-form>
        <div
          slot="footer"
          class="dialog-footer"
        >
          <el-button @click="dialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button
            type="primary"
            @click="toForm()"
          >
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>

    <el-dialog
      :title="$t('tuk.dialog.addNew') + ' ' + editedData.nama"
      :visible.sync="dialogFormUpdateVisible"
    >
      <div
        v-loading="creating"
        class="form-container"
      >
        <el-form
          ref="dataForm"
          :rules="rules"
          :model="editedData"
          label-position="left"
          label-width="150px"
          style="max-width: 500px;"
        >
          <el-form-item
            :label="$t('tuk.table.code')"
            prop="kode_tuk"
          >
            <el-input v-model="editedData.kode_tuk" />
          </el-form-item>
          <el-form-item
            :label="$t('table.name')"
            prop="nama"
          >
            <el-input v-model="editedData.nama" />
          </el-form-item>
          <el-form-item
            :label="$t('tuk.table.address')"
            prop="alamat"
          >
            <el-input v-model="editedData.alamat" />
          </el-form-item>
          <el-form-item
            :label="$t('tuk.table.telp')"
            prop="no_telp"
          >
            <el-input v-model="editedData.no_telp" />
          </el-form-item>
          <el-form-item
            :label="$t('tuk.table.email')"
            prop="email"
          >
            <el-input v-model="editedData.email" />
          </el-form-item>
        </el-form>
        <div
          slot="footer"
          class="dialog-footer"
        >
          <el-button @click="dialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button
            type="primary"
            @click="updateData()"
          >
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import permission from '@/directive/permission'; // Permission directive
import checkRole from '@/utils/role';

const listResource = new Resource('uji-komp-get');
const skemaResource = new Resource('skema');
const jadwalResource = new Resource('jadwal-get');
const ujiResource = new Resource('uji');
const pemegangSertifikatResource = new Resource('pemegang-sertifikat');
// const preview = new Resource('detail/preview') ;
// const soalIa05AndIa07 = new Resource('soal/ia05/ia07');

export default {
  name: 'PerangkatAsemenList',
  components: { Pagination },
  directives: { waves, permission },
  data() {
    return {
      list: null,
      listSkema: null,
      listJadwal: null,
      aksesForm: {},
      total: 0,
      loading: true,
      downloading: false,
      creating: false,
      sertifikatCreating: false,
      dialogFormVisible: false,
      dialogFormUpdateVisible: false,
      dialogFormSertifikatVisible: false,
      dialogFormUpdateSertifikatVisible: false,
      newData: {},
      pwdType: 'password',
      ia05: null,
      ia07: null,
      newSertifikat: {
        id: 0,
        id_uji_komp: 0,
        nama: '',
        no_registrasi: '',
        skema_sertifikasi: '',
        no_sertifikat: '',
        masa_berlaku: '',
      },
      editedSertifikat: {
        id: 0,
        id_uji_komp: 0,
        nama: '',
        no_registrasi: '',
        skema_sertifikasi: '',
        no_sertifikat: '',
        masa_berlaku: '',
      },
      editedData: {
        id: 0,
        kode_tuk: '',
        nama: '',
        alamat: '',
        no_telp: '',
        email: '',
      },
      query: {
        page: 1,
        limit: 5,
        keyword: '',
        role: '',
        user_id: null,
      },
      pemegangSertifikat: '',
      rules: {
        kode_perangkat: [{ required: true, message: 'Kode Perangkat is required', trigger: 'change' }],
        nama_perangkat: [{ required: true, message: 'Nama Perangkat is required', trigger: 'blur' }],
        id_skema: [{ required: true, message: 'Skema Sertifikasi is required', trigger: 'blur' }],
      },
      rulesSertifikat: {
        nama: [{ required: true, message: 'Nama is required', trigger: 'change' }],
        no_registrasi: [{ required: true, message: 'Nomor Registrasi is required', trigger: 'blur' }],
        skema_sertifikasi: [{ required: true, message: 'Skema Sertifikasi is required', trigger: 'blur' }],
        no_sertifikat: [{ required: true, message: 'Nomor Sertifikat is required', trigger: 'blur' }],
        masa_berlaku: [{ required: true, message: 'Masa Berlaku is required', trigger: 'blur' }],
      },
      colors: [
        { color: '#f56c6c', percentage: 20 },
        { color: '#e6a23c', percentage: 40 },
        { color: '#5cb87a', percentage: 60 },
        { color: '#1989fa', percentage: 80 },
        { color: '#6f7ad3', percentage: 100 },
      ],
    };
  },
  computed: {
    ...mapGetters([
      'username',
      'userId',
      'roles',
      'user',
    ]),
  },
  created() {
    this.getList();
    this.getListJadwal();
  },
  methods: {
    checkRole,
    handleIdUji(id){
      console.log(id)
      localStorage.setItem('idujikomp', id)
    },
    // tidak menampilkan ia 05 dan ia 07 ketika form tersebut tidak punya list pertanyaan
    // async getSoalIa05AndIa07(){
    //   console.log(this.list);
    //   const dataPreview = await preview.get(this.list[0].id);
    //   const dataSoal = await soalIa05AndIa07.list(dataPreview.id_skema);
    //   console.log(dataSoal);
    //   if (dataSoal.soalIa05 !== null) {
    //     this.ia05 = dataSoal.soalIa05;
    //   }
    //   if (dataSoal.soalIa07 !== null) {
    //     this.ia07 = dataSoal.soalIa07;
    //   }
    // },
    async getList() {
      this.query.role = this.roles[0];
      this.query.user_id = this.userId;
      const { limit, page } = this.query;
      this.loading = true;
      // get data skema;
      const dataSkema = await skemaResource.list({ limit: 1000 });
      this.listSkema = dataSkema.data;
      // get data perangkat / list table
      const { data, meta } = await listResource.list(this.query);
      this.list = data;
      // console.log(this.list);
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.total = meta.total;
      this.loading = false;
    },
    async getListJadwal() {
      const { data } = await jadwalResource.list({ limit: 1000 });
      this.listJadwal = data;
    },
    async getDataSertifikat(id){
      const { data } = await pemegangSertifikatResource.list({ id });
      return data;
    },
    handleAkses(form, data) {
      this.aksesForm = data;
      this.aksesForm.fr = form;
      // console.log(this.aksesForm);
      this.dialogFormVisible = true;
    },
    handleUji(to, row){
      localStorage.setItem('idujikomp', row.id)
      this.$router.push({ name: to, params: { id_va: row.id_va, id_apl_01: row.id_apl_01, id_skema: row.id_skema, id_uji: row.id }});
    },
    toForm() {
      if (this.aksesForm.password !== this.aksesForm.password_asesi) {
        this.$message({
          type: 'error',
          message: 'Password Salah',
        });
      } else {
        if (this.aksesForm.fr === 'ia02') {
          // this.$router.push({ path: `form-ia-02/${this.aksesForm.id_ia_02}/${this.aksesForm.id_apl_01}/${this.aksesForm.id_skema}/${this.aksesForm.id}` }); // ini nanti akan dipake klo masalah perbaikan ia 02 selesai
          this.$router.push({ name: 'form-ia-02', params: { id_ia_02: this.aksesForm.id_ia_02, id_apl_01: this.aksesForm.id_apl_01, id_skema: this.aksesForm.id_skema, id_uji: this.aksesForm.id }});
        } if (this.aksesForm.fr === 'ia03') {
          this.$router.push({ name: 'form-ia-03', params: { id_ia_03: this.aksesForm.id_ia_03, id_apl_01: this.aksesForm.id_apl_01, id_skema: this.aksesForm.id_skema, id_uji: this.aksesForm.id }});
        } if (this.aksesForm.fr === 'ia05') {
          this.$router.push({ name: 'form-ia-05', params: { id_ia_05: this.aksesForm.id_ia_05, id_apl_01: this.aksesForm.id_apl_01, id_skema: this.aksesForm.id_skema, id_uji: this.aksesForm.id }});
        } if (this.aksesForm.fr === 'ia06') {
          this.$router.push({ name: 'form-ia-06', params: { id_ia_06: this.aksesForm.id_ia_06, id_apl_01: this.aksesForm.id_apl_01, id_skema: this.aksesForm.id_skema, id_uji: this.aksesForm.id }});
        } if (this.aksesForm.fr === 'ia07') {
          this.$router.push({ name: 'form-ia-07', params: { id_ia_07: this.aksesForm.id_ia_07, id_apl_01: this.aksesForm.id_apl_01, id_skema: this.aksesForm.id_skema, id_uji: this.aksesForm.id }});
        }
      }
      // this.aksesForm.fr = form;
      // console.log(this.aksesForm);
      // this.dialogFormVisible = true;
    },
    handleFilter() {
      this.query.page = 1;
      this.getList();
    },
    resetnewData() {
      this.newData = {};
    },
    resetNewSertifikat() {
      this.newSertifikat = {};
    },
    dialogFormUpdateSertifikatIsVisible(){
      this.dialogFormUpdateSertifikatIsVisible = false;
      this.getList();
    },
    async getPemegangSertifikat(id){
      this.editedSertifikat = await pemegangSertifikatResource.get(id);
    },
    async handleUpdateSertifikat(sertifikat) {
      this.isSelect = true;
      this.editedSertifikat = await pemegangSertifikatResource.get(sertifikat.id);
      // console.log(sertifikat);
      // console.log(this.editedSertifikat);
      this.dialogFormUpdateSertifikatVisible = true;
    },
    handleCreateSertifikat(sertifikat) {
      this.resetNewSertifikat();
      console.log(sertifikat);
      this.newSertifikat.id_uji_komp = sertifikat.id;
      this.newSertifikat.nama = sertifikat.nama_peserta;
      this.newSertifikat.skema_sertifikasi = sertifikat.skema_sertifikasi;
      this.dialogFormSertifikatVisible = true;
      this.$nextTick(() => {
        this.$refs['newSertifikatForm'].clearValidate();
      });
    },
    submitNewSertifikat() {
      this.loading = true;
      this.$refs['newSertifikatForm'].validate((valid) => {
        if (valid) {
          const uploadData = new FormData();
          uploadData.append('nama', this.newSertifikat.nama);
          uploadData.append('id_uji_komp', this.newSertifikat.id_uji_komp);
          uploadData.append('no_registrasi', this.newSertifikat.no_registrasi);
          uploadData.append('skema_sertifikasi', this.newSertifikat.skema_sertifikasi);
          uploadData.append('no_sertifikat', this.newSertifikat.no_sertifikat);
          uploadData.append('masa_berlaku', this.newSertifikat.masa_berlaku);
          this.sertifikatCreating = true;
          pemegangSertifikatResource
            .store(uploadData)
            .then(() => {
              // console.log(this.dataTrx);
              this.$message({
                message: 'A new certificate in the name of ' + this.newSertifikat.nama + ' has been created successfully.',
                type: 'success',
                duration: 5 * 1000,
              });
              this.resetNewSertifikat();
              this.dialogFormSertifikatVisible = false;
              this.handleFilter();
            })
            .catch(error => {
              console.log(error);
            })
            .finally(() => {
              this.loading = false;
              this.sertifikatCreating = false;
            });
        } else {
          this.loading = false;
          return false;
        }
      });
    },
    updateDataSertifikat() {
      this.loading = true;
      pemegangSertifikatResource.update(this.editedSertifikat.id, this.editedSertifikat).then(() => {
        this.getList();
        this.dialogFormUpdateSertifikatVisible = false;
        this.$notify({
          title: 'Success',
          message: 'Updated successfully',
          type: 'success',
          duration: 2000,
        });
      })
        .catch(error => {
          console.log(error);
        })
        .finally(() => {
          this.loading = true;
          this.creating = false;
        });
    },

    handleCreate() {
      this.resetnewData();
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs['dataForm'].clearValidate();
      });
    },
    handleDelete(row) {
      this.$confirm(
        'Ini akan menghapus Ujian milik ' + row.nama_peserta + ', semua form pada ujian ini akan dihapus. Lanjutkan?',
        'Warning',
        {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning',
        }
      )
        .then(() => {
          ujiResource
            .destroy(row.id)
            .then((response) => {
              this.$message({
                type: 'success',
                message: 'Delete completed',
              });
              this.handleFilter();
            })
            .catch((error) => {
              console.log(error);
            });
        })
        .catch(() => {
          this.$message({
            type: 'info',
            message: 'Delete canceled',
          });
        });
    },
    create() {
      this.loading = true;
      this.newData.author = this.userId;
      this.$refs['dataForm'].validate((valid) => {
        if (valid) {
          this.creating = true;
          listResource
            .store(this.newData)
            .then(response => {
              this.$message({
                message: 'New TUK ' + this.newData.nama + ' has been created successfully.',
                type: 'success',
                duration: 5 * 1000,
              });
              this.resetnewData();
              this.dialogFormVisible = false;
              this.handleFilter();
            })
            .catch(error => {
              console.log(error);
            })
            .finally(() => {
              this.loading = true;
              this.creating = false;
            });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    showPwd() {
      if (this.pwdType === 'password') {
        this.pwdType = '';
      } else {
        this.pwdType = 'password';
      }
    },
    handleUpdate(tuk) {
      this.editedData = tuk;
      this.dialogFormUpdateVisible = true;
      // console.log(this.editedData);
    },
    updateData() {
      this.loading = true;
      listResource.update(this.editedData.id, this.editedData).then(() => {
        this.getList();
        this.dialogFormUpdateVisible = false;
        this.$notify({
          title: 'Success',
          message: 'Updated successfully',
          type: 'success',
          duration: 2000,
        });
      })
        .catch(error => {
          console.log(error);
        })
        .finally(() => {
          this.loading = true;
          this.creating = false;
        });
    },
    handleDownload() {
      this.downloading = true;
      import('@/vendor/Export2Excel').then(excel => {
        const tHeader = ['Kode', 'Nama', 'Alamat', 'No telp', 'Email'];
        const filterVal = ['kode_tuk', 'nama', 'alamat', 'no_telp', 'email'];
        const data = this.formatJson(filterVal, this.list);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: 'tuk-list', // filename
        });
        this.downloading = false;
      });
    },
    formatJson(filterVal, jsonData) {
      return jsonData.map(v => filterVal.map(j => v[j]));
    },
  },
};
</script>

<style lang="scss" scoped>

.show-pwd {
      position: absolute;
      right: 10px;
      top: 7px;
      font-size: 16px;
      color: darkgray;
      cursor: pointer;
      user-select: none;
    }
.table-expand {
  text-align: center;
  margin-left: 20px;
}
.list-progress {
  text-align: left;
  margin-left: 20px;
}
.el-icon-check {
  font-size: 20px;
  color: green;
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
  margin-left: 0;
}
.app-container {
  flex: 1;
  justify-content: space-between;
  font-size: 14px;
  padding-right: 8px;
  .block {
    float: left;
    min-width: 250px;
  }
  .clear-left {
    clear: left;
  }

  .el-row {
    margin-bottom: 20px;
    &:last-child {
      margin-bottom: 0;
    }
  }
  .link {
    color: #1890ff;
  }
  .el-col {
    border-radius: 4px;
  }
  .bg-purple-dark {
    background: #99a9bf;
  }
  .bg-purple {
    background: #d3dce6;
  }
  .bg-purple-light {
    background: #e5e9f2;
  }
  .grid-content {
    border-radius: 4px;
    min-height: 36px;
  }
  .row-bg {
    padding: 10px 0;
    background-color: #f9fafc;
  }
}
</style>
