<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  
  <!-- Navbar Brand-->
  <!-- <a class="navbar-brand ps-3" href="<?//= ( $user["role_id"] == 1 ) ? base_url("admin/index") : base_url("user/index");?>">Minrose</a> -->
  <a class="navbar-brand ps-3" href="<?= base_url("home/index"); ?>">Minrose</a>

  

  <!-- Sidebar Toggle-->
  <button class="btn btn-link btn-dark btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

  <!-- Navbar Search-->
  <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    <div class="input-group">
      <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
      <button class="btn btn-light" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
    </div>
  </form>

  <!-- Navbar-->
  <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4" style="margin-right: 0;">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img width="40px" class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>"></a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item"  href="<?= base_url("profile/user_profile"); ?>">Profile Saya</a></li>
        <li><a class="dropdown-item" href="<?= base_url("profile/edit_profile"); ?>">Ubah Profile</a></li>
        <li><a class="dropdown-item" href="<?= base_url("profile/ganti_password"); ?>">Ganti Password</a></li>
        <li><hr class="dropdown-divider" /></li>
        <li><a class="dropdown-item" href="<?= base_url("auth/logout")?>">Logout</a></li>
      </ul>
    </li>
  </ul>
  
</nav>
