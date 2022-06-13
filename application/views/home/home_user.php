<div class="container">
  <?php
  echo $this->session->flashdata('message');
  unset($_SESSION["message"]);
  ?>
</div>

<section id="hero">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
        <div>
          <h1>New way to enjoy rosella flower extract</h1>
          <p>Minuman rosella buatan kami merupakan minuman berbahan dasar rosella yang kami tanam dan petik sendiri yang telah melalui proses quality control yang baik. Sehingga bisa memiliki rasa yang segar, manis, dan sedikit asam.</p>
          <a href="#about" class="btn-get-started scrollto">Get Started</a>
        </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
        <img src="<?= base_url("assets/img/home/rosela.jpg"); ?>" class="img-fluid" alt="Bunga rosela">
      </div>
    </div>
  </div>

</section>

<main id="main">

  <!-- ======= About Section ======= -->
  <section id="about" class="about">

    <div class="container" data-aos="fade-up">
      <div class="row">

        <div class="col-lg-5 col-md-6">
          <div class="about-img" data-aos="fade-right" data-aos-delay="100">
            <img src="<?= base_url("assets/img/home/tentang-rosella.jpg") ?>" alt="minuman rosella">
          </div>
        </div>

        <div class="col-lg-7 col-md-6">
          <div class="about-content" data-aos="fade-left" data-aos-delay="100">
            <h2>Tentang Minrose</h2>
            <p>Minrose merupakan minuman yang diproduksi sejak tahun 2019, berbahan dasar bunga rosella (Hibiscus sabdariffa). Berdasarkan hasil penelitian. Bunga Rosella ini banyak mengandung manfaat. Dalam 57 gram bunga rosella terdapat 123 mg kalsium, 0,84 mg zat besi, 6,8 mg vitamin C, 29 mg magnesium, 6,45 g karbohidrat, 21 mg fosfor, 119 mg potasium, 0,016 mg vitamin B2, dan sedikit Vitamin A. Tentunya baik untuk menjaga imunitas tubuh, menurunkan kadar lemak (kolesterol) dalam darah dan tekanan darah tinggi.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section id="services" class="services section-bg">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Informasi Tambahan</h2>
        <!-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> -->
      </div>

      <div class="row">
        <div class="col-md-12 col-lg-6 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in">
          <div class="icon-box icon-box-pink">
            <div class="icon"><i class="fa fa-fw fa-dumpster" style="font-size: 48px;margin-bottom: 15px;line-height: 1;color:orange;"></i></div>
            <h4 class="title"><a href="">Mengapa harus Minrose?</a></h4>
            <p class="description">Karena produk yang kami tawarkan diproduksi secara higienis, kala memproduksi, karyawan diharuskan menerapkan protokol kesehatan secara ketat.</p>
            <p class="description">Minuman rosella yang kami produksi mempunyai izin PIRT (Produk Industri Rumah Tangga) dan sudah mendapatkan sertifikat Halal MUI</p>
          </div>
        </div>

        <div class="col-md-12 col-lg-6 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="100">
          <div class="icon-box icon-box-cyan">
            <div class="icon"><i class="fa fa-basket-shopping" style="font-size: 48px;margin-bottom: 15px;line-height: 1;color:#3fcdc7;"></i></div>
            <h4 class="title"><a href="">Pemesanan dilakukan dengan cara yang mudah!</a></h4>
            <p class="description">Para customer dapat melakukan pemesanan dengan memilih section "Produk" pada side bar, lakukan langkah-langkah berikut dan pemesanan berhasil dilakukan</p>
            <ul class="description">
              <li>Pilih dan klik "beli" pada salah satu produk</li>
              <li>Mengisi form pembelian</li>
              <li>Klik tambah pesanan</li>
            </ul>
          </div>
        </div>



      </div>

    </div>
  </section>
</main>