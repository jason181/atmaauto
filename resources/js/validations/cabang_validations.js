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
            maxLength: maxLength(25), 
        },
        Telepon_Cabang: { 
            required,
            maxLength: maxLength(12),
            minLength: minLength(12),
            numeric, 
        },
    },
}