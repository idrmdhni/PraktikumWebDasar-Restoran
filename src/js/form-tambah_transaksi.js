// Validasi
const transaksiFormValidation = document.getElementById(
  "transaksiFormValidation"
);

transaksiFormValidation.addEventListener("submit", (event) => {
  if (!transaksiFormValidation.checkValidity()) {
    event.preventDefault();
    event.stopPropagation();
  }
  setTimeout(() => {
    transaksiFormValidation.classList.add("was-validated");
  }, 150);
});

// Clone input
const tambahInput = document.getElementById("tambahInput");
const kurangInput = document.getElementById("kurangInput");
const dropdown = document.querySelector(".info-menu");

tambahInput.addEventListener("click", () => {
  const clone = dropdown.cloneNode(true);
  document.getElementById("inputWrapper").appendChild(clone);
});

kurangInput.addEventListener("click", () => {
  form = document.querySelectorAll("#inputWrapper > .info-menu");
  form[form.length - 1].remove();
});
