// Script untuk validasi input saat mendambahkan transaksi
// Mendapatkan element form
const transaksiFormValidation = document.getElementById(
  "transaksiFormValidation"
);

transaksiFormValidation.addEventListener("submit", (event) => {
  if (!transaksiFormValidation.checkValidity()) {
    // Menghentikan aksi mengirim form ketika input kosong
    event.preventDefault();
    event.stopPropagation();
    // Mengirim peringatan ke input yang kosong
    transaksiFormValidation.classList.add("was-validated");
  }
});

// Script untuk menambahkan/mengurangkan input saat mendambahkan transaksi
// Mendapatkan input tombol tambah
const tambahInput = document.getElementById("tambahInput");
// Mendapatkan input tombol kurang
const kurangInput = document.getElementById("kurangInput");
// Mendapatkan dropdown
const dropdown = document.querySelector(".info-menu");

// Event ketika tombol tambah diklik
tambahInput.addEventListener("click", () => {
  // Menggandakan dropdown
  const clone = dropdown.cloneNode(true);
  document.getElementById("inputWrapper").appendChild(clone);
});

// Event ketika tombol kurang diklik
kurangInput.addEventListener("click", () => {
  // Menghapus dropdown
  form = document.querySelectorAll("#inputWrapper > .info-menu");
  form[form.length - 1].remove();
});
