<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <div class="sb-sidenav-menu-heading">ADMINISTRATOR</div>
          <a class="nav-link" href="<?= base_url("home/index"); ?>">
            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-chart-line"></i></div>
            Dashboard
          </a>

          <a class="nav-link" href="<?= base_url("home/customers"); ?>">
            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-solid fa-users"></i></div>
            Customers
          </a>

          <div class="sb-sidenav-menu-heading">Interface</div>
          <a class="nav-link" href="<?= base_url("Produk/index"); ?>">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-fw fa-dumpster"></i></div>
            Produk
          </a>

          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-columns"></i></div>
            Pemesanan
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-fw fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link" href="<?= base_url("pemesanan/data_pemesanan") ?>">Data Pemesanan</a>
              <a class="nav-link" href="<?= base_url("pemesanan/riwayat_pemesanan") ?>">Riwayat Pemesanan</a>
            </nav>
          </div>

          <a class="nav-link" href="<?= base_url("transaksi/index"); ?>">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-fw fa-dollar-sign"></i></div>
            Transaksi
          </a>

          <hr class="sidebar-divider">

          <a class="nav-link auth_logout" href="<?= base_url('auth/logout') ?>" style="cursor: pointer;">
            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-sign-out-alt"></i></div>
            Logout
          </a>

        </div>
      </div>
      <div class="sb-sidenav-footer">
        <div class="small">Saat ini masuk sebagai:</div>
        Admin
      </div>
    </nav>
  </div>
  <div id="layoutSidenav_content">