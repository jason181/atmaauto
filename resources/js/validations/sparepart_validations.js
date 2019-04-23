import { required, minLength, maxLength, numeric, minValue } from 'vuelidate/lib/validators'

export default {
    Sparepart: {
        Kode_Sparepart: { 
             required, 
            // minLength: minLength(5), 
            // maxLength: maxLength(25), 
        },
        Tipe_Barang: { 
<<<<<<< HEAD
             required,
            // minLength: minLength(5),
            // maxLength: maxLength(25),
            // numeric, 
=======
            required,
            minLength: minLength(5),
            maxLength: maxLength(25),
>>>>>>> 0e9a2f460b7320b9b80d31b3cb63e02ad933c548
        },
        Nama_Sparepart: { 
             required, 
            // minLength: minLength(5), 
            // maxLength: maxLength(25), 
        },
        Merk_Sparepart: { 
             required, 
            // minLength: minLength(5), 
            // maxLength: maxLength(25), 
        },
        Rak_Sparepart: {
<<<<<<< HEAD
             required,
            // minLength: minLength(5),
            // maxLength: maxLength(25),
            // numeric,
=======
>>>>>>> 0e9a2f460b7320b9b80d31b3cb63e02ad933c548
        },
        Jumlah_Sparepart: {
             required,
            // maxLength: maxLength(12),
            // numeric,  
        },
        Stok_Minimum_Sparepart: {
             required,
            // maxLength: maxLength(12),
            // numeric, 
        },
        Harga_Beli: {
<<<<<<< HEAD
             required,
            // minLength: minLength(10),
            // maxLength: maxLength(12),
            // numeric, 
        },
        Harga_Jual: {
             required,
            // minLength: minLength(10),
            // maxLength: maxLength(12),
            // numeric, 
            // minValue:  minValue(10),
=======
            required,
            maxLength: maxLength(12),
            numeric, 
        },
        Harga_Jual: {
            required,
            maxLength: maxLength(12),
            numeric, 
>>>>>>> 0e9a2f460b7320b9b80d31b3cb63e02ad933c548
        },
        Gambar: {
            // required,
        }
    },
}