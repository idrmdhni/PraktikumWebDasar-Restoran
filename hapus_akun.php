<?php
session_start();

include "app/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");

include "app/admin-session.php";

if (isset($_GET['akun'])) {
    $uid = $_GET['akun'];
} else {
    header('location: admin.php');
}

$db->query("DELETE FROM users WHERE user_id = '$uid'");

if ($db->affectedRows() > 0) {
    echo "
        <script>
            alert('Akses berhasil diubah!');
            document.location.href = 'admin.php';
        </script>";
} else {
    echo "
        <script>
            alert('Akses gagal diubah!');
            document.location.href = 'admin.php';
        </script>";
}
