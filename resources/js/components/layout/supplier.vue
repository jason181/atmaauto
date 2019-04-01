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
            
            <div class="table-responsive" style="max-width: 1000px; margin: auto;">
                <table class="table table-striped table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th colspan="3">Supplier</th>
                            <th colspan="2">Sales</th>
                            <th colspan="2">Action</th>
                        </tr>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Telepon</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Telepon</th>
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
                                    <button class="btn btn-primary" @click="updatehandler(supplier)" data-id=(jasa.id) data-title="Edit_Jasa_Service" data-toggle="modal" data-target="#Edit_Jasa_Service">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button @click="deletejasaservice(supplier.id)" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </p>
                            </td>
                        </tr>
                        <!-- <?php  
                        $query="SELECT * FROM jasas";
                        $result=mysqli_query($conn,$query);
                        while($data = mysqli_fetch_assoc($result))
                        {
                            echo '
                                <tr>
                                    <td>'.$data["Nama_Jasa"].'</td>
                                    <td>'.$data["Harga_Jasa"].'</td>
                                    <td class="text-center">
                                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                                            <button class="btn btn-primary" data-id="'.$data["Id_Jasa"].'" data-title="Edit_Jasa_Service" data-toggle="modal" data-target="#Edit_Jasa_Service" >
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p data-placement="top" data-toggle="tooltip" title="Delete">
                                            <button class="btn btn-danger" data-id="'.$data["Id_Jasa"].'" data-title="Hapus_Jasa_Service" data-toggle="modal" data-target="#Hapus_Jasa_Service">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </p>
                                    </td>
                                </tr>
                            ';
                        }
                        ?> -->
                        
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
                        <form @submit.prevent="updatejasaservice(editedjasaservice.id)">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Nama</span>
                            </div>
                                <input type="text" v-model="editedjasaservice.Nama_Jasa" class="form-control" placeholder="Masukkan Nama Jasa Service" aria-label="Nama_Jasa_Service" aria-describedby="basic-addon2" id="Nama_Jasa_Service" name="Nama_Pegawai">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Harga</span>
                            </div>
                                <input type="number" v-model="editedjasaservice.Harga_Jasa" class="form-control" placeholder="Masukkan Harga Jasa Service" aria-label="Harga_Jasa_Service" aria-describedby="basic-addon2" id="Harga_Jasa_Service" name="Harga_Jasa_Service">
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
        // async addjasaservice () {
        //     try {
        //         const payload = {
        //             Nama_Jasa : this.Nama_Jasa,
        //             Harga_Jasa : this.Harga_Jasa,
        //         }
        //         await Controller.addjasaservice(payload)
        //         this.getalljasaservice()
        //         // console.log()
        //     } catch (err) {
        //         console.log(err)
        //     }
        // },
        // async updatejasaservice (id) {
        //     try {
        //         const payload = {
        //             Nama_Jasa : this.editedjasaservice.Nama_Jasa,
        //             Harga_Jasa : this.editedjasaservice.Harga_Jasa,
        //         }
        //         await Controller.updatejasaservice(payload,id)
        //         this.getalljasaservice()
        //         // console.log()
        //     } catch (err) {
        //         console.log(err)
        //     }
        // },
        // async deletejasaservice (id) {
        //     try {
        //         await Controller.deletejasaservice(id)
        //         this.getalljasaservice()
        //         // console.log()
        //     } catch (err) {
        //         console.log(err)
        //     }
        // },
        // updatehandler(jasa){
        //     this.editedjasaservice = jasa
        // }

        
    }
}
</script>

