<div class="container-fluid pt-4">
  <!-- Hierarki -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Home</li>
      <li class="breadcrumb-item">Transaksi</li>
      <li class="breadcrumb-item active" aria-current="page">Tambah Pengeluaran</li>
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
                <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="" class="active nav-link">Form Tambah Data Pengeluaran</a></li>
                </ul>

                <!-- Form -->
                <?= form_open_multipart('transaksi/tambah_pengeluaran'); ?>

                <div class="tab-content pt-3">
                  <div class="tab-pane active">
                      <div class="row">
                        <div class="col">
                          <div class="row">
                            <div class="col-12 col-sm-8 mb-3">
                              <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <input class="form-control" type="text" id="kategori" name="kategori" placeholder="Masukkan nama kategori" value="<?= set_value('kategori'); ?>">
                                <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                            </div>
                            <div class="col-12 col-sm-4 mb-3">
                              <div class="form-group">
                                <label for="pengeluaran">Total pengeluaran</label>
                                <input class="form-control" type="text" id="pengeluaran" name="pengeluaran" placeholder="Masukkan nominal pengeluaran" value="<?= set_value('pengeluaran'); ?>">
                                <?= form_error('pengeluaran', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col mb-3">
                              <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan pengeluaran" value="<?= set_value('keterangan'); ?>">
                                <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                            </div>
                          </div>
                        </form>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col d-flex justify-content-end">
                          <a class="btn btn-secondary mx-3" href="<?= base_url("transaksi"); ?>">Kembali</a>
                          <button class="btn btn-dark" type="submit">Submit</button>
                        </div>
                      </div>
                    </div>
                </div>
                </form >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>