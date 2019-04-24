<template>
    <body>
        <div class="container mt-3" style="max-width: 800px;">
            <div class="row mb-2">
                <div class="col-sm-2">
                    <button class="btn btn-success float-left mb-2 btn-block" 
                    @click="getallkonsumen(),refresh()" 
                    data-title="Tambah_Konsumen" data-toggle="modal" 
                    data-target="#Tambah_Konsumen">
                        <i class="fas fa-plus mr-2"></i>Tambah
                    </button>
                </div>
                <div class="col-sm-6">

                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input class="form-control" v-model="Cari_Konsumen" type="search" 
                        placeholder="Cari Konsumen">
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
                            <th scope="col">Motor</th>
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
                                <p data-placement="top" data-toggle="tooltip" title="Tambah">
                                    <button @click="datakonsumenhandler(konsumen)" 
                                    class="btn btn-success" data-title="Tambah_Motor_Konsumen"
                                    data-toggle="modal" data-target="#Tambah_Motor_Konsumen">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </p>
                            </td>
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

        <!-- MODAL OF MOTOR KONSUMEN -->
        <div class="modal fade" id="Tambah_Motor_Konsumen" tabindex="-1" role="dialog" 
            aria-labelledby="Tambah_Motor_Konsumen" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 800px;">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Tambah Motor Konsumen</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" >
                        <div class="container mt-3" style="max-width: 800px;">
                        <div class="row mb-2">
                            <div class="col-sm-2">
                                <button class="btn btn-success float-left mb-2 btn-block" 
                                @click="getallmotorkonsumen(),refresh()" 
                                data-title="Tambah_MotorKonsumen" data-toggle="modal" 
                                data-target="#Tambah_MotorKonsumen" data-dismiss="modal">
                                    <i class="fas fa-plus mr-2"></i>Tambah
                                </button>
                            </div>
                            <div class="col-sm-6">

                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input class="form-control" v-model="Cari_Motor_Konsumen" 
                                    type="search" 
                                    placeholder="Cari Motor Konsumen">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                    
                    <div class="table-responsive" style="max-width: 800px; margin: auto;">
                        <table class="table table-striped table-hover">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Konsumen</th>
                                    <th scope="col">ID Motor</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-bind:key="motorkonsumen['Id_Motor_Konsumen']" v-for="motorkonsumen in filteredmotorkonsumen">
                                    <td>{{motorkonsumen.Id_Konsumen}} </td>
                                    <td>{{motorkonsumen.Nama_Konsumen}} </td>
                                    <td>{{motorkonsumen.Id_Motor}} </td>
                                    <td class="text-center">
                                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                                            <button class="btn btn-primary" 
                                                data-dismiss="modal"
                                                @click="datamotorkonsumenhandler(motorkonsumen)" 
                                                data-title="Edit_Konsumen" data-toggle="modal" 
                                                data-target="#Edit_Konsumen">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p data-placement="top" data-toggle="tooltip" title="Delete">
                                            <button @click="datamotorkonsumenhandler(motorkonsumen)"
                                                data-dismiss="modal" 
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
                </div>
            </div>
        </div>
        <!-- TAMBAH MOTOR KONSUMEN -->
        <div class="modal fade" id="Tambah_MotorKonsumen" tabindex="-1" role="dialog" 
            aria-labelledby="Tambah_MotorKonsumen" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Tambah Motor Konsumen</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                            aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <div class="input-group">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">ID</span>
                            </div>
                            <input type="text" v-model="Konsumen.Id_Konsumen" class="form-control" 
                                placeholder="Masukkan Nama Konsumen" :error="nameErrors" 
                                aria-label="Nama_Konsumen" aria-describedby="basic-addon2" 
                                id="Nama_Konsumen" name="Nama_Konsumen" 
                                @input="$v.Konsumen.Nama_Konsumen.$touch()" 
                                @blur="$v.Konsumen.Nama_Konsumen.$touch()" required>
                        </div> -->

                        <!-- <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">ID Konsumen</span>
                            </div>
                            <input type="text" v-model="Motor_Konsumen.Id_Konsumen" 
                                class="form-control" placeholder="Masukkan Plat Kendaraan" 
                                aria-label="Motor_Konsumen_Plat_Kendaraan" aria-describedby="basic-addon2" 
                                id="Motor_Konsumen_Plat_Kendaraan" name="Motor_Konsumen_Plat_Kendaraan" 
                                @input="$v.Motor_Konsumen.Id_Konsumen.$touch()" 
                                @blur="$v.Motor_Konsumen.Id_Konsumen.$touch()" required>
                        </div> -->


                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">ID Konsumen</span>
                            </div>
                            <input type="text" v-model="Konsumen.Id_Konsumen" 
                                aria-label="Id_Konsumen" aria-describedby="basic-addon2" 
                                id="Id_Konsumen" name="Id_Konsumen" disabled>{{Konsumen.Id_Konsumen}}
                        </div>

                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Nama</span>
                            </div>
                            <input type="text" v-model="Konsumen.Nama_Konsumen" 
                                aria-label="Nama_Konsumen" aria-describedby="basic-addon2" 
                                id="Nama_Konsumen" name="Nama_Konsumen" disabled>{{Konsumen.Nama_Konsumen}}
                        </div>

                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Id_Motor</span>
                            </div>
                                
                            <select class="form-control mr-2" v-model="Motor_Konsumen.Id_Motor">
                                <option disabled="disabled" selected="selected" 
                                value="Pilih Merk">-- Pilih Merk Motor --</option>
                                <option v-bind:key="motor['Id_Motor']" 
                                v-on:change="getSelectedIndex"
                                v-for="motor in motorcycle" 
                                :value="motor.Id_Motor">{{motor.Id_Motor}}</option>
                            </select>
                        </div>

                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Plat</span>
                            </div>
                            <input type="text" v-model="Motor_Konsumen.Plat_Kendaraan" 
                                class="form-control" placeholder="Masukkan Plat Kendaraan" 
                                aria-label="Motor_Konsumen_Plat_Kendaraan" aria-describedby="basic-addon2" 
                                id="Motor_Konsumen_Plat_Kendaraan" name="Motor_Konsumen_Plat_Kendaraan" 
                                @input="$v.Motor_Konsumen.Plat_Kendaraan.$touch()" 
                                @blur="$v.Motor_Konsumen.Plat_Kendaraan.$touch()" required>
                        </div>

                        <div class="modal-footer mt-3">
                            <button type="submit" class="btn btn-success btn-lg w-100" 
                            data-dismiss="modal" 
                            @click="addmotorkonsumen()"  >Tambahkan Motor Konsumen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF TAMBAH MOTOR KONSUMEN -->
    </body>

