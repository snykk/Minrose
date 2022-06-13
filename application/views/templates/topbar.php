<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

  <a class="navbar-brand ps-3" href="<?= base_url("home/index"); ?>">Minrose</i> </a>

  <!-- Sidebar Toggle-->
  <button class="btn btn-link btn-dark btn-sm order-1 order-lg-0 me-3 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

  <!-- Nama User/Admin -->
  <div style="color: white; " class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"><?= $user['username']; ?></div>

  <!-- Navbar-->
  <ul class="navbar-nav ms-auto ms-md-0 me-1 me-lg-2" style="margin-right: 0;">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img width="40px" class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>"></a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="<?= base_url("profile/user_profile"); ?>"><i class="fas fa-user-alt fa-sm fa-fw text-gray-400" style="margin-right: 10px;"></i>Profile Saya</a></li>
        <li><a class="dropdown-item" href="<?= base_url("profile/ganti_password"); ?>"><i class="fas fa-key fa-sm fa-fw text-gray-400" style="margin-right: 10px;"></i>Ganti Password</a></li>
        <li>
          <hr class="dropdown-divider" />
        </li>
        <li><a class="dropdown-item auth_logout" href="<?= base_url('auth/logout') ?>" style="cursor: pointer;"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400" style="margin-right: 10px;"></i>Logout</a></li>
      </ul>
    </li>
  </ul>
</nav>