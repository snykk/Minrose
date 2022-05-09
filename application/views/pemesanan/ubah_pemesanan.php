<?//php var_dump($pemesanan)?>
<div class="container-fluid mb-5">

    <!-- Hierarki -->
    <nav aria-label="breadcrumb" class="main-breadcrumb mt-3">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Pemesanan</li>
        <li class="breadcrumb-item active" aria-current="page"><?= $title?></li>
      </ol>
    </nav>
    <!-- Tutup hierarki -->
    <hr class="mt-0 mb-4">

    <!-- main content -->
    <div class="row flex-lg-nowrap">

    <div class="col">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div class="e-profile">
                <div class="row">
                  <div class="col-12 col-sm-auto mb-3">
                  <img class="img-account-profile mb-2" src="<?= base_url('assets/img/produk/') .  $pemesanan[0]["image_produk"]; ?>" width="200" alt="">
                  </div>
                  <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                    <div class="text-sm-left mb-2 mb-sm-0">
                      <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?= $pemesanan[0]["nama_produk"]?></h4>
                      <div class="text-muted">
                        <small>Pesanan terakhir diubah pada <?= date('d F Y', $pemesanan[0]["pesanan_diubah"]); ?></small>
                      </div>
                      <div class="mt-2">

                      <!-- Form -->
                      <?= form_open_multipart('produk/ubah_produk'); ?>
                      <!-- <input type="hidden" name="id" value="<//?= $produk["id"]; ?>"> -->
                      <!-- <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" value="<?= set_value('image'); ?>">
                        <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>				 -->
                      </div>
                    </div>
                    <div class="text-center text-sm-right">
                      <span style="background: #108d6f; color:white; padding:0.08em 0.4em;border-radius: 0.5em;cursor:pointer"><?= ($this->session->userdata('role_id') == 1) ? "Admin":"User"?></span>
                      <div class="text-muted"><small>Pesanan dibuat pada <?= date('d F Y', $pemesanan[0]["pesanan_dibuat"]); ?></small></div>
                    </div>
                  </div>
                </div>
                <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="" class="active nav-link">Form Ubah Data Pemesanan</a></li>
                </ul>
                <div class="tab-content pt-3">
                  <div class="tab-pane active">
                      <div class="row">
                        <div class="col">
                          <div class="row mb-3">
                            <div class="col-12 col-sm-9">
                              <div class="form-group">
                                <label for="nama_produk">Nama Produk</label>
                                <input class="form-control" type="text" id="nama_produk" name="nama_produk"  value="<?= set_value('nama', $pemesanan[0]["nama_produk"]); ?>" disabled>
                              </div>
                            </div>
                            <div class="col-12 col-sm-3">
                              <div class="form-group">
                                <label for="stok">Jumlah_produk</label>
                                <input class="form-control" type="number" id="jumlah_produk" name="jumlah_produk" min="0" max="<?= $pemesanan[0]["stok"];?>" placeholder="Masukkan jumlah produk" value="<?= set_value('jumlah_produk', $pemesanan[0]["jumlah_produk"]); ?>">
                                <?= form_error('jumlah_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col">
                              <div class="form-group">
                                <label class="col control-label">Metode transaksi</label>
                                <select id="metode_pembayaran" class="form-control">
                                  <?php 
                                  if ($pemesanan[0]["metode_pembayaran"] == "COD"){
                                    $first = "COD";
                                    $second = "Transfer Bank";
                                  } else {
                                    $first = "Transfer Bank";
                                    $second = "COD";
                                  }
                                  ?>

                                  <option value="<?= $first; ?>"><?= $first; ?></option>
                                  <option value="<?= $second; ?>"><?= $second; ?></option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-12">
                              <div class="form-group">
                                <label for="harga">Alamat</label>
                                <input class="form-control" id="alamat_pemesanan" name="alamat_pemesanan" type="text" placeholder="Masukkan alamat anda" value="<?= set_value('alamat_pemesanan', $pemesanan[0]["alamat_pemesanan"]); ?>">
                                <?= form_error('alamat_pemesanan', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <div class="form-group mb-3">
                                <label for="nama_produk"  class="d-flex justify-content-center align-items-center mb-2" style="font-size: 20px;">bukti transfer</label>
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="<?= base_url('assets/img/bukti/default.png') //.  $user['image']; ?>" width="150">
                                    <div class="mt-3">
                                        <p class="text-secondary mb-1">upload bukti transfer</p>
                                        <a data-bs-dismiss="modal" data-bs-toggle="modal" href="#ModalUploadBukti" title="upload bukti" style="text-decoration: none;color:red;transition:0.5s" onMouseOver="this.style.fontSize='28px'" onMouseOut="this.style.fontSize='16px'">upload</a>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col d-flex justify-content-end">
                          <a class="btn btn-outline-secondary mx-3" href="<?= base_url("pemesanan/data_pemesanan") ?>">Kembali</a>
                          <button class="btn btn-dark" type="submit">Simpan perubahan</button>
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

<?php if (false) :?>
<div class="row">
  <!-- left column -->
  <div class="col-md-3">
    <div class="text-center">
      <img src="<?= base_url("assets/img/produk/"). $pemesanan[0]["image_produk"]; ?>" class="avatar img-circle img-thumbnail" alt="avatar" />
      <h6 class="mt-3 mb-1">Upload a different photo...</h6>

      <input type="file" class="form-control" />
      <div class="mt-3 link-dark">dipesan pada <?= date('d-m-Y', $pemesanan[0]["tanggal_dipesan"])?></div>
    </div>
  </div>

  <!-- edit form column -->
  <div class="col-md-9 personal-info">
    <!-- <div class="alert alert-info alert-dismissable d-flex justify-content-between align-items-center" >
      <div class="content-alert" >This is an <strong>.alert</strong>. Use this to show important messages to the user.</div>
      <a class="panel-close close" data-bs-dismiss="alert">x</a>
    </div> -->
    <h3><?= $pemesanan[0]["nama_produk"]; ?></h3>

    <form class="form-horizontal" role="form">
      <div class="form-group mb-1">
        <label class="col-lg-3 control-label">Dipesan oleh</label>
        <div class="col-lg-8">
          <input class="form-control" type="text" name="dipesan_oleh" value="<?= set_value('dipesan_oleh', $pemesanan[0]["username"]); ?>" disabled/>
        </div>
      </div>
      <div class="form-group mb-1 col-2">
        <label for="jumlah_produk">Jumlah Produk</label>
        <input id="jumlah_produk" name="jumlah_produk" value="<?= set_value('jumlah_produk', $pemesanan[0]["jumlah_produk"]); ?>" type="number" min="0" max="<?= $pemesanan[0]["stok"];?>" class="form-control" onchange="myCounter()">
        <?= form_error('jumlah_produk', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
      <div class="form-group mb-1">
        <label class="col-lg-3 control-label">Alamat</label>
        <div class="col-lg-8">
          <input class="form-control" type="text" name="alamat" value="<?= set_value('alamat', $pemesanan[0]["alamat_pemesanan"]); ?>" />
        </div>
      </div>
      <!-- <div class="form-group">
        <label class="col-lg-3 control-label">Time Zone:</label>
        <div class="col-lg-8">
          <div class="ui-select">
            <select id="user_time_zone" class="form-control">
              <option value="Hawaii">(GMT-10:00) Hawaii</option>
              <option value="Alaska">(GMT-09:00) Alaska</option>
            </select>
          </div>
        </div>
      </div> -->
    </form>
  </div>
</div>

<?php endif; ?>