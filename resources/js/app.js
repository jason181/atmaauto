require('./bootstrap');
// import Buefy from 'buefy';

window.Vue = require('vue');
window.VueRouter = require('vue-router').default;
// Vue.use(Buefy,{defaultIconPack: 'fa'}, VueRouter, axios);

import AppLayout from './components/appLayout.vue';
import HomeLayout from './components/layout/HomeLayout.vue';
import Pegawai from './components/layout/pegawai.vue';
import Jasa_Service from './components/layout/jasa_service.vue';
import Supplier from './components/layout/supplier.vue';
import Sparepart from './components/layout/sparepart.vue';

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
        {
            name: 'Jasa_Service',
            path: '/jasa_service',
            component: Jasa_Service
        },
        {
            name: 'Supplier',
            path: '/supplier',
            component: Supplier
        },
        {
            name: 'Sparepart',
            path: '/sparepart',
            component: Sparepart
        },
    ]
})

const app = new Vue({
    el: '#app',
    components: {AppLayout},
    router,
});
