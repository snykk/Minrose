<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <div class="sb-sidenav-menu-heading">ADMINISTRATOR</div>
          <a class="nav-link" href="<?= base_url("home/index"); ?>">
            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-tachometer-alt"></i></div>
            Dashboard
          </a>

          <!-- <hr class="sidebar-divider"> -->

          <div class="sb-sidenav-menu-heading">Interface</div>
          <a class="nav-link" href="<?= base_url("Produk/index"); ?>">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-fw fa-dumpster"></i></div>
            Produk
          </a>

          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-columns"></i></div>
            Produk Advance
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-fw fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link" href="layout-static.html">Tampilkan Produk</a>
              <a class="nav-link" href="layout-sidenav-light.html">Tambah Produk</a>
            </nav>
          </div>
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-book-open"></i></div>
            Pages
            <div class="sb-sidenav-collapse-arrow"><i fa-fw class="fas fa-fw fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                Authentication
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-fw fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="login.html">Login</a>
                  <a class="nav-link" href="register.html">Register</a>
                  <a class="nav-link" href="password.html">Forgot Password</a>
                </nav>
              </div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                Error
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-fw fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="401.html">401 Page</a>
                  <a class="nav-link" href="404.html">404 Page</a>
                  <a class="nav-link" href="500.html">500 Page</a>
                </nav>
              </div>
            </nav>
          </div>
          <div class="sb-sidenav-menu-heading">Addons</div>
          <a class="nav-link" href="charts.html">
            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-chart-area"></i></div>
            Charts
          </a>
          <a class="nav-link" href="tables.html">
            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-table"></i></div>
            Tables
          </a>

          <hr class="sidebar-divider">

          <a class="nav-link" data-bs-toggle="modal" data-bs-target="#logoutModal">
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