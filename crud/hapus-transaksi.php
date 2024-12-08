<?php
session_start();

include "../module/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");

include "../module/session/session-admin.php";

if (isset($_POST['hapus_transaksi'])) {
    $tid = $_POST['transaksi_id'];
} else {
    header('location: ../transaksi.php');
}

$db->query("DELETE FROM transaksi WHERE transaksi_id = '$tid'");

if ($db->affectedRows() > 0) {
    echo "
        <script>
            alert('Transaksi berhasil dihapus!');
            document.location.href = '../transaksi.php';
        </script>";
} else {
    echo "
        <script>
            alert('Transaksi gagal dihapus!');
            document.location.href = '../transaksi.php';
        </script>";
}
