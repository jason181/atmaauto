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
    // addCabang(payload) {
    //     return new Promise((resolve, reject) => {
    //         const successCallback = (res) => {
    //             const data = res.data
    //             resolve(data)
    //         }
    //         const errorCallback = (err) => {
    //             reject(err)
    //         }
    //         Http.post('/api/cabangs/store', payload, successCallback, errorCallback)
    //     })
    // },
    // updateCabang(payload,id){
    //     return new Promise((resolve, reject) => {
    //         const successCallback = (res) => {
    //             const data = res.data
    //             resolve(data)
    //         }

    //         const errorCallback = (err) => {
    //             reject(err)
    //         }

    //         Http.patch('/api/cabangs/update/'+id, payload, successCallback, errorCallback)
    //     })
    // },
    // deleteCabang(id){
    //     return new Promise((resolve, reject) => {
    //         const successCallback = (res) => {
    //             const data = res.data
    //             resolve(data)
    //         }
    //         const errorCallback = (err) => {
    //             reject(err)
    //         }
    //         Http.delete('/api/cabangs/delete/'+id, successCallback, errorCallback)
    //     })
    // },
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
}