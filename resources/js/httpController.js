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
    addpegawai(payload) {
        return new Promise((resolve, reject) => {

            const successCallback = (res) => {
                const data = res.data
                resolve(data)

            }
            const errorCallback = (err) => {
                reject(err)
    
            }
            Http.post('/api/pegawai/store', payload, successCallback, errorCallback)
        })
    },
    updatepegawai(payload,id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.patch('/api/pegawai/update/'+id, payload, successCallback, errorCallback)
        })
    },
    deletepegawai(id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)

            }

            Http.delete('/api/pegawai/delete/'+id, successCallback, errorCallback)
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
    addsupplier(payload) {
        return new Promise((resolve, reject) => {

            const successCallback = (res) => {
                const data = res.data
                resolve(data)

            }
            const errorCallback = (err) => {
                reject(err)
    
            }
            Http.post('/api/suppliers/store', payload, successCallback, errorCallback)
        })
    },
    updatesupplier(payload,id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.patch('/api/suppliers/update/'+id, payload, successCallback, errorCallback)
        })
    },
    deletesupplier(id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)

            }

            const errorCallback = (err) => {
                reject(err)

            }

            Http.delete('/api/suppliers/delete/'+id, successCallback, errorCallback)
        })
    },


}