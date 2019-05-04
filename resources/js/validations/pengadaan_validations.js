import { required, minLength, maxLength, numeric, maxValue } from 'vuelidate/lib/validators'

export default {
    Pengadaan: {
        Id_Supplier: {
            required
            
        },
        Tanggal_Pengadaan: { 
            required
            
        },
        // Total_Harga: {
        //     required,
        //     maxLength: maxLength(12),
        //     numeric,
        // },
        // Status_Pengadaan: {
        //     required,
        //     maxValue: maxValue(3),
        //     numeric, 
        // },
    },
}