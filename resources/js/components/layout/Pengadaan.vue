<template>
    <body>
        <div class="container-fluid mt-3">
            <div class="row mb-2">
                <div class="col-lg-2">
                    <div class="col-lg-7 p-0">
                        <button class="btn btn-success mb-2 btn-block" @click="getallpengadaan(),refresh()" data-title="Tambah_Pengadaan" data-toggle="modal" data-target="#Tambah_Pengadaan">
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
                        <input class="form-control" v-model="Cari_Pengadaan" type="search" placeholder="Cari Transaksi Pengadaan">
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
                        <tr v-bind:key="pengadaan['id']" v-for="pengadaan in pengadaandata">
                            <td>{{pengadaan.Nama_Supplier }} </td>
                            <td>{{pengadaan.Nama_Sales}} </td>
                            <td>{{pengadaan.Tanggal_Pengadaan}} </td>
                            <td>{{pengadaan.Total_Harga}}</td>
                            <td>{{pengadaan.Status_Pengadaan}} </td>     
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <button class="btn btn-primary" @click="datapengadaanhandler(pengadaan)" data-title="Edit_Pengadaan" data-toggle="modal" data-target="#Edit_Pengadaan">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button @click="datapengadaanhandler(pengadaan)" class="btn btn-danger" data-title="Delete_Pengadaan" data-toggle="modal" data-target="#Delete_Pengadaan">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </p>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</template>
<script>
import Controller from '../../service/Pengadaan'

export default {
    data:()=>({
        pengadaandata:[],
        Pengadaan:[],
        Id_Supplier:'',
        Id_Sales:'',
        Tanggal_Pengadaan:'',
        Total_Harga:'',
        Status_Pengadaan:'',
        Pengadaan:{
            Id_Supplier:'',
            Id_Sales:'',
            Tanggal_Pengadaan:'',
            Total_Harga:'',
            Status_Pengadaan:'',
        },
        Cari_Pengadaan:'',
    }),
    mounted(){
        this.getallpengadaan()
    },
    methods:{
        async getallpengadaan () {
            try {
                this.pengadaandata = (await Controller.getallpengadaan()).data
                console.log(this.pengadaandata)
            } catch (err) {
                console.log(err)
            }
        },
        datapengadaanhandler(pengadaan){
            this.Pengadaan = pengadaan;
        },
        refresh(){
            this.Pengadaan.Id_Supplier      ='';
            this.Pengadaan.Id_Sales         ='';
            this.Pengadaan.Tanggal_Pengadaan='';
            this.Pengadaan.Total_Harga      ='';
            this.Pengadaan.Status_Pengadaan ='';
        }
    },
    computed:{
        filteredpengadaan:function(){
            return this.pengadaandata.filter((pengadaan)=>{
                return pengadaan.Nama_Supplier.toLowerCase().match(this.Cari_Pengadaan.toLowerCase());
            });
        },
    }

}
</script>
