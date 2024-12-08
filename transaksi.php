<?php
session_start();

include "module/template-halaman_admin/navigasi-admin.php";

include "module/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");
date_default_timezone_set('Asia/Makassar');

include "module/session/session-admin.php";

$daftarMenu = $db->fetchAll("SELECT * FROM daftar_menu");
$daftarTransaksi = $db->fetchAll("SELECT * FROM transaksi");
$datailTransaksi = $db->fetchAll("SELECT * FROM detail_transaksi");
$user = $db->fetchAll("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $titleCurrentPage ?></title>
  <!-- Bootstrap -->
  <link
    rel="stylesheet"
    href="src/bootstrap-5.3.3-dist/css/bootstrap.min.css" />
  <!-- Icon -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <!-- Styling untuk halaman admin -->
  <link rel="stylesheet" href="src/css/admin-page_style.css">
  <!-- Styling untuk mengubah checkbox menjadi switch mode dark & light -->
  <link rel="stylesheet" href="src/css/dark-light-mode.css" />
</head>

<body>
  <div class="container-fluid vh-100">
    <div class="row">
      <!-- Navigasi -->
      <?php include "module/template-halaman_admin/template_navigasi-admin.php" ?>

      <!-- Konten Utama -->
      <div class="col p-3 bg-tertiary-subtle d-sm-flex flex-column vh-100" id="content">
        <?php include "module/template-halaman_admin/template_header-admin.php" ?>

        <main class="d-flex flex-column px-5 py-3 py-md-4 ms-3 ms-md-4 gap-1">
          <!-- Judul Halaman dan Breadcrum -->
          <h2 class="fw-bold"><?= $titleCurrentPage ?></h2>
          <nav class="ms-2" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li><i class="ph-fill ph-house-line align-middle pe-2 text-body-tertiary"></i></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="<?= $navItems[0]['link'] ?>"><?= $navItems[0]['title'] ?></a></li>
              <li class="breadcrumb-item"><?= $titleCurrentPage ?></li>
            </ol>
          </nav>

          <div class="table-responsive">
            <div class="d-flex justify-content-between align-items-center">
              <div class="fw-5 fw-medium mt-1 text-body-secondary">
                <i class="ph-duotone ph-money"></i> Belum Bayar
              </div>

              <!-- Modal tambah transaksi -->
              <?php include "module/modal_box/modal-tambah_transaksi.php" ?>

              <button class="btn btn-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#modalTambahTransaksi">
                <i class="ph-bold ph-plus"></i> Tambah Transaksi
              </button>
            </div>

            <table class="table table-bordered caption-top mt-2">
              <thead>
                <tr class="border-secondary-subtle text-center">
                  <th class="fw-semibold bg-body-secondary">No.</th>
                  <th class="fw-semibold bg-body-secondary">Waktu Transaksi</th>
                  <th class="fw-semibold bg-body-secondary">Nama Pemesan</th>
                  <th class="fw-semibold bg-body-secondary">Total Harga</th>
                  <th class="fw-semibold bg-body-secondary">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i = 0; $i < count($daftarTransaksi); $i++): ?>
                  <?php $user = $db->fetchRow("SELECT nama_lengkap FROM users WHERE user_id = {$daftarTransaksi[$i]['user_id']}")['nama_lengkap'] ?>
                  <?php if ($daftarTransaksi[$i]['status_bayar'] == 'belum bayar'): ?>
                    <tr>
                      <td class="text-center"><?= $i + 1 ?>.</td>
                      <td><?= $daftarTransaksi[$i]['waktu_transaksi'] ?></td>
                      <td><?= $user ?></td>
                      <td>Rp <?= number_format($daftarTransaksi[$i]['total_harga_keseluruhan'], 2, ',', '.') ?></td>
                      <td>
                        <!-- Modal bayar transaksi -->
                        <?php include "module/modal_box/modal-bayar_transaksi.php" ?>

                        <div class="d-flex justify-content-center gap-1">
                          <!-- Hapus -->
                          <form action="crud/hapus-transaksi.php" method="post">
                            <input type="hidden" name="transaksi_id" value="<?= $daftarTransaksi[$i]['transaksi_id'] ?>">
                            <button class="btn btn-danger ph-fill ph-eraser p-1 y-1" type="submit" name="hapus_transaksi"></button>
                          </form>
                          <!-- Bayar -->
                          <button type="button" class="btn btn-primary ph-bold ph-check p-1 y-1" data-bs-toggle="modal" data-bs-target="#bayarTransaksi<?= $i ?>"></button>
                        </div>
                      </td>
                    </tr>
                  <?php endif ?>
                <?php endfor ?>
              </tbody>
            </table>
          </div>
          <hr>

          <div class="table-responsive">
            <div class="fw-5 fw-medium mt-1 text-body-secondary">
              <i class="ph-duotone ph-clock-counter-clockwise"></i> Riwayat Transaksi
            </div>
            <table class="table table-bordered caption-top mt-2">
              <thead>
                <tr class="border-secondary-subtle text-center">
                  <th class="fw-semibold bg-body-secondary">No.</th>
                  <th class="fw-semibold bg-body-secondary">Waktu Pemesanan</th>
                  <th class="fw-semibold bg-body-secondary">Nama Pemesan</th>
                  <th class="fw-semibold bg-body-secondary">Total Harga</th>
                  <th class="fw-semibold bg-body-secondary">Bayar</th>
                  <th class="fw-semibold bg-body-secondary">Kembalian</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i = 0; $i < count($daftarTransaksi); $i++): ?>
                  <?php $user = $db->fetchRow("SELECT nama_lengkap FROM users WHERE user_id = {$daftarTransaksi[$i]['user_id']}")['nama_lengkap'] ?>
                  <?php if ($daftarTransaksi[$i]['status_bayar'] == 'lunas'): ?>
                    <tr>
                      <td class="text-center"><?= $i + 1 ?>.</td>
                      <td><?= $daftarTransaksi[$i]['waktu_transaksi'] ?></td>
                      <td><?= $user ?></td>
                      <td>Rp<?= number_format($daftarTransaksi[$i]['total_harga_keseluruhan'], 2, ',', '.') ?></td>
                      <td>Rp<?= number_format($daftarTransaksi[$i]['bayar'], 2, ',', '.') ?></td>
                      <td>Rp<?= number_format($daftarTransaksi[$i]['kembalian'], 2, ',', '.') ?></td>
                    </tr>
                  <?php endif ?>
                <?php endfor ?>
              </tbody>
            </table>
          </div>

        </main>
      </div>
    </div>
  </div>

  <!-- Bootstsrap -->
  <script src="src/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
  <!-- Script untuk interaksi pada halaman admin -->
  <script src="src/js/interaction-admin_page.js"></script>
  <!-- Script untuk mode dark & light -->
  <script src="src/js/dark_light-mode.js"></script>
  <!-- Script untuk validasi form tambah transaksi -->
  <script src="src/js/form-tambah_transaksi.js"></script>
  <script src="src/js/bayar-transaksi.js"></script>
</body>

</html>