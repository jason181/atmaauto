<template>
<body>
    <div class="container w-25 mt-5">
        <h1 style="text-align:center;">LOGIN</h1>
        <div class="alert alert-danger" v-if="error">
            <p>There was an error, unable to sign in with those credentials.</p>
        </div>
        <form autocomplete="off" @submit.prevent="login" method="post">
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
                <input type="password" class="form-control" v-model="Password" placeholder="Masukkan Password" aria-label="Password" aria-describedby="basic-addon2" id="Password" name="Password">
            </div>
            <div class="modal-footer ">
                <button type="submit" class="btn btn-success btn-lg" style="width: 100%;">LOGIN</button>
            </div>
        </form>
    </div>
</body>
</template>


<style>
</style>

<script>
export default {
    data(){
        return {
            Username: null,
            Password: null,
            error: false
        }
    },
    methods: {
      login(){
        var app = this
        this.$auth.login({
            params: {
              username: app.Username,
              password: app.Password
            }, 
            success: function () {},
            error: function () {},
            rememberMe: true,
            redirect: '/pegawai',
            fetchUser: true,
        });       
      },
    }

}
</script>
