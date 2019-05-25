import Http from '../http'

export default {
    getallpengadaan(){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.get('/api/transaksi_pengadaans', successCallback, errorCallback)
        })
    },
    addpengadaan(payload) {
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.post('/api/transaksi_pengadaans/store', payload, successCallback, errorCallback)
        })
    },
    updatepengadaan(payload,id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.patch('/api/transaksi_pengadaans/update/'+id, payload, successCallback, errorCallback)
        })
    },
    updatedetailpengadaan(payload,id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.patch('/api/detail_pengadaans/update/'+id, payload, successCallback, errorCallback)
        })
    },
    deletepengadaan(id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.delete('/api/transaksi_pengadaans/delete/'+id, successCallback, errorCallback)
        })
    },
    verifikasipengadaan(id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.patch('/api/transaksi_pengadaans/verify/'+id, successCallback, errorCallback)
        })
    },
    getallsupplier(){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.get('/api/suppliers', successCallback, errorCallback)
        })
    },
    getallsparepart(){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.get('/api/spareparts', successCallback, errorCallback)
        })
    },
    getalldetailpengadaan(){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.get('/api/detail_pengadaans', successCallback, errorCallback)
        })
    },
    cetaksuratpemesanan(id){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.download('/api/cetak_surat_pemesanan/'+id, successCallback, errorCallback)
        })
    },
}