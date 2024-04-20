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
      <el-input v-model="query.keyword" :placeholder="$t('table.keyword')" style="width: 200px;" class="filter-item" @keyup.enter.native="handleFilter" />
      <el-button v-waves class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter">
        {{ $t('table.search') }}
      </el-button>
    </div>
    <el-table
      v-loading="loading"
      :data="list"
      border
      fit
      style="width: 100%;"
      :header-cell-style="{ 'text-align': 'center', 'background': '#324157', 'color': 'white' }"
    >
      <el-table-column label="No" width="50" align="center">{
        <template slot-scope="scope">
          {{ scope.$index + 1 }}
        </template>
      </el-table-column>
      <el-table-column align="left" :label="$t('uji.table.schedule')" min-width="100px">
        <template slot-scope="scope">
          <span> {{ scope.row.jadwal }} </span>
        </template>
      </el-table-column>
      <el-table-column align="left" :label="$t('uji.table.skema')" min-width="150px">
        <template slot-scope="scope">
          <span> {{ scope.row.kode_skema }} / {{ scope.row.skema_sertifikasi }} </span>
        </template>
      </el-table-column>

      <el-table-column align="left" :label="$t('jadwal.table.asesor')">
        <template slot-scope="scope">
          {{ scope.row.asesor }}
        </template>
      </el-table-column>

      <el-table-column align="left" :label="$t('uji.table.asesi')">
        <template slot-scope="scope">
          <span>{{ scope.row.nama_peserta }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" :label="$t('uji.table.mulai')">
        <template slot-scope="scope">
          <span> {{ scope.row.mulai }} </span>
        </template>
      </el-table-column>
      <el-table-column v-if="checkRole(['admin', 'assesor'])" align="center" label="Action">
        <template slot-scope="scope">
          <router-link :to="{ name: 'preview-apl-01', params:{ iduji: scope.row.id, asesor: scope.row.asesor }}">
            <el-button type="primary" icon="el-icon-view">Preview</el-button>
          </router-link>
          {{ scope.row.persentase }}
          <el-button style="margin-top: 10px;" type="warning" icon="el-icon-view" @click="showDialogPrint(scope.row.id, scope.row.asesor, scope.row.nama_peserta)">Print</el-button>
          <el-dialog
            v-loading="loading"
            title="Download Data"
            :visible.sync="dialogVisible"
            width="50%"
          >
            <el-checkbox v-model="checkAll" :indeterminate="isIndeterminate" @change="handleCheckAllChange">Check all</el-checkbox>
            <!-- <el-checkbox-group v-model="checkedDataUjiKomp" @change="handleCheckedCitiesChange"> -->
            <!-- <el-checkbox v-for="ujiKomp in dataUjiKomp" :key="ujiKomp" :label="ujiKomp" style="">
                <div style="font-weight: 400;">{{ ujiKomp }}</div>
              </el-checkbox> -->
            <table v-loading="loading" style="width: 100%;">
              <tr style="width: 100%;">
                <td style="width: 25%;">
                  <div v-for="ujiKomp in dataUjiKomp" :key="ujiKomp.index" :label="ujiKomp" style="width: 25%; text-align: left;">
                    <!-- <el-checkbox v-if="ujiKomp.index < 5">{{ ujiKomp.name }})</el-checkbox> -->
                    <el-checkbox v-if="ujiKomp.index < 5" v-model="ujiKomp.value" @change="handleCheckedCitiesChange">{{ ujiKomp.name }}</el-checkbox>
                  </div>
                </td>
                <td style="width: 25%;">
                  <div v-for="ujiKomp in dataUjiKomp" :key="ujiKomp.index" :label="ujiKomp" style="width: 25%; text-align: left;">
                    <el-checkbox v-if="ujiKomp.index > 4 && ujiKomp.index < 9" v-model="ujiKomp.value" @change="handleCheckedCitiesChange">{{ ujiKomp.name }}</el-checkbox>
                  </div>
                </td>
                <td style="width: 25%;">
                  <div v-for="ujiKomp in dataUjiKomp" :key="ujiKomp.index" :label="ujiKomp" style="width: 25%; text-align: left;">
                    <el-checkbox v-if="ujiKomp.index > 8 && ujiKomp.index < 13" v-model="ujiKomp.value" @change="handleCheckedCitiesChange">{{ ujiKomp.name }}</el-checkbox>
                  </div>
                </td>
                <td style="width: 25%;">
                  <div v-for="ujiKomp in dataUjiKomp" :key="ujiKomp.index" :label="ujiKomp" style="width: 25%; text-align: left;">
                    <el-checkbox v-if="ujiKomp.index > 12 && ujiKomp.index < 18" v-model="ujiKomp.value" @change="handleCheckedCitiesChange">{{ ujiKomp.name }}</el-checkbox>
                  </div>
                </td>
              </tr>
            </table>
            <!-- </el-checkbox-group> -->
            <span v-if="allUnchecked" slot="footer" class="dialog-footer">
              <!-- <el-button @click="dialogVisible = false">Cancel</el-button> -->
              <el-button type="primary" @click="generateReport()">Print</el-button>
            </span>
          </el-dialog>
        </template>
      </el-table-column>}
    </el-table>
    <pagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" @pagination="getList" />
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import Resource from '@/api/resource';
import checkRole from '@/utils/role';
import waves from '@/directive/waves'; // Waves directive

