<?php
// Memulai sesi
session_start();
// Menyertakan script untuk fungsi database
include "module/Koneksi.php";
// Koneksi ke database restoran
$db = new Koneksi("localhost", "root", "", "restoran");
// Menyertakan script untuk mengatur sesi
include "module/session/session-login_register.php";

// Ketika tombol login ditekan
if (isset($_POST['login'])) {
  // Koneksi ke database dan mengambil data login
  $username = $_POST['username'];
  $password = $_POST['password'];
  $result = $db->fetchRow("SELECT * FROM users WHERE username = '$username'");

  // Validasi
  // Cek apakah username dan password sesuai
  if ($result && password_verify($password, $result['password'])) {

    // Set sesi untuk mengatur akses ke halaman 
    $_SESSION['login'] = $result['user_id'];
    $_SESSION['akses'] = $result['akses_id'];

    // Jika tombol remember me dicentang
    if (isset($_POST['rememberme'])) {
      // Atur agar ketika membuka halaman tidak perlu login kembali
      setcookie('id', $result['user_id'], time() + 3600);
      setcookie('key', hash('sha256', $result['username']), time() + 3600);
    }

    // Jika akun yang login termasuk akun pelanggan, arahkan ke halaman user
    if ($result['akses_id'] == "pelanggan") {
      header('location: index.php');
    }
    // Jika akun yang login tidak termasuk akun pelanggan, arahkan ke halaman admin
    else {
      header('location: admin.php');
    }
  }
  // Jika username / password tidak sesuai, set variabel untuk memunculkan peringatan
  else {
    $loginError = true;
  }
}
?>

<!DOCTYPE html>
<!-- Atribut data-bs-theme digunakan untuk mengatur night/light mode -->
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
      <input type="checkbox" class="dark-light-checkbox" id="darkLightcheckbox" />
      <label for="darkLightcheckbox" class="dark-light-checkbox-label bg-body-secondary">
        <i class="ph ph-moon me-2 text-body"></i>
        <i class="ph ph-sun text-body"></i>
        <span class="ball bg-body"></span>
      </label>
    </div>

    <!-- Login Form -->
    <div class="row h-100">
      <div class="col-9 col-sm-8 col-md-6 col-lg-5 col-xl-4 m-auto">

        <!-- Peringatan ketika username/password salah -->
        <?php if (isset($loginError)): ?>
          <div class="alert alert-danger alert-dismissible fade show">
            <span>Username atau password anda salah!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php endif ?>

        <div class="bg-body-tertiary shadow p-4 rounded-4 text">
          <div class="fs-1 fw-bold text-center mb-4">LOGIN</div>

          <form action="" method="post" id="userFormValidation" novalidate>
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
                  required />
                <div class="invalid-feedback">Username tidak boleh kosong!</div>
              </div>

              <!-- Password field -->
              <div>
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                  <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control rounded-start-3 shadow pw"
                    placeholder="Password"
                    required />
                  <i class="ph ph-eye-slash input-group-text rounded-end-3 shadow show-pw"></i>
                  <div class="invalid-feedback">Password tidak boleh kosong!</div>
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
  <script src="src/js/dark_light-mode.js"></script>
  <!-- Script untuk tombol sembunyikan & tampilkan password -->
  <script src="src/js/show-hide-pw.js"></script>
  <!-- Script untuk validasi form user -->
  <script src="src/js/validation-kelola_akun.js"></script>
</body>

</html>