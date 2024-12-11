<?php
$user = $db->fetchRow("SELECT * FROM users WHERE user_id = '{$_SESSION['login']}'");
?>

<header class="d-flex align-items-center justify-content-between">
    <!-- Tombol Navigasi dan Judul Halaman -->
    <div class="ms-2 d-flex gap-4">
        <a class="ph-bold ph-list fs-3 text-decoration-none text-reset align-self-center" id="sidebarBtn" data-bs-toggle="offcanvas" data-bs-target="#sidebarParent"></a>
        <span class="fs-5 fw-semibold">Selamat Datang, <?= $user['nama_lengkap'] ?></span>
    </div>

    <!-- Tombol switch dark/light mode -->
    <div class="me-2">
        <input type="checkbox" class="dark-light-checkbox" id="darkLightcheckbox" />
        <label for="darkLightcheckbox" class="dark-light-checkbox-label bg-body-secondary">
            <i class="ph ph-moon me-2 text-body"></i>
            <i class="ph ph-sun text-body"></i>
            <span class="ball bg-body"></span>
        </label>
    </div>
</header>