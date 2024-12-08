<?php
session_start();

include "../module/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");

include "../module/session/session-admin.php";

if (isset($_POST['tambah'])) {
    $waktuTransaksi = $_POST["waktu_transaksi"];
    $userId = $_POST["user_id"];
    $idMenuYangDipesan = $_POST["menu"];
    $jumlahPesananPerMenu = $_POST["jumlah_pesanan_per_menu"];
    $totalHargaKeseluruhan = 0;

    for ($i = 0; $i < count($idMenuYangDipesan); $i++) {
        $dapatkanMenu = $db->fetchRow("SELECT * FROM daftar_menu WHERE menu_id = '{$idMenuYangDipesan[$i]}'");
        $totalHargaKeseluruhan += $dapatkanMenu['harga'] * $jumlahPesananPerMenu[$i];
        $totalHarga[] = $dapatkanMenu['harga'] * $jumlahPesananPerMenu[$i];
    }
} else {
    header('location: ../transaksi.php');
}

$db->query("INSERT INTO transaksi VALUES ('', '$waktuTransaksi', '$totalHargaKeseluruhan', NULL, NULL, 'belum bayar', '$userId')");
$insertDetailTransaksi = "INSERT INTO detail_transaksi VALUES ";
for ($i = 0; $i < count($idMenuYangDipesan); $i++) {
    $insertDetailTransaksi .= "('', '{$idMenuYangDipesan[$i]}', LAST_INSERT_ID(), '{$jumlahPesananPerMenu[$i]}', '{$totalHarga[$i]}'),";
}
$db->query(substr($insertDetailTransaksi, 0, -1));

if ($db->affectedRows() > 0) {
    echo "
            <script>
                alert('Transaksi berhasil ditambahkan!');
                document.location.href = '../transaksi.php';
            </script>";
} else {
    echo "
            <script>
                alert('Transaksi gagal ditambahkan!');
                document.location.href = '../transaksi.php';
            </script>";
}
