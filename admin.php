<?php
session_start();

include "app/behavior.php";
include "app/Koneksi.php";

$db = new Koneksi("localhost", "root", "", "restoran");

include "app/admin-session.php";

$result = $db->fetchRow("SELECT * FROM users WHERE user_id = '{$_SESSION['login']}'");
$jenisAkun = $db->fetchAll("SELECT * FROM master_akses");
$daftarWarnaCardAkun = ['bg-danger', 'bg-success', 'bg-primary', 'bg-warning'];
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
      <?php include "app/nav-template.php" ?>

      <!-- Konten Utama -->
      <div class="col p-3 bg-tertiary-subtle d-sm-flex flex-column vh-100 overflow-auto" id="content">
        <header class="d-flex align-items-center justify-content-between">
          <!-- Tombol Navigasi dan Judul Halaman -->
          <div class="ms-2 d-flex gap-4">
            <a class="ph-bold ph-list fs-3 text-decoration-none text-reset align-self-center" id="sidebarBtn" data-bs-toggle="offcanvas" data-bs-target="#sidebarParent"></a>
            <span class="fs-5 fw-semibold">Selamat Datang, <?= $result['nama_lengkap'] ?></span>
          </div>
          <!-- Toggle Dark & Light Mode -->
          <div class="me-2">
            <input type="checkbox" class="checkbox" id="checkbox">
            <label for="checkbox" class="checkbox-label bg-body-secondary">
              <i class="ph-duotone ph-moon me-2 text-body"></i>
              <i class="ph-duotone ph-sun text-body"></i>
              <span class="ball bg-body"></span>
            </label>
          </div>
        </header>

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

                        <?php if ($status['akses_id'] != "administrator" && $_SESSION['akses'] == "administrator"): ?>
                          <th class="fw-semibold bg-body-tertiary">Status</th>
                          <th class="fw-semibold bg-body-tertiary">Aksi</th>
                        <?php endif ?>

                      </tr>
                    </thead>
                    <tbody>

                      <?php foreach ($daftarAkun as $akun): ?>

                        <tr>
                          <td class="text-center"><?= $counterDaftarAkun++ ?></td>
                          <td><?= $akun['username'] ?></td>
                          <td><?= $akun['nama_lengkap'] ?></td>

                          <?php if ($status['nama'] != "Administrator" && $_SESSION['akses'] == "administrator"): ?>
                            <td><?= $akun['status'] ?></td>
                            <td class="text-center">

                              <?php if ($akun['status'] == "aktif"): ?>
                                <?php include 'app/modal-edit_akun.php' ?>
                                <button type="button" class="btn btn-primary ph-fill ph-pencil-line p-1 y-1" data-bs-toggle="modal" data-bs-target="#modalEditAkun"></button>
                              <?php endif ?>

                              <?php if ($akun['status'] == "tidak aktif"): ?>
                                <a href="aktifkan_akun.php?akun=<?= $akun['user_id'] ?>" class="btn btn-success ph-fill ph-check-fat p-1 y-1"></a>
                              <?php endif ?>

                              <a href="hapus_akun.php?akun=<?= $akun['user_id'] ?>" class="btn btn-danger ph-fill ph-eraser p-1 y-1"></a>
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
  <script src="src/js/admin_page-interaction.js"></script>
  <!-- Script untuk mode dark & light -->
  <script src="src/js/dark-light-mode.js"></script>
</body>

</html>