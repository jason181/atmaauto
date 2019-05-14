<template>
    <body>
        <div class="container-fluid mt-3" style="">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <router-link :to="{name:'Sparepart'}" class="breadcrumb-item">
                        <li class="breadcrumb-item">
                            <a>Sparepart</a>
                        </li>
                    </router-link>
                    <li class="breadcrumb-item active" aria-current="page">Stok dibawah minimum</li>
                </ol>
            </nav>
            <!-- <div class="row mb-2">
                <div class="col-sm-2">
                    <div class="col-sm-7 p-0">
                        
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
            </div> -->
            
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
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr v-bind:key="index" v-for="(sparepart,index) in filteredsparepart"> -->
                        <tr v-bind:key="sparepart['Kode_Sparepart']" v-for="sparepart in sparepartdata">
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
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</template>

<script>
import Controller from '../../service/Sparepart'

export default {
    data:() => ({
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
        sparepartdata:[]
    }),
    mounted(){
        this.getallsparepartminimum()
    },
    methods :{
        async getallsparepartminimum () {
            try {
                this.sparepartdata = (await Controller.getallsparepartminimum()).data
                console.log(this.sparepartdata)
            } catch (err) {
                console.log(err)
            }
        },
    }
}
</script>
