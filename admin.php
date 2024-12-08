<?php
session_start();

include "module/template-halaman_admin/navigasi-admin.php";
include "module/Koneksi.php";

$db = new Koneksi("localhost", "root", "", "restoran");

include "module/session/session-admin.php";

$jenisAkun = $db->fetchAll("SELECT * FROM master_akses");
$daftarWarnaCardAkun = ['bg-danger', 'bg-warning', 'bg-primary', 'bg-success'];
$counterWarnaCardAkun = 0;
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
      <div class="col p-3 bg-tertiary-subtle d-sm-flex flex-column vh-100 overflow-auto" id="content">
        <?php include "module/template-halaman_admin/template_header-admin.php" ?>

        <main class="d-flex flex-column px-5 py-3 py-md-4 ms-3 ms-md-4 gap-1">
          <!-- Judul Halaman dan Breadcrum -->
          <h2 class="fw-bold"><?= $titleCurrentPage ?></h2>
          <nav class="ms-2" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li><i class="ph-fill ph-house-line align-middle pe-2 text-body-tertiary"></i></li>
              <li class="breadcrumb-item active" aria-current="page"><?= $titleCurrentPage ?></li>
            </ol>
          </nav>

          <div class="row">
            <div class="col-12 col-xl-5 col-xxl-4">

              <!-- Sumarry Account Cards -->
              <div class="row row-cols-2 g-2 justify-content-center mb-4 mb-xl-0">

                <?php foreach ($jenisAkun as $status): ?>
                  <?php $jumlahAkun = $db->fetchAll("SELECT * FROM akses WHERE akses_id = '{$status['akses_id']}'"); ?>

                  <div class="col-5 card <?= $daftarWarnaCardAkun[$counterWarnaCardAkun++] ?> me-2">
                    <div class="card-body text-center px-3">
                      <i class="ph-fill ph-user fs-1"></i>
                      <div class="fs-5 fw-bold"><?= count($jumlahAkun) ?></div>
                      <span class="fs-5 fw-bold"><?= $status['nama'] ?></span>
                    </div>
                  </div>
                <?php endforeach ?>

              </div>
            </div>

            <!-- Account Tables -->
            <div class="col-12 col-xl-7 col-xxl-8">

              <?php if ($_SESSION['akses'] == "administrator"): ?>

                <!-- Modal - Tambah Akun -->
                <?php include "module/modal_box/modal-tambah_akun.php" ?>

                <button type="button" class="btn btn-primary mb-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#modalTambahAkun"><i class="ph-bold ph-plus"></i> Tambah Akun</button>
              <?php endif ?>

              <?php foreach ($jenisAkun as $status): ?>
                <?php
                $daftarAkun = $db->fetchAll("SELECT * FROM akses INNER JOIN users ON akses.user_id = users.user_id  WHERE akses.akses_id = '{$status['akses_id']}'");
                $counterDaftarAkun = 1;
                ?>

                <div class="table-responsive">
                  <table class="table table-bordered caption-top">
                    <caption class="pt-0">Data <?= $status['nama'] ?></caption>
                    <thead>
                      <tr class="border-secondary-subtle text-center">
                        <th class="fw-semibold bg-body-tertiary" width=10>No.</th>
                        <th class="fw-semibold bg-body-tertiary">Username</th>
                        <th class="fw-semibold bg-body-tertiary">Nama</th>

                        <?php if ($_SESSION['akses'] == "administrator"): ?>
                          <th class="fw-semibold bg-body-tertiary">Aksi</th>
                        <?php endif ?>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Varibel untuk memberi nomor pada modal box edit akun
                      if ($_SESSION['akses'] == "administrator") {
                        $counterModalEditAkun = 1;
                      } ?>
                      <?php foreach ($daftarAkun as $akun): ?>

                        <tr>
                          <td class="text-center"><?= $counterDaftarAkun++ ?></td>
                          <td><?= $akun['username'] ?></td>
                          <td><?= $akun['nama_lengkap'] ?></td>

                          <?php if ($_SESSION['akses'] == "administrator"): ?>
                            <td class="text-center">

                              <!-- Modal edit akun -->
                              <?php include "module/modal_box/modal-edit_akun.php" ?>

                              <div class="d-flex justify-content-center gap-1">
                                <!-- Edit -->
                                <button type="button" class="btn btn-success ph-fill ph-pencil-line p-1 y-1" data-bs-toggle="modal" data-bs-target="#modalEditAkun<?= $counterModalEditAkun++ ?>"></button>
                                <!-- Hapus -->
                                <form action="crud/hapus-akun.php" method="post">
                                  <input type="hidden" name="user_id" value="<?= $akun['user_id'] ?>">
                                  <button type="submit" class="btn btn-danger ph-fill ph-eraser p-1 y-1" name="hapus_akun"></button>
                                </form>
                              </div>
                            </td>
                          <?php endif ?>

                        </tr>

                      <?php endforeach ?>

                    </tbody>
                  </table>
                </div>

              <?php endforeach ?>

            </div>

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

  <!-- Jika login sebagai administrator jalankan scriptnya -->
  <?php if ($_SESSION['akses'] == "administrator"): ?>
    <!-- Script untuk tombol sembunyikan & tampilkan password -->
    <script src="src/js/show-hide-pw.js"></script>
    <!-- Script untuk validasi form user -->
    <script src="src/js/validation-kelola_akun.js"></script>
  <?php endif ?>
</body>

</html>