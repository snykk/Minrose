<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="text-center mt-4">
                <h1 class="display-1">?</h1>
                <p class="lead">No Data</p>
                <?php
                $status = [
                    1 => "disetujui",
                    2 => "pending",
                    3 => "ditolak",
                    5 => "dibatalkan",
                ];
                if (!isset($_GET["filter"])) { ?>
                    <p>Tidak ada data pemesanan untuk saat ini</p>
                <?php } else { ?>
                    <p>Tidak ada data pemesanan dengan status <?= $status[$_GET["filter"]]; ?></p>
                <?php } ?>
                <?php if ($this->session->userdata("role_id") == 2) { ?>
                    <a href="<?= base_url("produk") ?>" class="link-info">
                        <i class="fas fa-arrow-left me-1"></i>
                        Beli Sekarang
                    </a>
                <?php } else { ?>
                    <a href="<?= base_url("pemesanan/riwayat_pemesanan") ?>" class="link-info">
                        <i class="fas fa-arrow-left me-1"></i>
                        Transaksi
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>