<template>
    <body>
        <div class="container-fluid mt-3" style="">
            <div class="row mb-2">
                <div class="col-sm-2">
                    <div class="col-sm-7 p-0">
                        <button class="btn btn-success mb-2 btn-block" @click="getallsparepart(),refresh()" data-title="Tambah_Sparepart" data-toggle="modal" data-target="#Tambah_Sparepart">
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
                        <input class="form-control" v-model="Cari_Sparepart" type="search" placeholder="Cari Sparepart">
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
                            <th scope="col">Kode</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tipe</th>
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
                        <!-- <tr v-bind:key="index" v-for="(sparepart,index) in filteredsparepart"> -->
                        <tr v-bind:key="sparepart['Kode_Sparepart']" v-for="sparepart in filteredsparepart">
                            <td>{{sparepart.Kode_Sparepart}} </td>
                            <td>{{sparepart.Nama_Sparepart}} </td>
                            <td>{{sparepart.Tipe_Barang}} </td>
                            <td>{{sparepart.Merk_Sparepart}} </td>
                            <td>{{sparepart.Rak_Sparepart}} </td>
                            <td>{{sparepart.Jumlah_Sparepart}} </td>
                            <td>{{sparepart.Stok_Minimum_Sparepart}} </td>
                            <td>{{sparepart.Harga_Beli}} </td>
                            <td>{{sparepart.Harga_Jual}} </td>
                            <!-- image/sparepart/Bohlam_Depan.jpg -->
                            <td> <img :src="'images/'+sparepart.Gambar" alt="" style="max-width:75px; max-height:75px;"> </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <button class="btn btn-primary" @click="dataspareparthandler(sparepart)" 
                                    data-title="Edit_Sparepart" data-toggle="modal" 
                                    data-target="#Edit_Sparepart">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button @click="dataspareparthandler(sparepart)" 
                                    class="btn btn-danger"  data-title="Delete_Sparepart" 
                                    data-toggle="modal" data-target="#Delete_Sparepart">
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
        <!-- TAMBAH SPAREPART -->
        <div class="modal fade" id="Tambah_Sparepart" tabindex="-1" role="dialog" 
            aria-labelledby="Tambah_Sparepart" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Tambah Sparepart</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="input-group">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Kode</span>
                                </div>
                                <!-- <fieldset>
                                    <input v-model="Kode1" type="text" size="4" maxlength="4" @focus="next()"> -
                                    <input v-model="Kode2" type="text" size="4" maxlength="4"> -
                                    <input v-model="Kode3" type="text" size="3" maxlength="3">
                                </fieldset> -->
                                <input type="text" v-model="Sparepart.Kode_Sparepart" class="form-control" 
                                placeholder="Masukkan Kode Sparepart" :error="kodeErrors" 
                                aria-label="Kode_Sparepart" aria-describedby="basic-addon2"
                                id="Kode_Sparepart" name="Kode_Sparepart" 
                                @input="$v.Sparepart.Kode_Sparepart.$touch()" 
                                @blur="$v.Sparepart.Kode_Sparepart.$touch()" required>
                            </div>
                            <div class="text-center">
                                <p class="mb-3" style="color:red;" 
                                v-if="$v.Sparepart.Kode_Sparepart.$invalid">{{kodeErrors[0]}}</p>
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Tipe Barang</span>
                                </div>
                                <input type="text" v-model="Sparepart.Tipe_Barang" class="form-control" 
                                placeholder="Masukkan Tipe Barang" :error="typeErrors" 
                                aria-label="Tipe_Barang" aria-describedby="basic-addon2"
                                id="Tipe_Barang" name="Tipe_Barang" 
                                @input="$v.Sparepart.Tipe_Barang.$touch()" 
                                @blur="$v.Sparepart.Tipe_Barang.$touch()" required>
                            </div>
                            <div class="text-center">
                                <div style="color:red;" 
                                v-if="$v.Sparepart.Tipe_Barang.$invalid">{{typeErrors[0]}}
                                </div>
                            </div>

                            <div class="input-group mt-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Nama</span>
                                </div>
                                <input type="text" v-model="Sparepart.Nama_Sparepart" class="form-control" 
                                placeholder="Masukkan Nama Sparepart" :error="nameErrors" 
                                aria-label="Nama_Sparepart" aria-describedby="basic-addon2" 
                                id="Nama_Sparepart" name="Nama_Sparepart" 
                                @input="$v.Sparepart.Nama_Sparepart.$touch()" 
                                @blur="$v.Sparepart.Nama_Sparepart.$touch()" required>
                            </div>
                            <div class="text-center">
                                <p class="mb-3" style="color:red;" 
                                v-if="$v.Sparepart.Nama_Sparepart.$invalid">{{nameErrors[0]}}</p>
                            </div>

                            <div class="input-group mt-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="fieldBox input-group-text" id="basic-addon2">Merk</span>
                                </div>
                                <input type="text" v-model="Sparepart.Merk_Sparepart" 
                                class="form-control" placeholder="Masukkan Merek Sparepart" 
                                :error="merkErrors" aria-label="Merk_Sparepart" 
                                aria-describedby="basic-addon2" id="Merk_Sparepart"
                                name="Merk_Sparepart" @input="$v.Sparepart.Merk_Sparepart.$touch()" 
                                @blur="$v.Sparepart.Merk_Sparepart.$touch()" required>
                            </div>
                            <div class="text-center">
                                <div style="color:red;" 
                                v-if="$v.Sparepart.Merk_Sparepart.$invalid">{{merkErrors[0]}}</div>
                            </div>

                            <div class="input-group mt-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Rak</span>
                                </div>
                                <select class="form-control mr-2" v-model="posisi">
                                    <option disabled="disabled" selected="selected" value="Pilih Posisi">Pilih Posisi</option>
                                    <option v-for="(posisi,index) in positions" :key="index">{{posisi.value}}</option>
                                </select>

                                <select class="form-control mr-2" v-model="ruang">
                                    <option disabled="disabled" selected="selected" value="Pilih Tempat">Pilih Tempat</option>
                                    <option v-for="(ruang,index) in ruangs" :key="index">{{ruang.value}}</option>
                                </select>

                                <input type="number" v-model="nomor" 
                                class="form-control" required>
                            </div>

                            <div class="input-group mt-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Jumlah</span>
                                </div>
                                <input type="text" v-model="Sparepart.Jumlah_Sparepart" 
                                class="form-control" placeholder="Masukkan Jumlah Sparepart" 
                                :error="sumErrors" aria-label="Jumlah_Sparepart" 
                                aria-describedby="basic-addon2" id="Jumlah_Sparepart" 
                                name="Jumlah_Sparepart" @input="$v.Sparepart.Jumlah_Sparepart.$touch()" 
                                @blur="$v.Sparepart.Jumlah_Sparepart.$touch()" required>
                            </div>
                            <div class="text-center">
                                <div style="color:red;" 
                                v-if="$v.Sparepart.Jumlah_Sparepart.$invalid">{{sumErrors[0]}}</div>
                            </div>

                            <div class="input-group mt-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Stok</span>
                                </div>
                                <input type="number" v-model="Sparepart.Stok_Minimum_Sparepart" 
                                class="form-control" placeholder="Masukkan Stok Minimum Sparepart" 
                                :error="stokErrors" aria-label="Stok_Minimum_Sparepart" 
                                aria-describedby="basic-addon2" id="Stok_Minimum_Sparepart" 
                                name="Stok_Minimum_Sparepart" @input="$v.Sparepart.Stok_Minimum_Sparepart.$touch()" 
                                @blur="$v.Sparepart.Stok_Minimum_Sparepart.$touch()" required>
                            </div>
                            <div class="text-center">
                                <div style="color:red;" 
                                v-if="$v.Sparepart.Stok_Minimum_Sparepart.$invalid">{{stokErrors[0]}}</div>
                            </div>

                            <div class="input-group mt-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Harga Beli</span>
                                </div>
                                <input type="number" v-model="Sparepart.Harga_Beli" 
                                class="form-control" placeholder="Masukkan Harga Beli Sparepart" 
                                :error="priceBErrors" aria-label="Harga_Beli" 
                                aria-describedby="basic-addon2" id="Harga_Beli" 
                                name="Harga_Beli" @input="$v.Sparepart.Harga_Beli.$touch()" 
                                @blur="$v.Sparepart.Harga_Beli.$touch()" required>
                            </div>
                            <div class="text-center">
                                <div style="color:red;" 
                                v-if="$v.Sparepart.Harga_Beli.$invalid">{{priceBErrors[0]}}</div>
                            </div>

                            <div class="input-group mt-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Harga Jual</span>
                                </div>
                                <input type="number" v-model="Sparepart.Harga_Jual" 
                                class="form-control" placeholder="Masukkan Harga Jual Sparepart" 
                                :error="priceJErrors" aria-label="Harga_Jual" 
                                aria-describedby="basic-addon2" id="Harga_Jual" 
                                name="Harga_Jual" @input="$v.Sparepart.Harga_Jual.$touch()" 
                                @blur="$v.Sparepart.Harga_Jual.$touch()" required>
                            </div>
                            <div class="text-center">
                                <div style="color:red;" 
                                v-if="$v.Sparepart.Harga_Jual.$invalid">{{priceJErrors[0]}}</div>
                            </div>

                             <div class="input-group mt-4">
                                <img :src="Gambar" class="box img-responsive">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <input type="file" name="Gambar" id="Gambar" class="button" 
                                    aria-label="Gambar" 
                                    aria-describedby="basic-addon2"
                                    :v-model="Sparepart.Gambar"
                                    v-on:change="onFileChange" 
                                    ref="Gambar" accept="image/*">
                                    </div>
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Merk</span>
                                </div>
                                    
                                <select class="form-control mr-2" v-model="Motor.Id_Motor" v-on:change="getSelectedIndex" >
                                    <option disabled="disabled" selected="selected" 
                                    value="Pilih Merk">-- Pilih Merk Motor --</option>
                                    <option v-bind:key="motor['Id_Motor']" 
                                    v-on:change="getSelectedIndex"
                                    v-for="motor in motorcycle" 
                                    :value="motor.Id_Motor">{{motor.Merk}}</option>
                                </select>
                                
                                <span class="input-group-text" id="basic-addon2">Tipe</span>
                                <select class="form-control mr-2" v-model="Motor.Id_Motor" v-on:change="getSelectedIndex">
                                    <option disabled="disabled" selected="selected" 
                                    value="Pilih Merk">-- Pilih Tipe Motor --</option>
                                    <option v-bind:key="motor['Id_Motor']"
                                    v-on:change="getSelectedIndex" 
                                    v-for="motor in motorcycle" 
                                    :value="motor.Id_Motor">{{motor.Tipe}}</option>
                                </select>
                                <button type="submit" class="btn btn-warning btn"  
                                    @click="compatibilityHandler(motorcycle)">Add Motor</button>
                            </div>
                            
                            <div class="input-group mt-3 w-400">
                                <div class="row">
                                    <div class="col-12">
                                    <div class="list-group mr-2" v-for="motor in motorcycletypes" :key="motor.Id_Motor">
                                            <a href="#" class="list-group-item list-group-item-action list-group-item-info mr-2">
                                                {{motor.Merk + '-' + motor.Tipe}}</a>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-success btn-lg w-100" 
                                    data-dismiss="modal" 
                                    @click="addsparepart()"
                                    :disabled="$v.Sparepart.$invalid">Tambahkan Sparepart</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF TAMBAH SPAREPART-->

        <!-- EDIT SPAREPART -->
        <div class="modal fade" id="Edit_Sparepart" tabindex="-1" role="dialog" 
        aria-labelledby="Edit_Sparepart" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Edit Sparepart</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="input-group">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                            <span class="input-group-text" id="basic-addon2">Kode</span>
                        </div>
                        <input type="text" v-model="Sparepart.Kode_Sparepart" class="form-control" 
                            placeholder="Masukkan Kode Sparepart" :error="kodeErrors" 
                            aria-label="Kode_Sparepart" aria-describedby="basic-addon2"
                            id="Kode_Sparepart" name="Kode_Sparepart" disabled >
                        </div>
                    
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Tipe Barang</span>
                            </div>
                            <input type="text" v-model="Sparepart.Tipe_Barang" class="form-control" 
                            placeholder="Masukkan Tipe Barang" :error="typeErrors" 
                            aria-label="Tipe_Barang" aria-describedby="basic-addon2"
                            id="Tipe_Barang" name="Tipe_Barang" required>
                        </div>

                        <div class="input-group mt-4">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Nama</span>
                            </div>
                            <input type="text" v-model="Sparepart.Nama_Sparepart" class="form-control" 
                            placeholder="Masukkan Nama Sparepart" :error="nameErrors" 
                            aria-label="Nama_Sparepart" aria-describedby="basic-addon2" 
                            id="Nama_Sparepart" name="Nama_Sparepart" required>
                        </div>

                        <div class="input-group mt-4">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="fieldBox input-group-text" id="basic-addon2">Merk</span>
                            </div>
                            <input type="text" v-model="Sparepart.Merk_Sparepart" 
                            class="form-control" placeholder="Masukkan Merek Sparepart" 
                            :error="merkErrors" aria-label="Merk_Sparepart" 
                            aria-describedby="basic-addon2" id="Merk_Sparepart"
                            name="Merk_Sparepart"  required>
                        </div>

                        <div class="input-group mt-4">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Rak</span>
                            </div>
                            <select class="form-control mr-2" v-model="posisi">
                                <option disabled="disabled" selected="selected" value="Pilih Posisi">Pilih Posisi</option>
                                <option v-for="(posisi,index) in positions" :key="index">{{posisi.value}}</option>
                            </select>

                            <select class="form-control mr-2" v-model="ruang">
                                <option disabled="disabled" selected="selected" value="Pilih Tempat">Pilih Tempat</option>
                                <option v-for="(ruang,index) in ruangs" :key="index">{{ruang.value}}</option>
                            </select>

                            <input type="number" v-model="nomor" 
                            class="form-control" required>
                        </div>


                        <div class="input-group mt-4">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Jumlah</span>
                            </div>
                            <input type="text" v-model="Sparepart.Jumlah_Sparepart" 
                            class="form-control" placeholder="Masukkan Jumlah Sparepart" 
                            :error="sumErrors" aria-label="Jumlah_Sparepart" 
                            aria-describedby="basic-addon2" id="Jumlah_Sparepart" 
                            name="Jumlah_Sparepart"  required>
                        </div>

                        <div class="input-group mt-4">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Stok</span>
                            </div>
                            <input type="number" v-model="Sparepart.Stok_Minimum_Sparepart" 
                            class="form-control" placeholder="Masukkan Stok Minimum Sparepart" 
                            :error="stokErrors" aria-label="Stok_Minimum_Sparepart" 
                            aria-describedby="basic-addon2" id="Stok_Minimum_Sparepart" 
                            name="Stok_Minimum_Sparepart" required>
                        </div>

                        <div class="input-group mt-4">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Harga Beli</span>
                            </div>
                            <input type="number" v-model="Sparepart.Harga_Beli" 
                            class="form-control" placeholder="Masukkan Harga Beli Sparepart" 
                            :error="priceBErrors" aria-label="Harga_Beli" 
                            aria-describedby="basic-addon2" id="Harga_Beli" 
                            name="Harga_Beli"  required>
                        </div>

                        <div class="input-group mt-4">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Harga Jual</span>
                            </div>
                            <input type="number" v-model="Sparepart.Harga_Jual" 
                            class="form-control" placeholder="Masukkan Harga Jual Sparepart" 
                            :error="priceJErrors" aria-label="Harga_Jual" 
                            aria-describedby="basic-addon2" id="Harga_Jual" 
                            name="Harga_Jual" required>
                        </div>

                            <div class="input-group mt-4">
                            <img :src="Gambar" class="box img-responsive">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <input type="file" name="Gambar" id="Gambar" class="button" 
                                aria-label="Gambar" 
                                aria-describedby="basic-addon2"
                                v-on:change="onFileChange" 
                                :v-model="Sparepart.Gambar"
                                ref="Gambar" accept="image/*">
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-primary btn-lg" 
                            style="width: 100%;" 
                            @click="updatesparepart(Sparepart.Kode_Sparepart)" 
                            data-dismiss="modal"
                            :disabled="$v.Sparepart.$invalid">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF EDIT SPAREPART -->
        <!-- DELETE SPAREPART -->
        <div class="modal fade" id="Delete_Sparepart" tabindex="-1" role="dialog" 
        aria-labelledby="Delete_Sparepart" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Hapus Data Sparepart</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" 
                        aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">
                            </span> Apakah Anda Yakin Ingin Menghapus Data Sparepart Ini ?</div>
                    </div>
                    <div class="modal-footer ">
                        <a id="delete_btn" class="float-left w-100">
                            <button type="button" @click="deletesparepart(Sparepart.Kode_Sparepart)" 
                            class="btn btn-danger float-left w-50" data-dismiss="modal">
                            <span class="glyphicon glyphicon-ok-sign"></span>Ya</button>
                        </a>
                        <button type="button" class="btn btn-secondary float-right w-50" 
                        data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Tidak</button>
                    </div>
                </div>
            </div>
            </div>
        <!-- END OF DELETE SPAREPART -->
        <!-- END OF MY MODALS -->
    </body>
