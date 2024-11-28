<template>
  <el-container>
    <el-header>
      <div
        v-if="isWide"
        :class="{ 'fixed-header': true }"
      >
        <navigation
          mode="horizontal"
          style="position: -webkit-sticky"
        />
      </div>
      <el-collapse v-else>
        <el-collapse-item :class="{'fixed-header': true }">
          <div
            slot="title"
            class="custom-title"
          >
            Menu
          </div>
          <navigation mode="vertical" />
        </el-collapse-item>
      </el-collapse>
    </el-header>
    <el-main>
      <Jadwal />
    </el-main>
    <lsp-footer />
  </el-container>
</template>

<script>
import navigation from '../../frontpage/navigation.vue';
import Jadwal from './Jadwal.vue';
import footer from '../../frontpage/footer.vue';

import { mapGetters } from 'vuex';
import logo from '@/assets/login/logo.png';
import { isLogged } from '@/utils/auth';

export default {
  components: {
    navigation,
    'lsp-footer': footer,
    Jadwal,
  },
  data() {
    return {
      logo: logo,
      isLogged: isLogged(),
      isWide: true,
    };
  },
  computed: {
    ...mapGetters(['sidebar', 'name', 'avatar', 'device', 'userId']),
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.onResize);
  },
  mounted() {
    window.addEventListener('resize', this.onResize);
    this.onResize();
  },
  methods: {
    toggleSideBar() {
      this.$store.dispatch('app/toggleSideBar');
    },
    async logout() {
      await this.$store.dispatch('user/logout');
      this.$router.push(`/login?redirect=${this.$route.fullPath}`);
    },
    onResize() {
      const width = document.body.clientWidth;
      this.isWide = width > 800;
    },
  },
};
</script>

<style lang="scss" scoped>
.fixed-header {
    position: fixed;
    top: 0;
    right: 0;
    z-index: 9;
    width: 100%;
    transition: width 0.28s;
    background-color: #fff;
  }
  .custom-title,
  .custom-arrow
  {
    padding-left: 20px; /* Tambahkan padding ke kiri */
    padding-right: 20px; /* Tambahkan padding ke kanan */
  }
  .el-icon-arrow-right{
    padding-right: 20px;
  }

  .el-collapse-item__arrow {
    padding-right: 20px; /* Tambahkan padding ke kanan untuk ikon collapse */
  }

.navbar {
  height: 50px;
  overflow: hidden;
  position: relative;
  background: #fff;
  box-shadow: 0 1px 4px rgba(0, 21, 41, 0.08);

  .hamburger-container {
    line-height: 46px;
    height: 100%;
    float: left;
    cursor: pointer;
    transition: background 0.3s;
    -webkit-tap-highlight-color: transparent;

    &:hover {
      background: rgba(0, 0, 0, 0.025);
    }
  }

  .breadcrumb-container {
    float: left;
  }

  .errLog-container {
    display: inline-block;
    vertical-align: top;
  }

  .right-menu {
    float: right;
    height: 100%;
    line-height: 50px;
    padding-right: 50px;

    &:focus {
      outline: none;
    }

    .right-menu-item {
      display: inline-block;
      padding: 0 8px;
      height: 100%;
      font-size: 18px;
      color: #5a5e66;
      vertical-align: text-bottom;

      &.hover-effect {
        cursor: pointer;
        transition: background 0.3s;

        &:hover {
          background: rgba(0, 0, 0, 0.025);
        }
      }
    }

    .avatar-container {
      margin-right: 30px;

      .avatar-wrapper {
        margin-top: 5px;
        position: relative;

        .user-avatar {
          cursor: pointer;
          width: 40px;
          height: 40px;
          border-radius: 4px;
        }

        .el-icon-caret-bottom {
          cursor: pointer;
          position: absolute;
          right: -20px;
          top: 25px;
          font-size: 12px;
        }
      }
    }
  }

  .left-menu {
    float: left;
    height: 100%;
    line-height: 50px;
    padding-left: 200px;

    &:focus {
      outline: none;
    }

    .right-menu-item {
      display: inline-block;
      padding: 0 8px;
      height: 100%;
      font-size: 18px;
      color: #5a5e66;
      vertical-align: text-bottom;

      &.hover-effect {
        cursor: pointer;
        transition: background 0.3s;

        &:hover {
          background: rgba(0, 0, 0, 0.025);
        }
      }
    }

    .avatar-container {
      margin-right: 30px;

      .avatar-wrapper {
        margin-top: 5px;
        position: relative;

        .user-avatar {
          cursor: pointer;
          width: 40px;
          height: 40px;
          border-radius: 4px;
        }

        .el-icon-caret-bottom {
          cursor: pointer;
          position: absolute;
          right: -20px;
          top: 25px;
          font-size: 12px;
        }
      }
    }
  }
}
</style>
