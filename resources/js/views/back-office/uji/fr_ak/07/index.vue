<template>
  <el-container class="app-container">
    <el-header>
      <el-page-header
        content="FR.AK.07.CEKLIS PENYESUAIAN YANG WAJAR dan BERALASAN"
        @back="$router.back()"
      />
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
              <span v-if="listUji.data[0].id_ak_07 && scope.row.potensi == 1"><i class="el-icon-success ceklist-icon" /></span>
              <el-checkbox v-else-if="listUji.data[0].id_ak_07 == null" v-model="scope.row.potensi" />
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
                <span v-if="listUji.data[0].id_ak_07 && scope.row.keterangan == 1"><i class="el-icon-success ceklist-icon" /></span>
                <el-checkbox v-else-if="listUji.data[0].id_ak_07 == null" v-model="scope.row.keterangan" />
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
                <el-input v-model="scope.row.answer" />
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
                <div>
                  <vueSignature
                    ref="signatureAsesor"
                    :sig-option="optionAsesor"
                    :w="'300px'"
                    :h="'150px'"
                    :disabled="false"
                    style="border-style: outset"
                  />
                  <el-button
                    size="small"
                    @click="clearTtdAsesor"
                  >
                    Clear
                  </el-button>
                </div>
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
                <div>
                  <vueSignature
                    ref="signatureAsesi"
                    :sig-option="optionAsesi"
                    :w="'300px'"
                    :h="'150px'"
                    :disabled="false"
                    style="border-style: outset"
                  />
                  <el-button
                    size="small"
                    @click="clearTtdAsesi"
                  >
                    Clear
                  </el-button>
                </div>
              </div>
            </template>
          </el-table-column>
        </el-table>
        <br>
        <br>
        <el-button
          type="primary"
          @click="submit()"
        >
          {{ $t('table.confirm') }}
        </el-button>
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
const potensiAsesiResource = new Resource('show-ak-07-potensi-asesi');
const persyaratanResource = new Resource('show-ak-07-persyaratan');
const potensiAsesiResource2 = new Resource('preview-ak-07-potensi-asesi');
const persyaratanResource2 = new Resource('preview-ak-07-persyaratan');
const ak07Resource = new Resource('ak-07');
const storeAk07Resource = new Resource('uji-komp-ak-07');

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
      idujikomp: null,
      isWide: true,
      labelPosition: 'left',
      optionAsesi: { penColor: 'rgb(0, 0, 0)', backgroundColor: 'rgb(255,255,255)'},
      optionAsesor: { penColor: 'rgb(0, 0, 0)', backgroundColor: 'rgb(255,255,255)'},
      ttdAsesorPng: null,
      ttdAsesiPng: null
    };
  },
  computed: {
    ...mapGetters(['userId']),
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.onResize);
    localStorage.removeItem('idujikomp')
  },
  mounted() {
    window.addEventListener('resize', this.onResize);
    this.onResize();
  },
  created() {
    if(JSON.parse(localStorage.getItem('idujikomp') || null)){ this.idujikomp = localStorage.getItem('idujikomp')}
    this.getUjiKompDetail().then(() => {
      this.getPotensiAsesi();
      this.getPersyaratan();
      this.getAk07();
    })  
  },
  methods: {
    async getUjiKompDetail() {
      this.listUji = await previewResource.get(this.idujikomp);
      this.headerTable[0].content = this.listUji.data[0].skema_sertifikasi;
      this.headerTable[1].content = this.listUji.data[0].nama_tuk;
      this.headerTable[2].content = this.listUji.data[0].asesor;
      this.headerTable[3].content = this.listUji.data[0].nama_peserta;
      this.headerTable[4].content = this.listUji.data[0].mulai;
      this.listTtd[0].name = this.listUji.data[0].asesor;
      this.listTtd[1].name = this.listUji.data[0].nama_peserta;
    },
    async getPotensiAsesi() {
      console.log(this.listUji.data[0].id)
      let data = this.listUji.data[0].id ? await potensiAsesiResource2.get(this.listUji.data[0].id) : await potensiAsesiResource.list()
      this.listPotensiAsesi = data.data;
    },
    async getPersyaratan() {
      console.log(this.listUji.data[0].id)
      let data = this.listUji.data[0].id ? await persyaratanResource2.get(this.listUji.data[0].id) : await persyaratanResource.list();
      this.listPersyaratan = data.data
    },
    async getAk07() {
      let data = await ak07Resource.get(this.idujikomp);
      this.listAsesmen[0].answer = data.data[0].acuan_pembanding
      this.listAsesmen[1].answer = data.data[0].metode_asesmen
      this.listAsesmen[2].answer = data.data[0].instrumen_asesmen
      this.listTtd[0].ttd = '/uploads/users/signature/' + data.data[0].ttd_asesor;
      this.listTtd[1].ttd = '/uploads/users/signature/' + data.data[0].ttd_asesi;
    },
    submit() {
      this.listPotensiAsesi = this.listPotensiAsesi.map(element => {return {...element, potensi: element.potensi == true ? 1 : 0}})
      this.listPersyaratan = this.listPersyaratan.map(element => {return {...element, keterangan: element.keterangan == true ? 1 : 0}})
      const formData = new FormData();
      formData.append('id_uji_komp', this.idujikomp);
      formData.append('signature_asesor', this.$refs.signatureAsesor.save());
      formData.append('signature_asesi', this.$refs.signatureAsesi.save());
      this.listAsesmen.forEach(element => {formData.append('asesmen[]', JSON.stringify(element))});
      this.listPotensiAsesi.forEach(element => { formData.append('potensi_asesi[]', JSON.stringify(element)) });
      this.listPersyaratan.forEach(element => { formData.append('persyaratan[]', JSON.stringify(element)) });
      storeAk07Resource.store(formData)
        .then(response => {
          this.$message({
            message: 'FR AK 07 has been Submited successfully.',
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
    clearTtdAsesi() {
      this.$refs.signatureAsesi.clear();
    },
    clearTtdAsesor() {
      this.$refs.signatureAsesor.clear();
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
        if (rowIndex > 0 && this.listPersyaratan[rowIndex].id === this.listPersyaratan[rowIndex - 1].id) {
          return { rowspan: 0, colspan: 0 };
        } else {
          const sameIdCount = this.listPersyaratan.filter(item => item.id === row.id).length;
          return { rowspan: sameIdCount, colspan: 1 };
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
