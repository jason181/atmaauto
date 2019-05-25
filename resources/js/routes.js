import middleware, { auth } from './middleware'

import Login from './components/layout/Login.vue';
import Pegawai from './components/layout/Pegawai.vue';
import Jasa_Service from './components/layout/JasaService.vue';
import Supplier from './components/layout/Supplier.vue';
import Sparepart from './components/layout/sparepart.vue';
import SparepartMinimum from './components/layout/SparepartMinimum';
import Cabang from './components/layout/Cabang.vue';
import Konsumen from './components/layout/Konsumen.vue';
import Motor from './components/layout/Motor.vue';
import Home from './components/layout/Home.vue';
import Katalog from './components/layout/Katalog.vue';
import Status from './components/layout/Status.vue';
import Pengadaan from './components/layout/Pengadaan.vue';
import Penjualan from './components/layout/Penjualan.vue';
import History from './components/layout/History.vue';
import Laporan from './components/layout/Laporan.vue';
import Kasir from './components/layout/Kasir.vue';
import { homedir } from 'os';

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
        name: 'SparepartMinimum',
        path: '/sparepartminimum',
        component: SparepartMinimum,
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
    {
        name: 'Konsumen',
        path: '/konsumen',
        component: Konsumen,
        meta: { role: [
            'Customer Service'
        ]},
        beforeEnter: middleware([
            auth
        ]) 
    },
    {
        name: 'Motor',
        path: '/motor',
        component: Motor,
        meta: { role: [
            'Admin'
        ]},
        beforeEnter: middleware([
            auth
        ]) 
    },
    {
        name: 'Pengadaan',
        path: '/pengadaan',
        component: Pengadaan,
        meta: { role: [
            'Admin'
        ]},
        beforeEnter: middleware([
            auth
        ])
    },
    {
        name: 'History',
        path: '/history',
        component: History,
        meta: { role: [
            'Admin'
        ]},
        beforeEnter: middleware([
            auth
        ])
    },
    {
        name: 'Penjualan',
        path: '/penjualan',
        component: Penjualan,
        meta:{ role:[
            'Customer Service'
        ]},
        beforeEnter: middleware([
            auth
        ])
    },
    {
        name: 'Laporan',
        path:'/laporan',
        component: Laporan,
        meta: { role: [
            'Admin'
        ]},
        beforeEnter: middleware([
            auth
        ])
    },
    {
        name: 'Kasir',
        path: '/kasir',
        component:Kasir,
        meta: { role: [
            'Kasir'
        ]},
        beforeEnter: middleware([
            auth
        ])
    }
]