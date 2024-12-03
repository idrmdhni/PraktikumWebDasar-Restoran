<div class="offcanvas-lg offcanvas-start d-none bg-body-tertiary vh-100 d-lg-flex flex-column text-body py-3 sidebar-close shadow" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="sidebarParent">
  <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebarParent" id="closeSidebarBtn" aria-label="Close"></button>
  <div
    class="mt-2 d-none justify-content-center align-items-center gap-2" id="nameLabel">
    <img
      src="src/img/logo.png"
      alt="profile picture"
      width="45"
      height="45"
      class="rounded-circle" />
    <span class="fs-4 fw-bold">Restoran</span>
  </div>

  <hr class="w-100 d-none" id="labelDivider" />

  <ul class="nav nav-pills flex-column h-100" id="menu">
    <?php foreach ($navItems as $item): ?>
      <li class="nav-item mb-1">
        <a
          href='<?= $item["link"] ?>'
          class="nav nav-link text-body d-flex gap-3 align-items-center <?= $currentPage ==  $item['link'] ? 'active' : '' ?>">
          <i class="<?= $navItemsLogo[$item['title']] ?> fs-4"></i>
          <span class="d-none"><?= $item['title'] ?></span>
        </a>
      </li>
    <?php endforeach ?>
  </ul>

  <hr class="w-100" />

  <ul class="nav flex-column">
    <li class="nav-item">
      <a
        href="logout.php"
        class="nav nav-link text-body d-flex gap-2 align-items-center">
        <i class="ph-duotone ph-sign-out fs-4"></i>
        <span class="d-none">Logout</span>
      </a>
    </li>
  </ul>
</div>