        <!-- Tambah Produk -->
        <div id="ModalTambahProduk" class="modal fade" style="text-transform: capitalize;">
          <div class="modal-dialog">
            <div class="modal-content">
              <?= form_open_multipart('produk/addProduk'); ?>
                <div class="modal-header">
                  <h4 class="modal-title">tambahkan produk</h4>
                  <button type="button" class="close" data-bs-dismiss="modal" type="button" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nama_produk">name produk</label>
                    <input id="nama_produk" name="nama_produk" value="<?= set_value('nama_produk'); ?>" type="text" class="form-control" required>
                    <?= form_error('nama_produk', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>				
                  <div class="form-group">
                    <label for="orientasi" class="form-label">orientasi</label>
                    <textarea class="form-control" id="orientasi" name="orientasi" rows="3" value="<?= set_value('orientasi'); ?>"></textarea>
                    <?= form_error('orientasi', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>		
                  <div class="form-group">
                    <label for="deskripsi" class="form-label">deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" value="<?= set_value('deskripsi'); ?>"></textarea>
                    <?= form_error('deskripsi', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="harga">harga</label>
                    <input id="harga" name="harga" type="text" class="form-control" value="<?= set_value('harga'); ?>">
                    <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>				
                  <div class="form-group">
                    <label for="stok">stok</label>
                    <input id="stok" name="stok" type="text" class="form-control" value="<?= set_value('stok'); ?>">
                    <?= form_error('stok', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="diskon">diskon</label>
                    <input id="diskon" name="diskon" value="" type="text" class="form-control" value="<?= set_value('diskon'); ?>">
                    <?= form_error('diskon', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>				
                  <div class="custom-file">
                    <label class="custom-file-label" for="image">Gambar</label> <br>
                    <input type="file" class="custom-file-input" id="image" name="image" value="<?= set_value('image'); ?>">
                    <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>				
                </div>
                <div class="modal-footer">
                  <button class="btn btn-outline-info" data-bs-dismiss="modal" type="button"> kembali</button>
                  <button class="btn btn btn-outline-dark" data-bs-dismiss="modal" type="submit">tambahkan</button>
                </div>
              </form>
            </div>
          </div>
        </div>