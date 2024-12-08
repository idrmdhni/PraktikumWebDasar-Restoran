<?php
if (!isset($_SESSION['login'])) {
    header('location: login.php');
}

if ($_SESSION['akses'] == "pelanggan") {
    header('location: index.php');
}
