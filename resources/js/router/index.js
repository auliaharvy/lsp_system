import Vue from 'vue';
import Router from 'vue-router';

/**
 * Layzloading will create many files and slow on compiling, so best not to use lazyloading on devlopment.
 * The syntax is lazyloading, but we convert to proper require() with babel-plugin-syntax-dynamic-import
 * @see https://doc.laravue.dev/guide/advanced/lazy-loading.html
 */

Vue.use(Router);

/* Layout */
import Layout from '@/layout';

/* Router for modules */
// import elementUiRoutes from './modules/element-ui';
// import componentRoutes from './modules/components';
// import chartsRoutes from './modules/charts';
// import tableRoutes from './modules/table';
import adminRoutes from './modules/admin';
// import nestedRoutes from './modules/nested';
import errorRoutes from './modules/error';
// import excelRoutes from './modules/excel';
// import permissionRoutes from './modules/permission';
import masterRoutes from './modules/master-data';
// import perangkatRoutes from './modules/perangkat';
import persiapanRoutes from './modules/persiapan';
import ujiRoutes from './modules/uji-komp';
import previewRoutes from './modules/preview';
// import skemaRoutes from './modules/skema';

/**
 * Sub-menu only appear when children.length>=1
 * @see https://doc.laravue.dev/guide/essentials/router-and-nav.html
 **/

/**
* hidden: true                   if `hidden:true` will not show in the sidebar(default is false)
* alwaysShow: true               if set true, will always show the root menu, whatever its child routes length
*                                if not set alwaysShow, only more than one route under the children
*                                it will becomes nested mode, otherwise not show the root menu
* redirect: noredirect           if `redirect:noredirect` will no redirect in the breadcrumb
* name:'router-name'             the name is used by <keep-alive> (must set!!!)
* meta : {
    roles: ['admin', 'editor']   Visible for these roles only
    permissions: ['view menu zip', 'manage user'] Visible for these permissions only
    title: 'title'               the name show in sub-menu and breadcrumb (recommend set)
    icon: 'svg-name'             the icon show in the sidebar
    noCache: true                if true, the page will no be cached(default is false)
    breadcrumb: false            if false, the item will hidden in breadcrumb (default is true)
    affix: true                  if true, the tag will affix in the tags-view
  }
**/

export const constantRoutes = [
  {
    path: '/redirect',
    component: Layout,
    hidden: true,
    children: [
      {
        path: '/redirect/:path*',
        component: () => import('@/views/redirect/index'),
      },
    ],
  },
  // front page
  {

    path: '/',
    name: 'homepage',
    component: () => import('@/views/frontpage/index'),
    hidden: true,
  },

  {
    path: '/pemegang-sertifikat',
    component: () => import('@/views/back-office/pemegang-sertifikat/Index'),
    hidden: true,
  },
  {
    path: '/jadwal-assesmen',
    component: () => import('@/views/back-office/jadwal/Index'),
    hidden: true,
  },
  {
    path: '/form-apl-02',
    component: () => import('@/views/frontpage/form-apl-02/index'),
    hidden: true,
  },
  {
    path: '/skema/:id/:kategori',
    component: () => import('@/views/back-office/skema/komponen/index'),
    hidden: true,
  },

  {
    path: '/kegiatan',
    name: 'kegiatan',
    component: () => import('@/views/articles/Index'),
    hidden: true,
  },

  {
    path: '/kegiatan/:slug',
    name: 'detailKegiatan',
    component: () => import('@/views/articles/Index'),
    hidden: true,
  },

  {
    path: '/assesor',
    component: () => import('@/views/back-office/asesor/Index'),
    hidden: true,
  },

  {
    path: '/dudi',
    component: () => import('@/views/back-office/dudi/Index'),
    hidden: true,
  },

  {
    path: '/kkni',
    component: () => import('@/views/back-office/kkni/Index'),
    hidden: true,
  },

  {
    path: '/tuk',
    component: () => import('@/views/back-office/tuk/Index'),
    hidden: true,
  },

  {
    path: '/tentang-lsp',
    component: () => import('@/views/frontpage/tentang-lsp/Index'),
    hidden: true,
  },

  {
    path: '/visi-misi',
    component: () => import('@/views/frontpage/visi-misi/Index'),
    hidden: true,
  },

  {
    path: '/struktur-organisasi',
    component: () => import('@/views/frontpage/struktur-organisasi/Index'),
    hidden: true,
  },

  {
    path: '/stakeholder',
    component: () => import('@/views/frontpage/stakeholder/Index'),
    hidden: true,
  },

  {
    path: '/komitmen-ketidakberpihakan',
    component: () => import('@/views/frontpage/komitmen-ketidakberpihakan/Index'),
    hidden: true,
  },

  {
    path: '/rencana-strategis',
    component: () => import('@/views/frontpage/rencana-strategis/Index'),
    hidden: true,
  },

  {
    path: '/program-kerja',
    component: () => import('@/views/frontpage/program-kerja/Index'),
    hidden: true,
  },

  {
    path: '/mitra-kerja',
    component: () => import('@/views/frontpage/mitra-kerja/Index'),
    hidden: true,
  },

  {
    path: '/pdf-viewer',
    component: () => import('@/views/pdf/PdfViewer'),
    hidden: true,
  },
  // {
  //   // path: '/preview-page/:id',
  //   path: '/preview-page',
  //   name: 'preview-page',
  //   component: () => import('@/views/preview/index'),
  //   hidden: true,
  // },

  {
    path: '/penelusuran-tamatan',
    component: () => import('@/views/frontpage/penelusuran/index'),
    hidden: true,
  },

  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/login/index'),
    hidden: true,
  },
  {
    path: '/auth-redirect',
    component: () => import('@/views/login/AuthRedirect'),
    hidden: true,
  },
  {
    path: '/404',
    redirect: { name: 'Page404' },
    component: () => import('@/views/error-page/404'),
    hidden: true,
  },
  {
    path: '/401',
    component: () => import('@/views/error-page/401'),
    hidden: true,
  },
  {
    path: '',
    component: Layout,
    redirect: 'dashboard',
    children: [
      {
        path: 'dashboard',
        component: () => import('@/views/dashboard/index'),
        name: 'Dashboard',
        meta: { title: 'dashboard', icon: 'dashboard', noCache: false },
      },
    ],
  },
  ujiRoutes,
  previewRoutes,
  // skemaRoutes,
  // {
  //   path: '/documentation',
  //   component: Layout,
  //   redirect: '/documentation/index',
  //   children: [
  //     {
  //       path: 'index',
  //       component: () => import('@/views/documentation/index'),
  //       name: 'Documentation',
  //       meta: { title: 'documentation', icon: 'documentation', noCache: true },
  //     },
  //   ],
  // },
  {
    path: '/profile',
    component: Layout,
    redirect: '/profile/edit',
    children: [
      {
        path: 'edit',
        component: () => import('@/views/users/SelfProfile'),
        name: 'SelfProfile',
        meta: { title: 'userProfile', icon: 'user', noCache: true },
      },
    ],
  },
  // {
  //   path: '/guide',
  //   component: Layout,
  //   redirect: '/guide/index',
  //   children: [
  //     {
  //       path: 'index',
  //       component: () => import('@/views/guide/index'),
  //       name: 'Guide',
  //       meta: { title: 'guide', icon: 'guide', noCache: true },
  //     },
  //   ],
  // },
  // elementUiRoutes,
];

