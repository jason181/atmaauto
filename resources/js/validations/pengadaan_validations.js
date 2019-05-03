import { required, minLength, maxLength, numeric, date, maxValue } from 'vuelidate/lib/validators'

export default {
    Pengadaan: {
        Id_Supplier: {
            required,
            numeric,
        },
        Tanggal_Pengadaan: { 
            required, 
            date,
        },
        Total_Harga: {
            required,
            maxLength: maxLength(12),
            numeric,
        },
        Status_Pembayaran: {
            required,
            maxValue: maxValue(3),
            numeric, 
        },
    },
}