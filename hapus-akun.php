<?php
session_start();

include "module/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");

include "module/session-admin.php";

if (isset($_POST['hapus_akun'])) {
    $uid = $_POST['user_id'];
} else {
    header('location: admin.php');
}

$db->query("DELETE FROM users WHERE user_id = '$uid'");

if ($db->affectedRows() > 0) {
    echo "
        <script>
            alert('Akun berhasil dihapus!');
            document.location.href = 'admin.php';
        </script>";
} else {
    echo "
        <script>
            alert('Akun gagal dihapus!');
            document.location.href = 'admin.php';
        </script>";
}
