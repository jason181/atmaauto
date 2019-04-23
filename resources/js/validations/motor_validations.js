import { required, minLength, maxLength, numeric, alpha } from 'vuelidate/lib/validators'

export default {
    Motor: {
        Merk: { 
            required, 
            minLength: minLength(5), 
            maxLength: maxLength(25), 
        },
        Tipe: { 
            required, 
            minLength: minLength(5), 
            maxLength: maxLength(25),  
        },
    },
}