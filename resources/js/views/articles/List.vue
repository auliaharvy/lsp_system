<template>
  <div class="app-container">
    <el-table v-loading="listLoading" :data="list" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="ID" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.id }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Waktu">
        <template slot-scope="scope">
          <span>{{ scope.row.waktu }}</span>
        </template>
      </el-table-column>

      <el-table-column label="Judul">
        <template slot-scope="scope">
          <span>{{ scope.row.judul }}</span>
        </template>
      </el-table-column>

      <el-table-column label="Deskripsi">
        <template slot-scope="scope">
          <span>{{ scope.row.description }}</span>
        </template>
      </el-table-column>

      <!-- <el-table-column align="center" label="Content">
        <template slot-scope="scope">
          <span>{{ scope.row.content }}</span>
        </template>
      </el-table-column> -->

      <el-table-column align="center" label="Kategori">
        <template slot-scope="scope">
          <span>{{ scope.row.kategori }}</span>
        </template>
      </el-table-column>

      <!-- <el-table-column class-name="status-col" label="Status" width="110">
        <template slot-scope="{row}">
          <el-tag :type="row.status | statusFilter">
            {{ row.status }}
          </el-tag>
        </template>
      </el-table-column> -->

      <!-- <el-table-column min-width="300px" label="Title">
        <template slot-scope="{row}">
          <router-link :to="'/administrator/articles/edit/'+row.id" class="link-type">
            <span>{{ row.title }}</span>
          </router-link>
        </template>
      </el-table-column> -->

      <el-table-column align="center" label="Actions" width="120">
        <template slot-scope="scope">
          <router-link :to="'/administrator/articles/edit/'+scope.row.id">
            <el-button type="primary" size="small" icon="el-icon-edit">
              Edit
            </el-button>
          </router-link>
        </template>
      </el-table-column>
    </el-table>

    <pagination v-show="total>0" :total="total" :page.sync="listQuery.page" :limit.sync="listQuery.limit" @pagination="getList" />
  </div>
</template>

<script>
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import Resource from '@/api/resource';
const articleResource = new Resource('article');

export default {
  name: 'ArticleList',
  components: { Pagination },
  filters: {
    statusFilter(status) {
      const statusMap = {
        published: 'success',
        draft: 'info',
        deleted: 'danger',
      };
      return statusMap[status];
    },
  },
  data() {
    return {
      list: null,
      total: 0,
      listLoading: true,
      listQuery: {
        page: 1,
        limit: 20,
      },
    };
  },
  created() {
    this.getList();
  },
  methods: {
    ubahFormatTanggal(tanggalAwal) {
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      const tanggal = new Date(tanggalAwal.replace('Z', ''));
      return tanggal.toLocaleDateString('id-ID', options);
    },
    async getList() {
      this.listLoading = true;
      const { data } = await articleResource.list(this.listQuery);
      this.list = data;
      this.list.forEach((element, index) => {
        const waktu = this.ubahFormatTanggal(element.created_at);
        console.log(element.created_at);
        element['waktu'] = waktu;
      });

      // this.total = data;
      this.listLoading = false;
    },
  },
};
</script>

<style scoped>
.edit-input {
  padding-right: 100px;
}
.cancel-btn {
  position: absolute;
  right: 15px;
  top: 10px;
}
</style>
