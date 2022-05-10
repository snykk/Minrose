<!-- Modal -->
<div class="modal fade" id="ModalDetailDataPemesanan" tabindex="-1" aria-labelledby="ModalDetailDataPemesananLabel" aria-hidden="true" style="text-transform: capitalize" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalDetailDataPemesananLabel">detail data pemesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" data-bs-dismiss="modal"><i class="fa fa-close"></i></span>
        </button>
      </div>
      <div class="modal-body detail">
        <div class="row g-0">
          <div class="col-md-8 border-right">
            <div class="status p-3">
              <table class="table table-borderless">
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="heading d-block">dipesan oleh</span>
                        <span class="subheadings" id="username_detail"> <!-- content dipesan oleh --> </span>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="heading d-block">tanggal dipesan</span>
                        <span class="subheadings" id="tanggal_dipesan_detail"> <!-- content tanggal pemesanan --> </span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="heading d-block">jumlah produk</span>
                        <span class="subheadings" id="jumlah_produk_detail"> <!-- content jumlah produk --> </span>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="heading d-block">alamat</span>
                        <span class="subheadings" id="alamat_detail"> <!-- content alamat --> </span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="heading d-block">metode</span>
                        <span class="subheadings" id="metode_detail"> <!-- content metode --> </span>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="heading d-block">status</span>
                        <div class="subheadings d-flex justify-content-start align-items-center mt-1">
                          <div id="style_status" style="margin-right: 8px;"></div>
                          <div id="status_detail"> <!-- content status --> </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr id="row_bank">
                    <td>
                      <div class="d-flex flex-column">
                        <span class="heading d-block">nama bank</span>
                        <span class="subheadings" id="bank_detail"> <!-- content nama bank --> </span>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="heading d-block">no. rekening</span>
                        <span class="subheadings" style="color:red;" id="no_rekening_detail"> <!-- content no rekening bank --></span>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td id="modal_section_detail_bukti">
                      <div class="d-flex flex-column">
                        <span class="heading d-block">bukti transfer</span>
                        <span class="d-flex flex-row gallery"> <img id="bukti_transfer_detail" src="<?= base_url("assets/img/bukti/default.png")?>" width="100px" class="rounded" alt="bukti transfer"> </span>
                      </div>
                    </td>
                    <td>
                      <span class="heading d-block">catatan</span>
                      <span class="subheadings" style="text-transform: lowercase;" id="catatan_transaksi_detail"> <!-- content catatan transaksi --> </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-2 text-center">
              <div class="Produk">
                <h1 style="font-size: 18px;">Produk</h1>
                <img id="image_detail" width="150px">
                <span class="d-block my-2" style="font-size: 14px;" id="nama_produk_detail">minrose cup</span>
                <div class="d-flex justify-content-center align-items-cetner mb-3">
                  <div>Total Harga: Rp.</div>
                  <div style="margin-left:5px" id="total_harga_detail"></div>
                </div>
                <!-- <a data-bs-dismiss="modal" data-bs-toggle="modal" href="#ModalUbahDataPemesanan" title="detail pemesanan" title="ubah data pemesanan"><button class="btn btn-outline-dark">ubah</button></a> -->

                <?php if ($this->session->userdata('role_id') == 2) :?>
                <a id="link_ubah" title="ubah data pemesanan"><button class="btn btn-outline-dark mb-3">ubah</button></a>
                <?php endif; ?>
                
                <?php if ($this->session->userdata('role_id') == 1) :?>
                <a id="link_tolak" href="<?= base_url("pemesanan/ditolak") ?>" title="tolak data pemesanan"><button class="btn btn-outline-danger mb-3">ditolak</button></a>
                <a id="link_selesai" href="<?= base_url("pemesanan/selesai") ?>" title="akhiri data pemesanan"><button class="btn btn-outline-info mb-3">selesai</button></a>
                <a id="link_setujui" href="<?= base_url("pemesanan/disetujui") ?>" title="setujui data pemesanan"><button class="btn btn-outline-success mb-3">setujui</button></a>
                <?php endif; ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
