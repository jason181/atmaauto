<template>
    <body>
        <div class="container mt-3" style="">
            <div class="clearfix my-2">
                <button class="btn btn-success float-left mb-2" data-title="Tambah_Jasa_Service" data-toggle="modal" data-target="#Tambah_Jasa_Service">
                    <i class="fas fa-plus mr-2"></i>Tambah
                </button>
                <div class="navbar navbar-light bg-light float-right p-0">
				  	<form class="form-inline">
				    	<input class="form-control mr-sm-2" type="search" v-model="Cari_Sparepart" placeholder="Search" aria-label="Search">
				    	<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
				  	</form>
				</div>
            </div>
            
            <div class="table-responsive" style="margin: auto;">
                <table class="table table-striped table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Rak</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Stok Minimum</th>
                            <th scope="col">Harga Beli</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr v-bind:key="index" v-for="sparepart in sparepartdata"> -->
                        <tr v-bind:key="index" v-for="(sparepart,index) in filteredsparepart">
                            <td>{{sparepart.Kode_Sparepart}} </td>
                            <td>{{sparepart.Nama_Sparepart}} </td>
                            <td>{{sparepart.Merk_Sparepart}} </td>
                            <td>{{sparepart.Rak_Sparepart}} </td>
                            <td>{{sparepart.Jumlah_Sparepart}} </td>
                            <td>{{sparepart.Stok_Minimum_Sparepart}} </td>
                            <td>{{sparepart.Harga_Beli}} </td>
                            <td>{{sparepart.Harga_Jual}} </td>
                            <td>{{sparepart.Gambar}} </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <button class="btn btn-primary" @click="dataspareparthandler(sparepart)" data-title="Edit_Jasa_Service" data-toggle="modal" data-target="#Edit_Jasa_Service">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button @click="dataspareparthandler(sparepart)" class="btn btn-danger"  data-title="Delete_Jasa_Service" data-toggle="modal" data-target="#Delete_Jasa_Service">
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
        <!-- <div class="modal fade" id="Tambah_Jasa_Service" tabindex="-1" role="dialog" aria-labelledby="Tambah_Jasa_Service" aria-hidden="true">
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
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Nama</span>
                                </div>
                                <input type="text" v-model="Nama_Jasa" class="form-control" placeholder="Masukkan Nama Jasa Service" aria-label="Nama_Jasa_Service" aria-describedby="basic-addon2" id="Nama_Jasa_Service" name="Nama_Pegawai">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Harga</span>
                                </div>
                                <input type="number" v-model="Harga_Jasa" class="form-control" placeholder="Masukkan Harga Jasa Service" aria-label="Harga_Jasa_Service" aria-describedby="basic-addon2" id="Harga_Jasa_Service" name="Harga_Jasa_Service">
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-success btn-lg" style="width: 100%;">Tambahkan Jasa Service</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- END OF TAMBAH JASA SERVICE -->
        <!-- EDIT JASA SERVICE -->
        <!-- <div class="modal fade" id="Edit_Jasa_Service" tabindex="-1" role="dialog" aria-labelledby="Edit_Jasa_Service" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Edit Jasa Service</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updatejasaservice(handledjasaservice.id)">
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
        </div> -->
        <!-- END OF EDIT JASA SERVICE -->
        <!-- DELETE JASA SERVICE -->
        <!-- <div class="modal fade" id="Delete_Jasa_Service" tabindex="-1" role="dialog" aria-labelledby="Delete_Jasa_Service" aria-hidden="true">
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
                            <button type="button" @click="deletejasaservice(handledjasaservice.id)" class="btn btn-danger float-left w-50" data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span>Ya</button>
                        </a>
                        <button type="button" class="btn btn-secondary float-right w-50" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Tidak</button>
                    </div>
                </div>
            </div>
            </div> -->
        <!-- END OF DELETE JASA SERVICE -->
        <!-- END OF MY MODALS -->
    </body>
</template>
<script>
import Controller from '../../httpController'
export default {
    data: () => ({
        sparepartdata:[],
        handledsparepart:[],
        Kode_Sparepart:'',
        Nama_Sparepart:'',
        Merk_Sparepart:'',
        Rak_Sparepart:'',
        Jumlah_Sparepart:'',
        Stok_Minimum_Sparepart:'',
        Harga_Beli:0,
        Harga_Jual:0,
        Gambar:'',
        Cari_Sparepart:'',
    }),
    mounted(){
        this.getallsparepart()
    },
    methods:{
        async getallsparepart () {
            try {
                this.sparepartdata = (await Controller.getallsparepart()).data
                console.log(this.sparepartdata)
            } catch (err) {
                console.log(err)
            }
        },
        async addsparepart () {
            try {
                const payload = {
                    Kode_Sparepart      : this.Kode_Sparepart,
                    Nama_Sparepart      : this.Nama_Sparepart,
                    Merk_Sparepart      : this.Merk_Sparepart,
                    Rak_Sparepart       : this.Rak_Sparepart,
                    Jumlah_Sparepart    : this.Jumlah_Sparepart,
                    Stok_Minimum_Sparepart:this.Stok_Minimum_Sparepart,
                    Harga_Beli          : this.Harga_Beli,
                    Harga_Jual          : this.Harga_Jual,
                    Gambar              : this.Gambar,
                }
                await Controller.addsparepart(payload)
                this.getallsparepart()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        async updatesparepart (id) {
            try {
                const payload = {
                    Kode_Sparepart      : this.handledsparepart.Kode_Sparepart,
                    Nama_Sparepart      : this.handledsparepart.Nama_Sparepart,
                    Merk_Sparepart      : this.handledsparepart.Merk_Sparepart,
                    Rak_Sparepart       : this.handledsparepart.Rak_Sparepart,
                    Jumlah_Sparepart    : this.handledsparepart.Jumlah_Sparepart,
                    Stok_Minimum_Sparepart:this.handledsparepart.Stok_Minimum_Sparepart,
                    Harga_Beli          : this.handledsparepart.Harga_Beli,
                    Harga_Jual          : this.handledsparepart.Harga_Jual,
                    Gambar              : this.handledsparepart.Gambar,
                }
                await Controller.updatesparepart(payload,id)
                this.getallsparepart()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        async deletesparepart (id) {
            try {
                await Controller.deletesparepart(id)
                this.getallsparepart()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        dataspareparthandler(sparepart){
            this.handledsparepart = sparepart
        }
    },
    computed:{
        filteredsparepart:function(){
            return this.sparepartdata.filter((sparepart)=>{
                return  sparepart.Nama_Sparepart.toLowerCase().match(this.Cari_Sparepart.toLowerCase())||
                        sparepart.Kode_Sparepart.toLowerCase().match(this.Cari_Sparepart.toLowerCase())||
                        sparepart.Merk_Sparepart.toLowerCase().match(this.Cari_Sparepart.toLowerCase());
            });
        }
    }
}
</script>

