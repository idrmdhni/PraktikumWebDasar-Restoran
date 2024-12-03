<?php
session_start();

include "app/Koneksi.php";

$db = new Koneksi("localhost", "root", "", "restoran");

include "app/user-session.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Halaman User</h1>
    <a href="logout.php">Logout</a>
</body>

</html>