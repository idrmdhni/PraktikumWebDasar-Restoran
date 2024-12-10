// Script untuk validasi saat menambahkan daftar menu
// Mengambil semua element input
const menuFormValidation = document.getElementById("menuFormValidation");
const namaMenu = document.getElementById("namaMenu");
const harga = document.getElementById("harga");
const gambarMenu = document.getElementById("gambarMenu");

// Event ketika tombol di submit
menuFormValidation.addEventListener("submit", (event) => {
  if (!menuFormValidation.checkValidity()) {
    // Menghentikan aksi mengirim form ketika input kosong
    event.preventDefault();
    event.stopPropagation();

    // Memberi peringatan ke input yang kosong
    if (namaMenu.value == "") {
      namaMenu.classList.add("is-invalid");
    }
    if (harga.value == "") {
      harga.classList.add("is-invalid");
    }
    if (gambarMenu.value == "") {
      gambarMenu.classList.add("is-invalid");
    }
  }
});
