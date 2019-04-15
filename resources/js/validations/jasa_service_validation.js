import { required, minLength, maxLength, numeric, alpha } from 'vuelidate/lib/validators'

export default {
    Jasaservice: {
        Nama_Jasa: { 
            required, 
            minLength: minLength(5), 
            maxLength: maxLength(25), 
            // alpha 
        },
        Harga_Jasa: { 
            required,
            maxLength: maxLength(12),
            numeric, 
        },
    },
}