<template>
   <div class="content" id="homeLayout">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <a class="navbar-brand" href=""><img src="" width="50px"> SIAUTO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">
            <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link disabled py-2" href="#" style="font-size: 20pt;">SELAMAT DATANG CUSTOMER SERVICE</a>
                    </li>
                </ul>
            </div>
            <form class="form-inline my-2 my-lg-0" > 
                <button class="btn btn-outline-danger my-2 my-sm-0" type="submit" @click="logoutHandler()">Logout</button>
            </form>
        </div>
    </nav>

    <div class="collapse navbar-collapse show" id=navbarSupportedContent>
        <nav class="nav nav-pills nav-justified" style="background-color: #e3f2fd;">
            <router-link :to="{name:'Pegawai'}" class="nav-tabs nav-item nav-link">
                <a class="nav-tabs nav-item nav-link">Transaksi Penjualan</a>
            </router-link>
        </nav>
	</div>

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
                            <th scope="col">ID</th>
                            <th scope="col">Nama Konsumen</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status Transaksi</th>
                            <th scope="col">Detail</th>
                            <th scope="col">SPK</th>
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
                        <h4 class="modal-title mx-auto" id="Heading">Tambah Transaksi</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                            aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Konsumen</span>
                            </div>
                            <select class="form-control mr-2" v-model="Konsumen.Id_Konsumen" v-on:change="getSelectedIndex">
                                <option disabled="disabled" selected="selected" 
                                value="Pilih Merk">-- Nama Konsumen --</option>
                                <option v-bind:key="konsumen['Id_Konsumen']" 
                                v-for="konsumen in konsumendata" 
                                v-on:change="getSelectedIndex"
                                :value="konsumen.Id_Konsumen">{{konsumen.Nama_Konsumen}}</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" 
                                v-if="$v.Konsumen.Nama_Konsumen.$invalid">{{nameErrors[0]}}</p>
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Telepon</span>
                            </div>
                            <select class="form-control mr-2" v-model="Konsumen.Id_Konsumen" v-on:change="getSelectedIndex">
                                <option disabled="disabled" selected="selected" 
                                value="Pilih Merk">-- Nama Konsumen --</option>
                                <option v-bind:key="konsumen['Id_Konsumen']" 
                                v-for="konsumen in konsumendata" 
                                v-on:change="getSelectedIndex"
                                :value="konsumen.Id_Konsumen">{{konsumen.Telepon_Konsumen}}</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" 
                                v-if="$v.Konsumen.Nama_Konsumen.$invalid">{{nameErrors[0]}}</p>
                        </div>
                        
                        <!-- <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Telepon</span>
                            </div>
                            <input type="number" v-model="Konsumen.Telepon_Konsumen" 
                                class="form-control" placeholder="Masukkan Nomor Telepon Konsumen" 
                                aria-label="Telepon_Konsumen" aria-describedby="basic-addon2" 
                                id="Telepon_Konsumen" name="Telepon_Konsumen" 
                                v-on:change="getSelectedIndex" required>{{konsumen.Telepon_Konsumen}}
                        </div> -->

                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Tanggal</span>
                            </div>
                            <input type="date" v-model="Konsumen.Telepon_Konsumen" 
                                class="form-control" placeholder="Masukkan Nomor Telepon Konsumen" 
                                aria-label="Telepon_Konsumen" aria-describedby="basic-addon2" 
                                id="Telepon_Konsumen" name="Telepon_Konsumen" required>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" 
                                v-if="$v.Konsumen.Telepon_Konsumen.$invalid">{{phoneErrors[0]}}</p>
                        </div>

                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Status</span>
                            </div>
                            <select class="form-control mr-2" v-model="posisi">
                                <option disabled="disabled" selected="selected" value="Pilih Posisi">Pilih Status</option>
                                <option v-for="(posisi,index) in positions" :key="index" >{{posisi.value}}</option>
                            </select>
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
   </div>
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
        Cari_Motor_Konsumen: '',
        Cari_Konsumen:'',
        Id_Konsumen: '',
        Id_Motor_Konsumen: '',
        Plat_Kendaraan:'',
        Motor_Konsumen:{
            Id_Motor_Konsumen : '',
            Id_Konsumen: '',
            Nama_Konsumen:'',
            Id_Motor: '',
            Plat_Kendaraan:'',
        },
        Konsumen:{
            Nama_Konsumen:'',
            Alamat_Konsumen:'',
            Telepon_Konsumen:'',
        },
        Motor:{
            Merk:'',
            Tipe:'',
            Id_Motor:''
        },
        posisi: 'Pilih Status',
        positions: [
            { value: "Selesai", id: 'Depan' },
            { value: "Belum Diproses", id: 'Tengah' },
            { value: "Sedang Diproses", id: 'Belakang' }
        ],
    }),
    mounted(){
        this.getallkonsumen()
        this.getallmotorkonsumen()
    },
    methods:{
        getSelectedIndex(){
            this.index = this.konsumen.map(function(e) { return e.Id_Konsumen; }).indexOf(this.Konsumen.Id_Konsumen)
            console.log(this.index)
        },
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
                    Id_Motor              : this.Motor.Id_Motor,
                    Plat_Kendaraan        : this.Motor_Konsumen.Plat_Kendaraan,
                }
                await controller.addmotorkonsumen(payload)
                this.getallmotorkonsumen()
                this.refreshMotorKonsumen()
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
                    Id_Motor              : this.Motor.Id_Motor,
                    Plat_Kendaraan        : this.Motor_Konsumen.Plat_Kendaraan,
                }
                await controller.updatemotorkonsumen(payload,id)
                this.getallmotorkonsumen()
                this.refreshMotorKonsumen()
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
        //Method konsumen
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
        },
        refreshMotorKonsumen(){
            this.Motor_Konsumen.Plat_Kendaraan = '';
            this.Motor.Id_Motor = -1;
            // this.Motor.Merk = -1;
            // this.Motor.Tipe = -1;
        }
    },
    computed:{
        filteredkonsumen:function(){
            return this.konsumendata.filter((konsumen)=>{
                return konsumen.Nama_Konsumen.toLowerCase().match(this.Cari_Konsumen.toLowerCase());
            });
        },
        filteredmotorkonsumen:function(){
            return this.motorkonsumendata.filter((motorkonsumen)=>{
                return motorkonsumen.Plat_Kendaraan.toLowerCase().match(this.Cari_Motor_Konsumen.toLowerCase());
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
            !this.$v.Konsumen.Alamat_Konsumen.maxLength && errors.push('Address must be at most 255 characters long')
            !this.$v.Konsumen.Alamat_Konsumen.minLength && errors.push('Address must be at least 5 characters long')
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
        platErrors () {
            const errors = []
            if (!this.$v.Motor_Konsumen.Plat_Kendaraan.$dirty) return errors
            !this.$v.Motor_Konsumen.Plat_Kendaraan.maxLength && errors.push('Plat must be at most 15 characters long')
            !this.$v.Motor_Konsumen.Plat_Kendaraan.minLength && errors.push('Plat must be at least 5 characters long')
            !this.$v.Motor_Konsumen.Plat_Kendaraan.required && errors.push('Plat is required')
            return errors
        },
    }
}
</script>
