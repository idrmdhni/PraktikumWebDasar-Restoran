<!-- Modal tambah transaksi -->
<div class="modal fade" id="modalTambahTransaksi" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="modalLabelEditAkun">Tambah Daftar Menu</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="crud/tambah-transaksi.php" method="post" id="transaksiFormValidation" novalidate>
        <div class="modal-body text-start">
          <input type="hidden" name="waktu_transaksi" value="<?= date("Y-m-d H:i:s"); ?>">
          <input type="hidden" name="user_id" value="<?= $_SESSION["login"]; ?>">
          <div id="inputWrapper">
            <div class="mb-3 info-menu">
              <select name=" menu[]" class="form-select" required>
                <option value="" selected disabled>Pilih menu</option>
                <?php foreach ($daftarMenu as $menu): ?>
                  <option value="<?= $menu["menu_id"] ?>"><?= $menu["nama_menu"] . " (Rp." . (number_format($menu['harga'], 0, ',', '.')) . ")" ?></option>
                <?php endforeach ?>
              </select>
              <div class="input-group mt-1">
                <span class="input-group-text">Jumlah</span>
                <input type="number" class="form-control" name="jumlah_pesanan_per_menu[]" required>
              </div>
              <div class="invalid-feedback">Menu tidak boleh kosong!</div>
            </div>
          </div>

          <div class="d-flex justify-content-center gap-2">
            <button type="button" class="btn btn-outline-secondary" id="tambahInput"><i class="ph-bold ph-plus"></i></button>
            <button type="button" class="btn btn-outline-secondary" id="kurangInput"><i class="ph-bold ph-minus"></i></button>
          </div>
        </div>

        <div class="modal-footer text-end">
          <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End modal -->