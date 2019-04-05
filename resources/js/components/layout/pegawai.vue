<template>
    <body>
        <div class="container-fluid mt-3">
            <div class="clearfix my-2">
                <button class="btn btn-success float-left mb-2" data-title="Tambah_Pegawai" data-toggle="modal" data-target="#Tambah_Pegawai">
                    <i class="fas fa-plus mr-2"></i>Tambah
                </button>
                <div class="navbar navbar-light bg-light float-right p-0">
				  	<form class="form-inline">
				    	<input class="form-control mr-sm-2" type="search" v-model="Cari_Pegawai" placeholder="Search" aria-label="Search">
				    	<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
				  	</form>
				</div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <!-- <th scope="col">Id</th> -->
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Telepon</th>
                            <th scope="col">Cabang</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Gaji</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-bind:key="pegawai['id']" v-for="pegawai in filteredpegawai">
                            <td>{{pegawai.Nama_Pegawai }} </td>
                            <td>{{pegawai.Alamat_Pegawai}} </td>
                            <td>{{pegawai.Telepon_Pegawai}} </td>
                            <td>{{pegawai.Nama_Cabang}}</td>
                            <td>{{pegawai.Nama_Role}} </td>     
                            <td>{{pegawai.Gaji_Pegawai}} </td>
                            <td>{{pegawai.Username}} </td>
                            <td>{{pegawai.Password}} </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <button class="btn btn-primary" @click="updatehandler(jasa)" data-id=(jasa.id) data-title="Edit_Jasa_Service" data-toggle="modal" data-target="#Edit_Jasa_Service">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button @click="deletepegawai(jasa.id)" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </p>
                            </td>
                        </tr>
                        <!-- <?php  
                        $query="SELECT * FROM pegawais JOIN cabangs USING(Id_Cabang) JOIN roles USING(Id_Role)";
                        $result=mysqli_query($conn,$query);
                        while($data = mysqli_fetch_assoc($result))
                        {
                            echo '
                                <tr>
                                    <th scope="row" class="text-center">PEG-'.$data["Id_Pegawai"].'</th>
                                    <td>'.$data["Nama_Pegawai"].'</td>
                                    <td>'.$data["Alamat"].'</td>
                                    <td>'.$data["Telepon_Pegawai"].'</td>
                                    <td>'.$data["Nama_Cabang"].'</td>
                                    <td>'.$data["Nama_Role"].'</td>
                                    <td>'.$data["Gaji_Pegawai"].'</td>
                                    <td>'.$data["Username"].'</td>
                                    <td>'.$data["Password"].'</td>
                                    <td class="text-center">
                                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                                            <button class="btn btn-primary" data-id="'.$data["Id_Pegawai"].'" data-title="Edit_Pegawai" data-toggle="modal" data-target="#Edit_Pegawai" >
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p data-placement="top" data-toggle="tooltip" title="Delete">
                                            <button class="btn btn-danger" data-id="'.$data["Id_Pegawai"].'" data-title="Delete_Pegawai" data-toggle="modal" data-target="#Delete_Pegawai">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </p>
                                    </td>
                                </tr>
                            ';
                        }
                        ?> -->
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="Tambah_Pegawai" tabindex="-1" role="dialog" aria-labelledby="Tambah_Pegawai" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Tambah Pegawai</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addpegawai()">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Nama</span>
                            </div>
                                <input type="text" class="form-control" v-model="Nama_Pegawai" placeholder="Masukkan Nama Pegawai" aria-label="Nama_Pegawai" aria-describedby="basic-addon2" id="Nama_Pegawai" name="Nama_Pegawai">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Alamat</span>
                                </div>
                                <input type="text" class="form-control" v-model="Alamat_Pegawai" placeholder="Masukkan Alamat Pegawai" aria-label="Nama_Lengkap" aria-describedby="basic-addon2" id="Alamat" name="Alamat">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Telepon</span>
                                </div>
                                <input type="text" class="form-control" v-model="Telepon_Pegawai" placeholder="Masukkan Nomor Telepon Pegawai" aria-label="Telepon_Pegawai" aria-describedby="basic-addon2" id="Telepon_Pegawai" name="Telepon_Pegawai">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Gaji</span>
                                </div>
                                <input type="text" class="form-control" v-model="Gaji_Pegawai" placeholder="Masukkan Gaji" aria-label="Gaji_Pegawai" aria-describedby="basic-addon2" id="Gaji_Pegawai" name="Gaji_Pegawai">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Username</span>
                                </div>
                                <input type="text" class="form-control" v-model="Username" placeholder="Masukkan Username" aria-label="Username" aria-describedby="basic-addon2" id="Username" name="Username">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Password</span>
                                </div>
                                <input type="text" class="form-control" v-model="Password" placeholder="Masukkan Password" aria-label="Password" aria-describedby="basic-addon2" id="Password" name="Password">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Cabang</span>
                                </div>
                                <select class="form-control" v-model="Id_Cabang">
                                    <option disabled="disabled" selected="selected">-- Pilih Cabang --</option>
                                    <option v-bind:key="cabang['Id_Cabang']" v-for="cabang in cabangdata" :value="cabang.Id_Cabang">{{cabang.Nama_Cabang}} </option>
                                </select>
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Jabatan</span>
                                </div>
                                <select class="form-control" v-model="Id_Role">
                                    <option disabled="disabled" selected="selected">-- Pilih Jabatan --</option>
                                    <option v-bind:key="role['Id_Role']" v-for="role in roledata" :value="role.Id_Role">{{role.Nama_Role}} </option>
                                </select>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-success btn-lg" style="width: 100%;">Tambahkan Pegawai</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</template>
<script>
import Controller from '../../httpController'
export default {
    data:()=>({
        pegawaidata:[],
        cabangdata:[],
        roledata:[],
        handledpegawai:[],
        Id_Cabang:0,
        Id_Role:0,
        Nama_Pegawai:'',
        Alamat_Pegawai:'',
        Telepon_Pegawai:'',
        Gaji_Pegawai:0,
        Username:'',
        Password:'',
        Cari_Pegawai:'',
    }),
    mounted(){
        this.getallpegawai(),
        this.getallcabang(),
        this.getallrole()
    },
    methods:{
        async getallpegawai () {
            try {
                this.pegawaidata = (await Controller.getallpegawai()).data
                console.log(this.pegawaidata)
            } catch (err) {
                console.log(err)
            }
        },
        async getallcabang () {
            try {
                this.cabangdata = (await Controller.getallcabang()).data
                console.log(this.cabangdata)
            } catch (err) {
                console.log(err)
            }
        },
        async getallrole () {
            try {
                this.roledata = (await Controller.getallrole()).data
                console.log(this.roledata)
            } catch (err) {
                console.log(err)
            }
        },
        async addpegawai () {
            try {
                const payload = {
                    Id_Cabang           : this.Id_Cabang,
                    Id_Role             : this.Id_Role,
                    Nama_Pegawai        : this.Nama_Pegawai,
                    Alamat_Pegawai      : this.Alamat_Pegawai,
                    Telepon_Pegawai     : this.Telepon_Pegawai,
                    Gaji_Pegawai        : this.Gaji_Pegawai,
                    Username            : this.Username,
                    Password            : this.Password,
                }
                await Controller.addpegawai(payload)
                this.getallpegawai()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
    },
    computed:{
        filteredpegawai:function(){
            return this.pegawaidata.filter((pegawai)=>{
                return pegawai.Nama_Pegawai.match(this.Cari_Pegawai);
            });
        }
    }

}
</script>
