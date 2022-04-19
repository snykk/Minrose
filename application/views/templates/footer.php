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


        <!-- Modal untuk logout -->
        <!-- Modal -->
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url("assets/") ?>js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url("assets/") ?>js/chart-area.js"></script>
        <script src="<?= base_url("assets/") ?>js/chart-bar.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="<?= base_url("assets/") ?>js/tabel_user.js"></script>
        </body>

        </html>