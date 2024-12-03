<?php
if (!isset($_SESSION['login'])) {
    header('location: login.php');
}

if ($_SESSION['akses'] == "administrator" || $_SESSION['akses'] == "kasir" || $_SESSION['akses'] == "pelayan") {
    header('location: admin.php');
}
