<?php
session_start();

include "module/navigasi-admin.php";
include "module/Koneksi.php";

$db = new Koneksi("localhost", "root", "", "restoran");

include "module/session-admin.php";

include "module/navigasi-admin.php";

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
            <div class="d-flex justify-content-between align-items-center">
              <div class="fw-5 fw-medium mt-1 text-body-secondary">
                <i class="ph-duotone ph-money"></i> Belum Bayar
              </div>
              <button class="btn btn-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#modalTambahTransaksi">
                <i class="ph-bold ph-plus"></i> Tambah Transaksi
              </button>

              <!-- Modal tambah transaksi -->
              <div class="modal fade" id="modalTambahTransaksi" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title fs-5" id="modalLabelEditAkun">Tambah Daftar Menu</h3>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="tambah-transaksi.php" method="post" id="transaksiFormValidation" novalidate>
                      <div class="modal-body text-start">
                        <input type="hidden" name="waktu_transaksi" value="<?= date("Y-m-d H:i:s"); ?>">
                        <input type="hidden" name="user_id" value="<?= $_SESSION["login"]; ?>">
                        <div id="inputWrapper">
                          <div class="mb-3 info-menu">
                            <select name=" menu[]" class="form-select" required>
                              <option value="" selected disabled>Pilih menu</option>
                              <?php foreach ($daftarMenu as $menu): ?>
                                <option value="<?= $menu["menu_id"] ?>"><?= $menu["nama_menu"] ?></option>
                              <?php endforeach ?>
                            </select>
                            <div class="input-group mt-1">
                              <span class="input-group-text">Jumlah</span>
                              <input type="number" class="form-control" name="jumlah_pesanan_per_menu[]">
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

            </div>
            <table class="table table-bordered caption-top mt-2">
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
            <div class="fw-5 fw-medium mt-1 text-body-secondary">
              <i class="ph-duotone ph-clock-counter-clockwise"></i> Riwayat Transaksi
            </div>
            <table class="table table-bordered caption-top mt-2">
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
  <!-- Script untuk validasi form tambah transaksi -->
  <script src="src/js/form-tambah_transaksi.js"></script>
</body>

</html>