<!-- Upload Bukti -->
<div id="ModalUbahDataPemesanan" class="modal fade" style="text-transform: capitalize;" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ubah pemesanan</h4>
                <button type="button" class="close" data-bs-dismiss="modal" type="button" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="nama_produk">name produk</label>
                    <input id="nama_produk" name="nama_produk" value="Minrose Cup<?=""// set_value('nama_produk'); ?>" type="text" class="form-control">
                    <?= form_error('nama_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group mb-3 col-3">
                    <label for="jumlah_produk">Jumlah Produk</label>
                    <input id="jumlah_produk" name="jumlah_produk" value="<?= set_value('jumlah_produk', "0"); ?>" type="number" min="0" max="" class="form-control" required>
                    <?= form_error('jumlah_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group mb-3">
                    <label for="nama_produk">oleh</label>
                    <input id="nama_produk" name="nama_produk" value="@iya pen ngubah aja<?=""// set_value('nama_produk'); ?>" type="text" class="form-control" disabled>
                    <?= form_error('nama_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group mb-3">
                    <label for="nama_produk">alamat</label>
                    <input id="nama_produk" name="nama_produk" value="inialamatku<?=""// set_value('nama_produk'); ?>" type="text" class="form-control">
                    <?= form_error('nama_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group mb-3">
                    <label for="nama_produk">Metode</label>
                    <select class="form-select form-select-lg" aria-label=".form-select-lg example">
                        <option selected value="cod">transfer bank</option>
                        <?php $st = ("transfer bank" != "cod") ? "cod": "transfer bank" ?>
                        <option value="<?= $st?>"> <?= $st?></option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="nama_produk">total harga</label>
                    <input id="nama_produk" name="nama_produk" value="Rp. 60000<?=""// set_value('nama_produk'); ?>" type="text" class="form-control" disabled>
                    <?= form_error('nama_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <?php if (true) :?>
                <div class="form-group mb-3">
                    <label for="nama_produk"  class="d-flex justify-content-center align-items-center mb-2" style="font-size: 20px;">bukti transfer</label>
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?= base_url('assets/img/bukti/default.png') //.  $user['image']; ?>" width="150">
                        <div class="mt-3">
                            <p class="text-secondary mb-1">upload bukti transfer</p>
                            <a data-bs-dismiss="modal" data-bs-toggle="modal" href="#ModalUploadBukti" title="upload bukti" style="text-decoration: none;color:red">upload</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal" type="button"> kembali</button>
                <button class="btn btn btn-outline-dark" data-bs-dismiss="modal" type="submit">ubah</button>
            </div>
        </div>
    </div>
</div> 