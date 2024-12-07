// Mengatur mode dark & light
const darkLightCheckbox = document.getElementById("darkLightcheckbox");

const themeMode = getCookie("theme_mode");
if (themeMode == "dark") {
  darkLightCheckbox.checked = true;
  themeModeChange();
}

function setCookie(name, value, days) {
  // console.log("tes");
  let expires = "";

  if (days) {
    const date = new Date();
    date.setDate(date.getDate() + days);

    expires = date.toUTCString();
  }

  document.cookie = `${name}=${
    value || ""
  }; expires=${expires}; path=/; SameSite=Lax`;
  console.log(
    `${name}=${value || ""}; expires=${expires}; path=/; SameSite=Lax`
  );
}

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

function themeModeChange() {
  if (darkLightCheckbox.checked) {
    document.documentElement.setAttribute("data-bs-theme", "dark");

    setCookie("theme_mode", "dark", 30);
  } else {
    document.documentElement.setAttribute("data-bs-theme", "light");

    setCookie("theme_mode", "light", 30);
  }
}

darkLightCheckbox.addEventListener("change", () => {
  themeModeChange();
});
