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
}