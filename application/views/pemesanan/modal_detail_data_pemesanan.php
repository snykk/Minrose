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
                        <span class="subheadings">@seseorang</span>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="heading d-block">tanggal dipesan</span>
                        <span class="subheadings">3-01-2022</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="heading d-block">jumlah produk</span>
                        <span class="subheadings">5</span>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="heading d-block">Alamat</span>
                        <span class="subheadings">Jln. Pattimura no 45</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="heading d-block">metode</span>
                        <span class="subheadings">transfer bank</span>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="heading d-block">status</span>
                        <span class="subheadings"><i class="dots"></i> disetujui</span>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="heading d-block">bukti transaksi</span>
                        <span class="d-flex flex-row gallery"> <img src="<?= base_url("assets/img/bukti/default.png")?>" width="100px" class="rounded"> </span>
                      </div>
                    </td>
                    <td>
                      <span class="heading d-block">catatan</span>
                      <span class="subheadings" style="text-transform: lowercase;"> sedang menunggu pertemuan COD</span>
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
                <img src="<?= base_url("assets/img/produk/minrose-cup.jpeg")?>" width="150px">
                <span class="d-block my-2" style="font-size: 14px;">minrose cup</span>
                <a data-bs-dismiss="modal" data-bs-toggle="modal" href="#ModalUbahDataPemesanan" title="detail pemesanan" title="ubah data pemesanan"><button class="btn btn-outline-dark">ubah</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
