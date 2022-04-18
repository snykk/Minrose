<div class="background-wrap">
  <div class="background"></div>
</div>

<form id="accesspanel" action="<?= base_url('auth/registration'); ?>" method="post">
  <h1 id="litheader">Minrose</h1>
  <div class="inset">
    <p>
      <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?= set_value('nama_lengkap'); ?>">
      <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
    </p>
    <p>
      <input type="text" name="username" id="username" placeholder="Username" value="<?= set_value('username'); ?>">
      <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
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
      <input type="text" name="email" id="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
      <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
    </p>
    <p>
      <input type="password" name="password" id="password" placeholder="Password" value="<?= set_value('password'); ?>">
      <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
    </p>
    <p>
      <input type="password" name="verif-password" id="verif-password" placeholder="Verif Password" value="<?= set_value('verif-password'); ?>">
      <?= form_error('verif-password', '<small class="text-danger pl-3">', '</small>'); ?>
    </p>
    <p>
      <input type="text" name="no_hp" id="no_hp" placeholder="Nomor Hp" value="<?= set_value('no_hp'); ?>">
      <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
    </p>
    <p>
      <input type="text" name="alamat" id="alamat" placeholder="Alamat" value="<?= set_value('alamat'); ?>">
      <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
    </p>
    <input type="hidden" name="role_id" value="2"/>
    <div id="section">
      <div><span class="atensi">Sudah punya akun?</span> <span><a href="<?= base_url('auth'); ?>">masuk sekarang</a></span></div>
    </div>
  </div>
  <p class="p-container">
    <input type="submit" name="Login" id="go" value="Authorize">
  </p>
</form>