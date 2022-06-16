<div class="container">

    <!-- flasher -->
    <?php
    echo $this->session->flashdata('message');
    unset($_SESSION["message"]);
    ?>

    <div class="panel panel-default panel-order">
        <div class="panel-heading d-flex justify-content-between align-items-center">
            <h1 class="main-title"><?= $title; ?></h1>
            <?php if ($title == "Data Pemesanan") : ?>
                <div class="btn-group pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-bs-toggle="dropdown">Filter history <i class="fa fa-filter"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <a href="<?= base_url("pemesanan/data_pemesanan?filter=1") ?>">
                                <li class="dropdown-item">disetujui
                                </li>
                            </a>
                            <a href="<?= base_url("pemesanan/data_pemesanan?filter=2") ?>">
                                <li class="dropdown-item">pending</li>
                            </a>
                            <a href="<?= base_url("pemesanan/data_pemesanan?filter=3") ?>">
                                <li class="dropdown-item">ditolak</li>
                            </a>
                            <a href="<?= base_url("pemesanan/data_pemesanan?filter=5") ?>">
                                <li class="dropdown-item">dibatalkan</li>
                            </a>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <a href="<?= base_url("pemesanan/data_pemesanan") ?>">
                                <li class="dropdown-item">tampilkan semua</li>
                            </a>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="panel-body mt-3">