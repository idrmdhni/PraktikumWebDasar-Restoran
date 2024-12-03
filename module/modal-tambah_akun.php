<div class="modal fade" id="modalTambahAkun" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="modalLabelEditAkun">Tambah Akun</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="tambah-akun.php" method="post" id="userFormsValidation" novalidate>
        <div class="modal-body text-start">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
            <div class="invalid-feedback">Username tidak boleh kosong!</div>
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
            <div class="invalid-feedback">Nama tidak boleh kosong!</div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <input
                type="password"
                id="password"
                name="password"
                name="password"
                class="form-control rounded-start-3"
                placeholder="Password"
                required />
              <i class="ph ph-eye-slash input-group-text rounded-end-3" id="showPw"></i>
              <div class="invalid-feedback">Password tidak boleh kosong!</div>
            </div>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Jenis Akun</label>
            <select name="role" id="role" class="form-select">
              <option value="pelanggan">Pelanggan</option>
              <option value="kasir">Kasir</option>
              <option value="waiter">Waiter</option>
            </select>
          </div>
        </div>
        <div class="modal-footer text-end">
          <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>