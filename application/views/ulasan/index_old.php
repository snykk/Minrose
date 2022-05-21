<div class="container-fluid pt-4" style="background: #eee">
  <!-- Hierarki -->
  <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Home</li>
      <li class="breadcrumb-item">Ulasan</li>
      <li class="breadcrumb-item active" aria-current="page">Rincian</li>
    </ol>
  </nav>
  <!-- Tutup hierarki -->

  <hr class="mt-0 mb-4" />

  <?php
    echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>

  <div class="row flex-lg-nowrap">
    <div class="col">
      <div class="row">
        <div class="col mb-3">
          <div class="card">
            <div class="card-body">
              <div class="e-profile">
                <div class="row">
                  <div class="col-12 col-sm-auto mb-3">
                    <img class="img-account-profile mb-2" src="<?= base_url('assets/img/produk/minrose-cup.jpeg'); ?>" width="200" alt="" />
                  </div>
                  <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                    <div class="text-sm-left mb-2 mb-sm-0">
                      <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">Minrose Cup</h4>
                      <div class="text-muted">
                        <small>
                          Minuman cup Bunga Rosella ini terbuat dari bahan alami pilihan yaitu bunga Rosella terbaik. Pengolahan Teh Rosela sebagai minuman kesehatan herbal ini sudah menggunakan standar CPOTB, SNI dan ISO. Sehingga dapat memberikan jaminan mutu dan rasa aman bagi konsumen.
                        </small>
                      </div>
                      <div class="text-muted mt-3">
                          <span>Harga : </span>
                          <span>35000</span>
                      </div>
                      <div class="text-muted">
                          <span>Tersedia : </span>
                          <span>50 Stok</span>
                      </div>
                      <div class="mt-2">
                      </div>
                    </div>
                  </div>
                </div>
                <div id="reviews" class="review-section">
                  <div class="d-flex align-items-center justify-content-between">
                    <h4>37 Ulasan</h4>
                    <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: 188px">
                      <span class="selection">
                        <span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-qd66-container">
                          <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                        </span>
                      </span>
                      <span class="dropdown-wrapper" aria-hidden="true"></span>
                    </span>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <table class="stars-counters">
                        <tbody>
                          <tr class="">
                            <td>
                              <span>
                                <div class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">5 Stars</div>
                              </span>
                            </td>
                            <td class="progress-bar-container">
                              <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                <div class="fit-progressbar-background">
                                  <span class="progress-fill" style="width: 97.2973%"></span>
                                </div>
                              </div>
                            </td>
                            <td class="star-num">(36)</td>
                          </tr>
                          <tr class="">
                            <td>
                              <span>
                                <div class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">4 Stars</div>
                              </span>
                            </td>
                            <td class="progress-bar-container">
                              <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                <div class="fit-progressbar-background">
                                  <span class="progress-fill" style="width: 2.2973%"></span>
                                </div>
                              </div>
                            </td>
                            <td class="star-num">(2)</td>
                          </tr>
                          <tr class="">
                            <td>
                              <span>
                                <div class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">3 Stars</div>
                              </span>
                            </td>
                            <td class="progress-bar-container">
                              <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                <div class="fit-progressbar-background">
                                  <span class="progress-fill" style="width: 0"></span>
                                </div>
                              </div>
                            </td>
                            <td class="star-num">(0)</td>
                          </tr>
                          <tr class="">
                            <td>
                              <span>
                                <div class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">2 Stars</div>
                              </span>
                            </td>
                            <td class="progress-bar-container">
                              <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                <div class="fit-progressbar-background">
                                  <span class="progress-fill" style="width: 0"></span>
                                </div>
                              </div>
                            </td>
                            <td class="star-num">(0)</td>
                          </tr>
                          <tr class="">
                            <td>
                              <span>
                                <div class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">1 Stars</div>
                              </span>
                            </td>
                            <td class="progress-bar-container">
                              <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                <div class="fit-progressbar-background">
                                  <span class="progress-fill" style="width: 0"></span>
                                </div>
                              </div>
                            </td>
                            <td class="star-num">(0)</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-6">
                      <div class="ranking">
                        <h6 class="text-display-7">Rincian Rating</h6>
                        <ul>
                          <li>
                            Penilaian terhadap layanan<span>4.9<span class="review-star rate-10 show-one"></span></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="review-list">
                  <ul>
                    <li>
                      <?php for ($i = 0; $i < 3; $i++) :?>
                      <div class="d-flex">
                        <div class="left">
                          <span> <img src="<?= base_url("assets/img/profile/default.jpg")?>" class="profile-pict-img img-fluid" alt="" /> </span>
                        </div>
                        <div class="right">
                          <h4>
                            username
                            <span class="gig-rating text-body-2">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                <path
                                  fill="currentColor"
                                  d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"
                                ></path>
                              </svg>
                              5.0
                            </span>
                          </h4>
                          <div class="review-description">
                            <p>The process was smooth, after providing the required info, Pragyesh sent me an outstanding packet of wireframes. Thank you a lot!</p>
                          </div>
                          <span class="publish py-3 d-inline-block w-100"
                            >Dipublis pada
                            <?= date('d/m/Y', 1652276424); ?></span
                          >
                        </div>
                      </div>
                      <?php endfor; ?>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
