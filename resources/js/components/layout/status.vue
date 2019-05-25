<template>
<body>
  <div class="card text-center mx-auto mt-5" style="width: 25rem;">
    <div class="card-header">
      <h3 class="card-title m-0">Cek Status</h3>
    </div>
    <form autocomplete="off" @submit.prevent="loginHandler" method="post">
      <div class="card-body">
        <div class="input-group mb-4">
          <div class="input-group-prepend d-block" style="width: 100px;">
            <span class="input-group-text" id="basic-addon2">Telepon</span>
          </div>
          <input type="text" class="form-control" v-model="hp" placeholder="08xx-xxxx-xxxx" aria-label="hp" aria-describedby="basic-addon2" id="hp" name="hp">
        </div>
        <div class="input-group mb-4">
            <div class="input-group-prepend d-block" style="width: 100px;">
                <span class="input-group-text" id="basic-addon2">Plat</span>
            </div>
            <input type="text" class="form-control" v-model="plat" placeholder="XX-XXXX-XX" aria-label="plat" aria-describedby="basic-addon2" id="plat" name="plat">
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-success btn-lg" style="width: 100%;">CHECK</button>
      </div>
    </form>
  </div>
</body>
</template>

<script>


</script>

