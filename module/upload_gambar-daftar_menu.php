<?php
function upload()
{
    $nama_file = $_FILES["gambar_menu"]["name"];
    $ukuran_file = $_FILES["gambar_menu"]["size"];
    $error = $_FILES["gambar_menu"]["error"];
    $tmp_name = $_FILES["gambar_menu"]["tmp_name"];

    // cek apakah tidak ada gambar yang di upload
    if ($error == 4) {
        return ["status" => "error", "pesan" => "Upload gambar terlebih dahulu!"];
    }

    // cek apakah file yang diupload adalah gambar
    $ektensi_gambar_valid = ["jpg", "jpeg", "png"];
    $ektensi_gambar = explode(".", $nama_file);
    $ektensi_gambar = strtolower(end($ektensi_gambar));
    if (!in_array($ektensi_gambar, $ektensi_gambar_valid)) {
        return ["status" => "error", "pesan" => "Ektensi gambar tidak valid!"];
    }

    // cek jika ukuran file lebih dari 5 mb
    if ($ukuran_file > 5242880) {
        return ["status" => "error", "pesan" => "Ukuran gambar terlalu besar!"];
    }

    // Lolos pengecekan, gambar siap di upload
    move_uploaded_file($tmp_name, "../src/img/$nama_file");

    return ["status" => "success", "pesan" => "Gambar berhasil di upload", "result" => $nama_file];
}
