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
                                    <button class="btn btn-primary" @click="datapegawaihandler(pegawai)" data-title="Edit_Pegawai" data-toggle="modal" data-target="#Edit_Pegawai">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button @click="datapegawaihandler(pegawai)" class="btn btn-danger" data-title="Delete_Pegawai" data-toggle="modal" data-target="#Delete_Pegawai">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </p>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <!-- MY MODALS -->
        <!-- TAMBAH PEGAWAI -->
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
                            <div class="input-group">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Nama</span>
                                </div>
                                <input type="text" class="form-control" v-model="pegawai.Nama_Pegawai" placeholder="Masukkan Nama Pegawai" aria-label="Nama_Pegawai" aria-describedby="basic-addon2" id="Nama_Pegawai" name="Nama_Pegawai" @input="$v.pegawai.Nama_Pegawai.$touch()" @blur="$v.pegawai.Nama_Pegawai.$touch()" required>
                            </div>
                            <div class="text-center">
                                <p class="mb-3" style="color:red;" v-if="$v.pegawai.Nama_Pegawai.$invalid">{{nameErrors[0]}}</p>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Alamat</span>
                                </div>
                                <input type="text" class="form-control" v-model="pegawai.Alamat_Pegawai" placeholder="Masukkan Alamat Pegawai" aria-label="Nama_Lengkap" aria-describedby="basic-addon2" id="Alamat_Pegawai" name="Alamat_Pegawai" @input="$v.pegawai.Alamat_Pegawai.$touch()" @blur="$v.pegawai.Alamat_Pegawai.$touch()" required>
                            </div>
                            <div class="text-center">
                                <p class="mb-3" style="color:red;" v-if="$v.pegawai.Alamat_Pegawai.$invalid">{{addressErrors[0]}}</p>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Telepon</span>
                                </div>
                                <input type="text" class="form-control" v-model="pegawai.Telepon_Pegawai" placeholder="Masukkan Nomor Telepon Pegawai" aria-label="Telepon_Pegawai" aria-describedby="basic-addon2" id="Telepon_Pegawai" name="Telepon_Pegawai" @input="$v.pegawai.Telepon_Pegawai.$touch()" @blur="$v.pegawai.Telepon_Pegawai.$touch()" require>
                            </div>
                            <div class="text-center">
                                <p class="mb-3" style="color:red;" v-if="$v.pegawai.Telepon_Pegawai.$invalid">{{phoneErrors[0]}}</p>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Gaji</span>
                                </div>
                                <input type="text" class="form-control" v-model="pegawai.Gaji_Pegawai" placeholder="Masukkan Gaji" aria-label="Gaji_Pegawai" aria-describedby="basic-addon2" id="Gaji_Pegawai" name="Gaji_Pegawai" @input="$v.pegawai.Gaji_Pegawai.$touch()" @blur="$v.pegawai.Gaji_Pegawai.$touch()" require>
                            </div>
                            <div class="text-center">
                                <p class="mb-3" style="color:red;" v-if="$v.pegawai.Gaji_Pegawai.$invalid">{{salaryErrors[0]}}</p>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Username</span>
                                </div>
                                <input type="text" class="form-control" v-model="pegawai.Username" placeholder="Masukkan Username" aria-label="Username" aria-describedby="basic-addon2" id="Username" name="Username" @input="$v.pegawai.Username.$touch()" @blur="$v.pegawai.Username.$touch()" require>
                            </div>
                            <div class="text-center">
                                <p class="mb-3" style="color:red;" v-if="$v.pegawai.Username.$invalid">{{usernameErrors[0]}}</p>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Password</span>
                                </div>
                                <input type="password" class="form-control" v-model="pegawai.Password" placeholder="Masukkan Password" aria-label="Password" aria-describedby="basic-addon2" id="Password" name="Password" @input="$v.pegawai.Password.$touch()" @blur="$v.pegawai.Password.$touch()" require>
                            </div>
                            <div class="text-center">
                                <p class="mb-3" style="color:red;" v-if="$v.pegawai.Password.$invalid">{{passwordErrors[0]}}</p>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Cabang</span>
                                </div>
                                <select class="form-control" v-model="pegawai.Id_Cabang" @input="$v.pegawai.Id_Cabang.$touch()" @blur="$v.pegawai.Id_Cabang.$touch()" require>
                                    <option disabled="disabled" selected="selected">-- Pilih Cabang --</option>
                                    <option v-bind:key="cabang['Id_Cabang']" v-for="cabang in cabangdata" :value="cabang.Id_Cabang">{{cabang.Nama_Cabang}} </option>
                                </select>
                            </div>
                            <div class="text-center">
                                <p class="mb-3" style="color:red;" v-if="$v.pegawai.Id_Cabang.$invalid">{{cabangErrors[0]}}</p>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Jabatan</span>
                                </div>
                                <select class="form-control" v-model="pegawai.Id_Role" @input="$v.pegawai.Id_Role.$touch()" @blur="$v.pegawai.Id_Role.$touch()" require>
                                    <option disabled="disabled" selected="selected">-- Pilih Jabatan --</option>
                                    <option v-bind:key="role['Id_Role']" v-for="role in roledata" :value="role.Id_Role">{{role.Nama_Role}} </option>
                                </select>
                            </div>
                            <div class="text-center">
                                <p class="mb-3" style="color:red;" v-if="$v.pegawai.Id_Role.$invalid">{{roleErrors[0]}}</p>
                            </div>
                            <div class="modal-footer mt-3">
                                <button type="submit" class="btn btn-success btn-lg" style="width: 100%;" :disabled="$v.pegawai.$invalid">Tambahkan Pegawai</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF TAMBAH PEGAWAI -->
        <!-- EDIT PEGAWAI -->
        <div class="modal fade" id="Edit_Pegawai" tabindex="-1" role="dialog" aria-labelledby="Edit_Pegawai" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Edit Pegawai</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updatepegawai(handledpegawai.Id_Pegawai)">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Nama</span>
                            </div>
                                <input type="text" class="form-control" v-model="handledpegawai.Nama_Pegawai" placeholder="Masukkan Nama Pegawai" aria-label="Nama_Pegawai" aria-describedby="basic-addon2" id="Nama_Pegawai" name="Nama_Pegawai">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Alamat</span>
                                </div>
                                <input type="text" class="form-control" v-model="handledpegawai.Alamat_Pegawai" placeholder="Masukkan Alamat Pegawai" aria-label="Nama_Lengkap" aria-describedby="basic-addon2" id="Alamat" name="Alamat">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Telepon</span>
                                </div>
                                <input type="text" class="form-control" v-model="handledpegawai.Telepon_Pegawai" placeholder="Masukkan Nomor Telepon Pegawai" aria-label="Telepon_Pegawai" aria-describedby="basic-addon2" id="Telepon_Pegawai" name="Telepon_Pegawai">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Gaji</span>
                                </div>
                                <input type="text" class="form-control" v-model="handledpegawai.Gaji_Pegawai" placeholder="Masukkan Gaji" aria-label="Gaji_Pegawai" aria-describedby="basic-addon2" id="Gaji_Pegawai" name="Gaji_Pegawai">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Username</span>
                                </div>
                                <input type="text" class="form-control" v-model="handledpegawai.Username" placeholder="Masukkan Username" aria-label="Username" aria-describedby="basic-addon2" id="Username" name="Username">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Password</span>
                                </div>
                                <input type="text" class="form-control" v-model="handledpegawai.Password" placeholder="Masukkan Password" aria-label="Password" aria-describedby="basic-addon2" id="Password" name="Password">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Cabang</span>
                                </div>
                                <select class="form-control" v-model="handledpegawai.Id_Cabang">
                                    <option disabled="disabled" selected="selected">-- Pilih Cabang --</option>
                                    <option v-bind:key="cabang['Id_Cabang']" v-for="cabang in cabangdata" :value="cabang.Id_Cabang">{{cabang.Nama_Cabang}} </option>
                                </select>
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend d-block" style="width: 100px;">
                                    <span class="input-group-text" id="basic-addon2">Jabatan</span>
                                </div>
                                <select class="form-control" v-model="handledpegawai.Id_Role">
                                    <option disabled="disabled" selected="selected">-- Pilih Jabatan --</option>
                                    <option v-bind:key="role['Id_Role']" v-for="role in roledata" :value="role.Id_Role">{{role.Nama_Role}} </option>
                                </select>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF EDIT PEGAWAI -->
        <!-- DELETE PEGAWAI -->
        <div class="modal fade" id="Delete_Pegawai" tabindex="-1" role="dialog" aria-labelledby="Delete_Pegawai" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Hapus Data Pegawai</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda Yakin Ingin Menghapus Data Pegawai Ini ?</div>
                    </div>
                    <div class="modal-footer ">
                        <a id="delete_btn" class="float-left w-100">
                            <button type="button" @click="deletepegawai(handledpegawai.Id_Pegawai)" class="btn btn-danger float-left w-50" data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span>Ya</button>
                        </a>
                        <button type="button" class="btn btn-secondary float-right w-50" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Tidak</button>
                    </div>
                </div>
            </div>
            </div>
        <!-- END OF DELETE JASA SERVICE -->
        <!-- END OF MY MODALS -->
    </body>
