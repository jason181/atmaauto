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
                            <th scope="col">Id</th>
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
    </body>
</template>
