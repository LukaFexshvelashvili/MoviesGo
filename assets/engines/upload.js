import { types, genres } from "../../ui/themes";

const mg_ai_web_loader = document.querySelector(".mg_ai_web_loader");
const name_eng = document.getElementById("name_eng");
const nameInp = document.getElementById("name");
const subtitle = document.getElementById("subtitle");
const year = document.getElementById("year");
const country = document.getElementById("country");
const imdb = document.getElementById("imdb");
const creator = document.getElementById("creator");
const actors = document.getElementById("actors");
const description = document.getElementById("description");
const player = document.getElementById("player");

function changeValues(answer) {
  let get_type = types.filter((item) => item.title == answer.type)[0];
  if (get_type) {
    typeChangeHand(get_type.id);
  }
  let genre_answer = answer.genres;

  if (genre_answer) {
    genre_answer.forEach((genre) => {
      selectGenreHand(genre);
    });
  }

  name_eng.value = answer.name_eng;
  nameInp.value = answer.name;
  year.value = answer.year;
  country.value = answer.country;
  imdb.value = answer.imdb;
  creator.value = answer.creator;
  actors.value = answer.actors.join(", ");
  description.value = answer.description;
  ai_suggestion.innerText = `AI შემოთავაზება: ${answer.genres}`;
}

const ai_button = document.querySelector(".ai_button");
const ai_input = document.querySelector("#ai_input");

ai_button.addEventListener("click", sendAIrequest);
async function sendAIrequest() {
  mg_ai_web_loader.classList.remove("mg_ai_web_loader_hidden");
  if (ai_input.value.length > 1) {
    const API_URL = "https://api.groq.com/openai/v1/chat/completions"; // Example: Text summarization model
    const API_TOKEN =
      "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"; // Replace with your Hugging Face API token
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
            content: `give me just json answer only for movie: ${ai_input.value} as {type (return as, "ფილმი", "სერიალი", "ანიმაცია", "ანიმე"), name_eng, name, year, country, imdb, creator, actors, description, genres ( as array)} CAUTION answers should be in georgian language except name_eng`,
          },
        ],
      }),
    });
    mg_ai_web_loader.classList.add("mg_ai_web_loader_hidden");

    const data = await response.json();
    const answer = JSON.parse(
      data.choices[0].message.content.replace(/```/g, "").replace("json", "")
    );
    changeValues(answer);
  } else {
    alert("AI - სთვის შეტყობინება ცარიელია");
  }
}

const genres_listing = document.querySelector(".genres_listing");
const types_listing = document.querySelector(".types_listing");
const addplayer = document.querySelector("#addplayer");
const players_row = document.querySelector(".players_row");
const clear_inps = document.querySelectorAll(".clear_inp");
const inputs = document.querySelectorAll("input, textarea");

Array.from(inputs).forEach((item) => {
  if (item.getAttribute("id") !== "ai_input") {
    item.addEventListener("input", () => {
      let delitem = item.closest(".labeled").querySelector(".clear_inp");
      if (item.value > 0 && delitem) {
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
let players = [1];
function addplayerblock() {
  const newPlayerNumber = players.length ? players[players.length - 1] + 1 : 1;
  players.push(newPlayerNumber);

  const playersRow = document.querySelector(".players_row");

  const labeledDiv = document.createElement("div");
  labeledDiv.classList.add("labeled");

  const psDiv = document.createElement("div");
  psDiv.classList.add("ps");

  const playerName = document.createElement("p");
  playerName.textContent = `ფლეერი ${newPlayerNumber}`;

  const deleteP = document.createElement("p");
  deleteP.classList.add("dl");
  deleteP.setAttribute("data-delete-id", newPlayerNumber);
  deleteP.id = "deleteplayerbox";
  deleteP.textContent = "წაშლა";

  const clearInpDiv = document.createElement("div");
  clearInpDiv.classList.add("clear_inp");

  const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
  svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");
  svg.setAttribute("viewBox", "0 0 512 512");
  const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
  path.setAttribute("fill", "currentColor");
  path.setAttribute(
    "d",
    "m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z"
  );
  svg.appendChild(path);

  clearInpDiv.appendChild(svg);

  psDiv.appendChild(playerName);
  psDiv.appendChild(deleteP);
  psDiv.appendChild(clearInpDiv);

  const inputField = document.createElement("input");
  inputField.setAttribute("name", `player${newPlayerNumber}`);
  inputField.setAttribute("type", "text");

  labeledDiv.appendChild(psDiv);
  labeledDiv.appendChild(inputField);

  playersRow.appendChild(labeledDiv);

  deleteP.addEventListener("click", () => {
    const parent = deleteP.closest(".labeled");
    parent.remove();
    players = players.filter((num) => num !== newPlayerNumber);
  });

  clearInpDiv.addEventListener("click", () => {
    const inputToClear = clearInpDiv.closest(".labeled").querySelector("input");
    inputToClear.value = "";
    clearInpDiv.style.display = "none";
  });
  inputField.addEventListener("input", () => {
    if (inputField.value > 0) {
      inputField.closest(".labeled").querySelector(".clear_inp").style.display =
        "flex";
    } else {
      inputField.closest(".labeled").querySelector(".clear_inp").style.display =
        "none";
    }
  });
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
      get_genre = button.getAttribute("data-genre");
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
function selectGenreHand(title) {
  if (title == "რომანტიკული") {
    const element3 = document.querySelector(`[data-genre="რომანტიკა"]`);
    element3.classList.add("genre_active");
    movie_genres.unshift("რომანტიკა");
    genres_check.classList.add("checked");
  }
  if (title == "მეცნიერული ფანტასტიკა") {
    const element1 = document.querySelector(`[data-genre="სამეცნიერო"]`);
    const element2 = document.querySelector(`[data-genre="ფანტასტიკა"]`);
    element1.classList.add("genre_active");
    element2.classList.add("genre_active");
    movie_genres.unshift("სამეცნიერო");
    movie_genres.unshift("ფანტასტიკა");
    genres_check.classList.add("checked");
  } else {
    const element = document.querySelector(`[data-genre="${title}"]`);
    if (element) {
      element.classList.add("genre_active");
      movie_genres.unshift(title);
      genres_check.classList.add("checked");
    }
  }
}

initializeTypes();
initializeGenres();

const type_check = document.getElementById("type_check");
const name_eng_check = document.getElementById("name_eng_check");
const name_check = document.getElementById("name_check");
const subtitle_check = document.getElementById("subtitle_check");
const year_check = document.getElementById("year_check");
const country_check = document.getElementById("country_check");
const imdb_check = document.getElementById("imdb_check");
const creator_check = document.getElementById("creator_check");
const actors_check = document.getElementById("actors_check");
const description_check = document.getElementById("description_check");
const genres_check = document.getElementById("genres_check");
const player_check = document.getElementById("player_check");
const image_check = document.getElementById("image_check");
const image2_check = document.getElementById("image2_check");
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
player.oninput = () => {
  if (player.value.length > 2) {
    player_check.classList.add("checked");
  } else {
    player_check.classList.remove("checked");
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
  if (player.value.length > 2) {
    player_check.classList.add("checked");
  } else {
    player_check.classList.remove("checked");
  }
}
