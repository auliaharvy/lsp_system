<template>
  <div class="app-container">
    <div class="filter-container">
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
      <el-button
        class="filter-item"
        style="margin-left: 10px;"
        type="primary"
        icon="el-icon-plus"
        @click="handleCreate"
      >
        {{ $t('table.add') }}
      </el-button>
      <el-button
        v-waves
        :loading="downloading"
        class="filter-item"
        type="primary"
        icon="el-icon-download"
        @click="handleDownloadTemplateUnitKompetensi"
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
      <el-table-column label="Skema Sertifikasi">
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
            <br>
            <div class="filter-container">
              <el-row>
                <el-button
                  v-waves
                  :loading="downloading"
                  class="filter-item"
                  type="primary"
                  icon="el-icon-download"
                  @click="handleDownloadTemplateElemen(scope.row.children)"
                >
                  {{ $t('table.export') }} Template Elemen Unit Kompetensi
                </el-button>
              </el-row>
              <el-row>
                <el-button
                  v-waves
                  :loading="downloading"
                  class="filter-item"
                  type="primary"
                  icon="el-icon-download"
                  @click="handleDownloadTemplateKuk(scope.row.children)"
                >
                  {{ $t('table.export') }} Template Kuk
                </el-button>
              </el-row>
            </div>

            <el-table
              v-loading="loading"
              :data="scope.row.children"
              border
              fit
              highlight-current-row
              style="width: 80%"
              :header-cell-style="{ 'text-align': 'center', background: '#C0C0C0', color: 'white' }"
              class="table-child"
            >
              <el-table-column label="Unit Kompetensi">
                <el-table-column
                  align="left"
                  label="Kelompok Pekerjaan"
                >
                  <template slot-scope="elemen">
                    <span>{{ getKelompokPekerjaan(elemen.row.kelompok_pekerjaan) }}</span>
                  </template>
                </el-table-column>

                <el-table-column type="expand">
                  <template slot-scope="row">
                    <el-table
                      v-loading="loading"
                      :data="row.row.elemen"
                      border
                      fit
                      highlight-current-row
                      style="width: 80%"
                      :header-cell-style="{ 'text-align': 'center', background: '#C0C0C0', color: 'white' }"
                      class="table-child"
                    >
                      <el-table-column type="expand">
                        <template slot-scope="kuk">
                          <el-table
                            v-loading="loading"
                            :data="kuk.row.kuk"
                            border
                            fit
                            highlight-current-row
                            style="width: 80%"
                            :header-cell-style="{ 'text-align': 'center', background: '#C0C0C0', color: 'white' }"
                            class="table-child"
                          >
                            <el-table-column
                              align="left"
                              label="Kuk Elemen"
                            >
                              <template slot-scope="elementok">
                                <span>{{ elementok.row.kuk }}</span>
                              </template>
                            </el-table-column>
                            <el-table-column
                              align="left"
                              label="Actions"
                              min-width="150px"
                            >
                              <template slot-scope="elementox">
                                <div
                                  v-if="kuk.row.kuk.length > 0"
                                  style="padding-top: 25px;"
                                >
                                  <el-tooltip
                                    class="item"
                                    effect="dark"
                                    content="Update Kuk Elemen"
                                    placement="top-end"
                                  >
                                    <el-button
                                      v-permission="['manage user']"
                                      type="primary"
                                      size="small"
                                      icon="el-icon-edit-outline"
                                      @click="handleUpdateSkemaUnit(elementox.row, 'kuk')"
                                    />
                                  </el-tooltip>
                                  <el-tooltip
                                    class="item"
                                    effect="dark"
                                    content="Delete Kuk Elemen"
                                    placement="top-end"
                                  >
                                    <el-button
                                      v-permission="['manage user']"
                                      type="danger"
                                      size="small"
                                      icon="el-icon-delete"
                                      @click="deleteKuk(elementox.row)"
                                    />
                                  </el-tooltip>
                                </div>
                              </template>
                            </el-table-column>
                          </el-table>
                        </template>
                      </el-table-column>
                      <el-table-column
                        align="left"
                        label="Elemen"
                      >
                        <template slot-scope="elemen">
                          <span>{{ elemen.row.nama_elemen }}</span>
                        </template>
                      </el-table-column>
                      <el-table-column
                        align="left"
                        label="Actions"
                        min-width="150px"
                      >
                        <template slot-scope="elemen">
                          <el-tooltip
                            class="item"
                            effect="dark"
                            content="Upload Kuk Elemen"
                            placement="top-end"
                          >
                            <el-button
                              v-permission="['manage user']"
                              type="success"
                              size="small"
                              icon="el-icon-upload2"
                              @click="handleUpload(row.row, 'kuk')"
                            />
                          </el-tooltip>
                          <el-tooltip
                            class="item"
                            effect="dark"
                            content="Update Elemen Unit"
                            placement="top-end"
                          >
                            <el-button
                              v-permission="['manage user']"
                              type="primary"
                              size="small"
                              icon="el-icon-edit-outline"
                              @click="handleUpdateSkemaUnit(elemen.row, 'elemen')"
                            />
                          </el-tooltip>
                          <el-tooltip
                            class="item"
                            effect="dark"
                            content="Delete Elemen Unit"
                            placement="top-end"
                          >
                            <el-button
                              v-permission="['manage user']"
                              type="danger"
                              size="small"
                              icon="el-icon-delete"
                              @click="deleteElemen(elemen.row)"
                            />
                          </el-tooltip>
                        </template>
                      </el-table-column>
                    </el-table>
                  </template>
                </el-table-column>
                <el-table-column
                  align="center"
                  label="Kode Unit"
                >
                  <template slot-scope="row">
                    <span>{{ row.row.kode_unit }}</span>
                  </template>
                </el-table-column>
                <el-table-column
                  align="left"
                  label="Unit Kompetensi"
                  min-width="150px"
                >
                  <template slot-scope="row">
                    <span>{{ row.row.unit_kompetensi }}</span>
                  </template>
                </el-table-column>
                <el-table-column
                  align="left"
                  label="Actions"
                  min-width="150px"
                >
                  <template slot-scope="row">
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="Upload Elemen Kompetensi"
                      placement="top-end"
                    >
                      <el-button
                        v-permission="['manage user']"
                        type="success"
                        size="small"
                        icon="el-icon-upload2"
                        @click="handleUpload(scope.row, 'elemen')"
                      />
                    </el-tooltip>
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="Update Unit Kompetensi"
                      placement="top-end"
                    >
                      <el-button
                        v-permission="['manage user']"
                        type="primary"
                        size="small"
                        icon="el-icon-edit-outline"
                        @click="handleUpdateSkemaUnit(scope.row, 'unit')"
                      />
                    </el-tooltip>
                    <el-tooltip
                      class="item"
                      effect="dark"
                      content="Delete Unit Kompetensi"
                      placement="top-end"
                    >
                      <el-button
                        v-permission="['manage user']"
                        type="danger"
                        size="small"
                        icon="el-icon-delete"
                        @click="deleteUnit(row.row)"
                      />
                    </el-tooltip>
                  </template>
                </el-table-column>
              </el-table-column>
            </el-table>
          </template>
        </el-table-column>

        <el-table-column
          align="center"
          :label="$t('skema.table.code')"
          min-width="200px"
        >
          <template slot-scope="scope">
            <span>{{ scope.row.kode_skema }}</span>
          </template>
        </el-table-column>

        <el-table-column
          align="left"
          :label="$t('skema.table.skema')"
          min-width="250px"
        >
          <template slot-scope="scope">
            <span>{{ scope.row.skema_sertifikasi }}</span>
          </template>
        </el-table-column>

        <el-table-column
          align="center"
          :label="$t('skema.table.category')"
          min-width="100px"
        >
          <template slot-scope="scope">
            <span>{{ scope.row.nama_kategori }}</span>
          </template>
        </el-table-column>

        <!-- <el-table-column align="center" :label="$t('skema.table.unit_qty')">
          <template slot-scope="scope">
            <span>{{ scope.row.jumlah_unit_count }}</span>
          </template>
        </el-table-column>

        <el-table-column align="center" :label="$t('skema.table.kblui')">
          <template slot-scope="scope">
            <span>{{ scope.row.kblui }}</span>
          </template>
        </el-table-column>

        <el-table-column align="center" :label="$t('skema.table.kbji')">
          <template slot-scope="scope">
            <span>{{ scope.row.kbji }}</span>
          </template>
        </el-table-column> -->

        <el-table-column
          align="center"
          :label="$t('skema.table.jenjang')"
        >
          <template slot-scope="scope">
            <span>{{ scope.row.jenjang }}</span>
          </template>
        </el-table-column>

        <el-table-column
          align="center"
          :label="$t('skema.table.sector_code')"
          min-width="80px"
        >
          <template slot-scope="scope">
            <span>{{ scope.row.kode_sektor }}</span>
          </template>
        </el-table-column>

        <!-- <el-table-column align="center" :label="$t('skema.table.visibility')">
          <template slot-scope="scope">
            <span>{{ scope.row.visibilitas }}</span>
          </template>
        </el-table-column> -->

        <el-table-column
          align="center"
          label="Actions"
          min-width="120"
        >
          <template slot-scope="scope">
            <el-button-group>
              <el-tooltip
                class="item"
                effect="dark"
                content="Upload Unit Kompetensi"
                placement="top-end"
              >
                <el-button
                  v-permission="['manage user']"
                  type="success"
                  size="small"
                  icon="el-icon-upload2"
                  @click="handleUpload(scope.row, 'unit')"
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
                  type="primary"
                  size="small"
                  icon="el-icon-edit-outline"
                  @click="handleUpdate(scope.row)"
                />
              </el-tooltip>
              <el-tooltip
                class="item"
                effect="dark"
                content="List Perangkat"
                placement="top-end"
              >
                <router-link :to="{ name: 'PerangkatSkemaList', params: { id_skema: scope.row.id, skema: scope.row.skema_sertifikasi }}">
                  <el-button
                    v-permission="['manage user']"
                    type="warning"
                    size="small"
                    icon="el-icon-view"
                  />
                </router-link>
              </el-tooltip>
            </el-button-group>
          </template>
        </el-table-column>
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
      :title="$t('skema.dialog.addNew')"
      :visible.sync="dialogFormVisible"
    >
      <div
        v-loading="creating"
        class="form-container"
      >
        <el-form
          ref="skemaForm"
          :rules="rules"
          :model="newSkema"
          label-position="left"
          label-width="150px"
          style="max-width: 500px;"
        >
          <el-form-item
            :label="$t('skema.table.code')"
            prop="kode_skema"
          >
            <el-input v-model="newSkema.kode_skema" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.table.skema')"
            prop="skema_sertifikasi"
          >
            <el-input v-model="newSkema.skema_sertifikasi" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.table.category')"
            prop="kategori_id"
          >
            <el-select
              v-model="newSkema.kategori_id"
              filterable
              clearable
              class="filter-item full"
              :placeholder="$t('skema.table.category')"
            >
              <el-option
                v-for="item in kategori"
                :key="item.id"
                :label="item.nama"
                :value="item.id"
              />
            </el-select>
          </el-form-item>
          <el-form-item
            :label="$t('skema.table.unit_qty')"
            prop="jumlah_unit"
          >
            <el-input v-model="newSkema.jumlah_unit" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.table.kblui')"
            prop="kblui"
          >
            <el-input v-model="newSkema.kblui" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.table.kbji')"
            prop="kbji"
          >
            <el-input v-model="newSkema.kbji" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.table.jenjang')"
            prop="jenjang"
          >
            <el-input v-model="newSkema.jenjang" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.table.sector_code')"
            prop="kode_sektor"
          >
            <el-input v-model="newSkema.kode_sektor" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.table.visibility')"
            prop="visibilitas"
          >
            <el-input v-model="newSkema.visibilitas" />
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
            @click="createSkema()"
          >
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>

    <el-dialog
      :title="$t('skema.dialog.edit') + ' ' + editedSkema.skema_sertifikasi"
      :visible.sync="dialogFormUpdateVisible"
    >
      <div
        v-loading="creating"
        class="form-container"
      >
        <el-form
          ref="skemaForm"
          :rules="rules"
          :model="editedSkema"
          label-position="left"
          label-width="150px"
          style="max-width: 500px;"
        >
          <el-form-item
            :label="$t('skema.table.code')"
            prop="kode_skema"
          >
            <el-input v-model="editedSkema.kode_skema" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.table.skema')"
            prop="skema_sertifikasi"
          >
            <el-input v-model="editedSkema.skema_sertifikasi" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.table.category')"
            prop="kategori_id"
          >
            <el-select
              v-model="editedSkema.kategori_id"
              filterable
              clearable
              class="filter-item full"
              :placeholder="$t('skema.table.category')"
            >
              <el-option
                v-for="item in kategori"
                :key="item.id"
                :label="item.nama"
                :value="item.id"
              />
            </el-select>
          </el-form-item>
          <!-- <el-form-item :label="$t('skema.table.unit_qty')" prop="jumlah_unit">
            <el-input v-model="editedSkema.jumlah_unit" />
          </el-form-item> -->
          <el-form-item
            :label="$t('skema.table.kblui')"
            prop="kblui"
          >
            <el-input v-model="editedSkema.kblui" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.table.kbji')"
            prop="kbji"
          >
            <el-input v-model="editedSkema.kbji" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.table.jenjang')"
            prop="jenjang"
          >
            <el-input v-model="editedSkema.jenjang" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.table.sector_code')"
            prop="kode_sektor"
          >
            <el-input v-model="editedSkema.kode_sektor" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.table.visibility')"
            prop="visibilitas"
          >
            <el-input v-model="editedSkema.visibilitas" />
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

    <el-dialog
      :title="$t('skema.dialog.upload') + ' Unit Skema'"
      :visible.sync="dialogUploadUnitVisible"
      fullscreen
    >
      <div class="app-container">
        <el-row :gutter="20">
          <el-col :span="10">
            <div class="grid-content bg-purple">
              <el-descriptions title="Skema Sertifikasi">
                <el-descriptions-item label="Kode Skema">
                  {{ editedSkema.kode_skema }}
                </el-descriptions-item>
                <el-descriptions-item label="Skema">
                  {{ editedSkema.skema_sertifikasi }}
                </el-descriptions-item>
                <el-descriptions-item label="Kategori">
                  {{ editedSkema.nama_kategori }}
                </el-descriptions-item>
                <el-descriptions-item label="KBLUI">
                  {{ editedSkema.kblui }}
                </el-descriptions-item>
                <el-descriptions-item label="KBJI">
                  {{ editedSkema.kbji }}
                </el-descriptions-item>
                <el-descriptions-item label="Jenjang">
                  {{ editedSkema.jenjang }}
                </el-descriptions-item>
                <el-descriptions-item label="Kode Sektor">
                  {{ editedSkema.kode_sektor }}
                </el-descriptions-item>
              </el-descriptions>
            </div>
          </el-col>
          <el-col :span="10">
            <div class="grid-content bg-purple">
              <upload-excel-component
                :on-success="handleSuccess"
                :before-upload="beforeUpload"
              />
            </div>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :span="10">
            <div class="grid-content bg-purple">
              <el-button
                type="primary"
                @click="uploadData()"
              >
                Upload
              </el-button>
            </div>
          </el-col>
        </el-row>
        <span>{{ uploadTableData[0] }}</span>
        <el-table
          :data="uploadTableData"
          border
          highlight-current-row
          style="width: 100%;margin-top:20px;"
        >
          <el-table-column
            v-for="item of uploadTableHeader"
            :key="item"
            :prop="item"
            :label="item"
          />
        </el-table>
      </div>
    </el-dialog>
    <el-dialog
      :title="$t('skema.dialog.edit') + ' Unit Skema'"
      :visible.sync="dialogUpdateUnitVisible"
      fullscreen
    >
      <div class="app-container">
        <el-row :gutter="20">
          <el-col :span="10">
            <div class="grid-content bg-purple">
              <upload-excel-component
                :on-success="handleSuccess"
                :before-upload="beforeUpload"
              />
            </div>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :span="10">
            <div class="grid-content bg-purple">
              <el-button
                type="primary"
                @click="updateUnit()"
              >
                Update
              </el-button>
            </div>
          </el-col>
        </el-row>
        <span>{{ uploadTableData[0] }}</span>
        <el-table
          :data="uploadTableData"
          border
          highlight-current-row
          style="width: 100%;margin-top:20px;"
        >
          <el-table-column
            v-for="item of uploadTableHeader"
            :key="item"
            :prop="item"
            :label="item"
          />
        </el-table>
      </div>
    </el-dialog>
    <el-dialog
      :title="$t('skema.dialog.addNew')"
      :visible.sync="dialogSkemaUnitVisible"
    >
      <div
        v-loading="creating"
        class="form-container"
      >
        <el-form
          ref="newForm"
          :rules="rules"
          :model="dataTrx"
          label-position="left"
          label-width="150px"
          style="max-width: 500px;"
        >
          <el-form-item
            :label="$t('skema.dialog.kode_unit')"
            prop="kode_unit"
          >
            <el-input v-model="editedUnitKomp.kode_unit" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.dialog.unit_kompetensi')"
            prop="unit_kompetensi"
          >
            <el-input v-model="editedUnitKomp.unit_kompetensi" />
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
            @click="submit()"
          >
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>
    <el-dialog
      :title="$t('skema.dialog.updateUnit')"
      :visible.sync="dialogSkemaUnitVisible"
    >
      <div
        v-loading="creating"
        class="form-container"
      >
        <el-form
          ref="unitForm"
          :rules="unitRules"
          :model="editedUnitKomp"
          label-position="left"
          label-width="150px"
          style="max-width: 500px;"
        >
          <el-form-item
            :label="$t('skema.dialog.kode_unit')"
            prop="kode_unit"
          >
            <el-input v-model="editedUnitKomp.kode_unit" />
          </el-form-item>
          <el-form-item
            :label="$t('skema.dialog.unit_kompetensi')"
            prop="unit_kompetensi"
          >
            <el-input v-model="editedUnitKomp.unit_kompetensi" />
          </el-form-item>
        </el-form>
        <div
          slot="footer"
          class="dialog-footer"
        >
          <el-button @click="dialogSkemaUnitVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button
            type="primary"
            @click="updateUnit()"
          >
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>
    <el-dialog
      :title="$t('skema.dialog.updateElemen')"
      :visible.sync="dialogSkemaElemenVisible"
    >
      <div
        v-loading="creating"
        class="form-container"
      >
        <el-form
          ref="elemenForm"
          :rules="elemenRules"
          :model="editedElemen"
          label-position="left"
          label-width="150px"
          style="max-width: 500px;"
        >
          <el-form-item
            :label="$t('skema.dialog.elemen')"
            prop="nama_elemen"
          >
            <el-input v-model="editedElemen.nama_elemen" />
          </el-form-item>
        </el-form>
        <div
          slot="footer"
          class="dialog-footer"
        >
          <el-button @click="dialogSkemaElemenVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button
            type="primary"
            @click="updateUnit()"
          >
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>
    <el-dialog
      :title="$t('skema.dialog.updateKuk')"
      :visible.sync="dialogSkemaKukVisible"
    >
      <div
        v-loading="creating"
        class="form-container"
      >
        <el-form
          ref="kukForm"
          :rules="kukRules"
          :model="editedKuk"
          label-position="left"
          label-width="150px"
          style="max-width: 500px;"
        >
          <el-form-item
            :label="$t('skema.dialog.kuk')"
            prop="kuk"
          >
            <el-input v-model="editedKuk.kuk" />
          </el-form-item>
        </el-form>
        <div
          slot="footer"
          class="dialog-footer"
        >
          <el-button @click="dialogSkemaKukVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button
            type="primary"
            @click="updateUnit()"
          >
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import UploadExcelComponent from '@/components/UploadExcel/index.vue';
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import UserResource from '@/api/user';
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import permission from '@/directive/permission'; // Permission directive

