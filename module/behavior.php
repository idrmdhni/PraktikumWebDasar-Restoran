<?php
$navItems = [
    ['link' => 'admin.php', 'title' => 'Beranda'],
    ['link' => 'kelola-menu.php', 'title' => 'Kelola Menu'],
    ['link' => 'transaksi.php', 'title' => 'Transaksi']
];
$navItemsLogo = ['Beranda' => 'ph-duotone ph-house-line', 'Kelola Menu' => 'ph-duotone ph-pencil-line', 'Transaksi' => 'ph-duotone ph-cash-register'];
$currentPage = basename($_SERVER['PHP_SELF']);
foreach ($navItems as $item) {
    if ($currentPage == $item['link']) {
        $titleCurrentPage = $item['title'];
    }
}
