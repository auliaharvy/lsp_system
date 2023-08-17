/** When your routing table is too long, you can split it into small modules**/
const previewRoutes = {
  path: '/preview-uji-komp',
  component: () => import('@/views/preview/index'),
  redirect: '/uji-komp/list',
  name: 'preview-uji-komp',
  alwaysShow: true,
  meta: {
    title: 'Preview Uji Kompetensi',
    icon: 'documentation',
    permissions: ['view menu administrator'],
  },
  hidden: true,
  children: [
    // {
    //   path: 'preview-page',
    //   component: () => import('@/views/preview/index'),
    //   name: 'preview-page',
    //   meta: { title: 'Preview', icon: 'list', permissions: ['manage user'] },
    // },
    {
      path: 'preview-apl-01/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_apl/01/index'),
      name: 'preview-apl-01',
      meta: { title: 'Preview APL 01', icon: 'list', permissions: ['manage user'], nextPage: 'preview-apl-02' },
    },
    {
      path: 'preview-apl-02/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_apl/02/index'),
      name: 'preview-apl-02',
      meta: { title: 'Preview APL 02', icon: 'list', permissions: ['manage user'], previousPage: 'preview-apl-01', nextPage: 'preview-mapa-02' },
    },
    {
      path: 'preview-mapa-02/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_mapa/02/index'),
      name: 'preview-mapa-02',
      meta: { title: 'Preview APL 01', icon: 'list', permissions: ['manage user'], previousPage: 'preview-apl-02', nextPage: 'preview-ak-01' },
    },
    {
      path: 'preview-ak-01/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_ak/01/index'),
      name: 'preview-ak-01',
      meta: { title: 'Preview AK 01', icon: 'list', permissions: ['manage user'], previousPage: 'preview-mapa-02', nextPage: 'preview-ak-04' },
    },
    {
      path: 'preview-ak-04/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_ak/04/index'),
      name: 'preview-ak-04',
      meta: { title: 'Preview AK 04', icon: 'list', permissions: ['manage user'], previousPage: 'preview-ak-01', nextPage: 'preview-ia-01' },
    },
    {
      path: 'preview-ia-01/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_ia/01/index'),
      name: 'preview-ia-01',
      meta: { title: 'Preview IA 01', icon: 'list', permissions: ['manage user'], previousPage: 'preview-ak-04', nextPage: 'preview-ia-02' },
    },
    {
      path: 'preview-ia-02/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_ia/02/index'),
      name: 'preview-ia-04',
      meta: { title: 'Preview IA 02', icon: 'list', permissions: ['manage user'], previousPage: 'preview-ia-01', nextPage: 'preview-ia-03' },
    },
    {
      path: 'preview-ia-03/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_ia/03/index'),
      name: 'preview-ia-03',
      meta: { title: 'Preview IA 03', icon: 'list', permissions: ['manage user'], previousPage: 'preview-ia-02' },
    },
    {
      path: 'preview-ia-05/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_ia/05/index'),
      name: 'preview-ia-05',
      meta: { title: 'Preview IA 05', icon: 'list', permissions: ['manage user'], previousPage: 'preview-ia-05' },
    },
    {
      path: 'preview-ia-06/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_ia/06/index'),
      name: 'preview-ia-06',
      meta: { title: 'Preview IA 06', icon: 'list', permissions: ['manage user'], previousPage: 'preview-ia-06' },
    },
    {
      path: 'preview-ia-07/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_ia/07/index'),
      name: 'preview-ia-07',
      meta: { title: 'Preview IA 07', icon: 'list', permissions: ['manage user'], previousPage: 'preview-ia-07' },
    },
    {
      path: 'preview-ia-11/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_ia/11/index'),
      name: 'preview-ia-11',
      meta: { title: 'Preview IA 11', icon: 'list', permissions: ['manage user'], previousPage: 'preview-ia-11' },
    },
    {
      path: 'preview-ak-02/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_ak/02/index'),
      name: 'preview-ak-02',
      meta: { title: 'Preview AK 02', icon: 'list', permissions: ['manage user'], previousPage: 'preview-ak-02' },
    },
    {
      path: 'preview-ak-03/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_ak/03/index'),
      name: 'preview-ak-03',
      meta: { title: 'Preview AK 03', icon: 'list', permissions: ['manage user'], previousPage: 'preview-ak-03' },
    },
    {
      path: 'preview-ak-05/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_ak/05/index'),
      name: 'preview-ak-05',
      meta: { title: 'Preview AK 05', icon: 'list', permissions: ['manage user'], previousPage: 'preview-ak-05' },
    },
    {
      path: 'preview-ak-06/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_ak/05/index'),
      name: 'preview-ak-06',
      meta: { title: 'Preview AK 06', icon: 'list', permissions: ['manage user'], previousPage: 'preview-ak-06' },
    },
    {
      path: 'preview-va/:iduji/:asesor/:idskema/:apl01/:apl02/:mapa02/:ak01/:ak04/:ia01/:ia02/:ia03/:ia05/:ia06/:ia07/:ia11/:ak02/:ak03/:ak05/:ak06/:va',
      component: () => import('@/views/preview/uji/fr_va/index'),
      name: 'preview-va',
      meta: { title: 'Preview VA', icon: 'list', permissions: ['manage user'], previousPage: 'preview-va' },
    },
  ],
};

export default previewRoutes;
