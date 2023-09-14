/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const masterRoutes = {
  path: '/master-data',
  component: Layout,
  redirect: '/master-data/tuk',
  name: 'Master Data',
  alwaysShow: true,
  meta: {
    title: 'Master Data',
    icon: 'education',
    // TODO add view master data permission
    permissions: ['manage user'],
  },
  children: [
    /** Skema Sertifikasi */
    {
      path: 'skema',
      component: () => import('@/views/back-office/skema/List'),
      name: 'SkemaList',
      meta: {
        title: 'Skema',
        icon: 'el-icon-files',
        permissions: ['manage user'],
      },
    },
    {
      path: 'perangkat',
      component: () => import('@/views/back-office/perangkat/List'),
      name: 'PerangkatList',
      meta: {
        title: 'Perangkat',
        icon: 'clipboard',
        permissions: ['manage user'],
      },
    },
    /** TUK managements */
    {
      path: 'tuk',
      component: () => import('@/views/back-office/tuk/List'),
      name: 'TukList',
      meta: {
        title: 'TUK',
        icon: 'el-icon-office-building',
        permissions: ['manage user'],
      },
    },
    /** Assesor managements */
    {
      path: 'assesor',
      component: () => import('@/views/back-office/asesor/List'),
      name: 'AssesorList',
      meta: {
        title: 'Assesor',
        icon: 'peoples',
        permissions: ['manage user'],
      },
    },
    /** Skema managements */
    {
      path: 'skema/kategori',
      component: () => import('@/views/back-office/skema/kategori/List'),
      name: 'Kategori Skema',
      meta: {
        title: 'Kategori',
        icon: 'tree',
        permissions: ['manage user'],
      },
    },
    /** Master Mapa 02 */
    {
      path: 'mapa02',
      component: () => import('@/views/back-office/mapa02/List'),
      name: 'Mapa 02',
      meta: {
        title: 'MAPA 02',
        icon: 'el-icon-document-checked',
        permissions: ['manage user'],
      },
    },

    /** DUDI */
    {
      path: 'dudi',
      component: () => import('@/views/back-office/dudi/List'),
      name: 'Dudi',
      meta: {
        title: 'DUDI',
        icon: 'el-icon-office-building',
        permissions: ['manage user'],
      },
    },

    /** KKNI */
    {
      path: 'kkni',
      component: () => import('@/views/back-office/kkni/List'),
      name: 'Kkni',
      meta: {
        title: 'KKNI',
        icon: 'el-icon-s-claim',
        permissions: ['manage user'],
      },
    },

  ],
};

export default masterRoutes;
