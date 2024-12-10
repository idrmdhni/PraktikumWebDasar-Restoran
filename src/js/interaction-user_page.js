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
  if (amountField[index].value <= 1) {
    // Menghilangkan fungsi tombol kurang
    decremenetBtn[index].disabled = true;
  } else {
    // Jika nilai input lebih dari 1, maka akan mengembalikan fungsi tombol kurang
    decremenetBtn[index].disabled = false;
  }

  if (amountField[index].value < 1) {
    // Menghilangkan tombol pesan
    tombolPesan.classList.add("d-none");
  } else {
    tombolPesan.classList.remove("d-none");
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
      tombolPesan.classList.remove("d-none");
    } else {
      amountField[i].required = false;
      cardMenu[i].classList.toggle("border-warning");
      cardFooterMenu[i].classList.toggle("border-warning");
      increDecre[i].style.display = "none";
      amountField[i].removeAttribute("name");
      amountField[i].value = null;
      tombolPesan.classList.add("d-none");
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
  for (let i = 0; i < amountField.length; i++) {
    if (!userTransactionValidation.checkValidity()) {
      // Menghentikan aksi mengirim form ketika input kosong
      event.preventDefault();
      event.stopPropagation();

      // Memberi peringatan ke input yang kosong
      if (amountField[i].value == "") {
        amountField[i].classList.add("is-invalid");
        alertInput.classList.add("show");
      }
    }
  }
});
