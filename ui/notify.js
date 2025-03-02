import { color_list, themes_list } from "./themes.js";

const variables = getComputedStyle(document.documentElement);

let active_colors = {
  main: variables.getPropertyValue("--main").trim(),
  mainshadow: variables.getPropertyValue("--mainshadow").trim(),
  mainhover: variables.getPropertyValue("--mainhover").trim(),
};
function cookieExists(name) {
  return document.cookie
    .split("; ")
    .some((cookie) => cookie.startsWith(name + "="));
}
const notify_choose_colors = document.querySelector(".notify_choose_colors");
const notify_choose_themes = document.querySelector(".notify_choose_themes");
if (!cookieExists("theme_notify")) {
  function initializeThemeSelector() {
    themes_list.slice(0, 6).forEach((item) => {
      notify_choose_themes.innerHTML += `
        <div style="background: linear-gradient(to bottom right,  ${
          item.bodybg
        } 50%,  ${item.main} 51%)" data-theme-id='${
        item.id
      }' class="n_selection theme_selection_button ${
        item.main == active_colors.main ? "n_selected" : ""
      }"></div>
            `;
    });
    const theme_selection_buttons = document.querySelectorAll(
      ".theme_selection_button"
    );
    Array.from(theme_selection_buttons).forEach((element) => {
      element.addEventListener("click", () => {
        changeTheme(
          element,
          theme_selection_buttons,
          element.getAttribute("data-theme-id")
        );
      });
    });
  }

  initializeThemeSelector();

  function changeTheme(button, buttons, themeID) {
    document.documentElement.style.cssText = "";
    // remove all current active themes
    const color_selection_buttons = document.querySelectorAll(
      ".color_selection_button"
    );

    color_selection_buttons.forEach((d) => d.classList.remove("n_selected"));
    buttons.forEach((d) => d.classList.remove("n_selected"));

    let get_theme = themes_list.filter((d) => d.id == themeID)[0];
    if (get_theme) {
      getTransition();
      button.classList.add("n_selected");
      localStorage.setItem("ui", JSON.stringify({ theme: themeID }));

      Array.from(Object.keys(get_theme)).forEach((item) => {
        document.documentElement.style.setProperty(
          `--${item}`,
          get_theme[item]
        );
      });
      active_colors = {
        main: get_theme.main,
        mainshadow: get_theme.mainshadow,
        mainhover: get_theme.mainhover,
      };
    }
  }

  function initializeColorSelector() {
    color_list.slice(0, 6).forEach((item) => {
      notify_choose_colors.innerHTML += `
        <div style="background-color: ${
          item.main
        }" class="n_selection color_selection_button ${
        item.main == active_colors.main ? "n_selected" : ""
      }"></div>
            `;
    });
    const color_selection_buttons = document.querySelectorAll(
      ".color_selection_button"
    );
    Array.from(color_selection_buttons).forEach((element) => {
      element.addEventListener("click", () =>
        changeActiveColor(element, color_selection_buttons)
      );
    });
  }

  initializeColorSelector();

  function changeActiveColor(button, buttons) {
    document.documentElement.style.cssText = "";
    const theme_selection_buttons = document.querySelectorAll(
      ".theme_selection_button"
    );

    theme_selection_buttons.forEach((d) => d.classList.remove("n_selected"));

    buttons.forEach((d) => d.classList.remove("n_selected"));
    const get_active_colors = color_list.filter(
      (d) => d.main == button.style.backgroundColor
    )[0];

    if (get_active_colors) {
      getTransition();
      active_colors = get_active_colors.main;
      localStorage.setItem(
        "ui",
        JSON.stringify({ color: get_active_colors.id })
      );
      button.classList.add("n_selected");
      Array.from(Object.keys(get_active_colors)).forEach((item) => {
        document.documentElement.style.setProperty(
          `--${item}`,
          get_active_colors[item]
        );
      });
    }
  }
  function getTransition() {
    const style = document.createElement("style");
    style.innerHTML = `
* {
  transition: border-color 0.3s, background-color 0.3s, color 0.3s, outline-color 0.3s, box-shadow 0.3s;
}
`;
    document.head.appendChild(style);
    setTimeout(() => {
      style.remove();
    }, 300);
  }
}
