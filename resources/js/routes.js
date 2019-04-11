import middleware, { auth } from './middleware'

import AppLayout from './components/appLayout.vue';
import HomeLayout from './components/layout/HomeLayout.vue';
import Pegawai from './components/layout/pegawai.vue';
import Jasa_Service from './components/layout/jasa_service.vue';
import Supplier from './components/layout/supplier.vue';
import Sparepart from './components/layout/sparepart.vue';

export const routes = [
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
        component: Jasa_Service,
        meta: { role: [
            'Admin'
        ]},
        beforeEnter: middleware([
            auth
        ])
    },
    {
        name: 'Supplier',
        path: '/supplier',
        component: Supplier,
        meta: { role: [
            'Admin'
        ]},
        beforeEnter: middleware([
            auth
        ])
    },
    {
        name: 'Sparepart',
        path: '/sparepart',
        component: Sparepart,
        meta: { role: [
            'Admin'
        ]},
        beforeEnter: middleware([
            auth
        ])
    },
]
