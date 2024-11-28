<template>
  <el-menu
    background-color="#fff"
    :mode="mode"
    router
    class="navbar-mobile"
  >
    <el-menu-item
      v-if="mode === 'horizontal'"
      index="/login"
    >
      <img
        :src="logo"
        class="logo"
      >
    </el-menu-item>
    <el-menu-item index="/login">
      Home
    </el-menu-item>
    <el-submenu index="1">
      <template slot="title">
        Profile
      </template>
      <el-menu-item index="/tentang-lsp">
        Lembaga Sertifikasi Profesi
      </el-menu-item>
      <el-menu-item index="/visi-misi">
        Visi & Misi
      </el-menu-item>
      <el-menu-item index="/struktur-organisasi">
        Struktur Organisasi
      </el-menu-item>
      <el-menu-item index="/stakeholder">
        Stakeholder
      </el-menu-item>
      <el-menu-item index="/komitmen-ketidakberpihakan">
        Komitmen Ketidakberpihakan
      </el-menu-item>
      <el-menu-item index="/rencana-strategis">
        Rencana Strategis
      </el-menu-item>
      <el-menu-item index="/program-kerja">
        Program Kerja 2024
      </el-menu-item>
      <el-menu-item index="/mitra-kerja">
        Mitra Kerja
      </el-menu-item>
      <el-menu-item index="/pemegang-sertifikat">
        Pemegang Sertifikat
      </el-menu-item>
      <el-menu-item index="/jadwal-assesmen">
        Jadwal Assesmen
      </el-menu-item>
      <el-menu-item index="/assesor">
        Asesor Kompetensi
      </el-menu-item>
      <el-menu-item index="/tuk">
        TUK
      </el-menu-item>
      <el-menu-item index="/kkni">
        KKNI
      </el-menu-item>
      <el-menu-item index="/dudi">
        DUDI
      </el-menu-item>
    </el-submenu>
    <el-menu-item index="/form-apl-02">
      Uji Kompetensi
    </el-menu-item>
    <el-menu-item index="/kegiatan">
      Kegiatan
    </el-menu-item>

    <template v-if="!isLogged">
      <el-menu-item
        style="float: right"
        index="/login"
      >
        <el-button>Login</el-button>
      </el-menu-item>
    </template>
    <template v-if="isLogged">
      <el-menu-item style="float: right">
        <el-dropdown
          class="avatar-container right-menu-item hover-effect"
          trigger="click"
        >
          <div class="avatar-wrapper">
            <img
              src="@/assets/login/logo.png"
              style="width: 40px; height: 40px;"
            >
            <i class="el-icon-caret-bottom" />
          </div>
          <el-dropdown-menu slot="dropdown">
            <router-link to="/dashboard">
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
      </el-menu-item>
    </template>
  </el-menu>
  <!-- <div class="navbar">
    <div class="left-menu">
      <template v-if="device!=='mobile'">
        <router-link to="/login"><span class="right-menu-item hover-effect">Home</span></router-link>
        <router-link to="/login"><span class="right-menu-item hover-effect">Profile</span></router-link>
      </template>
    </div>

    <div class="right-menu">
      <template v-if="!isLogged">
        <router-link to="/login"><el-button>Login</el-button></router-link>
      </template>

      <template v-if="isLogged">
        <el-dropdown class="avatar-container right-menu-item hover-effect" trigger="click">
          <div class="avatar-wrapper">
            <img :src="logo" class="user-avatar">
            <i class="el-icon-caret-bottom" />
          </div>
          <el-dropdown-menu slot="dropdown">
            <router-link to="/dashboard">
              <el-dropdown-item>
                {{ $t('navbar.dashboard') }}
              </el-dropdown-item>
            </router-link>
            <router-link v-show="userId !== null" :to="`/profile/edit`">
              <el-dropdown-item>
                {{ $t('navbar.profile') }}
              </el-dropdown-item>
            </router-link>
            <a target="_blank" href="https://github.com/tuandm/laravue/">
              <el-dropdown-item>
                {{ $t('navbar.github') }}
              </el-dropdown-item>
            </a>
            <el-dropdown-item divided>
              <span style="display:block;" @click="logout">{{ $t('navbar.logOut') }}</span>
            </el-dropdown-item>
          </el-dropdown-menu>
        </el-dropdown>
      </template>
    </div>
  </div> -->
</template>

<script>
import { mapGetters } from 'vuex';
import logo from '@/assets/login/logo.png';
import { isLogged } from '@/utils/auth';

export default {
  name: 'FrontNav',
  components: {},
  props: {
    mode: {
      type: String,
      default: 'horizontal',
    },
  },
  data() {
    return {
      logo: logo,
      isLogged: isLogged(),
    };
  },
  computed: {
    ...mapGetters(['sidebar', 'name', 'avatar', 'device', 'userId']),
  },
  methods: {
    toggleSideBar() {
      this.$store.dispatch('app/toggleSideBar');
    },
    async logout() {
      await this.$store.dispatch('user/logout');
      this.$router.push(`/login?redirect=${this.$route.fullPath}`);
    },
  },
};
</script>

<style lang="scss" scoped>
.logo {
  position: relative;
  width: 100%;
  height: 80%;
  line-height: 80%;
  text-align: left;
  overflow: hidden;
}
.navbar-mobile{
  z-index: 99;
}
.navbar {
  height: 50px;
  overflow: hidden;
  position: sticky;
  background: rgb(110, 61, 61);
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
