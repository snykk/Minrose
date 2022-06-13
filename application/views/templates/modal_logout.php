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