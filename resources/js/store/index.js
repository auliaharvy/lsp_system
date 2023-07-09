import Vue from 'vue';
import Vuex from 'vuex';
import getters from './getters';

Vue.use(Vuex);

// https://webpack.js.org/guides/dependency-management/#requirecontext
const modulesFiles = require.context('./modules', false, /\.js$/);

// you do not need `import app from './modules/app'`
// it will auto require all vuex module from modules file
const modules = modulesFiles.keys().reduce((modules, modulePath) => {
  // set './app.js' => 'app'
  const moduleName = (modulePath.replace(/^\.\/(.*)\.\w+$/, '$1')).replace(/-([a-z])/g, g => g[1].toUpperCase());
  // camelCase(modulePath.replace(/^\.\/(.*)\.\w+$/, '$1'));
  const value = modulesFiles(modulePath);
  modules[moduleName] = value.default;
  return modules;
}, {});

const store = new Vuex.Store({
  modules,
  getters,
  plugins: [
    (store) => {
      store.subscribeAction({
        before: (action, state) => {
          if (action.payload && action.payload.timeout) {
            action.payload.timeout = 30000; // Set timeout value to 30,000 milliseconds (30 seconds)
          }
        },
      });
    },
  ],
});

export default store;
