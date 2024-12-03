<?php
session_start();

include "app/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");

include "app/login-register-session.php";


// Set nilai awal variabel agar peringatan tidak muncul
$inputError = false;
$loginError = false;

// Ketika tombol login ditekan
if (isset($_POST['login'])) {
  // Koneksi ke database dan mengambil data login
  $username = $_POST['username'];
  $password = $_POST['password'];
  $result = $db->fetchRow("SELECT * FROM users WHERE username = '$username'");

  // Validasi
  // Cek apakah input kosong
  if ($username == '' || $password == '') {
    // Set variabel untuk memunculkan peringatan
    $inputError = true;
  } else {
    // Jika tidak kosong, cek apakah username dan password sesuai
    if ($result && password_verify($password, $result['password'])) {
      // Jika akun belum diverifikasi olehh admin
      if ($result['status'] == "tidak aktif") {
        // Set variabel untuk memunculkan peringatan
        $verifError = true;
      }
      // Jika akun sudah diverifikasi arahkan ke halaman admin / user
      else {
        // Mendapatkan akses berdasarkan jenis akun
        $akses = $db->fetchRow("SELECT * FROM akses WHERE user_id = '{$result["user_id"]}'");

        // Set sesi untuk mengatur akses ke halaman 
        $_SESSION['login'] = $result['user_id'];
        $_SESSION['akses'] = $akses['akses_id'];

        // Jika tombol remember me dicentang
        if (isset($_POST['rememberme'])) {
          // Atur agar ketika membuka halaman tidak perlu login kembali
          setcookie('id', $result['user_id'], time() + 60);
          setcookie('key', hash('sha256', $result['username']), time() + 60);
        }

        // Jika akun yang login termasuk akun pelanggan, arahkan ke halaman user
        if ($akses['akses_id'] == "pelanggan") {
          header('location: index.php');
        }
        // Jika akun yang login tidak termasuk akun pelanggan, arahkan ke halaman admin
        else {
          header('location: admin.php');
        }
      }
    }
    // Jika username / password tidak sesuai, set variabel untuk memunculkan peringatan
    else {
      $loginError = true;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <!-- Bootstrap -->
  <link
    rel="stylesheet"
    href="src/bootstrap-5.3.3-dist/css/bootstrap.min.css" />
  <!-- Icon -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <!-- Styling untuk mengubah checkbox menjadi switch mode dark & light -->
  <link rel="stylesheet" href="src/css/dark-light-mode.css" />
</head>

<body class="position-relative">
  <div class="container vh-100">
    <!-- Toggle Dark & Light Mode -->
    <div class="dark-light-toggle-wrapper">
      <input type="checkbox" class="checkbox" id="checkbox" />
      <label for="checkbox" class="checkbox-label bg-body-secondary">
        <i class="ph ph-moon me-2 text-body"></i>
        <i class="ph ph-sun text-body"></i>
        <span class="ball bg-body"></span>
      </label>
    </div>

    <!-- Login Form -->
    <div class="row h-100">
      <div class="col-9 col-sm-8 col-md-6 col-lg-5 col-xl-4 m-auto">

        <!-- Peringatan ketika input kosong atau username/password salah -->
        <?php if ($inputError || $loginError): ?>
          <div class="alert alert-danger alert-dismissible fade show">
            <span><?= $inputError ? 'Tolong masukkan username / password' : 'Username atau password anda salah!' ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php endif ?>

        <!-- Peringatan ketika akun belum diverifikasi -->
        <?php if (isset($verifError)): ?>
          <div class="alert alert-danger alert-dismissible fade show">
            <span><?= 'Akun anda belum diverifikasi oleh admin' ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php endif ?>

        <div class="bg-body-tertiary shadow p-4 rounded-4 text">
          <div class="fs-1 fw-bold text-center mb-4">LOGIN</div>
          <form action="" method="post">
            <!-- Username field -->
            <div class="d-flex flex-column gap-3">
              <div>
                <label for="username" class="form-label">Username</label>
                <input
                  type="text"
                  id="username"
                  name="username"
                  class="form-control rounded-3 shadow"
                  placeholder="Username"
                  <?= $inputError ? 'autofocus' : '' ?> />
              </div>

              <!-- Password field -->
              <div>
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                  <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control rounded-start-3 shadow"
                    placeholder="Password" />
                  <i class="ph ph-eye-slash input-group-text rounded-end-3 shadow" id="showPw"></i>
                </div>
              </div>

              <!-- Remember me checkbox -->
              <div class="form-check">
                <input
                  type="checkbox"
                  id="rememberme"
                  name="rememberme"
                  class="form-check-input rounded-3 shadow" />
                <label for="rememberme" class="form-check-label">Remember me</label>
              </div>

              <!-- Register link -->
              <span>Tidak punya akun? <a href="register.php">Daftar</a></span>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary align-self-center shadow" name="login">
                Login
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstsrap -->
  <script src="src/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
  <!-- Script untuk mode dark & light -->
  <script src="src/js/dark-light-mode.js"></script>
  <!-- Script untuk tombol sembunyikan & tampilkan password -->
  <script src="src/js/show-hide-pw.js"></script>
</body>

</html>