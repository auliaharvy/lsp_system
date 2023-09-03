/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const skemaRoutes = {
  path: '/skema',
  component: Layout,
  redirect: '/skema/list',
  name: 'skema',
  alwaysShow: true,
  meta: {
    title: 'Skema',
    icon: 'education',
    permissions: ['view menu administrator'],
  },
  children: [
    {
      path: 'skema',
      component: () => import('@/views/back-office/skema/komponen/detail'),
      name: 'DetailSkema',
      meta: {
        title: 'Skema',
        icon: 'el-icon-files',
        permissions: ['manage user'],
      },
    },
    {
      path: 'ict',
      component: () => import('@/views/back-office/skema/komponen/detail'),
      name: 'skema-ict',
      meta: {
        title: 'Skema ICT',
        icon: 'list',
        permissions: ['manage user'],
      },
      hidden: true,
    },

  ],
};

export default skemaRoutes;