const userResource = new UserResource();
const skemaResource = new Resource('skema');
const kategoriResource = new Resource('skema/kategori');
const uploadUnitResource = new Resource('skema/upload/unit');
const uploadElemenUnitResource = new Resource('skema/upload/elemen');
const uploadKukResource = new Resource('skema/upload/kuk');
const updateUnitResource = new Resource('skema/update/unit');
const updateElemenUnitResource = new Resource('skema/update/elemen');
const updateKukResource = new Resource('skema/update/kuk');
const deleteUnitResource = new Resource('skema/unit');
const deleteElemenResource = new Resource('skema/elemen');
const deleteKukResource = new Resource('skema/kuk');
let nameKelompokPekerjaan = ''
let counterKelompokPekerjaan = 0

export default {
  name: 'SkemaList',
  components: { Pagination, UploadExcelComponent },
  directives: { waves, permission },
  data() {
    return {
      list: null,
      total: 0,
      loading: true,
      downloading: false,
      creating: false,
      dialogFormVisible: false,
      dialogFormUpdateVisible: false,
      dialogUploadUnitVisible: false,
      dialogUpdateUnitVisible: false,
      dialogSkemaUnitVisible: false,
      dialogSkemaElemenVisible: false,
      dialogSkemaKukVisible: false,
      jenisUpload: false,
      kategori: [],
      uploadTableData: [],
      uploadTableHeader: [],
      kukTemplateData: [],
      id_skema: null,
      newSkema: {},
      dataTrx: {},
      editedUnitKomp: {
        id: 0,
        id_skema: '',
        kode_unit: '',
        unit_kompetensi: '',
      },
      editedElemen: {
        id: 0,
        id_unit: '',
        nama_elemen: '',
        benchmark: '',
      },
      editedKuk: [
        {
          id: 0,
          kuk: '',
        },
      ],
      editedSkema: {
        id: 0,
        kode_skema: '',
        skema_sertifikasi: '',
        kategori_id: '',
        jumlah_unit: '',
        kblui: '',
        kbji: '',
        jenjang: '',
        kode_sektor: '',
        visibilitas: '',
      },
      query: {
        page: 1,
        limit: 15,
        keyword: '',
      },
      rules: {
        kode_skema: [{ required: true, message: 'Kode Skema is required', trigger: 'change' }],
        skema_sertifikasi: [{ required: true, message: 'Skema Sertifikasi is required', trigger: 'blur' }],
        kategori_id: [{ required: true, message: 'Kategori Skema is required', trigger: 'blur' }],
        // jumlah_unit: [{ required: true, message: 'Jumlah Unit is required', trigger: 'blur' }],
        kblui: [{ required: true, message: 'KBLUI is required', trigger: 'blur' }],
        kbji: [{ required: true, message: 'KBJI is required', trigger: 'blur' }],
        jenjang: [{ required: true, message: 'Jenjang is required', trigger: 'blur' }],
        kode_sektor: [{ required: true, message: 'Kode Sektor is required', trigger: 'blur' }],
        visibilitas: [{ required: true, message: 'Visibilitas is required', trigger: 'blur' }],
      },
      unitRules: {
        kode_unit: [{ required: true, message: 'Kode Unit is required', trigger: 'blur' }],
        unit_kompetensi: [{ required: true, message: 'Unit Kompetensi is required', trigger: 'blur' }],
      },
      elemenRules: {
        nama_elemen: [{ required: true, message: 'Nama Elemen is required', trigger: 'blur' }],
      },
      kukRules: {
        kuk: [{ required: true, message: 'Kuk Elemen is required', trigger: 'blur' }],
      },
    };
  },
  created() {
    this.getList();
    this.getListKategori();
  },
  methods: {
    getKelompokPekerjaan(val){
      if(counterKelompokPekerjaan == 0) nameKelompokPekerjaan = val
      val == nameKelompokPekerjaan ? counterKelompokPekerjaan++ : counterKelompokPekerjaan = 0
      return counterKelompokPekerjaan > 0 ? '' : val
    },
    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      const { data, meta } = await skemaResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.total = meta.total;
      this.loading = false;
    },
    async getListKategori() {
      const { limit, page } = this.query;
      this.loading = true;
      const { data } = await kategoriResource.list();
      this.kategori = data;
      this.kategori.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.loading = false;
    },
    beforeUpload(file) {
      const isLt1M = file.size / 1024 / 1024 < 1;

      if (isLt1M) {
        return true;
      }

      this.$message({
        message: 'Please do not upload files larger than 1m in size.',
        type: 'warning',
      });
      return false;
    },
    handleSuccess({ results, header }) {
      this.uploadTableData = results;
      this.uploadTableHeader = header;
    },
    handleFilter() {
      this.query.page = 1;
      this.getList();
    },
    resetNewSkema() {
      this.newSkema = {};
    },
    resetUpload() {
      this.uploadTableData = [];
      this.uploadTableHeader = [];
      this.editedSkema = {};
    },
    resetUpdateUnit() {
      this.uploadTableData = [];
      this.uploadTableHeader = [];
      this.unitKompetensi = null;
      this.elemenKompetensi = null;
      this.kukElemen = null;
    },
    handleCreate() {
      this.resetNewSkema();
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs['skemaForm'].clearValidate();
      });
    },
    handleDelete(id, name) {
      this.$confirm('This will permanently delete user ' + name + '. Continue?', 'Warning', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(() => {
        userResource.destroy(id).then(response => {
          this.$message({
            type: 'success',
            message: 'Delete completed',
          });
          this.handleFilter();
        }).catch(error => {
          console.log(error);
        });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: 'Delete canceled',
        });
      });
    },
    deleteSkema(data){
      console.log(data);
      this.$confirm('Ini akan menghapus semua beberapa data skema sertifikasi, anda yakin?').then(() => {
        skemaResource.destroy(data.id).then(() => {
          this.getList();
          this.$notify({
            title: 'Success',
            message: 'Delete successfully',
            type: 'success',
            duration: 2000,
          });
        })
          .catch(error => {
            console.log(error);
          });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: 'Delete canceled',
        });
      });
    },
    deleteUnit(data){
      console.log(data);
      this.$confirm('Ini akan menghapus semua unit elemen, apakah kamu yakin?').then(() => {
        deleteUnitResource.destroy(data.id).then(() => {
          this.getList();
          this.$notify({
            title: 'Success',
            message: 'Delete successfully',
            type: 'success',
            duration: 2000,
          });
        })
          .catch(error => {
            console.log(error);
          });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: 'Delete canceled',
        });
      });
    },
    deleteElemen(data){
      console.log(data);
      this.$confirm('Ini akan menghapus semua elemen unit, apakah kamu yakin?').then(() => {
        deleteElemenResource.destroy(data.id_elemen).then(() => {
          this.getList();
          this.$notify({
            title: 'Success',
            message: 'Delete successfully',
            type: 'success',
            duration: 2000,
          });
        })
          .catch(error => {
            console.log(error);
          });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: 'Delete canceled',
        });
      });
    },
    deleteKuk(data){
      console.log(data);
      this.$confirm('Ini akan menghapus semua kuk elemen, apakah kamu yakin?').then(() => {
        deleteKukResource.destroy(data.id).then(() => {
          this.getList();
          this.$notify({
            title: 'Success',
            message: 'Delete successfully',
            type: 'success',
            duration: 2000,
          });
        })
          .catch(error => {
            console.log(error);
          });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: 'Delete canceled',
        });
      });
    },
    createSkema() {
      this.loading = true;
      this.$refs['skemaForm'].validate((valid) => {
        if (valid) {
          this.creating = true;
          skemaResource
            .store(this.newSkema)
            .then(response => {
              this.$message({
                message: 'New Skema ' + this.newSkema.nama + ' has been created successfully.',
                type: 'success',
                duration: 5 * 1000,
              });
              this.resetNewSkema();
              this.dialogFormVisible = false;
              this.handleFilter();
            })
            .catch(error => {
              console.log(error);
            })
            .finally(() => {
              this.loading = false;
              this.creating = false;
            });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    handleUpdate(skema) {
      this.editedSkema = skema;
      this.dialogFormUpdateVisible = true;
      // console.log(this.editedSkema);
    },
    handleUpdateSkemaUnit(data, jenisUpdate) {
      this.jenisUpload = jenisUpdate;
      if (this.jenisUpload === 'unit'){
        this.editedUnitKomp = data;
        this.dialogSkemaUnitVisible = true;
      }
      if (this.jenisUpload === 'elemen'){
        this.editedElemen = data;
        this.dialogSkemaElemenVisible = true;
      }
      if (this.jenisUpload === 'kuk'){
        this.editedKuk = data;
        console.log(this.editedKuk);
        this.dialogSkemaKukVisible = true;
      }
    },
    handleUpload(data, jenisUpdate) {
      this.jenisUpload = jenisUpdate;
      if (this.jenisUpload === 'unit'){
        this.editedUnitKomp = data;
        this.dialogUploadUnitVisible = true;
      }
      if (this.jenisUpload === 'elemen'){
        this.editedElemen = data;
        this.dialogUploadUnitVisible = true;
      }
      if (this.jenisUpload === 'kuk'){
        this.editedKuk = data;
        console.log(this.editedKuk);
        this.dialogUploadUnitVisible = true;
      }
    },
    updateData() {
      this.loading = true;
      skemaResource.update(this.editedSkema.id, this.editedSkema).then(() => {
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
          this.loading = false;
          this.creating = false;
        });
    },
    uploadData() {
      this.loading = true;
      if (this.jenisUpload === 'unit') {
        var uploadData = {
          id_skema: this.editedUnitKomp.id,
          unit: this.uploadTableData,
        };
        uploadUnitResource.store(uploadData).then(() => {
          this.getList();
          this.dialogUploadUnitVisible = false;
          this.resetUpload();
          this.$notify({
            title: 'Success',
            message: 'Upload successfully',
            type: 'success',
            duration: 2000,
          });
        })
          .catch(error => {
            console.log(error);
          })
          .finally(() => {
            this.loading = false;
            this.creating = false;
          });
      }
      if (this.jenisUpload === 'elemen') {
        var uploadElemen = {
          id_skema: this.editedElemen.id,
          elemen: this.uploadTableData,
        };
        console.log(uploadElemen);
        uploadElemenUnitResource.store(uploadElemen).then(() => {
          this.getList();
          this.dialogUploadUnitVisible = false;
          this.resetUpload();
          this.$notify({
            title: 'Success',
            message: 'Upload successfully',
            type: 'success',
            duration: 2000,
          });
        })
          .catch(error => {
            console.log(error);
          })
          .finally(() => {
            this.loading = false;
            this.creating = false;
          });
      }
      if (this.jenisUpload === 'kuk') {
        uploadKukResource.store(this.uploadTableData).then(() => {
          this.getList();
          this.dialogUploadUnitVisible = false;
          this.resetUpload();
          this.$notify({
            title: 'Success',
            message: 'Upload successfully',
            type: 'success',
            duration: 2000,
          });
        })
          .catch(error => {
            console.log(error);
          })
          .finally(() => {
            this.loading = false;
            this.creating = false;
          });
      }
    },
    updateUnit() {
      this.loading = true;
      if (this.jenisUpload === 'unit') {
        console.log('unit blabal');
        console.log(this.editedUnitKomp);
        updateUnitResource.store(this.editedUnitKomp).then(() => {
          this.getList();
          this.dialogSkemaUnitVisible = false;
          this.resetUpdateUnit();
          this.$notify({
            title: 'Success',
            message: 'Update successfully',
            type: 'success',
            duration: 2000,
          });
        })
          .catch(error => {
            console.log(error);
          })
          .finally(() => {
            this.loading = false;
            this.creating = false;
          });
      }
      if (this.jenisUpload === 'elemen') {
        updateElemenUnitResource.store(this.editedElemen).then(() => {
          this.getList();
          this.dialogSkemaElemenVisible = false;
          this.resetUpdateUnit();
          this.$notify({
            title: 'Success',
            message: 'Update successfully',
            type: 'success',
            duration: 2000,
          });
        })
          .catch(error => {
            console.log(error);
          })
          .finally(() => {
            this.loading = false;
            this.creating = false;
          });
      }
      if (this.jenisUpload === 'kuk') {
        console.log(this.editedKuk);
        updateKukResource.store(this.editedKuk).then(() => {
          this.getList();
          this.dialogSkemaKukVisible = false;
          this.resetUpdateUnit();
          this.$notify({
            title: 'Success',
            message: 'Upload successfully',
            type: 'success',
            duration: 2000,
          });
        })
          .catch(error => {
            console.log(error);
          })
          .finally(() => {
            this.loading = false;
            this.creating = false;
          });
      }
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
          filename: 'tuk-list',
        });
        this.downloading = false;
      });
    },
    handleDownloadTemplateUnitKompetensi() {
      this.downloading = true;
      import('@/vendor/Export2Excel').then(excel => {
        const tHeader = ['id_skema', 'skema_sertifikasi', 'kode_unit', 'unit_kompetensi'];
        const filterVal = ['id', 'skema_sertifikasi', 'kode_unit', 'unit_kompetensi'];
        const data = this.formatJson(filterVal, this.list);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: 'template import element unit',
        });
        this.downloading = false;
      });
    },
    handleDownloadTemplateElemen(list) {
      this.downloading = true;
      import('@/vendor/Export2Excel').then(excel => {
        const tHeader = ['kode_unit', 'unit_kompetensi', 'nama_elemen'];
        const filterVal = ['kode_unit', 'unit_kompetensi'];
        const data = this.formatJson(filterVal, list);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: 'Template Upload Elemen unit skema',
        });
        this.downloading = false;
      });
    },
    handleDownloadTemplateKuk(list) {
      // console.log(list);
      var dataDownload = [];
      for (var i = 0; i < list.length; i++) {
        var elemen = list[i].elemen;
        for (var x = 0; x < elemen.length; x++) {
          // console.log(elemen[x]);
          dataDownload.push(elemen[x]);
        }
        // console.log(dataDownload);
      }
      // console.log(dataDownload);
      this.downloading = true;
      import('@/vendor/Export2Excel').then(excel => {
        const tHeader = ['id_elemen', 'nama_elemen', 'kuk'];
        const filterVal = ['id_elemen', 'nama_elemen'];
        const data = this.formatJson(filterVal, dataDownload);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: 'Template Upload KUK Elemen',
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
.table-child {
  align-items: center;
  text-align: center;
}
.grid-content {
  border-radius: 4px;
  min-height: 36px;
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
  .block {
    float: left;
    min-width: 250px;
  }
  .clear-left {
    clear: left;
  }
}
</style>
