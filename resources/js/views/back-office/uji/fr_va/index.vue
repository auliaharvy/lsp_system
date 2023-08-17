<template>
  <el-container class="app-container">
    <vue-html2pdf
      ref="html2Pdf"
      :show-layout="false"
      :float-layout="true"
      :enable-download="true"
      :preview-modal="true"
      :paginate-elements-by-height="1100"
      :filename="fileName"
      :pdf-quality="2"
      :manual-pagination="true"
      pdf-format="a4"
      pdf-orientation="portrait"
      pdf-content-width="100%"
      @hasStartedGeneration="hasStartedGeneration()"
      @hasGenerated="hasGenerated($event)"
    />

    <el-header>
      <el-page-header content="FR.VA MEMBERIKAN KONTRIBUSI DALAM VALIDASI ASESMEN" @back="$router.back()" />
    </el-header>
    <el-main>
      <div>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="12">
            <el-form ref="form" :model="dataTrx" label-width="120px">
              <el-form-item label="Tim Validas 1">
                <el-input v-model="dataTrx.tim_validasi_1" />
              </el-form-item>
              <el-form-item label="Tim Validasi 2">
                <el-input v-model="dataTrx.tim_validasi_2" />
              </el-form-item>
            </el-form>
          </el-col>
          <el-col :sm="24" :md="24" :lg="12">
            <el-form ref="form" :model="dataTrx" label-width="120px">
              <el-form-item label="Hari / Tanggal">
                <!-- <span>{{ dataTrx.hari }} / {{ dataTrx.tanggal }} - {{ dataTrx.bulan }} - {{ dataTrx.tahun }}</span> -->
                <el-date-picker v-model="dataTrx.date" type="date" placeholder="Pilih hari dan tanggal" style="width: 100%;" />
              </el-form-item>
              <el-form-item label="Tempat">
                <span>{{ dataTrx.tempat }}</span>
                <!-- <el-date-picker v-model="dataTrx.date" type="date" placeholder="Pilih hari dan tanggal" style="width: 100%;" /> -->
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-form ref="form" :model="dataTrx" label-width="120px">
              <el-form-item label="Periode">
                <el-select
                  v-model="dataTrx.periode"
                  filterable
                  clearable
                  class="filter-item full"
                  placeholder="pilih periode"
                  style="width: 100%;"
                >
                  <el-option
                    v-for="item in masterData.periode"
                    :key="item.id"
                    :label="item.nama"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-form ref="form" :model="dataTrx" label-width="120px">
              <el-form-item label="Nama Skema">
                <span>{{ dataTrx.namaSkema }}</span>
              </el-form-item>
              <el-form-item label="No Skema">
                <span>{{ dataTrx.noSkema }}</span>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <h4>Bagian 1 : Menyiapkan proses validasi</h4>
        <br>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-form ref="form" :model="dataTrx" label-width="200px">
              <el-form-item label="Tujuan dan fokus validasi">
                <el-select
                  v-model="dataTrx.tujuan_dan_fokus_validasi"
                  filterable
                  clearable
                  class="filter-item full"
                  placeholder="pilih tujuan validasi"
                  style="width: 100%;"
                >
                  <el-option
                    v-for="item in masterData.tujuan"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
              <el-form-item label="Konteks validasi">
                <el-select
                  v-model="dataTrx.konteks_validasi"
                  filterable
                  clearable
                  class="filter-item full"
                  placeholder="pilih konteks validasi"
                  style="width: 100%;"
                >
                  <el-option
                    v-for="item in masterData.konteks"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
              <el-form-item label="Pendekatan validasi">
                <el-select
                  v-model="dataTrx.pendekatan_validasi"
                  filterable
                  clearable
                  class="filter-item full"
                  placeholder="pilih Pendekatan validasi"
                  style="width: 100%;"
                >
                  <el-option
                    v-for="item in masterData.pendekatan"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
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
              <el-table-column align="center" min-width="200px" label="Nama">
                <template slot-scope="scope">
                  <template v-if="scope.row.no === 1">
                    <el-form ref="form" :model="dataTrx" label-width="20px">
                      <el-form-item label="1">
                        <el-select v-model="dataTrx.asesor_1" filterable placeholder="Select" style="width: 100%">
                          <el-option
                            v-for="item in listAsesor"
                            :key="item.id"
                            :label="item.nama"
                            :value="item.id"
                          />
                        </el-select>
                      </el-form-item>
                      <el-form-item label="2">
                        <el-select v-model="dataTrx.asesor_2" filterable placeholder="Select" style="width: 100%">
                          <el-option
                            v-for="item in listAsesor"
                            :key="item.id"
                            :label="item.nama"
                            :value="item.id"
                          />
                        </el-select>
                      </el-form-item>
                      <el-form-item label="3">
                        <el-select v-model="dataTrx.asesor_3" filterable placeholder="Select" style="width: 100%">
                          <el-option
                            v-for="item in listAsesor"
                            :key="item.id"
                            :label="item.nama"
                            :value="item.id"
                          />
                        </el-select>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 2">
                    <el-form ref="form" :model="dataTrx" label-width="20px">
                      <el-form-item>
                        <el-select v-model="dataTrx.lead_asesor" filterable placeholder="Select" style="width: 100%">
                          <el-option
                            v-for="item in listAsesor"
                            :key="item.id"
                            :label="item.nama"
                            :value="item.id"
                          />
                        </el-select>
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 3">
                    <el-form ref="form" :model="dataTrx" label-width="20px">
                      <el-form-item>
                        <el-input v-model="dataTrx.manager" />
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 4">
                    <el-form ref="form" :model="dataTrx" label-width="20px">
                      <el-form-item>
                        <el-input v-model="dataTrx.tenaga_ahli" />
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 5">
                    <el-form ref="form" :model="dataTrx" label-width="20px">
                      <el-form-item>
                        <el-input v-model="dataTrx.koordinator_pelatihan" />
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 6">
                    <el-form ref="form" :model="dataTrx" label-width="20px">
                      <el-form-item>
                        <el-input v-model="dataTrx.anggota_asosiasi" />
                      </el-form-item>
                    </el-form>
                  </template>
                </template>
              </el-table-column>
              <el-table-column align="left" min-width="200px" label="Hasil Konfirmasi/diskusi tujuan, fokus & konteks">
                <template slot-scope="scope">
                  <template v-if="scope.row.no === 1">
                    <el-form ref="form" :model="dataTrx" label-width="20px">
                      <el-form-item label="1">
                        <el-input v-model="dataTrx.hasil_konfirmasi_asesor_1" />
                      </el-form-item>
                      <el-form-item label="2">
                        <el-input v-model="dataTrx.hasil_konfirmasi_asesor_2" />
                      </el-form-item>
                      <el-form-item label="3">
                        <el-input v-model="dataTrx.hasil_konfirmasi_asesor_3" />
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 2">
                    <el-form ref="form" :model="dataTrx" label-width="20px">
                      <el-form-item>
                        <el-input v-model="dataTrx.hasil_konfirmasi_lead_asesor" />
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 3">
                    <el-form ref="form" :model="dataTrx" label-width="20px">
                      <el-form-item>
                        <el-input v-model="dataTrx.hasil_konfirmasi_manager" />
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 4">
                    <el-form ref="form" :model="dataTrx" label-width="20px">
                      <el-form-item>
                        <el-input v-model="dataTrx.hasil_konfirmasi_tenaga_ahli" />
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 5">
                    <el-form ref="form" :model="dataTrx" label-width="20px">
                      <el-form-item>
                        <el-input v-model="dataTrx.hasil_konfirmasi_koordinator_pelatihan" />
                      </el-form-item>
                    </el-form>
                  </template>
                  <template v-if="scope.row.no === 6">
                    <el-form ref="form" :model="dataTrx" label-width="20px">
                      <el-form-item>
                        <el-input v-model="dataTrx.hasil_konfirmasi_anggota_asosiasi" />
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
            <el-form ref="form" :model="dataTrx" label-width="200px">
              <el-form-item label="Acuan Pembanding">
                <el-select
                  v-model="dataTrx.acuan_pembanding"
                  filterable
                  clearable
                  class="filter-item full"
                  placeholder="pilih tujuan validasi"
                  style="width: 100%;"
                >
                  <el-option
                    v-for="item in masterData.acuanPembanding"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-form ref="form" :model="dataTrx" label-width="200px">
              <el-form-item label="Dokumen Terkait dan Bahan - Bahan">
                <el-select
                  v-model="dataTrx.dokumen_terkait"
                  filterable
                  clearable
                  class="filter-item full"
                  placeholder="pilih tujuan validasi"
                  style="width: 100%;"
                >
                  <el-option
                    v-for="item in masterData.dokumenTerkait"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <h4>Bagian 2 : Memberikan kontribusi dalam proses validasi</h4>
        <br>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-form ref="form" :model="dataTrx" label-width="200px">
              <el-form-item label="Keterampilan Komunikasi">
                <el-select
                  v-model="dataTrx.keterampilan_komunikasi"
                  filterable
                  clearable
                  class="filter-item full"
                  placeholder="pilih Keterampilan Komunikasi"
                  style="width: 100%;"
                >
                  <el-option
                    v-for="item in masterData.keterampilanKomunikasi"
                    :key="item"
                    :label="item"
                    :value="item"
                  />
                </el-select>
              </el-form-item>
            </el-form>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :sm="24" :md="24" :lg="24">
            <el-table
              v-loading="loading"
              :data="masterData.aspekAspekKegiatan"
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
                      <el-checkbox v-model="row.aturanV" />
                    </template>
                  </el-table-column>
                  <el-table-column align="center" min-width="10px" label="A">
                    <template slot-scope="{row}">
                      <el-checkbox v-model="row.aturanA" />
                    </template>
                  </el-table-column>
                  <el-table-column align="center" min-width="10px" label="T">
                    <template slot-scope="{row}">
                      <el-checkbox v-model="row.aturanT" />
                    </template>
                  </el-table-column>
                  <el-table-column align="center" min-width="10px" label="M">
                    <template slot-scope="{row}">
                      <el-checkbox v-model="row.aturanM" />
                    </template>
                  </el-table-column>
                </el-table-column>
                <el-table-column label="Prinsip Asesmen">
                  <el-table-column align="center" min-width="10px" label="V">
                    <template slot-scope="{row}">
                      <el-checkbox v-model="row.prinsipV" />
                    </template>
                  </el-table-column>
                  <el-table-column align="center" min-width="10px" label="R">
                    <template slot-scope="{row}">
                      <el-checkbox v-model="row.prinsipR" />
                    </template>
                  </el-table-column>
                  <el-table-column align="center" min-width="10px" label="F">
                    <template slot-scope="{row}">
                      <el-checkbox v-if="row.item === 'Proses pengambilan keputusan'" v-model="row.prinsipF" :disabled="true" />
                      <el-checkbox v-else v-model="row.prinsipF" />
                    </template>
                  </el-table-column>
                  <el-table-column align="center" min-width="10px" label="F">
                    <template slot-scope="{row}">
                      <el-checkbox v-model="row.prinsipF2" />
                    </template>
                  </el-table-column>
                </el-table-column>
              </el-table-column>
            </el-table>
          </el-col>
        </el-row>
        <h4>Bagian 3 : Memberikan kontribusi untuk hasil asesmen</h4>
        <br>
        <el-button class="filter-item" style="margin-left: 10px;" type="primary" icon="el-icon-plus" @click="addTemuan">
          {{ $t('table.add') }}
        </el-button>
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
                  <el-input v-model="row.temuan" type="textarea" />
                </template>
              </el-table-column>
              <el-table-column align="left" min-width="80px" label="Rekomendasi-rekomendasi untuk meningkatkan praktek asesmen">
                <template slot-scope="{row}">
                  <el-input v-model="row.rekomendasi" type="textarea" />
                </template>
              </el-table-column>
              <el-table-column align="left" width="80px" label="-">
                <template slot-scope="{row}">
                  <el-tooltip class="item" effect="dark" content="Delete" placement="top-end">
                    <el-button type="danger" size="small" icon="el-icon-delete" @click="deleteTemuan(row)" />
                  </el-tooltip>
                </template>
              </el-table-column>
            </el-table>
          </el-col>
        </el-row>
        <h4>Rencana Implementasi  perubahan/perbaikan pelaksanaan asesmen :</h4>
        <br>
        <el-button class="filter-item" style="margin-left: 10px;" type="primary" icon="el-icon-plus" @click="addRencanaImplementasi">
          {{ $t('table.add') }}
        </el-button>
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
                    <el-input v-model="row.kegiatan" type="textarea" />
                  </template>
                </el-table-column>
                <el-table-column align="left" min-width="80px" label="Waktu Penyelesaian">
                  <template slot-scope="{row}">
                    <el-input v-model="row.waktu" type="textarea" />
                  </template>
                </el-table-column>
                <el-table-column align="left" min-width="80px" label="Penanggungjawab">
                  <template slot-scope="{row}">
                    <el-input v-model="row.penanggungJawab" type="textarea" />
                  </template>
                </el-table-column>
                <el-table-column align="left" width="80px" label="-">
                  <template slot-scope="{row}">
                    <el-tooltip class="item" effect="dark" content="Delete" placement="top-end">
                      <el-button type="danger" size="small" icon="el-icon-delete" @click="deleteRencanaImplementasi(row)" />
                    </el-tooltip>
                  </template>
                </el-table-column>
              </el-table-column>
            </el-table>
          </el-col>
        </el-row>
      </div>
    </el-main>
    <!-- <el-button @click="onSubmit">Submit</el-button> -->
    <el-button v-if="$route.params.id_va !== null" @click="generateReport">Print</el-button>
    <el-button v-else @click="onSubmit">Submit</el-button>

  </el-container>
