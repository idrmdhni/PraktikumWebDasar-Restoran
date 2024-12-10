<?php
session_start();

include "../module/Koneksi.php";
$db = new Koneksi("localhost", "root", "", "restoran");

if (!isset($_SESSION['login'])) {
    header('location: login.php');
}

if ($_SESSION['akses'] == "pelanggan") {
    $lokasi = "../index.php";
}

if ($_SESSION['akses'] == "administrator" || $_SESSION['akses'] == "kasir" || $_SESSION['akses'] == "pelayan") {
    $lokasi = "../transaksi.php";
}

if (isset($_POST['tambah'])) {
    $idMenuYangDipesan = $_POST["menu"];
    $waktuTransaksi = $_POST["waktu_transaksi"];
    $userId = $_POST["user_id"];
    $jumlahPesananPerMenu = $_POST["jumlah_pesanan_per_menu"];
    $totalHargaKeseluruhan = 0;

    for ($i = 0; $i < count($idMenuYangDipesan); $i++) {
        $dapatkanMenu = $db->fetchRow("SELECT * FROM daftar_menu WHERE menu_id = '{$idMenuYangDipesan[$i]}'");
        $totalHargaKeseluruhan += $dapatkanMenu['harga'] * intval($jumlahPesananPerMenu[$i]);
        $totalHarga[] = $dapatkanMenu['harga'] * intval($jumlahPesananPerMenu[$i]);
    }
} else {
    header("location: $lokasi");
}

$db->query("INSERT INTO transaksi VALUES ('', '$waktuTransaksi', '$totalHargaKeseluruhan', NULL, NULL, 'belum bayar', '$userId')");
$insertDetailTransaksi = "INSERT INTO detail_transaksi VALUES ";
for ($i = 0; $i < count($idMenuYangDipesan); $i++) {
    $insertDetailTransaksi .= "('', '{$idMenuYangDipesan[$i]}', LAST_INSERT_ID(), '" . intval($jumlahPesananPerMenu[$i]) . "', '{$totalHarga[$i]}'),";
}
$db->query(substr($insertDetailTransaksi, 0, -1));

if ($db->affectedRows() > 0) {
    echo "
            <script>
                alert('Transaksi berhasil ditambahkan!');
                document.location.href = '$lokasi';
            </script>";
} else {
    echo "
            <script>
                alert('Transaksi gagal ditambahkan!');
                document.location.href = '$lokasi';
            </script>";
}
