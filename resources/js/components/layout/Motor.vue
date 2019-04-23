<template>
    <body>
        <div class="container mt-3" style="max-width: 800px;">
            <div class="row mb-2">
                <div class="col-sm-2">
                    <button class="btn btn-success float-left mb-2 btn-block" 
                    @click="getallmotor(),refresh()" data-title="Tambah_Motor" 
                    data-toggle="modal" data-target="#Tambah_Motor">
                        <i class="fas fa-plus mr-2"></i>Tambah
                    </button>
                </div>
                <div class="col-sm-6">

                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input class="form-control" v-model="Cari_Motor" 
                        type="search" placeholder="Cari Motor">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive" style="max-width: 800px; margin: auto;">
                <table class="table table-striped table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Tipe</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-bind:key="motor['Id_Motor']" v-for="motor in filteredmotor">
                            <td>{{motor.Tipe}} </td>
                            <td>{{motor.Merk}} </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Edit">
                                    <button class="btn btn-primary" @click="datamotorhandler(motor)" 
                                        data-title="Edit_Motor" data-toggle="modal" 
                                        data-target="#Edit_Motor">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </p>
                            </td>
                            <td class="text-center">
                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                    <button class="btn btn-danger" @click="datamotorhandler(motor)" 
                                        data-title="Delete_Motor" 
                                        data-toggle="modal" data-target="#Delete_Motor">
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
        <!-- TAMBAH MOTOR -->
        <div class="modal fade" id="Tambah_Motor" tabindex="-1" role="dialog" 
            aria-labelledby="Tambah_Motor" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Tambah Motor</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                            aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Merk</span>
                            </div>
                            <input type="text" v-model="Motor.Merk" class="form-control" 
                            placeholder="Masukkan Merk Motor" 
                            :error="merkErrors" aria-label="Merk_Motor" 
                            aria-describedby="basic-addon2" 
                            id="Merk_Motor" name="Merk_Motor" 
                            @input="$v.Motor.Merk.$touch()" 
                            @blur="$v.Motor.Merk.$touch()" required>
                        </div>
                        <div class="text-center">
                            <div class="mb-3" style="color:red;" 
                            v-if="$v.Motor.Merk.$invalid">{{merkErrors[0]}}</div>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Tipe</span>
                            </div>
                            <input type="text" v-model="Motor.Tipe" 
                            class="form-control" placeholder="Masukkan Tipe Motor" 
                            aria-label="Motor_Tipe" aria-describedby="basic-addon2" 
                            id="Motor_Tipe" name="Motor_Tipe" 
                            @input="$v.Motor.Tipe.$touch()" 
                            @blur="$v.Motor.Tipe.$touch()" required>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" 
                            v-if="$v.Motor.Tipe.$invalid">{{typeErrors[0]}}</p>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="submit" class="btn btn-success btn-lg w-100" 
                            :disabled="$v.Motor.$invalid" 
                            data-dismiss="modal" @click="addmotor()">Tambahkan Motor</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF TAMBAH MOTOR -->
        <!-- EDIT MOTOR -->
        <div class="modal fade" id="Edit_Motor" tabindex="-1" role="dialog" 
            aria-labelledby="Edit_Motor" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Edit Motor</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                            aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Merk</span>
                            </div>
                            <input type="text" v-model="Motor.Merk" class="form-control" 
                            placeholder="Masukkan Merk Motor" 
                            :error="merkErrors" aria-label="Merk_Motor" 
                            aria-describedby="basic-addon2" 
                            id="Merk_Motor" name="Merk_Motor" 
                            @input="$v.Motor.Merk.$touch()" 
                            @blur="$v.Motor.Merk.$touch()" required>
                        </div>
                        <div class="text-center">
                            <div class="mb-3" style="color:red;" 
                            v-if="$v.Motor.Merk.$invalid">{{merkErrors[0]}}</div>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend d-block" style="width: 100px;">
                                <span class="input-group-text" id="basic-addon2">Tipe</span>
                            </div>
                            <input type="text" v-model="Motor.Tipe" 
                            class="form-control" placeholder="Masukkan Tipe Motor" 
                            aria-label="Motor_Tipe" aria-describedby="basic-addon2" 
                            id="Motor_Tipe" name="Motor_Tipe" 
                            @input="$v.Motor.Tipe.$touch()" 
                            @blur="$v.Motor.Tipe.$touch()" required>
                        </div>
                        <div class="text-center">
                            <p class="mb-3" style="color:red;" 
                            v-if="$v.Motor.Tipe.$invalid">{{typeErrors[0]}}</p>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="submit" class="btn btn-primary btn-lg w-100" 
                        @click="updatemotor(Motor.Id_Motor)" 
                        :disabled="$v.Motor.$invalid" data-dismiss="modal">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF EDIT MOTOR -->
        <!-- DELETE MOTOR -->
        <div class="modal fade" id="Delete_Motor" tabindex="-1" role="dialog" 
            aria-labelledby="Delete_Motor" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto" id="Heading">Hapus Data Motor</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                            aria-hidden="true" aria-label="Close" style="margin-left: -30px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> 
                        Apakah Anda Yakin Ingin Menghapus Data Jasa Service Ini ?</div>
                    </div>
                    <div class="modal-footer ">
                        <a id="delete_btn" class="float-left w-100">
                            <button type="button" @click="deletemotor(Motor.Id_Motor)" 
                            class="btn btn-danger float-left w-50" data-dismiss="modal">
                            <span class="glyphicon glyphicon-ok-sign"></span>Ya</button>
                        </a>
                        <button type="button" class="btn btn-secondary float-right w-50" 
                            data-dismiss="modal"><span class="glyphicon glyphicon-remove">
                                </span>Tidak</button>
                    </div>
                </div>
            </div>
            </div>
        <!-- END OF DELETE MOTOR -->
        <!-- END OF MY MODALS -->
    </body>
