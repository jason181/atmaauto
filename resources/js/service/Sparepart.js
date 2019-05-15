import Http from '../http'

export default {
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
    getallsparepartminimum(){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.get('/api/spareparts/showBelowMinimumStock', successCallback, errorCallback)
        })
    },
    addsparepart(payload) {
        return new Promise((resolve, reject) => {

            const successCallback = (res) => {
                const data = res.data
                resolve(data)

            }
            const errorCallback = (err) => {
                reject(err)

            }
            Http.post('/api/spareparts/store', payload, successCallback, errorCallback)
        })
    },
    updatesparepart(payload,id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.patch('/api/spareparts/update/'+id, payload, successCallback, errorCallback)
        })
    },
    deletesparepart(id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }
            Http.delete('/api/spareparts/delete/'+id, successCallback, errorCallback)
        })
    },
    getallinput(){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.get('/api/history_masuk', successCallback, errorCallback)
        })
    },
    getalloutput(){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.get('/api/history_keluar', successCallback, errorCallback)
        })
    },

}
