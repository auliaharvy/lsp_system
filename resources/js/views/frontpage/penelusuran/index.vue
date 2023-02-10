<template>
  <div class="dashboard-editor-container">

    <el-row :gutter="32">
      <el-col :xs="24" :sm="24" :lg="24">
        <div class="chart-wrapper">
          <transaction-table />
        </div>
      </el-col>
    </el-row>

  </div>
</template>

<script>
import TransactionTable from './TransactionTable';

export default {
  name: 'DashboardAdmin',
  components: {
    TransactionTable,
  },
  data() {
    return {
    };
  },
  methods: {
  },
};
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
.dashboard-editor-container {
  padding: 32px;
  background-color: rgb(240, 242, 245);
  .chart-wrapper {
    background: #fff;
    padding: 16px 16px 0;
    margin-bottom: 32px;
  }
}
</style>
