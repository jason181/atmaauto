<template>
    <body>
        <div class="container-fluid mt-3">
            <div class="row mb-2">
                <div class="col-lg-2">
                    <div class="col-lg-7 p-0">
                        <button class="btn btn-success mb-2 btn-block" @click="getallpengadaan(),refresh()" data-title="Tambah_Pengadaan" data-toggle="modal" data-target="#Tambah_Pengadaan">
                            <i class="fas fa-plus mr-2"></i>Tambah
                        </button>
                    </div>
                    <div class="col-lg-5">

                    </div>
                </div>
                <div class="col-lg-7">

                </div>
                <div class="col-lg-3">
                    <div class="input-group">
                        <input class="form-control" v-model="Cari_Pengadaan" type="search" placeholder="Cari Transaksi Pengadaan">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
                
            
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Supplier</th>
                            <th scope="col">Sales</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-bind:key="pengadaan['id']" v-for="pengadaan in pengadaandata">
                            <td>{{pengadaan.Nama_Supplier }} </td>
                            <td>{{pengadaan.Nama_Sales}} </td>
                            <td>{{pengadaan.Tanggal_Pengadaan}} </td>
                            <td>{{pengadaan.Total_Harga}}</td>
                            <td>{{pengadaan.Status_Pengadaan}} </td>     
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <button class="btn btn-primary" @click="datapengadaanhandler(pengadaan)" data-title="Edit_Pengadaan" data-toggle="modal" data-target="#Edit_Pengadaan">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button @click="datapengadaanhandler(pengadaan)" class="btn btn-danger" data-title="Delete_Pengadaan" data-toggle="modal" data-target="#Delete_Pengadaan">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </p>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <!-- MY MODALS -->
        <!-- TAMBAH PEGAWAI -->
        
        <!-- END OF DELETE JASA SERVICE -->
        <!-- END OF MY MODALS -->
    </body>
</template>
<script>
import Controller from '../../service/Pengadaan'
import validators from '../../validations/pegawai_validations'
import controller from '../../service/Cabang'

