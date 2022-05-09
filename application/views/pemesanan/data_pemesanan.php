<div class="container">
    
    <!-- flasher -->
    <?php
        echo $this->session->flashdata('message');
        unset($_SESSION["message"]);
    ?>

    <div class="panel panel-default panel-order">
        <?php if ($pemesanan->num_rows() == 0) {?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center mt-4">
                            <h1 class="display-1">?</h1>
                            <p class="lead">No Data</p>
                            <p>Tidak ada data pemesanan untuk saat ini</p>
                            <a href="<?= base_url("produk")?>" class="link-info">
                                <i class="fas fa-arrow-left me-1"></i>
                                Beli Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else {?>
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
            <?php foreach ($pemesanan->result_array() as $row) :?>
            <div class="row">
                <div class="col-md-1">
                    <img src="<?= base_url("assets/img/produk/") . $row["image"]?>" class="media-object img-thumbnail" />
                    <div class="detail-pemesanan"><a class="detail_data_pemesanan" data-bs-toggle="modal" data-bs-target="#ModalDetailDataPemesanan" title="detail pemesanan" style="cursor: pointer;" data-id="<?= $row["id_pemesanan"]; ?>" data-dipesan="<?= date('d-m-Y', $user['data_dibuat']); ?>" >detail</a></div>
                </div>
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right"><label class="badge bg-<?= $row["style_status"]; ?>"><?= $row["status_pemesanan"]?></label></div>
                            <span><strong><?= $row["nama_produk"]?></strong></span> <span class="badge bg-primary"><?= $row["metode_pembayaran"]?></span><br />
                            Kuantitas : <?= $row["jumlah_produk"]?>, Total harga: Rp. <?= $row["total_harga"]?> <br />
                            <small>Catatan: <?= $row["catatan_pemesanan"]?></small><br>

                            <?php if ( $row["metode_pembayaran"] === "Transfer Bank" && $this->session->userdata('role_id') == 2) : ?>
                                <small>Action </small><a data-placement="top" class="btn btn-danger btn-xs fa fa-fw fa-camera label-bukti" style="font-size: 0.75rem;padding:0.3rem; color:white" data-bs-toggle="modal" data-bs-target="#ModalUploadBukti" title="Kirim bukti"></a>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($this->session->userdata('role_id') == 1) {
                            $dest = "home/customers?username=" . $row["username"];
                        } else {
                            $dest = "profile/user_profile";
                        } ?>
                        <div class="col-md-12">pesanan dibuat pada: <?= date('d/m/Y', $user['data_dibuat']); ?> oleh <a href="<?= base_url($dest); ?>" style="text-decoration:none;">@<?= $row["username"]?></a></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div> 
        <div class="panel-footer mb-3 mt-1">Note: yuhu ini note tambahan buat user gitu gatau mau diisi apa</div>
        <?php }?>
    </div>
</div>