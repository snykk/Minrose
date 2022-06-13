<div class="modal fade" id="ModalEditReview" tabindex="-1" aria-labelledby="ModalEditReviewLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalEditReviewLabel">Edit Review</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open_multipart('ulasan/edit_ulasan'); ?>

      <input type="hidden" name="id_produk" id="id_produk">
      <div class="modal-body">
        <p style="margin-bottom: 0 !important;">Pilih rating</p>

        <div class="rating-wrapperr">
          <!-- star 5 -->
          <input type="radio" id="5-star-rating_edit" name="star-rating_edit" value="5" <?= set_radio('star-rating_edit', '5'); ?>>
          <label for="5-star-rating_edit" class="star-rating_edit">
            <i class="fas fa-star d-inline-block"></i>
          </label>

          <!-- star 4 -->
          <input type="radio" id="4-star-rating_edit" name="star-rating_edit" value="4" <?= set_radio('star-rating_edit', '4'); ?>>
          <label for="4-star-rating_edit" class="star-rating_edit star">
            <i class="fas fa-star d-inline-block"></i>
          </label>

          <!-- star 3 -->
          <input type="radio" id="3-star-rating_edit" name="star-rating_edit" value="3" <?= set_radio('star-rating_edit', '3'); ?>>
          <label for="3-star-rating_edit" class="star-rating_edit star">
            <i class="fas fa-star d-inline-block"></i>
          </label>

          <!-- star 2 -->
          <input type="radio" id="2-star-rating_edit" name="star-rating_edit" value="2" <?= set_radio('star-rating_edit', '2'); ?>>
          <label for="2-star-rating_edit" class="star-rating_edit star">
            <i class="fas fa-star d-inline-block"></i>
          </label>

          <!-- star 1 -->
          <input type="radio" id="1-star-rating_edit" name="star-rating_edit" value="1" <?= set_radio('star-rating_edit', '1'); ?>>
          <label for="1-star-rating_edit" class="star-rating star">
            <i class="fas fa-star d-inline-block"></i>
          </label>
        </div>

        <div class="mb-3">
          <label for="ulasan_edit" class="col-form-label">Ulasan</label>
          <textarea class="form-control" name="ulasan_edit" id="ulasan_edit"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-dark">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>