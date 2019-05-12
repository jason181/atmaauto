
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