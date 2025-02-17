const nav = document.querySelector(".navbar");

const nav_mb_menu_opener = document.querySelector(".nav_mb_menu_opener");
const mobile_nav_shadow = document.querySelector(".mobile_nav_shadow");
const mobile_nav = document.querySelector(".mobile_nav");
const nav_mb_menu_open_svg = document.querySelector("#nav_mb_menu_open_svg");
const nav_mb_menu_close_svg = document.querySelector("#nav_mb_menu_close_svg");
const navprofilebutton = document.querySelector(".navprofilebutton");
const navinput = document.querySelector(".navinput");
const navsearch = document.querySelector(".navsearch");
const navinputblock = document.querySelector(".navinputblock");
const nav_mb_search_opener = document.querySelector(".nav_mb_search_opener");
const nav_mb_search_close = document.querySelector(".nav_mb_search_close");
const navsearchshadow = document.querySelector(".navsearchshadow");

const navprofileblock = document.querySelector(".navprofileblock");
const navprofileblockactions = document.querySelectorAll(
  ".navprofileblockactions, .mob_nav_actions_row"
);

nav_mb_search_opener.addEventListener("click", function () {
  navinputblock.classList.add("navinputblockshow");
});
nav_mb_search_close.addEventListener("click", closemobilesearch);
navsearchshadow.addEventListener("click", closemobilesearch);
function closemobilesearch() {
  navinputblock.classList.remove("navinputblockshow");
  navsearch.classList.remove("navsearchshow");
}
mobile_nav_shadow.addEventListener("click", function () {
  mobile_nav.classList.remove("mobile_nav_show");
  nav_mb_menu_open_svg.classList.add("getshow");
  nav_mb_menu_close_svg.classList.remove("getshow");
});

nav_mb_menu_opener.addEventListener("click", function () {
  if (mobile_nav.classList.contains("mobile_nav_show")) {
    mobile_nav.classList.remove("mobile_nav_show");
    nav_mb_menu_open_svg.classList.add("getshow");
    nav_mb_menu_close_svg.classList.remove("getshow");
  } else {
    mobile_nav.classList.add("mobile_nav_show");
    nav_mb_menu_open_svg.classList.remove("getshow");
    nav_mb_menu_close_svg.classList.add("getshow");
  }
});

let debounceTimeout;

navinput.addEventListener("input", () => {
  clearTimeout(debounceTimeout);
  if (navinput.value.length >= 1) {
    navsearch.innerHTML = '<p class="no_results">იძებნება...</p>';
  }
  debounceTimeout = setTimeout(() => {
    if (navinput.value.length >= 1) {
      $.get(
        server_start_local + "/actions/quick_search.php",
        { title: navinput.value },
        function (data) {
          navsearch.innerHTML = data;
        }
      );
    } else {
      navsearch.innerHTML = '<p class="no_results">ძიება</p>';
    }
  }, 300);
});

navinput.addEventListener("click", () => {
  navsearch.classList.add("navsearchshow");
});

document.addEventListener("click", (event) => {
  if (!navinputblock.contains(event.target)) {
    navsearch.classList.remove("navsearchshow");
  }
});

function initializeNavBlock() {
  navprofileblockactions.forEach((lister) => {
    profileactions.forEach((action) => {
      lister.innerHTML += `<a href="${action.link}" class="navblockaction">${action.icon} ${action.title}</a>`;
    });
  });
}

navprofilebutton.addEventListener("click", toggleProfileBlock);

function toggleProfileBlock() {
  if (navprofileblock.classList.contains("navprofileblockshow")) {
    navprofileblock.classList.remove("navprofileblockshow");
  } else {
    navprofileblock.classList.add("navprofileblockshow");
    document.addEventListener("click", removeProfileBlock);
  }
}
function removeProfileBlock(e) {
  if (
    !e.target.closest(".navprofileblock") &&
    !e.target.closest(".navprofilebutton")
  ) {
    navprofileblock.classList.remove("navprofileblockshow");
  }
}

