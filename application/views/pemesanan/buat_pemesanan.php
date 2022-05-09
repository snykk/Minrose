<div class="container">
    <h1 class="main-title"><?= $title; ?></h1>
    <div class="row">
      <!-- Left -->
      <div class="col-lg-9">
        <div class="accordion" id="accordionMain">


          <!-- top field -->
        <div class="accordion-item mb-3 px-4 py-3">
          <?= form_open_multipart('pemesanan/buat_pemesanan'); ?>

          <!-- hidden input -->
          <input type="hidden" name="id_produk" value="<?= set_value('in_produk', $produk["id"]); ?>">
          <input type="hidden" name="id_user" value="<?= set_value('id_user', $user["id"]); ?>">


          <div class="row mb-3">
            <div class="col-8">
              <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input id="nama_produk" name="nama_produk" value="<?= set_value('nama', $produk["nama"]); ?>" type="text" class="form-control" disabled>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="harga_produk">Harga 1 produk</label>
                <input id="harga_produk" name="harga_produk" data-trueHarga="<?= set_value('nama', $produk["harga"]); ?>" value="Rp. <?= set_value('nama', $produk["harga"]); ?>" type="text" class="form-control" disabled>
              </div>
            </div>
          </div>
          <div class="form-group mb-3 col-2">
            <label for="jumlah_produk">Jumlah Produk</label>
            <input id="jumlah_produk" name="jumlah_produk" value="<?= set_value('jumlah_produk', "0"); ?>" type="number" min="0" max="<?= $produk["stok"];?>" class="form-control" onchange="myCounter()">
            <?= form_error('jumlah_produk', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="form-group mb-3">
            <label for="alamat">Alamat Pelanggan</label>
            <input id="alamat" name="alamat" value="<?= set_value('alamat', $user["alamat"]); ?>" type="text" class="form-control">
            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
        </div>

        
          <!-- Online Banking -->
          <div class="accordion-item mb-3 ">
            <h2 class="h5 px-4 py-3 accordion-header d-flex justify-content-between align-items-center">
              <div class="form-check w-100 collapsed">
                <input class="form-check-input" type="radio" name="id_metode" id="online_bank" data-bs-toggle="collapse" data-bs-target="#collapseCC" aria-expanded="false" value="1" <?= set_radio('id_metode', "1",TRUE); ?>>
                <label class="form-check-label pt-1" for="online_bank" data-bs-toggle="collapse" data-bs-target="#collapseCC" aria-expanded="false">
                  Transfer Bank
                </label>
              </div>
              <span>
                <img src="<?= base_url("assets/img/logo/online-banking.png")?>" height="50px" alt="logo online banking">
              </span>
            </h2>
            <div id="collapseCC" class="accordion-collapse collapse show" data-bs-parent="#accordionMain">
              <div class="accordion-body">
                <div>Pilih Bank:</div>
                <div id="mandiri" class="form-check w-100 collapsed">
                  <span><img src="<?= base_url("assets/img/logo/bank-mandiri.svg")?>" alt="mandiri logo" width="40px"></span>
                  <input type="radio" id="bank_mandiri" class="bank" name="id_bank" value="1" <?= set_radio('id_bank', '1', TRUE); ?> style="appearance: none;">
                  <label for="bank_mandiri" class="colapse_pilih_bank" data-bs-toggle="collapse" data-bs-target="#section_mandiri" aria-expanded="false" style="cursor: pointer;">Bank Mandiri</label>
                  <div id="section_mandiri" class="accordion-collapse collapse show collapse-pilih-bank" data-bs-parent="#collapseCC">
                    <!-- collapse pilih bank -->
                    <div class="divider"></div>
                    <small class="rek-title">No. Rekening Admin: </small>
                    <div class="rek-content d-flex justify-content-between mt-1">
                      <small class="no-rek">092 7840 1923 7422</small>
                      <small class="salin-rek">salin</small>
                    </div>
                    <div class="divider"></div>
                    <small class="note">Akan dicek dalam 10 menit setelah pembayaran berhasil</small>
                  </div>
                </div>
                <div id="bri" class="form-check w-100 collapsed">
                  <span><img src="<?= base_url("assets/img/logo/bank-bri.svg")?>" alt="bri logo" width="40px" height="20px"></span>
                  <input type="radio" id="bank_bri" class="bank" name="id_bank" value="2" <?= set_radio('id_bank', '2'); ?> style="appearance: none;">
                  <label for="bank_bri" class="colapse_pilih_bank" data-bs-toggle="collapse" data-bs-target="#section_bri" aria-expanded="false" style="cursor: pointer;">Bank Bri</label>
                  <div id="section_bri" class="accordion-collapse collapse fade collapse-pilih-bank" data-bs-parent="#collapseCC">
                    <!-- collapse pilih bank -->
                    <div class="divider"></div>
                    <small class="rek-title">No. Rekening Admin: </small>
                    <div class="rek-content d-flex justify-content-between mt-1">
                      <small class="no-rek">058 9092 8274 9125</small>
                      <small class="salin-rek">salin</small>
                    </div>
                    <div class="divider"></div>
                    <small class="note">Akan dicek dalam 10 menit setelah pembayaran berhasil</small>
                  </div>
                </div>
                <div id="bca" class="form-check w-100 collapsed" >
                  <span><img src="<?= base_url("assets/img/logo/bank-bca.svg")?>" alt="bca logo" width="40px"></span>
                  <input type="radio" id="bank_bca" class="bank" name="id_bank" value="3" <?= set_radio('id_bank', '3'); ?> style="appearance: none;">
                  <label for="bank_bca" class="colapse_pilih_bank" data-bs-toggle="collapse" data-bs-target="#section_bca" aria-expanded="false" style="cursor: pointer;">Bank BCA</label>
                    <div id="section_bca" class="accordion-collapse collapse fade collapse-pilih-bank" data-bs-parent="#collapseCC">
                      <!-- collapse pilih bank -->
                      <div class="divider"></div>
                      <small class="rek-title">No. Rekening Admin: </small>
                      <div class="rek-content d-flex justify-content-between mt-1">
                        <small class="no-rek">088 7182 4291 9123</small>
                        <small class="salin-rek">salin</small>
                      </div>
                      <div class="divider"></div>
                      <small class="note">Akan dicek dalam 10 menit setelah pembayaran berhasil</small>
                    </div>
                </div>
                <div id="bni" class="form-check w-100 collapsed" >
                  <span><img src="<?= base_url("assets/img/logo/bank-bni.svg")?>" alt="bni logo" width="40px"></span>
                  <input type="radio" id="bank_bni" class="bank" name="id_bank" value="4" <?= set_radio('id_bank', '4'); ?> style="appearance: none;">
                  <label for="bank_bni" class="colapse_pilih_bank" data-bs-toggle="collapse" data-bs-target="#section_bni" aria-expanded="false" style="cursor: pointer;">Bank BNI</label>
                    <div id="section_bni" class="accordion-collapse collapse fade collapse-pilih-bank" data-bs-parent="#collapseCC">
                      <!-- collapse pilih bank -->
                      <div class="divider"></div>
                      <small class="rek-title">No. Rekening Admin: </small>
                      <div class="rek-content d-flex justify-content-between mt-1">
                        <small class="no-rek">098 2937 9823 2341</small>
                        <small class="salin-rek">salin</small>
                      </div>
                      <div class="divider"></div>
                      <small class="note">Akan dicek dalam 10 menit setelah pembayaran berhasil</small>
                    </div>
                </div>

                <!-- petunjuk -->
                <div class="container mt-3" id="container-petunjuk">
                  <div class="accordion" id="accordionPetunjuk">
                    <div class="item">
                      <div class="item-header" id="headingTwo">
                        <h2 class="mb-0">
                          <button class="btn btn-link collapsed d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse"
                              data-bs-target="#transfer-mbanking" aria-expanded="false" aria-controls="transfer-mbanking">
                          <div class="title-accordion-petunjuk">Petunjuk transfer mBanking</div>
                          <img class="title-accordion-petunjuk" src="<?= base_url("assets/icons/angle-down.svg")?>" alt="angle down fas icon" width="18px">
                          </button>
                        </h2>
                      </div>
                      <div id="transfer-mbanking" class="collapse" aria-labelledby="headingTwo"
                          data-bs-parent="#accordionPetunjuk">
                          <div class="t-p">
                            <ol>
                              <li>Pilih m-transfer > antar rekening</li>
                              <li>Masukkan [No. Rekening Admin] beserta jumlah uang</li>
                              <li>klik <strong>send</strong></li>
                              <li>Masukkan pin mBanking anda dan pilih "OK"</li>
                            </ol>
                          </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="item-header" id="headingThree">
                          <h2 class="mb-0">
                            <button class="btn btn-link collapsed d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree">
                              <div class="title-accordion-petunjuk">Petunjuk transfer iBanking</div>
                              <img class="title-accordion-petunjuk" src="<?= base_url("assets/icons/angle-down.svg")?>" alt="angle down fas icon" width="18px">
                            </button>
                          </h2>
                      </div>
                      <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                          data-bs-parent="#accordionPetunjuk">
                          <div class="t-p">
                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                          </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="item-header" id="headingFour">
                          <h2 class="mb-0">
                            <button class="btn btn-link collapsed d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false"
                                aria-controls="collapseFour">
                              <div class="title-accordion-petunjuk">Petunjuk transfer ATM</div>
                              <img class="title-accordion-petunjuk" src="<?= base_url("assets/icons/angle-down.svg")?>" alt="angle down fas icon" width="18px">
                            </button>
                          </h2>
                      </div>
                      <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                          data-bs-parent="#accordionPetunjuk">
                          <div class="t-p">
                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item mb-3 border">
            <h2 class="h5 px-4 py-3 accordion-header d-flex justify-content-between align-items-center">
              <div class="form-check w-100 collapsed" >
                <input class="form-check-input" type="radio" name="id_metode" id="cod" data-bs-toggle="collapse" data-bs-target="#collapsePP" aria-expanded="false" value="2" <?= set_radio('id_metode', "2"); ?>>
                <label class="form-check-label pt-1" for="cod" data-bs-toggle="collapse" data-bs-target="#collapsePP" aria-expanded="false">
                  Cash on Delivery
                </label>
              </div>
              <span>
                <img src="<?= base_url("assets/img/logo/cash-on-delivery.png")?>" height="50px" alt="logo COD"/>
              </span>
            </h2>
            <div id="collapsePP" class="accordion-collapse collapse" data-bs-parent="#accordionMain" >
              <div class="accordion-body">
                <div class="content-cod">
                  <div class="note-cod">Note: gunakan metode ini jika ingin melakukan transaksi secara COD</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Right -->
      <div class="col-lg-3">
        <div class="card position-sticky top-0">
          <div class="p-3 bg-light bg-opacity-10">
            <h6 class="card-title mb-3">Order Summary</h6>
            <div class="d-flex justify-content-between mb-1 small">
              <span>Subtotal</span> <span><span>Rp. </span> <span id="sub-total">0</span></span>
            </div>
            <div class="d-flex justify-content-between mb-1 small">
              <span>Ongkir</span> <span><span>Rp. </span><span id="ongkir" data-valueOngkir="10000">10000</span></span>
            </div>
            <div class="d-flex justify-content-between mb-1 small">
              <span>Kupon (kode: tidak ada kupon)</span> <span class="text-danger"><span>Rp. </span><span id="kupon" data-valueKupon="0">0</span></span>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-4 small">
              <span>TOTAL</span> <strong class="text-dark"><span>Rp. </span><span id="total">10000</span></strong>
              <input type="hidden" name="input_total" id="input_total" value="<?= set_value('input_total'); ?>">
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2">Submit</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>