<!-- Modal edit daftar menu -->
<div class="modal fade" id="modalEditDaftarMenu<?= $counter ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="modalLabelEditAkun">Edit Daftar Menu</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="crud/edit-daftar_menu.php" method="post" id="menuFormValidation" enctype="multipart/form-data">
        <div class="modal-body text-start">
          <input type="hidden" name="menu_id" value="<?= $menu['menu_id'] ?>">
          <input type="hidden" name="gambar_lama" value="<?= $menu['gambar'] ?>">
          <div class="mb-3">
            <label for="namaMenu" class="form-label">Nama menu</label>
            <input type="text" class="form-control" id="namaMenu" name="nama_menu" value="<?= $menu['nama_menu'] ?>">
          </div>
          <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" value="<?= $menu['harga'] ?>">
          </div>
          <div class="mb-3">
            <label for="gambarMenu" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambarMenu" name="gambar_menu">
          </div>
        </div>
        <div class="modal-footer text-end">
          <button type="submit" class="btn btn-success" name="edit">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>