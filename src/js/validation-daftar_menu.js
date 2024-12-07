const menuFormValidation = document.getElementById("menuFormValidation");
const namaMenu = document.getElementById("namaMenu");
const harga = document.getElementById("harga");
const gambarMenu = document.getElementById("gambarMenu");

menuFormValidation.addEventListener("submit", (event) => {
  if (!menuFormValidation.checkValidity()) {
    event.preventDefault();
    event.stopPropagation();
  }
  setTimeout(() => {
    namaMenu.classList.add("is-invalid");
    harga.classList.add("is-invalid");
    gambarMenu.classList.add("is-invalid");
  }, 150);
});
