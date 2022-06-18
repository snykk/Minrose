<!-- data pemesanan -->
<?php foreach ($pemesanan->result_array() as $row) : ?>
    <div class="row">
        <div class="col-md-1">
            <img src="<?= base_url("assets/img/produk/") . $row["image_produk"] ?>" class="media-object img-thumbnail" />
            <div class="detail-pemesanan"><a class="detail_data_pemesanan" data-bs-toggle="modal" data-bs-target="#ModalDetailDataPemesanan" title="detail pemesanan" style="cursor: pointer;" data-id="<?= $row["id_pemesanan"]; ?>" data-dipesan="<?= date('d-m-Y', $row['tanggal_pemesanan']); ?>">detail</a></div>
        </div>
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right"><label class="badge bg-<?= $row["style_status"]; ?>"><?= $row["status_pemesanan"] ?></label></div>
                    <span><strong><?= $row["nama_produk"] ?></strong></span> <span class="badge bg-primary"><?= $row["metode_pembayaran"] ?></span><br />
                    Kuantitas : <?= $row["jumlah_produk"] ?>, Total harga: Rp. <?= $row["total_harga"] ?> <br />
                    <small>Catatan: <?= (isset($row["alasan_penolakan"])) ?  $row["alasan_penolakan"] : $row["catatan_pemesanan"]; ?></small><br>

                    <?php if ($row["metode_pembayaran"] === "Transfer Bank" && $this->session->userdata('role_id') == 2) : ?>
                        <small>Action </small>
                        <a data-bs-placement="top" class="iniUploadBukti" data-bs-toggle="modal" data-id="<?= $row["id_pemesanan"] ?>" data-bs-target="<?= ($row["id_status"] != 2) ? "#ModalUploadBuktiDitolak" : "#ModalUploadBukti"; ?>" title="Kirim bukti">
                            <div class="btn btn-danger btn-xs fa fa-fw fa-camera label-bukti" style="font-size: 0.75rem;padding:0.3rem; color:white">
                            </div>
                        </a>
                    <?php endif; ?>

                    <?php if (isset($row["id_produk"]) && $this->session->userdata('role_id') == 2 && $row["is_done"] == 1) : ?>
                        <div>
                            <a href="<?= base_url("ulasan?id_produk=") . $row["id_produk"]; ?>" class="link-info" style="text-decoration: none; font-size:0.9rem;">
                                Ulas sekarang!
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($this->session->userdata('role_id') == 1) {
                    $dest = "home/customers?username=" . $row["username"];
                } else {
                    $dest = "profile/user_profile";
                } ?>

                <?php if ($row["is_done"] == '1 ') { ?>
                    <div class="col-md-12">pesanan diakhiri pada <?= date('d/m/Y', $row['pesanan_diubah']); ?>
                        oleh <span class="link-danger" style="cursor: pointer;">@admin</span>
                    </div>
                <?php } else { ?>
                    <div class="col-md-12">pesanan dibuat pada <?= date('d/m/Y', $row['tanggal_pemesanan']); ?>
                        oleh <a href="<?= base_url($dest); ?>" style="text-decoration:none;">@<?= $row["username"] ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<div class="mb-5"></div>