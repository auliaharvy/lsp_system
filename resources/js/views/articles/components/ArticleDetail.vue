<template>
  <div class="createPost-container">
    <el-form ref="postForm" :model="postForm" :rules="rules" class="form-container">
      <sticky :class-name="'sub-navbar '+postForm.status">
        <!-- <CommentDropdown v-model="postForm.comment_disabled" />
        <PlatformDropdown v-model="postForm.platforms" />
        <SourceUrlDropdown v-model="postForm.source_uri" /> -->
        <el-button
          v-if="$route.name === 'EditArticle'"
          v-loading="loading"
          style="margin-left: 10px;"
          type="success"
          @click="submitFormEdit"
        >
          Submit
        </el-button>
        <el-button
          v-if="$route.name === 'CreateArticle'"
          v-loading="loading"
          style="margin-left: 10px;"
          type="success"
          @click="submitForm"
        >
          Submit
        </el-button>

        <el-button v-loading="loading" type="warning" @click="draftForm">
          Draft
        </el-button>
      </sticky>

      <div class="createPost-main-container">
        <el-row>
          <el-col :span="24">
            <el-form-item style="margin-bottom: 40px;" prop="judul">
              <MDinput v-model="postForm.judul" :maxlength="100" :name="$t('article.create.judul')" required>
                {{ $t('article.create.judul') }}
              </MDinput>
            </el-form-item>
            <el-form-item style="margin-bottom: 40px;" prop="description">
              <MDinput v-model="postForm.description" :maxlength="100" :name="$t('article.create.deskripsi')" required>
                {{ $t('article.create.deskripsi') }}
              </MDinput>
            </el-form-item>
            <el-form-item style="margin-bottom: 40px;" prop="kategori">
              <MDinput v-model="postForm.kategori" :maxlength="100" :name="$t('article.create.kategori')" required>
                {{ $t('article.create.kategori') }}
              </MDinput>
            </el-form-item>
            <div class="postInfo-container">
              <el-row>
                <!-- <el-col :span="8">
                  <el-form-item label-width="80px" label="Author:" class="postInfo-container-item">
                    <el-select
                      v-model="postForm.ostForm.author"
                      :remote-method="getRemoteUserList"
                      filterable
                      remote
                      placeholder="Search user"
                    >
                      <el-option
                        v-for="(item,index) in userListOptions"
                        :key="item+index"
                        :label="item"
                        :value="item"
                      />
                    </el-select>
                  </el-form-item>
                </el-col> -->

                <!-- <el-col :span="10">
                  <el-form-item
                    label-width="120px"
                    label="Published date:"
                    class="postInfo-container-item"
                  >
                    <el-date-picker
                      v-model="postForm.display_time"
                      type="datetime"
                      format="yyyy-MM-dd HH:mm:ss"
                      placeholder="Select date and time"
                    />
                  </el-form-item>
                </el-col> -->

                <!-- <el-col :span="6">
                  <el-form-item
                    label-width="80px"
                    label="Important:"
                    class="postInfo-container-item"
                  >
                    <el-rate
                      v-model="postForm.importance"
                      :max="3"
                      :colors="['#99A9BF', '#F7BA2A', '#FF9900']"
                      :low-threshold="1"
                      :high-threshold="3"
                      style="margin-top:8px;"
                    />
                  </el-form-item>
                </el-col> -->
              </el-row>
            </div>
          </el-col>
        </el-row>

        <!-- <el-form-item style="margin-bottom: 40px;" label-width="80px" :label="$t('article.create.deskripsi') + ':'">
          <el-input
            v-model="postForm.content_short"
            :rows="1"
            type="textarea"
            class="article-textarea"
            autosize
            placeholder="Please enter the content"
          />
          <span v-show="contentShortLength" class="word-counter">{{ contentShortLength }} word</span>
        </el-form-item> -->

        <el-form-item prop="content" style="margin-bottom: 30px;">
          <Tinymce ref="editor" v-model="postForm.content" :height="400" />
        </el-form-item>

        <el-form-item :label="$t('article.create.uploadImageHeader')" prop="image">
          <input type="file" @change="handleUploadSuccess">
        </el-form-item>

        <!-- <el-form-item prop="image" style="margin-bottom: 30px;">
          <div>{{ $t('article.create.uploadImageHeader') }}</div>
          <Upload v-model="postForm.image" />
        </el-form-item> -->
      </div>
    </el-form>
  </div>
</template>

<script>
import Tinymce from '@/components/Tinymce';
// import Upload from '@/components/Upload/SingleImage';
import MDinput from '@/components/MDinput';
import Sticky from '@/components/Sticky'; // Sticky headers
import { validURL } from '@/utils/validate';
import { fetchArticle } from '@/api/article';
import { userSearch } from '@/api/search';
import Resource from '@/api/resource';

const articleResource = new Resource('article');
const articleUpdateResource = new Resource('article/update');
// import {
//   CommentDropdown,
//   PlatformDropdown,
//   SourceUrlDropdown,
// } from './Dropdown';

const defaultForm = {
  // status: 'draft',
  // title: '',
  // content: '',
  // content_short: '',
  // source_uri: '',
  // image_uri: '',
  // display_time: undefined,
  // id: undefined,
  // platforms: ['a-platform'],
  // comment_disabled: false,
  // importance: 0,
  judul: '',
  description: '',
  content: '',
  kategori: '',
  image: '',
};

