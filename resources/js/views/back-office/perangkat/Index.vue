<template>
  <div class="app-container">
    <el-header>
      <el-page-header :content="skema" @back="$router.back()" />
    </el-header>
    <Ia02 :id-skema="idSkema" :user-id="userId" />
    <Ia03 :id-skema="idSkema" :user-id="userId" />
    <Ia05 :id-skema="idSkema" :user-id="userId" />
    <Ia06 :id-skema="idSkema" :user-id="userId" />
    <Ia07 :id-skema="idSkema" :user-id="userId" />
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Ia02 from './ia02.vue';
import Ia03 from './ia03.vue';
import Ia05 from './ia05.vue';
import Ia06 from './ia06.vue';
import Ia07 from './ia07.vue';

export default {
  name: 'SkemaList',
  components: { Ia02, Ia03, Ia05, Ia06, Ia07 },
  data() {
    return {
      idSkema: this.$route.params.id_skema,
      skema: this.$route.params.skema,
    };
  },
  computed: {
    ...mapGetters(['username', 'userId']),
  },
};
</script>

<style lang="scss" scoped>
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
