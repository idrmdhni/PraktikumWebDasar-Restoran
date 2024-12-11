// Script untuk validasi form input akun

// Mengambil semua element input
const userFormValidation = document.getElementById("userFormValidation");
const username = document.getElementById("username");
const password = document.getElementById("password");
const namaLengkap = document.getElementById("nama");

// Event ketika tombol di submit
userFormValidation.addEventListener("submit", (event) => {
  if (!userFormValidation.checkValidity()) {
    // Menghentikan aksi mengirim form ketika input kosong
    event.preventDefault();
    event.stopPropagation();

    // Memberi peringatan ke input yang kosong
    if (username.value == "") {
      username.classList.add("is-invalid");
    }
    if (password.value == "") {
      password.classList.add("is-invalid");
    }

    if (namaLengkap) {
      if (namaLengkap.value == "") {
        namaLengkap.classList.add("is-invalid");
      }
    }
  }
});
