import { required, minLength, maxLength, numeric, minValue } from 'vuelidate/lib/validators'

export default {
    Sparepart: {
        Kode_Sparepart: { 
            required, 
            minLength: minLength(5), 
            maxLength: maxLength(25), 
        },
        Tipe_Barang: { 
            required,
            minLength: minLength(5),
            maxLength: maxLength(25),
            numeric, 
        },
        Nama_Sparepart: { 
            required, 
            minLength: minLength(5), 
            maxLength: maxLength(25), 
        },
        Merk_Sparepart: { 
            required, 
            minLength: minLength(5), 
            maxLength: maxLength(25), 
        },
        Rak_Sparepart: {
            required,
            minLength: minLength(5),
            maxLength: maxLength(25),
            numeric,
        },
        Jumlah_Sparepart: {
            required,
            maxLength: maxLength(12),
            numeric,  
        },
        Stok_Minimum_Sparepart: {
            required,
            maxLength: maxLength(12),
            numeric, 
        },
        Harga_Beli: {
            required,
            minLength: minLength(10),
            maxLength: maxLength(12),
            numeric, 
        },
        Harga_Jual: {
            required,
            minLength: minLength(10),
            maxLength: maxLength(12),
            numeric, 
            minValue:  minValue(10),
        },
        Gambar: {
            required,
            // minLength: minLength(10),
            // maxLength: maxLength(15),
            // numeric,
        }
    },
}