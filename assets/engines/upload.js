import { types, genres, addons } from "../../ui/themes.js";

const mg_ai_web_loader = document.querySelector(".mg_ai_web_loader");
const name_eng = document.getElementById("name_eng");
const nameInp = document.getElementById("name");
const subtitle = document.getElementById("subtitle");
const year = document.getElementById("year");
const country = document.getElementById("country");
const imdb = document.getElementById("imdb");
const creator = document.getElementById("creator");
const actors = document.getElementById("actors");
const trailer = document.getElementById("trailer");
const description = document.getElementById("description");
const player = document.getElementById("player");

const poster_suggestion = document.querySelector(".poster_suggestion");

function changeValues(answer) {
  if (answer.Genre) {
    let genre_answer = answer.Genre.split(",").map((genre) => genre.trim());
    if (genre_answer) {
      genre_answer.forEach((genre) => {
        selectGenreHand(genre);
      });
    }
  }

  if (answer.Type) {
    let get_type = types.filter((item) => item.title == answer.Type)[0];
    if (get_type) {
      let genre_answer = answer.Genre.split(",").map((genre) => genre.trim());
      if (genre_answer) {
        if (genre_answer.includes("ანიმაცია")) {
          get_type = types.filter((item) => item.title == "ანიმაცია")[0];
        }
      } else {
        get_type = types.filter((item) => item.title == "ანიმაცია")[0];
      }
      typeChangeHand(get_type.id);
    }
  }

  name_eng.value = answer.Title_eng;
  nameInp.value = answer.Title;
  year.value = answer.Year;
  country.value = answer.Country;
  imdb.value = answer.imdbRating;
  creator.value = answer.Director_eng;
  actors.value = answer.Actors_eng;
  description.value = answer.Plot;
  ai_suggestion.innerText = `AI შემოთავაზება: ${answer.Genre}`;
  poster_suggestion.href = answer.Poster;
  poster_suggestion.innerText = "AI შემოთავაზებული პოსტერი";
  poster_suggestion.style.display = "block";

  checkall();
}
function clearValues() {
  window.location.reload();

  movie_type = -1;
  movie_genres = [];
  name_eng.value = "";
  nameInp.value = "";
  year.value = "";
  country.value = "";
  imdb.value = "";
  creator.value = "";
  actors.value = "";
  description.value = "";
  ai_suggestion.innerText = ``;
  image1Upload.value = "";
  image1UploadPreview.src = "";
  image2Upload.value = "";
  image2UploadPreview.src = "";
  checkall();
}
const ai_button = document.querySelector(".ai_button");
const ai_input = document.querySelector("#ai_input");
const ai_input_year = document.querySelector("#ai_input_year");

ai_button.addEventListener("click", sendAIrequest);
async function sendAIrequest() {
  mg_ai_web_loader.classList.remove("mg_ai_web_loader_hidden");
  if (ai_input.value.length > 1) {
    let params = {
      t: ai_input.value,
      y: ai_input_year.value,
      plot: "full",
      i: "tt3896198",
      apikey: "ee640089",
    };
    $.get(
      "http://www.omdbapi.com/",
      params,
      async function (data) {
        mg_ai_web_loader.classList.add("mg_ai_web_loader_hidden");
        let translatedAnswer = await sendAItranslate(JSON.stringify(data));
        changeValues({
          Title_eng: data.Title,
          ...translatedAnswer,
          Actors_eng: data.Actors,
          Director_eng: data.Director,
        });
      },
      "json"
    );
  } else {
    alert("AI - სთვის შეტყობინება ცარიელია");
  }
}

const genres_listing = document.querySelector(".genres_listing");
const addons_listing = document.querySelector(".addons_listing");
const types_listing = document.querySelector(".types_listing");
const addplayer = document.querySelector("#addplayer");
const clear_inps = document.querySelectorAll(".clear_inp");
const playergeo1 = document.getElementById("playergeo1");
const playereng1 = document.getElementById("playereng1");
const inputs = document.querySelectorAll("input, textarea");

playergeo1.addEventListener("input", function () {
  players[1].GEO.HD = playergeo1.value;
});

