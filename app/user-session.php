<?php
if (!isset($_SESSION['login'])) {
    header('location: login.php');
}

if ($_SESSION['akses'] == "administrator" || $_SESSION['akses'] == "kasir" || $_SESSION['akses'] == "pelayan") {
    header('location: admin.php');
}

$accStatus = $db->fetchRow("SELECT status FROM users WHERE user_id = '{$_SESSION['login']}'")['status'];
if ($accStatus == 'tidak aktif') {
    header('location: logout.php');
}
