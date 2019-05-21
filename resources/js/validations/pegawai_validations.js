import { required, minLength, maxLength, numeric, alpha, alphaNum } from 'vuelidate/lib/validators'

export default {
    Pegawai:{
        Id_Cabang : { 
            required 
        },
        Id_Role : {
            required
        },
        Nama_Pegawai: {
            required,
            minLength: minLength(5),
            maxLength: maxLength(25),
            // alpha,
        },
        Alamat_Pegawai: {
            required,
            minLength: minLength(5),
            maxLength: maxLength(255),
        },
        Telepon_Pegawai: {
            required,
            minLength: minLength(10),
            maxLength: maxLength(15),
            numeric,
        },
        Gaji_Pegawai: {
            required,
            maxLength: maxLength(10),
            numeric,
        },
        Username:{
            required,
            minLength: minLength(5),
            maxLength: maxLength(30),
            // alphaNum,
        },
        Password:{
            required,
            minLength: minLength(5),
            maxLength: maxLength(15),
        },
    }
}