import Http from '../http'

export default {
    cekstatus(hp,plat){
        return new Promise((resolve, reject) => {
            console.log(hp,plat)
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.get('/api/transaksi_penjualans/cekStatus/'+hp+'/'+plat, successCallback, errorCallback)
        })
    },
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
    getalldetailsparepart(){
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
}