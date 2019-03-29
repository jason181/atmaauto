require('./bootstrap');
// import Buefy from 'buefy';

window.Vue = require('vue');
window.VueRouter = require('vue-router').default;
// Vue.use(Buefy,{defaultIconPack: 'fa'}, VueRouter, axios);

import AppLayout from './components/appLayout.vue';
import HomeLayout from './components/layout/HomeLayout.vue';
import Pegawai from './components/layout/pegawai.vue';

Vue.config.productionTip = false;

const router = new VueRouter({
    mode: 'history',
    routes:[
        {
            name: 'HomeLayout',
            path: '/',
            component: HomeLayout
        },
        {
            name: 'Pegawai',
            path: '/pegawai',
            component: Pegawai
        },

    ]
})

const app = new Vue({
    el: '#app',
    components: {AppLayout},
    router,
});
