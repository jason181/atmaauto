<template>
    <body>
        <div class="container w-50 my-5">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <a href="#"  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" style="font-size:18px;">
                                    Laporan Serta Grafik Pendapatan Bulanan
                                </button>
                            </h5>
                        </div>
                    </a>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend d-block" style="width: 75px;">
                                            <span class="input-group-text" id="basic-addon2">Tahun</span>
                                        </div>
                                        <select class="form-control" require v-model="TahunPendapatan">
                                            <option value="2018" selected>2018</option>
                                            <option value="2019">2019</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success" style="float:right;" @click="laporanpendapatanbulananhandler(TahunPendapatan)">
                                        <i class="far fa-file-pdf"></i> PRINT
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <a href="#"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" style="font-size:18px;">
                                    Laporan Serta Grafik Pengeluaran Bulanan
                                </button>
                            </h5>
                        </div>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend d-block" style="width: 75px;">
                                            <span class="input-group-text" id="basic-addon2">Tahun</span>
                                        </div>
                                        <select class="form-control" require v-model="TahunPengeluaran">
                                            <option value="2018" selected>2018</option>
                                            <option value="2019">2019</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success" style="float:right;" @click="laporanpengeluaranbulananhandler(TahunPengeluaran)">
                                        <i class="far fa-file-pdf"></i> PRINT
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <a href="#"  data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" style="font-size:18px;">
                                    Laporan Serta Grafik Sisa Stok Bulanan
                                </button>
                            </h5>
                        </div>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend d-block" style="width: 75px;">
                                            <span class="input-group-text" id="basic-addon2">Tahun</span>
                                        </div>
                                        <select class="form-control" require v-model="TahunSisaStok">
                                            <option value="2018" selected>2018</option>
                                            <option value="2019">2019</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend d-block" style="width: 75px;">
                                            <span class="input-group-text" id="basic-addon2">Tipe</span>
                                        </div>
                                        <select class="form-control" require v-model="TipeSisaStok">
                                            <option value="Sparepart Motor" selected>Motor</option>
                                            <option value="Sparepart Kelistrikan">Kelistrikan</option>
                                            <option value="Sparepart Apa">Apa</option>
                                            <option value="Sparepart Soal">Soal</option>
                                            <option value="Test Sparepart">Test</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success" style="float:right;" @click="laporansisastokhandler(TahunSisaStok,TipeSisaStok)">
                                        <i class="far fa-file-pdf"></i> PRINT
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <a href="#"  data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" style="font-size:18px;">
                                    Laporan Serta Grafik Jumlah Penjualan Terbanyak Bulanan
                                </button>
                            </h5>
                        </div>
                    </a>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend d-block" style="width: 75px;">
                                            <span class="input-group-text" id="basic-addon2">Tahun</span>
                                        </div>
                                        <select class="form-control" require v-model="TahunPenjualanTerbanyak">
                                            <option value="2018" selected>2018</option>
                                            <option value="2019">2019</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success" style="float:right;" @click="laporanpenjualanterbanyakhandler(TahunPenjualanTerbanyak)">
                                        <i class="far fa-file-pdf"></i> PRINT
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <a href="#"  data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" style="font-size:18px;">
                                    Laporan Serta Grafik Pendapatan Cabang Tahunan
                                </button>
                            </h5>
                        </div>
                    </a>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                   
                                </div>
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success" style="float:right;" @click="laporanpendapatancabangtahunan()">
                                        <i class="far fa-file-pdf"></i> PRINT
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <a href="#"  data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        <div class="card-header" id="headingSix">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" style="font-size:18px;">
                                    Laporan Serta Grafik Penjualan Jasa
                                </button>
                            </h5>
                        </div>
                    </a>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend d-block" style="width: 75px;">
                                            <span class="input-group-text" id="basic-addon2">Bulan</span>
                                        </div>
                                        <select class="form-control" require v-model="BulanPenjualanJasa">
                                            <option value="January" selected>Januari</option>
                                            <option value="February">Februari</option>
                                            <option value="March">Maret</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend d-block" style="width: 75px;">
                                            <span class="input-group-text" id="basic-addon2">Tahun</span>
                                        </div>
                                        <select class="form-control" require v-model="TahunPenjualanJasa">
                                            <option value="2018" selected>2018</option>
                                            <option value="2019">2019</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success" style="float:right;" @click="laporanpenjualanjasahandler(BulanPenjualanJasa,TahunPenjualanJasa)">
                                        <i class="far fa-file-pdf"></i> PRINT
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</template>

