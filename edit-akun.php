<?php
session_start();

include "module/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");

include "module/admin-session.php";

if (isset($_POST['edit'])) {
    $uid = $_POST['user_id'];
    $username = $_POST['username'];
    $namaLengkap = $_POST['nama'];
    if ($_POST['password_baru'] == "") {
        $password = $_POST['password_lama'];
    } else {
        $password = password_hash($_POST['password_baru'], PASSWORD_DEFAULT);;
    }
} else {
    header('location: admin.php');
}

$cekUsername = $db->fetchRow("SELECT * FROM users WHERE username = '$username'");

if ($cekUsername && $cekUsername['user_id'] != $uid) {
    echo "
        <script>
            alert('Username tidak tersedia!');
            document.location.href = 'admin.php';
        </script>";
} else {
    $db->query("UPDATE users SET username = '$username', nama_lengkap = '$namaLengkap', password = '$password' WHERE user_id = '$uid'");

    if ($db->affectedRows() > 0) {
        echo "
            <script>
                alert('Akun berhasil diedit!');
                document.location.href = 'admin.php';
            </script>";
    } else {
        echo "
            <script>
                alert('Akun gagal diubah!');
                document.location.href = 'admin.php';
            </script>";
    }
}
