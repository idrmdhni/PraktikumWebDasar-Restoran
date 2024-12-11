<?php
// Memulai sesi
session_start();
// Menyertakan script untuk fungsi database
include "module/Koneksi.php";
// Koneksi ke database restoran
$db = new Koneksi("localhost", "root", "", "restoran");
// Menyertakan script untuk mengatur sesi
include "module/session/session-user.php";
// Mengatur zona waktu ke WITA
date_default_timezone_set('Asia/Makassar');
// Mengambil data daftar menu dari tabel daftar_meni
$daftarMenu = $db->fetchAll("SELECT * FROM daftar_menu");
// Mengambil informasi akun yang digunakan untuk login
$user = $db->fetchRow("SELECT * FROM users WHERE user_id = '{$_SESSION['login']}'");
?>

<!DOCTYPE html>
<!-- Atribut data-bs-theme digunakan untuk mengatur night/light mode -->
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pesan Menu</title>
  <!-- Bootstrap -->
  <link
    rel="stylesheet"
    href="src/bootstrap-5.3.3-dist/css/bootstrap.min.css" />
  <!-- Icon -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <!-- Styling untuk mengubah checkbox menjadi switch mode dark & light -->
  <link rel="stylesheet" href="src/css/dark-light-mode.css" />
  <!-- Styling untuk halaman -->
  <link rel="stylesheet" href="src/css/user-page_style.css" />
</head>

<body>
  <!-- Bagian header -->
  <header class="vw-100 p-3 d-flex justify-content-between align-items-center bg-body-tertiary shadow position-sticky top-0 z-1">
    <div class="d-flex align-items-center gap-2">
      <!-- Tombol logout -->
      <a href="logout.php" class="text-decoration-none logout"><i class="ph-duotone ph-sign-out fs-4"></i></a>
      <!-- Ucapan selamat datang -->
      <h4 class="d-sm-inline d-none">Selamat Datang, <?= $user['nama_lengkap'] ?></h4>
    </div>

    <!-- Tombol switch dark/light mode -->
    <div class="me-2">
      <input type="checkbox" class="dark-light-checkbox" id="darkLightcheckbox" />
      <label for="darkLightcheckbox" class="dark-light-checkbox-label bg-body-secondary">
        <i class="ph ph-moon me-2 text-body"></i>
        <i class="ph ph-sun text-body"></i>
        <span class="ball bg-body"></span>
      </label>
    </div>
  </header>

  <main class="container-fluid mt-4">
    <section class="d-flex flex-column align-items-center py-3 title">
      <!-- Gmbar logo restoran -->
      <img src="src/img/logo.png" alt="logo restoran" height="85" class="rounded-circle mb-2">
      <!-- Judul Website -->
      <span>
        <h1 class="fw-bold text-center">Restoran Kelompok 12</h1>
        <hr class="mx-0 mx-xl-4 mx-lg-3 mx-md-2 mx-sm-1 mb-2">
      </span>
      <span class="text-body-secondary text-center">Silahkan pesan menu sesuai keinginan Anda</span>
    </section>

    <section class="py-4">
      <form action="crud/tambah-transaksi.php" method="post" id="userTransactionValidation" novalidate>
        <div class="row justify-content-center gy-4">

          <!-- Perluangan untuk mendapatkan daftar menu -->
          <?php foreach ($daftarMenu as $menu): ?>
            <!-- Input checkbox untuk memilih makanan -->
            <div class="d-flex gap-2 col-auto">
              <input
                type="checkbox"
                class="form-check-input chekbox-menu fs-5 m-0 shadow border-2"
                name="menu[]"
                value="<?= $menu['menu_id'] ?>" />

              <!-- Card daftar menu -->
              <div class="card card-menu shadow border-2">
                <!-- Bagian gambar card -->
                <div class="row g-0">
                  <div class="col-sm-4 col-12">
                    <img
                      src="src/img/<?= $menu['gambar'] ?>"
                      alt=""
                      class="img-fluid rounded-top-2 d-sm-none d-inline-block" />
                    <img
                      src="src/img/<?= $menu['gambar'] ?>"
                      alt=""
                      class="img-fluid rounded-top-2 rounded-end-0 d-sm-inline-block d-none" />
                  </div>

                  <!-- Bagian body card -->
                  <div class="col-sm-8 col-12">
                    <div class="card-body">
                      <div style="height: 80px">
                        <h4 class="card-title"><?= $menu['nama_menu'] ?></h4>
                        <span class="card-text">Rp <?= number_format($menu['harga'], 2, ',', '.') ?>/Porsi</span>
                      </div>
                    </div>
                  </div>

                  <!-- Bagian footer card -->
                  <div class="col-12 card-footer d-flex gap-3 card-footer-menu border-2" style="height: 47px;">
                    <span>Jumlah:</span>

                    <!-- Input untuk menentukan jumlah menu  -->
                    <div class="incre-decre">
                      <button type="button" class="decrement" disabled>-</button>
                      <input type="text" class="amount bg-body-tertiary" />
                      <button type="button" class="increment">+</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          <?php endforeach ?>

        </div>

        <div class="d-flex flex-column justify-content-center align-items-center mt-4 gap-3">
          <!-- Mendapatkan waktu saat ini -->
          <input type="hidden" name="waktu_transaksi" value="<?= date("Y-m-d H:i:s"); ?>">
          <!-- Mendapatkan user id -->
          <input type="hidden" name="user_id" value="<?= $_SESSION["login"]; ?>">

          <!-- Tombol submit untuk memesan menu -->
          <button type="submit" onclick="return confirm('Apakah kamu yakin')" class="btn btn-primary fs-5 fw-semibold" name="tambah"><i class="ph ph-shopping-cart"></i> Pesan</button>

          <!-- Peringatan ketika jumlah menu kosong -->
          <div class="alert alert-danger alert-dismissible fade">
            <span>Terdapat jumlah pesanan yang kosong!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        </div>
      </form>
    </section>

    <!-- Bootstsrap -->
    <script src="src/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script untuk mode dark & light -->
    <script src="src/js/dark_light-mode.js"></script>
    <!-- Script untuk interaksi pada halaman -->
    <script src="src/js/interaction-user_page.js"></script>
</body>

</html>