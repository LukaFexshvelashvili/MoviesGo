const navbar = document.querySelector(".navbar");
let navbar_scroll_change = 200;
navbar.classList.add("navbar_home");
function ChangeNavbar() {
  if (
    !navbar.classList.contains("navbar_scrolled") &&
    window.scrollY > navbar_scroll_change
  ) {
    navbar.classList.add("navbar_scrolled");
  } else if (
    navbar.classList.contains("navbar_scrolled") &&
    window.scrollY < navbar_scroll_change
  ) {
    navbar.classList.remove("navbar_scrolled");
  }
}

ChangeNavbar();
window.addEventListener("scroll", () => {
  ChangeNavbar();
});
