<div class="background-wrap">
  <div class="background"></div>
</div>

<?php Flasher::flashRegister(); ?>
<?php Flasher::flashLogin(); ?>

<form id="accesspanel" action="<?= BASEURL;?>/auth/validasiLogin" method="post">
  <h1 id="litheader">Minrose</h1>
  <div class="inset">
    <p>
      <input type="text" name="username" id="username" placeholder="Userame">
    </p>
    <p>
      <input type="password" name="password" id="password" placeholder="Password">
    </p>
    <div id="section">
      <div>
        <div class="checkboxouter">
          <input type="checkbox" name="rememberme" id="remember" value="Remember">
          <label class="checkbox"></label>
        </div>
        <label for="remember">Remember me</label>
      </div>
      <div><span class="atensi">Belum punya akun?</span> <span><a href="<?= BASEURL; ?>/auth/register">daftar</a></span></div>
    </div>
  </div>
  <p class="p-container">
    <input type="submit" name="Login" id="go" value="Authorize">
  </p>
</form>