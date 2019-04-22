<template>
    <body>
        <div class="container-fluid mt-3" style="">
            <div class="clearfix my-2">
                <button class="btn btn-success float-left mb-2" data-title="Tambah_Supplier" data-toggle="modal" data-target="#Tambah_Supplier">
                    <i class="fas fa-plus mr-2"></i>Tambah
                </button>
                <div class="navbar navbar-light bg-light float-right p-0">
				  	<form class="form-inline">
				    	<input class="form-control mr-sm-2" type="search" v-model="Cari_Supplier" placeholder="Search" aria-label="Search">
				    	<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
				  	</form>
				</div>
            </div>
            <div class="table-responsive" style="margin: auto;">
                <table class="table table-striped table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Alamat Supplier </th>
                            <th scope="col">Telepon Supplier</th>
                            <th scope="col">Nama Sales</th>
                            <th scope="col">Telepon Sales</th>
                            <th scope="col">Edit Supplier</th>
                            <th scope="col">Delete Supplier</th>
                            <th scope="col">Tambah / Edit Sales</th>
                            <th scope="col">Delete Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-bind:key="supplier['Id_Supplier']" v-for="supplier in filteredsupplier">
                            <td>{{supplier.Nama_Supplier}} </td>
                            <td>{{supplier.Alamat_Supplier}} </td>
                            <td>{{supplier.Telepon_Supplier}} </td>
                            <td>{{supplier.Nama_Sales}} </td>
                            <td>{{supplier.Telepon_Sales}} </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <button class="btn btn-primary" @click="datasupplierhandler(supplier)" data-title="Edit_Supplier" data-toggle="modal" data-target="#Edit_Supplier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button @click="datasupplierhandler(supplier)" class="btn btn-danger" data-title="Delete_Supplier" data-toggle="modal" data-target="#Delete_Supplier">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center" v-if="supplier.Nama_Sales==null">
                                <p data-placement="top" data-toggle="tooltip" title="Tambah">
                                    <button @click="datasupplierhandler(supplier)" class="btn btn-success" data-title="Tambah_Sales" data-toggle="modal" data-target="#Tambah_Sales">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center" v-else>
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <button @click="datasupplierhandler(supplier)" class="btn btn-primary" data-title="Edit_Sales" data-toggle="modal" data-target="#Edit_Sales">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button @click="datasupplierhandler(supplier)" class="btn btn-danger" data-title="Delete_Sales" data-toggle="modal" data-target="#Delete_Sales">
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
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Nama</span>
                            </div>
                            <input type="text" v-model="Supplier.Nama_Supplier" class="form-control" placeholder="Masukkan Nama Supplier" aria-label="Nama_Supplier" aria-describedby="basic-addon2" id="Nama_Supplier" name="Nama_Supplier" @input="$v.Supplier.Nama_Supplier.$touch()" @blur="$v.Supplier.Nama_Supplier.$touch()" require>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" v-if="$v.Supplier.Nama_Supplier.$invalid">{{nameErrors[0]}}</p>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Alamat</span>
                            </div>
                            <input type="text" v-model="Supplier.Alamat_Supplier" class="form-control" placeholder="Masukkan Alamat Supplier" aria-label="Alamat_Supplier" aria-describedby="basic-addon2" id="Alamat_Supplier" name="Alamat_Supplier" @input="$v.Supplier.Alamat_Supplier.$touch()" @blur="$v.Supplier.Alamat_Supplier.$touch()" required>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" v-if="$v.Supplier.Alamat_Supplier.$invalid">{{addressErrors[0]}}</p>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Telepon</span>
                            </div>
                            <input type="text" v-model="Supplier.Telepon_Supplier" class="form-control" placeholder="Masukkan Telepon Supplier" aria-label="Telepon_Supplier" aria-describedby="basic-addon2" id="Telepon_Supplier" name="Telepon_Supplier" @input="$v.Supplier.Telepon_Supplier.$touch()" @blur="$v.Supplier.Telepon_Supplier.$touch()" required>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" v-if="$v.Supplier.Telepon_Supplier.$invalid">{{phoneErrors[0]}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-lg w-100" @click="addsupplier()" data-dismiss="modal">Tambahkan Supplier</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF TAMBAH SUPPLIER -->
        <!-- EDIT SUPPLIER -->
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
                        <div class="input-group">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Nama</span>
                            </div>
                            <input type="text" v-model="Supplier.Nama_Supplier" class="form-control" placeholder="Masukkan Nama Supplier" aria-label="Nama_Supplier" aria-describedby="basic-addon2" id="Nama_Supplier" name="Nama_Supplier" @input="$v.Supplier.Nama_Supplier.$touch()" @blur="$v.Supplier.Nama_Supplier.$touch()" require>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" v-if="$v.Supplier.Nama_Supplier.$invalid">{{nameErrors[0]}}</p>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Alamat</span>
                            </div>
                            <input type="text" v-model="Supplier.Alamat_Supplier" class="form-control" placeholder="Masukkan Alamat Supplier" aria-label="Alamat_Supplier" aria-describedby="basic-addon2" id="Alamat_Supplier" name="Alamat_Supplier" @input="$v.Supplier.Alamat_Supplier.$touch()" @blur="$v.Supplier.Alamat_Supplier.$touch()" required>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" v-if="$v.Supplier.Alamat_Supplier.$invalid">{{addressErrors[0]}}</p>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Telepon</span>
                            </div>
                            <input type="text" v-model="Supplier.Telepon_Supplier" class="form-control" placeholder="Masukkan Telepon Supplier" aria-label="Telepon_Supplier" aria-describedby="basic-addon2" id="Telepon_Supplier" name="Telepon_Supplier" @input="$v.Supplier.Telepon_Supplier.$touch()" @blur="$v.Supplier.Telepon_Supplier.$touch()" required>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" v-if="$v.Supplier.Telepon_Supplier.$invalid">{{phoneErrors[0]}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-lg w-100" @click="updatesupplier(Supplier.Id_Supplier)" data-dismiss="modal" :disabled="($v.Supplier.Nama_Supplier.$invalid || $v.Supplier.Alamat_Supplier.$invalid || $v.Supplier.Telepon_Supplier.$invalid)">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF EDIT SUPPLIER -->
        <!-- DELETE SUPPLIER -->
        <div class="modal fade" id="Delete_Supplier" tabindex="-1" role="dialog" aria-labelledby="Delete_Supplier" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Hapus Data Supplier</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda Yakin Ingin Menghapus Data Supplier Ini ?</div>
                    </div>
                    <div class="modal-footer ">
                        <a id="delete_btn" class="float-left w-100">
                            <button type="button" @click="deletesupplier(Supplier.Id_Supplier)" class="btn btn-danger float-left w-50" data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span>Ya</button>
                        </a>
                        <button type="button" class="btn btn-secondary float-right w-50" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Tidak</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF DELETE SUPPLIER -->
        <!-- TAMBAH SALES -->
        <div class="modal fade" id="Tambah_Sales" tabindex="-1" role="dialog" aria-labelledby="Tambah_Sales" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Tambah Sales</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Nama</span>
                            </div>
                            <input type="text" v-model="Supplier.Nama_Sales" class="form-control" placeholder="Masukkan Nama Sales" aria-label="Nama_Sales" aria-describedby="basic-addon2" id="Nama_Sales" name="Nama_Sales" @input="$v.Supplier.Nama_Sales.$touch()" @blur="$v.Supplier.Nama_Sales.$touch()" require>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" v-if="$v.Supplier.Nama_Sales.$invalid">{{salesNameErrors[0]}}</p>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Telepon</span>
                            </div>
                            <input type="text" v-model="Supplier.Telepon_Sales" class="form-control" placeholder="Masukkan Telepon Sales" aria-label="Telepon_Sales" aria-describedby="basic-addon2" @input="$v.Supplier.Telepon_Sales.$touch()" @blur="$v.Supplier.Telepon_Sales.$touch()" required>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" v-if="$v.Supplier.Telepon_Sales.$invalid">{{salesPhoneErrors[0]}}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-lg w-100" @click="updatesales(Supplier.Id_Supplier)" data-dismiss="modal">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF TAMBAH SALES -->
        <!-- EDIT SALES -->
        <div class="modal fade" id="Edit_Sales" tabindex="-1" role="dialog" aria-labelledby="Edit_Sales" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Edit Sales</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Nama</span>
                            </div>
                            <input type="text" v-model="Supplier.Nama_Sales" class="form-control" placeholder="Masukkan Nama Sales" aria-label="Nama_Supplier" aria-describedby="basic-addon2" id="Nama_Supplier" name="Nama_Supplier" @input="$v.Supplier.Nama_Sales.$touch()" @blur="$v.Supplier.Nama_Sales.$touch()" require>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" v-if="$v.Supplier.Nama_Sales.$invalid">{{salesNameErrors[0]}}</p>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Telepon</span>
                            </div>
                            <input type="text" v-model="Supplier.Telepon_Sales" class="form-control" placeholder="Masukkan Telepon Sales" aria-label="Telepon_Sales" aria-describedby="basic-addon2" @input="$v.Supplier.Telepon_Sales.$touch()" @blur="$v.Supplier.Telepon_Sales.$touch()" required>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" v-if="$v.Supplier.Telepon_Sales.$invalid">{{salesPhoneErrors[0]}}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-lg w-100" @click="updatesales(Supplier.Id_Supplier)" data-dismiss="modal">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF EDIT SALES -->
        <!-- DELETE SALES -->
        <div class="modal fade" id="Delete_Sales" tabindex="-1" role="dialog" aria-labelledby="Delete_Sales" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Hapus Data Sales</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda Yakin Ingin Menghapus Data Sales Ini ?</div>
                    </div>
                    <div class="modal-footer ">
                        <a id="delete_btn" class="float-left w-100">
                            <button type="button" @click="delsales(Supplier.Id_Supplier)" class="btn btn-danger float-left w-50" data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span>Ya</button>
                        </a>
                        <button type="button" class="btn btn-secondary float-right w-50" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Tidak</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF DELETE SALES -->
        <!-- END OF MY MODALS -->
    </body>
