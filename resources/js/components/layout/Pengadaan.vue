<template>
    <body>
        <div class="container-fluid mt-3">
            <div class="row mb-2">
                <div class="col-lg-2">
                    <div class="col-lg-7 p-0">
                        <button class="btn btn-success mb-2 btn-block" @click="getallpengadaan(),refresh()" 
                        data-title="Tambah_Pengadaan" data-toggle="modal" data-target="#Tambah_Pengadaan">
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
                        <input class="form-control" v-model="Cari_Pengadaan" type="search" 
                        placeholder="Cari Transaksi Pengadaan">
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
                            <th scope="col">Detail</th>
                            <th scope="col">Print</th>
                            <th scope="col">Edit/Verify</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-bind:key="pengadaan['id']" v-for="pengadaan in filteredpengadaan">
                            <td>{{pengadaan.Nama_Supplier }} </td>
                            <td>{{pengadaan.Nama_Sales}} </td>
                            <td>{{pengadaan.Tanggal_Pengadaan}} </td>
                            <td>{{pengadaan.Total_Harga}}</td>
                            <td v-if="pengadaan.Status_Pengadaan==0">
                                Ordered
                            </td>
                            <td v-if="pengadaan.Status_Pengadaan==1">
                                Printed
                            </td>
                            <td v-if="pengadaan.Status_Pengadaan==2">
                                Finished
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <button class="btn btn-primary" @click="detailhandler(pengadaan)" 
                                    data-title="Detail_Pengadaan" data-toggle="modal" data-target="#Detail_Pengadaan">
                                        <i class="fas fa-list-ul"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Print">
                                    <button class="btn btn-success" data-title="Cetak_Nota" @click="cetaksuratpemesanan(pengadaan.Id_Pengadaan)" 
                                    :disabled="pengadaan.Status_Pengadaan !== 0">
                                        <i class="fas fa-file-pdf"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center" v-if="pengadaan.Status_Pengadaan == 0">
                                <p data-placement="top" data-toggle="tooltip" title="Verify_Pengadaan">
                                    <button class="btn btn-primary" @click="datapengadaanhandler(pengadaan)" 
                                    data-title="Verify_Pengadaan" data-dismiss="modal" data-toggle="modal" data-target="#Edit_Pengadaan">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center" v-if="pengadaan.Status_Pengadaan == 1">
                                <p data-placement="top" data-toggle="tooltip" title="Verify_Pengadaan">
                                    <button class="btn btn-primary" @click="datapengadaanhandler(pengadaan)" 
                                    data-title="Verify_Pengadaan" data-dismiss="modal" data-toggle="modal" data-target="#Verify_Pengadaan">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center" v-if="pengadaan.Status_Pengadaan == 2">
                                <p data-placement="top" data-toggle="tooltip" title="Verify_Pengadaan">
                                    <button class="btn btn-success" @click="datapengadaanhandler(pengadaan),refresh()" disabled
                                    data-title="Verify_Pengadaan" data-dismiss="modal" data-toggle="modal" data-target="#Verify_Pengadaan">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete" >
                                    <button @click="datapengadaanhandler(pengadaan)" class="btn btn-danger" :disabled="pengadaan.Status_Pengadaan !== 0" 
                                    data-title="Delete_Pengadaan" data-toggle="modal" data-target="#Delete_Pengadaan">
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
        <!-- TAMBAH TRANSAKSI PENGADAAN -->
        <div class="modal fade" id="Tambah_Pengadaan" tabindex="-1" role="dialog" aria-labelledby="Tambah_Pengadaan" 
        aria-hidden="true">
            <div class="modal-dialog" style="max-width:600px;">
                <div class="modal-content" style="width:600px;">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Tambah Pengadaan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" 
                        style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Supplier</span>
                            </div>
                            <select class="form-control" v-model="Pengadaan.Id_Supplier" 
                            @input="$v.Pengadaan.Id_Supplier.$touch()" @blur="$v.Pengadaan.Id_Supplier.$touch()" required>
                                <option disabled="disabled" selected="selected" value="Pilih Supplier">
                                    -- Pilih Supplier / Sales --
                                </option>
                                <option v-bind:key="supplier['Id_Supplier']" v-for="supplier in supplierdata"
                                :value="supplier.Id_Supplier">
                                    <p v-if="supplier.Nama_Sales!=null">
                                        {{supplier.Nama_Supplier}} - {{supplier.Nama_Sales}} 
                                    </p>
                                </option>
                            </select>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" v-if="$v.Pengadaan.Id_Supplier.$invalid">{{supplierErrors[0]}}</p>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Tanggal</span>
                            </div>
                            <input type="date" v-model="Pengadaan.Tanggal_Pengadaan" class="form-control" 
                            aria-label="Tanggal_Pengadaan"  aria-describedby="basic-addon2" id="Tanggal_Pengadaan" name="Tanggal_Pengadaan" 
                            @input="$v.Pengadaan.Tanggal_Pengadaan.$touch()" @blur="$v.Pengadaan.Tanggal_Pengadaan.$touch()" required>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" v-if="$v.Pengadaan.Tanggal_Pengadaan.$invalid">{{dateErrors[0]}}</p>
                        </div>
                        <div class="row mt-0">
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <div class="input-group-prepend d-block" style="width: 100px;">
                                        <span class="input-group-text" id="basic-addon2">Sparepart</span>
                                    </div>  
                                    <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                        <option disabled="disabled" selected="selected" 
                                        value="Pilih ">-- Pilih Sparepart --</option>
                                        <option v-bind:key="spareparts['Kode_Sparepart']" 
                                        v-on:change="getSelectedIndex"
                                        v-for="spareparts in sparepart" 
                                        :value="spareparts.Kode_Sparepart">{{spareparts.Nama_Sparepart}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <div class="input-group-prepend d-block" style="width: 100px;">
                                        <span class="input-group-text" id="basic-addon2">Jumlah</span>
                                    </div>
                                    <input type="number" v-model="Sparepart.Jumlah_Sparepart" class="form-control" 
                                    aria-label="Jumlah_Sparepart"  aria-describedby="basic-addon2" id="Jumlah_Sparepart" name="Jumlah_Sparepart" 
                                    required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-success btn" @click="sparepartHandler(sparepart)">Add Sparepart</button>
                            </div>
                        </div>

                        <div class="input-group mt-3 w-400">
                            <div class="row">
                                <div class="col-12 mr-2">
                                    <div class="list-group mr-2" v-for="spareparts in sparepartdata" :key="spareparts['Kode_Sparepart']">
                                        <a href="#" class="list-group-item list-group-item-action list-group-item-success">
                                            {{spareparts.Kode_Sparepart + '-' + spareparts.Nama_Sparepart}}          
                                            <button type="submit" class="btn btn-danger" style="margin-left: 200px"
                                            @click="deleteList(spareparts.Kode_Sparepart)">Delete</button>
                                            <br>     
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="submit" class="btn btn-success btn-lg w-100" :disabled="$v.Pengadaan.$invalid" data-dismiss="modal" @click="addpengadaan()">Tambahkan Transaksi Pengadaan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF TAMBAH TRANSAKSI PENGADAAN -->
        <!-- DELETE TRANSAKSI PENGADAAN -->
        <div class="modal fade" id="Delete_Pengadaan" tabindex="-1" role="dialog" aria-labelledby="Delete_Pengadaan" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Hapus Data Transaksi Pengadaan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda Yakin Ingin Menghapus Data Transaksi Pengadaan Ini ?</div>
                    </div>
                    <div class="modal-footer ">
                        <a id="delete_btn" class="float-left w-100">
                            <button type="button" @click="deletepengadaan(Pengadaan.Id_Pengadaan)" class="btn btn-danger float-left w-50" data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span>Ya</button>
                        </a>
                        <button type="button" class="btn btn-secondary float-right w-50" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Tidak</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF DELETE DELETE TRANSAKSI PENGADAAN -->
         <!-- EDIT DETAIL TRANSAKSI PENGADAAN -->
        <div class="modal fade" id="Update_Detail_Pengadaan" tabindex="-1" role="dialog" aria-labelledby="Update_Detail_Pengadaan" 
        aria-hidden="true">
            <div class="modal-dialog" style="max-width:600px;">
                <div class="modal-content" style="width:600px;">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Update Detail Pengadaan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" 
                        style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-0">
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <div class="input-group-prepend d-block" style="width: 100px;">
                                        <span class="input-group-text" id="basic-addon2">Sparepart</span>
                                    </div>  
                                    <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                        <option disabled="disabled" selected="selected" 
                                        value="Pilih ">-- Pilih Sparepart --</option>
                                        <option v-bind:key="spareparts['Kode_Sparepart']" 
                                        v-on:change="getSelectedIndex"
                                        v-for="spareparts in sparepart" 
                                        :value="spareparts.Kode_Sparepart">{{spareparts.Nama_Sparepart}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <div class="input-group-prepend d-block" style="width: 100px;">
                                        <span class="input-group-text" id="basic-addon2">Jumlah</span>
                                    </div>
                                    <input type="number" v-model="Sparepart.Jumlah_Sparepart" class="form-control" 
                                    aria-label="Jumlah_Sparepart"  aria-describedby="basic-addon2" id="Jumlah_Sparepart" name="Jumlah_Sparepart" 
                                    required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-success btn" @click="sparepartHandler(sparepart)">Add Sparepart</button>
                            </div>
                        </div>

                        <div class="input-group mt-3 w-400">
                            <div class="row">
                                <div class="col-12 mr-2">
                                    <div class="list-group mr-2" v-for="spareparts in sparepartdata" :key="spareparts['Kode_Sparepart']">
                                        <a href="#" class="list-group-item list-group-item-action list-group-item-success">
                                            {{spareparts.Kode_Sparepart + '-' + spareparts.Nama_Sparepart}}          
                                            <button type="submit" class="btn btn-danger" style="margin-left: 200px"
                                            @click="deleteList(spareparts.Kode_Sparepart)">Delete</button>
                                            <br>     
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="submit" class="btn btn-success btn-lg w-100" :disabled="$v.Pengadaan.$invalid" data-dismiss="modal" @click="addpengadaan()">Tambahkan Transaksi Pengadaan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- EDIT DETAIL PENGADAAN -->
        <!-- TAMPIL DETAIL PENGADAAN -->
        <div class="modal fade" id="Detail_Pengadaan" tabindex="-1" role="dialog" aria-labelledby="Detail_Pengadaan" 
        aria-hidden="true">
            <div class="modal-dialog" style="max-width:750px;">
                <div class="modal-content" style="width:750px;">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Detail Pengadaan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" 
                        style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th scope="col">Kode Sparepart</th>
                                        <th scope="col">Nama Sparepart</th>
                                        <th scope="col">Harga Satuan</th>
                                        <th scope="col">Jumlah Sparepart</th>
                                        <th scope="col">Subtotal Pengadaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-bind:key="detail['id']" v-for="detail in filtereddetail">
                                        <td>{{detail.Kode_Sparepart }} </td>
                                        <td>{{detail.Nama_Sparepart}} </td>
                                        <td>{{detail.Harga_Satuan}} </td>
                                        <td>{{detail.Jumlah}}</td>
                                        <td>{{detail.Subtotal_Pengadaan}} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">

                            </div>
                            
                            <div class="col-sm-4">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF TAMPIL DETAIL PENGADAAN -->
        <!-- EDIT TRANSAKSI PENGADAAN -->
        <div class="modal fade" id="Edit_Pengadaan" tabindex="-1" role="dialog" aria-labelledby="Edit_Pengadaan" 
        aria-hidden="true">
            <div class="modal-dialog" style="max-width:600px;">
                <div class="modal-content" style="width:600px;">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Edit Pengadaan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" 
                        style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Supplier</span>
                            </div>
                            <select class="form-control" v-model="Pengadaan.Id_Supplier" 
                            @input="$v.Pengadaan.Id_Supplier.$touch()" @blur="$v.Pengadaan.Id_Supplier.$touch()" required>
                                <option disabled="disabled" selected="selected" value="Pilih Supplier">
                                    -- Pilih Supplier / Sales --
                                </option>
                                <option v-bind:key="supplier['Id_Supplier']" v-for="supplier in supplierdata"
                                :value="supplier.Id_Supplier">
                                    <p v-if="supplier.Nama_Sales!=null">
                                        {{supplier.Nama_Supplier}} - {{supplier.Nama_Sales}} 
                                    </p>
                                </option>
                            </select>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" v-if="$v.Pengadaan.Id_Supplier.$invalid">{{supplierErrors[0]}}</p>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Tanggal</span>
                            </div>
                            <input type="date" v-model="Pengadaan.Tanggal_Pengadaan" class="form-control" 
                            aria-label="Tanggal_Pengadaan"  aria-describedby="basic-addon2" id="Tanggal_Pengadaan" name="Tanggal_Pengadaan" 
                            @input="$v.Pengadaan.Tanggal_Pengadaan.$touch()" @blur="$v.Pengadaan.Tanggal_Pengadaan.$touch()" required>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" v-if="$v.Pengadaan.Tanggal_Pengadaan.$invalid">{{dateErrors[0]}}</p>
                        </div>
                        <div class="row mt-0">
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <div class="input-group-prepend d-block" style="width: 100px;">
                                        <span class="input-group-text" id="basic-addon2">Sparepart</span>
                                    </div>  
                                    <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                        <option disabled="disabled" selected="selected" 
                                        value="Pilih ">-- Pilih Sparepart --</option>
                                        <option v-bind:key="spareparts['Kode_Sparepart']" 
                                        v-on:change="getSelectedIndex"
                                        v-for="spareparts in sparepart" 
                                        :value="spareparts.Kode_Sparepart">{{spareparts.Nama_Sparepart}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <div class="input-group-prepend d-block" style="width: 100px;">
                                        <span class="input-group-text" id="basic-addon2">Jumlah</span>
                                    </div>
                                    <input type="number" v-model="Sparepart.Jumlah_Sparepart" class="form-control" 
                                    aria-label="Jumlah_Sparepart"  aria-describedby="basic-addon2" id="Jumlah_Sparepart" name="Jumlah_Sparepart" 
                                    required>
                                    <!-- <div class="list-group mr-2" v-for="spareparts in sparepartdata" :key="spareparts['Kode_Sparepart']"> 
                                        <a href="#" class="list-group-item list-group-item-action list-group-item-success">
                                            {{spareparts.Jumlah + '-' + spareparts.Nama_Sparepart}}          
                                            <button type="submit" class="btn btn-danger" style="margin-left: 200px"
                                            @click="deleteList(spareparts.Kode_Sparepart)">Delete</button>
                                            <br>     
                                        </a> -->
                                        <!-- <select class="form-control mr-2" v-model="spareparts.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                        <option disabled="disabled" selected="selected" 
                                        value="Pilih ">-- Pilih Sparepart --</option>
                                        <option v-bind:key="spareparts['Kode_Sparepart']" 
                                        v-on:change="getSelectedIndex"
                                        v-for="spareparts in sparepartdata" 
                                        :value="spareparts.Kode_Sparepart">{{spareparts.Kode_Sparepart}}</option>
                                    </select> -->

                                    
                                    <!-- </div> -->

                                </div>
                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-success btn" @click="sparepartHandler(sparepart)">Add Sparepart</button>
                            </div>
                        </div>

                        <div class="input-group mt-3 w-400">
                            <div class="row">
                                <div class="col-12 mr-2">
                                    <div class="list-group mr-2" v-for="spareparts in sparepartdata" :key="spareparts['Kode_Sparepart']">
                                        <a href="#" class="list-group-item list-group-item-action list-group-item-success">
                                            {{spareparts.Kode_Sparepart + '-' + spareparts.Nama_Sparepart}}          
                                            <button type="submit" class="btn btn-danger" style="margin-left: 200px"
                                            @click="deleteList(spareparts.Kode_Sparepart)">Delete</button>
                                            <br>     
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="submit" class="btn btn-primary btn-lg w-100" :disabled="$v.Pengadaan.$invalid" data-dismiss="modal" @click="updatepengadaan(Pengadaan.Id_Pengadaan)">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF EDIT TRANSAKSI PENGADAAN -->
        <!-- TAMPIL DETAIL PENGADAAN -->
        <div class="modal fade" id="Verify_Pengadaan" tabindex="-1" role="dialog" aria-labelledby="Verify_Pengadaan" 
        aria-hidden="true">
            <div class="modal-dialog" style="max-width:750px;">
                <div class="modal-content" style="width:750px;">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Verify Pengadaan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" 
                        style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="container-fluid mt-3">
                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <button class="btn btn-warning mb-2 btn-block" @click="verifikasipengadaan(Pengadaan.Id_Pengadaan),getallpengadaan()" 
                                data-title="Tambah_Pengadaan" data-toggle="modal" data-target="" data-dismiss="modal">
                                    <i class="fas fa-plus mr-2"></i>Verifikasi
                                </button>
                            </div>
                        </div>

                        <!-- <div class="row mb-2">
                            <div class="col-lg-3">
                                <button class="btn btn-success mb-2 btn-block" @click="verifikasipengadaan(Pengadaan.Id_Pengadaan),getallpengadaan()" 
                                data-title="Update_Detail_Pengadaan" data-toggle="modal" data-target="" data-dismiss="modal">
                                    <i class="fas fa-plus mr-2"></i>Update
                                </button>
                            </div>
                        </div> -->

                     </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th scope="col">Kode Sparepart</th>
                                        <th scope="col">Nama Sparepart</th>
                                        <th scope="col">Harga Satuan</th>
                                        <th scope="col">Jumlah Sparepart</th>
                                        <th scope="col">Subtotal Pengadaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-bind:key="detail['id']" v-for="detail in filtereddetail">
                                        <td>{{detail.Kode_Sparepart }} </td>
                                        <td>{{detail.Nama_Sparepart}} </td>
                                        <td>{{detail.Harga_Satuan}} </td>
                                        <td>{{detail.Jumlah}}</td>
                                        <td>{{detail.Subtotal_Pengadaan}} </td>
                                        <td class="text-center">
                                            <p data-placement="top" data-toggle="tooltip" title="Edit">
                                                <button class="btn btn-primary" @click="detailhandler(pengadaan)" 
                                                data-title="Update_Detail_Pengadaan" data-toggle="modal" data-target="#Update_Detail_Pengadaan">
                                                    <i class="fas fa-edit-ul"></i>
                                                </button>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">

                            </div>
                            
                            <div class="col-sm-4">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF TAMPIL DETAIL PENGADAAN -->
        <!-- END OF MY MODALS -->
    </body>
</template>
<script>
import Http from '../../service/Http'
import Controller from '../../service/Pengadaan'
import validators from '../../validations/pengadaan_validations'
export default {
    validations: validators,
    data:()=>({
        pengadaandata:[],
        supplierdata:[],
        sparepart:[],
        sparepartdata:[],
        sparepartData:[],
        detailpengadaandata:[],
        Id_Supplier:'',
        Tanggal_Pengadaan:'',
        Total_Harga:0,
        Status_Pengadaan:0,
        index:'',
        err: '',
        Id_Detail_Modal:0,
        Pengadaan:{
            Id_Supplier:'Pilih Supplier',
            Tanggal_Pengadaan:'',
            Total_Harga:0,
            Status_Pengadaan:0,
        },
        Cari_Pengadaan:'',
        Sparepart:{
            Kode_Sparepart:'',
            Tipe_Barang:'',
            Nama_Sparepart:'',
            Merk_Sparepart:'',
            Rak_Sparepart: '',
            Jumlah_Sparepart:0,
            Stok_Minimum_Sparepart:0,
            Harga_Beli:0,
            Harga_Jual:0,
            Gambar:'',
        },
        temp:{
            Kode_Sparepart:'',
            Nama_Sparepart:'',
            Harga_Satuan:0,
            Jumlah:0,
            Subtotal_Pengadaan:0,
        }
    }),
    mounted(){
        this.getallpengadaan(),
        this.getallsupplier(),
        this.getallsparepart(),
        this.getalldetailpengadaan()
    },
    methods:{
        getSelectedIndex(){
            this.index = this.sparepart.map(function(e) { return e.Kode_Sparepart; }).indexOf(this.Sparepart.Kode_Sparepart)
            console.log(this.index)
        },
        sparepartHandler(sparepart){
            var object = sparepart[this.index]
            // console.log(object);
            this.temp.Kode_Sparepart    = this.Sparepart.Kode_Sparepart;
            let data = this.sparepart.find(obj=>obj.Kode_Sparepart == this.Sparepart.Kode_Sparepart)
            // console.log(data)
            this.temp.Nama_Sparepart    = data.Nama_Sparepart
            this.temp.Harga_Satuan      = data.Harga_Beli;
            this.temp.Jumlah            = this.Sparepart.Jumlah_Sparepart;
            this.temp.Subtotal_Pengadaan= data.Harga_Beli * this.Sparepart.Jumlah_Sparepart;
            this.Pengadaan.Total_Harga  = parseInt(this.temp.Subtotal_Pengadaan + this.Pengadaan.Total_Harga ,10);
            this.sparepartdata.push(JSON.parse(JSON.stringify(this.temp)))
            this.sparepartData.push(this.Sparepart.Kode_Sparepart)
        },
        deleteList(id)
        {
            let filter = this.sparepartdata.filter(function( obj ) {
                return obj.Kode_Sparepart !== id;
            });
            this.sparepartdata=filter
            let filter2 = this.sparepartData.filter(function( obj ) {
                return obj !== id;
            });
            this.sparepartData=filter2
        },
        async getallpengadaan () {
            try {
                this.pengadaandata = (await Controller.getallpengadaan()).data
                console.log(this.pengadaandata)
            } catch (err) {
                console.log(err)
            }
        },
        async getallsupplier () {
            try {
                this.supplierdata = (await Controller.getallsupplier()).data
                console.log(this.supplierdata)
            } catch (err) {
                console.log(err)
            }
        },
        async getallsparepart () {
            try {
                this.sparepart = (await Controller.getallsparepart()).data
                console.log(this.sparepart)
            } catch (err) {
                console.log(err)
            }
        },
        async getalldetailpengadaan () {
            try {
                this.detailpengadaandata = (await Controller.getalldetailpengadaan()).data
                console.log(this.detailpengadaandata)
            } catch (err) {
                console.log(err)
            }
        },
        async addpengadaan () {
            try {
                const payload = {
                    Id_Supplier         : this.Pengadaan.Id_Supplier,
                    Tanggal_Pengadaan   : this.Pengadaan.Tanggal_Pengadaan,
                    Total_Harga         : this.Pengadaan.Total_Harga,
                    Status_Pengadaan    : '0',
                    Detail_Pengadaan    : this.sparepartdata,
                }
                console.log(payload);
                await Controller.addpengadaan(payload)
                this.getallpengadaan()
                this.getalldetailpengadaan()
            } catch (err) {
                console.log(err)
            }
        },
        async updatepengadaan (id) {
            try {
                const payload = {
                    Id_Supplier         : this.Pengadaan.Id_Supplier,
                    Tanggal_Pengadaan   : this.Pengadaan.Tanggal_Pengadaan,
                    Total_Harga         : this.Pengadaan.Total_Harga,
                    Status_Pengadaan    : '0',
                    Detail_Pengadaan    : this.sparepartdata,
                }
                await Controller.updatepengadaan(payload,id)
                this.getallpengadaan()
                this.getalldetailpengadaan()
            } catch (err) {
                console.log(err)
            }
        },
        async verifikasipengadaan(id) {
            try {
                await Controller.verifikasipengadaan(id)
                this.getallpengadaan()
            } catch (err) {
                console.log(err)
            }
        },
        async cetaksuratpemesanan(id){
            try {
                await Http.download('/api/cetak_surat_pemesanan/'+id);
                // await Controller.cetaksuratpemesanan(id)
                this.getallpengadaan()
                console.log(this.supplierdata)
            } catch (err) {
                console.log(err)
            }
        },
        // async updatepengadaan () {

        // },
        async deletepengadaan(id) {
            try {
                await Controller.deletepengadaan(id)
                this.getallpengadaan()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        datapengadaanhandler(pengadaan){
            this.Pengadaan = pengadaan;
            this.sparepartdata = pengadaan.detail_pengadaan.data;
            this.Id_Detail_Modal = pengadaan.Id_Pengadaan
            console.log(this.Pengadaan);
        },
        refresh(){
            this.Pengadaan.Id_Supplier      ='Pilih Supplier';
            this.Pengadaan.Tanggal_Pengadaan='';
            this.Pengadaan.Total_Harga      ='';
            this.Pengadaan.Status_Pengadaan ='0';
        },
        detailhandler(pengadaan){
            this.Id_Detail_Modal = pengadaan.Id_Pengadaan
            this.Pengadaan = pengadaan;
            this.sparepartdata = pengadaan.detail_pengadaan.data;
            console.log(this.Pengadaan);
        }
    },
    computed:{
        filteredpengadaan:function(){
            return this.pengadaandata.filter((pengadaan)=>{
                return pengadaan.Nama_Supplier.toLowerCase().match(this.Cari_Pengadaan.toLowerCase());
            });
        },
        supplierErrors(){
            const errors = []
            if(!this.$v.Pengadaan.Id_Supplier.$dirty) return errors
            !this.$v.Pengadaan.Id_Supplier.required && errors.push('Supplier is required')
            return errors
        },
        dateErrors(){
            const errors = []
            if(!this.$v.Pengadaan.Tanggal_Pengadaan.$dirty) return errors
            !this.$v.Pengadaan.Tanggal_Pengadaan.required && errors.push('Transaction date is required')
            return errors
        },
        filtereddetail:function(){
            return this.detailpengadaandata.filter((detailpengadaan)=>{
                return detailpengadaan.Id_Pengadaan == this.Id_Detail_Modal;
            });
        }
    }
}
</script>