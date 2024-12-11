// Script untuk mengatur interaksi di halaman user

const cardMenu = document.querySelectorAll(".card.card-menu");
const cardFooterMenu = document.querySelectorAll(
  ".card-footer.card-footer-menu"
);
const increDecre = document.querySelectorAll(".incre-decre");
const amountField = document.querySelectorAll(".amount");
const incrementBtn = document.querySelectorAll(".increment");
const decremenetBtn = document.querySelectorAll(".decrement");
const menuCheckbox = document.querySelectorAll(
  ".form-check-input.chekbox-menu"
);
const userTransactionValidation = document.getElementById(
  "userTransactionValidation"
);
const alertInput = document.querySelector(".alert.alert-danger");
const tombolPesan = document.querySelector(".btn[name='tambah']");

// Mengatur segala perilaku input untuk menentukan jumlah menu
function amount(index) {
  // Regex (Regular Expression) untuk menyaring input selain angka
  const regex = /[^0-9]/g;
  // Jika nilai input kurang dari sama dengan 1
  if (amountField[index].value <= 0) {
    // Menghilangkan fungsi tombol kurang
    decremenetBtn[index].disabled = true;
    // Membuat input tetap berada di nol
    amountField[index].value = 0;
  } else {
    // Jika nilai input lebih dari 1, maka akan mengembalikan fungsi tombol kurang
    decremenetBtn[index].disabled = false;
  }

  // Jika nilai input kosong
  if (amountField[index].value == "") {
    // Menghilangkan fungsi tombol tambah
    incrementBtn[index].disabled = true;
  } else {
    // Jika terdapat nilai pada input, maka akan mengembalikan fungsi tombol tambah
    incrementBtn[index].disabled = false;
  }

  // Jika memasukkan selain angka pada input
  if (regex.test(amountField[index].value)) {
    // Karakter tersebut akan dihapus
    amountField[index].value = amountField[index].value.replace(regex, "");
  }
}

// Mendapatkan setiap checkbox
for (let i = 0; i < menuCheckbox.length; i++) {
  // Event ketika checkbox di ceklis
  menuCheckbox[i].addEventListener("change", function () {
    // Jika tombol checkbox untuk memilih menu diceklis
    if (this.checked) {
      // Membuat input wajib memiliki nilai
      amountField[i].required = true;
      amountField[i].value = 1;

      // Memunculkan input untuk menentukan jumlah menu
      increDecre[i].style.display = "flex";
      // Menambahkan atribut name pada input untuk mengisi jumlah menu
      amountField[i].setAttribute("name", "jumlah_pesanan_per_menu[]");

      // Tambahan styling
      cardMenu[i].classList.toggle("border-warning");
      cardFooterMenu[i].classList.toggle("border-warning");
    } else {
      // Ketika tombol checkbox untuk memilih menu di unceklis
      // Membuat input tidak wajib memiliki nilai
      amountField[i].required = false;
      amountField[i].value = null;

      // Menghilangkan input untuk menentukan jumlah menu
      increDecre[i].style.display = "none";
      // Menghapus atribut name pada input untuk mengisi jumlah menu
      amountField[i].removeAttribute("name");

      // Tambahan styling
      cardMenu[i].classList.toggle("border-warning");
      cardFooterMenu[i].classList.toggle("border-warning");
    }
  });

  // Event ketika nilai input untuk menentukan jumlah menu berubah
  amountField[i].addEventListener("input", function () {
    // Menjalankan fungsi amount
    amount(i);
  });
  // Event ketika tombol untuk menambahkan jumlah menu berubah
  incrementBtn[i].addEventListener("click", function () {
    // Menambahkankan 1 nilai input
    amountField[i].value = parseInt(amountField[i].value) + 1;
    // Menjalankan fungsi amount
    amount(i);
  });
  // Event ketika tombol untuk mengurangi jumlah menu berubah
  decremenetBtn[i].addEventListener("click", function () {
    // Mengurangi 1 nilai input
    amountField[i].value = parseInt(amountField[i].value) - 1;
    amount(i);
  });
}

// Event ketika tombol pesan diklik
userTransactionValidation.addEventListener("submit", (event) => {
  // Mengecek apakah terdapat menu yang dipilih
  let isChecked = false;
  menuCheckbox.forEach((element) => {
    if (element.checked) {
      isChecked = true;
    }
  });

  for (let i = 0; i < amountField.length; i++) {
    // Periksa apakah ada input yang kosong / ada menu yang dipilih / jumlah menu sama dengan 0
    if (
      !userTransactionValidation.checkValidity() ||
      isChecked == false ||
      parseInt(amountField[i].value) <= 0
    ) {
      // Menghentikan aksi mengirim form ketika input kosong
      event.preventDefault();
      event.stopPropagation();

      // Memberi peringatan ke input yang kosong
      if (amountField[i].value == "" || parseInt(amountField[i].value) <= 0) {
        amountField[i].classList.add("is-invalid");
        alertInput.classList.add("show");
      }
      break;
    }
  }
});
