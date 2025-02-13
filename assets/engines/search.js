import { types, genres } from "../../ui/themes.js";

let selected_types = [];
let selected_genres = [];
let selected_year = [];
let selected_imdb = [];
let selected_countries = [];

const filter_container = document.querySelector(".filter_container");
const filter_shadow = document.querySelector(".filter_shadow");
const filter_types_row = document.querySelector(".filter_types_row");
const filter_genres_row = document.querySelector(".filter_genres_row");

const filtershowbutton = document.querySelector(".filtershowbutton");
const close_filters = document.querySelector(".close_filters");
filtershowbutton.addEventListener("click", () => {
  filter_container.classList.add("filter_container_show");
});
close_filters.addEventListener("click", () => {
  filter_container.classList.remove("filter_container_show");
});
filter_shadow.addEventListener("click", () => {
  filter_container.classList.remove("filter_container_show");
});
function showFilter(type) {}

function initializeFilters() {
  types.forEach((type) => {
    filter_types_row.innerHTML += `
    <div data-type="${type.id}" style="--buttoncolor:${type.color}" class="type_button" >${type.title}</div>
    `;
  });
  const type_button = document.querySelectorAll(".type_button");
  Array.from(type_button).forEach((button) => {
    button.addEventListener("click", () => {
      if (button.classList.contains("type_active")) {
        button.classList.remove("type_active");
        arrayRemove(selected_types, button.getAttribute("data-type"));
      } else {
        button.classList.add("type_active");
        selected_types.unshift(button.getAttribute("data-type"));
      }
    });
  });

  genres.forEach((genres) => {
    filter_genres_row.innerHTML += `
    <div data-genre="${genres.title}" style="--buttoncolor:${genres.color}" class="genre_button" >${genres.title}</div>
    `;
  });
  const genre_buttons = document.querySelectorAll(".genre_button");
  Array.from(genre_buttons).forEach((button) => {
    button.addEventListener("click", () => {
      if (button.classList.contains("genre_active")) {
        button.classList.remove("genre_active");
        arrayRemove(selected_genres, button.getAttribute("data-genre"));
      } else {
        button.classList.add("genre_active");
        selected_genres.unshift(button.getAttribute("data-genre"));
      }
    });
  });
}
initializeFilters();

function arrayRemove(array, item) {
  const index = array.indexOf(item);
  if (index !== -1) {
    array.splice(index, 1);
  }
}
