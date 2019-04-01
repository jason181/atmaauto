import Http from './http'

export default {
    getalljasaservice(){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.get('/api/jasas', successCallback, errorCallback)
        })
    },
    addjasaservice(payload) {
        return new Promise((resolve, reject) => {

            const successCallback = (res) => {
                const data = res.data
                resolve(data)

            }
            const errorCallback = (err) => {
                reject(err)
    
            }
            Http.post('/api/jasas/store', payload, successCallback, errorCallback)
        })
    },
    updatejasaservice(payload,id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.patch('/api/jasas/update/'+id, payload, successCallback, errorCallback)
        })
    },
    deletejasaservice(id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)

            }

            const errorCallback = (err) => {
                reject(err)

            }

            Http.delete('/api/jasas/delete/'+id, successCallback, errorCallback)
        })
    },
    getallpegawai(){
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



}