</template>
<script>
import Controller from '../../service/Konsumen'
import controller from '../../service/MotorKonsumen'
import motorController from '../../service/Motor'
import validators from '../../validations/konsumen_validations'

export default {
    validations: validators,
    data: () => ({
        konsumendata:[],
        motorkonsumendata:[],
        handledkonsumen:[],
        motorcycle:[],
        Nama_Konsumen:'',
        Alamat_Konsumen:'',
        Telepon_Konsumen:'',
        Cari_Konsumen:'',
        Cari_Motor_Konsumen: '',
        Konsumen:{
            Nama_Konsumen:'',
            Alamat_Konsumen:'',
            Telepon_Konsumen:'',
        },
        Motor_Konsumen:{
            Id_Motor_Konsumen : '',
            Id_Konsumen: '',
            Nama_Konsumen:'',
            Id_Motor: '',
            Plat_Kendaraan:'',
        },
        Motor:{
            Merk:'',
            Tipe:'',
            Id_Motor:''
        },
    }),
    mounted(){
        this.getallkonsumen()
        this.getallmotorkonsumen()
        this.getallmotor()
    },
    methods:{
        async getallmotor () {
            try {
                this.motorcycle = (await motorController.getallmotor()).data
                console.log(this.motorcycle)
            } catch (err) {
                console.log(err)
            }
        },
        async getallmotorkonsumen () {
            try {
                this.motorkonsumendata = (await controller.getallmotorkonsumen()).data
                console.log(this.motorkonsumendata)
            } catch (err) {
                console.log(err)
            }
        },
        async addmotorkonsumen () {
            try {
                const payload = {
                    Id_Motor_Konsumen     : this.Motor_Konsumen.Id_Motor_Konsumen,
                    Id_Konsumen           : this.Konsumen.Id_Konsumen,
                    Nama_Konsumen         : this.Konsumen.Nama_Konsumen,
                    Id_Motor              : this.Motor_Konsumen.Id_Motor,
                    Plat_Kendaraan        : this.Motor_Konsumen.Plat_Kendaraan,
                }
                await controller.addmotorkonsumen(payload)
                this.getallmotorkonsumen()
                //this.refresh()
            } catch (err) {
                console.log(err)
            }
        },
        async updatemotorkonsumen (id) {
            try {
                const payload = {
                    Id_Motor_Konsumen     : this.Motor_Konsumen.Id_Motor_Konsumen,
                    Id_Konsumen           : this.Konsumen.Id_Konsumen,
                    Nama_Konsumen         : this.Konsumen.Nama_Konsumen,
                    Id_Motor              : this.Motor_Konsumen.Id_Motor,
                    Plat_Kendaraan        : this.Motor_Konsumen.Plat_Kendaraan,
                }
                await controller.updatemotorkonsumen(payload,id)
                this.getallmotorkonsumen()
                //this.refresh()
            } catch (err) {
                console.log(err)
            }
        },
        async deletemotorkonsumen(id) {
            try {
                await controller.deletemotorkonsumen(id)
                this.getallmotorkonsumen()
            } catch (err) {
                console.log(err)
            }
        },
        datamotorkonsumenhandler(motorkonsumen){
            this.Motor_Konsumen = motorkonsumen
        },
        //Method Motor
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
        filteredmotorkonsumen:function(){
            return this.motorkonsumendata.filter((motorkonsumen)=>{
                return motorkonsumen.Id_Konsumen.match(this.Cari_Motor_Konsumen);
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
            !this.$v.Konsumen.Telepon_Konsumen.maxLength && errors.push('Phone must be at most 15 characters long')
            !this.$v.Konsumen.Telepon_Konsumen.minLength && errors.push('Phone must be at least 10 characters long')
            !this.$v.Konsumen.Telepon_Konsumen.numeric && errors.push('Phone must be numeric')
            !this.$v.Konsumen.Telepon_Konsumen.required && errors.push('Phone is required')
            return errors
        },
    }
}
</script>

