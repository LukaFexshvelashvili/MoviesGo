import { color_list, themes_list } from "./themes.js";
let main_color = color_list[0].main;

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
  }
}

function changeActiveColorHand(colorID) {
  const colors = color_list.filter((item) => item.id == colorID)[0];
  if (colors) {
    if (colors) {
      localStorage.setItem("ui", JSON.stringify({ color: colors.id }));
      Array.from(Object.keys(colors)).forEach((item) => {
        document.documentElement.style.setProperty(`--${item}`, colors[item]);
      });
    }
  } else {
    localStorage.setItem("ui", JSON.stringify({ color: 0 }));
    document.documentElement.style.setProperty("--main", main_color);
  }
}

// SWIPE MOBILE

const mobile_swiper_container = document.querySelectorAll(
  ".mobile_swiper_container"
);
mobile_swiper_container.forEach((swiper_container) => {
  const mobile_swiper_addon = swiper_container.querySelector(
    ".mobile_swiper_addon"
  );
  const mobile_swiper_block_c = swiper_container.querySelector(
    ".mobile_swiper_block_c"
  );

  const mobile_swiper_shadow = swiper_container.querySelector(
    ".mobile_swiper_shadow"
  );
  mobile_swiper_shadow.addEventListener("click", close_mobile_swiper);
  function open_mobile_swiper() {
    setCookie("theme_notify", "true", 365);

    setTimeout(() => {
      document.body.classList.add("no-scroll");
    }, 50);
    swiper_container.classList.add("mobile_swiper_container_show");
  }
  if (!cookieExists("theme_notify")) {
    open_mobile_swiper();
  }
  function close_mobile_swiper() {
    document.body.classList.remove("no-scroll");
    swiper_container.classList.remove("mobile_swiper_container_show");
  }
  let grabbing = false;
  let startY = null;

  mobile_swiper_addon.addEventListener(
    "touchstart",
    function (e) {
      grabbing = true;
      startY = e.touches[0].clientY;
      mobile_swiper_block_c.style.transition = "none";
    },
    { passive: true }
  );

  document.body.addEventListener(
    "touchmove",
    function (e) {
      if (grabbing && startY) {
        let currentY = e.touches[0].clientY;
        let deltaY = (currentY - startY).toFixed(2);
        mobile_swiper_block_c.style.transform = `translateY(${
          deltaY >= 0 ? deltaY : 0
        }px)`;
      }
    },
    { passive: false }
  );

  mobile_swiper_addon.addEventListener(
    "touchend",
    function (e) {
      grabbing = false;
      let numericValue = mobile_swiper_block_c.style.transform
        .replace("translateY(", "")
        .replace("px)", "");

      if (numericValue) {
        let nm = parseFloat(numericValue);

        if (nm > 140) {
          mobile_swiper_block_c.style = ``;
          close_mobile_swiper();
        } else {
          mobile_swiper_block_c.style = ``;
        }
      }
    },
    { passive: false }
  );
});
function cookieExists(name) {
  return document.cookie
    .split("; ")
    .some((cookie) => cookie.startsWith(name + "="));
}
function setCookie(name, value, days) {
  let expires = "";
  if (days) {
    let date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie =
    name + "=" + encodeURIComponent(value) + expires + "; path=/";
}

document.addEventListener("DOMContentLoaded", () => {
  const mg_web_loader = document.querySelector(".mg_web_loader");
  if (mg_web_loader) {
    mg_web_loader.classList.add("mg_web_loader_hidden");
    document.body.classList.remove("no-scroll");
    mg_web_loader.addEventListener("transitionend", () => {
      mg_web_loader.remove();
    });
  }
  startHeartbeat();
  sendSessionStatus("enter"); // Notify server that the user is back
});

// SESSION

function sendSessionStatus(status) {
  const data = new URLSearchParams();
  data.append("status", status);

  navigator.sendBeacon(server_start_local + "user/session.php", data);
}
let heartbeatInterval;

function startHeartbeat() {
  heartbeatInterval = setInterval(() => {
    sendSessionStatus("enter");
  }, 40000); // Send a heartbeat every 30 seconds
}

document.addEventListener("visibilitychange", () => {
  if (document.visibilityState === "hidden") {
    stopHeartbeat(); // User switched tabs, apps, or closed the browser
  } else {
    startHeartbeat(); // User returned to the page
    sendSessionStatus("enter"); // Notify server that the user is back
  }
});

function stopHeartbeat() {
  clearInterval(heartbeatInterval);
  sendSessionStatus("leave");
}
window.addEventListener("beforeunload", stopHeartbeat);