export const asyncRoutes = [
  persiapanRoutes,
  // permissionRoutes,
  // componentRoutes,
  // chartsRoutes,
  // nestedRoutes,
  // tableRoutes,
  // perangkatRoutes,
  masterRoutes,
  adminRoutes,
  // {
  //   path: '/theme',
  //   component: Layout,
  //   redirect: 'noredirect',
  //   children: [
  //     {
  //       path: 'index',
  //       component: () => import('@/views/theme/index'),
  //       name: 'Theme',
  //       meta: { title: 'theme', icon: 'theme' },
  //     },
  //   ],
  // },
  // {
  //   path: '/clipboard',
  //   component: Layout,
  //   redirect: 'noredirect',
  //   meta: { permissions: ['view menu clipboard'] },
  //   children: [
  //     {
  //       path: 'index',
  //       component: () => import('@/views/clipboard/index'),
  //       name: 'ClipboardDemo',
  //       meta: { title: 'clipboardDemo', icon: 'clipboard', roles: ['admin', 'manager', 'editor', 'user'] },
  //     },
  //   ],
  // },
  errorRoutes,
  // skemaRoutes,
  // excelRoutes,
  // {
  //   path: '/zip',
  //   component: Layout,
  //   redirect: '/zip/download',
  //   alwaysShow: true,
  //   meta: { title: 'zip', icon: 'zip', permissions: ['view menu zip'] },
  //   children: [
  //     {
  //       path: 'download',
  //       component: () => import('@/views/zip'),
  //       name: 'ExportZip',
  //       meta: { title: 'exportZip' },
  //     },
  //   ],
  // },
  // {
  //   path: '/pdf',
  //   component: Layout,
  //   redirect: '/pdf/index',
  //   meta: { title: 'pdf', icon: 'pdf', permissions: ['view menu pdf'] },
  //   children: [
  //     {
  //       path: 'index',
  //       component: () => import('@/views/pdf'),
  //       name: 'Pdf',
  //       meta: { title: 'pdf' },
  //     },
  //   ],
  // },
  // {
  //   path: '/pdf/download',
  //   component: () => import('@/views/pdf/Download'),
  //   hidden: true,
  // },
  // {
  //   path: '/i18n',
  //   component: Layout,
  //   meta: { permissions: ['view menu i18n'] },
  //   children: [
  //     {
  //       path: 'index',
  //       component: () => import('@/views/i18n'),
  //       name: 'I18n',
  //       meta: { title: 'i18n', icon: 'international' },
  //     },
  //   ],
  // },
  // {
  //   path: '/external-link',
  //   component: Layout,
  //   children: [
  //     {
  //       path: 'https://github.com/tuandm/laravue',
  //       meta: { title: 'externalLink', icon: 'link' },
  //     },
  //   ],
  // },
  { path: '*', redirect: '/404', hidden: true },
];

const createRouter = () => new Router({
  // mode: 'history', // require service support
  scrollBehavior: () => ({ y: 0 }),
  base: process.env.MIX_LARAVUE_PATH,
  routes: constantRoutes,
});

const router = createRouter();

// Detail see: https://github.com/vuejs/vue-router/issues/1234#issuecomment-357941465
export function resetRouter() {
  const newRouter = createRouter();
  router.matcher = newRouter.matcher; // reset router
}

export default router;
