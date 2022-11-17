/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const ujiRoutes = {
  path: '/uji-komp',
  component: Layout,
  redirect: '/uji-komp/list',
  name: 'uji-komp',
  alwaysShow: true,
  meta: {
    title: 'Uji Kompetensi',
    icon: 'documentation',
    permissions: ['view menu administrator'],
  },
  children: [
    {
      path: 'list',
      component: () => import('@/views/back-office/uji/List'),
      name: 'uji-komp-list',
      meta: { title: 'List', icon: 'list', permissions: ['manage user'] },
    },
    {
      path: 'form-apl-01',
      component: () => import('@/views/back-office/uji/fr_apl/01/index'),
      name: 'form-apl-01',
      meta: { title: 'Form APL 01', icon: 'date', permissions: ['manage user'] },
      hidden: true,
    },
    {
      path: 'form-ia-01',
      component: () => import('@/views/back-office/uji/fr_ia/01/index'),
      name: 'form-ia-01',
      meta: { title: 'Form IA 01', icon: 'date', permissions: ['manage user'] },
      hidden: true,
    },
    {
      path: 'form-ia-02',
      component: () => import('@/views/back-office/uji/fr_ia/02/index'),
      name: 'form-ia-02',
      meta: { title: 'Form IA 02', icon: 'date', permissions: ['manage user'] },
      hidden: true,
    },
    {
      path: 'form-ia-03',
      component: () => import('@/views/back-office/uji/fr_ia/03/index'),
      name: 'form-ia-03',
      meta: { title: 'Form IA 03', icon: 'date', permissions: ['manage user'] },
      hidden: true,
    },
    {
      path: 'form-ia-11',
      component: () => import('@/views/back-office/uji/fr_ia/11/index'),
      name: 'form-ia-11',
      meta: { title: 'Form IA 11', icon: 'date', permissions: ['manage user'] },
      hidden: true,
    },
    {
      path: 'form-ak-01',
      component: () => import('@/views/back-office/uji/fr_ak/01/index'),
      name: 'form-ak-01',
      meta: { title: 'Form AK 01', icon: 'date', permissions: ['manage user'] },
      hidden: true,
    },
    {
      path: 'form-ak-02',
      component: () => import('@/views/back-office/uji/fr_ak/02/index'),
      name: 'form-ak-02',
      meta: { title: 'Form AK 02', icon: 'date', permissions: ['manage user'] },
      hidden: true,
    },
    {
      path: 'form-ak-03',
      component: () => import('@/views/back-office/uji/fr_ak/03/index'),
      name: 'form-ak-03',
      meta: { title: 'Form AK 03', icon: 'date', permissions: ['manage user'] },
      hidden: true,
    },
    {
      path: 'form-ak-04',
      component: () => import('@/views/back-office/uji/fr_ak/04/index'),
      name: 'form-ak-04',
      meta: { title: 'Form AK 04', icon: 'date', permissions: ['manage user'] },
      hidden: true,
    },
    {
      path: 'form-ak-05',
      component: () => import('@/views/back-office/uji/fr_ak/05/index'),
      name: 'form-ak-05',
      meta: { title: 'Form AK 05', icon: 'date', permissions: ['manage user'] },
      hidden: true,
    },
    {
      path: 'form-ak-06',
      component: () => import('@/views/back-office/uji/fr_ak/06/index'),
      name: 'form-ak-06',
      meta: { title: 'Form AK 06', icon: 'date', permissions: ['manage user'] },
      hidden: true,
    },
  ],
};

export default ujiRoutes;
