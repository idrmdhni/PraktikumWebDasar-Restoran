// Mengatur mode dark & light
const checkbox = document.getElementById("checkbox");
checkbox.addEventListener("change", () => {
  if (checkbox.checked) {
    document.documentElement.setAttribute("data-bs-theme", "dark");
  } else {
    document.documentElement.setAttribute("data-bs-theme", "light");
  }
});
