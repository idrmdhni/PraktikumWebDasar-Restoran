<?php
session_start();

include "../module/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");

include "../module/session/session-admin.php";

if (isset($_POST['bayar_pesanan'])) {
    $bayar = $_POST['bayar'];
    $kembalian = $_POST['kembalian'];
    $tId = $_POST['transaksi_id'];
    $totalHargaKeseluruhan = $_POST['total_harga_keseluruhan'];
} else {
    header('location: ../transaksi.php');
}

if ($bayar < $totalHargaKeseluruhan) {
    echo "
            <script>
                alert('Jumlah pembayaran yang diberikan kurang dari total harga keseluruhan!');
                document.location.href = '../transaksi.php';
            </script>";
} else {
    $db->query("UPDATE transaksi SET bayar = '$bayar', kembalian = '$kembalian', status_bayar = 'lunas' WHERE transaksi_id = $tId");
    if ($db->affectedRows() > 0) {
        echo "
            <script>
                alert('Transaksi berhasil dibayar!');
                document.location.href = '../transaksi.php';
            </script>";
    } else {
        echo "
            <script>
                alert('Transaksi gagal dibayar!');
                document.location.href = '../transaksi.php';
            </script>";
    }
}
