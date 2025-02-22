import { types, genres } from "../../ui/themes.js";

function get_results() {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const paramsObject = Object.fromEntries(urlParams.entries());

  $.get(
    server_start_local + "actions/search_results.php",
    paramsObject,
    function (data) {
      let parsedData = JSON.parse(data);

      $(".cardrows").html(parsedData.data);
      $("#search_nums_rows").text(parsedData.length);
      loadCards();
    }
  );
}
get_results();

let selected_types = [];
let selected_genres = [];
let selected_year = [1900, 2025];
let selected_imdb = [0, 10];

const filter_container = document.querySelector(".filter_container");
const filter_shadow = document.querySelector(".filter_shadow");
const filter_types_row = document.querySelector(".filter_types_row");
const filter_genres_row = document.querySelector(".filter_genres_row");
const filter_block_c = document.querySelector(".filter_block_c");
const mobile_addon = document.querySelector(".mobile_addon");
const year_from = document.getElementById("year_from");
const year_to = document.getElementById("year_to");
const imdb_from = document.getElementById("imdb_from");
const imdb_to = document.getElementById("imdb_to");

const clearfiltersbutton = document.getElementById("clearfilters");
const filterit = document.getElementById("filterit");

const filtershowbutton = document.querySelector(".filtershowbutton");
const close_filters = document.querySelector(".close_filters");

filterit.addEventListener("click", filtermovies);

let grabbing = false;
let startY = null;

mobile_addon.addEventListener("touchstart", function (e) {
  grabbing = true;
  startY = e.touches[0].clientY;
  filter_block_c.style.transition = "none";
});

document.body.addEventListener(
  "touchmove",
  function (event) {
    if (grabbing && startY) {
      let currentY = event.touches[0].clientY;
      let deltaY = (currentY - startY).toFixed(2);
      filter_block_c.style.transform = `translateY(${
        deltaY >= 0 ? deltaY : 0
      }px)`;
      event.preventDefault();
    }
  },
  { passive: false }
);

mobile_addon.addEventListener("touchend", function () {
  grabbing = false;
  let numericValue = filter_block_c.style.transform.match(/\d+\.\d+/);
  if (numericValue) {
    let nm = parseFloat(numericValue[0]);

    if (nm > 140) {
      filter_block_c.style = ``;
      close_filters_fun();
    } else {
      filter_block_c.style = ``;
    }
  }
});

function filtermovies() {
  const filteringdata = {
    type: selected_types.length !== 0 ? selected_types : null,
    genres: selected_genres.length !== 0 ? selected_genres : null,
    year_from: selected_year[0] !== 1900 ? selected_year[0] : null,
    year_to: selected_year[1] !== 2025 ? selected_year[1] : null,
    imdb_from: selected_imdb[0] !== 0 ? selected_imdb[0] : null,
    imdb_to: selected_imdb[1] !== 10 ? selected_imdb[1] : null,
  };
  addSearchParam(filteringdata);
  get_results();
}

clearfiltersbutton.addEventListener("click", clearFilters);
filtershowbutton.addEventListener("click", () => {
  document.body.classList.add("no-scroll");
  filter_container.classList.add("filter_container_show");
});
close_filters.addEventListener("click", close_filters_fun);
filter_shadow.addEventListener("click", close_filters_fun);

function close_filters_fun() {
  document.body.classList.remove("no-scroll");
  filter_container.classList.remove("filter_container_show");
}
year_from.addEventListener("input", () => {
  selected_year[0] = year_from.value;
});
year_to.addEventListener("input", () => {
  selected_year[1] = year_to.value;
});
imdb_from.addEventListener("input", () => {
  selected_imdb[0] = imdb_from.value;
});
imdb_to.addEventListener("input", () => {
  selected_imdb[1] = imdb_to.value;
});
function clearFilters() {
  selected_types = [];
  selected_genres = [];
  selected_year = [1900, 2025];
  selected_imdb = [0, 10];
  search_genres_row.value = "";
  year_from.value = selected_year[0];
  year_to.value = selected_year[1];
  imdb_from.value = selected_imdb[0];
  imdb_to.value = selected_imdb[1];

  initializeFilters();
}

function initializeFilters() {
  let genresHTML = genres
    .map(
      (genre) => `
    <div data-genre="${genre.title}" style="--buttoncolor:${genre.color}" class="genre_button">
      ${genre.title}
    </div>`
    )
    .join("");

  filter_genres_row.innerHTML = genresHTML;

  let typesHTML = types
    .map(
      (type) => `
    <div data-type="${type.id}" style="--buttoncolor:${type.color}" class="type_button" >${type.title}</div>`
    )
    .join("");

  filter_types_row.innerHTML = typesHTML;
}
initializeFilters();

filter_types_row.addEventListener("click", (event) => {
  if (event.target.classList.contains("type_button")) {
    const type = event.target.getAttribute("data-type");

    if (selected_types.includes(type)) {
      event.target.classList.remove("type_active");
      arrayRemove(selected_types, type);
    } else {
      selected_types.unshift(type);
      event.target.classList.add("type_active");
    }
  }
});

const search_genres_row = document.querySelector(".search_genres_row");

search_genres_row.addEventListener("input", () => {
  let searchValue = search_genres_row.value.toLowerCase();
  let filteredGenres = genres.filter((item) =>
    item.title.toLowerCase().includes(searchValue)
  );

  let genresHTML = filteredGenres
    .map(
      (genre) => `
      <div data-genre="${genre.title}" style="--buttoncolor:${
        genre.color
      }" class="genre_button${
        selected_genres.includes(genre.title) ? " genre_active" : ""
      }">
        ${genre.title}
      </div>`
    )
    .join("");

  filter_genres_row.innerHTML = genresHTML;
});

filter_genres_row.addEventListener("click", (event) => {
  if (event.target.classList.contains("genre_button")) {
    const genre = event.target.getAttribute("data-genre");

    if (selected_genres.includes(genre)) {
      event.target.classList.remove("genre_active");
      arrayRemove(selected_genres, genre);
    } else {
      selected_genres.unshift(genre);
      event.target.classList.add("genre_active");
    }
  }
});

function arrayRemove(array, item) {
  const index = array.indexOf(item);
  if (index !== -1) {
    array.splice(index, 1);
  }
}

function addSearchParam(object) {
  const url = new URL(window.location);

  Object.entries(object).forEach(([key, value]) => {
    if (value !== null) {
      url.searchParams.set(key, value);
    } else {
      url.searchParams.delete(key);
    }
  });

  window.history.pushState({}, "", url);
}
