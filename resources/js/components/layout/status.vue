<template>
<body>
  <div class="card text-center mx-auto mt-5" style="width: 25rem;" v-if="this.toggle == false">
    <div class="card-header">
      <h3 class="card-title m-0">Cek Status</h3>
    </div>
      <div class="card-body">
        <div class="input-group mb-4">
          <div class="input-group-prepend d-block" style="width: 100px;">
            <span class="input-group-text" id="basic-addon2">Telepon</span>
          </div>
          <input type="text" class="form-control" v-model="hp" placeholder="08xx-xxxx-xxxx" aria-label="hp" aria-describedby="basic-addon2" id="hp" name="hp">
        </div>
        <div class="input-group mb-4">
            <div class="input-group-prepend d-block" style="width: 100px;">
                <span class="input-group-text" id="basic-addon2">Plat</span>
            </div>
            <input type="text" class="form-control" v-model="plat" placeholder="XX-XXXX-XX" aria-label="plat" aria-describedby="basic-addon2" id="plat" name="plat">
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-success btn-lg" style="width: 100%;" @click="show(hp,plat)">CHECK</button>
      </div>
  </div>
  <div class="container-fluid mt-3" v-else>
    <div class="row mb-2">
        <div class="col-sm-3">
            <div class="row ml-1">
                <div class="col-sm-5 p-0">
                    <button class="btn btn-primary mb-2 btn-block" @click="show(hp,plat)">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                </div>
                <div class="col-sm-7">
                    <select class="form-control" v-model="Status_Transaksi">
                        <option disabled="disabled" selected="selected" value="">-- Pilih Jenis Transaksi --</option>
                        <option value="0">Ordered</option>
                        <option value="1">Processed</option>
                        <option value="2">Finished</option>
                        <option value="3">Paid</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-6">

        </div>
        <div class="col-sm-3">
            <div class="input-group">
                <input class="form-control" v-model="Cari_Transaksi" type="search" placeholder="Masukkan Kode Jenis Transaksi">
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
                    <th scope="col">Nama Konsumen</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jenis Transaksi</th>
                    <th scope="col">Status Transaksi</th>
                    <th scope="col">Total</th>
                    <th scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr v-bind:key="transaksi['Id_Transaksi']" v-for="transaksi in filteredtransaksi">
                    <td>{{transaksi.Id_Transaksi}}</td>
                    <td>{{transaksi.Nama_Konsumen}} </td>
                    <td>{{transaksi.Tanggal_Transaksi}} </td>
                    <td v-if="transaksi.Jenis_Transaksi == 'SS'">
                        Servis dan Sparepart
                    </td>
                    <td v-if="transaksi.Jenis_Transaksi == 'SV'">
                        Servis
                    </td>
                    <td v-if="transaksi.Jenis_Transaksi == 'SP'">
                        Sparepart
                    </td>
                    <td v-if="transaksi.Status==0">
                        Belum Diproses
                    </td>
                    <td v-if="transaksi.Status==1">
                        Sedang Diproses
                    </td>
                    <td v-if="transaksi.Status==2">
                        Selesai Diproses
                    </td>
                    <td v-if="transaksi.Status==3">
                        Sudah Dibayar
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
                </tr>
            </tbody>
        </table>
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
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-bind:key="detail['id']" v-for="detail in filtereddetailsparepart">
                                  <td>{{detail.Kode_Sparepart }} </td>
                                  <td>{{detail.Harga_Satuan}} </td>
                                  <td>{{detail.Jumlah}} </td>
                                  <td>{{detail.Subtotal_Detail_Sparepart}}</td>
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
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-bind:key="detailjasa['id']" v-for="detailjasa in filtereddetailjasa">
                                  <td>{{detailjasa.Id_Jasa }} </td>
                                  <td>{{detailjasa.Nama_Jasa}} </td>
                                  <td>{{detailjasa.Harga_Jasa}} </td>
                                  <td>{{detailjasa.Subtotal_Detail_Jasa}} </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- END OF TAMPIL DETAIL PENJUALAN SPAREPART -->
</body>
</template>

<script>
import Controller from '../../service/Status'

export default {
  data: () => ({
    transaksidata:[],
    data_detail_sparepart:[],
    data_detail_jasa:[],
    hp:'',
    plat:'',
    toggle:false,
    Status_Transaksi:'',
    Cari_Transaksi:'',
    Cari_Detail_Sparepart:'',
    Cari_Detail_Jasa:'',
    Transaksi:{
      Id_Transaksi:'',
      Id_Konsumen:'',
      Alamat_Konsumen:'',
      Tanggal_Transaksi:'',
      Jenis_Transaksi:'',
      Subtotal:0,
      Diskon:0,
      Total:0,
      Status:0,
    },
    Detail_Sparepart:{
        Id_Jasa_Montir:'',
        Id_Transaksi:'',
        Kode_Sparepart:'',
        Harga_Satuan:'',
        Subtotal_Detail_Sparepart:0,
        Jumlah:0,
        Harga_Satuan:0,
        Nama_Sparepart:'',
    },
    Detail_Jasa:{
        Id_Jasa_Montir:'',
        Id_Transaksi:'',
        Id_Jasa:'',
        Subtotal_Detail_Jasa:0,
        Nama_Jasa:'',
        Harga_Jasa:0,
    },
  }),
  mounted(){
    this.getallpenjualan()
    this.getalldetailsparepart()
    this.getalldetailjasa()
  },
  methods:{
    show(hp,plat){
      this.toggle = !this.toggle
      this.hp = hp
      this.plat = plat
      this.cekStatus(this.hp,this.plat)
    },
    async getallpenjualan () {
        try {
            this.transaksidata = (await Controller.getallpenjualan()).data
            console.log(this.transaksidata)
        } catch (err) {
            console.log(err)
        }
    },
    async getalldetailsparepart () {
        try {
            this.data_detail_sparepart = (await Controller.getalldetailsparepart()).data
            console.log(this.data_detail_sparepart)
        } catch (err) {
            console.log(err)
        }
    },
    async getalldetailjasa () {
        try {
            this.data_detail_jasa = (await Controller.getalldetailjasa()).data
            console.log(this.data_detail_jasa)
        } catch (err) {
            console.log(err)
        }
    },
    async cekStatus(hp,plat)
    {
        try {
          this.transaksidata = (await Controller.cekstatus(hp,plat)).data
          console.log(this.transaksidata)
        } catch (err) {
          console.log(err)
        }
    },
    detailhandler(transaksi){
        this.Transaksi = transaksi
    },
  },
  computed:{
    filteredtransaksi:function(){
        return this.transaksidata.filter((transaksi)=>{
          return transaksi.Jenis_Transaksi.toLowerCase().match(this.Cari_Transaksi.toLowerCase()) &&
            transaksi.Status == this.Status_Transaksi;
        });
    },
    filtereddetailsparepart:function(){
        return this.data_detail_sparepart.filter((detailsparepart)=>{
            return detailsparepart.Nama_Sparepart.toLowerCase().match(this.Cari_Detail_Sparepart.toLowerCase()) &&
            detailsparepart.Id_Transaksi == this.Transaksi.Id_Transaksi;
        });
    },
    filtereddetailjasa:function(){
        return this.data_detail_jasa.filter((detailjasa)=>{
            return detailjasa.Nama_Jasa.toLowerCase().match(this.Cari_Detail_Jasa.toLowerCase()) && 
            detailjasa.Id_Transaksi == this.Transaksi.Id_Transaksi;
        });
    },
  }
}
</script>

