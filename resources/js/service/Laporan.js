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
}
