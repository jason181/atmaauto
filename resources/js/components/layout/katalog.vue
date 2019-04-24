<template>
<body>
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-sm-4" v-if="Select1=='Harga dan Stok'">
                <select class="form w-100 form-control" v-model="Select1">
                    <option selected="selected" disabled value="Harga dan Stok"> Harga dan Stok</option>
                    <option value="Harga">Harga</option>
                    <option value="Stok">Stok</option>
                </select>
            </div>
            <div class="col-sm-2" v-if="Select1!='Harga dan Stok'">
                <select class="form w-100 form-control" style="width:250px;" v-model="Select1">
                    <option selected="selected" disabled value="Harga dan Stok"> Harga dan Stok</option>
                    <option value="Harga">Harga</option>
                    <option value="Stok">Stok</option>
                </select>
            </div>
            <div class="col-sm-2" v-if="Select1!='Harga dan Stok'">
                <select class="form form-control w-100" v-model="SelectHarga" v-if="Select1=='Harga'" @click="sort('Harga_Jual',SelectHarga)"  >
                    <option selected disabled value="Pilih Berdasarkan Harga">Pilih Berdasarkan Harga</option>
                    <option value="desc" >Termahal</option>
                    <option value="asc" >Termurah</option>
                </select>
                <select class="form form-control w-100" v-model="SelectStok" v-if="Select1=='Stok'" @click="sort('Jumlah_Sparepart',SelectStok)">
                    <option selected disabled value="Pilih Berdasarkan Harga">Pilih Berdasarkan Harga</option>
                    <option value="desc">Terbanyak</option>
                    <option value="asc">Tersedikit</option>
                </select>
            </div>
            <div class="col-sm-4">
                <input class="form-control mr-sm-2" type="search" v-model="Cari_Sparepart" placeholder="Cari Sparepart..." aria-label="Search">
            </div>
            <div class="col-sm-4">
                Range Harga :
                <input type="range" class="custom-range" min="1000" max="1000000" step="1000" v-model="Price_Range">
                <p style="float:left">Rp.1000</p><p style="float:right">Rp 1000000</p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 mx-auto mb-5" v-bind:key="index" v-for="(sparepart,index) in filteredspareparts">
                <a>
                    <div class="card border-primary mx-auto" style="width: 18rem;">
                        <div class="card-header">
                            <h4 class="card-title mb-0" style="text-align: center;">{{sparepart.Nama_Sparepart}}</h4>
                        </div>
                        <div class="card-body" style="text-align:center;">
                            <img class="card-img-top" :src="'/images/'+sparepart.Gambar" :alt="sparepart.Nama_Sparepart" style="height:250px;width:auto;max-height:250px;max-width:250px;">
                        </div>
                        <div class="card-footer" style="text-align: center;">
                            <p class="card-text mb-2" style="color: black">Rp {{formatPrice(sparepart.Harga_Jual)}}</p>
                            <p class="card-text mb-2" style="color: black">Stok : {{sparepart.Jumlah_Sparepart}} </p>
                            <a href="" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
</body>
</template>

<script>
import Controller from '../../service/Sparepart'
export default {
    data:() => ({
        sparepartdata:[],
        Kode_Sparepart  : '',
        Tipe_Barang     : '',
        Nama_Sparepart  : '',
        Merk_Sparepart  : '',
        Rak_Sparepart   : '',
        Jumlah_Sparepart: 0,
        Stok_Minimum    : 0,
        Harga_Beli      : 0,
        Harga_Jual      : 0,
        Gambar          : '',
        Cari_Sparepart  : '',
        Price_Range     : '',
        Select1         : 'Harga dan Stok',
        SelectHarga     : 'asc',
        SelectStok      : 'desc',
        currentSort     : 'Nama_Sparepart',
        currentSortDir  : 'asc',
    }),
    mounted(){
        this.getallsparepart()
    },
    methods:{
        formatPrice(value) {
            let val = (value/1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        async getallsparepart() {
            try {
                this.sparepartdata = (await Controller.getallsparepart()).data
                console.log(this.sparepartdata)
            } catch (err) {
                console.log(err)
            }
        },
        sort:function(s,dir) {
            //if s == current sort, reverse
            // if(s === this.currentSort) {
            // this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
            // }
            if(dir!='asc' && dir!='desc')
                this.currentSortDir='asc';
            else
                this.currentSortDir = dir;
            this.currentSort = s;
        },
        
    },
    computed:{
        // filteredspareparts:function(){
        //     return this.sparepartdata.filter((sparepart)=>{
        //         return  sparepart.Nama_Sparepart.toLowerCase().match(this.Cari_Sparepart.toLowerCase()) ||
        //                 sparepart.Kode_Sparepart.toLowerCase().match(this.Cari_Sparepart.toLowerCase())  ||
        //                 sparepart.Merk_Sparepart.toLowerCase().match(this.Cari_Sparepart.toLowerCase());
        //     });
        // },
        filteredspareparts:function(){
            return this.sortedSpareparts.filter((sparepart)=>{
                return  sparepart.Nama_Sparepart.toLowerCase().match(this.Cari_Sparepart.toLowerCase()) ||
                        sparepart.Kode_Sparepart.toLowerCase().match(this.Cari_Sparepart.toLowerCase())  ||
                        sparepart.Merk_Sparepart.toLowerCase().match(this.Cari_Sparepart.toLowerCase());
            });
        },
        sortedSpareparts:function() {
            return this.sparepartdata.sort((a,b) => {
            let modifier = 1;
            if(this.currentSortDir === 'desc') modifier = -1;
            if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
            if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
            return 0;
            });
        }
    }
}
</script>