<script>
import Controller from '../../service/Laporan'
import Http from '../../service/Http'

var app = new Vue({
  el: '#appl',
  data: function() {
    return {
      
    }
  }
});

export default {
    data:() => ({
        TahunPendapatan:'',
        TahunPengeluaran:'',
        TahunSisaStok:'',
        TipeSisaStok:'',
        TahunPenjualanTerbanyak:'',
        BulanPenjualanJasa:'',
        TahunPenjualanJasa:'',
        tampung:[],

        options: {
            chart: {
                id: 'vuechart-example'
            },
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
            }
        },
        series: [{
            name: 'series-1',
            data: [30, 40, 45, 50, 49, 60, 70, 91]
        }]
    }),
    // created(){
    //     this.laporanpendapatanbulanan();
    // },
    methods:{
        async Print(){
            window.print()
        },
        async laporanpendapatanbulanan(TahunPendapatan) {
            try {
                //await Http.download('/api/pendapatan_bulanan/'+TahunPendapatan);
                await Http.download('/api/pendapatan_bulanan/'+TahunPendapatan);
                window.open()
                this.laporan = this.tampung.data;
                console.log(this.laporan);
            } catch (err) {
                console.log(err)
            }
        },
        laporanpendapatanbulananhandler(TahunPendapatan)
        {
            this.TahunPendapatan=TahunPendapatan;
            this.laporanpendapatanbulanan(this.TahunPendapatan);
        },
        async laporanpengeluaranbulanan(TahunPengeluaran)
        {
            try{
                await Http.download('/api/pengeluaran_bulanan/'+TahunPengeluaran);
            } catch (err) {
                console.log(err)
            }
        },
        laporanpengeluaranbulananhandler(TahunPengeluaran)
        {
            this.TahunPengeluaran=TahunPengeluaran;
            this.laporanpengeluaranbulanan(this.TahunPengeluaran);
        },
        async laporansisastok(TahunSisaStok,TipeSisaStok)
        {
            try{
                await Http.download('/api/sisa_stok/'+TahunSisaStok+'/"'+TipeSisaStok+'"');
            } catch (err) {
                console.log(err)
            }
        },
        laporansisastokhandler(TahunSisaStok,TipeSisaStok)
        {
            this.TahunSisaStok=TahunSisaStok;
            this.TipeSisaStok=TipeSisaStok;
            this.laporansisastok(this.TahunSisaStok,this.TipeSisaStok);
        },
        async laporanpenjualanterbanyak(TahunPenjualanTerbanyak)
        {
            try{
                await Http.download('/api/sparepart_terlaris/'+TahunPenjualanTerbanyak);
            } catch (err) {
                console.log(err)
            }
        },
        laporanpenjualanterbanyakhandler(TahunPenjualanTerbanyak)
        {
            this.TahunPenjualanTerbanyak = TahunPenjualanTerbanyak;
            this.laporanpenjualanterbanyak(this.TahunPenjualanTerbanyak);
        },
        async laporanpendapatancabangtahunan()
        {
            try{
                await Http.download('/api/pedapatan_tahunan');
            }catch(err)
            {
                console.log(err)
            }
        },
        async laporanpenjualanjasa(BulanPenjualanJasa,TahunPenjualanJasa)
        {
            try{
                await Http.download('/api/penjualan_jasa/'+TahunPenjualanJasa+'/"'+BulanPenjualanJasa+'"');
            } catch (err) {
                console.log(err)
            }
        },
        laporanpenjualanjasahandler(BulanPenjualanJasa,TahunPenjualanJasa)
        {
            this.BulanPenjualanJasa=BulanPenjualanJasa;
            this.TahunPenjualanJasa=TahunPenjualanJasa;
            this.laporanpenjualanjasa(this.BulanPenjualanJasa,this.TahunPenjualanJasa);
        }
    }
}
</script>
