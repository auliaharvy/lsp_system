// import router, { resetRouter } from '@/router';
// import store from '@/store';

const state = {
  ujiKomp: {
    iduji: '',
    idskema: '',
    asesor: '',
    apl01: '',
    apl02: '',
    mapa02: '',
    ak01: '',
    ak04: '',
    ia01: '',
    ia02: '',
    ia03: '',
    ia05: '',
    ia06: '',
    ia07: '',
    ia11: '',
    ak02: '',
    ak03: '',
    ak05: '',
    ak06: '',
    va: '',
  },
};

const mutations = {
  SET_UJI_KOMP: (state, ujikomp) => {
    state.ujiKomp = {
      iduji: ujikomp.iduji,
      apl01: ujikomp.idskema,
      asesor: ujikomp.asesor,
      apl02: ujikomp.apl02,
      mapa02: ujikomp.mapa02,
      ak01: ujikomp.ak01,
      ak04: ujikomp.ak04,
      ia01: ujikomp.ia01,
      ia02: ujikomp.ia02,
      ia03: ujikomp.ia03,
      ia05: ujikomp.ia05,
      ia06: ujikomp.ia06,
      ia07: ujikomp.ia07,
      ia11: ujikomp.ia11,
      ak02: ujikomp.ak02,
      ak03: ujikomp.ak03,
      ak05: ujikomp.ak05,
      ak06: ujikomp.ak06,
      va: ujikomp.va,
    };
  },

};

const actions = {
  // user login
  ujiKomp({ commit, state }, payload) {
    commit('SET_UJI_KOMP', payload);
    console.log(state.ujiKomp.asesor);
  },
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
};
