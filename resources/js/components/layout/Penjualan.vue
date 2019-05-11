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

    <div class="container-fluid mt-3">
            <div class="row mb-2">
                <div class="col-sm-2">
                    <div class="col-sm-7 p-0">
                        <button class="btn btn-success mb-2 btn-block" @click="getallpenjualan(),refresh()" 
                        data-title="Tambah_Transaksi" data-toggle="modal" data-target="#Tambah_Transaksi">
                            <i class="fas fa-plus mr-2"></i>Tambah
                        </button>
                    </div>
                    <div class="col-sm-5">

                    </div>
                </div>
                <div class="col-sm-7">

                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input class="form-control" v-model="Cari_Transaksi" type="search" placeholder="Cari Transaksi">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
                
            
            <div class="table-responsive" style="margin: auto;">
                <table class="table table-striped table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">ID Transaksi</th>
                            <th scope="col">ID Konsumen</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jenis Transaksi</th>
                            <th scope="col">Status Transaksi</th>
                            <th scope="col">Total</th>
                            <th scope="col">Detail</th>
                            <th scope="col">SPK</th>
                            <th scope="col">Edit/Verify</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-bind:key="transaksi['Id_Transaksi']" v-for="transaksi in filteredtransaksi">
                            <td>{{transaksi.Id_Transaksi}}</td>
                            <td>{{transaksi.Id_Konsumen}} </td>
                            <td>{{transaksi.Tanggal_Transaksi}} </td>
                            <td>{{transaksi.Jenis_Transaksi}} </td>
                            <td v-if="transaksi.Status==0">
                                Belum Diproses
                            </td>
                            <td v-if="transaksi.Status==1">
                                Sedang Diproses
                            </td>
                            <td v-if="transaksi.Status==2">
                                Selesai
                            </td>
                            <td>{{transaksi.Total}} </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Detail">
                                    <button @click="detailhandler(transaksi)"  
                                    class="btn btn-primary" data-title="Detail_Penjualan"
                                    data-toggle="modal" data-target="#Detail_Penjualan">
                                        <i class="fas fa-list-ul"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Tambah">
                                    <button @click="datakonsumenhandler(konsumen)" 
                                    class="btn btn-success" data-title="Tambah_Motor_Konsumen"
                                    data-toggle="modal" data-target="#Tambah_Motor_Konsumen">
                                        <i class="far fa-file-pdf"></i>
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
                                    <button @click="datatransaksihandler(transaksi)" 
                                        class="btn btn-danger"  data-title="Delete_Penjualan" 
                                        data-toggle="modal" data-target="#Delete_Penjualan">
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
        <!-- TAMBAH TRANSAKSI PENJUALAN -->
        <div class="modal fade" id="Tambah_Transaksi" tabindex="-1" role="dialog" 
            aria-labelledby="Tambah_Transaksi" aria-hidden="true">
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
                            <select class="form-control mr-2" v-model="Konsumen.Id_Konsumen" v-on:change="getKonsumen()">
                                <option disabled="disabled" selected="selected" 
                                value="Pilih Merk">-- Nama Konsumen --</option>
                                <option v-bind:key="konsumen['Id_Konsumen']" 
                                v-for="konsumen in konsumendata" 
                                v-on:change="getKonsumen()"
                                :value="konsumen.Id_Konsumen">{{konsumen.Nama_Konsumen}}</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" 
                                v-if="$v.Konsumen.Nama_Konsumen.$invalid">{{nameErrors[0]}}</p>
                        </div>

                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Alamat</span>
                            </div>
                            <input type="text" v-model="konsumen.Alamat_Konsumen" 
                            class="form-control" 
                            aria-label="Alamat_Konsumen" aria-describedby="basic-addon2" 
                            id="Alamat_Konsumen" name="Alamat_Konsumen" disabled>
                        </div>

                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Telepon</span>
                            </div>
                            <input type="text" v-model="konsumen.Telepon_Konsumen" 
                            class="form-control" 
                            aria-label="Telepon_Konsumen" aria-describedby="basic-addon2" 
                            id="Telepon_Konsumen" name="Telepon_Konsumen" disabled>
                        </div>

                        <div class="text-center">
                            <p class="mb-3" style="color:red;" 
                                v-if="$v.Konsumen.Nama_Konsumen.$invalid">{{nameErrors[0]}}</p>
                        </div>

                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Tanggal</span>
                            </div>
                            <input type="date" v-model="Transaksi.Tanggal_Transaksi" 
                                class="form-control"  
                                aria-label="Transaksi_Tanggal" aria-describedby="basic-addon2" 
                                id="Transaksi_Tanggal" name="Transaksi_Tanggal" required>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" 
                                v-if="$v.Konsumen.Telepon_Konsumen.$invalid">{{phoneErrors[0]}}</p>
                        </div>

                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Jasa Montir</span>
                            </div>
                                
                            <select class="form-control mr-2" v-model="Id_Jasa_Montir">
                                <option disabled="disabled" selected="selected" 
                                value="Pilih Merk">-- Pilih Jasa Montir --</option>
                                <option v-bind:key="pegawai['Id_Pegawai']" 
                                v-for="pegawai in filteredpegawai" 
                                :value="pegawai.Id_Pegawai">{{pegawai.Id_Pegawai}} - {{pegawai.Nama_Pegawai}}</option>
                            </select>
                        </div>

                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Motor</span>
                            </div>
                                
                            <select class="form-control mr-2" v-model="Motor.Id_Motor" v-on:change="getSelectedIndex">
                                <option disabled="disabled" selected="selected" 
                                value="Pilih Merk">-- Pilih Merk Motor --</option>
                                <option v-bind:key="motor['Id_Motor']" 
                                v-for="motor in filteredmotorkonsumen" 
                                v-on:change="getSelectedIndex"
                                :value="motor.Id_Motor">{{motor.Plat_Kendaraan}}
                                -- {{motor.Tipe}} -- -- {{motor.Merk}}</option>
                            </select>
                        </div>
                            
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Jenis</span>
                            </div>
                            <select class="form-control mr-2" v-model="jenis">
                                <option disabled="disabled" selected="selected" value="Pilih Posisi">Pilih Jenis Transaksi</option>
                                <option v-for="(jenis,index) in Jenis" :key="index" >{{jenis.value}}</option>
                            </select>
                        </div>

                        <div class="input-group mt-3" v-if="jenis == 'SP' || jenis=='SS'"> 
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Sparepart</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Pilih Sparepart --</option>
                                <option v-bind:key="spareparts['Kode_Sparepart']" 
                                v-on:change="getSelectedIndex"
                                v-for="spareparts in sparepart" 
                                :value="spareparts.Kode_Sparepart" >{{spareparts.Nama_Sparepart}}</option>
                            </select>

                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Tipe</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Tipe Sparepart --</option>
                                <option v-bind:key="spareparts['Kode_Sparepart']" 
                                v-on:change="getSelectedIndex"
                                v-for="spareparts in sparepart" 
                                :value="spareparts.Kode_Sparepart" disabled>{{spareparts.Tipe_Barang}}</option>
                            </select>
                        </div>

                        <div class="input-group mt-3" v-if="jenis == 'SP' || jenis=='SS'"> 
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Jumlah</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Jumlah Sparepart --</option>
                                <option v-bind:key="spareparts['Kode_Sparepart']" 
                                v-on:change="getSelectedIndex"
                                v-for="spareparts in sparepart" 
                                :value="spareparts.Kode_Sparepart" disabled>{{spareparts.Jumlah_Sparepart}}</option>
                            </select>

                            <div class="input-group-prepend d-block" style="width: 100px;" v-if="jenis == 'SP' || jenis=='SS'">
                                <span class="input-group-text" id="basic-addon2" disabled>Harga Jual</span>
                            </div> 
                            <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Harga Jual --</option>
                                <option v-bind:key="spareparts['Kode_Sparepart']" 
                                v-on:change="getSelectedIndex"
                                v-for="spareparts in sparepart" 
                                :value="spareparts.Kode_Sparepart" disabled>{{spareparts.Harga_Jual}}</option>
                            </select>
                        </div>
                        <div class="input-group mt-3" v-if="jenis == 'SP' || jenis=='SS'">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Jumlah</span>
                            </div>
                            <input type="number" v-model="jumlah" 
                            class="form-control" placeholder="Masukkan Jumlah Sparepart Yang Ingin Dibeli" 
                            aria-label="jumlah" aria-describedby="basic-addon2" 
                            id="jumlah" name="jumlah" required>
                        </div>

                        <div class="col-lg-6 mt-3" v-if="jenis == 'SP' || jenis=='SS'">
                            <button type="submit" class="btn btn-success btn" @click="sparepartHandler(sparepart)">Add Sparepart</button>
                        </div>

                        <div class="input-group mt-3 w-400" v-if="jenis=='SP' || jenis=='SS'">
                            <div class="row">
                                <div class="col-12 mr-2">
                                    <div class="list-group mr-2" v-for="spareparts in sparepartdata" :key="spareparts['Kode_Sparepart']">
                                        <a href="#" class="list-group-item list-group-item-action list-group-item-success">
                                            {{spareparts.Kode_Sparepart + '-' + spareparts.Nama_Sparepart}}          
                                            <button type="submit" class="btn btn-danger" style="margin-left: 200px"
                                            @click="deleteListSparepart(spareparts.Kode_Sparepart)">Delete</button>
                                            <br>     
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mt-3" v-if="jenis == 'SP' || jenis=='SS'">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Subtotal</span>
                            </div>
                            <input type="text" v-model="Transaksi.Subtotal" 
                            class="form-control" placeholder="Subtotal" 
                            aria-label="Transaksi_Subtotal" aria-describedby="basic-addon2" 
                            id="Transaksi_Subtotal" name="Transaksi_Subtotal" disabled required> 
                        </div>

                        <div class="input-group mt-3" v-if="jenis == 'SV' || jenis=='SS'"> 
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Jasa</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Jasaservice.Id_Jasa" v-on:change="getSelectedIndexJasa" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Pilih Jasa --</option>
                                <option v-bind:key="jasaS['Id_Jasa']" 
                                v-on:change="getSelectedIndexJasa"
                                v-for="jasaS in jasa" 
                                :value="jasaS.Id_Jasa" >{{jasaS.Nama_Jasa}}</option>
                            </select>

                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Harga</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Jasaservice.Id_Jasa" v-on:change="getSelectedIndexJasa" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Pilih Jasa --</option>
                                <option v-bind:key="jasaS['Id_Jasa']" 
                                v-on:change="getSelectedIndexJasa"
                                v-for="jasaS in jasa" 
                                :value="jasaS.Id_Jasa" >{{jasaS.Harga_Jasa}}</option>
                            </select>

                            <button type="submit" class="btn btn-success btn" @click="jasaHandler(jasa)">Add Jasa</button>

                        </div>

                        <div class="col-lg-6 mt-3" v-if="jenis == 'SV' || jenis=='SS'">
                        </div>

                        <div class="input-group mt-3 w-400" v-if="jenis=='SV' || jenis=='SS'">
                            <div class="row">
                                <div class="col-12 mr-2">
                                    <div class="list-group mr-2" v-for="jasaS in jasadata" :key="jasaS['Id_Jasa']">
                                        <a href="#" class="list-group-item list-group-item-action list-group-item-success">
                                            {{jasaS.Nama_Jasa + '-' + jasaS.Harga_Jasa}}          
                                            <button type="submit" class="btn btn-danger" style="margin-left: 200px"
                                            @click="deleteListJasa(jasaS.Id_Jasa)">Delete</button>
                                            <br>     
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group mt-3" v-if="jenis == 'SV' || jenis=='SS'" >
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Subtotal</span> 
                            </div>
                            <input type="text" v-model="Transaksi.Subtotal" 
                            class="form-control" placeholder="Subtotal" 
                            aria-label="Transaksi_Subtotal" aria-describedby="basic-addon2" 
                            id="Transaksi_Subtotal" name="Transaksi_Subtotal" disabled required>
                        </div>

                        <div class="input-group mt-3" v-if="jenis == 'SV' || jenis=='SS' || jenis=='SP'"> 
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Diskon</span>
                            </div>
                            <input type="text" v-model="Transaksi.Diskon" 
                            class="form-control" placeholder="Masukkan Diskon" 
                            aria-label="Transaksi_Diskon" aria-describedby="basic-addon2" 
                            id="Transaksi_Diskon" name="Transaksi_Diskon" required>
                        </div>

                        <div class="modal-footer mt-3" >
                            <button type="submit" class="btn btn-success btn-lg w-100" 
                            data-dismiss="modal" @click="getDiskon(),addpenjualan()">Tambahkan Transaksi Penjualan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TAMPIL DETAIL PENJUALAN SPAREPART-->
        <div class="modal fade" id="Detail_Penjualan" tabindex="-1" role="dialog" aria-labelledby="Detail_Penjualan" 
        aria-hidden="true">
            <div class="modal-dialog" style="max-width:750px;">
                <div class="modal-content" style="width:750px;">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Detail Transaksi Penjualan Sparepart</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" 
                        style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="container-fluid mt-3">
                        <div class="row mb-2">
                            <div class="col-sm-3">
                                <div class="col-sm-9 p-0">
                                    <button class="btn btn-success mb-2 btn-block" @click="getallpenjualan(),refresh()" 
                                    data-title="Tambah_Detail_Sparepart" data-toggle="modal" data-target="#Tambah_Detail_Sparepart">
                                        <i class="fas fa-plus mr-2"></i>Tambah
                                    </button>
                                </div>
                                <div class="col-sm-3">

                                </div>
                            </div>
                            <div class="col-sm-5">

                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input class="form-control" v-model="Cari_Detail_Sparepart" type="search" placeholder="Cari Detail">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th scope="col">Kode Sparepart</th>
                                        <th scope="col">Harga Satuan</th>
                                        <th scope="col">Jumlah Sparepart</th>
                                        <th scope="col">Subtotal Penjualan</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-bind:key="detail['id']" v-for="detail in filtereddetail">
                                        <td>{{detail.Kode_Sparepart }} </td>
                                        <td>{{detail.Harga_Satuan}} </td>
                                        <td>{{detail.Jumlah}} </td>
                                        <td>{{detail.Subtotal_Detail_Sparepart}}</td>
                                        <td class="text-center">
                                            <p data-placement="top" data-toggle="tooltip" title="Edit">
                                                <button class="btn btn-primary" 
                                                    @click="datakonsumenhandler(konsumen)" 
                                                    data-title="Edit_Detail_Sparepart" data-toggle="modal" 
                                                    data-target="#Edit_Detail_Sparepart">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p data-placement="top" data-toggle="tooltip" title="Delete">
                                                <button @click="datatransaksihandler(transaksi)" 
                                                    class="btn btn-danger"  data-title="Delete_Detail_Sparepart" 
                                                    data-toggle="modal" data-target="#Delete_Detail_Sparepart">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="modal-header">
                            <h4 class="modal-title mx-auto" id="Heading">Detail Transaksi Jasa</h4>
                        </div>
                        
                        <div class="container-fluid mt-3">
                            <div class="row mb-2">
                                <div class="col-sm-3">
                                    <div class="col-sm-9 p-0">
                                        <button class="btn btn-success mb-2 btn-block" @click="getallpenjualan(),refresh()" 
                                        data-title="Tambah_Detail_Jasa" data-toggle="modal" data-target="#Tambah_Detail_Jasa">
                                            <i class="fas fa-plus mr-2"></i>Tambah
                                        </button>
                                    </div>
                                    <div class="col-sm-3">

                                    </div>
                                </div>
                                <div class="col-sm-5">

                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input class="form-control" v-model="Cari_Detail_Jasa" type="search" placeholder="Cari Detail">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th scope="col">ID Jasa</th>
                                        <th scope="col">Nama Jasa</th>
                                        <th scope="col">Harga Jasa</th>
                                        <th scope="col">Subtotal Jasa</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-bind:key="detailjasa['id']" v-for="detailjasa in filtereddetailjasa">
                                        <td>{{detailjasa.Id_Jasa }} </td>
                                        <td>{{detailjasa.Nama_Jasa}} </td>
                                        <td>{{detailjasa.Harga_Jasa}} </td>
                                        <td>{{detailjasa.Subtotal_Detail_Jasa}} </td>
                                        <td class="text-center">
                                            <p data-placement="top" data-toggle="tooltip" title="Edit">
                                                <button class="btn btn-primary" 
                                                    @click="datakonsumenhandler(konsumen)" 
                                                    data-title="Edit_Detail_Jasa" data-toggle="modal" 
                                                    data-target="#Edit_Detail_Jasa">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p data-placement="top" data-toggle="tooltip" title="Delete">
                                                <button @click="datatransaksihandler(transaksi)" 
                                                    class="btn btn-danger"  data-title="Delete_Detail_Jasa" 
                                                    data-toggle="modal" data-target="#Delete_Detail_Jasa">
                                                    <i class="fas fa-trash-alt"></i>
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
                                <button class="btn btn-success mb-2 btn-block" data-title="Cetak_SPK">
                                    <i class="far fa-file-pdf"></i> Cetak Surat Perintah Kerja
                                </button>
                            </div>
                            <div class="col-sm-4">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF TAMPIL DETAIL PENJUALAN SPAREPART -->
        <!-- DELETE TRANSAKSI PENJUALAN -->
        <div class="modal fade" id="Delete_Penjualan" tabindex="-1" role="dialog" aria-labelledby="Delete_Penjualan" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Hapus Data Transaksi </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda Yakin Ingin Menghapus Data Transaksi Ini ?</div>
                    </div>
                    <div class="modal-footer ">
                        <a id="delete_btn" class="float-left w-100">
                            <button type="button" @click="deletepenjualan(Transaksi.Id_Transaksi)" class="btn btn-danger float-left w-50" data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span>Ya</button>
                        </a>
                        <button type="button" class="btn btn-secondary float-right w-50" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Tidak</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF DELETE DELETE TRANSAKSI PENJUALAN -->
        <!-- TAMBAH DETAIL TRANSAKSI SPAREPART -->
        <div class="modal fade" id="Tambah_Detail_Sparepart" tabindex="-1" role="dialog" 
            aria-labelledby="Tambah_Detail_Sparepart" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Tambah Transaksi Penjualan Sparepart</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                            aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mt-3"> 
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Sparepart</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Pilih Sparepart --</option>
                                <option v-bind:key="spareparts['Kode_Sparepart']" 
                                v-on:change="getSelectedIndex"
                                v-for="spareparts in sparepart" 
                                :value="spareparts.Kode_Sparepart" >{{spareparts.Nama_Sparepart}}</option>
                            </select>

                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Tipe</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Tipe Sparepart --</option>
                                <option v-bind:key="spareparts['Kode_Sparepart']" 
                                v-on:change="getSelectedIndex"
                                v-for="spareparts in sparepart" 
                                :value="spareparts.Kode_Sparepart" disabled>{{spareparts.Tipe_Barang}}</option>
                            </select>
                        </div>

                        <div class="input-group mt-3"> 
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Jumlah</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Jumlah Sparepart --</option>
                                <option v-bind:key="spareparts['Kode_Sparepart']" 
                                v-on:change="getSelectedIndex"
                                v-for="spareparts in sparepart" 
                                :value="spareparts.Kode_Sparepart" disabled>{{spareparts.Jumlah_Sparepart}}</option>
                            </select>

                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2" disabled>Harga Jual</span>
                            </div> 
                            <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Harga Jual --</option>
                                <option v-bind:key="spareparts['Kode_Sparepart']" 
                                v-on:change="getSelectedIndex"
                                v-for="spareparts in sparepart" 
                                :value="spareparts.Kode_Sparepart" disabled>{{spareparts.Harga_Jual}}</option>
                            </select>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Jumlah</span>
                            </div>
                            <input type="number" v-model="jumlah" 
                            class="form-control" placeholder="Masukkan Jumlah Sparepart Yang Ingin Dibeli" 
                            aria-label="jumlah" aria-describedby="basic-addon2" 
                            id="jumlah" name="jumlah" required>
                        </div>

                        <div class="col-lg-6 mt-3">
                            <button type="submit" class="btn btn-success btn" @click="sparepartHandler(sparepart)">Add Sparepart</button>
                        </div>

                        <div class="input-group mt-3 w-400">
                            <div class="row">
                                <div class="col-12 mr-2">
                                    <div class="list-group mr-2" v-for="spareparts in sparepartdata" :key="spareparts['Kode_Sparepart']">
                                        <a href="#" class="list-group-item list-group-item-action list-group-item-success">
                                            {{spareparts.Kode_Sparepart + '-' + spareparts.Nama_Sparepart}}          
                                            <button type="submit" class="btn btn-danger" style="margin-left: 200px"
                                            @click="deleteListSparepart(spareparts.Kode_Sparepart)">Delete</button>
                                            <br>     
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer mt-3" >
                            <button type="submit" class="btn btn-success btn-lg w-100" 
                            data-dismiss="modal" @click="addetailspareparts()">Tambahkan Penjualan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF TAMBAH DETAIL SPAREPART -->
        <!-- EDIT DETAIL TRANSAKSI SPAREPART -->
        <div class="modal fade" id="Edit_Detail_Sparepart" tabindex="-1" role="dialog" 
            aria-labelledby="Edit_Detail_Sparepart" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Edit Transaksi Penjualan Sparepart</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                            aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mt-3"> 
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Sparepart</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Pilih Sparepart --</option>
                                <option v-bind:key="spareparts['Kode_Sparepart']" 
                                v-on:change="getSelectedIndex"
                                v-for="spareparts in sparepart" 
                                :value="spareparts.Kode_Sparepart" >{{spareparts.Nama_Sparepart}}</option>
                            </select>

                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Tipe</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Tipe Sparepart --</option>
                                <option v-bind:key="spareparts['Kode_Sparepart']" 
                                v-on:change="getSelectedIndex"
                                v-for="spareparts in sparepart" 
                                :value="spareparts.Kode_Sparepart" disabled>{{spareparts.Tipe_Barang}}</option>
                            </select>
                        </div>

                        <div class="input-group mt-3"> 
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Jumlah</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Jumlah Sparepart --</option>
                                <option v-bind:key="spareparts['Kode_Sparepart']" 
                                v-on:change="getSelectedIndex"
                                v-for="spareparts in sparepart" 
                                :value="spareparts.Kode_Sparepart" disabled>{{spareparts.Jumlah_Sparepart}}</option>
                            </select>

                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2" disabled>Harga Jual</span>
                            </div> 
                            <select class="form-control mr-2" v-model="Sparepart.Kode_Sparepart" v-on:change="getSelectedIndex" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Harga Jual --</option>
                                <option v-bind:key="spareparts['Kode_Sparepart']" 
                                v-on:change="getSelectedIndex"
                                v-for="spareparts in sparepart" 
                                :value="spareparts.Kode_Sparepart" disabled>{{spareparts.Harga_Jual}}</option>
                            </select>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Jumlah</span>
                            </div>
                            <input type="number" v-model="jumlah" 
                            class="form-control" placeholder="Masukkan Jumlah Sparepart Yang Ingin Dibeli" 
                            aria-label="jumlah" aria-describedby="basic-addon2" 
                            id="jumlah" name="jumlah" required>
                        </div>

                        <div class="col-lg-6 mt-3">
                            <button type="submit" class="btn btn-success btn" @click="sparepartHandler(sparepart)">Add Sparepart</button>
                        </div>

                        <div class="input-group mt-3 w-400">
                            <div class="row">
                                <div class="col-12 mr-2">
                                    <div class="list-group mr-2" v-for="spareparts in sparepartdata" :key="spareparts['Kode_Sparepart']">
                                        <a href="#" class="list-group-item list-group-item-action list-group-item-success">
                                            {{spareparts.Kode_Sparepart + '-' + spareparts.Nama_Sparepart}}          
                                            <button type="submit" class="btn btn-danger" style="margin-left: 200px"
                                            @click="deleteListSparepart(spareparts.Kode_Sparepart)">Delete</button>
                                            <br>     
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer mt-3" >
                            <button type="submit" class="btn btn-primary btn-lg w-100" 
                            data-dismiss="modal" @click="addetailspareparts()">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF EDIT DETAIL SPAREPART -->
        <!-- DELETE TRANSAKSI PENJUALAN SPAREPART -->
        <div class="modal fade" id="Delete_Detail_Sparepart" tabindex="-1" role="dialog" aria-labelledby="Delete_Detail_Sparepart" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Hapus Data Transaksi </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda Yakin Ingin Menghapus Detail Sparepart Ini ?</div>
                    </div>
                    <div class="modal-footer ">
                        <a id="delete_btn" class="float-left w-100">
                            <button type="button" @click="deletepenjualan(Transaksi.Id_Transaksi)" class="btn btn-danger float-left w-50" data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span>Ya</button>
                        </a>
                        <button type="button" class="btn btn-secondary float-right w-50" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Tidak</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF DELETE DETAIL SPAREPART -->
        <!-- TAMBAH DETAIL TRANSAKSI JASA -->
        <div class="modal fade" id="Tambah_Detail_Jasa" tabindex="-1" role="dialog" 
            aria-labelledby="Tambah_Detail_Jasa" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Tambah Transaksi Jasa</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                            aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mt-3"> 
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Jasa</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Jasaservice.Id_Jasa" v-on:change="getSelectedIndexJasa" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Pilih Jasa --</option>
                                <option v-bind:key="jasaS['Id_Jasa']" 
                                v-on:change="getSelectedIndexJasa"
                                v-for="jasaS in jasa" 
                                :value="jasaS.Id_Jasa" >{{jasaS.Nama_Jasa}}</option>
                            </select>

                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Harga</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Jasaservice.Id_Jasa" v-on:change="getSelectedIndexJasa" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Pilih Jasa --</option>
                                <option v-bind:key="jasaS['Id_Jasa']" 
                                v-on:change="getSelectedIndexJasa"
                                v-for="jasaS in jasa" 
                                :value="jasaS.Id_Jasa" >{{jasaS.Harga_Jasa}}</option>
                            </select>
                            <button type="submit" class="btn btn-success btn" @click="jasaHandler(jasa)">Add Jasa</button>
                        </div>

                            <div class="col-lg-6 mt-3">
                            </div>

                            <div class="input-group mt-3 w-400">
                                <div class="row">
                                    <div class="col-12 mr-2">
                                        <div class="list-group mr-2" v-for="jasaS in jasadata" :key="jasaS['Id_Jasa']">
                                            <a href="#" class="list-group-item list-group-item-action list-group-item-success">
                                                {{jasaS.Nama_Jasa + '-' + jasaS.Harga_Jasa}}          
                                                <button type="submit" class="btn btn-danger" style="margin-left: 200px"
                                                @click="deleteListJasa(jasaS.Id_Jasa)">Delete</button>
                                                <br>     
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3" >
                            <button type="submit" class="btn btn-success btn-lg w-100" 
                            data-dismiss="modal" @click="adddetailjasa()">Tambahkan Transaksi Jasa</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END OF TAMBAH DETAIL TRANSAKSI JASA -->
        <!-- EDIT DETAIL TRANSAKSI JASA -->
        <div class="modal fade" id="Edit_Detail_Jasa" tabindex="-1" role="dialog" 
            aria-labelledby="Edit_Detail_Jasa" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Edit Detail Transaksi Jasa</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                            aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mt-3"> 
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Jasa</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Jasaservice.Id_Jasa" v-on:change="getSelectedIndexJasa" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Pilih Jasa --</option>
                                <option v-bind:key="jasaS['Id_Jasa']" 
                                v-on:change="getSelectedIndexJasa"
                                v-for="jasaS in jasa" 
                                :value="jasaS.Id_Jasa" >{{jasaS.Nama_Jasa}}</option>
                            </select>

                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Harga</span>
                            </div>  
                            <select class="form-control mr-2" v-model="Jasaservice.Id_Jasa" v-on:change="getSelectedIndexJasa" >
                                <option disabled="disabled" selected="selected" 
                                value="Pilih ">-- Pilih Jasa --</option>
                                <option v-bind:key="jasaS['Id_Jasa']" 
                                v-on:change="getSelectedIndexJasa"
                                v-for="jasaS in jasa" 
                                :value="jasaS.Id_Jasa" >{{jasaS.Harga_Jasa}}</option>
                            </select>
                            <button type="submit" class="btn btn-success btn" @click="jasaHandler(jasa)">Add Jasa</button>
                        </div>

                            <div class="col-lg-6 mt-3">
                            </div>

                            <div class="input-group mt-3 w-400">
                                <div class="row">
                                    <div class="col-12 mr-2">
                                        <div class="list-group mr-2" v-for="jasaS in jasadata" :key="jasaS['Id_Jasa']">
                                            <a href="#" class="list-group-item list-group-item-action list-group-item-success">
                                                {{jasaS.Nama_Jasa + '-' + jasaS.Harga_Jasa}}          
                                                <button type="submit" class="btn btn-danger" style="margin-left: 200px"
                                                @click="deleteListJasa(jasaS.Id_Jasa)">Delete</button>
                                                <br>     
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3" >
                            <button type="submit" class="btn btn-primary  btn-lg w-100" 
                            data-dismiss="modal" @click="adddetailjasa()">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END OF EDIT DETAIL TRANSAKSI JASA -->
        <!-- DELETE TRANSAKSI PENJUALAN SPAREPART -->
        <div class="modal fade" id="Delete_Detail_Jasa" tabindex="-1" role="dialog" aria-labelledby="Delete_Detail_Sparepart" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Hapus Data Transaksi </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda Yakin Ingin Menghapus Detail Jasa Ini ?</div>
                    </div>
                    <div class="modal-footer ">
                        <a id="delete_btn" class="float-left w-100">
                            <button type="button" @click="deletepenjualan(Transaksi.Id_Transaksi)" class="btn btn-danger float-left w-50" data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span>Ya</button>
                        </a>
                        <button type="button" class="btn btn-secondary float-right w-50" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Tidak</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- END OF DELETE DETAIL SPAREPART -->
