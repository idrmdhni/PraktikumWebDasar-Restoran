const showPw = document.querySelectorAll(".show-pw");
const pw = document.querySelectorAll(".pw");

for (let i = 0; i < showPw.length; i++) {
  showPw[i].style.cursor = "pointer";
  showPw[i].addEventListener("click", (ele) => {
    ele.target.classList.toggle("ph-eye-slash");
    ele.target.classList.toggle("ph-eye");

    if (pw[i].getAttribute("type") == "password") {
      pw[i].removeAttribute("type", "password");
      pw[i].setAttribute("type", "text");
    } else {
      pw[i].removeAttribute("type", "text");
      pw[i].setAttribute("type", "password");
    }
  });
}
