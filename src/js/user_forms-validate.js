const userForms = document.getElementById("userFormsValidation");
const username = document.getElementById("username");
const password = document.getElementById("password");
const namaLengkap = document.getElementById("nama");

userForms.addEventListener("submit", (event) => {
  if (!userForms.checkValidity()) {
    event.preventDefault();
    event.stopPropagation();
  }
  setTimeout(() => {
    username.classList.add("is-invalid");
    password.classList.add("is-invalid");
    if (namaLengWkap) {
      namaLengkap.classList.add("is-invalid");
    }
  }, 500);
  // forms.classList.add("was-validated");
});
