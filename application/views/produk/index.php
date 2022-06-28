<!-- product -->
<section id="team" class="pb-5">
    <div class="container">

        <?php
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
        ?>

        <h5 class="section-title h1">PRODUK KAMI</h5>
        <div class="row justify-content-center">
            <?php foreach ($produk->result() as $row) : ?>
                <!-- Produk card -->
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                        <div class="mainflip">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <p><img class=" img-fluid" src="<?= base_url('assets/img/produk/') . $row->image;  ?>" alt="Minrose Cup"></p>
                                        <h4 class="card-title"><?= $row->nama; ?></h4>
                                        <p class="card-text"><?= $row->orientasi; ?></p>
                                        <div class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="backside">
                                <div class="card">
                                    <div class="card-body text-center mt-4">
                                        <h4 class="card-title"><?= $row->nama; ?></h4>
                                        <p class="card-text">Upsss cieee pasti penasaran yaaa? 😄 klik "detail Produk" di bawah</p>

                                        <!-- detail -->
                                        <button data-id="<?= $row->id; ?>" class="btn btn-primary btn-sm detail" data-bs-toggle="modal" data-bs-target="#ModalDetail">Detail</button>

                                        <!-- ulasan -->
                                        <a href="<?= base_url("ulasan?id_produk=" . $row->id) ?>"><button class="btn btn-primary btn-sm ubah">Ulasan</button></a>

                                        <!-- [admin] ubah -->
                                        <?php if ($user['role_id'] == 1) : ?>
                                            <a href="<?= base_url("produk/ubah_produk?id=" . $row->id) ?>"><button class="btn btn-primary btn-sm ubah">Ubah</button></a>
                                        <?php endif; ?>

                                        <!-- [user] beli -->
                                        <?php if ($user['role_id'] == 2) : ?>
                                            <a href="<?= base_url("pemesanan/buat_pemesanan?id_produk=" . $row->id) ?>"><button class="btn btn-primary btn-sm ubah">Beli</button></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./product card -->
            <?php endforeach; ?>
        </div>
        <?php if ($user["role_id"] == 1) : ?>
            <div class="d-flex align-items-end flex-column">
                <a style="text-decoration: none;" href="<?= base_url("produk/tambah_produk"); ?>">
                    <div class="text-right button-kemren mr-lg-5 mr-sm-3">pe</div>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- product -->