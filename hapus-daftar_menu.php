<?php
session_start();

include "module/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");

include "module/session-admin.php";

if (isset($_POST['hapus_menu'])) {
    $mid = $_POST['menu_id'];
} else {
    header('location: kelola-menu.php');
}

$db->query("DELETE FROM daftar_menu WHERE menu_id = '$mid'");

if ($db->affectedRows() > 0) {
    echo "
        <script>
            alert('Menu berhasil dihapus!');
            document.location.href = 'kelola-menu.php';
        </script>";
} else {
    echo "
        <script>
            alert('Menu gagal dihapus!');
            document.location.href = 'kelola-menu.php';
        </script>";
}
