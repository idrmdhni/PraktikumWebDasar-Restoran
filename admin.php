<?php
session_start();

include "module/navigasi-admin.php";
include "module/Koneksi.php";

$db = new Koneksi("localhost", "root", "", "restoran");

include "module/session-admin.php";

$jenisAkun = $db->fetchAll("SELECT * FROM master_akses");
$daftarWarnaCardAkun = ['bg-danger', 'bg-warning', 'bg-primary', 'bg-success'];
$counterWarnaCardAkun = 0;

if ($_SESSION['akses'] == "administrator") {
  $counterModalEditAkun = 1;
}
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
                <div class="modal fade" id="modalTambahAkun" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title fs-5" id="modalLabelEditAkun">Tambah Akun</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <form action="tambah-akun.php" method="post" id="userFormValidation" novalidate>
                        <div class="modal-body text-start">
                          <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                            <div class="invalid-feedback">Username tidak boleh kosong!</div>
                          </div>
                          <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                            <div class="invalid-feedback">Nama tidak boleh kosong!</div>
                          </div>
                          <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                              <input
                                type="password"
                                id="password"
                                name="password"
                                name="password"
                                class="form-control rounded-start-3"
                                placeholder="Password"
                                required />
                              <i class="ph ph-eye-slash input-group-text rounded-end-3" id="showPw"></i>
                              <div class="invalid-feedback">Password tidak boleh kosong!</div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="role" class="form-label">Jenis Akun</label>
                            <select name="role" id="role" class="form-select">
                              <option value="pelanggan">Pelanggan</option>
                              <option value="kasir">Kasir</option>
                              <option value="pelayan">Pelayan</option>
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer text-end">
                          <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

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

                      <?php foreach ($daftarAkun as $akun): ?>

                        <tr>
                          <td class="text-center"><?= $counterDaftarAkun++ ?></td>
                          <td><?= $akun['username'] ?></td>
                          <td><?= $akun['nama_lengkap'] ?></td>

                          <?php if ($_SESSION['akses'] == "administrator"): ?>
                            <td class="text-center">

                              <!-- Modal - Edit Akun -->
                              <div class="modal fade" id="modalEditAkun<?= $counterModalEditAkun ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h3 class="modal-title fs-5" id="modalLabelEditAkun">Edit Akun</h3>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="edit-akun.php" method="post">
                                      <div class="modal-body text-start">
                                        <input type="hidden" name="user_id" value="<?= $akun['user_id'] ?>">
                                        <input type="hidden" name="password_lama" value="<?= $akun['password'] ?>">
                                        <div class="mb-3">
                                          <label for="username" class="form-label">Username</label>
                                          <input type="text" class="form-control" id="username" name="username" value="<?= $akun['username'] ?>">
                                        </div>
                                        <div class="mb-3">
                                          <label for="nama" class="form-label">Nama Lengkap</label>
                                          <input type="text" class="form-control" id="nama" name="nama" value="<?= $akun['nama_lengkap'] ?>">
                                        </div>
                                        <div class="mb-3">
                                          <label for="password" class="form-label">Password</label>
                                          <div class="input-group">
                                            <input
                                              type="password"
                                              id="password"
                                              name="password_baru"
                                              name="password"
                                              class="form-control rounded-start-3 pw"
                                              placeholder="Password" />
                                            <i class="ph ph-eye-slash input-group-text rounded-end-3 show-pw"></i>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer text-end">
                                        <button type="submit" class="btn btn-success" name="edit">Edit</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>

                              <div class="d-flex justify-content-center gap-1">
                                <!-- Edit -->
                                <button type="button" class="btn btn-success ph-fill ph-pencil-line p-1 y-1" data-bs-toggle="modal" data-bs-target="#modalEditAkun<?= $counterModalEditAkun++ ?>"></button>
                                <!-- Hapus -->
                                <form action="hapus-akun.php" method="post">
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
    <script src="src/js/validation-user_form.js"></script>
  <?php endif ?>
</body>

</html>