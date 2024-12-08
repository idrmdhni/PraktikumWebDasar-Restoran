<?php
session_start();

include "module/template-halaman_admin/navigasi-admin.php";
include "module/Koneksi.php";

$db = new Koneksi("localhost", "root", "", "restoran");

include "module/session/session-admin.php";

$daftarMenu = $db->fetchAll("SELECT * FROM daftar_menu");
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
              <li class="breadcrumb-item active" aria-current="page"><a href="<?= $navItems[0]['link'] ?>"><?= $navItems[0]['title'] ?></a></li>
              <li class="breadcrumb-item"><?= $titleCurrentPage ?></li>
            </ol>
          </nav>

          <div class="row g-3 justify-content-center">
            <div class="col-12 d-flex justify-content-between">
              <span class="fs-4 fw-semibold">Daftar Menu</span>

              <button class="btn btn-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#modalTambahDaftarMenu">
                <i class="ph-bold ph-plus"></i> Tambah Menu
              </button>

              <!-- Modal tambah daftar menu -->
              <?php include "module/modal_box/modal-tambah_daftar_menu.php" ?>

            </div>

            <!-- Cards Menu -->
            <?php $counter = 0 ?>
            <?php foreach ($daftarMenu as $menu): ?>
              <div class="col-auto">
                <div class="card me-2">
                  <img src="src/img/<?= $menu['gambar'] ?>" class="card-img-top bg-dark-subtle img-fluid" style="width: 16rem ;height: 12rem;"></img>
                  <div class="card-body">
                    <div class="mb-3" style="width: 224px; height: 80px;">
                      <h5 class="card-title" style="width: 224px;"><?= $menu['nama_menu'] ?></h5>
                      <span>Rp <?= number_format($menu['harga'], 2, ',', '.') ?>/Porsi</span>
                    </div>

                    <!-- Modal edit daftar menu -->
                    <?php include "module/modal_box/modal-edit_daftar_menu.php" ?>

                    <!-- Edit -->
                    <div class="d-flex gap-2 justify-content-center">
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEditDaftarMenu<?= $counter++ ?>">
                        <i class="ph-fill ph-pencil-line"></i> Edit
                      </button>

                      <!-- Hapus -->
                      <form action="crud/hapus-daftar_menu.php" method="post">
                        <input type="hidden" name="menu_id" value="<?= $menu['menu_id'] ?>">
                        <button type="submit" class="btn btn-danger" name="hapus_menu">
                          <i class="ph-fill ph-eraser"></i> Hapus
                        </button>
                      </form>
                    </div>

                  </div>
                </div>
              </div>
            <?php endforeach ?>

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
  <!-- Script untuk validasi form kelola menu -->
  <script src="src/js/validation-daftar_menu.js"></script>
</body>

</html>