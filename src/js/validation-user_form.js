const userFormValidation = document.getElementById("userFormValidation");
const username = document.getElementById("username");
const password = document.getElementById("password");
const namaLengkap = document.getElementById("nama");

userFormValidation.addEventListener("submit", (event) => {
  if (!userFormValidation.checkValidity()) {
    event.preventDefault();
    event.stopPropagation();
  }
  setTimeout(() => {
    username.classList.add("is-invalid");
    password.classList.add("is-invalid");

    if (namaLengkap) {
      namaLengkap.classList.add("is-invalid");
    }
  }, 150);
});
