<template>
<body>
  <div class="card text-center mx-auto mt-5" style="width: 25rem;">
    <div class="card-header">
      <h3 class="card-title m-0">LOGIN</h3>
    </div>
    <form autocomplete="off" @submit.prevent="loginHandler" method="post">
      <div class="card-body">
        <div class="input-group mb-4">
          <div class="input-group-prepend d-block" style="width: 100px;">
            <span class="input-group-text" id="basic-addon2">Username</span>
          </div>
          <input type="text" class="form-control" v-model="form.username" placeholder="Masukkan Username" aria-label="Username" aria-describedby="basic-addon2" id="Username" name="Username">
        </div>
        <div class="input-group mb-4">
            <div class="input-group-prepend d-block" style="width: 100px;">
                <span class="input-group-text" id="basic-addon2">Password</span>
            </div>
            <input :type="type" class="form-control" v-model="form.password" placeholder="Masukkan Password" aria-label="Password" aria-describedby="basic-addon2" id="Password" name="Password">
            <div class="input-group-append" @click="togglePassword()">
                <span class="input-group-text mouseover" id="basic-addon2">
                  <i class="fas fa-eye-slash" ></i>
                </span>
            </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-success btn-lg" style="width: 100%;" id="btnLogin">LOGIN</button>
      </div>
    </form>
  </div>
</body>
</template>


<style>
.mouseover{
  cursor: pointer;
}
</style>

<script>
import auth from '../../service/Auth'
import { mapGetter, mapGetters } from 'vuex'
  export default {
    name: 'HomeLayout',
    data () {
      return {
        form: {
          username: '',
          password: '',
        },
        // Role:'',
        error:'',
        type:'password',
      }
    },
    
    methods: {
      async loginHandler(){
        try {
          await auth.authenticate(this.form)
          if(this.Role == 'Admin')
          {
            this.$router.push({ name: 'Pegawai' })
          }
          else if(this.Role == 'Customer Service')
          {
            this.$router.push({ name: 'Penjualan' })
          }
          else if(this.Role == 'Kasir')
          {
            this.$router.push({ name: 'Kasir' })
          }
        } catch (err) {
          //this.$refs.errorAlert.trigger({ message: 'Terjadi Kesalahan Login!' })
        }
      },
      togglePassword(){
        if(this.type=='password')
          this.type='text';
        else{
          this.type='password';
        }
      }
    },
    computed:{
        ...mapGetters({
            Role : 'LoggedUser/role'
        }),
    }
  }
</script>

