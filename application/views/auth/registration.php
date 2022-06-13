<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Halaman Registrasi!</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= set_value('nama_lengkap'); ?>">
                                <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= set_value('password'); ?>">
                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="verif-password" name="verif-password" placeholder="Verifikasi Password" value="<?= set_value('verif-password'); ?>">
                                    <?= form_error('verif-password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="ml-2">Jenis Kelamin</div>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="L" <?= set_radio('jenis_kelamin', 'L', TRUE); ?>>
                                <label class="form-check-label" for="laki_laki">
                                    Laki Laki
                                </label>
                            </div>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" <?= set_radio('jenis_kelamin', 'P'); ?>>
                                <label class="form-check-label" for="perempuan">
                                    Perempuan
                                </label>
                            </div>
                            <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No. HP" value="<?= set_value('no_hp'); ?>">
                                <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?= set_value('alamat'); ?>">
                                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <input type="hidden" name="role_id" value="2" />

                            <button type="submit" class="btn btn-info btn-block">
                                Submit Registrasi
                            </button>
                        </form>
                        <hr>
                        <?php if (false) : ?>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Forgot Password?</a>
                            </div>
                        <?php endif; ?>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Sudah punya akun? Login sekarang!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>