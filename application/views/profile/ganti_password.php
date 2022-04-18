<div class="container-fluid">
    <div class="main-body">
    <!-- Hierarki -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Profile</li>
            <li class="breadcrumb-item active" aria-current="page">Ganti Password</li>
        </ol>
    </nav>
    <!-- Tutup hierarki -->
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 separator social-login-box"> <br>
                        <img alt="gambar profile user" class="img-thumbnail" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">                        
                        </div>
                        <div style="margin-top:20px;" class="col-xs-6 col-sm-6 col-md-6 login-box">
                        
                            <?php
                            echo $this->session->flashdata('message'); 
                            unset($_SESSION["message"]);
                            ?>
                            <form action="<?= base_url('profile/ganti_password'); ?>" method="post">
                            <div class="form-group">
                                <label for="current_password">Password Saat ini</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                                <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="new_password1">Password Baru</label>
                                <input type="password" class="form-control" id="new_password1" name="new_password1">
                                <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="new_password2">Ulangi Password</label>
                                <input type="password" class="form-control" id="new_password2" name="new_password2">
                                <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group my-3">
                                <button type="submit" class="btn btn-dark">Ubah Password</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

