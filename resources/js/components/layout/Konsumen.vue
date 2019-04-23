<template>
    <body>
        <div class="container mt-3" style="max-width: 800px;">
            <div class="row mb-2">
                <div class="col-sm-2">
                    <button class="btn btn-success float-left mb-2 btn-block" @click="getallkonsumen(),refresh()" data-title="Tambah_Konsumen" data-toggle="modal" data-target="#Tambah_Konsumen">
                        <i class="fas fa-plus mr-2"></i>Tambah
                    </button>
                </div>
                <div class="col-sm-6">

                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input class="form-control" v-model="Cari_Konsumen" type="search" placeholder="Cari Konsumen">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive" style="max-width: 800px; margin: auto;">
                <table class="table table-striped table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Telepon</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-bind:key="konsumen['Id_Konsumen']" v-for="konsumen in filteredkonsumen">
                            <td>{{konsumen.Nama_Konsumen}} </td>
                            <td>{{konsumen.Alamat_Konsumen}} </td>
                            <td>{{konsumen.Telepon_Konsumen}} </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <button class="btn btn-primary" 
                                        @click="datakonsumenhandler(konsumen)" 
                                        data-title="Edit_Konsumen" data-toggle="modal" 
                                        data-target="#Edit_Konsumen">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button @click="datakonsumenhandler(konsumen)" 
                                        class="btn btn-danger"  data-title="Delete_Konsumen" 
                                        data-toggle="modal" data-target="#Delete_Konsumen">
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
        <!-- TAMBAH KONSUMEN -->
        <div class="modal fade" id="Tambah_Konsumen" tabindex="-1" role="dialog" 
            aria-labelledby="Tambah_Konsumen" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Tambah Konsumen</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                            aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Nama</span>
                            </div>
                            <input type="text" v-model="Konsumen.Nama_Konsumen" class="form-control" 
                                placeholder="Masukkan Nama Konsumen" :error="nameErrors" 
                                aria-label="Nama_Konsumen" aria-describedby="basic-addon2" 
                                id="Nama_Konsumen" name="Nama_Konsumen" 
                                @input="$v.Konsumen.Nama_Konsumen.$touch()" 
                                @blur="$v.Konsumen.Nama_Konsumen.$touch()" required>
                        </div>
                        <div class="text-center">
                            <div class="mb-3" style="color:red;" 
                            v-if="$v.Konsumen.Nama_Konsumen.$invalid">{{nameErrors[0]}}</div>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Alamat</span>
                            </div>
                            <input type="text" v-model="Konsumen.Alamat_Konsumen" 
                                class="form-control" placeholder="Masukkan Alamat Konsumen" 
                                aria-label="Alamat_Konsumen" aria-describedby="basic-addon2" 
                                id="Alamat_Konsumen" name="Alamat_Konsumen" 
                                @input="$v.Konsumen.Alamat_Konsumen.$touch()" 
                                @blur="$v.Konsumen.Alamat_Konsumen.$touch()" required>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" 
                                v-if="$v.Konsumen.Alamat_Konsumen.$invalid">{{addressErrors[0]}}</p>
                        </div>

                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Telepon</span>
                            </div>
                            <input type="number" v-model="Konsumen.Telepon_Konsumen" 
                                class="form-control" placeholder="Masukkan Nomor Telepon Konsumen" 
                                aria-label="Telepon_Konsumen" aria-describedby="basic-addon2" 
                                id="Telepon_Konsumen" name="Telepon_Konsumen" 
                                @input="$v.Konsumen.Telepon_Konsumen.$touch()" 
                                @blur="$v.Konsumen.Telepon_Konsumen.$touch()" required>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" 
                                v-if="$v.Konsumen.Telepon_Konsumen.$invalid">{{phoneErrors[0]}}</p>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="submit" class="btn btn-success btn-lg w-100" 
                            :disabled="$v.Konsumen.$invalid" data-dismiss="modal" 
                            @click="addkonsumen()">Tambahkan Konsumen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF TAMBAH KONSUMEN -->
        <!-- EDIT KONSUMEN -->
        <div class="modal fade" id="Edit_Konsumen" tabindex="-1" role="dialog" 
            aria-labelledby="Edit_Konsumen" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title mx-auto" id="Heading">Edit Konsumen</h4>
                            <button type="button" class="close" data-dismiss="modal" 
                                aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">
                            <div class="input-group">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Nama</span>
                                </div>
                                <input type="text" v-model="Konsumen.Nama_Konsumen" class="form-control" 
                                    placeholder="Masukkan Nama Konsumen" :error="nameErrors" 
                                    aria-label="Nama_Konsumen" aria-describedby="basic-addon2" 
                                    id="Nama_Konsumen" name="Nama_Konsumen" 
                                    @input="$v.Konsumen.Nama_Konsumen.$touch()" 
                                    @blur="$v.Konsumen.Nama_Konsumen.$touch()" required>
                            </div>
                            <div class="text-center">
                                <div class="mb-3" style="color:red;" 
                                v-if="$v.Konsumen.Nama_Konsumen.$invalid">{{nameErrors[0]}}</div>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Alamat</span>
                                </div>
                                <input type="text" v-model="Konsumen.Alamat_Konsumen" 
                                    class="form-control" placeholder="Masukkan Alamat Konsumen" 
                                    aria-label="Alamat_Konsumen" aria-describedby="basic-addon2" 
                                    id="Alamat_Konsumen" name="Alamat_Konsumen" 
                                    @input="$v.Konsumen.Alamat_Konsumen.$touch()" 
                                    @blur="$v.Konsumen.Alamat_Konsumen.$touch()" required>
                            </div>
                            <div class="text-center">
                                <p class="mb-3" style="color:red;" 
                                    v-if="$v.Konsumen.Alamat_Konsumen.$invalid">{{addressErrors[0]}}</p>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Telepon</span>
                                </div>
                                <input type="number" v-model="Konsumen.Telepon_Konsumen" 
                                    class="form-control" placeholder="Masukkan Nomor Telepon Konsumen" 
                                    aria-label="Telepon_Konsumen" aria-describedby="basic-addon2" 
                                    id="Telepon_Konsumen" name="Telepon_Konsumen" 
                                    @input="$v.Konsumen.Telepon_Konsumen.$touch()" 
                                    @blur="$v.Konsumen.Telepon_Konsumen.$touch()" required>
                            </div>
                            <div class="text-center">
                                <p class="mb-3" style="color:red;" 
                                    v-if="$v.Konsumen.Telepon_Konsumen.$invalid">{{phoneErrors[0]}}</p>
                            </div>
                            </div>

                    <div class="modal-footer mt-3">
                        <button type="submit" class="btn btn-primary btn-lg w-100" 
                        @click="updatekonsumen(Konsumen.Id_Konsumen)" 
                        :disabled="$v.Konsumen.$invalid" data-dismiss="modal">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF EDIT KONSUMEN -->
        <!-- DELETE KONSUMEN -->
        <div class="modal fade" id="Delete_Konsumen" tabindex="-1" role="dialog" 
            aria-labelledby="Delete_Konsumen" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Hapus Data Konsumen</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                            aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">
                            </span> Apakah Anda Yakin Ingin Menghapus Data Konsumen Ini ?</div>
                    </div>
                    <div class="modal-footer ">
                        <a id="delete_btn" class="float-left w-100">
                            <button type="button" @click="deletekonsumen(Konsumen.Id_Konsumen)" 
                            class="btn btn-danger float-left w-50" data-dismiss="modal">
                            <span class="glyphicon glyphicon-ok-sign"></span>Ya</button>
                        </a>
                        <button type="button" class="btn btn-secondary float-right w-50" 
                        data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Tidak</button>
                    </div>
                </div>
            </div>
            </div>
        <!-- END OF DELETE KONSUMEN -->
        <!-- END OF MY MODALS -->
    </body>
