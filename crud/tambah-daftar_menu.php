<?php
session_start();

include "../module/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");

include "../module/session/session-admin.php";
include "../module/upload_gambar-daftar_menu.php";

if (isset($_POST['tambah'])) {
    $namaMenu = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $gambarMenu = upload();
} else {
    header('location: ../kelola_menu.php');
}

if ($gambarMenu['status'] == 'error') {
    echo "
        <script>
            alert('{$gambarMenu['pesan']}');
            document.location.href = '../kelola_menu.php'
        </script>";
} else {
    $db->query("INSERT INTO daftar_menu VALUES ('', '$namaMenu', '{$gambarMenu['result']}', '$harga')");

    if ($db->affectedRows() > 0) {
        echo "
            <script>
                alert('Akun berhasil ditambahkan!');
                document.location.href = '../kelola_menu.php';
            </script>";
    } else {
        echo "
            <script>
                alert('Akun gagal ditambahkan!');
                document.location.href = '../kelola_menu.php';
            </script>";
    }
}
