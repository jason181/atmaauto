<template>
    <body>
        <div class="container-fluid mt-3" style="">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <div class="row ml-1">
                        <div class="col-sm-4 p-0">
                            
                        </div>
                        <div class="col-sm-9">
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">

                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input class="form-control" v-model="Kode_Sparepart" type="search" placeholder="Cari Sparepart">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="table-responsive" style="margin: auto;">
                        <table class="table table-striped table-hover">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr v-bind:key="index" v-for="(sparepart,index) in filteredsparepart"> -->
                                <tr v-bind:key="input['Kode_Sparepart']" v-for="input in filteredinput">
                                    <td>{{input.Tanggal_Pengadaan}} </td>
                                    <td>{{input.Nama_Sparepart}} </td>
                                    <td>{{input.Jumlah}} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="table-responsive" style="margin: auto;">
                        <table class="table table-striped table-hover">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr v-bind:key="index" v-for="(sparepart,index) in filteredsparepart"> -->
                                <tr v-bind:key="output['Kode_Sparepart']" v-for="output in filteredoutput">
                                    <td>{{output.Tanggal_Transaksi}} </td>
                                    <td>{{output.Nama_Sparepart}} </td>
                                    <td>{{output.Jumlah}} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </body>
</template>

<script>
import Controller from '../../service/Sparepart'

export default {
    data: () => ({
        inputdata:[],
        outputdata:[],
        Kode_Sparepart:'',
    }),
    mounted(){
        this.getallinput()
        this.getalloutput()
    },
    methods:{
        async getallinput () {
            try {
                this.inputdata = (await Controller.getallinput()).data
                console.log(this.inputdata)
            } catch (err) {
                console.log(err)
            }
        },
        async getalloutput () {
            try {
                this.outputdata = (await Controller.getalloutput()).data
                console.log(this.outputdata)
            } catch (err) {
                console.log(err)
            }
        },
    },
    computed:{
        filteredinput:function(){
            return this.inputdata.filter((sparepart)=>{
                return  sparepart.Nama_Sparepart.toLowerCase().match(this.Kode_Sparepart.toLowerCase())
            });
        },
        filteredoutput:function(){
            return this.outputdata.filter((sparepart)=>{
                return  sparepart.Nama_Sparepart.toLowerCase().match(this.Kode_Sparepart.toLowerCase())
            });
        },
    }

}
</script>
