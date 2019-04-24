import Http from '../http'

export default {
    getallmotorkonsumen(){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.get('/api/motor_konsumens', successCallback, errorCallback)
        })
    },
    addmotorkonsumen(payload) {
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.post('/api/motor_konsumens/store', payload, successCallback, errorCallback)
        })
    },
    updatemotorkonsumen(payload,id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }

            const errorCallback = (err) => {
                reject(err)
            }

            Http.patch('/api/motor_konsumens/update/'+id, payload, successCallback, errorCallback)
        })
    },
    deletemotorkonsumen(id){
        return new Promise((resolve, reject) => {
            const successCallback = (res) => {
                const data = res.data
                resolve(data)
            }
            const errorCallback = (err) => {
                reject(err)
            }
            Http.delete('/api/motor_konsumens/delete/'+id, successCallback, errorCallback)
        })
    }
}
