<template>
    <body>
        <div class="container-fluid mt-3">
            <div class="clearfix my-2">
                <button class="btn btn-success float-left mb-2" data-title="Tambah_Pegawai" data-toggle="modal" data-target="#Tambah_Pegawai">
                    <i class="fas fa-plus mr-2"></i>Tambah
                </button>
                <div class="navbar navbar-light bg-light float-right p-0">
				  	<form class="form-inline">
				    	<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
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
                        <tr v-bind:key="pegawai['id']" v-for="pegawai in pegawaidata">
                            <td>{{pegawai.Nama_Pegawai }} </td>
                            <td>{{pegawai.Alamat_Pegawai}} </td>
                            <td>{{pegawai.Telepon_Pegawai}} </td>
                            <td>Cabang</td>
                            <td>Jabatan</td>     
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
                        <form action="pegawai.php" method="POST">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Nama</span>
                            </div>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Pegawai" aria-label="Nama_Pegawai" aria-describedby="basic-addon2" id="Nama_Pegawai" name="Nama_Pegawai">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Alamat</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Masukkan Alamat" aria-label="Nama_Lengkap" aria-describedby="basic-addon2" id="Alamat" name="Alamat">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Telepon</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Masukkan Nomor Telepon" aria-label="Telepon_Pegawai" aria-describedby="basic-addon2" id="Telepon_Pegawai" name="Telepon_Pegawai">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Email</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Masukkan Gaji" aria-label="Gaji_Pegawai" aria-describedby="basic-addon2" id="Gaji_Pegawai" name="Gaji_Pegawai">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Username</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Masukkan Username" aria-label="Username" aria-describedby="basic-addon2" id="Username" name="Username">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Password</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Masukkan Password" aria-label="Password" aria-describedby="basic-addon2" id="Password" name="Password">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Cabang</span>
                                </div>
                                <select class="form-control">
                                    <option disabled="disabled" selected="selected">-- Pilih Cabang --</option>
                                    <option>CABANG 1</option>
                                    <option>CABANG 2</option>
                                </select>
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Jabatan</span>
                                </div>
                                <select class="form-control">
                                    <option disabled="disabled" selected="selected">-- Pilih Jabatan --</option>
                                    <option>Jabatan 1</option>
                                    <option>Jabatan 2</option>
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
        editedegawai:[],
        Nama_Pegawai:'',
        Alamat_Pegawai:'',
        Telepon_Pegawai:'',
        Gaji_Pegawai:0,
        Username:'',
        Password:'',
    }),
    mounted(){
        this.getallpegawai()
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
    }

}
</script>
