const showPw = document.getElementById("showPw");
const password = document.getElementById("password");

showPw.style.cursor = "pointer";

showPw.addEventListener("click", (ele) => {
  ele.target.classList.toggle("ph-eye-slash");
  ele.target.classList.toggle("ph-eye");
  console.log(password.getAttribute("type"));
  if (password.getAttribute("type") == "password") {
    password.removeAttribute("type", "password");
    password.setAttrribute("type", "text");
  } else {
    password.removeAttribute("type", "text");
    password.setAttribute("type", "password");
  }
});