playereng1.addEventListener("input", function () {
  players[1].ENG.HD = playereng1.value;
});

Array.from(inputs).forEach((item) => {
  if (
    item.getAttribute("id") !== "ai_input" &&
    item.getAttribute("id") !== "ai_input_year"
  ) {
    item.addEventListener("input", () => {
      let delitem = item.closest(".labeled").querySelector(".clear_inp");
      if (item.value.length > 0 && delitem) {
        delitem.style.display = "flex";
      } else if (delitem) {
        delitem.style.display = "hidden";
      }
    });
  }
});

Array.from(clear_inps).forEach((item) => {
  item.addEventListener("click", clearinp);
});

function clearinp() {
  const inputField = this.closest(".labeled").querySelector(".inpc");
  if (inputField) {
    this.style.display = "none";
    inputField.value = "";
  }
}

addplayer.addEventListener("click", addplayerblock);

function addplayerblock() {
  let lastPlayer = parseInt(
    Object.keys(players)[Object.keys(players).length - 1]
  );
  const playersRow = document.querySelector(".players_row"); // Find the player row container
  const newPlayerRow = document.createElement("div"); // Create a new div for the player row
  newPlayerRow.classList.add("labeled");
  let newPlayerID = lastPlayer + 1;
  newPlayerRow.innerHTML = `
    <div class="ps">
      <p>ფლეერი ${newPlayerID}</p>
       <div class="dl" >წაშლა</div>
      <div class="clear_inp">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <path
            fill="currentColor"
            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z"
          />
        </svg>
      </div>
    </div>
    <div class="inputs_upload">
      <input class="inpc" placeholder="GEO" id="playergeo${newPlayerID}" type="text" value="" />
      <input class="inpc" placeholder="ENG" id="playereng${newPlayerID}" type="text" value="" />
    </div>
  `;

  playersRow.appendChild(newPlayerRow);

  const deleteButton = newPlayerRow.querySelector(".dl");
  deleteButton.addEventListener("click", function () {
    removePlayer(deleteButton, newPlayerID);
  });

  players[newPlayerID] = {
    GEO: { HD: "" },
    ENG: { HD: "" },
  };

  const geoInput = newPlayerRow.querySelector(`#playergeo${newPlayerID}`);
  const engInput = newPlayerRow.querySelector(`#playereng${newPlayerID}`);

  geoInput.addEventListener("input", function () {
    players[newPlayerID].GEO.HD = geoInput.value;
  });

  engInput.addEventListener("input", function () {
    players[newPlayerID].ENG.HD = engInput.value;
  });
}
function removePlayer(button, newPlayerID) {
  const playerRow = button.closest(".labeled");

  if (playerRow) {
    playerRow.remove();

    delete players[newPlayerID];
  }
}

function initializeTypes() {
  types.forEach((type) => {
    types_listing.innerHTML += `
<div data-type="${type.id}" style="--buttoncolor:${type.color}" class="type_button" >${type.title}</div>
`;
  });
  const type_button = document.querySelectorAll(".type_button");
  Array.from(type_button).forEach((button) => {
    button.addEventListener("click", () => {
      type_button.forEach((item) => item.classList.remove("type_active"));
      if (button.classList.contains("type_active")) {
        button.classList.remove("type_active");
        movie_type = -1;
        type_check.classList.remove("checked");
      } else {
        button.classList.add("type_active");
        movie_type = button.getAttribute("data-type");
        type_check.classList.add("checked");
      }
    });
  });
}
function typeChangeHand(id) {
  const elements = document.querySelectorAll(`.type_button`);
  elements.forEach((element) => {
    element.classList.remove("type_active");
  });
  const element = document.querySelector(`[data-type="${id}"]`);
  element.classList.add("type_active");
  movie_type = id;
  type_check.classList.add("checked");
}

