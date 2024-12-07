<?php
session_start();

include "module/navigasi-admin.php";
include "module/Koneksi.php";

$db = new Koneksi("localhost", "root", "", "restoran");

include "module/session-admin.php";

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
      <?php include "module/template-navigasi_admin.php" ?>

      <!-- Konten Utama -->
      <div class="col p-3 bg-tertiary-subtle d-sm-flex flex-column vh-100 overflow-auto" id="content">
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

          <div class="row g-3 justify-content-center">
            <!-- Tambah Daftar Menu -->
            <div class="col-12 d-flex justify-content-between">
              <span class="fs-4 fw-semibold">Daftar Menu</span>

              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahDaftarMenu"><i class="ph-bold ph-plus"></i> Tambah Menu</button>

              <!-- Modal tambah daftar menu -->
              <div class="modal fade" id="modalTambahDaftarMenu" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title fs-5" id="modalLabelEditAkun">Tambah Daftar Menu</h3>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="tambah-daftar_menu.php" method="post" id="menuFormValidation" enctype="multipart/form-data" novalidate>
                      <div class="modal-body text-start">
                        <div class="mb-3">
                          <label for="namaMenu" class="form-label">Nama Menu</label>
                          <input type="text" class="form-control" id="namaMenu" name="nama_menu" required>
                          <div class="invalid-feedback">Nama menu tidak boleh kosong!</div>
                        </div>
                        <div class="mb-3">
                          <label for="harga" class="form-label">Harga</label>
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
            </div>

            <!-- Cards Menu -->
            <?php $counter = 0 ?>
            <?php foreach ($daftarMenu as $menu): ?>
              <div class="col-auto">
                <div class="card me-2">
                  <img src="src/img/<?= $menu['gambar'] ?>" class="card-img-top bg-dark-subtle" style="width: 16rem ;height: 12rem;"></img>
                  <div class="card-body">
                    <h5 class="card-title"><?= $menu['nama_menu'] ?></h5>
                    <p class="card-text">Rp.<?= number_format($menu['harga'], 0, ',', '.') ?>/Porsi</p>
                    <div class="text-center">

                      <!-- Modal edit daftar menu -->
                      <div class="modal fade" id="modalEditDaftarMenu<?= $counter ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title fs-5" id="modalLabelEditAkun">Edit Daftar Menu</h3>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="edit-daftar_menu.php" method="post" id="menuFormValidation" enctype="multipart/form-data">
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

                      <!-- Edit -->
                      <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEditDaftarMenu<?= $counter++ ?>">
                          <i class="ph-fill ph-pencil-line"></i> Edit
                        </button>

                        <!-- Hapus -->
                        <form action="hapus-daftar_menu.php" method="post">
                          <input type="hidden" name="menu_id" value="<?= $menu['menu_id'] ?>">
                          <button type="submit" class="btn btn-danger" name="hapus_menu">
                            <i class="ph-fill ph-eraser"></i> Hapus
                          </button>
                        </form>
                      </div>
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