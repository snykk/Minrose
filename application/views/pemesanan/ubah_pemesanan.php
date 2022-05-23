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

    <?php
      echo $this->session->flashdata('message');
      unset($_SESSION['message']);
    ?>
    
    <!-- main content -->
    <div class="row flex-lg-nowrap">

    <div class="col-9">
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
                      <div class="text-muted">Pesanan terakhir diubah pada <?= date('d F Y', $pemesanan[0]["pesanan_diubah"]); ?></div>
                      <div class="text-muted" >
                        <small>dipesan oleh </small>
                        <small style="transition:1s;cursor:pointer;" onMouseOver="this.style.fontSize='18px'" onMouseOut="this.style.fontSize='14px'">@<?= $pemesanan[0]["username"]; ?></small>
                      </div>
                      <div class="mt-2">

                      <!-- Form -->
                      <?= form_open_multipart('pemesanan/ubah_pemesanan'); ?>
                      <!-- id pemesanan -->
                      <input type="hidden" name="id" id="id" value="<?= set_value('id', $pemesanan[0]["id_pemesanan"]); ?>">
                      </div>
                    </div>
                    <div class="text-center text-sm-right">
                      <span style="background: #108d6f; color:white; padding:0.08em 0.4em;border-radius: 0.5em;cursor:pointer"><?= ($this->session->userdata('role_id') == 1) ? "Admin":"User"?></span>
                      <div class="text-muted"><small>Pesanan dibuat pada <?= date('d F Y', $pemesanan[0]["tanggal_pemesanan"]); ?></small></div>
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
                            <div class="col-12 col-md-6">
                              <div class="form-group">
                                <label for="nama_produk">Nama produk</label>
                                <input class="form-control" type="text" id="nama_produk" name="nama_produk"  value="<?= set_value('nama', $pemesanan[0]["nama_produk"]); ?>" disabled>
                              </div>
                            </div>
                            <div class="col-12 col-md-3">
                              <div class="form-group">
                                <label for="nama_produk">Harga produk</label>
                                <input class="form-control" type="text" id="harga_produk" name="harga_produk" data-trueHarga="<?= set_value('nama', $pemesanan[0]["harga_produk"]); ?>"  value="<?= set_value('harga_produk', $pemesanan[0]["harga_produk"]); ?>" disabled>
                              </div>
                            </div>
                            <div class="col-12 col-md-3">
                              <div class="form-group">
                                <label for="jumlah_produk">Jumlah_produk</label>
                                <input class="form-control" type="number" min="0" id="jumlah_produk" name="jumlah_produk" placeholder="Masukkan jumlah produk" value="<?= set_value('jumlah_produk', $pemesanan[0]["jumlah_produk"]); ?>" onchange="myCounter()">
                                <?= form_error('jumlah_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col">
                              <div class="form-group">
                                <label class="col control-label">Metode transaksi</label>
                                <div class="form-control d-flex justify-content-between align-items-center" style="background-color: #e9ecef;"><?= $pemesanan[0]["metode_pembayaran"]; ?> <em class="link-danger" >tidak dapat melakukan perubahan metode untuk saat ini</em></div>
                                <!-- <select id="metode_pembayaran" name="metode_pembayaran" class="form-control">
                                  <?php 
                                  // if ($pemesanan[0]["metode_pembayaran"] == "COD"){
                                  //   $first = "COD";
                                  //   $second = "Transfer Bank";
                                  // } else {
                                  //   $first = "Transfer Bank";
                                  //   $second = "COD";
                                  // }
                                  ?>
                                  
                                   <option value="0"><?//= $first; ?></option>
                                  <option value="1"><?//= $second; ?></option>  
                                   value 0 atau 1 untuk mengidentifikasi jika ada value yang berubah 
                                </select> -->

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
                          <?php if ($pemesanan[0]["metode_pembayaran"] == "Transfer Bank") : ?>
                          <div class="row">
                            <div class="col">
                              <div class="form-group mb-3">
                                <label for="nama_produk"  class="d-flex justify-content-center align-items-center mb-2" style="font-size: 20px;">bukti transfer</label>
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="<?= base_url('assets/img/bukti/' . $pemesanan[0]["bukti_transfer"]) //.  $user['image']; ?>" width="150">
                                    <div class="mt-3">
                                        <p class="text-secondary mb-1">upload bukti transfer</p>
                                        <!-- <a data-bs-dismiss="modal" data-bs-toggle="modal" href="#ModalUploadBukti" title="upload bukti" style="text-decoration: none;color:red;transition:0.5s" onMouseOver="this.style.fontSize='28px'" onMouseOut="this.style.fontSize='16px'">upload</a> -->
                                        <div class="custom-file">
                                          <input type="file" class="form-control" id="image" name="image" value="<?= set_value('image'); ?>">
                                          <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>	
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php endif;?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col d-flex justify-content-end">
                          <a class="btn btn-outline-secondary mx-3" href="<?= base_url("pemesanan/data_pemesanan") ?>">Kembali</a>
                          <button class="btn btn-dark" type="submit">Simpan perubahan</button>
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
    <!-- order summmary -->
    <div class="col-lg-3">
      <div class="card">
        <div class="p-3 bg-light bg-opacity-10">
          <h6 class="card-title mb-3">Order Summary</h6>
          <div class="d-flex justify-content-between mb-1 small">
            <span>Subtotal</span> <span><span>Rp. </span> <span id="sub-total"><?= $pemesanan[0]["harga_produk"] * $pemesanan[0]["jumlah_produk"] ?></span></span>
          </div>
          <div class="d-flex justify-content-between mb-1 small">
            <span>Ongkir</span> <span><span>Rp. </span><span id="ongkir" data-valueOngkir="10000">10000</span></span>
          </div>
          <div class="d-flex justify-content-between mb-1 small">
            <span>Kupon (kode: tidak ada kupon)</span> <span class="text-danger"><span>Rp. </span><span id="kupon" data-valueKupon="0">0</span></span>
          </div>
          <hr>
          <div class="d-flex justify-content-between mb-4 small">
            <?php
            $init_total = $pemesanan[0]["harga_produk"] * $pemesanan[0]["jumlah_produk"] + 10000;
            ?>
            <span>TOTAL</span> <strong class="text-dark"><span>Rp. </span><span id="total"><?= $init_total; ?></span></strong>
            <input type="hidden" name="input_total" id="input_total" value="<?= set_value('input_total', $init_total); ?>">
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>