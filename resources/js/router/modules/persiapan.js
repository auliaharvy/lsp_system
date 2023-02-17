/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const persiapanRoutes = {
  path: '/persiapan',
  component: Layout,
  redirect: '/persiapan/jadwal',
  name: 'Persiapan',
  alwaysShow: true,
  meta: {
    title: 'Persiapan',
    icon: 'skill',
    // TODO add view master data permission
    roles: ['admin', 'assesor'],
  },
  children: [
    /** Skema Sertifikasi */
    {
      path: 'jadwal',
      component: () => import('@/views/back-office/jadwal/List'),
      name: 'jadwal',
      meta: { title: 'Jadwal', icon: 'el-icon-date', roles: ['admin', 'assesor'] },
    },
  ],
};

export default persiapanRoutes;
