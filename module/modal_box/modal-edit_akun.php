<!-- Modal - Edit Akun -->
<div class="modal fade" id="modalEditAkun<?= $counterModalEditAkun ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="modalLabelEditAkun">Edit Akun</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="crud/edit-akun.php" method="post">
        <div class="modal-body text-start">
          <input type="hidden" name="user_id" value="<?= $akun['user_id'] ?>">
          <input type="hidden" name="password_lama" value="<?= $akun['password'] ?>">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $akun['username'] ?>">
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $akun['nama_lengkap'] ?>">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <input
                type="password"
                id="password"
                name="password_baru"
                name="password"
                class="form-control rounded-start-3 pw"
                placeholder="Password" />
              <i class="ph ph-eye-slash input-group-text rounded-end-3 show-pw"></i>
            </div>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Jenis Akun</label>
            <select name="role" id="role" class="form-select">
              <option value="administrator">Administrator</option>
              <option value="kasir">Kasir</option>
              <option value="pelanggan">Pelanggan</option>
              <option value="pelayan">Pelayan</option>
            </select>
          </div>
        </div>
        <div class="modal-footer text-end">
          <button type="submit" class="btn btn-success" name="edit">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>