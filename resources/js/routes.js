import middleware, { auth } from './middleware'

import HomeLayout from './components/layout/HomeLayout.vue';
import Pegawai from './components/layout/pegawai.vue';
import Jasa_Service from './components/layout/jasa_service.vue';
import Supplier from './components/layout/supplier.vue';
import Sparepart from './components/layout/sparepart.vue';


export const routes = ({
    mode: 'history',
    routes:[
        {
            name: 'HomeLayout',
            path: '/',
            component: HomeLayout,
        },
        {
            name: 'Pegawai',
            path: '/pegawai',
            component: Pegawai,
            meta: { role: [
                'Admin'
            ]},
            beforeEnter: middleware([
                auth
            ]) 
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