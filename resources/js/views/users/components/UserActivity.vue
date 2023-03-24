<template>
  <el-card v-if="user.name">
    <el-tabs v-model="activeActivity" @tab-click="handleClick">
      <el-tab-pane v-loading="updating" label="Account" name="first">
        <el-form-item label="Name">
          <el-input v-model="user.name" :disabled="user.role === 'admin'" />
        </el-form-item>
        <el-form-item label="Email">
          <el-input v-model="user.email" :disabled="user.role === 'admin'" />
        </el-form-item>
        <el-form-item>
          <el-button type="primary" :disabled="user.role === 'admin'" @click="onSubmit">
            Update
          </el-button>
        </el-form-item>
      </el-tab-pane>

      <el-tab-pane v-loading="updating" label="Password" name="second">
        <el-form ref="passwordForm" :rules="rules" :model="password" label-position="top" label-width="150px" style="max-width: 100%;">
          <el-form-item label="Email">
            <el-input v-model="user.email" :disabled="true" />
          </el-form-item>

          <!-- <el-form-item label="Password" prop="oldPassword">
            <el-input v-model="password.oldPassword" :type="pwdType" />
          </el-form-item> -->

          <el-form-item label="Password Baru" prop="newPassword">
            <el-input v-model="password.newPassword" :type="pwdType" />
          </el-form-item>

          <el-form-item label="Ulangi Password Baru" prop="confirmPassword">
            <el-input v-model="password.confirmPassword" :type="pwdType" />
          </el-form-item>

          <el-form-item>
            <el-button type="primary" @click="onSubmitPassword">
              Update Password
            </el-button>
            <el-button type="primary" @click="showPwd">
              Lihat Password
            </el-button>
          </el-form-item>
        </el-form>
      </el-tab-pane>

      <el-tab-pane v-if="roles[0] === 'admin'" v-loading="updating" label="Set Role" name="third">
        <el-form ref="roleForm" :rules="ruleRole" :model="setRoleData" label-position="top" label-width="150px" style="max-width: 100%;">
          <el-form-item label="Email">
            <el-input v-model="user.email" :disabled="true" />
          </el-form-item>

          <!-- <el-form-item label="Password" prop="oldPassword">
            <el-input v-model="password.oldPassword" :type="pwdType" />
          </el-form-item> -->

          <el-form-item :label="$t('user.role')" prop="role">
            <el-select v-model="setRoleData.role" class="filter-item" placeholder="Please select role">
              <el-option v-for="item in optionRoles" :key="item" :label="item | uppercaseFirst" :value="item" />
            </el-select>
          </el-form-item>

          <el-form-item>
            <el-button type="primary" @click="onSubmitSetRole">
              Set Role
            </el-button>
          </el-form-item>
        </el-form>
      </el-tab-pane>
    </el-tabs>
  </el-card>
</template>

<script>
import { mapGetters } from 'vuex';
import Resource from '@/api/resource';
const userResource = new Resource('users');
const updatePasswordResource = new Resource('update-password');
const updateRoleResource = new Resource('update-role');