</template>
<script>
import Controller from '../../service/Motor'
import validators from '../../validations/motor_validations'

export default {
    validations: validators,
    data: () => ({
        motordata:[],
        Merk:'',
        Tipe:'',
        Cari_Motor:'',
        Motor:{
            Merk:'',
            Tipe:'',
        }
    }),
    mounted(){
        this.getallmotor()
    },
    methods:{
        async getallmotor () {
            try {
                this.motordata = (await Controller.getallmotor()).data
                console.log(this.motordata)
            } catch (err) {
                console.log(err)
            }
        },
        async addmotor () {
            try {
                const payload = {
                    Merk : this.Motor.Merk,
                    Tipe : this.Motor.Tipe,
                }
                await Controller.addmotor(payload)
                this.getallmotor()
                this.refresh()
                //this.$router.go()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        async updatemotor (id) {
            try {
                const payload = {
                    Merk : this.Motor.Merk,
                    Tipe : this.Motor.Tipe,
                }
                await Controller.updatemotor(payload,id)
                this.getallmotor()
                this.refresh()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        async deletemotor (id) {
            try {
                await Controller.deletemotor(id)
                this.getallmotor()
                // console.log()
            } catch (err) {
                console.log(err)
            }
        },
        datamotorhandler(motor){
            this.Motor = motor
        },
        refresh(){
            this.Motor.Merk = '';
            this.Motor.Tipe= '';
        }
    },
    computed:{
        filteredmotor:function(){
            return this.motordata.filter((motor)=>{
                return motor.Merk.match(this.Cari_Motor);
            });
        },
        merkErrors () {
            const errors = []
            if (!this.$v.Motor.Merk.$dirty) return errors
            !this.$v.Motor.Merk.minLength && errors.push('Motorcycle Brand must be at least 5 characters long')
            !this.$v.Motor.Merk.maxLength && errors.push('Motorcycle Brand must be at most 25 characters long')
            !this.$v.Motor.Merk.required && errors.push('Motorcycle Brand is required.')
            return errors
        },
        typeErrors () {
            const errors = []
            if (!this.$v.Motor.Tipe.$dirty) return errors
            !this.$v.Motor.Tipe.maxLength && errors.push('Type must be at most 25 characters long')
            !this.$v.Motor.Tipe.minLength && errors.push('Type must be at least 5 characters long')
            !this.$v.Motor.Tipe.required && errors.push('Type is required')
            return errors
        },
    }
}
</script>

