<div class="container-fluid pt-4" style="background: #eee;">
  <!-- Hierarki -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Home</li>
      <li class="breadcrumb-item">Produk</li>
      <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
    </ol>
  </nav>
  <!-- Tutup hierarki -->

  <hr class="mt-0 mb-4">
  <div class="row flex-lg-nowrap">

    <div class="col">
      <div class="row">
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <div class="e-profile">
                <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#" class="active nav-link">Form Tambah Data Produk</a></li>
                </ul>
                <div class="tab-content pt-3">
                  <div class="tab-pane active">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col-12 col-sm-6 mb-3">
                            <div class="form-group">
                              <!-- Form -->
                              <?= form_open_multipart('produk/tambah_produk'); ?>
                              <label for="nama_produk">Nama Produk</label>
                              <input class="form-control" type="text" id="nama" name="nama" placeholder="Masukkan nama produk" value="<?= set_value('nama'); ?>">
                              <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                          </div>
                          <div class="col-12 col-sm-2 mb-3">
                            <div class="form-group">
                              <label for="stok">Stok Tersedia</label>
                              <input class="form-control" type="text" id="stok" name="stok" placeholder="Masukkan banyak stok saat ini" value="<?= set_value('stok'); ?>">
                              <?= form_error('stok', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                          </div>
                          <div class="col-12 col-sm-2 mb-3">
                            <div class="form-group">
                              <label for="harga">Harga</label>
                              <input class="form-control" id="harga" name="harga" type="text" placeholder="Masukkan harga produk" value="<?= set_value('harga'); ?>">
                              <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                          </div>
                          <div class="col-12 col-sm-2 mb-3">
                            <div class="form-group">
                              <label for="diskon">Diskon</label>
                              <input class="form-control" type="text" id="diskon" name="diskon" placeholder="Masukkan harga produk" value="<?= set_value('diskon'); ?>">
                              <?= form_error('diskon', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                          </div>
                          <div class="col-lg-12 mb-3">
                            <div class="form-group">
                              <label for="orientasi">Orientasi Produk</label>
                              <textarea class="form-control" rows="3" id="orientasi" name="orientasi" placeholder="Masukkan orientasi produk"><?= set_value('orientasi'); ?></textarea>
                              <?= form_error('orientasi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                          </div>
                          <div class="col-lg-12 mb-3">
                            <div class="form-group">
                              <label for="deskripsi">Deskripsi Produk</label>
                              <textarea class="form-control" rows="5" id="deskripsi" placeholder="Masukkan deskripsi produk" name="deskripsi"><?= set_value('deskripsi'); ?></textarea>
                              <?= form_error('deskripsi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                          </div>
                          <div class="custom-file">
                            <label class="custom-file-label" for="image">Gambar</label> <br>
                            <input type="file" class="custom-file-input" id="image" name="image" value="<?= set_value('image'); ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <a class="btn btn-primary mx-3" href="<?= base_url("produk/index") ?>">Kembali</a>
                        <button class="btn btn-primary" type="submit">Tambahkan</button>
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