function initializeGenres() {
  genres.forEach((genre) => {
    genres_listing.innerHTML += `
<div data-genre="${genre.title}" style="--buttoncolor:${genre.color}" class="genre_button" >${genre.title}</div>
`;
  });
  const genre_button = document.querySelectorAll(".genre_button");
  Array.from(genre_button).forEach((button) => {
    button.addEventListener("click", () => {
      let get_genre = button.getAttribute("data-genre");
      if (button.classList.contains("genre_active")) {
        button.classList.remove("genre_active");
        arrayRemove(movie_genres, get_genre);
        genres_check.classList.remove("checked");
      } else {
        button.classList.add("genre_active");
        movie_genres.unshift(get_genre);
        genres_check.classList.add("checked");
      }
    });
  });
}

function initializeAddons() {
  addons.forEach((addon) => {
    addons_listing.innerHTML += `
<div data-addon="${addon.title}" style="--buttoncolor:var(--main)" class="addon_button" >${addon.title}</div>
`;
  });
  const addon_button = document.querySelectorAll(".addon_button");
  Array.from(addon_button).forEach((button) => {
    button.addEventListener("click", () => {
      let get_addon = button.getAttribute("data-addon");
      if (button.classList.contains("addon_active")) {
        button.classList.remove("addon_active");
        arrayRemove(movie_addons, get_addon);
        addons_check.classList.remove("checked");
      } else {
        button.classList.add("addon_active");
        movie_addons.unshift(get_addon);
        addons_check.classList.add("checked");
      }
    });
  });
}
function selectGenreHand(title) {
  if (title == "ანიმაცია") {
    const element4 = document.querySelector(`[data-genre="ანიმაციური"]`);
    element4.classList.add("genre_active");
    if (!movie_genres.includes("ანიმაციური")) {
      movie_genres.unshift("ანიმაციური");
    }
    genres_check.classList.add("checked");
  }
  if (title == "რომანტიკული") {
    const element3 = document.querySelector(`[data-genre="რომანტიკა"]`);
    element3.classList.add("genre_active");
    if (!movie_genres.includes("რომანტიკა")) {
      movie_genres.unshift("რომანტიკა");
    }
    genres_check.classList.add("checked");
  }
  if (title == "მეცნიერული ფანტასტიკა") {
    const element1 = document.querySelector(`[data-genre="სამეცნიერო"]`);
    const element2 = document.querySelector(`[data-genre="ფანტასტიკა"]`);
    element1.classList.add("genre_active");
    element2.classList.add("genre_active");
    if (!movie_genres.includes("სამეცნიერო")) {
      movie_genres.unshift("სამეცნიერო");
    }
    if (!movie_genres.includes("ფანტასტიკა")) {
      movie_genres.unshift("ფანტასტიკა");
    }
    genres_check.classList.add("checked");
  } else {
    const element = document.querySelector(`[data-genre="${title}"]`);
    if (element) {
      element.classList.add("genre_active");
      if (!movie_genres.includes(title)) {
        movie_genres.unshift(title);
      }
      genres_check.classList.add("checked");
    }
  }
}

initializeTypes();
initializeGenres();
initializeAddons();

const type_check = document.getElementById("type_check");
const name_eng_check = document.getElementById("name_eng_check");
const name_check = document.getElementById("name_check");
const subtitle_check = document.getElementById("subtitle_check");
const year_check = document.getElementById("year_check");
const country_check = document.getElementById("country_check");
const imdb_check = document.getElementById("imdb_check");
const creator_check = document.getElementById("creator_check");
const actors_check = document.getElementById("actors_check");
const trailer_check = document.getElementById("trailer_check");
const description_check = document.getElementById("description_check");
const genres_check = document.getElementById("genres_check");
const addons_check = document.getElementById("addons_check");
const image_check = document.getElementById("image_check");
const image2_check = document.getElementById("image2_check");

