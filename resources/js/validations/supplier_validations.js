import { required, minLength, maxLength, numeric, alpha } from 'vuelidate/lib/validators'

export default {
    Supplier: {
        Nama_Supplier: { 
            required, 
            minLength: minLength(5), 
            maxLength: maxLength(25), 
            // alpha 
        },
        Alamat_Supplier: { 
            required,
            minLength: minLength(5),
            maxLength: maxLength(255),
            numeric, 
        },
        Telepon_Supplier: {
            required,
            minLength: minLength(10),
            maxLength: maxLength(15),
            numeric,
        },
        Nama_Sales: {
            required, 
            minLength: minLength(5), 
            maxLength: maxLength(25), 
        },
        Telepon_Sales: {
            required,
            minLength: minLength(10),
            maxLength: maxLength(15),
            numeric,
        }
    },
}