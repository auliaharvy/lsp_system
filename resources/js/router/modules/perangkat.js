/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const perangkatRoutes = {
  path: '/perangkat',
  component: Layout,
  redirect: '/perangkat',
  name: 'Perangkat',
  alwaysShow: true,
  meta: {
    title: 'Perangkat',
    icon: 'admin',
    permissions: ['manage user'],
  },
  children: [
    /** Skema Sertifikasi */
    {
      path: 'perangkat',
      component: () => import('@/views/back-office/perangkat/List'),
      name: 'PerangkatList',
      meta: { title: 'Perangkat', icon: 'user', permissions: ['manage user'] },
    },
  ],
};

export default perangkatRoutes;
