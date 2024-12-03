const showPw = document.getElementById("showPw");
const pw = document.getElementById("password");

showPw.style.cursor = "pointer";

showPw.addEventListener("click", (ele) => {
  ele.target.classList.toggle("ph-eye-slash");
  ele.target.classList.toggle("ph-eye");

  if (pw.getAttribute("type") == "password") {
    pw.removeAttribute("type", "password");
    pw.setAttribute("type", "text");
  } else {
    pw.removeAttribute("type", "text");
    pw.setAttribute("type", "password");
  }
});