</template>

<script>
import { mapGetters } from 'vuex';
import Resource from '@/api/resource';
import VueHtml2pdf from 'vue-html2pdf';
import masterDataVa from './masterDataVa.json';
const jadwalResource = new Resource('jadwal-get');
const skemaResource = new Resource('skema-get');
const tukResource = new Resource('tuk-get');
const ujiKomResource = new Resource('uji-komp-get');
const apl01Resource = new Resource('detail/apl-01');
const vaResource = new Resource('uji-komp-va');
const asesorResource = new Resource('assesor');
const delay = ms => new Promise(res => setTimeout(res, ms));

export default {
  components: {
    VueHtml2pdf,
  },
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
        asesor_1: null,
        asesor_2: null,
        asesor_3: null,
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
    // this.getListSkema().then((value) => {
    this.onJadwalSelect();
    // });
    this.getUjiKompDetail();
    this.getListUji().then((value) => {
      this.getListAsesor();
      this.getListTuk();
      this.getListJadwal();
      this.getDate();
    });
    this.getApl01();
  },
  methods: {
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
    async getUjiKompDetail() {
      // var id_uji = this.$route.params.id_uji;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      var id_apl_01 = this.$route.params.id_apl_01;
      this.listUji = await ujiKomResource.list({ idapl01: id_apl_01 });
      // var ujiDetail = this.listUji.find((x) => x.id === id_uji);
      // this.selectedUji = ujiDetail;
      this.dataTrx.tempat = this.listUji.data[0].nama_tuk;
      this.dataTrx.namaSkema = this.listUji.data[0].skema_sertifikasi;
      this.dataTrx.noSkema = this.listUji.data[0].kode_skema;
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
      const data = await apl01Resource.get(this.$route.params.id_apl_01);
      this.fileName = 'APL.01 - ' + data.nama_lengkap + ' - ' + data.kode_skema;
    },
    async onJadwalSelect() {
      // var id_skema = this.$route.params.id_skema;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      // var skemaId = this.listSkema.find((x) => x.id === id_skema);
      // this.selectedSkema = skemaId;
      // var tukId = this.listTuk.find((x) => x.id === jadwal.id_tuk);
      // this.dataTrx.id_skema = skemaId.id;
      // this.dataTrx.id_tuk = tukId.id;
      // this.getKuk();

      var idSkema = this.$route.params.id_skema;
      // var jadwal = this.listJadwal.find((x) => x.id === this.dataTrx.id_jadwal);
      // var skemaId = this.listSkema.find((x) => x.id === id_skema);
      var skemaId = await skemaResource.list({ id_skema: idSkema });
      this.selectedSkema = skemaId.data[0];
      console.log(skemaId);
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
      // var elemen = unitKomp.elemen;
      // var kuk = elemen.kuk;;
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
