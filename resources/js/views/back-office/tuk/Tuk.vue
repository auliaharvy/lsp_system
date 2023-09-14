<template>
  <div class="app-container">
    <div class="container-judul">
      <h1>Daftar TUK</h1>
    </div>
    <div class="container-main">
      <div class="filter-container">
        <el-input v-model="query.keyword" :placeholder="$t('table.keyword')" @input="handleFilter">
          <el-button slot="append" v-waves class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter" />
        </el-input>
      </div>
      <el-table v-loading="loading" :data="list" border fit highlight-current-row class="container-table">
        <el-table-column align="center" label="No">
          <template slot-scope="scope">
            <span>{{ scope.row.index }}</span>
          </template>
        </el-table-column>
        <el-table-column align="center" :label="$t('tuk.table.code')">
          <template slot-scope="scope">
            <span>{{ scope.row.kode_tuk }}</span>
          </template>
        </el-table-column>
        <el-table-column align="center" :label="$t('tuk.table.name')">
          <template slot-scope="scope">
            <span>{{ scope.row.nama }}</span>
          </template>
        </el-table-column>
        <el-table-column align="center" :label="$t('tuk.table.address')">
          <template slot-scope="scope">
            <span>{{ scope.row.alamat }}</span>
          </template>
        </el-table-column>
        <el-table-column align="center" :label="$t('tuk.table.telp')">
          <template slot-scope="scope">
            <span>{{ scope.row.no_telp }}</span>
          </template>
        </el-table-column>
        <el-table-column align="center" :label="$t('tuk.table.email')">
          <template slot-scope="scope">
            <span>{{ scope.row.email }}</span>
          </template>
        </el-table-column>
      </el-table>
      <pagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" class="pagination" @pagination="getList" />
    </div>
  </div>
</template>

<script>
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import permission from '@/directive/permission'; // Permission directive

const tukResource = new Resource('tuk');

export default {
  name: 'Tuk',
  components: { Pagination },
  directives: { waves, permission },
  data() {
    return {
      list: null,
      total: 0,
      loading: true,
      query: {
        page: 1,
        limit: 15,
        keyword: '',
        role: '',
      },
    };
  },
  created() {
    this.getList();
  },
  methods: {
    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      const { data, meta } = await tukResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.total = meta.total;
      this.loading = false;
      console.log(this.list);
    },

    handleFilter() {
      const keyword = this.query.keyword.toLowerCase(); // Konversi kata kunci pencarian ke huruf kecil
      this.list = this.list.filter((item) => {
        return (
          item.kode_tuk.toLowerCase().includes(keyword) ||
          item.nama.toLowerCase().includes(keyword) ||
          item.no_telp.toLowerCase().includes(keyword) ||
          item.alamat.toLowerCase().includes(keyword) ||
          item.email.toLowerCase().includes(keyword)
        );
      });
      this.getList();
    },
  },
};
</script>

<style lang="scss" scoped>

  @media(min-width: 990px){
    .container-main{
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .filter-container{
      min-width: 400px;
    }

    .container-table{
      width: 80%;
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
  }

  .container-judul {
    display: block;
    text-align: center;
  }

  .container-main{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
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
    padding: 0px;
  }

</style>