</template>
<script>
import Controller from '../../service/Konsumen'
import validators from '../../validations/konsumen_validations'

export default {
    validations: validators,
    data: () => ({
        konsumendata:[],
        handledkonsumen:[],
        Nama_Konsumen:'',
        Alamat_Konsumen:'',
        Telepon_Konsumen:'',
        Cari_Konsumen:'',
        Konsumen:{
            Nama_Konsumen:'',
            Alamat_Konsumen:'',
            Telepon_Konsumen:'',
        }
    }),
    mounted(){
        this.getallkonsumen()
    },
    methods:{
        async getallkonsumen () {
            try {
                this.konsumendata = (await Controller.getallkonsumen()).data
                console.log(this.konsumendata)
            } catch (err) {
                console.log(err)
            }
        },
        async addkonsumen () {
            try {
                const payload = {
                    Nama_Konsumen       : this.Konsumen.Nama_Konsumen,
                    Alamat_Konsumen     : this.Konsumen.Alamat_Konsumen,
                    Telepon_Konsumen    : this.Konsumen.Telepon_Konsumen,
                }
                await Controller.addkonsumen(payload)
                this.getallkonsumen()
                this.refresh()
            } catch (err) {
                console.log(err)
            }
        },
        async updatekonsumen (id) {
            try {
                const payload = {
                    Nama_Konsumen       : this.Konsumen.Nama_Konsumen,
                    Alamat_Konsumen     : this.Konsumen.Alamat_Konsumen,
                    Telepon_Konsumen    : this.Konsumen.Telepon_Konsumen,
                }
                await Controller.updatekonsumen(payload,id)
                this.getallkonsumen()
                this.refresh()
            } catch (err) {
                console.log(err)
            }
        },
        async deletekonsumen(id) {
            try {
                await Controller.deletekonsumen(id)
                this.getallkonsumen()
            } catch (err) {
                console.log(err)
            }
        },
        datakonsumenhandler(konsumen){
            this.Konsumen = konsumen
        },
        refresh(){
            this.Konsumen.Nama_Konsumen = '';
            this.Konsumen.Alamat_Konsumen= '';
            this.Konsumen.Telepon_Konsumen= '';
        }
    },
    computed:{
        filteredkonsumen:function(){
            return this.konsumendata.filter((konsumen)=>{
                return konsumen.Nama_Konsumen.match(this.Cari_Konsumen);
            });
        },
        nameErrors () {
            const errors = []
            if (!this.$v.Konsumen.Nama_Konsumen.$dirty) return errors
            !this.$v.Konsumen.Nama_Konsumen.minLength && errors.push('Name must be at least 5 characters long')
            !this.$v.Konsumen.Nama_Konsumen.maxLength && errors.push('Name must be at most 25 characters long')
            !this.$v.Konsumen.Nama_Konsumen.required && errors.push('Name is required.')
            return errors
        },
        addressErrors () {
            const errors = []
            if (!this.$v.Konsumen.Alamat_Konsumen.$dirty) return errors
            !this.$v.Konsumen.Alamat_Konsumen.maxLength && errors.push('Address must be at most 12 characters long')
            !this.$v.Konsumen.Alamat_Konsumen.minLength && errors.push('Address must be numeric')
            !this.$v.Konsumen.Alamat_Konsumen.required && errors.push('Address is required')
            return errors
        },
        phoneErrors () {
            const errors = []
            if (!this.$v.Konsumen.Telepon_Konsumen.$dirty) return errors
            !this.$v.Konsumen.Telepon_Konsumen.maxLength && errors.push('Phone must be at most 12 characters long')
            !this.$v.Konsumen.Telepon_Konsumen.numeric && errors.push('Phone must be numeric')
            !this.$v.Konsumen.Telepon_Konsumen.required && errors.push('Phone is required')
            return errors
        },
    }
}
</script>