</template>
<script>
import Controller from '../../httpController'
import validators from '../../validations/pegawai_validations'

export default {
    validations:validators,
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
        pegawai:{
            Id_Cabang:0,
            Id_Role:0,
            Nama_Pegawai:'',
            Alamat_Pegawai:'',
            Telepon_Pegawai:'',
            Gaji_Pegawai:0,
            Username:'',
            Password:'',
        },
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
                    Id_Cabang           : this.pegawai.Id_Cabang,
                    Id_Role             : this.pegawai.Id_Role,
                    Nama_Pegawai        : this.pegawai.Nama_Pegawai,
                    Alamat_Pegawai      : this.pegawai.Alamat_Pegawai,
                    Telepon_Pegawai     : this.pegawai.Telepon_Pegawai,
                    Gaji_Pegawai        : this.pegawai.Gaji_Pegawai,
                    Username            : this.pegawai.Username,
                    Password            : this.pegawai.Password,
                }
                await Controller.addpegawai(payload)
                this.getallpegawai()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        async updatepegawai (id) {
            try {
                const payload = {
                    Id_Cabang           : this.handledpegawai.Id_Cabang,
                    Id_Role             : this.handledpegawai.Id_Role,
                    Nama_Pegawai        : this.handledpegawai.Nama_Pegawai,
                    Alamat_Pegawai      : this.handledpegawai.Alamat_Pegawai,
                    Telepon_Pegawai     : this.handledpegawai.Telepon_Pegawai,
                    Gaji_Pegawai        : this.handledpegawai.Gaji_Pegawai,
                    Username            : this.handledpegawai.Username,
                    Password            : this.handledpegawai.Password,
                }
                await Controller.updatepegawai(payload,id)
                this.getallpegawai()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        async deletepegawai (id) {
            try {
                await Controller.deletepegawai(id)
                this.getallpegawai()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        datapegawaihandler(pegawai){
            this.handledpegawai = pegawai
        }
    },
    computed:{
        filteredpegawai:function(){
            return this.pegawaidata.filter((pegawai)=>{
                return pegawai.Nama_Pegawai.match(this.Cari_Pegawai);
            });
        },
        cabangErrors(){
            const errors = []
            if(this.$v.pegawai.Id_Cabang.$dirty) return errors
            !this.$v.pegawai.Id_Cabang.required && errors.push('Id cabang is required')
            return errors
        },
        roleErrors(){
            const errors = []
            if(this.$v.pegawai.Id_Role.$dirty) return errors
            !this.$v.pegawai.Id_Role.required && errors.push('Id role is required')
            return errors
        },
        nameErrors(){
            const errors = []
            if (!this.$v.pegawai.Nama_Pegawai.$dirty) return errors
            !this.$v.pegawai.Nama_Pegawai.minLength && errors.push('Name must be at least 5 characters long')
            !this.$v.pegawai.Nama_Pegawai.maxLength && errors.push('Name must be at most 25 characters long')
            !this.$v.pegawai.Nama_Pegawai.required && errors.push('Name is required')
            // !this.$v.pegawai.Nama_Pegawai.alpha && errors.push('Name must be alphabetic')
            return errors
        },
        addressErrors(){
            const errors = []
            if (!this.$v.pegawai.Alamat_Pegawai.$dirty) return errors
            !this.$v.pegawai.Alamat_Pegawai.minLength && errors.push('Address must be at least 5 characters long')
            !this.$v.pegawai.Alamat_Pegawai.maxLength && errors.push('Address must be at most 255 characters long')
            !this.$v.pegawai.Alamat_Pegawai.required && errors.push('Address is required')
            return errors
        },
        phoneErrors(){
            const errors = []
            if (!this.$v.pegawai.Telepon_Pegawai.$dirty) return errors
            !this.$v.pegawai.Telepon_Pegawai.minLength && errors.push('Phone Number must be at least 10 characters long')
            !this.$v.pegawai.Telepon_Pegawai.maxLength && errors.push('Phone Number must be at most 15 characters long')
            !this.$v.pegawai.Telepon_Pegawai.required && errors.push('Phone Number is required')
            !this.$v.pegawai.Telepon_Pegawai.numeric && errors.push('Phone Number must be numeric')
            return errors
        },
        salaryErrors(){
            const errors = []
            if (!this.$v.pegawai.Gaji_Pegawai.$dirty) return errors
            !this.$v.pegawai.Gaji_Pegawai.maxLength && errors.push('Salary must be at most 10 characters long')
            !this.$v.pegawai.Gaji_Pegawai.required && errors.push('Salary is required')
            !this.$v.pegawai.Gaji_Pegawai.numeric && errors.push('Salary must be numeric')
            return errors
        },
        usernameErrors(){
            const errors = []
            if (!this.$v.pegawai.Username.$dirty) return errors
            !this.$v.pegawai.Username.minLength && errors.push('Username must be at least 10 characters long')
            !this.$v.pegawai.Username.maxLength && errors.push('Username must be at most 30 characters long')
            !this.$v.pegawai.Username.required && errors.push('Username is required')
            // !this.$v.pegawai.Username.alphaNum && errors.push('Username must be alphabetic or numeric')
        },
        passwordErrors(){
            const errors = []
            if (!this.$v.pegawai.Password.$dirty) return errors
            !this.$v.pegawai.Password.minLength && errors.push('Password must be at least 10 characters long')
            !this.$v.pegawai.Password.maxLength && errors.push('Password must be at most 30 characters long')
            !this.$v.pegawai.Password.required && errors.push('Password is required')
            return errors
        },
    }

}
</script>
