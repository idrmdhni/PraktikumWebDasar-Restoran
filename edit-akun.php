<?php
session_start();

include "app/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");

include "app/admin-session.php";

if (isset($_POST['edit'])) {
    $uid = $_POST['user_id'];
    $username = $_POST['username'];
    $namaLengkap = $_POST['nama'];
    if ($_POST['password_baru'] == "") {
        $password = $_POST['password_lama'];
    } else {
        $password = $_POST['password_baru'];
    }
} else {
    header('location: admin.php');
}

$cekUsername = $db->fetchRow("SELECT username FROM users WHERE username = '$username'");

if ($cekUsername) {
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
                alert('Akses gagal diubah!');
                document.location.href = 'admin.php';
            </script>";
    }
}