export default {
  props: {
    user: {
      type: Object,
      default: () => {
        return {
          name: '',
          email: '',
          avatar: '',
          roles: [],
        };
      },
    },
  },
  data() {
    var validateConfirmPassword = (rule, value, callback) => {
      if (value !== this.password.newPassword) {
        callback(new Error('Password tidak sama!'));
      } else {
        callback();
      }
    };
    return {
      activeActivity: 'first',
      carouselImages: [
        'https://cdn.laravue.dev/photo1.png',
        'https://cdn.laravue.dev/photo2.png',
        'https://cdn.laravue.dev/photo3.jpg',
        'https://cdn.laravue.dev/photo4.jpg',
      ],
      rules: {
        role: [{ required: true, message: 'Password is required', trigger: 'blur' }],
        newPassword: [{ required: true, message: 'password harus dimasukan', trigger: 'blur' }],
        confirmPassword: [{ validator: validateConfirmPassword, trigger: 'blur' }],
      },
      ruleRole: {
        role: [{ required: true, message: 'Role is required', trigger: 'blur' }],
      },
      updating: false,
      password: {},
      pwdType: 'password',
      optionRoles: ['admin', 'assesor', 'user'],
      setRoleData: {},
    };
  },
  computed: {
    ...mapGetters([
      'userId',
      'roles',
    ]),
  },
  methods: {
    showPwd() {
      if (this.pwdType === 'password') {
        this.pwdType = '';
      } else {
        this.pwdType = 'password';
      }
    },
    handleClick(tab, event) {
      console.log('Switching tab ', tab, event);
    },
    onSubmit() {
      this.updating = true;
      userResource
        .update(this.user.id, this.user)
        .then(response => {
          this.updating = false;
          this.$message({
            message: 'User information berhasil di update',
            type: 'success',
            duration: 5 * 1000,
          });
        })
        .catch(error => {
          console.log(error);
          this.updating = false;
        });
    },

    onSubmitPassword() {
      this.$refs['passwordForm'].validate((valid) => {
        if (valid) {
          this.password.email = this.user.email;
          this.updating = true;
          updatePasswordResource
            .update(this.user.id, this.password)
            .then(response => {
              this.updating = false;
              this.$message({
                message: 'User password berhasil di update',
                type: 'success',
                duration: 5 * 1000,
              });
            })
            .catch(error => {
              this.$message({
                message: error,
                type: 'error',
                duration: 5 * 1000,
              });
            })
            .finally(() => {
              this.updating = false;
            });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },

    onSubmitSetRole() {
      this.$refs['roleForm'].validate((valid) => {
        if (valid) {
          this.setRoleData.email = this.user.email;
          this.setRoleData.userId = this.user.id;
          this.setRoleData.submitRole = this.roles[0];
          this.updating = true;
          updateRoleResource
            .store(this.setRoleData)
            .then(response => {
              this.updating = false;
              this.$message({
                message: 'User Role berhasil di update',
                type: 'success',
                duration: 5 * 1000,
              });
            })
            .catch(error => {
              this.$message({
                message: error,
                type: 'error',
                duration: 5 * 1000,
              });
            })
            .finally(() => {
              this.updating = false;
            });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.user-activity {
  .user-block {
    .username, .description {
      display: block;
      margin-left: 50px;
      padding: 2px 0;
    }
    img {
      width: 40px;
      height: 40px;
      float: left;
    }
    :after {
      clear: both;
    }
    .img-circle {
      border-radius: 50%;
      border: 2px solid #d2d6de;
      padding: 2px;
    }
    span {
      font-weight: 500;
      font-size: 12px;
    }
  }
  .post {
    font-size: 14px;
    border-bottom: 1px solid #d2d6de;
    margin-bottom: 15px;
    padding-bottom: 15px;
    color: #666;
    .image {
      width: 100%;
    }
    .user-images {
      padding-top: 20px;
    }
  }
  .list-inline {
    padding-left: 0;
    margin-left: -5px;
    list-style: none;
    li {
      display: inline-block;
      padding-right: 5px;
      padding-left: 5px;
      font-size: 13px;
    }
    .link-black {
      &:hover, &:focus {
        color: #999;
      }
    }
  }
  .el-carousel__item h3 {
    color: #475669;
    font-size: 14px;
    opacity: 0.75;
    line-height: 200px;
    margin: 0;
  }

  .show-pwd {
      position: absolute;
      right: 10px;
      top: 7px;
      font-size: 16px;
      color: darkgray;
      cursor: pointer;
      user-select: none;
    }
  .svg-container {
      padding: 6px 5px 6px 15px;
      color: darkgrey;
      vertical-align: middle;
      width: 30px;
      display: inline-block;
    }

  .el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
  }

  .el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
  }
}
</style>