export default {
    validations:validators,
    data:()=>({
        pengadaandata:[],
        Pengadaan:[],
        Id_Supplier:'',
        Id_Sales:'',
        Tanggal_Pengadaan:'',
        Total_Harga:'',
        Status_Pengadaan:'',
        Pengadaan:{
            Id_Supplier:'',
            Id_Sales:'',
            Tanggal_Pengadaan:'',
            Total_Harga:'',
            Status_Pengadaan:'',
        },
        Cari_Pengadaan:'',
    }),
    mounted(){
        this.getallpengadaan()
    },
    methods:{
        async getallpengadaan () {
            try {
                this.pengadaandata = (await Controller.getallpengadaan()).data
                console.log(this.pengadaandata)
            } catch (err) {
                console.log(err)
            }
        },
        // async addpegawai () {
        //     try {
        //         const payload = {
        //             Id_Cabang           : this.Pegawai.Id_Cabang,
        //             Id_Role             : this.Pegawai.Id_Role,
        //             Nama_Pegawai        : this.Pegawai.Nama_Pegawai,
        //             Alamat_Pegawai      : this.Pegawai.Alamat_Pegawai,
        //             Telepon_Pegawai     : this.Pegawai.Telepon_Pegawai,
        //             Gaji_Pegawai        : this.Pegawai.Gaji_Pegawai,
        //             Username            : this.Pegawai.Username,
        //             Password            : this.Pegawai.Password,
        //         }
        //         await Controller.addpegawai(payload)
        //         this.getallpegawai()
        //     } catch (err) {
        //         console.log(err)
        //     }
        // },
        // async updatepegawai (id) {
        //     try {
        //         const payload = {
        //             Id_Cabang           : this.Pegawai.Id_Cabang,
        //             Id_Role             : this.Pegawai.Id_Role,
        //             Nama_Pegawai        : this.Pegawai.Nama_Pegawai,
        //             Alamat_Pegawai      : this.Pegawai.Alamat_Pegawai,
        //             Telepon_Pegawai     : this.Pegawai.Telepon_Pegawai,
        //             Gaji_Pegawai        : this.Pegawai.Gaji_Pegawai,
        //             Username            : this.Pegawai.Username,
        //             Password            : this.Pegawai.Password,
        //         }
        //         await Controller.updatepegawai(payload,id)
        //         this.getallpegawai()
        //     } catch (err) {
        //         console.log(err)
        //     }
        // },
        // async deletepegawai (id) {
        //     try {
        //         await Controller.deletepegawai(id)
        //         this.getallpegawai()
        //         // console.log()
        //     } catch (err) {
        //         console.log(err)
        //     }
        // },
        datapengadaanhandler(pengadaan){
            this.Pengadaan = pengadaan;
        },
        refresh(){
            this.Pengadaan.Id_Supplier      ='';
            this.Pengadaan.Id_Sales         ='';
            this.Pengadaan.Tanggal_Pengadaan='';
            this.Pengadaan.Total_Harga      ='';
            this.Pengadaan.Status_Pengadaan ='';
        }
    },
    computed:{
        filteredpengadaan:function(){
            return this.pengadaandata.filter((pengadaan)=>{
                return Pengadaan.Tanggal_Pengadaan.toLowerCase().match(this.Cari_Pengadaan.toLowerCase());
            });
        },
        // cabangErrors(){
        //     const errors = []
        //     if(this.$v.Pegawai.Id_Cabang.$dirty) return errors
        //     !this.$v.Pegawai.Id_Cabang.required && errors.push('Id cabang is required')
        //     return errors
        // },
        // roleErrors(){
        //     const errors = []
        //     if(this.$v.Pegawai.Id_Role.$dirty) return errors
        //     !this.$v.Pegawai.Id_Role.required && errors.push('Id role is required')
        //     return errors
        // },
        // nameErrors(){
        //     const errors = []
        //     if (!this.$v.Pegawai.Nama_Pegawai.$dirty) return errors
        //     !this.$v.Pegawai.Nama_Pegawai.minLength && errors.push('Name must be at least 5 characters long')
        //     !this.$v.Pegawai.Nama_Pegawai.maxLength && errors.push('Name must be at most 25 characters long')
        //     !this.$v.Pegawai.Nama_Pegawai.required && errors.push('Name is required')
        //     // !this.$v.Pegawai.Nama_Pegawai.alpha && errors.push('Name must be alphabetic')
        //     return errors
        // },
        // addressErrors(){
        //     const errors = []
        //     if (!this.$v.Pegawai.Alamat_Pegawai.$dirty) return errors
        //     !this.$v.Pegawai.Alamat_Pegawai.minLength && errors.push('Address must be at least 5 characters long')
        //     !this.$v.Pegawai.Alamat_Pegawai.maxLength && errors.push('Address must be at most 255 characters long')
        //     !this.$v.Pegawai.Alamat_Pegawai.required && errors.push('Address is required')
        //     return errors
        // },
        // phoneErrors(){
        //     const errors = []
        //     if (!this.$v.Pegawai.Telepon_Pegawai.$dirty) return errors
        //     !this.$v.Pegawai.Telepon_Pegawai.minLength && errors.push('Phone Number must be at least 10 characters long')
        //     !this.$v.Pegawai.Telepon_Pegawai.maxLength && errors.push('Phone Number must be at most 15 characters long')
        //     !this.$v.Pegawai.Telepon_Pegawai.required && errors.push('Phone Number is required')
        //     !this.$v.Pegawai.Telepon_Pegawai.numeric && errors.push('Phone Number must be numeric')
        //     return errors
        // },
        // salaryErrors(){
        //     const errors = []
        //     if (!this.$v.Pegawai.Gaji_Pegawai.$dirty) return errors
        //     !this.$v.Pegawai.Gaji_Pegawai.maxLength && errors.push('Salary must be at most 10 characters long')
        //     !this.$v.Pegawai.Gaji_Pegawai.required && errors.push('Salary is required')
        //     !this.$v.Pegawai.Gaji_Pegawai.numeric && errors.push('Salary must be numeric')
        //     return errors
        // },
        // usernameErrors(){
        //     const errors = []
        //     if (!this.$v.Pegawai.Username.$dirty) return errors
        //     !this.$v.Pegawai.Username.minLength && errors.push('Username must be at least 10 characters long')
        //     !this.$v.Pegawai.Username.maxLength && errors.push('Username must be at most 30 characters long')
        //     !this.$v.Pegawai.Username.required && errors.push('Username is required')
        //     // !this.$v.Pegawai.Username.alphaNum && errors.push('Username must be alphabetic or numeric')
        //     return errors
        // },
        // passwordErrors(){
        //     const errors = []
        //     if (!this.$v.Pegawai.Password.$dirty) return errors
        //     !this.$v.Pegawai.Password.minLength && errors.push('Password must be at least 5 characters long')
        //     !this.$v.Pegawai.Password.maxLength && errors.push('Password must be at most 30 characters long')
        //     !this.$v.Pegawai.Password.required && errors.push('Password is required')
        //     return errors
        // },
    }

}
</script>
