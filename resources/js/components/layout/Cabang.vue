<template>
    <body>
        <div class="container mt-3" style="max-width: 800px;">
            <div class="clearfix my-2">
                <button class="btn btn-success float-left mb-2" data-title="Tambah_Cabang" 
                data-toggle="modal" data-target="#Tambah_Cabang">
                    <i class="fas fa-plus mr-2"></i>Tambah
                </button>
                <div class="navbar navbar-light bg-light float-right p-0">
				  	<form class="form-inline">
				    	<input class="form-control mr-sm-2" v-model="Cari_Cabang" type="search" 
                        placeholder="Cari Cabang">
				    	<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
				  	</form>
				</div>
            </div>
            
            <div class="table-responsive" style="max-width: 800px; margin: auto;">
                <table class="table table-striped table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nomor Telepon</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-bind:key="cabang['Id_Cabang']" v-for="cabang in filteredCabang">
                            <td>{{cabang.Nama_Cabang}} </td>
                            <td>{{cabang.Alamat_Cabang}} </td>
                            <td>{{cabang.Telepon_Cabang}} </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <button class="btn btn-primary" @click="dataCabangHandler(cabang)" 
                                    data-title="Edit_Cabang" data-toggle="modal" data-target="#Edit_Cabang">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button @click="dataCabangHandler(cabang)" class="btn btn-danger"  
                                    data-title="Delete_Cabang" data-toggle="modal" data-target="#Delete_Cabang">
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
        <!-- TAMBAH CABANG -->
        <div class="modal fade" id="Tambah_Cabang" tabindex="-1" role="dialog" 
        aria-labelledby="Tambah_Cabang" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Tambah Cabang</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addCabang()">
                            <div class="input-group">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Nama</span>
                                </div>
                                <input type="text" v-model="Cabang.Nama_Cabang" class="form-control" 
                                placeholder="Masukkan Nama Cabang" :error="nameErrors" 
                                aria-label="Nama_Cabang" aria-describedby="basic-addon2" 
                                id="Nama_Cabang" name="Nama_Cabang" 
                                @input="$v.Cabang.Nama_Cabang.$touch()" 
                                @blur="$v.Cabang.Nama_Cabang.$touch()" required>
                            </div>
                            <div class="text-center">
                                <p class="mb-3" style="color:red;" 
                                v-if="$v.Cabang.Nama_Cabang.$invalid">{{nameErrors[0]}}</p>
                            </div>
                            <div class="input-group mt-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Alamat</span>
                                </div>
                                <input type="text" v-model="Cabang.Alamat_Cabang" 
                                class="form-control" placeholder="Masukkan Alamat Cabang" 
                                :error="addressErrors" aria-label="Alamat_Cabang" 
                                aria-describedby="basic-addon2" id="Alamat_Cabang" 
                                name="Alamat_Cabang" @input="$v.cabang.Alamat_Cabang.$touch()" 
                                @blur="$v.Cabang.Alamat_Cabang.$touch()" required>
                            </div>
                            <div class="text-center">
                                <div style="color:red;" 
                                v-if="$v.Cabang.Alamat_Cabang.$invalid">{{addressErrors[0]}}</div>
                            </div>
                            <div class="input-group mt-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Telepon</span>
                                </div>
                                <input type="text" v-model="Cabang.Telepon_Cabang" 
                                class="form-control" placeholder="Masukkan Nomor Telepon Cabang" 
                                :error="phoneErrors" aria-label="Telepon_Cabang"
                                 aria-describedby="basic-addon2" id="Telepon_Cabang" 
                                 name="Telepon_Cabang" @input="$v.Cabang.Telepon_Cabang.$touch()" 
                                 @blur="$v.Cabang.Telepon_Cabang.$touch()" required>
                            </div>
                            <div class="text-center">
                                <div style="color:red;" 
                                v-if="$v.Cabang.Telepon_Cabang.$invalid">{{phoneErrors[0]}}</div>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-success btn-lg" 
                                style="width: 100%;" 
                                :disabled="$v.Cabang.$invalid"
                                @click="addCabang(Cabang.Id_Cabang)" 
                                data-dismiss="modal">Tambahkan Cabang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF TAMBAH CABANG-->
        <!-- EDIT CABANG -->
        <div class="modal fade" id="Edit_Cabang" tabindex="-1" role="dialog" 
             aria-labelledby="Edit_Cabang" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Edit Cabang</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Nama</span>
                                </div>
                                <input type="text" v-model="Cabang.Nama_Cabang" 
                                class="form-control" placeholder="Masukkan Nama Cabang" 
                                aria-label="Nama_Cabang" aria-describedby="basic-addon2" 
                                id="Nama_Cabang" name="Nama_Cabang">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Alamat</span>
                                </div>
                                <input type="text" v-model="Cabang.Alamat_Cabang" 
                                class="form-control" placeholder="Masukkan Alamat Cabang" 
                                aria-label="Alamat_Cabang" aria-describedby="basic-addon2" 
                                id="Alamat_Cabang" name="Alamat_Cabang">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Telepon</span>
                                </div>
                                <input type="number" v-model="Cabang.Telepon_Cabang" 
                                class="form-control" placeholder="Masukkan Telepon Cabang" 
                                aria-label="Telepon_Cabang" aria-describedby="basic-addon2" 
                                id="Telepon_Cabang" name="Telepon_Cabang">
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-primary btn-lg" 
                                style="width: 100%;" data-dismiss="modal"
                                @click="updateCabang(Cabang.Id_Cabang)">Simpan Perubahan</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF EDIT CABANG -->
        <!-- DELETE CABANG -->
        <div class="modal fade" id="Delete_Cabang" tabindex="-1" role="dialog" aria-labelledby="Delete_Cabang" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Hapus Data Cabang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda Yakin Ingin Menghapus Data Cabang Ini ?</div>
                    </div>
                    <div class="modal-footer ">
                        <a id="delete_btn" class="float-left w-100">
                            <button type="button" @click="deleteCabang(Cabang.Id_Cabang)" class="btn btn-danger float-left w-50" data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span>Ya</button>
                        </a>
                        <button type="button" class="btn btn-secondary float-right w-50" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Tidak</button>
                    </div>
                </div>
            </div>
            </div>
        <!-- END OF DELETE CABANG -->
        <!-- END OF MY MODALS -->
    </body>
