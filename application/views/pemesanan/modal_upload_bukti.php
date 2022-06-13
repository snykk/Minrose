<!-- Upload Bukti -->
<div id="ModalUploadBukti" class="modal fade" style="text-transform: capitalize;" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">upload bukti transfer</h4>
                <button type="button" class="close" data-bs-dismiss="modal" type="button" aria-hidden="true">&times;</button>
            </div>
            <?= form_open_multipart('pemesanan/setBuktiTransfer'); ?>
            <input type="hidden" id="id_pemesanan_upload" name="id">
            <div class="modal-body">
                <div class="d-flex flex-column align-items-center text-center">
                    <img id="image_ubah" width="150">
                    <div class="mt-3">
                        <p class="text-secondary mb-1">upload bukti transfer</p>
                        <div class="custom-file">
                            <input type="file" class="form-control" id="image" name="image" value="<?= set_value('image'); ?>">
                            <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal" type="button"> kembali</button>
                <button class="btn btn btn-outline-dark" data-bs-dismiss="modal" type="submit">upload</button>
            </div>
            </form>
        </div>
    </div>
</div>