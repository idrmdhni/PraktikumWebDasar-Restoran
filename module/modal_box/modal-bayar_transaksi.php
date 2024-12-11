<!-- Modal - Bayar Transkasi -->
<div class="modal fade" id="bayarTransaksi<?= $i ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="modalLabelEditAkun">Bayar Transaksi</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="crud/bayar-transaksi.php" method="post" id="transaksiFormValidation" novalidate>
        <div class="modal-body text-start">
          <div class="table-responsive">
            <table class="table table-bordered caption-top mt-2">
              <thead>
                <tr class="border-secondary-subtle text-center">
                  <th class="fw-semibold bg-body-secondary">No.</th>
                  <th class="fw-semibold bg-body-secondary">Nama Menu</th>
                  <th class="fw-semibold bg-body-secondary">Harga</th>
                  <th class="fw-semibold bg-body-secondary">Jumlah</th>
                  <th class="fw-semibold bg-body-secondary">Total Harga</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // $detailTransaksi = $db->fetchAll("SELECT * FROM ((detail_transaksi INNER JOIN daftar_menu ON detail_transaksi.menu_id = daftar_menu.menu_id) INNER JOIN transaksi ON detail_transaksi.transaksi_id = transaksi.transaksi_id) WHERE detail_transaksi.transaksi_id = '{$daftarTransaksi[$i]['transaksi_id']}'");
                $detailTransaksi = $db->fetchAll("SELECT * FROM detail_transaksi INNER JOIN daftar_menu ON detail_transaksi.menu_id = daftar_menu.menu_id WHERE detail_transaksi.transaksi_id = '{$daftarTransaksi[$i]['transaksi_id']}'");
                ?>
                <?php for ($j = 0; $j < count($detailTransaksi); $j++): ?>
                  <tr>
                    <td class="text-center"><?= $j + 1 ?>.</td>
                    <td><?= $detailTransaksi[$j]['nama_menu'] ?></td>
                    <td>Rp<?= number_format($detailTransaksi[$j]['harga'], 2, ',', '.') ?></td>
                    <td class="text-center"><?= $detailTransaksi[$j]['jumlah'] ?></td>
                    <td>Rp<?= number_format($detailTransaksi[$j]['total_harga'], 2, ',', '.') ?></td>
                  </tr>
                <?php endfor ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4"></td>
                  <td>Rp<?= number_format($daftarTransaksi[$i]['total_harga_keseluruhan'], 2, ',', '.') ?></td>
                </tr>
              </tfoot>
            </table>
          </div>

          <input type="hidden" value="<?= $daftarTransaksi[$i]['total_harga_keseluruhan'] ?>" name="total_harga_keseluruhan" class="total_harga_keseluruhan">
          <input type="hidden" value="<?= $daftarTransaksi[$i]['transaksi_id'] ?>" name="transaksi_id">
          <div class="mb-3 row">
            <div class="col-auto d-flex align-items-center">
              <label for="bayar" class="form-label mb-0">Membayar :</label>
            </div>
            <div class=" col">
              <input type="text" class="form-control bayar" name="bayar">
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col-auto d-flex align-items-center">
              <label for="kembalianDisplay" class="form-label mb-0">Kembalian :</label>
            </div>
            <div class=" col">
              <input type="text" class="kembalian_display form-control-plaintext" readonly>
              <input type="hidden" class="kembalian_input" name="kembalian">
            </div>
          </div>
        </div>

        <div class="modal-footer text-end">
          <button type="submit" class="btn btn-primary" name="bayar_pesanan">Bayar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End modal -->