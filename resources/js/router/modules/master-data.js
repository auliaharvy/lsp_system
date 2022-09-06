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
    icon: 'admin',
    // TODO add view master data permission
    permissions: ['view menu administrator'],
  },
  children: [
    /** Skema Sertifikasi */
    {
      path: 'skema',
      component: () => import('@/views/back-office/skema/List'),
      name: 'SkemaList',
      meta: { title: 'Skema', icon: 'user', permissions: ['manage user'] },
    },
    /** TUK managements */
    {
      path: 'tuk',
      component: () => import('@/views/back-office/tuk/List'),
      name: 'TukList',
      meta: { title: 'TUK', icon: 'user', permissions: ['manage user'] },
    },
    /** Assesor managements */
    {
      path: 'assesor',
      component: () => import('@/views/back-office/asesor/List'),
      name: 'AssesorList',
      meta: { title: 'Assesor', icon: 'user', permissions: ['manage user'] },
    },
    /** Skema managements */
    {
      path: 'skema/kategori',
      component: () => import('@/views/back-office/skema/kategori/List'),
      name: 'Kategori Skema',
      meta: { title: 'Kategori', icon: 'user', permissions: ['manage user'] },
    },
  ],
};

export default masterRoutes;
