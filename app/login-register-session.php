<?php
// Cek apakah sudah login:
// Jika pada cookie terdapat id dan key
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    $result = $db->fetchRow("SELECT * FROM users WHERE user_id = '$id'");
    $akses = $db->fetchRow("SELECT * FROM akses WHERE user_id = '{$result["user_id"]}'");

    // Cek apakah key tersebut sesuai dengan username
    if ($key === hash('sha256', $result['username'])) {
        // Jika iya, set sesi login
        $_SESSION['login'] = $id;
        $_SESSION['akses'] = $akses['akses_id'];
    }
}

// Jika terdapat sesi login, arahkan ke halaman admin / user
if (isset($_SESSION['login']) && isset($_SESSION['akses'])) {
    // Jika akun yang login termasuk akun pelanggan, arahkan ke halaman user
    if ($_SESSION['akses'] == "pelanggan") {
        header('location: index.php');
    }
    // Jika akun yang login tidak termasuk akun pelanggan, arahkan ke halaman admin
    else {
        header('location: admin.php');
    }
}