export default {
  name: 'ArticleDetail',
  components: {
    Tinymce,
    MDinput,
    // Upload,
    Sticky,
    // CommentDropdown,
    // PlatformDropdown,
    // SourceUrlDropdown,
  },
  props: {
    isEdit: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    const validateRequire = (rule, value, callback) => {
      if (value === '') {
        this.$message({
          message: rule.field + ' is required',
          type: 'error',
        });
        callback(new Error(rule.field + ' is required'));
      } else {
        callback();
      }
    };
    const validateSourceUri = (rule, value, callback) => {
      if (value) {
        if (validURL(value)) {
          callback();
        } else {
          this.$message({
            message: 'External URL is invalid.',
            type: 'error',
          });
          callback(new Error('External URL is invalid.'));
        }
      } else {
        callback();
      }
    };
    return {
      postForm: Object.assign({}, defaultForm),
      loading: false,
      userListOptions: [],
      rules: {
        image_uri: [{ validator: validateRequire }],
        title: [{ validator: validateRequire }],
        content: [{ validator: validateRequire }],
        image: [{ validator: validateRequire }],
        source_uri: [{ validator: validateSourceUri, trigger: 'blur' }],
      },
      tempRoute: {},
    };
  },
  computed: {
    contentShortLength() {
      return this.postForm.content_short.length;
    },
    lang() {
      return this.$store.getters.language;
    },
  },
  created() {
    if (this.isEdit) {
      const id = this.$route.params && this.$route.params.id;
      this.getArticle(id);
    } else {
      this.postForm = Object.assign({}, defaultForm);
    }

    // Why need to make a copy of this.$route here?
    // Because if you enter this page and quickly switch tag, may be in the execution of the setTagsViewTitle function, this.$route is no longer pointing to the current page
    this.tempRoute = Object.assign({}, this.$route);
  },
  methods: {
    handleUploadSuccess(e) {
      const files = e.target.files;
      const rawFile = files[0]; // only use files[0]
      this.postForm.image = rawFile;
    },
    async getArticle(id){
      const data = await articleResource.get(id);
      this.postForm = data;
      console.log('test');
      console.log(this.postForm);
    },
    fetchData(id) {
      fetchArticle(id)
        .then(response => {
          this.postForm = response.data;
          // Just for test
          this.postForm.title += `   Article Id:${this.postForm.id}`;
          this.postForm.content_short += `   Article Id:${this.postForm.id}`;

          // Set tagsview title
          this.setTagsViewTitle();
        })
        .catch(err => {
          console.log(err);
        });
    },
    setTagsViewTitle() {
      const title =
        this.lang === 'zh'
          ? '编辑文章'
          : this.lang === 'vi'
            ? 'Chỉnh sửa'
            : 'Edit Article'; // Should move to i18n
      const route = Object.assign({}, this.tempRoute, {
        title: `${title}-${this.postForm.id}`,
      });
      this.$store.dispatch('updateVisitedView', route);
    },
    resetPostForm() {
      this.postForm = {};
    },
    submitForm() {
      this.postForm.display_time = parseInt(this.display_time / 1000);
      this.$refs.postForm.validate(valid => {
        if (valid) {
          this.loading = true;
          const uploadData = new FormData();
          uploadData.append('judul', this.postForm.judul);
          uploadData.append('description', this.postForm.description);
          uploadData.append('content', this.postForm.content);
          uploadData.append('kategori', this.postForm.kategori);
          uploadData.append('file', this.postForm.image);
          // console.log(this.postForm);
          articleResource
            .store(uploadData)
            .then((response) => {
              this.resetPostForm();
              this.$notify({
                title: 'Success',
                message: 'Article has been published successfully',
                type: 'success',
                duration: 2000,
              });
              this.postForm.status = 'published';
              this.loading = false;
              this.$router.push({ path: '/administrator/articles' }).then(() => {
                window.location.reload();
              });
            });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    submitFormEdit() {
      this.postForm.display_time = parseInt(this.display_time / 1000);
      this.$refs.postForm.validate(valid => {
        if (valid) {
          this.loading = true;
          const uploadData = new FormData();
          uploadData.append('id', this.postForm.id);
          uploadData.append('judul', this.postForm.judul);
          uploadData.append('description', this.postForm.description);
          uploadData.append('content', this.postForm.content);
          uploadData.append('kategori', this.postForm.kategori);
          uploadData.append('file', this.postForm.image);
          console.log(this.postForm);
          // console.log(uploadData);
          articleUpdateResource
            .store(uploadData)
            .then((response) => {
              console.log(response);
              this.resetPostForm();
              this.$notify({
                title: 'Success',
                message: 'Article has been edited successfully',
                type: 'success',
                duration: 2000,
              });
              this.loading = false;
              this.postForm.status = 'published';
              this.$router.push({ path: '/administrator/articles' }).then(() => {
                window.location.reload();
              });
            });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    draftForm() {
      if (
        this.postForm.content.length === 0 ||
        this.postForm.title.length === 0
      ) {
        this.$message({
          message: 'Please enter required title and content',
          type: 'warning',
        });
        return;
      }
      this.$message({
        message: 'Successfully saved',
        type: 'success',
        showClose: true,
        duration: 1000,
      });
      this.postForm.status = 'draft';
    },
    getRemoteUserList(query) {
      userSearch(query).then(response => {
        if (!response.data.items) {
          return;
        }
        this.userListOptions = response.data.items.map(v => v.name);
      });
    },
  },
};
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
@import "~@/styles/mixin.scss";
.createPost-container {
  position: relative;
  .createPost-main-container {
    padding: 0 45px 20px 50px;
    .postInfo-container {
      position: relative;
      @include clearfix;
      margin-bottom: 10px;
      .postInfo-container-item {
        float: left;
      }
    }
  }
  .word-counter {
    width: 40px;
    position: absolute;
    right: -10px;
    top: 0px;
  }
}
</style>
<style>
.createPost-container label.el-form-item__label {
  text-align: left;
}
</style>
