<template>
  <div class="navbar">
    <hamburger
      id="hamburger-container"
      :is-active="sidebar.opened"
      class="hamburger-container"
      @toggleClick="toggleSideBar"
    />

    <breadcrumb
      id="breadcrumb-container"
      class="breadcrumb-container"
    />

    <div class="right-menu">
      <template v-if="device!=='mobile'">
        <search
          id="header-search"
          class="right-menu-item"
        />

        <screenfull
          id="screenfull"
          class="right-menu-item hover-effect"
        />

        <el-tooltip
          :content="$t('navbar.size')"
          effect="dark"
          placement="bottom"
        >
          <size-select
            id="size-select"
            class="right-menu-item hover-effect"
          />
        </el-tooltip>

        <lang-select class="right-menu-item hover-effect" />
      </template>

      <el-dropdown
        class="avatar-container right-menu-item hover-effect"
        trigger="click"
      >
        <div class="avatar-wrapper">
          <img
            src="@/assets/login/logo.png"
            class="user-avatar"
          >
          <i class="el-icon-caret-bottom" />
        </div>
        <el-dropdown-menu slot="dropdown">
          <router-link to="/">
            <el-dropdown-item>
              {{ $t('navbar.dashboard') }}
            </el-dropdown-item>
          </router-link>
          <router-link
            v-show="userId !== null"
            :to="`/profile/edit`"
          >
            <el-dropdown-item>
              {{ $t('navbar.profile') }}
            </el-dropdown-item>
          </router-link>
          <el-dropdown-item divided>
            <span
              style="display:block;"
              @click="logout"
            >{{ $t('navbar.logOut') }}</span>
          </el-dropdown-item>
        </el-dropdown-menu>
      </el-dropdown>
    </div>
    <!-- dialog set user tanda tangan -->
    <el-dialog
      v-loading="loading"
      title="Akun anda belum ada tanda tangan silakan buat"
      :visible.sync="dialogTtd"
      :close-on-click-modal="false"
    >
      <div class="form-container">
        <el-form
          ref="setReferenceForm"
          label-position="left"
          label-width="150px"
          style="max-width: 500px;"
        >
          <el-form-item label="Tanda Tangan">
            <vueSignature
              ref="signature"
              :sig-option="option"
              :w="'300px'"
              :h="'150px'"
              :disabled="false"
              style="border-style: outset"
            />
            <el-button
              size="small"
              @click="clear"
            >
              Clear
            </el-button>
          </el-form-item>
        </el-form>
        <div
          slot="footer"
          class="dialog-footer"
        >
          <!-- <el-button @click="dialogTtd = false">
            {{ $t('table.cancel') }}
          </el-button> -->
          <el-button
            type="primary"
            @click="saveSign"
          >
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import vueSignature from 'vue-signature';
import { mapGetters } from 'vuex';
import Resource from '@/api/resource';
import Breadcrumb from '@/components/Breadcrumb';
import Hamburger from '@/components/Hamburger';
import Screenfull from '@/components/Screenfull';
import SizeSelect from '@/components/SizeSelect';
import LangSelect from '@/components/LangSelect';
import Search from '@/components/HeaderSearch';

const saveTtdResource = new Resource('user/save-signature');

export default {
  components: {
    Breadcrumb,
    Hamburger,
    Screenfull,
    SizeSelect,
    LangSelect,
    Search,
    vueSignature,
  },
  data() {
    return {
      option: {
        penColor: 'rgb(0, 0, 0)',
        backgroundColor: 'rgb(255,255,255)',
      },
      loading: false,
      dialogTtd: false,
      dataTTd: null,
    };
  },
  computed: {
    ...mapGetters([
      'sidebar',
      'name',
      'avatar',
      'device',
      'userId',
      'user',
    ]),
  },
  created() {
    this.checkTtd();
  },
  methods: {
    toggleSideBar() {
      this.$store.dispatch('app/toggleSideBar');
    },
    clear() {
      this.$refs.signature.clear();
    },
    saveSign() {
      var _this = this;
      this.dataTTd = _this.$refs.signature.save();
      const formData = new FormData();
      formData.append('user_id', this.userId);
      formData.append('signature', this.dataTTd);
      saveTtdResource
        .store(formData)
        .then(response => {
          this.$message({
            message: 'Tanda tangan user berhasil di simpan.',
            type: 'success',
            duration: 5 * 1000,
          });
          this.dialogTtd = false;
          this.loading = false;
        })
        .catch(error => {
          console.log(error);
          this.loading = false;
        })
        .finally(() => {
          this.loading = false;
        });
    },
    async checkTtd(){
      if (this.user.signature === null) {
        this.dialogTtd = true;
      }
    },
    async logout() {
      await this.$store.dispatch('user/logout');
      this.$router.push(`/login?redirect=${this.$route.fullPath}`);
    },
  },
};
</script>

<style lang="scss" scoped>
.navbar {
  height: 70px;
  overflow: hidden;
  position: relative;
  background: #fff;
  box-shadow: 0 1px 4px rgba(0,21,41,.08);

  .hamburger-container {
    line-height: 46px;
    height: 100%;
    float: left;
    cursor: pointer;
    transition: background .3s;
    -webkit-tap-highlight-color:transparent;

    &:hover {
      background: rgba(0, 0, 0, .025)
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
        transition: background .3s;

        &:hover {
          background: rgba(0, 0, 0, .025)
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