</template>

<script>
import Controller from '../../service/Sparepart'
import controller from '../../service/Motor'
import validators from '../../validations/sparepart_validations'
export default {
    validations: validators,
    data: () => ({
        sparepartdata:[],
        motorcycletypes:[],
        motorcycle:[],
        motorcycleTypes:[],
        Kode_Sparepart:'',
        Kode1:'',
        Kode2:'',
        Kode3:'',
        Tipe_Barang:'',
        Nama_Sparepart:'',
        Merk_Sparepart:'',
        Rak_Sparepart: '',
        Jumlah_Sparepart:'',
        Stok_Minimum_Sparepart:0,
        Harga_Beli:0,
        Harga_Jual:0,
        Gambar:'',
        Cari_Sparepart:'',
        Id_Motor: '',
        err: '',
        index: '',
        Sparepart:{
            Kode_Sparepart:'',
            Kode1:'',
            Kode2:'',
            Kode3:'',
            Tipe_Barang:'',
            Nama_Sparepart:'',
            Merk_Sparepart:'',
            Rak_Sparepart: '',
            Jumlah_Sparepart:'',
            Stok_Minimum_Sparepart:0,
            Harga_Beli:0,
            Harga_Jual:0,
            Gambar:'',
        },
        Motor:{
            Merk:'',
            Tipe:'',
            Id_Motor:''
        },
        posisi: 'Pilih Posisi',
        ruang: 'Pilih Tempat',
        nomor:'',
        positions: [
            { value: "DPN", id: 'Depan' },
            { value: "TGH", id: 'Tengah' },
            { value: "BLK", id: 'Belakang' }
        ],
        ruangs: [
            { value: "KACA", id: 'Rak Kaca' },
            { value: "DUS", id: 'Tumpukan Dus' },
            { value: "KAYU", id: 'Lemari Kayu' }
        ],
    }),
    mounted(){
        this.getallsparepart()
        this.getallmotor()
    },
    methods:{
        compatibilityHandler(motorcycle){
            var i =0
            var object = motorcycle[this.index]
            this.err = false
            for(var data in this.motorcycletypes) {
                if(this.motorcycletypes[i].Id_Motor==object.Id_Motor)
                {
                    this.err = true
                }
                i++;
            }
            if(!this.err)
            {
                this.motorcycletypes.push(JSON.parse(JSON.stringify(object)))
                this.motorcycleTypes.push(this.Motor.Id_Motor)
           }
        },
        getSelectedIndex(){
            this.index = this.motorcycle.map(function(e) { return e.Id_Motor; }).indexOf(this.Motor.Id_Motor)
            console.log(this.index)
        },
        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
            
            console.log(this.Gambar)
        },
        createImage(file) {
            let reader = new FileReader();
            reader.onload = (e) => {
                this.Gambar = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        pickFile () {
            this.$refs.Gambar.click ()
        },
        async getallmotor () {
            try {
                this.motorcycle = (await controller.getallmotor()).data
                console.log(this.motorcycle)
            } catch (err) {
                console.log(err)
            }
        },
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
                    Kode_Sparepart          : this.Sparepart.Kode_Sparepart,
                    Nama_Sparepart          : this.Sparepart.Nama_Sparepart,
                    Tipe_Barang             : this.Sparepart.Tipe_Barang,
                    Merk_Sparepart          : this.Sparepart.Merk_Sparepart,
                    Rak_Sparepart           : this.posisi +'-'+ this.ruang+'-'+this.nomor,
                    Jumlah_Sparepart        : this.Sparepart.Jumlah_Sparepart,
                    Stok_Minimum_Sparepart  : this.Sparepart.Stok_Minimum_Sparepart,
                    Harga_Beli              : this.Sparepart.Harga_Beli,
                    Harga_Jual              : this.Sparepart.Harga_Jual,
                    Gambar                  : this.Gambar,
                    motorcycleTypes         : this.motorcycleTypes
               }
               await Controller.addsparepart(payload)
               this.getallsparepart()
            } catch (err) {
                console.log(err)
            }
        },
        async updatesparepart (id) {
            try {
                const payload = {
                    Nama_Sparepart      : this.Sparepart.Nama_Sparepart,
                    Tipe_Barang         : this.Sparepart.Tipe_Barang,
                    Merk_Sparepart      : this.Sparepart.Merk_Sparepart,
                    Rak_Sparepart       : this.posisi +'-'+ this.ruang+'-'+this.nomor,
                    Jumlah_Sparepart    : this.Sparepart.Jumlah_Sparepart,
                    Stok_Minimum_Sparepart:this.Sparepart.Stok_Minimum_Sparepart,
                    Harga_Beli          : this.Sparepart.Harga_Beli,
                    Harga_Jual          : this.Sparepart.Harga_Jual,
                    Gambar              : this.Gambar,
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
            this.Sparepart = sparepart
        },
        refresh(){
            this.Sparepart.Kode_Sparepart       ='';
            this.Sparepart.Kode1                ='';
            this.Sparepart.Kode2                ='';
            this.Sparepart.Kode3                ='';
            this.Sparepart.Tipe_Barang          ='';
            this.Sparepart.Nama_Sparepart       ='';
            this.Sparepart.Merk_Sparepart       ='';
            this.Sparepart.Rak_Sparepart        = '';
            this.Sparepart.Jumlah_Sparepart     ='';
            this.Sparepart.Stok_Minimum_Sparepart=0;
            this.Sparepart.Harga_Beli           =0;
            this.Sparepart.Harga_Jual           =0;
        }
    },
    computed:{
        filteredsparepart:function(){
            return this.sparepartdata.filter((sparepart)=>{
                return  sparepart.Nama_Sparepart.toLowerCase().match(this.Cari_Sparepart.toLowerCase())||
                        sparepart.Kode_Sparepart.toLowerCase().match(this.Cari_Sparepart.toLowerCase())||
                        sparepart.Merk_Sparepart.toLowerCase().match(this.Cari_Sparepart.toLowerCase());
            });
        },
        kodeErrors() {
            const errors = []
            if (!this.$v.Sparepart.Kode_Sparepart.$dirty) return errors
            !this.$v.Sparepart.Kode_Sparepart.required && errors.push('Kode is required')
            !this.$v.Sparepart.Kode_Sparepart.maxLength && errors.push('Kode must be at most 25 characters long')
            !this.$v.Sparepart.Kode_Sparepart.minLength && errors.push('Kode must be at least 5 characters long')
            return errors
        },
        nameErrors() {
            const errors = []
            if (!this.$v.Sparepart.Nama_Sparepart.$dirty) return errors
            !this.$v.Sparepart.Nama_Sparepart.minLength && errors.push('Name must be at least 5 characters long')
            !this.$v.Sparepart.Nama_Sparepart.maxLength && errors.push('Name must be at most 25 characters long')
            !this.$v.Sparepart.Nama_Sparepart.required && errors.push('Name is required.')
            return errors
        },
        merkErrors() {
            const errors = []
            if (!this.$v.Sparepart.Merk_Sparepart.$dirty) return errors
            !this.$v.Sparepart.Merk_Sparepart.minLength && errors.push('Merk must be at least 5 characters long')
            !this.$v.Sparepart.Merk_Sparepart.maxLength && errors.push('Merk must be at most 25 characters long')
            !this.$v.Sparepart.Merk_Sparepart.required && errors.push('Merk is required.')
            return errors
        },
        typeErrors() {
            const errors = []
            if (!this.$v.Sparepart.Tipe_Barang.$dirty) return errors
            !this.$v.Sparepart.Tipe_Barang.minLength && errors.push('Type must be at least 5 characters long')
            !this.$v.Sparepart.Tipe_Barang.maxLength && errors.push('Type must be at most 25 characters long')
            !this.$v.Sparepart.Tipe_Barang.required && errors.push('Type is required.')
            return errors
        },
        rakErrors() {
            // const errors = []
            // if (!this.$v.Sparepart.Rak_Sparepart.$dirty) return errors
            // !this.$v.Sparepart.Rak_Sparepart.minLength && errors.push('Rak must be at least 5 characters long')
            // !this.$v.Sparepart.Rak_Sparepart.maxLength && errors.push('Rak must be at most 25 characters long')
            // !this.$v.Sparepart.Rak_Sparepart.required && errors.push('Rak is required.')
            // return errors
        },
        sumErrors() {
            const errors = []
            if (!this.$v.Sparepart.Jumlah_Sparepart.$dirty) return errors
            !this.$v.Sparepart.Jumlah_Sparepart.required && errors.push('Jumlah is required.')
            !this.$v.Sparepart.Jumlah_Sparepart.maxLength && errors.push('Jumlah must be at most 25 characters long')
            !this.$v.Sparepart.Jumlah_Sparepart.numeric && errors.push('Jumlah must be numeric')
            return errors
        },
        stokErrors() {
            const errors = []
            if (!this.$v.Sparepart.Stok_Minimum_Sparepart.$dirty) return errors
            !this.$v.Sparepart.Stok_Minimum_Sparepart.maxLength && errors.push('Stok must be at most 12 characters long')
            !this.$v.Sparepart.Stok_Minimum_Sparepart.numeric && errors.push('Stok must be numeric')
            !this.$v.Sparepart.Stok_Minimum_Sparepart.required && errors.push('Stok is required')
            return errors
        },
        priceBErrors() {
            const errors = []
            if (!this.$v.Sparepart.Harga_Beli.$dirty) return errors
            !this.$v.Sparepart.Harga_Beli.maxLength && errors.push('Price must be at most 12 characters long')
            !this.$v.Sparepart.Harga_Beli.numeric && errors.push('Price must be numeric')
            !this.$v.Sparepart.Harga_Beli.required && errors.push('Price is required')
            return errors
        },
        priceJErrors() {
            const errors = []
            if (!this.$v.Sparepart.Harga_Jual.$dirty) return errors
            !this.$v.Sparepart.Harga_Jual.maxLength && errors.push('Price must be at most 12 characters long')
            !this.$v.Sparepart.Harga_Jual.numeric && errors.push('Price must be numeric')
            !this.$v.Sparepart.Harga_Jual.required && errors.push('Price is required')
            return errors
        },
    }
}
</script>



<style>
.box{
    height: 420px; 
    width: 460px;
    padding-bottom: 15px;
}
</style>