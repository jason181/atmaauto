require('./bootstrap');
// import Buefy from 'buefy';
import Vue from 'vue';
import Vuelidate from 'vuelidate';
import store from './store' 
import auth from './service/Auth'
import middleware from './middleware'
import { routes } from './routes'
import VueApexCharts from 'vue-apexcharts'
Vue.use(Vuelidate);

window.Vue = require('vue');
window.VueRouter = require('vue-router').default;
// Vue.use(Buefy,{defaultIconPack: 'fa'}, VueRouter, axios);

import AppLayout from './components/appLayout.vue';
import App from './components/App.vue';

Vue.config.productionTip = false;

Vue.router = router

const router = new VueRouter({
  mode: 'history',
  routes,
})

new Vue({
  el: '#app',
  router,
  store,
  render: h => h(AppLayout),
  created() {
      try {
          auth.refresh()
      } catch (err) {
          // Do nothing :))
      }
  }
}).$mount('#app');

