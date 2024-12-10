<?php
// Mengilangkan semua sesi
session_start();
$_SESSION = [];
session_unset();
session_destroy();

// Menghapus cookie id dan key
setcookie("id", "", time() - 3600);
setcookie("key", "", time() - 3600);

// Kembali ke halaman login
header("location: login.php");
exit;