const listResource = new Resource('history');
const skemaResource = new Resource('skema');
const jadwalResource = new Resource('jadwal-get');
const preview = new Resource('detail/preview');
const print = new Resource('print-semua-module');

export default {
  components: { Pagination },
  directives: { waves },
  data() {
    return {
      query: {
        page: 1,
        limit: 10,
        keyword: '',
        role: '',
        user_id: null,
        id_jadwal: null,
        id_skema: null,
      },
      loading: true,
      list: null,
      listJadwal: null,
      listSkema: null,
      total: 0,
      dataUjiKomp: [
        { index: 1, name: 'APL 01', nameInDatabase: 'id_apl_01', idujikom: null, value: false },
        { index: 2, name: 'APL 02', nameInDatabase: 'id_apl_02', idujikom: null, value: false },
        { index: 3, name: 'MAPA 02', nameInDatabase: 'id_mapa_02', idujikom: null, value: false },
        { index: 4, name: 'AK 01', nameInDatabase: 'id_ak_01', idujikom: null, value: false },
        { index: 5, name: 'AK 04', nameInDatabase: 'id_ak_04', idujikom: null, value: false },
        { index: 6, name: 'IA 01', nameInDatabase: 'id_ia_01', idujikom: null, value: false },
        { index: 7, name: 'IA 02', nameInDatabase: 'id_ia_02', idujikom: null, value: false },
        { index: 8, name: 'IA 03', nameInDatabase: 'id_ia_03', idujikom: null, value: false },
        { index: 9, name: 'IA 05', nameInDatabase: 'id_ia_05', idujikom: null, value: false },
        { index: 10, name: 'IA 06', nameInDatabase: 'id_ia_06', idujikom: null, value: false },
        { index: 11, name: 'IA 07', nameInDatabase: 'id_ia_07', idujikom: null, value: false },
        { index: 12, name: 'IA 11', nameInDatabase: 'id_ia_11', idujikom: null, value: false },
        { index: 13, name: 'AK 02', nameInDatabase: 'id_ak_02', idujikom: null, value: false },
        { index: 14, name: 'AK 03', nameInDatabase: 'id_ak_03', idujikom: null, value: false },
        { index: 15, name: 'AK 05', nameInDatabase: 'id_ak_05', idujikom: null, value: false },
        { index: 16, name: 'AK 06', nameInDatabase: 'id_ak_06', idujikom: null, value: false },
        { index: 17, name: 'VA', nameInDatabase: 'id_va', idujikom: null, value: false },
      ],
      checkAll: false,
      checkedCities: ['Shanghai', 'Beijing'],
      checkedDataUjiKomp: [],
      isIndeterminate: true,
      showButtonPrint: false,
      dialogVisible: false,
    };
  },
  computed: {
    ...mapGetters([
      'roles',
    ]),
    allUnchecked() {
      return !this.dataUjiKomp.every(item => !item.value);
    },
  },
  watch: {
    'dataUjiKomp': function(newVal, oldVal){
      if (newVal.includes(true)) {
        this.showButtonPrint = true;
      }
    },
  },
  created() {
    this.getList();
    this.getListJadwal();
    this.getListSkema();
  },
  methods: {
    checkRole,
    handleFilter() {
      this.query.page = 1;
      this.getList();
    },
    async getList() {
      this.query.role = this.roles[0];
      this.query.user_id = this.userId;
      const { limit, page } = this.query;
      this.loading = true;
      listResource.list(this.query).then((res) => {
        this.list = res.data;
        this.list.forEach((element, index) => {
          element['index'] = (page - 1) * limit + index + 1;
        });
        this.total = res.total;
        this.loading = false;
      });
    },
    async getListJadwal() {
      const { data } = await jadwalResource.list({ limit: 1000 });
      this.listJadwal = data;
    },
    async getListSkema() {
      const { data } = await skemaResource.list({ limit: 1000 });
      this.listSkema = data;
    },
    async showDialogPrint(id, asesor, nama_peserta){
      const data = await preview.get(id);
      this.iduji = data.id;
      this.asesor = asesor;
      this.asesi = nama_peserta;
      this.isIndeterminate = true;
      for (let i = 0; i < this.dataUjiKomp.length; i++){
        this.dataUjiKomp[i].value = false;
        // this.data.value = this.checkAll;
        i++;
      }
      // const skema = await skemaunit.list({ id_skema: data.id_skema });
      // console.log(skema);
      this.dialogVisible = true;
      let index = 0;
      for (const property in data){
        if (this.dataUjiKomp[index] && this.dataUjiKomp[index].nameInDatabase === property) {
          this.dataUjiKomp[index].idujikom = data[property];
          index++;
        }
      }
      console.log(this.dataUjiKomp);
    },
    handleCheckAllChange(value) {
      // this.checkedCities = val ? cityOptions : [];
      this.checkedDataUjiKomp = value ? this.dataUjiKomp : [];
      // console.log(this.checkedDataUjiKomp);
      let index = 0;
      for (const item in this.dataUjiKomp){
        this.dataUjiKomp[index].value = this.checkAll;
        // this.data.value = this.checkAll;
        console.log(item);
        // console.log(this.dataUjiKomp[index].index);
        index++;
      }
      this.isIndeterminate = false;
      if (value){
        this.showButtonPrint = true;
      } else {
        this.showButtonPrint = false;
      }
    },
    handleErrorPrint(done){
      this.$confirm('Gagal, silahkan coba lagi!')
        .then(_ => {
          done();
        })
        .catch(_ => {});
    },
    async generateReport() {
      this.loading = true;
      const ujikomp = {
        iduji: this.iduji,
        asesor: this.asesor,
        idapl01: this.dataUjiKomp[0].idujikom,
        idapl02: this.dataUjiKomp[1].idujikom,
        idmapa02: this.dataUjiKomp[2].idujikom,
        idak01: this.dataUjiKomp[3].idujikom,
        idak04: this.dataUjiKomp[4].idujikom,
        idia01: this.dataUjiKomp[5].idujikom,
        idia02: this.dataUjiKomp[6].idujikom,
        idia03: this.dataUjiKomp[7].idujikom,
        idia05: this.dataUjiKomp[8].idujikom,
        idia06: this.dataUjiKomp[9].idujikom,
        idia07: this.dataUjiKomp[10].idujikom,
        idia11: this.dataUjiKomp[11].idujikom,
        idak02: this.dataUjiKomp[12].idujikom,
        idak03: this.dataUjiKomp[13].idujikom,
        idak05: this.dataUjiKomp[14].idujikom,
        idak06: this.dataUjiKomp[15].idujikom,
        idva: this.dataUjiKomp[16].idujikom,
        valueapl01: this.dataUjiKomp[0].value,
        valueapl02: this.dataUjiKomp[1].value,
        valuemapa02: this.dataUjiKomp[2].value,
        valueak01: this.dataUjiKomp[3].value,
        valueak04: this.dataUjiKomp[4].value,
        valueia01: this.dataUjiKomp[5].value,
        valueia02: this.dataUjiKomp[6].value,
        valueia03: this.dataUjiKomp[7].value,
        valueia05: this.dataUjiKomp[8].value,
        valueia06: this.dataUjiKomp[9].value,
        valueia07: this.dataUjiKomp[10].value,
        valueia11: this.dataUjiKomp[11].value,
        valueak02: this.dataUjiKomp[12].value,
        valueak03: this.dataUjiKomp[13].value,
        valueak05: this.dataUjiKomp[14].value,
        valueak06: this.dataUjiKomp[15].value,
        valueva: this.dataUjiKomp[16].value,
      };

      // console.log(ujikomp);
      await print.download(ujikomp).then((response) => {
        // console.log(response);
        const url = window.URL.createObjectURL(new Blob([response]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', this.asesi + '.pdf');
        document.body.appendChild(link);
        link.click();
      }).catch((err) => {
        console.log(err);
        this.handleErrorPrint(err);
      });

      this.dialogVisible = false;
      this.loading = false;
    },
    handleCheckedCitiesChange(value) {
      // const checkedCount = value.length;
      // this.checkAll = checkedCount === this.dataUjiKomp.length;
      // this.isIndeterminate = checkedCount > 0 && checkedCount < this.dataUjiKomp.length;
      // console.log(value);
      if (value){
        this.showButtonPrint = true;
      } else {
        this.showButtonPrint = false;
      }
    },
  },
};
</script>
