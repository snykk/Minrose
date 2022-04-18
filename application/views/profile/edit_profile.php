<div class="container-fluid">
    <div class="main-body">
    <!-- Hierarki -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Profile</li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Profile</li>
        </ol>
    </nav>
    <!-- Tutup hierarki -->

    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Gambar Profile</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile mb-2" src="<?= base_url('assets/img/profile/') .  $user['image']; ?>" width="150" alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">[Jpg, Gif, Png] tidak lebih dari 2 MB</div>
                    <!-- Profile picture upload button-->
                    <?= form_open_multipart('home/edit_profile'); ?>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <!-- <label class="custom-file-label" for="image">Choose file</label> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Detail Akun</div>
                <div class="card-body">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="email">Email</label>
                            <input class="form-control" id="email" name="email" type="text" placeholder="Masukkan email anda" value="<?= $user['email']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="username">Username (akan dijadikan sebagai identitas di website ini)</label>
                            <input class="form-control" id="username" name="username" type="text" placeholder="Masukkan username anda" value="<?= $user['username']; ?>">
                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="nama_lengkap">Nama Lengkap</label>
                            <input class="form-control" id="nama_lengkap" name="nama_lengkap" type="text" placeholder="Masukkan nama anda" value="<?= $user['nama_lengkap']; ?>">
                            <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-7 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?= $user['jenis_kelamin']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="no_hp">No. HP</label>
                                <input class="form-control" id="no_hp" name="no_hp" type="text" placeholder="Masukkan nomor HP anda" value="<?= $user['no_hp']; ?>">
                                <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="alamat">Alamat</label>
                                <input class="form-control" id="alamat" name="alamat" type="text" placeholder="Masukkan lokasi anda" value="<?= $user['alamat']; ?>">
                                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        
                        <!-- Save changes button-->
                        <button class="btn btn-dark" type="submit">Simpang perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>