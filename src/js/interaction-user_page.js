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

for (let i = 0; i < menuCheckbox.length; i++) {
  menuCheckbox[i].addEventListener("change", function () {
    if (this.checked) {
      amountField[i].required = true;
      cardMenu[i].classList.toggle("border-warning");
      cardFooterMenu[i].classList.toggle("border-warning");
      increDecre[i].style.display = "flex";
      amountField[i].setAttribute("name", "jumlah_pesanan_per_menu[]");
      amountField[i].value = 1;
    } else {
      amountField[i].required = false;
      cardMenu[i].classList.toggle("border-warning");
      cardFooterMenu[i].classList.toggle("border-warning");
      increDecre[i].style.display = "none";
      amountField[i].removeAttribute("name");
      amountField[i].value = null;
    }
  });
  amountField[i].addEventListener("input", function () {
    amount(i);
  });
  incrementBtn[i].addEventListener("click", function () {
    amountField[i].value = parseInt(amountField[i].value) + 1;
    amount(i);
  });
  decremenetBtn[i].addEventListener("click", function () {
    amountField[i].value = parseInt(amountField[i].value) - 1;
    amount(i);
  });
}

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
