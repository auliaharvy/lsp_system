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
  children: [{
    path: 'list',
    component: () => import('@/views/back-office/uji/List'),
    name: 'uji-komp-list',
    meta: {
      title: 'List',
      icon: 'list',
      permissions: ['manage user'],
    },
  },
  {
    path: 'preview-page',
    component: () => import('@/views/preview/index'),
    name: 'preview-page',
    meta: {
      title: 'Preview',
      icon: 'list',
      permissions: ['manage user'],
    },
  },
  {
    path: 'preview-apl-01/:iduji/:asesor/:apl01',
    component: () => import('@/views/preview/uji/fr_apl/01/index'),
    name: 'preview-apl-01',
    meta: {
      title: 'Preview APL 01',
      icon: 'list',
      permissions: ['manage user'],
      nextPage: 'preview-apl-02',
    },
  },
  {
    path: 'preview-apl-02/:iduji/:asesor/:apl01/:apl02',
    component: () => import('@/views/preview/uji/fr_apl/02/index'),
    name: 'preview-apl-02',
    meta: {
      title: 'Preview APL 02',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-apl-01',
      nextPage: 'preview-mapa-02',
    },
  },
  {
    path: 'preview-mapa-02/:iduji/:asesor/:mapa02',
    component: () => import('@/views/preview/uji/fr_mapa/02/index'),
    name: 'preview-mapa-02',
    meta: {
      title: 'Preview MAPA 02',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-apl-02',
      nextPage: 'preview-ak-01',
    },
  },
  {
    path: 'preview-ak-01/:iduji/:asesor/:ak01',
    component: () => import('@/views/preview/uji/fr_ak/01/index'),
    name: 'preview-ak-01',
    meta: {
      title: 'Preview AK 01',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-mapa-02',
      nextPage: 'preview-ak-04',
    },
  },
  {
    path: 'preview-ak-04/:iduji/:asesor/:ak04',
    component: () => import('@/views/preview/uji/fr_ak/04/index'),
    name: 'preview-ak-04',
    meta: {
      title: 'Preview AK 04',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-ak-01',
      nextPage: 'preview-ia-01',
    },
  },
  {
    path: 'preview-ia-01/:iduji/:asesor/:ia01',
    component: () => import('@/views/preview/uji/fr_ia/01/index'),
    name: 'preview-ia-01',
    meta: {
      title: 'Preview IA 01',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-ak-04',
      nextPage: 'preview-ia-02',
    },
  },
  {
    path: 'preview-ia-02/:iduji/:asesor/:ia02',
    component: () => import('@/views/preview/uji/fr_ia/02/index'),
    name: 'preview-ia-02',
    meta: {
      title: 'Preview IA 02',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-ia-01',
      nextPage: 'preview-ia-03',
    },
  },
  {
    path: 'preview-ia-03/:iduji/:asesor/:ia03',
    component: () => import('@/views/preview/uji/fr_ia/03/index'),
    name: 'preview-ia-03',
    meta: {
      title: 'Preview IA 03',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-ia-02',
    },
  },
  {
    path: 'preview-ia-05/:iduji/:asesor/:ia05',
    component: () => import('@/views/preview/uji/fr_ia/05/index'),
    name: 'preview-ia-05',
    meta: {
      title: 'Preview IA 05',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-ia-05',
    },
  },
  {
    path: 'preview-ia-06/:iduji/:asesor/:ia06',
    component: () => import('@/views/preview/uji/fr_ia/06/index'),
    name: 'preview-ia-06',
    meta: {
      title: 'Preview IA 06',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-ia-06',
    },
  },
  {
    path: 'preview-ia-07/:iduji/:asesor/:ia07',
    component: () => import('@/views/preview/uji/fr_ia/07/index'),
    name: 'preview-ia-07',
    meta: {
      title: 'Preview IA 07',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-ia-07',
    },
  },
  {
    path: 'preview-ia-11/:iduji/:asesor/:ia11',
    component: () => import('@/views/preview/uji/fr_ia/11/index'),
    name: 'preview-ia-11',
    meta: {
      title: 'Preview IA 11',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-ia-11',
    },
  },
  {
    path: 'preview-ak-02/:iduji/:asesor/:ak02',
    component: () => import('@/views/preview/uji/fr_ak/02/index'),
    name: 'preview-ak-02',
    meta: {
      title: 'Preview AK 02',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-ak-02',
    },
  },
  {
    path: 'preview-ak-03/:iduji/:asesor/:ak03',
    component: () => import('@/views/preview/uji/fr_ak/03/index'),
    name: 'preview-ak-03',
    meta: {
      title: 'Preview AK 03',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-ak-03',
    },
  },
  {
    path: 'preview-ak-05/:iduji/:asesor/:ak05',
    component: () => import('@/views/preview/uji/fr_ak/05/index'),
    name: 'preview-ak-05',
    meta: {
      title: 'Preview AK 05',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-ak-05',
    },
  },
  {
    path: 'preview-ak-06/:iduji/:ak06',
    component: () => import('@/views/preview/uji/fr_ak/05/index'),
    name: 'preview-ak-06',
    meta: {
      title: 'Preview AK 06',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-ak-06',
    },
  },
  {
    path: 'preview-va/:iduji/:va',
    component: () => import('@/views/preview/uji/fr_va/index'),
    name: 'preview-va',
    meta: {
      title: 'Preview VA',
      icon: 'list',
      permissions: ['manage user'],
      previousPage: 'preview-va',
    },
  },

  {
    // path: 'preview-page/:id-uji',
    path: 'preview-page',
    name: 'preview-page',
    component: () => import('@/views/preview/index'),
    hidden: true,
  },
  ],
};

export default ujiRoutes;