</template>
<script>
import sparepartController from '../../service/Sparepart'
import penjualanController from '../../service/Penjualan'
import Controller from '../../service/Konsumen'
import controller from '../../service/MotorKonsumen'
import motorController from '../../service/Motor'
import jasaController from '../../httpController'
import validators from '../../validations/konsumen_validations'
import { mapGetter, mapGetters } from 'vuex'

export default {
    validations: validators,
    data: () => ({
        pegawaidata:[],
        jasa:[],
        jasaData:[],
        jasadata:[],
        detailpenjualandata:[],
        detailjasadata:[],
        transaksidata:[],
        sparepart:[],
        sparepartdata:[],
        sparepartData:[],
        penjualandata:[],
        compabitility:[],
        konsumendata:[],
        konsumen:[],
        motorkonsumendata:[],
        handledkonsumen:[],
        motorcycle:[],
        Nama_Konsumen:'',
        Alamat_Konsumen:'',
        Telepon_Konsumen:'',
        Cari_Motor_Konsumen: '',
        Cari_Transaksi:'',
        Cari_Detail_Sparepart:'',
        Cari_Detail_Jasa:'',
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
            Id_Konsumen:'',
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
            { value: "Sedang Diproses", id: '1' },
            { value: "Selesai", id: '2' },
            { value: "Belum Diproses", id: '3' }
        ],
        jenis: 'Pilih Jenis Transaksi',
        Jenis: [
            { value: "SP", id: '1' },
            { value: "SS", id: '2' },
            { value: "SV", id: '3' }
        ],
        Sparepart:{
            Kode_Sparepart:'',
            Tipe_Barang:'',
            Nama_Sparepart:'',
            Merk_Sparepart:'',
            Rak_Sparepart: '',
            Stok_Minimum_Sparepart:0,
            Harga_Beli:0,
            Harga_Jual:0,
            Gambar:'',
        },
        Transaksi:{
            Id_Transaksi:'',
            Id_Konsumen:'',
            Tanggal_Transaksi:'',
            Jenis_Transaksi:'',
            Subtotal:0,
            Diskon:0,
            Total:0,
            Status:0,
        },
        Jasaservice:{
            Id_Jasa:'',
            Nama_Jasa:'',
            Harga_Jasa:0,
        },
        jumlah:'',
        temp:{
            Id_Jasa_Montir:'',
            Id_Transaksi:'',
            Kode_Sparepart:'',
            Harga_Satuan:'',
            Subtotal_Detail_Sparepart:0,
            Jumlah:0,
            Harga_Satuan:0,
            Nama_Sparepart:'',
        },
        tempJ:{
            Id_Jasa_Montir:'',
            Id_Transaksi:'',
            Id_Jasa:'',
            Subtotal_Detail_Jasa:0,
            Nama_Jasa:'',
            Harga_Jasa:0,
        },
        Diskon:0,
        tempTotal:0,
        total:0,
        totalJasa:0,
        Id_Detail_Modal:0,
        Pegawai:{
            Id_Pegawai:'',
        },
        Id_Jasa_Montir:'',
        Harga:'',
    }),
    mounted(){
        this.getPegawai()
        this.getallkonsumen()
        this.getalldetailpenjualan()
        this.getalldetailjasa()
        this.getallpenjualan()
        this.getalljasaservice()
        this.getallmotorkonsumen()
        this.getallmotor()
        this.getallsparepart()
    },
    methods:{
        getDiskon(){
            //this.Diskon     = this.Transaksi.Diskon;
            //this.tempTotal  = (this.total + this.totalJasa) - this.Transaksi.Diskon;
            //this.Transaksi.Total  = (this.Transaksi.Total - this.Transaksi.Diskon);
        },
        sparepartHandler(sparepart){
            var object = sparepart[this.index]
            this.temp.Kode_Sparepart            = this.Sparepart.Kode_Sparepart;
            this.temp.Id_Transaksi              = this.Id_Detail_Modal;
            let data = this.sparepart.find(obj=>obj.Kode_Sparepart == this.Sparepart.Kode_Sparepart)
            console.log(data.Nama_Sparepart)
            this.temp.Nama_Sparepart            = data.Nama_Sparepart;
            this.temp.Harga_Satuan              = data.Harga_Jual;
            this.temp.Jumlah                    = this.jumlah;
            this.temp.Subtotal_Detail_Sparepart = this.temp.Harga_Satuan * this.temp.Jumlah;
            //this.total                          = parseInt(this.temp.Subtotal_Pengadaan + this.total);
            this.Transaksi.Subtotal             = parseInt(this.Transaksi.Subtotal + this.temp.Subtotal_Detail_Sparepart,10);
            this.Transaksi.Total                 = parseInt(this.temp.Subtotal_Detail_Sparepart + this.Transaksi.Total,10);

            this.sparepartdata.push(JSON.parse(JSON.stringify(this.temp)))
            this.sparepartData.push(this.Sparepart.Kode_Sparepart)
        },
        jasaHandler(jasa){
            var object = jasa[this.index]
            console.log(object);
            this.tempJ.Id_Jasa                   = this.Jasaservice.Id_Jasa;
            this.tempJ.Id_Transaksi              = this.Transaksi.Id_Transaksi;
            let data = this.jasa.find(obj=>obj.Id_Jasa == this.Jasaservice.Id_Jasa)
            console.log(data.Nama_Jasa)
            this.tempJ.Nama_Jasa                 = data.Nama_Jasa;
            this.tempJ.Harga_Jasa                = data.Harga_Jasa;
            this.tempJ.Subtotal_Detail_Jasa      = data.Harga_Jasa;
            this.Transaksi.Subtotal              = parseInt(this.Transaksi.Subtotal + this.tempJ.Subtotal_Detail_Jasa,10);
            this.Transaksi.Total                 = parseInt(this.tempJ.Subtotal_Detail_Jasa + this.Transaksi.Total,10);

            //this.totalJasa                       = data.Harga_Jasa + this.tempJ.Subtotal_Detail_Jasa;

            this.jasadata.push(JSON.parse(JSON.stringify(this.tempJ)))
            this.jasaData.push(this.Jasaservice.Id_Jasa)

            // this.jasadata = jasa.Subtotal_Detail_Jasa.data;
            // console.log(this.jasadata)
        },
        deleteListSparepart(id)
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
        deleteListJasa(id)
        {
            let filter = this.jasa.filter(function( obj ) {
                return obj.Id_Jasa !== id;
            });
            this.jasadata=filter
            let filter2 = this.jasaData.filter(function( obj ) {
                return obj !== id;
            });
            this.jasaData=filter2
        },
        async getalldetailpenjualan () {
            try {
                this.detailpenjualandata = (await penjualanController.getalldetailpenjualan()).data
                console.log(this.detailpenjualandata)
            } catch (err) {
                console.log(err)
            }
        },
        async getalldetailjasa () {
            try {
                this.detailjasadata = (await penjualanController.getalldetailjasa()).data
                console.log(this.detailjasadata)
            } catch (err) {
                console.log(err)
            }
        },
        async getmotorkonsumen () {
            try {
                this.sparepartdata = (await penjualanController.getmotorKonsumen()).data
                console.log(this.sparepartdata)
            } catch (err) {
                console.log(err)
            }
        },
        async getPegawai () {
            try {
                this.pegawaidata = (await penjualanController.getPegawai()).data
                console.log(this.pegawaidata)
            } catch (err) {
                console.log(err)
            }
        },
        async getallpenjualan () {
            try {
                this.penjualandata = (await penjualanController.getallpenjualan()).data
                console.log(this.penjualandata)
            } catch (err) {
                console.log(err)
            }
        },
         async getalljasaservice () {
            try {
                this.jasa = (await jasaController.getalljasaservice()).data
                console.log(this.jasa)
            } catch (err) {
                console.log(err)
            }
        },
        async getallsparepart () {
            try {
                this.sparepart = (await sparepartController.getallsparepart()).data
                console.log(this.sparepart)
            } catch (err) {
                console.log(err)
            }
        },
        getSelectedIndex(){
            this.index = this.konsumen.map(function(e) { return e.Id_Konsumen; }).indexOf(this.Konsumen.Id_Konsumen)
        },
        getSelectedIndexJasa(){
            this.index = this.jasa.map(function(e) { return e.Id_Jasa; }).indexOf(this.Jasaservice.Id_Jasa)
        },
        getKonsumen(){
            this.konsumen = this.konsumendata.find(obj=>obj.Id_Konsumen == this.Konsumen.Id_Konsumen);
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
        datamotorkonsumenhandler(motorkonsumen){
            this.Motor_Konsumen = motorkonsumen
        },
        async getallkonsumen () {
            try {
                this.konsumendata = (await Controller.getallkonsumen()).data
                console.log(this.konsumendata)
            } catch (err) {
                console.log(err)
            }
        },
        async addpenjualan () {
            try {
                const payload = {
                    Id_Montir           : this.Id_Jasa_Montir,
                    Id_Konsumen         : this.Konsumen.Id_Konsumen,
                    Id_Motor_Konsumen   : this.Motor.Id_Motor,
                    Tanggal_Transaksi   : this.Transaksi.Tanggal_Transaksi,
                    Jenis_Transaksi     : this.jenis,
                    Subtotal            : this.Transaksi.Subtotal,
                    Diskon              : this.Transaksi.Diskon,
                    Total               : this.Transaksi.Total - this.Transaksi.Diskon,
                    Status              : '0',
                    Detail_Sparepart    : this.sparepartdata,
                    Detail_Jasa         : this.jasadata,
                }
                await penjualanController.addpenjualan(payload)
                this.getallpenjualan()
                this.getalldetailpenjualan()
                this.getalldetailjasa()
                this.refresh()
            } catch (err) {
                console.log(err)
            }
        },
        async deletepenjualan(id) {
            try {
                await penjualanController.deletepenjualan(id)
                this.getallpenjualan()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        async addetailspareparts () {
            try {
                const payload = {
                    //Id_Montir           : this.Id_Jasa_Montir,
                    // Kode_Sparepart                  : this.Kode_Sparepart,
                    // Harga_Satuan                    : this.Harga_Satuan,
                    // Jumlah                          : this.Jumlah,
                    // Subtotal_Detail_Sparepart       : this.temp.Subtotal_Detail_Sparepart + this.tempJ.Subtotal_Detail_Jasa,
                    // Total                           : this.tempTotal,
                    Detail_Sparepart    : this.sparepartdata
                }
                await penjualanController.addetailspareparts(payload)
                this.getallpenjualan()
            } catch (err) {
                console.log(err)
            }
        },
        datakonsumenhandler(konsumen){
            this.Konsumen = konsumen
        },
        datatransaksihandler(transaksi){
            this.Transaksi = transaksi
        },
        detailhandler(transaksi){
            this.Id_Detail_Modal = transaksi.Id_Transaksi
        },
        refresh(){
            this.Konsumen.Nama_Konsumen = '';
            this.Konsumen.Alamat_Konsumen= '';
            this.Konsumen.Telepon_Konsumen= '';
        },
        refreshMotorKonsumen(){
            this.Motor.Id_Motor = -1;
        },
        refresh(){
            // this.Transaksi.Diskon      ='0'
            // this.Transaksi.Subtotal    ='0'
            // this.Transaksi.Tanggal_Transaksi=''
            // this.Id_Jasa_Montir = '-1'
            // this.Transaksi.Status ='0'
            // this.jumlah = 0
            // this.jenis = ''
            // this.Motor.Id_Motor = '-1'
            // this.Konsumen.Id_Konsumen = '-1'
            // this.Konsumen.Nama_Konsumen = '-1'
            // this.Konsumen.Alamat_Konsumen = '-1'
        },
    },
    computed:{
        ...mapGetters({
            Id_Pegawai : 'LoggedUser/id'
        }),
        filteredpegawai:function(){
            return this.pegawaidata.filter((pegawai)=>{
                return pegawai.Id_Role == '4'
            });
        },
        filteredmotor:function(){
            return this.motorcycle.filter((motor)=>{
                return motor.Merk.match(this.Cari_Motor);
            });
        },
        filteredkonsumen:function(){
            return this.konsumendata.filter((konsumen)=>{
                return konsumen.Nama_Konsumen.toLowerCase().match(this.Cari_Konsumen.toLowerCase());
            });
        },
        filteredmotorkonsumen:function(){
            return this.motorkonsumendata.filter((motorkonsumen)=>{
                return motorkonsumen.Id_Konsumen==this.Konsumen.Id_Konsumen;
            });
        },
        filteredtransaksi:function(){
            return this.penjualandata.filter((transaksi)=>{
                return transaksi.Jenis_Transaksi.toLowerCase().match(this.Cari_Transaksi.toLowerCase());
            });
        },
        filtereddetail:function(){
            return this.detailpenjualandata.filter((detailpenjualan)=>{
                return detailpenjualan.Id_Transaksi == this.Id_Detail_Modal;
            });
            return this.detailpenjualandata.filter((detailpenjualan)=>{
                return detailpenjualan.Kode_Sparepart.toLowerCase().match(this.Cari_Detail_Sparepart.toLowerCase());
            });
        },
        filtereddetailsparepart:function(){
            return this.detailpenjualandata.filter((detailpenjualan)=>{
                return detailpenjualan.Kode_Sparepart.toLowerCase().match(this.Cari_Detail_Sparepart.toLowerCase());
            });
        },
        filtereddetailJasa:function(){
            return this.detailjasadata.filter((detailjasa)=>{
                return detailjasa.Id_Jasa.toLowerCase().match(this.Cari_Detail_Jasa.toLowerCase());
            });
        },
        filtereddetailjasa:function(){
            return this.detailjasadata.filter((detailjasa)=>{
                return detailjasa.Id_Transaksi == this.Id_Detail_Modal;
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
