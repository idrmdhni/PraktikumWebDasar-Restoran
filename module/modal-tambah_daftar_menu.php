<div class="modal fade" id="modalTambahDaftarMenu" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="modalLabelEditAkun">Tambah Akun</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="" method="post" id="menuFormValidation" novalidate>
        <div class="modal-body text-start">
          <div class="mb-3">
            <label for="namaMenu" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" id="namaMenu" name="nama_menu" required>
            <div class="invalid-feedback">Nama menu tidak boleh kosong!</div>
          </div>
          <div class="mb-3">
            <label for="harga" class="form-label">Harg</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
            <div class="invalid-feedback">Harga tidak boleh kosong!</div>
          </div>
          <div class="mb-3">
            <label for="gambarMenu" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambarMenu" name="gambar_menu" required>
            <div class="invalid-feedback">Gambar tidak boleh kosong!</div>
          </div>
        </div>
        <div class="modal-footer text-end">
          <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>