<?php
if (!isset($_SESSION['login'])) {
    header('location: login.php');
}

if ($_SESSION['akses'] == "pelanggan") {
    header('location: index.php');
}

$accStatus = $db->fetchRow("SELECT status FROM users WHERE user_id = '{$_SESSION['login']}'")['status'];
if ($accStatus == 'tidak aktif') {
    header('location: logout.php');
}