</template>

<script>
import Controller from '../../service/Cabang'
import validators from '../../validations/cabang_validations' 

export default {
    validations: validators,
    data: () => ({
        cabangData:[],
        handledCabang:[],
        Nama_Cabang:'',
        Alamat_Cabang:'',
        Telepon_Cabang: '',
        Cari_Cabang:'',
        Cabang:{
            Nama_Cabang:'',
            Alamat_Cabang:'',
            Telepon_Cabang: '',
        }
    }),
    mounted(){
        this.getallCabang()
    },
    methods:{
        async getallCabang () {
            try {
                this.cabangData = (await Controller.getallCabang()).data
                console.log(this.cabangData)
            } catch (err) {
                console.log(err)
            }
        },
        async addCabang () {
            try {
                const payload = {
                    Nama_Cabang     : this.Cabang.Nama_Cabang,
                    Alamat_Cabang   : this.Cabang.Alamat_Cabang,
                    Telepon_Cabang  : this.Cabang.Telepon_Cabang
                }
                await Controller.addCabang(payload)
                this.getallCabang()
                this.refresh()
            } catch (err) {
                console.log(err)
            }
        },
        async updateCabang (id) {
            try {
                const payload = {
                    Nama_Cabang     : this.Cabang.Nama_Cabang,
                    Alamat_Cabang   : this.Cabang.Alamat_Cabang,
                    Telepon_Cabang  : this.Cabang.Telepon_Cabang,
                }
                await Controller.updateCabang(payload,id)
                this.getallCabang();
                this.refresh()
            } catch (err) {
                console.log(err)
            }
        },
        async deleteCabang (id) {
            try {
                await Controller.deleteCabang(id)
                this.getallCabang()
            } catch (err) {
                console.log(err)
            }
        },
        dataCabangHandler(cabang){
            this.Cabang = cabang
        },
        refresh(){
            this.Cabang.Nama_Cabang = '';
            this.Cabang.Alamat_Cabang= '';
            this.Cabang.Telepon_Cabang= '';
        }
    },
    computed:{
        filteredCabang:function(){
            return this.cabangData.filter((cabang)=>{
                return cabang.Nama_Cabang.match(this.Cari_Cabang);
            });
        },
        nameErrors () {
            const errors = []
            if (!this.$v.Cabang.Nama_Cabang.$dirty) return errors
            !this.$v.Cabang.Nama_Cabang.minLength && errors.push('Name must be at least 5 characters long')
            !this.$v.Cabang.Nama_Cabang.maxLength && errors.push('Name must be at most 25 characters long')
            !this.$v.Cabang.Nama_Cabang.required && errors.push('Name is required.')
            return errors
        },
        addressErrors () {
            const errors = []
            if (!this.$v.Cabang.Alamat_Cabang.$dirty) return errors
            !this.$v.Cabang.Alamat_Cabang.maxLength && errors.push('Address must be at most 25 characters long')
            !this.$v.Cabang.Alamat_Cabang.minLength && errors.push('Address must be at least 5 characters long')
            !this.$v.Cabang.Alamat_Cabang.required && errors.push('Address is required.')
            return errors
        },
        phoneErrors () {
            const errors = []
            if (!this.$v.Cabang.Telepon_Cabang.$dirty) return errors
            !this.$v.Cabang.Telepon_Cabang.maxLength && errors.push('Phone Number must be at most 12 characters long')
            !this.$v.Cabang.Telepon_Cabang.minLength && errors.push('Phone Number be at leats 12 characters long')
            !this.$v.Cabang.Telepon_Cabang.numeric && errors.push('Phone Number must be numeric')
            !this.$v.Cabang.Telepon_Cabang.required && errors.push('Phone Number is required.')
            return errors
        },
    }
}
</script>

