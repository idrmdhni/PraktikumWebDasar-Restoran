// Script untuk mengatur lihat/sembunyikan password

// Mengambil element icon lihat password
const showPw = document.querySelectorAll(".show-pw");
// Mengambil element input password
const pw = document.querySelectorAll(".pw");

for (let i = 0; i < showPw.length; i++) {
  // Mengatur kursor menjadi icon saat berada di atas icon lihat password
  showPw[i].style.cursor = "pointer";
  // Event ketika icon lihat password di klik
  showPw[i].addEventListener("click", (ele) => {
    // Mengubah icon lihat password
    ele.target.classList.toggle("ph-eye-slash");
    ele.target.classList.toggle("ph-eye");

    // Mengubah tipe input menjadi password / text
    if (pw[i].getAttribute("type") == "password") {
      pw[i].removeAttribute("type");
      pw[i].setAttribute("type", "text");
    } else {
      pw[i].removeAttribute("type");
      pw[i].setAttribute("type", "password");
    }
  });
}
