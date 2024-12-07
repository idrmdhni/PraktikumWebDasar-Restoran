<?php
session_start();

include "module/navigasi-admin.php";
include "module/Koneksi.php";

$db = new Koneksi("localhost", "root", "", "restoran");

include "module/session-admin.php";

include "module/navigasi-admin.php";
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
      <?php include "module/template-navigasi_admin.php" ?>

      <!-- Konten Utama -->
      <div class="col p-3 bg-tertiary-subtle d-sm-flex flex-column vh-100" id="content">
        <?php include "module/template_header-admin.php" ?>

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
            <table class="table table-bordered caption-top">
              <caption class="pt-1 fw-medium"><i class="ph-duotone ph-money"></i> Belum Bayar</caption>
              <thead>
                <tr class="border-secondary-subtle">
                  <th class="fw-semibold bg-body-secondary">No.</th>
                  <th class="fw-semibold bg-body-secondary">Waktu Pemesanan</th>
                  <th class="fw-semibold bg-body-secondary">No. Meja</th>
                  <th class="fw-semibold bg-body-secondary">Nama Pemesan</th>
                  <th class="fw-semibold bg-body-secondary">Total Harga</th>
                  <th class="fw-semibold bg-body-secondary">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td class="text-center">
                    <a href="" class="btn btn-success ph-fill ph-pencil-line p-1 y-1"></a>
                    <a href="" class=" btn btn-danger ph-fill ph-eraser p-1 y-1"></a>
                    <a href="" class="btn btn-primary ph-fill ph-check-fat p-1 y-1"></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <hr>

          <div class="table-responsive">
            <table class="table table-bordered caption-top">
              <caption class="pt-1 fw-medium"><i class="ph-duotone ph-clock-counter-clockwise"></i> Riwayat Transaksi</caption>
              <thead>
                <tr class="border-secondary-subtle">
                  <th class="fw-semibold bg-body-secondary">No.</th>
                  <th class="fw-semibold bg-body-secondary">Waktu Pemesanan</th>
                  <th class="fw-semibold bg-body-secondary">No. Meja</th>
                  <th class="fw-semibold bg-body-secondary">Nama Pemesan</th>
                  <th class="fw-semibold bg-body-secondary">Total Harga</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                </tr>
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
</body>

</html>