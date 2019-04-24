import { required, minLength, maxLength, numeric } from 'vuelidate/lib/validators'

export default {
    Konsumen: {
        Nama_Konsumen: { 
            required, 
            minLength: minLength(5), 
            maxLength: maxLength(25), 
        },
        Alamat_Konsumen: { 
            required, 
            minLength: minLength(5), 
            maxLength: maxLength(25), 
        },
        Telepon_Konsumen: { 
            required,
            maxLength: maxLength(15),
            minLength: minLength(10),
            numeric, 
        },
    },
}