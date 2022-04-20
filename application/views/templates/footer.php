        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-center small">
              Copyright &copy; Minrose <?= date('Y'); ?>
              <!-- <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
              </div> -->
            </div>
          </div>
        </footer>
        </div>
        </div>


        <!-- Modal Logout -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                klik "logout" di bawah jika anda ingin mengakhiri session anda saat ini
              </div>
              <div class="modal-footer">
                <a href="<?= base_url('home/index'); ?>" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</a>
                <a href="<?= base_url('auth/logout'); ?>" type="button" class="btn btn-dark">Logout</a>
              </div>
            </div>
          </div>
        </div>
        <!--Tutup Modal Logut -->

        <!-- Modal Detail Produk -->
        <div class="program-modal modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="close-modal" data-bs-dismiss="modal"><img src="<?= base_url('assets/icons/close-icon.svg') ?>" alt="Close modal" /></div>
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-lg-8">
                    <div class="modal-body">
                      <!-- Project details-->
                      <h2 class="text-uppercase">
                        Hallo
                      </h2>
                      <br>
                      <p class="orientasi text-center">
                      <!-- content orientasi -->
                      </p>
                      <img id="modal-image" src="<?= base_url("assets/img/produk/"); ?>" width="70%" class="img-fluid d-block mx-auto" alt="" />
                      <div>
                        <h3>
                          Deskripsi
                        </h3>
                        <div class="content">
                          <div>
                              <p class="deskripsi">
                                <!-- content deskripsi -->
                              </p>
                          </div>
                          <div class="pembagi"></div>
                          <div class="harga">
                            <!-- content harga -->
                          </div>
                          <div class="stok mb-4">
                            <!-- content stok -->
                          </div>
                        </div>
                      </div>
                      <button class="btn btn-primary btn-xl j" data-bs-dismiss="modal" type="button" > KEMBALI
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Tutup Modal Detail Produk -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="<?= base_url("assets/") ?>js/scripts.js"></script>
        <script src="<?= base_url("assets/") ?>js/chart-area.js"></script>
        <script src="<?= base_url("assets/") ?>js/chart-bar.js"></script>
        <script src="<?= base_url("assets/") ?>js/tabel_user.js"></script>
        <?php if (isset($js)) : ?>
          <script src="<?= base_url("assets/") ?>js/<?= $js; ?>.js"></script>
        <?php endif;?>
        </body>

        </html>