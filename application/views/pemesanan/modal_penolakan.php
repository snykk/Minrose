<!-- Upload Bukti -->
<div id="ModalPenolakan" class="modal fade" style="text-transform: capitalize;" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">alasan penolakan pemesanan</h4>
                <button type="button" class="close" data-bs-dismiss="modal" type="button" aria-hidden="true">&times;</button>
            </div>
            <?= form_open_multipart('pemesanan/ditolak'); ?>
            <input type="hidden" id="id_pemesanan_ditolak" name="id">
            <div class="modal-body">
                <div class="form-group">
                    <label for="alasan_penolakan">alasan penolakan</label>
                    <input id="alasan_penolakan" name="alasan_penolakan" type="text" class="form-control mt-1" >
                </div>
                </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" href="#ModalDetailDataPemesanan" type="button"> kembali</button>
                <button id="submit_penolakan" class="btn btn btn-outline-dark" data-bs-dismiss="modal" type="submit">submit</button>
            </div>
            </form>
        </div>
    </div>
</div> 