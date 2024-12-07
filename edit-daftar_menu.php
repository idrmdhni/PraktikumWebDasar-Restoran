<?php
session_start();

include "module/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");

include "module/session-admin.php";
include "module/upload_gambar-daftar_menu.php";

if (isset($_POST['edit'])) {
    $mid = $_POST['menu_id'];
    $namaMenu = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $gambar_lama = $_POST['gambar_lama'];
    if ($_FILES["gambar_menu"]["error"] == 4) {
        $gambar_baru = $gambar_lama;
    } else {
        $gambar_baru = upload()['result'];
    }
} else {
    header('location: kelola_menu.php');
}


$db->query("UPDATE daftar_menu SET nama_menu = '$namaMenu', harga = '$harga', gambar = '$gambar_baru' WHERE menu_id = '$mid'");

if ($db->affectedRows() > 0) {
    echo "
        <script>
            alert('Menu berhasil diedit!');
            document.location.href = 'kelola-menu.php';
        </script>";
} else {
    echo "
        <script>
            alert('Menu gagal diubah!');
            document.location.href = 'kelola-menu.php';
        </script>";
}
