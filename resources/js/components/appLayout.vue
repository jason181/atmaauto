<template>
   <div class="content" id="homeLayout">
            <nav class="navbar navbar-expand-lg navbar-light bg-light" v-if="this.$route.meta.role=='Admin'">
		  	<a class="navbar-brand" href="../"><img src="../../image/Logo_Transparan.png" width="50px"> SIAUTO</a>
		  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  	</button>

		  	<div class="collapse navbar-collapse">
		    	<div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
			        <ul class="navbar-nav">
			          	<li class="nav-item active">
			            	<a class="nav-link disabled py-2" href="#" style="font-size: 20pt;">SELAMAT DATANG OWNER</a>
			          	</li>
			        </ul>
			    </div>
			    <form class="form-inline my-2 my-lg-0" > 
			      	<button class="btn btn-outline-danger my-2 my-sm-0" type="submit" @click="logoutHandler()">Logout</button>
			    </form>
		  	</div>
		</nav>

		<div v-if="this.$route.meta.role=='Admin' " class="collapse navbar-collapse show" id=navbarSupportedContent>
			<nav class="nav nav-pills nav-justified" style="background-color: #e3f2fd;">
                <router-link :to="{name:'Pegawai'}" class="nav-tabs nav-item nav-link">
                    <a class="nav-tabs nav-item nav-link">Pegawai</a>
                </router-link>
			  	<router-link :to="{name:'Jasa_Service'}" class="nav-tabs nav-item nav-link">
                    <a class="nav-tabs nav-item nav-link">Jasa Service</a>
                </router-link>
				<router-link :to="{name:'Sparepart'}" class="nav-tabs nav-item nav-link">
                    <a class="nav-tabs nav-item nav-link">Sparepart</a>
                </router-link>
				<router-link :to="{name:'Motor'}" class="nav-tabs nav-item nav-link">
                    <a class="nav-tabs nav-item nav-link">Motor</a>
                </router-link>
				<router-link :to="{name:'Konsumen'}" class="nav-tabs nav-item nav-link">
                    <a class="nav-tabs nav-item nav-link">Konsumen</a>
                </router-link>
				<router-link :to="{name:'Supplier'}" class="nav-tabs nav-item nav-link">
                    <a class="nav-tabs nav-item nav-link">Supplier</a>
                </router-link>
				<router-link :to="{name:'Cabang'}" class="nav-tabs nav-item nav-link">
                    <a class="nav-tabs nav-item nav-link">Cabang</a>
                </router-link>
				<router-link :to="{name:'Pengadaan'}" class="nav-tabs nav-item nav-link">
                    <a class="nav-tabs nav-item nav-link">Pengadaan</a>
                </router-link>
				<router-link :to="{name:'Laporan'}" class="nav-tabs nav-item nav-link">
                    <a class="nav-tabs nav-item nav-link">Laporan</a>
                </router-link>
			</nav>
		</div>
        <nav v-if="$route.meta.role=='User'" class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../"><img src="../../image/Logo_Transparan.png" width="50px"> SIAUTO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-collapse collapse w-100" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <router-link :to="{name:'HomeLayout'}">
                                <a class="nav-link">Home</a>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name:'Katalog'}">
                                <a class="nav-link">Katalog</a>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name:'Status'}">
                                <a class="nav-link">Cek Status</a>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

         <div id="app">
            <main class="pageContent">
            <transition name="fade">
                <router-view></router-view>
            </transition>
            </main>
        </div>
   </div>
</template>


<style>

</style>


<script>
import auth from './../service/Auth'
export default {
    name: 'appLayout',
    data () {
      return {
		err: ''
      }
	},
	methods:{
		async logoutHandler(){
			try{
				await auth.logout()
				this.router.push({name : 'Login'})
			}
			catch(err){
				
			}
		}
	}
}
</script>
