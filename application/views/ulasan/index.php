<div class="container-xl">
    
    <?php
    echo $this->session->flashdata('message');
    unset($_SESSION['message']);
    ?>
    
    <div class="col-md-12">
        <div class="offer-dedicated-body-left">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                    <!-- overview produk -->
                    <div id="ratings-and-reviews" class="bg-white rounded shadow-sm p-4 mb-4 clearfix restaurant-detailed-star-rating mt-3">
                      <div class="row">
                        <div class="col-12 col-sm-auto mb-3">
                          <img class="img-account-profile mb-2" src="<?= base_url('assets/img/produk/') . $produk["image"]; ?>" width="200" alt="" />
                        </div>
                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                          <div class="text-sm-left mb-2 mb-sm-0">
                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?= $produk["nama"]?></h4>
                            <div class="text-muted">
                              <small>
                                <?= $produk["deskripsi"]?>
                              </small>
                            </div>
                            <div class="text-muted mt-3">
                                <span>Harga : </span>
                                <span><?= $produk["harga"]; ?></span>
                            </div>
                            <div class="text-muted">
                                <span>Tersedia : </span>
                                <span><?= $produk["stok"]; ?> stok</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- grafik rating dan review -->
                    <div class="bg-white rounded shadow-sm p-4 mb-4 clearfix graph-star-rating">
                        <h5 class="mb-0 mb-4">Ratings and Reviews</h5>
                        <div class="graph-star-rating-header">
                          <div class="ratings">
                            <?php 
                            $jml_rating = round($rateStar, 2);
                            for ($i = 1 ; $i <= 5; $i++) {
                              if ($i < $jml_rating) {
                                echo '<i class="fa fa-star rating-color"></i>';
                              } else if ($i - 1 < $jml_rating && $jml_rating< $i) {
                                echo '<i class="fa fa-star-half-stroke rating-color"></i>';
                              } else {
                                echo '<i class="fa fa-star"></i>';
                              }
                            }
                            ?>
                          </div>
                          <p class="text-black mb-4 mt-2">Rated <?= round($rateStar, 2); ?> out of 5</p>
                        </div>
                        <div class="graph-star-rating-body">
                            <?php for ($star = 4; 0 <= $star; $star--) : ?>
                            <div class="rating-list">
                                <div class="rating-list-left text-black">
                                    <?= $star + 1; ?> Star
                                </div>
                                <div class="rating-list-center">
                                    <div class="progress">
                                        <div style="width: <?= ($sum==0) ? 0 : $starCounter[$star]/$sum * 100; ?>%" aria-valuemax="<?= $star; ?>" aria-valuemin="0" aria-valuenow="<?= $star; ?>" role="progressbar" class="progress-bar bg-warning">
                                        </div>
                                    </div>
                                </div>
                                <div class="rating-list-right text-black"><?= ($sum==0) ? 0 : round($starCounter[$star]/$sum * 100); ?>%</div>
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <!-- Reply rating dan review dari user -->
                    <div class="bg-white rounded shadow-sm p-4 mb-4 restaurant-detailed-ratings-and-reviews">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">All Ratings and Reviews</h5>
                            <a href="#" class="btn btn-outline-primary btn-sm float-end">Scroll to Product</a>
                        </div>
                        <div class="reviews-members pt-4 pb-4">

                            <?php if ($ulasan != []){ ?>
                              <!-- konten ulasan -->
                              <?php foreach ($ulasan as $row) :?>
                              <div class="media d-flex">
                                  <a href="#"><img alt="Generic placeholder image" src="<?= base_url("assets/img/profile/") . $row["profile_user"]?>" class="mr-3 mt-3 rounded-pill"></a>
                                  <div class="media-body w-100">
                                      <div class="d-flex justify-content-between align-items center">
                                        <div class="reviews-members-header">
                                            <!-- star reviews -->
                                            <div class="ratings">
                                              <?php 
                                              $jml_rating = $row["rating"];
                                              for ($i = 0 ; $i < 5; $i++) {
                                                if ($i < $jml_rating) {
                                                  echo '<i class="fa fa-star rating-color" style="font-size:  0.75rem;"></i>';
                                                } else {
                                                  echo '<i class="fa fa-star" style="font-size: 0.75rem;"></i>';
                                                }
                                              }
                                              ?>
                                            </div>
                                            <h6 class="my-1"><a class="text-black" href="#">@<?= $row["username"]; ?></a></h6>
                                            <small><p class="text-muted"><?= date("D, j M Y" , $row["upload_ulasan"]); ?></p></small>
                                        </div>
                                        <?php if ( $this->session->userdata("email") == $row["email"] ) :?>
                                          <div >
                                            <a class="link_hapus_ulasan" href="<?= base_url("ulasan/hapus_ulasan?id_ulasan=") . $row["id_ulasan"] . "&id_produk={$_GET["id_produk"]}"; ?>" title="hapus ulasan">
                                              <button class="btn btn-danger p-1"><i class="fas fa-fw fa-solid fa-trash-can m-0 "></i></button>
                                            </a>
                                          </div>
                                        <?php endif; ?>
                                      </div>
                                      <div class="reviews-members-body">
                                          <p>
                                            <?= $row["ulasan"]; ?>
                                          </p>
                                      </div>
                                  </div>
                              </div>
                              <?php endforeach; ?>
                            <?php } else { ?>
                              <p class="link-grey">Oops, produk ini belum memiliki ulasan untuk saat ini.</p>
                            <?php }?>
                        </div>
                    </div>

                    <?php if ($isPurchased) :?>
                    <!-- Form inputan ulasan -->
                    <?= form_open_multipart('ulasan'); ?>
                      <div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                          <h5 class="mb-4">Tinggalkan jejak</h5>
                          
                          <p class="mb-2">Pilih rating</p>
                          
                          <!-- star rating -->
                          <div class="rating-wrapperr">
                          
                            <!-- star 5 -->
                            <input type="radio" id="5-star-rating" name="star-rating" value="5" <?= set_radio('star-rating', '5'); ?> >
                            <label for="5-star-rating" class="star-rating">
                              <i class="fas fa-star d-inline-block"></i>
                            </label>

                            <!-- star 4 -->
                            <input type="radio" id="4-star-rating" name="star-rating" value="4" <?= set_radio('star-rating', '4'); ?> >
                            <label for="4-star-rating" class="star-rating star">
                              <i class="fas fa-star d-inline-block"></i>
                            </label>

                            <!-- star 3 -->
                            <input type="radio" id="3-star-rating" name="star-rating" value="3" <?= set_radio('star-rating', '3'); ?> >
                            <label for="3-star-rating" class="star-rating star">
                              <i class="fas fa-star d-inline-block"></i>
                            </label>

                            <!-- star 2 -->
                            <input type="radio" id="2-star-rating" name="star-rating" value="2" <?= set_radio('star-rating', '2'); ?> >
                            <label for="2-star-rating" class="star-rating star">
                              <i class="fas fa-star d-inline-block"></i>
                            </label>

                            <!-- star 1 -->
                            <input type="radio" id="1-star-rating" name="star-rating" value="1" <?= set_radio('star-rating', '1', TRUE); ?> >
                            <label for="1-star-rating" class="star-rating star">
                              <i class="fas fa-star d-inline-block"></i>
                            </label>
                          </div>
                          <?= form_error('star-rating', '<small class="text-danger pl-3">', '</small>'); ?>
                          
                          <input type="hidden" name="id_produk" value="<?= $produk["id"]; ?>">

                          <div class="form-group">
                            <label>Tulis ulasanmu</label>
                            <input class="form-control" name="ulasan" value="<?= set_value('ulasan'); ?>">
                            <?= form_error('ulasan', '<small class="text-danger pl-3">', '</small>'); ?>
                          </div>
                          <div class="form-group mt-3">
                              <button class="btn btn-dark btn-sm" type="submit"> Submit Comment </button>
                          </div>
                      </div>
                    </form>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
