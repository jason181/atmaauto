import { required, minLength, maxLength, numeric } from 'vuelidate/lib/validators'

export default {
    cabang: {
        Nama_Cabang: { 
            required, 
            minLength: minLength(5), 
            maxLength: maxLength(25), 
        },
        Alamat_Cabang: { 
            required, 
            minLength: minLength(5), 
            maxLength: maxLength(255), 
        },
        Telepon_Cabang: { 
            required,
            minLength: minLength(10),
            maxLength: maxLength(15),
            numeric, 
        },
    },
}