import Http from '../http'

export default {
    getallpenjualan(){
        return new Promise((resolve, reject) => {
             
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.get('/api/transaksi_penjualans', successCallback, errorCallback)
        })
    },
    addpenjualan(payload) {
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.post('/api/transaksi_penjualans/store', payload, successCallback, errorCallback)
        })
    },
    updatepenjualan(payload,id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.patch('/api/transaksi_penjualans/update/'+id, payload, successCallback, errorCallback)
        })
    },
    getmotorKonsumen(id){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.get(`/api/transaksi_penjualans/showbyidmotorkonsumen/${id}`, successCallback, errorCallback)
        })
    },
    getalldetailpenjualan(){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.get('/api/detail_spareparts', successCallback, errorCallback)
        })
    },
    getalldetailjasa(){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.get('/api/detail_jasas', successCallback, errorCallback)
        })
    },
    deletepenjualan(id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.delete('/api/transaksi_penjualans/delete/'+id, successCallback, errorCallback)
        })
    },
    getPegawai(){
        return new Promise((resolve, reject) => {
             
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.get('/api/pegawais', successCallback, errorCallback)
        })
    },
    addetailspareparts(payload){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.post('/api/detail_spareparts/store', payload, successCallback, errorCallback)
        })
    },
    deletedetailsparepart(id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.delete('/api/detail_spareparts/delete/'+id, successCallback, errorCallback)
        })
    },
    adddetailjasa(payload){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.post('/api/detail_jasas/store', payload, successCallback, errorCallback)
        })
    },
}