<div class="background-wrap">
  <div class="background"></div>
</div>

<form id="accesspanel" action="<?= BASEURL;?>/auth/daftar" method="post">
  <h1 id="litheader">Minrose</h1>
  <div class="inset">
    <p>
      <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap">
    </p>
    <p>
      <input type="text" name="username" id="username" placeholder="Username">
    </p>
    <p>
      <div class="jenis-kelamin">
        <label class="jenis-kelamin" for="laki_laki">Jenis Kelamin</label>
        <label for="laki_laki" class="form-label">Laki Laki</label>
        <input type="radio" name="jenis_kelamin" value="L" id="laki_laki" required>
        <label for="wanita" class="form-label">Perempuan</label>
        <input type="radio" name="jenis_kelamin" value="P" id="wanita" required>
      </div>
    </p>
    <p>
      <input type="text" name="email" id="email" placeholder="Email Address">
    </p>
    <p>
      <input type="password" name="password" id="password" placeholder="Password">
    </p>
    <p>
      <input type="password" name="verif-password" id="verif-password" placeholder="Verif Password">
    </p>
    <p>
      <input type="text" name="no_hp" id="no_hp" placeholder="Nomor Hp">
    </p>
    <p>
      <input type="text" name="alamat" id="alamat" placeholder="Alamat">
    </p>
    <input type="hidden" name="role" value="pembeli" />
    <div id="section">
      <div><span class="atensi">Sudah punya akun?</span> <span><a href="<?= BASEURL; ?>/auth/login">masuk sekarang</a></span></div>
    </div>
  </div>
  <p class="p-container">
    <input type="submit" name="Login" id="go" value="Authorize">
  </p>
</form>