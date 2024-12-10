console.log("\u00A9Indra");
const sidebarBtn = document.getElementById("sidebarBtn");
const closeSidebarBtn = document.getElementById("closeSidebarBtn");
const sidebarParent = document.getElementById("sidebarParent");
const nameLabel = document.getElementById("nameLabel");
const labelDivider = document.getElementById("labelDivider");
const textSideBar = document.querySelectorAll(".nav-item .nav-link > span");
const content = document.getElementById("content");

const sideBar = () => {
  // Memperbesar sidebar
  sidebarParent.classList.toggle("sidebar-close");
  sidebarParent.classList.toggle("d-none");
  sidebarParent.classList.toggle("col-lg-3");
  sidebarParent.classList.toggle("col-xl-2");
  // Menampilkan nama saat sidebar diperbesar
  nameLabel.classList.toggle("d-none");
  nameLabel.classList.toggle("d-flex");
  labelDivider.classList.toggle("d-none");
  // Menampilkan text menu saat sidebar diperbesar
  textSideBar.forEach(function (text) {
    text.classList.toggle("d-none");
  });
  // Menghilangkan konten ketika sidebar dibuka dilayar kecil
  if (content) {
    content.classList.toggle("col-lg-9");
    content.classList.toggle("col-xl-10");
  }
};

window.addEventListener("resize", () => {
  // Jika ukuran layar berubah saat sidebar terbuka
  // Sidebar akan tertutup ketika ukuran layar mencapai 942 - 991
  if (
    window.innerWidth >= 942 &&
    window.innerWidth < 992 &&
    sidebarParent.classList.contains("show")
  ) {
    closeSidebarBtn.click();
  }
  // Sidebar akan tertutup ketika ukuran layar mencapai 993 - 1042
  if (
    window.innerWidth > 992 &&
    window.innerWidth <= 1042 &&
    sidebarParent.classList.contains("col-lg-3")
  ) {
    sidebarBtn.click();
  }
});

// Menjalankan fungsi sideBar ketika menekan tombol untuk membuka / menutup sidebar
sidebarBtn.addEventListener("click", () => {
  sideBar();
});
closeSidebarBtn.addEventListener("click", sideBar);
