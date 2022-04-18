<div class="background-wrap">
  <div class="background"></div>
</div>

<?php
  echo $this->session->flashdata('message'); 
  unset($_SESSION['message']);
?>

<form id="accesspanel" action="<?= base_url('auth'); ?>" method="post">
  <h1 id="litheader">Minrose</h1>
  <div class="inset">
    <p>
      <input type="text" name="email" id="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
      <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
    </p>
    <p>
      <input type="password" name="password" id="password" placeholder="Password">
      <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
    </p>
    <div id="section">
      <div>
        <div class="checkboxouter">
          <input type="checkbox" name="rememberme" id="remember" value="Remember">
          <label class="checkbox"></label>
        </div>
        <label for="remember">Remember me</label>
      </div>
      <div><span class="atensi">Belum punya akun?</span> <span><a href="<?= base_url('auth/registration'); ?>">daftar</a></span></div>
    </div>
  </div>
  <p class="p-container">
    <input type="submit" name="Login" id="go" value="Login">
  </p>
</form>