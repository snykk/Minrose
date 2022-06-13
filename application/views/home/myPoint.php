<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid mt-5">
                <div class="text-center">
                    <div class="point mx-auto"><sup style="font-size: 4rem; left: 1rem;"><?= $user["point"]; ?></sup>/<sub style="font-size: 4rem; left: -1rem;">150</sub> </div>
                    <p class="lead text-gray-800 mt-3">Point Anda</p>
                    <p class="text-gray-500 mb-2 mt-3">Dapatkan point setiap membeli produk kami untuk mendapatkan produk gratis</p>
                    <a type="submit" id="ambil_point" class="btn btn-success text-white mt-5" data-validKah="<?= $user['point'] >= 150 ? 'true' : 'false' ?>" href="<?= base_url("home/ambilPoint"); ?>">Ambil point anda</a>
                    <div class="text-muted mt-5" style="font-size: 2rem;">Kupon saat ini : <?= $user['kupon'] ?></div>
                </div>
            </div>
        </div>
    </div>
</div>