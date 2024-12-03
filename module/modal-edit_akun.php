<?php
$akunSaatIni = $db->fetchRow("SELECT * FROM users WHERE user_id = '{$akun['user_id']}'");
?>

<div class="modal fade" id="modalEditAkun" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="modalLabelEditAkun">Edit Akun</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="edit-akun.php" method="post">
        <div class="modal-body text-start">
          <input type="hidden" name="user_id" value="<?= $akunSaatIni['user_id'] ?>">
          <input type="hidden" name="password_lama" value="<?= $akunSaatIni['password'] ?>">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $akunSaatIni['username'] ?>">
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $akunSaatIni['nama_lengkap'] ?>">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <input
                type="password"
                id="password"
                name="password_baru"
                name="password"
                class="form-control rounded-start-3"
                placeholder="Password" />
              <i class="ph ph-eye-slash input-group-text rounded-end-3" id="showPw"></i>
            </div>
          </div>
        </div>
        <div class="modal-footer text-end">
          <button type="submit" class="btn btn-success" name="edit">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>