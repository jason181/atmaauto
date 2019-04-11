<template>
    <body>
        <div class="container mt-3" style="max-width: 800px;">
            <div class="clearfix my-2">
                <button class="btn btn-success float-left mb-2" data-title="Tambah_Jasa_Service" data-toggle="modal" data-target="#Tambah_Jasa_Service">
                    <i class="fas fa-plus mr-2"></i>Tambah
                </button>
                <div class="navbar navbar-light bg-light float-right p-0">
				  	<form class="form-inline">
				    	<input class="form-control mr-sm-2" v-model="Cari_Jasa_Service" type="search" placeholder="Cari Jasa Service">
				    	<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
				  	</form>
				</div>
            </div>
            
            <div class="table-responsive" style="max-width: 800px; margin: auto;">
                <table class="table table-striped table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-bind:key="jasa['Id_Jasa']" v-for="jasa in filteredjasaservice">
                            <td>{{jasa.Nama_Jasa}} </td>
                            <td>{{jasa.Harga_Jasa}} </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <button class="btn btn-primary" @click="datajasaservicehandler(jasa)" data-title="Edit_Jasa_Service" data-toggle="modal" data-target="#Edit_Jasa_Service">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button @click="datajasaservicehandler(jasa)" class="btn btn-danger"  data-title="Delete_Jasa_Service" data-toggle="modal" data-target="#Delete_Jasa_Service">
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
        <!-- TAMBAH JASA SERVICE -->
        <div class="modal fade" id="Tambah_Jasa_Service" tabindex="-1" role="dialog" aria-labelledby="Tambah_Jasa_Service" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Tambah Jasa Service</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addjasaservice()">
                            <div class="input-group">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Nama</span>
                                </div>
                                <input type="text" v-model="jasaservice.Nama_Jasa" class="form-control" placeholder="Masukkan Nama Jasa Service" :error="nameErrors" aria-label="Nama_Jasa_Service" aria-describedby="basic-addon2" id="Nama_Jasa_Service" name="Nama_Jasa_Service" @input="$v.jasaservice.Nama_Jasa.$touch()" @blur="$v.jasaservice.Nama_Jasa.$touch()" required>
                            </div>
                            <div class="text-center">
                                <p class="mb-3" style="color:red;" v-if="$v.jasaservice.Nama_Jasa.$invalid">{{nameErrors[0]}}</p>
                            </div>
                            <div class="input-group mt-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Harga</span>
                                </div>
                                <input type="number" v-model="jasaservice.Harga_Jasa" class="form-control" placeholder="Masukkan Harga Jasa Service" aria-label="Harga_Jasa_Service" aria-describedby="basic-addon2" id="Harga_Jasa_Service" name="Harga_Jasa_Service" @input="$v.jasaservice.Harga_Jasa.$touch()" @blur="$v.jasaservice.Harga_Jasa.$touch()" required>
                            </div>
                            <div class="text-center">
                                <div style="color:red;" v-if="$v.jasaservice.Harga_Jasa.$invalid">{{priceErrors[0]}}</div>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-success btn-lg" style="width: 100%;" :disabled="$v.jasaservice.$invalid">Tambahkan Jasa Service</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF TAMBAH JASA SERVICE -->
        <!-- EDIT JASA SERVICE -->
        <div class="modal fade" id="Edit_Jasa_Service" tabindex="-1" role="dialog" aria-labelledby="Edit_Jasa_Service" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Edit Jasa Service</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updatejasaservice(handledjasaservice.Id_Jasa)">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Nama</span>
                                </div>
                                <input type="text" v-model="handledjasaservice.Nama_Jasa" class="form-control" placeholder="Masukkan Nama Jasa Service" aria-label="Nama_Jasa_Service" aria-describedby="basic-addon2" id="Nama_Jasa_Service" name="Nama_Pegawai">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Harga</span>
                                </div>
                                <input type="number" v-model="handledjasaservice.Harga_Jasa" class="form-control" placeholder="Masukkan Harga Jasa Service" aria-label="Harga_Jasa_Service" aria-describedby="basic-addon2" id="Harga_Jasa_Service" name="Harga_Jasa_Service">
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF EDIT JASA SERVICE -->
        <!-- DELETE JASA SERVICE -->
        <div class="modal fade" id="Delete_Jasa_Service" tabindex="-1" role="dialog" aria-labelledby="Delete_Jasa_Service" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Hapus Data Jasa Service</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda Yakin Ingin Menghapus Data Jasa Service Ini ?</div>
                    </div>
                    <div class="modal-footer ">
                        <a id="delete_btn" class="float-left w-100">
                            <button type="button" @click="deletejasaservice(handledjasaservice.Id_Jasa)" class="btn btn-danger float-left w-50" data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span>Ya</button>
                        </a>
                        <button type="button" class="btn btn-secondary float-right w-50" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Tidak</button>
                    </div>
                </div>
            </div>
            </div>
        <!-- END OF DELETE JASA SERVICE -->
        <!-- END OF MY MODALS -->
    </body>
