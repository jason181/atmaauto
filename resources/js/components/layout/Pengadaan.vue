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
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-bind:key="pengadaan['id']" v-for="pengadaan in filteredpengadaan">
                            <td>{{pengadaan.Nama_Supplier }} </td>
                            <td>{{pengadaan.Nama_Sales}} </td>
                            <td>{{pengadaan.Tanggal_Pengadaan}} </td>
                            <td>{{pengadaan.Total_Harga}}</td>
                            <td v-if="pengadaan.Status_Pengadaan==1">
                                Sudah Dipesan
                            </td>
                            <td v-if="pengadaan.Status_Pengadaan==2">
                                Sudah Dicetak
                            </td>
                            <td v-if="pengadaan.Status_Pengadaan==3">
                                Sudah Datang
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <button class="btn btn-primary" @click="datapengadaanhandler(pengadaan)" 
                                    data-title="Edit_Pengadaan" data-toggle="modal" data-target="#Edit_Pengadaan">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button @click="datapengadaanhandler(pengadaan)" class="btn btn-danger" 
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
                                :value="supplier.Id_Supplier">{{supplier.Nama_Supplier}} - {{supplier.Nama_Sales}} </option>
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
                                    <!-- <tr v-bind:key="sparepart['Kode_Sparepart']" v-for="sparepart in filteredsparepart"> -->
                                        <!-- <div class="list-group mr-2" v-for="motor in motorcycletypes" :key="motor.Id_Motor"> -->
                                    <div class="list-group mr-2" v-for="spareparts in sparepartdata" :key="spareparts['Kode_Sparepart']">
                                        <a href="#" class="list-group-item list-group-item-action list-group-item-success">
                                            {{spareparts.Kode_Sparepart + '-' + spareparts.Nama_Sparepart}}          
                                            <button type="submit" class="btn btn-danger" style="margin-left: 200px"
                                            @click="deleteList(spareparts.Kode_Sparepart)">Delete</button>
                                            <br>     
                                        </a>
                                    </div>
                                    <!-- </tr> -->
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
        
        <!-- END OF MY MODALS -->
    </body>
</template>
<script>
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
        // Pengadaan:[],
        Id_Supplier:'',
        Tanggal_Pengadaan:'',
        Total_Harga:'',
        Status_Pengadaan:'',
        index:'',
        err: '',
        Pengadaan:{
            Id_Supplier:'Pilih Supplier',
            Tanggal_Pengadaan:'',
            Total_Harga:'',
            Status_Pengadaan:'1',
        },
        Cari_Pengadaan:'',
        Sparepart:{
            Kode_Sparepart:'',
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
        temp:{
            Id_Pengadaan:'2',
            Kode_Sparepart:'',
            Harga_Satuan:'',
            Jumlah:'',
            Subtotal_Pengadaan:'',
        }
    }),
    mounted(){
        this.getallpengadaan(),
        this.getallsupplier(),
        this.getallsparepart()
    },
    methods:{
        getSelectedIndex(){
            this.index = this.sparepart.map(function(e) { return e.Kode_Sparepart; }).indexOf(this.Sparepart.Kode_Sparepart)
            console.log(this.index)
        },
        sparepartHandler(sparepart){
            var object = sparepart[this.index]
            console.log(object);
            this.temp.Kode_Sparepart    = this.Sparepart.Kode_Sparepart;
            this.temp.Harga_Satuan      = this.Sparepart.Harga_Beli;
            this.temp.Jumlah            = this.Sparepart.Jumlah_Sparepart;
            this.temp.Subtotal_Pengadaan= this.Sparepart.Harga_Beli * this.Sparepart.Jumlah_Sparepart;
            this.sparepartdata.push(JSON.parse(JSON.stringify(this.temp)))
            this.sparepartData.push(this.Sparepart.Kode_Sparepart)
        },
        deleteList(id)
        {
            let filter = this.sparepart.filter(function( obj ) {
                return obj.Kode_Sparepart !== id;
            });
            this.sparepart=filter
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
        async addpengadaan () {
            try {
                const payload = {
                    Id_Supplier         : this.Pengadaan.Id_Supplier,
                    Tanggal_Pengadaan   : this.Pengadaan.Tanggal_Pengadaan,
                    Total_Harga         : 15000,
                    Status_Pengadaan    : '1',
                    Detail_Pengadaan    : this.sparepartdata,
                }
                console.log(payload);
                await Controller.addpengadaan(payload)
                this.getallpengadaan()
            } catch (err) {
                console.log(err)
            }
        },
        datapengadaanhandler(pengadaan){
            this.Pengadaan = pengadaan;
        },
        refresh(){
            this.Pengadaan.Id_Supplier      ='Pilih Supplier';
            this.Pengadaan.Tanggal_Pengadaan='';
            this.Pengadaan.Total_Harga      ='';
            this.Pengadaan.Status_Pengadaan ='1';
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
        }
    }
}
</script>