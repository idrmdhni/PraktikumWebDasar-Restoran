<?php
session_start();

include "../module/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");

include "../module/session/session-admin.php";

if (isset($_POST['bayar_transaksi'])) {
    $bayar = $_POST['bayar'];
    $kembalian = $_POST['kembalian'];
    $tId = $_POST['transaksi_id'];
} else {
    header('location: ../transaksi.php');
}

$db->query("UPDATE transaksi SET bayar = '$bayar', kembalian = '$kembalian', status_bayar = 'lunas' ");
if ($db->affectedRows() > 0) {
    echo "
            <script>
                alert('Pesanan berhasil dibayar!');
                document.location.href = '../transaksi.php';
            </script>";
} else {
    echo "
            <script>
                alert('Pesanan gagal dibayar!');
                document.location.href = '../transaksi.php';
            </script>";
}
