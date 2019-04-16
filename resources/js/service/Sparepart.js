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

            Http.patch('/api/sparepart/update/'+id, payload, successCallback, errorCallback)
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
    }
}