trailer.oninput = () => {
  if (trailer.value.length > 2) {
    trailer_check.classList.add("checked");
  } else {
    trailer_check.classList.remove("checked");
  }
};
name_eng.oninput = () => {
  if (name_eng.value.length > 2) {
    name_eng_check.classList.add("checked");
  } else {
    name_eng_check.classList.remove("checked");
  }
};
nameInp.oninput = () => {
  if (nameInp.value.length > 2) {
    name_check.classList.add("checked");
  } else {
    name_check.classList.remove("checked");
  }
};
subtitle.oninput = () => {
  if (subtitle.value.length > 2) {
    subtitle_check.classList.add("checked");
  } else {
    subtitle_check.classList.remove("checked");
  }
};
year.oninput = () => {
  if (year.value.length > 2) {
    year_check.classList.add("checked");
  } else {
    year_check.classList.remove("checked");
  }
};
country.oninput = () => {
  if (country.value.length > 2) {
    country_check.classList.add("checked");
  } else {
    country_check.classList.remove("checked");
  }
};
imdb.oninput = () => {
  if (imdb.value.length > 1) {
    imdb_check.classList.add("checked");
  } else {
    imdb_check.classList.remove("checked");
  }
};
creator.oninput = () => {
  if (creator.value.length > 2) {
    creator_check.classList.add("checked");
  } else {
    creator_check.classList.remove("checked");
  }
};
actors.oninput = () => {
  if (actors.value.length > 2) {
    actors_check.classList.add("checked");
  } else {
    actors_check.classList.remove("checked");
  }
};
description.oninput = () => {
  if (description.value.length > 2) {
    description_check.classList.add("checked");
  } else {
    description_check.classList.remove("checked");
  }
};

function arrayRemove(array, item) {
  const index = array.indexOf(item);
  if (index !== -1) {
    array.splice(index, 1);
  }
}

const image1Upload = document.getElementById("image1Upload");
const image1UploadPreview = document.getElementById("image1UploadPreview");

const image2Upload = document.getElementById("image2Upload");
const image2UploadPreview = document.getElementById("image2UploadPreview");
image1Upload.addEventListener("change", function (event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      image1UploadPreview.src = e.target.result;
    };
    reader.readAsDataURL(file);
    image_check.classList.add("checked");
  }
});
image2Upload.addEventListener("change", function (event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      image2UploadPreview.src = e.target.result;
    };
    reader.readAsDataURL(file);
    image2_check.classList.add("checked");
  }
});
function checkall() {
  if (name_eng.value.length > 2) {
    name_eng_check.classList.add("checked");
  } else {
    name_eng_check.classList.remove("checked");
  }
  if (nameInp.value.length > 2) {
    name_check.classList.add("checked");
  } else {
    name_check.classList.remove("checked");
  }
  if (subtitle.value.length > 2) {
    subtitle_check.classList.add("checked");
  } else {
    subtitle_check.classList.remove("checked");
  }
  if (year.value.length > 2) {
    year_check.classList.add("checked");
  } else {
    year_check.classList.remove("checked");
  }
  if (country.value.length > 2) {
    country_check.classList.add("checked");
  } else {
    country_check.classList.remove("checked");
  }
  if (imdb.value.length > 1) {
    imdb_check.classList.add("checked");
  } else {
    imdb_check.classList.remove("checked");
  }
  if (creator.value.length > 2) {
    creator_check.classList.add("checked");
  } else {
    creator_check.classList.remove("checked");
  }
  if (actors.value.length > 2) {
    actors_check.classList.add("checked");
  } else {
    actors_check.classList.remove("checked");
  }
  if (description.value.length > 2) {
    description_check.classList.add("checked");
  } else {
    description_check.classList.remove("checked");
  }
}

async function sendAItranslate(data_send) {
  mg_ai_web_loader.classList.remove("mg_ai_web_loader_hidden");
  if (ai_input.value.length > 1) {
    const API_URL = "https://api.groq.com/openai/v1/chat/completions";
    const API_TOKEN =
      "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";
    const response = await fetch(API_URL, {
      method: "POST",
      headers: {
        Authorization: `Bearer ${API_TOKEN}`,
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        model: "llama-3.3-70b-versatile",
        messages: [
          {
            role: "user",
            content: `translate json values (not keys) to georgian and just return JSON not any text as answer ${data_send}`,
          },
        ],
      }),
    });
    mg_ai_web_loader.classList.add("mg_ai_web_loader_hidden");

    const data = await response.json();
    const answer = JSON.parse(
      data.choices[0].message.content.replace(/```/g, "").replace("json", "")
    );
    console.log(answer);

    return answer;
  } else {
    alert("AI - სთვის შეტყობინება ცარიელია");
  }
}
