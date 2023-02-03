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
    icon: 'tickets',
    // TODO add view master data permission
    permissions: ['manage user'],
  },
  children: [
    /** Skema Sertifikasi */
    {
      path: 'jadwal',
      component: () => import('@/views/back-office/jadwal/List'),
      name: 'jadwal',
      meta: { title: 'Jadwal', icon: 'date', permissions: ['manage user'] },
    },
  ],
};

export default persiapanRoutes;
