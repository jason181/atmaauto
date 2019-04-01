<template>
   <div class="content" id="homeLayout">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
		  	<!-- <a class="navbar-brand" href="#"><img src="../img/Logo_AtmaAuto.jpg" width="50px"> SIAUTO</a> -->
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
			    <form class="form-inline my-2 my-lg-0">
			      	<button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Logout</button>
			    </form>
		  	</div>
		</nav>

		<div class="collapse navbar-collapse show" id=navbarSupportedContent>
			<nav class="nav nav-pills nav-justified" style="background-color: #e3f2fd;">
                <router-link :to="{name:'Pegawai'}" class="">
                    <a class="nav-tabs nav-item nav-link">Pegawai</a>
                </router-link>
			  	<!-- <a class="nav-tabs nav-item nav-link" href="pegawai.php">Pegawai</a> -->
			  	<router-link :to="{name:'Jasa_Service'}" class="">
                    <a class="nav-tabs nav-item nav-link">Jasa Service</a>
                </router-link>
				<!-- <a class="nav-tabs nav-item nav-link" href="jasa_service.php">Jasa Service</a> -->
			  	<a class="nav-tabs nav-item nav-link" href="sparepart.php">Sparepart</a>
			  	<a class="nav-tabs nav-item nav-link" href="motor.php">Motor</a>
			  	<a class="nav-tabs nav-item nav-link" href="konsumen.php">Konsumen</a>
			  	<a class="nav-tabs nav-item nav-link" href="sales.php">Sales</a>
			  	<a class="nav-tabs nav-item nav-link" href="supplier.php">Supplier</a>
			  	<a class="nav-tabs nav-item nav-link" href="cabang.php">Cabang</a>
			  	<a class="nav-tabs nav-item nav-link" href="pengadaan.php">Pengadaan</a>
			  	<a class="nav-tabs nav-item nav-link" href="laporan.php">Laporan</a>
			</nav>
		</div>

         <div id="appPage">
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

</script>
