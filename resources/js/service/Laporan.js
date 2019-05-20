import Http from '../http'

export default {
    laporanpendapatanbulanan(tahun){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.download('/api/pendapatan_bulanan/'+tahun, successCallback, errorCallback)
        })
    },
    laporanpengeluaranbulanan(tahun){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.download('/api/pengeluaran_bulanan/'+tahun, successCallback, errorCallback)
        })
    },
    laporansisastokbulanan(bulan,tahun){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.download('/api/sisa_stok/'+bulan+'/'+tahun, successCallback, errorCallback)
        })
    },
    laporanpenjualanterbanyakbulanan(tahun){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.download('/api/sparepart_terlaris/'+tahun, successCallback, errorCallback)
        })
    },
    laporanpendapatancabangtahunan(tahun){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.download('/api/pendapatan_bulanan/'+tahun, successCallback, errorCallback)
        })
    },
    laporanpenjualanjasa(tahun){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.download('/api/pendapatan_bulanan/'+tahun, successCallback, errorCallback)
        })
    },
}
    