</template>
<script>
import Controller from '../../httpController'
import { required, minLength, maxLength, numeric } from 'vuelidate/lib/validators'

export default {
     validations: {
       jasaservice: {
        Nama_Jasa: { required, minLength: minLength(5), maxLength: maxLength(25) },
        Harga_Jasa: { required, numeric, minLength: minLength(3), maxLength: maxLength(12) },
       },   
    },
    data: () => ({
        jasaservicedata:[],
        handledjasaservice:[],
        Nama_Jasa:'',
        Harga_Jasa:0,
        Cari_Jasa_Service:'',
        jasaservice:{
            Nama_Jasa:'',
            Harga_Jasa:0,
        }
    }),
    mounted(){
        this.getalljasaservice()
    },
    methods:{
        async getalljasaservice () {
            try {
                this.jasaservicedata = (await Controller.getalljasaservice()).data
                console.log(this.jasaservicedata)
            } catch (err) {
                console.log(err)
            }
        },
        async addjasaservice () {
            try {
                const payload = {
                    Nama_Jasa : this.jasaservice.Nama_Jasa,
                    Harga_Jasa : this.jasaservice.Harga_Jasa,
                }
                await Controller.addjasaservice(payload)
                this.getalljasaservice()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        async updatejasaservice (id) {
            try {
                const payload = {
                    Nama_Jasa : this.handledjasaservice.Nama_Jasa,
                    Harga_Jasa : this.handledjasaservice.Harga_Jasa,
                }
                await Controller.updatejasaservice(payload,id)
                this.getalljasaservice()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        async deletejasaservice (id) {
            try {
                await Controller.deletejasaservice(id)
                this.getalljasaservice()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        datajasaservicehandler(jasa){
            this.handledjasaservice = jasa
        }

    },
    computed:{
        filteredjasaservice:function(){
            return this.jasaservicedata.filter((jasa)=>{
                return jasa.Nama_Jasa.match(this.Cari_Jasa_Service);
            });
        },
        nameErrors () {
            const errors = []
            if (!this.$v.jasaservice.Nama_Jasa.$dirty) return errors
            !this.$v.jasaservice.Nama_Jasa.minLength && errors.push('Name must be at least 5 characters long')
            !this.$v.jasaservice.Nama_Jasa.maxLength && errors.push('Name must be at most 25 characters long')
            !this.$v.jasaservice.Nama_Jasa.required && errors.push('Name is required.')
            return errors
        },
        priceErrors () {
            const errors = []
            if (!this.$v.jasaservice.Harga_Jasa.$dirty) return errors
            !this.$v.jasaservice.Harga_Jasa.maxLength && errors.push('Price must be at most 12 characters long')
            !this.$v.jasaservice.Harga_Jasa.numeric && errors.push('Price must be numeric')
            !this.$v.jasaservice.Harga_Jasa.required && errors.push('Price is required.')
            return errors
        },
    }
}
</script>

