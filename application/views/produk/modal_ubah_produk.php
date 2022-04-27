        <!-- Tambah Produk -->
        <div id="ModalUbahProduk" class="modal fade" style="text-transform: capitalize;">
          <div class="modal-dialog">
            <div class="modal-content">
              <?= form_open_multipart('produk/editProduk'); ?>
                <div class="modal-header">
                  <h4 class="modal-title">ubah produk</h4>
                  <button type="button" class="close" data-bs-dismiss="modal" type="button" aria-hidden="true">&times;</button>
                </div>		
                <div class="modal-body">
                  <div class="form-group">
                    <input id="produk_id" name="produk_id" type="hidden" class="form-control">
                  </div>		
                  <div class="form-group">
                    <label for="ubah_nama_produk">name produk</label>
                    <input id="ubah_nama_produk" name="ubah_nama_produk" type="text" class="form-control">
                  </div>				
                  <div class="form-group">
                    <label for="ubah_orientasi" class="form-label">orientasi</label>
                    <textarea class="form-control" id="ubah_orientasi" name="ubah_orientasi" rows="3" value="<?= set_value('ubah_orientasi'); ?>"></textarea>
                    <?= form_error('ubah_orientasi', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>		
                  <div class="form-group">
                    <label for="ubah_deskripsi" class="form-label">deskripsi</label>
                    <textarea class="form-control" id="ubah_deskripsi" name="ubah_deskripsi" rows="3" value="<?= set_value('ubah_deskripsi'); ?>"></textarea>
                    <?= form_error('ubah_deskripsi', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="ubah_harga">harga</label>
                    <input id="ubah_harga" name="ubah_harga" type="text" class="form-control" value="<?= set_value('ubah_harga'); ?>">
                    <?= form_error('ubah_harga', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>				
                  <div class="form-group">
                    <label for="ubah_stok">stok</label>
                    <input id="ubah_stok" name="ubah_stok" type="text" class="form-control" value="<?= set_value('ubah_stok'); ?>">
                    <?= form_error('ubah_stok', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="ubah_diskon">diskon</label>
                    <input id="ubah_diskon" name="ubah_diskon" value="" type="text" class="form-control" value="<?= set_value('ubah_diskon'); ?>">
                    <?= form_error('ubah_diskon', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>				
                  <div class="custom-file">
                    <label class="custom-file-label" for="ubah_image">Gambar</label> <br>
                    <input type="file" class="custom-file-input" id="ubah_image" name="ubah_image" value="<?= set_value('ubah_image'); ?>">
                    <?= form_error('ubah_image', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>				
                </div>
                <div class="modal-footer">
                  <button class="btn btn-outline-info" data-bs-dismiss="modal" type="button"> kembali</button>
                  <button class="btn btn btn-outline-dark" data-bs-dismiss="modal" type="submit">ubah</button>
                </div>
              </form>
            </div>
          </div>
        </div>