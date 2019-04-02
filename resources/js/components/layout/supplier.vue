<template>
    <body>
        <div class="container mt-3" style="max-width: 800px;">
            <div class="clearfix my-2">
                <button class="btn btn-success float-left mb-2" data-title="Tambah_Supplier" data-toggle="modal" data-target="#Tambah_Supplier">
                    <i class="fas fa-plus mr-2"></i>Tambah
                </button>
                <div class="navbar navbar-light bg-light float-right p-0">
				  	<form class="form-inline">
				    	<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				    	<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
				  	</form>
				</div>
            </div>
            <div class="table-responsive" style="max-width: 1200px; margin: auto;">
                <table class="table table-striped table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Alamat Supplier </th>
                            <th scope="col">Telepon Supplier</th>
                            <th scope="col">Nama Sales</th>
                            <th scope="col">Telepon Sales</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-bind:key="supplier['id']" v-for="supplier in supplierdata">
                            <td>{{supplier.Nama_Supplier}} </td>
                            <td>{{supplier.Alamat_Supplier}} </td>
                            <td>{{supplier.Telepon_Supplier}} </td>
                            <td>{{supplier.Nama_Sales}} </td>
                            <td>{{supplier.Telepon_Sales}} </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <button class="btn btn-primary" @click="updatehandler(supplier)" data-title="Edit_Supplier" data-toggle="modal" data-target="#Edit_Supplier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button @click="deletesupplier(supplier.id)" class="btn btn-danger">
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
        <!-- TAMBAH SUPPLIER -->
        <div class="modal fade" id="Tambah_Supplier" tabindex="-1" role="dialog" aria-labelledby="Tambah_Supplier" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Tambah Supplier</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="addsupplier()">
                        <div class="modal-body">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Nama</span>
                                </div>
                                <input type="text" v-model="Nama_Supplier" class="form-control" placeholder="Masukkan Nama Supplier" aria-label="Nama_Supplier" aria-describedby="basic-addon2" id="Nama_Supplier" name="Nama_Supplier">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Alamat</span>
                                </div>
                                <input type="text" v-model="Alamat_Supplier" class="form-control" placeholder="Masukkan Alamat Supplier" aria-label="Alamat_Supplier" aria-describedby="basic-addon2" id="Alamat_Supplier" name="Alamat_Supplier">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Telepon</span>
                                </div>
                                <input type="text" v-model="Telepon_Supplier" class="form-control" placeholder="Masukkan Telepon Supplier" aria-label="Telepon_Supplier" aria-describedby="basic-addon2" id="Telepon_Supplier" name="Telepon_Supplier">
                            </div>
                        </div>
                        <div class="modal-header">
                            <h4 class="modal-title mx-auto" id="Heading">Tambah Sales</h4>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Nama</span>
                                </div>
                                <input type="text" v-model="Nama_Sales" class="form-control" placeholder="Masukkan Nama Sales" aria-label="Nama_Sales" aria-describedby="basic-addon2" id="Nama_Sales" name="Nama_Sales">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Telepon</span>
                                </div>
                                <input type="text" v-model="Telepon_Sales" class="form-control" placeholder="Masukkan Telepon Sales" aria-label="Telepon_Sales" aria-describedby="basic-addon2" id="Telepon_Sales" name="Telepon_Sales">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-lg" style="width: 100%;">Tambahkan Supplier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END OF TAMBAH SUPPLIER -->
        <!-- EDIT JASA SUPPLIER -->
        <div class="modal fade" id="Edit_Supplier" tabindex="-1" role="dialog" aria-labelledby="Edit_Supplier" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Edit Supplier</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updatesupplier(editedsupplier.id)">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Nama</span>
                                </div>
                                <input type="text" v-model="editedsupplier.Nama_Supplier" class="form-control" placeholder="Masukkan Nama Supplier" aria-label="Nama_Supplier" aria-describedby="basic-addon2" id="Nama_Supplier" name="Nama_Supplier">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Alamat Supplier</span>
                                </div>
                                <input type="text" v-model="editedsupplier.Alamat_Supplier" class="form-control" placeholder="Masukkan Alamat Supplier" aria-label="Alamat_Supplier" aria-describedby="basic-addon2" id="Alamat_Supplier" name="Alamat_Supplier">
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
        <!-- END OF MY MODALS -->
    </body>
</template>
<script>
import Controller from '../../httpController'
export default {
    data: () => ({
        supplierdata:[],
        editedsupplier:[],
        Nama_Supplier:'',
        Alamat_Supplier:'',
        Telepon_Supplier:'',
        Nama_Sales:'',
        Telepon_Sales:'',
    }),
    mounted(){
        this.getallsupplier()
    },
    methods:{
        async getallsupplier() {
            try {
                this.supplierdata = (await Controller.getallsupplier()).data
                console.log(this.supplierdata)
            } catch (err) {
                console.log(err)
            }
        },
        async addsupplier () {
            try {
                const payload = {
                    Nama_Supplier   : this.Nama_Supplier,
                    Alamat_Supplier : this.Alamat_Supplier,
                    Telepon_Supplier: this.Telepon_Supplier,
                    Nama_Sales      : this.Nama_Sales,
                    Telepon_Sales   : this.Telepon_Sales
                }
                await Controller.addsupplier(payload)
                this.getallsupplier()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        async updatesupplier (id) {
            try {
                const payload = {
                    Nama_Supplier   : this.editedsupplier.Nama_Supplier,
                    Alamat_Supplier : this.editedsupplier.Alamat_Supplier,
                    Telepon_Supplier: this.editedsupplier.Telepon_Supplier,
                    Nama_Sales      : this.editedsupplier.Nama_Sales,
                    Telepon_Sales   : this.editedsupplier.Telepon_Sales
                }
                await Controller.updatesupplier(payload,id)
                this.getallsupplier()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        async deletesupplier (id) {
            try {
                await Controller.deletesupplier(id)
                this.getallsupplier()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        updatehandler(supplier){
            this.editedsupplier = supplier
        }

        
    }
}
</script>

