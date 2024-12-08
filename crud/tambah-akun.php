<?php
session_start();

include "../module/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");

include "../module/session/session-admin.php";

if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $namaLengkap = $_POST['nama'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $jenisAkun = $_POST['role'];
} else {
    header('location: ../admin.php');
}

$result = $db->fetchRow("SELECT username FROM users WHERE username = '$username'");

if ($result) {
    echo "
    <script>
        alert('Username tidak tersedia!');
        document.location.href = '../admin.php';
    </script>";
} else {
    $db->query("INSERT INTO users VALUES ('', '$username', '$password', '$namaLengkap')");
    $result = $db->fetchRow("SELECT * FROM users WHERE username = '$username'")['user_id'];
    $db->query("INSERT INTO akses VALUES ('$result', '$jenisAkun')");

    if ($db->affectedRows() > 0) {
        echo "
            <script>
                alert('Akun berhasil ditambahkan!');
                document.location.href = '../admin.php';
            </script>";
    } else {
        echo "
            <script>
                alert('Akun gagal ditambahkan!');
                document.location.href = '../admin.php';
            </script>";
    }
}
