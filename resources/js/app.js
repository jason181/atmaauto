require('./bootstrap');
// import Buefy from 'buefy';
import Vue from 'vue';
import Vuelidate from 'vuelidate';
import store from './store' 
import auth from './service/Auth'
import middleware from './middleware'
Vue.use(Vuelidate);

window.Vue = require('vue');
window.VueRouter = require('vue-router').default;
// Vue.use(Buefy,{defaultIconPack: 'fa'}, VueRouter, axios);

import AppLayout from './components/appLayout.vue';

Vue.config.productionTip = false;

const app = new Vue({
    el: '#app',
    components: {AppLayout},
    router,
    store,
    created() {
        try {
          auth.refresh()
        } catch (err) {
          // Do nothing :))
        }
      }
});
