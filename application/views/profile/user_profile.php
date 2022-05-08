<div class="container-fluid">
    <div class="main-body">

      <!-- Hierarki -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">Profile</li>
          <li class="breadcrumb-item active" aria-current="page">User Profile</li>
        </ol>
      </nav>
      <!-- Tutup hierarki -->

      <hr class="mt-0 mb-4">


      <div class="row gutters-sm">
        <div class="col-md-4 mb-3">

          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <img src="<?= base_url('assets/img/profile/') .  $user['image']; ?>" width="150">
                <div class="mt-3">
                  <h4><?= $user["username"]; ?></h4>
                  <!-- <p class="text-secondary mb-1">Full Stack Developer</p> -->
                  <p class="text-muted font-size-sm">Member sejak <?= date('d F Y', $user['data_dibuat']); ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-8">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Nama Lengkap</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?= $user["nama_lengkap"]; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?= $user['email']; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">No. HP</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?= $user["no_hp"]?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Jenis Kelamin</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?= $user["jenis_kelamin"]?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Alamat</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?= $user["alamat"]; ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-12">
                  <a class="btn btn-dark " href="<?= base_url("profile/edit_profile")?>">Ubah Profile</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>