const profileactions = [
  {
    link: session_id !== null ? "profile?id=" + session_id : "login",
    title: "პროფილი",
    icon: `
<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4 14V12.6667C4 11.9594 4.28095 11.2811 4.78105 10.781C5.28115 10.281 5.95942 10 6.66667 10H9.33333C10.0406 10 10.7189 10.281 11.219 10.781C11.719 11.2811 12 11.9594 12 12.6667V14M5.33333 4.66667C5.33333 5.37391 5.61428 6.05219 6.11438 6.55229C6.61448 7.05238 7.29276 7.33333 8 7.33333C8.70724 7.33333 9.38552 7.05238 9.88562 6.55229C10.3857 6.05219 10.6667 5.37391 10.6667 4.66667C10.6667 3.95942 10.3857 3.28115 9.88562 2.78105C9.38552 2.28095 8.70724 2 8 2C7.29276 2 6.61448 2.28095 6.11438 2.78105C5.61428 3.28115 5.33333 3.95942 5.33333 4.66667Z" stroke="var(--icon)"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
`,
  },
  {
    link: session_id !== null ? "profile?id=" + session_id : "login",
    title: "მოწონებულები",
    icon: `
<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M2.05747 3.14347C2.76867 2.36227 3.78413 1.93294 4.976 1.93294C6.0624 1.93294 7.22253 2.44627 8 3.45054C8.7728 2.4472 9.92827 1.93294 11.024 1.93294C12.2131 1.93294 13.2267 2.3604 13.9397 3.13974C14.6453 3.91254 15 4.97094 15 6.14507C15 8.16667 13.9612 9.79347 12.6461 11.0581C11.3348 12.32 9.68747 13.2823 8.322 13.9888C8.22199 14.0405 8.11097 14.0674 7.99837 14.0671C7.88577 14.0667 7.77491 14.0392 7.6752 13.9869C6.30973 13.2729 4.6624 12.3181 3.35107 11.0628C2.036 9.80187 1 8.18067 1 6.146C1 4.97467 1.3528 3.91627 2.05747 3.14347ZM3.09253 4.08614C2.66787 4.5528 2.4 5.25 2.4 6.146C2.4 7.66174 3.1616 8.94227 4.31987 10.0511C5.38947 11.0759 6.74653 11.9037 8.00187 12.5757C9.24787 11.9131 10.6059 11.0787 11.6764 10.0492C12.8365 8.932 13.6 7.64587 13.6 6.146C13.6 5.2472 13.3312 4.55 12.9056 4.08334C12.4875 3.62694 11.864 3.33387 11.024 3.33387C10.1131 3.33387 9.07053 3.92 8.66547 5.15387C8.61966 5.29426 8.53062 5.41657 8.41109 5.50329C8.29157 5.59002 8.14767 5.63672 8 5.63672C7.85233 5.63672 7.70843 5.59002 7.58891 5.50329C7.46938 5.41657 7.38034 5.29426 7.33453 5.15387C6.9304 3.92187 5.87667 3.33387 4.976 3.33387C4.1332 3.33387 3.51067 3.62694 3.09253 4.08614Z" fill="var(--icon)" />
</svg>
`,
  },
  {
    link: "bookmarked",
    title: "ჩანიშნული ფილმები",
    icon: `
<svg
  xmlns="http://www.w3.org/2000/svg"
  viewBox="0 0 24 24"
>
  <path
    fill="none"
    stroke="var(--icon)"
    stroke-linecap="round"
    stroke-linejoin="round"
    stroke-width="2"
    d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z"
  />
</svg>
`,
  },
  {
    link: "history",
    title: "ბოლოს ნანახი",
    icon: `
<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M7.99968 1.33333C6.2906 1.3382 4.64867 1.99927 3.41301 3.18V1.99999C3.41301 1.82318 3.34277 1.65361 3.21775 1.52859C3.09272 1.40357 2.92315 1.33333 2.74634 1.33333C2.56953 1.33333 2.39996 1.40357 2.27494 1.52859C2.14991 1.65361 2.07967 1.82318 2.07967 1.99999V5C2.07967 5.17681 2.14991 5.34638 2.27494 5.4714C2.39996 5.59642 2.56953 5.66666 2.74634 5.66666H5.74634C5.92315 5.66666 6.09272 5.59642 6.21775 5.4714C6.34277 5.34638 6.41301 5.17681 6.41301 5C6.41301 4.82318 6.34277 4.65362 6.21775 4.52859C6.09272 4.40357 5.92315 4.33333 5.74634 4.33333H4.14634C5.00353 3.43757 6.14601 2.86843 7.37736 2.72377C8.60872 2.57912 9.852 2.86798 10.8934 3.54069C11.9349 4.2134 12.7094 5.22794 13.0839 6.40986C13.4584 7.59177 13.4093 8.86723 12.9453 10.0169C12.4812 11.1666 11.6311 12.1187 10.5411 12.7095C9.45111 13.3003 8.18933 13.4929 6.97271 13.2542C5.75609 13.0155 4.66065 12.3604 3.87474 11.4015C3.08882 10.4426 2.66153 9.23981 2.66634 8C2.66634 7.82318 2.5961 7.65362 2.47108 7.52859C2.34605 7.40357 2.17649 7.33333 1.99967 7.33333C1.82286 7.33333 1.65329 7.40357 1.52827 7.52859C1.40325 7.65362 1.33301 7.82318 1.33301 8C1.33301 9.31854 1.724 10.6075 2.45654 11.7038C3.18909 12.8001 4.23028 13.6546 5.44845 14.1592C6.66663 14.6638 8.00707 14.7958 9.30028 14.5386C10.5935 14.2813 11.7814 13.6464 12.7137 12.714C13.6461 11.7817 14.281 10.5938 14.5382 9.3006C14.7955 8.00739 14.6635 6.66695 14.1589 5.44877C13.6543 4.2306 12.7998 3.18941 11.7035 2.45686C10.6071 1.72432 9.31822 1.33333 7.99968 1.33333ZM7.99968 5.33333C7.82286 5.33333 7.6533 5.40357 7.52827 5.52859C7.40325 5.65362 7.33301 5.82318 7.33301 6V8C7.33301 8.17681 7.40325 8.34638 7.52827 8.4714C7.6533 8.59642 7.82286 8.66666 7.99968 8.66666H9.33301C9.50982 8.66666 9.67939 8.59642 9.80441 8.4714C9.92944 8.34638 9.99968 8.17681 9.99968 8C9.99968 7.82318 9.92944 7.65362 9.80441 7.52859C9.67939 7.40357 9.50982 7.33333 9.33301 7.33333H8.66634V6C8.66634 5.82318 8.5961 5.65362 8.47108 5.52859C8.34606 5.40357 8.17649 5.33333 7.99968 5.33333Z" fill="var(--icon)" />
</svg>
`,
  },
  {
    link: "settings",
    title: "პარამეტრები",
    icon: `
<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.3327 8.00001C10.3327 8.30642 10.2723 8.60984 10.1551 8.89293C10.0378 9.17603 9.86593 9.43325 9.64926 9.64992C9.43259 9.86659 9.17537 10.0385 8.89228 10.1557C8.60918 10.273 8.30577 10.3333 7.99935 10.3333C7.69293 10.3333 7.38951 10.273 7.10642 10.1557C6.82333 10.0385 6.5661 9.86659 6.34943 9.64992C6.13276 9.43325 5.96089 9.17603 5.84363 8.89293C5.72637 8.60984 5.66602 8.30642 5.66602 8.00001C5.66602 7.38117 5.91185 6.78767 6.34943 6.35009C6.78702 5.9125 7.38051 5.66667 7.99935 5.66667C8.61819 5.66667 9.21168 5.9125 9.64926 6.35009C10.0868 6.78767 10.3327 7.38117 10.3327 8.00001Z" stroke="var(--icon)"  stroke-linecap="round" stroke-linejoin="round"/>
<path d="M14.007 9.398C14.355 9.304 14.529 9.25667 14.5977 9.16734C14.6663 9.07734 14.6663 8.93334 14.6663 8.64467V7.35534C14.6663 7.06667 14.6663 6.922 14.5977 6.83267C14.529 6.74334 14.355 6.696 14.007 6.60267C12.707 6.252 11.893 4.89267 12.2283 3.60067C12.321 3.24534 12.367 3.06734 12.323 2.96334C12.279 2.85934 12.1523 2.78734 11.8997 2.644L10.7497 1.99067C10.5017 1.85067 10.3777 1.78 10.2663 1.79467C10.155 1.80934 10.029 1.93467 9.77767 2.186C8.80501 3.156 7.19567 3.156 6.22234 2.186C5.97101 1.93534 5.84567 1.81 5.73434 1.79467C5.62301 1.78 5.49901 1.85 5.25101 1.99134L4.10101 2.644C3.84767 2.78734 3.72101 2.85934 3.67767 2.964C3.63367 3.06734 3.67967 3.24534 3.77167 3.60067C4.10701 4.89267 3.29301 6.252 1.99234 6.60267C1.64434 6.696 1.47034 6.74267 1.40167 6.83267C1.33301 6.92267 1.33301 7.06667 1.33301 7.35534V8.64467C1.33301 8.93334 1.33301 9.078 1.40167 9.16734C1.47034 9.25667 1.64434 9.304 1.99234 9.398C3.29234 9.74867 4.10634 11.108 3.77101 12.3993C3.67834 12.7547 3.63234 12.9327 3.67634 13.0367C3.72034 13.1407 3.84701 13.2127 4.09967 13.3567L5.24967 14.0087C5.49767 14.15 5.62167 14.22 5.73301 14.2053C5.84434 14.1907 5.97034 14.0653 6.22167 13.814C7.19501 12.8427 8.80567 12.8427 9.77901 13.814C10.0303 14.0647 10.1557 14.19 10.267 14.2053C10.3783 14.22 10.5023 14.15 10.751 14.0087L11.9003 13.356C12.1537 13.2127 12.2803 13.1407 12.3237 13.036C12.367 12.9313 12.3217 12.7547 12.2297 12.3993C11.8937 11.108 12.707 9.74867 14.007 9.398Z" stroke="var(--icon)"  stroke-linecap="round" stroke-linejoin="round"/>
</svg>
`,
  },
  {
    link: "settings",
    title: "ინტერფეისი",
    icon: `
    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path fill="none" stroke="var(--icon)" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.5 12c0-4.478 0-6.718 1.391-8.109S7.521 2.5 12 2.5c4.478 0 6.718 0 8.109 1.391S21.5 7.521 21.5 12c0 4.478 0 6.718-1.391 8.109S16.479 21.5 12 21.5c-4.478 0-6.718 0-8.109-1.391S2.5 16.479 2.5 12m0-3h19M13 13h4m-4 4h2M7 6h.009M11 6h.009M9 9v12.5" color="currentColor"/></svg>
`,
  },
  {
    link: "help",
    title: "დახმარება",
    icon: `
<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8 15C4.14 15 1 11.86 1 8C1 4.14 4.14 1 8 1C11.86 1 15 4.14 15 8C15 11.86 11.86 15 8 15ZM8 2C4.69 2 2 4.69 2 8C2 11.31 4.69 14 8 14C11.31 14 14 11.31 14 8C14 4.69 11.31 2 8 2Z" fill="var(--icon)" />
<path d="M8 4.5C6.89 4.5 6 5.39 6 6.5H7C7 5.95 7.45 5.5 8 5.5C8.55 5.5 9 5.95 9 6.5C9 7.5 7.5 7.38 7.5 9H8.5C8.5 7.88 10 7.75 10 6.5C10 5.39 9.11 4.5 8 4.5Z" fill="var(--icon)" />
<path d="M7.99988 11.62C8.3423 11.62 8.61988 11.3424 8.61988 11C8.61988 10.6576 8.3423 10.38 7.99988 10.38C7.65747 10.38 7.37988 10.6576 7.37988 11C7.37988 11.3424 7.65747 11.62 7.99988 11.62Z" fill="var(--icon)" />
<path d="M6.5 7C6.77614 7 7 6.77614 7 6.5C7 6.22386 6.77614 6 6.5 6C6.22386 6 6 6.22386 6 6.5C6 6.77614 6.22386 7 6.5 7Z" fill="var(--icon)" />
<path d="M8 9.5C8.27614 9.5 8.5 9.27614 8.5 9C8.5 8.72386 8.27614 8.5 8 8.5C7.72386 8.5 7.5 8.72386 7.5 9C7.5 9.27614 7.72386 9.5 8 9.5Z" fill="var(--icon)" />
</svg>
`,
  },
];
initializeNavBlock();
