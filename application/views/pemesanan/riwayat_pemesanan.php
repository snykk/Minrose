<div class="container">
    <div class="panel panel-default panel-order">
        <div class="panel-heading d-flex justify-content-between align-items-center">
            <h1 class="main-title"><?= $title; ?></h1>
            <div class="btn-group pull-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-bs-toggle="dropdown">Filter history <i class="fa fa-filter"></i></button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-item"><a href="#">Approved orders</a></li>
                        <li class="dropdown-item"><a href="#">Pending orders</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="panel-body mt-3">
            <!-- data pemesanan -->
            <div class="row">
                <div class="col-md-1">
                    <img src="<?= base_url("assets/img/produk/minrose-cup.jpeg")?>" class="media-object img-thumbnail" />
                    <div class="detail-pemesanan"><a data-bs-toggle="modal" data-bs-target="#ModalDetailDataPemesanan" title="detail pemesanan" style="cursor: pointer;">detail</a></div>
                </div>
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right"><label class="badge bg-info">selesai</label></div>
                            <span><strong>Minrose Cup</strong></span> <span class="badge bg-primary">COD</span><br />
                            Kuantitas : 2, Total harga: Rp. 20.000 <br />
                            <small>Catatan: transaksi berhasil</small><br>
                        </div>
                        <?php if ($this->session->userdata('role_id') == 1) {
                            $dest = "home/customers?nama_lengkap=iya ini pen ngubah aja";
                        } else {
                            $dest = "profile/user_profile";
                        } ?>
                        <div class="col-md-12">pesanan dibuat pada: 05/31/2022 oleh <a href="<?= base_url($dest); ?>">@iya ini pen ngubah aja </a></div>
                    </div>
                </div>
            </div>
            <!-- tutup data pemesanan -->

            <!-- data pemesanan -->
            <div class="row">
                <div class="col-md-1">
                    <img src="<?= base_url("assets/img/produk/minrose-cup.jpeg")?>" class="media-object img-thumbnail" />
                    <div class="detail-pemesanan"><a data-bs-toggle="modal" data-bs-target="#ModalDetailDataPemesanan" title="detail pemesanan" style="cursor: pointer;">detail</a></div>
                </div>
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right"><label class="badge bg-info">selesai</label></div>
                            <span><strong>Minrose Cup</strong></span> <span class="badge bg-primary">Transfer Bank</span><br />
                            Kuantitas : 12, Total harga: Rp. 10.000<br />
                            <small>Catatan: transaksi berhasil</small><br>

                            <?php if ($this->session->userdata('role_id') == 2) : ?>
                                <small>Action </small><a data-placement="top" class="btn btn-danger btn-xs fa fa-fw fa-camera label-bukti" style="font-size: 0.75rem;padding:0.3rem; color:white" data-bs-toggle="modal" data-bs-target="#ModalUploadBukti" title="Kirim bukti"></a>
                            <?php endif; ?>
                            
                        </div>
                        <div class="col-md-12">pesanan dibuat pada: 06/12/2022 oleh <a href="#">@iya ini pen ngubah aja </a></div>
                    </div>
                </div>
            </div>
            <!-- tutup data pemesanan -->
        </div>
        <div class="panel-footer">Note: yuhu ini note tambahan buat user gitu gatau mau diisi apa</div>
    </div>
</div>