</template>
<script>
import Controller from '../../httpController'
import validators from '../../validations/supplier_validation' 

export default {
    validations:validators,
    data: () => ({
        supplierdata:[],
        Nama_Supplier:'',
        Alamat_Supplier:'',
        Telepon_Supplier:'',
        Nama_Sales:'',
        Telepon_Sales:'',
        Cari_Supplier:'',
        Supplier:{
            Nama_Supplier:'',
            Alamat_Supplier:'',
            Telepon_Supplier:'',
            Nama_Sales:'',
            Telepon_Sales:'',
        }
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
                    Nama_Supplier   : this.Supplier.Nama_Supplier,
                    Alamat_Supplier : this.Supplier.Alamat_Supplier,
                    Telepon_Supplier: this.Supplier.Telepon_Supplier
                }
                await Controller.addsupplier(payload)
                this.getallsupplier()
                this.refreshSupplier()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        async updatesupplier (id) {
            try {
                const payload = {
                    Nama_Supplier   : this.Supplier.Nama_Supplier,
                    Alamat_Supplier : this.Supplier.Alamat_Supplier,
                    Telepon_Supplier: this.Supplier.Telepon_Supplier
                }
                await Controller.updatesupplier(payload,id)
                this.getallsupplier()
                this.refreshSupplier()
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
        datasupplierhandler(supplier){
            this.Supplier = supplier
        },
        async updatesales(id) {
            try {
                const payload = {
                    Nama_Sales   : this.Supplier.Nama_Sales,
                    Telepon_Sales: this.Supplier.Telepon_Sales
                }
                await Controller.updatesales(payload,id)
                this.getallsupplier()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        async delsales(id) {
            try {
                const payload = {
                    Nama_Sales   : null,
                    Telepon_Sales: null
                }
                await Controller.delsales(payload,id)
                this.getallsupplier()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        refreshSupplier(){
            this.Nama_Supplier      ='';
            this.Alamat_Supplier    ='';
            this.Telepon_Supplier   ='';
        },
        refreshSales(){
            this.Nama_Sales         ='';
            this.Telepon_Sales      ='';
        }
    },
    computed:{
        filteredsupplier:function(){
            return this.supplierdata.filter((Supplier)=>{
                return Supplier.Nama_Supplier.match(this.Cari_Supplier);
            });
        },
        nameErrors(){
            const errors = []
            if (!this.$v.Supplier.Nama_Supplier.$dirty) return errors
            !this.$v.Supplier.Nama_Supplier.minLength && errors.push('Name must be at least 5 characters long')
            !this.$v.Supplier.Nama_Supplier.maxLength && errors.push('Name must be at most 25 characters long')
            !this.$v.Supplier.Nama_Supplier.required && errors.push('Name is required.')
            return errors
        },
        addressErrors(){
            const errors = []
            if (!this.$v.Supplier.Alamat_Supplier.$dirty) return errors
            !this.$v.Supplier.Alamat_Supplier.minLength && errors.push('Address must be at least 5 characters long')
            !this.$v.Supplier.Alamat_Supplier.maxLength && errors.push('Address must be at most 255 characters long')
            !this.$v.Supplier.Alamat_Supplier.required && errors.push('Address is required.')
            return errors
        },
        phoneErrors(){
            const errors = []
            if (!this.$v.Supplier.Telepon_Supplier.$dirty) return errors
            !this.$v.Supplier.Telepon_Supplier.minLength && errors.push('Phone Number must be at least 10 characters long')
            !this.$v.Supplier.Telepon_Supplier.maxLength && errors.push('Phone Number must be at most 15 characters long')
            !this.$v.Supplier.Telepon_Supplier.required && errors.push('Phone Number is required.')
            !this.$v.Supplier.Telepon_Supplier.numeric && errors.push('Phone Number must be numeric.')
            return errors
        },
        salesNameErrors(){
            const errors = []
            if (!this.$v.Supplier.Nama_Sales.$dirty) return errors
            !this.$v.Supplier.Nama_Sales.minLength && errors.push('Name must be at least 5 characters long')
            !this.$v.Supplier.Nama_Sales.maxLength && errors.push('Name must be at most 25 characters long')
            !this.$v.Supplier.Nama_Sales.required && errors.push('Name is required.')
            return errors
        },
        salesPhoneErrors(){
            const errors = []
            if (!this.$v.Supplier.Telepon_Sales.$dirty) return errors
            !this.$v.Supplier.Telepon_Sales.minLength && errors.push('Phone Number must be at least 10 characters long')
            !this.$v.Supplier.Telepon_Sales.maxLength && errors.push('Phone Number must be at most 15 characters long')
            !this.$v.Supplier.Telepon_Sales.required && errors.push('Phone Number is required.')
            !this.$v.Supplier.Telepon_Sales.numeric && errors.push('Phone Number must be numeric.')
            return errors
        },

    }
}
</script>

