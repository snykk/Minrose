<div class="container-fluid pt-4" style="background: #eee;">
  <!-- Hierarki -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Home</li>
      <li class="breadcrumb-item">Produk</li>
      <li class="breadcrumb-item active" aria-current="page">Ubah Produk</li>
    </ol>
  </nav>
  <!-- Tutup hierarki -->

  <hr class="mt-0 mb-4">

  <?php
  echo $this->session->flashdata('message');
  unset($_SESSION['message']);
  ?>

  <div class="row flex-lg-nowrap">

    <div class="col">
      <div class="row">
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <div class="e-profile">
                <div class="row">
                  <div class="col-12 col-sm-auto mb-3">
                    <img class="img-account-profile mb-2" src="<?= base_url('assets/img/produk/') .  $produk["image"]; ?>" width="200" alt="">
                  </div>
                  <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                    <div class="text-sm-left mb-2 mb-sm-0">
                      <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?= $produk["nama"] ?></h4>
                      <div class="text-muted"><small>Terakhir diubah pada <?= date('d F Y', $produk["data_diedit"]); ?></small></div>
                      <div class="mt-2">
                        <!-- Form -->
                        <?= form_open_multipart('produk/ubah_produk'); ?>
                        <input type="hidden" name="id" value="<?= $produk["id"]; ?>">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="image" name="image" value="<?= set_value('image'); ?>">
                          <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="text-center text-sm-right">
                      <span style="background: #108d6f; color:white; padding:0.08em 0.4em;border-radius: 0.5em;cursor:pointer">Admin</span>
                      <div class="text-muted"><small>Data dibuat pada <?= date('d F Y', $produk["data_dibuat"]); ?></small></div>
                    </div>
                  </div>
                </div>
                <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="" class="active nav-link">Form Ubah Data Produk</a></li>
                </ul>
                <div class="tab-content pt-3">
                  <div class="tab-pane active">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col-12 col-sm-6 mb-3">
                            <div class="form-group">
                              <label for="nama_produk">Nama Produk</label>
                              <input class="form-control" type="text" id="nama" name="nama" placeholder="Masukkan nama produk" value="<?= set_value('nama', $produk["nama"]); ?>">
                              <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                          </div>
                          <div class="col-12 col-sm-2 mb-3">
                            <div class="form-group">
                              <label for="stok">Stok Tersedia</label>
                              <input class="form-control" type="text" id="stok" name="stok" placeholder="Masukkan banyak stok saat ini" value="<?= set_value('stok', $produk["stok"]); ?>">
                              <?= form_error('stok', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                          </div>
                          <div class="col-12 col-sm-2 mb-3">
                            <div class="form-group">
                              <label for="harga">Harga</label>
                              <input class="form-control" id="harga" name="harga" type="text" placeholder="Masukkan harga produk" value="<?= set_value('harga', $produk["harga"]); ?>">
                              <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                          </div>
                          <div class="col-12 col-sm-2 mb-3">
                            <div class="form-group">
                              <label for="diskon">Diskon</label>
                              <input class="form-control" type="text" id="diskon" name="diskon" placeholder="Masukkan harga produk" value="<?= set_value('diskon', $produk["diskon"]); ?>">
                              <?= form_error('diskon', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label for="orientasi">Orientasi Produk</label>
                              <input class="form-control" id="orientasi" name="orientasi" placeholder="Masukkan orientasi produk" value="<?= set_value('orientasi', $produk["orientasi"]); ?>">
                              <?= form_error('orientasi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label for="deskripsi">Deskripsi Produk</label>
                              <input class="form-control" id="deskripsi" placeholder="Masukkan deskripsi produk" name="deskripsi" value="<?= set_value('deskripsi', $produk["deskripsi"]); ?>"">
                                <?= form_error('deskripsi', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row">
                              <div class="col d-flex justify-content-end">
                                <a class="btn btn-primary mx-3" href="<?= base_url("produk/index") ?>">Kembali</a>
                                <button class="btn btn-primary" type="submit">Simpan perubahan</button>
                              </div>
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
          </div>
        </div>