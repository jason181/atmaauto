import middleware, { auth } from './middleware'

import AppLayout from './components/appLayout.vue';
import Login from './components/layout/login.vue';
import Pegawai from './components/layout/pegawai.vue';
import Jasa_Service from './components/layout/jasa_service.vue';
import Supplier from './components/layout/supplier.vue';
import Sparepart from './components/layout/sparepart.vue';
import Home from './components/layout/home.vue';
import Katalog from './components/layout/katalog.vue';
import Status from './components/layout/status.vue';
import { homedir } from 'os';
import Cabang from './components/layout/Cabang.vue';

export const routes = [
    {
        name: 'Login',
        path: '/login',
        component: Login,
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
        meta: { 
            role: [
                'Admin'
            ]
        },
        beforeEnter: middleware([
            auth
        ]) 
    },
    {
        name: 'HomeLayout',
        path: '/',
        component : Home,
        meta: {
            role :[
                'User'
            ]
        },
    },
    {
        name: 'Katalog',
        path: '/katalog',
        component : Katalog,
        meta: {
            role :[
                'User'
            ]
        },
    },
    {
        name: 'Status',
        path: '/status',
        component: Status,
        meta: {
            role :[
                'User'
            ]
        }
    },
    {
        name: 'Cabang',
        path: '/cabang',
        component: Cabang,
        meta: { role: [
            'Admin'
        ]},
        beforeEnter: middleware([
            auth
        ]) 
    },
]
