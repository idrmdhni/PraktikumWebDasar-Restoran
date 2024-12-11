// Script untuk mengatur light/night mode

// Mendapatkan element toggle mode malam/siang
const darkLightCheckbox = document.getElementById("darkLightcheckbox");
// Mengecek mode apakah yang disimpan di dalam cookie
const themeMode = getCookie("theme_mode");
if (themeMode == "dark") {
  darkLightCheckbox.checked = true;
  themeModeChange();
}

// Fungsi untuk membuat cookie
function setCookie(name, value, days) {
  let expires = "";

  if (days) {
    const date = new Date();
    date.setDate(date.getDate() + days);

    expires = date.toUTCString();
  }

  document.cookie = `${name}=${
    value || ""
  }; expires=${expires}; path=/; SameSite=Lax`;
}

// Fungsi untuk mendapatkan cookie
function getCookie(cookieName) {
  const name = cookieName + "=";
  const decodedCookie = decodeURIComponent(document.cookie);
  let allCookie = decodedCookie.split(";");
  for (let i = 0; i < allCookie.length; i++) {
    let cookie = allCookie[i];

    while (cookie.charAt(0) == " ") {
      cookie = cookie.substring(1, cookie.length);
    }

    if (cookie.indexOf(name) == 0) {
      return cookie.substring(name.length, cookie.length);
    }
  }
}

// Fungsi untuk mengganti mode
function themeModeChange() {
  if (darkLightCheckbox.checked) {
    document.documentElement.setAttribute("data-bs-theme", "dark");

    setCookie("theme_mode", "dark", 360);
  } else {
    document.documentElement.setAttribute("data-bs-theme", "light");

    setCookie("theme_mode", "light", 30);
  }
}

// Event untuk mengecek apkah toggle mode malam berubah
darkLightCheckbox.addEventListener("change", () => {
  themeModeChange();
});
