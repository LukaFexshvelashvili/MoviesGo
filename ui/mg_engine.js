import { color_list, themes_list } from "./themes.js";
let main_color = color_list[0].main;

document.addEventListener("DOMContentLoaded", () => {
  const mg_web_loader = document.querySelector(".mg_web_loader");

  mg_web_loader.classList.add("mg_web_loader_hidden");
  mg_web_loader.addEventListener("transitioned", () => {
    mg_web_loader.remove();
  });
});

if (localStorage.getItem("ui")) {
  const decoded = JSON.parse(localStorage.getItem("ui"));
  if (decoded) {
    if (decoded.color !== undefined) {
      changeActiveColorHand(decoded.color);
    } else if (decoded.theme !== undefined) {
      changeActiveThemeHand(decoded.theme);
    }
  } else {
    localStorage.setItem("ui", JSON.stringify({ color: 0 }));
    document.documentElement.style.setProperty("--main", main_color);
  }
} else {
  localStorage.setItem("ui", JSON.stringify({ color: 0 }));
  document.documentElement.style.setProperty("--main", main_color);
}

function changeActiveThemeHand(themeID) {
  const theme = themes_list.filter((item) => item.id == themeID)[0];

  if (theme) {
    Array.from(Object.keys(theme)).forEach((item) => {
      document.documentElement.style.setProperty(`--${item}`, theme[item]);
    });
    active_colors = {
      main: theme.main,
      mainshadow: theme.mainshadow,
      mainhover: theme.mainhover,
    };
  }
}

function changeActiveColorHand(colorID) {
  const colors = color_list.filter((item) => item.id == colorID)[0];
  if (colors) {
    if (colors) {
      localStorage.setItem("maincolor", colors.main);
      Array.from(Object.keys(colors)).forEach((item) => {
        document.documentElement.style.setProperty(`--${item}`, colors[item]);
      });
    }
  } else {
    localStorage.setItem("ui", JSON.stringify({ color: 0 }));
    document.documentElement.style.setProperty("--main", main_color);
  }
}
