<?php
include_once "../server/connection.php";
if ($_GET["id"]) {
    $stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
    $stmt->bind_param("i", $_GET["id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $movie = $result->fetch_assoc();
    $players = json_decode($movie["players"], true);

    $is_movie = !isset($players[1][1]) && !isset($players[2][1]) && !isset($players[3][1]);

    if(!$is_movie){
        header("Location: ./updateseries?id=". $movie["id"]);
    }
} else {
header("Location: /pages/");
exit;
}
?>


<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>update</title>

    <link rel="stylesheet" href="../assets/css/components/colors.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/pages/uploadmovie/uploadmovie.css" />
    <link rel="stylesheet" href="../assets/css/components/nav.css" />
    <meta name="robots" content="noindex" />
</head>

<body>
    <div class="mg_ai_web_loader mg_ai_web_loader_hidden">
        <div class="popcorn_container">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24">
                <path fill="var(--main)"
                    d="M7 22H4.75s-.75 0-.94-1.35L2.04 3.81L2 3.5C2 2.67 2.9 2 4 2s2 .67 2 1.5C6 2.67 6.9 2 8 2s2 .67 2 1.5c0-.83.9-1.5 2-1.5c1.09 0 2 .66 2 1.5c0-.83.9-1.5 2-1.5s2 .67 2 1.5c0-.83.9-1.5 2-1.5s2 .67 2 1.5l-.04.31l-1.77 16.84C20 22 19.25 22 19.25 22H7M17.85 4.93C17.55 4.39 16.84 4 16 4c-.81 0-1.64.36-2 .87L13.78 20h2.88l1.19-15.07M10 4.87C9.64 4.36 8.81 4 8 4c-.84 0-1.55.39-1.85.93L7.34 20h2.88L10 4.87Z" />
            </svg>
        </div>
    </div>
    <?php include_once "../components/nav.php" ?>
    <div class="container upload_section">
        <h1>ფილმის განახლება | <?php echo $movie['name_eng']." - ".$movie['name'] ?></h1>

        <div class="ai_help">
            <input type="text" id="ai_input" placeholder="ფილმის სახელი ინგლისურად" />
            <input type="text" id="ai_input_year" placeholder="ფილმის წელი" />
            <button class="ai_button">გენერირება</button>
            <a href="" target="_blank" class="poster_suggestion"></a>
        </div>
        <form class="upload_form" enctype="multipart/form-data">
            <input class="inpc" type="hidden" id="movie_id" name="movie_id" value="<?php echo $movie['id'] ?>" />
            <div class="labeled">
                <p>ტიპი</p>
                <div class="types_listing"></div>
            </div>
            <div class="labeled">
                <p>სახელი ინგლისურად</p>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <input class="inpc" type="text" id="name_eng" name="name_eng"
                    value="<?php echo $movie['name_eng'] ?>" />
            </div>
            <div class="labeled">
                <p>სახელი</p>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <input class="inpc" type="text" id="name" name="name" value="<?php echo $movie['name'] ?>" />
            </div>
            <div class="labeled">
                <div class="ps">
                    <p>subtitle</p>
                    <p class="nr">არასავალდებულო</p>
                </div>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <input class="inpc" type="text" id="subtitle" name="subtitle"
                    value="<?php echo $movie['subtitle'] ?>" />
            </div>
            <div class="labeled">
                <p>წელი</p>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <input class="inpc" type="text" id="year" name="year" value="<?php echo $movie['year'] ?>" />
            </div>
            <div class="labeled">
                <p>ქვეყანა</p>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <input class="inpc" type="text" id="country" name="country" value="<?php echo $movie['country'] ?>" />
            </div>
            <div class="labeled">
                <p>IMDb</p>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <input class="inpc" type="text" id="imdb" name="imdb" value="<?php echo $movie['imdb'] ?>" />
            </div>
            <div class="labeled">
                <p>რეჟისორი</p>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <input class="inpc" type="text" id="creator" name="creator" value="<?php echo $movie['creator'] ?>" />
            </div>
            <div class="labeled">
                <div class="ps">
                    <p>როლებში</p>
                    <p class="nr">არასავალდებულო</p>
                </div>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <input class="inpc" type="text" id="actors" name="actors" value="<?php echo $movie['actors'] ?>" />
            </div>
            <div class="labeled">
                <div class="ps">
                    <p>თრეილერი</p>
                    <p class="nr">არასავალდებულო</p>
                </div>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <input class="inpc" type="text" id="trailer" name="trailer" value="<?php echo $movie['trailer'] ?>" />
            </div>
            <div class="labeled">
                <p>მოკლე სიუჟეტი</p>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <textarea class="inpc" id="description"
                    name="description"><?php echo $movie['description'] ?></textarea>
            </div>
            <div class="labeled">
                <p>ჟანრები</p>
                <p id="ai_suggestion"></p>
                <div class="genres_listing"></div>
            </div>
            <div class="labeled">
                <p>დამატებები</p>
                <div class="addons_listing"></div>
            </div>
            <div class="players">
                <div class="players_row">
                    <div class="labeled">
                        <div class="ps">
                            <p>ფლეერი 1</p>
                        </div>
                        <div class="inputs_upload">
                            <input class="inpc" placeholder="GEO" id="playergeo1" type="text" />
                            <input class="inpc" placeholder="ENG" id="playereng1" type="text" />
                        </div>
                    </div>
                </div>
                <button id="addplayer" type="button" class="dbt">დამატება</button>
            </div>
            <div class="labeled">
                <p>ფოტო გრძელი (POSTER)</p>
                <div class="custom_file cnt">
                    <input name="poster" type="file" class="fileInput" id="image1Upload"
                        accept="image/jpeg, image/jpg, image/png, image/webp" />
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 384 384">
                        <path fill="var(--triplecolor)"
                            d="M384 341q0 18-12.5 30.5T341 384H43q-18 0-30.5-12.5T0 341V43q0-18 12.5-30.5T43 0h298q18 0 30.5 12.5T384 43v298zM117 224l-74 96h298l-96-128l-74 96z" />
                    </svg>
                </div>
                <div class="pictureshow">
                    <img id="image1UploadPreview" class="imagePreviewer"
                        src="<?php echo $image_starter.$movie['poster_url'] ?>" />
                </div>
            </div>
            <div class="labeled">
                <p>ფოტო მსხვილი (THUMBNAIL)</p>
                <div class="custom_file cnt">
                    <input name="thumbnail" type="file" class="fileInput" id="image2Upload"
                        accept="image/jpeg, image/jpg, image/png, image/webp" />
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 384 384">
                        <path fill="var(--triplecolor)"
                            d="M384 341q0 18-12.5 30.5T341 384H43q-18 0-30.5-12.5T0 341V43q0-18 12.5-30.5T43 0h298q18 0 30.5 12.5T384 43v298zM117 224l-74 96h298l-96-128l-74 96z" />
                    </svg>
                </div>
                <div class="pictureshow">
                    <img id="image2UploadPreview" class="imagePreviewer"
                        src="<?php echo $image_starter.$movie['thumbnail_url'] ?>" />
                </div>
            </div>
            <div class="checkings">
                <p class="optional" id="type_check">ტიპი</p>
                <p class="optional" id="name_eng_check">სახელი ინგლისურად</p>
                <p class="optional" id="name_check">სახელი</p>
                <p class="optional" id="subtitle_check">subtitle</p>
                <p class="optional" id="year_check">წელი</p>
                <p class="optional" id="country_check">ქვეყანა</p>
                <p class="optional" id="imdb_check">imdb</p>
                <p class="optional" id="creator_check">რეჟისორი</p>
                <p class="optional" id="actors_check">როლებში</p>
                <p class="optional" id="trailer_check">თრეილერი</p>
                <p class="optional" id="description_check">მოკლე სიუჟეტი</p>
                <p class="optional" id="genres_check">ჟანრები</p>
                <p class="optional" id="addons_check">დამატებები</p>
                <p class="optional" id="image_check">ფოტო 1</p>
                <p class="optional" id="image2_check">ფოტო 2</p>
            </div>
            <button class="dbt">განახლება</button>
        </form>
    </div>

    <?php include_once "../components/endpage.php" ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
    let players = <?php echo $movie['players'] ?>;
    let movie_type = <?php echo $movie['type'] ?>;
    let movie_genres = <?php echo $movie['genres'] ?>;
    let movie_addons = <?php echo $movie['addons'] ?>;

    // changing in upload.js
    </script>
    <script type="module" src="../ui/mg_engine.js"></script>
    <script src="../assets/engines/nav.js"></script>
    <script type="module" src="../assets/engines/upload.js"></script>
    <script src="../assets/engines/mg_cardslider.js"></script>
    <script>
    setTimeout(() => {
        const elementtype = document.querySelector(`[data-type="${movie_type}"]`);
        elementtype.classList.add("type_active");
        movie_genres.forEach((genre) => {
            selectGenreHand(genre);
        });
        movie_addons.forEach((addon) => {
            selectAddonHand(addon);
        });

        function selectAddonHand(title) {

            const element = document.querySelector(`[data-addon="${title}"]`);

            if (element) {
                element.classList.add("addon_active");
            }
        }

        function selectGenreHand(title) {

            const element = document.querySelector(`[data-genre="${title}"]`);

            if (element) {
                element.classList.add("genre_active");
            }
        }
    }, 1000);

    Object.keys(players).forEach((id) => {
        if (id != 1) {
            addplayerblock(players[id], id);
        } else {
            const geoInput = document.querySelector(`#playergeo1`);
            const engInput = document.querySelector(`#playereng1`);
            geoInput.value = players[id].GEO.HD
            engInput.value = players[id].ENG.HD
        }
    });

    function addplayerblock(data, id) {
        const playersRow = document.querySelector(".players_row"); // Find the player row container
        const newPlayerRow = document.createElement("div"); // Create a new div for the player row
        newPlayerRow.classList.add("labeled");
        let newPlayerID = id;
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
      <input class="inpc" placeholder="GEO" id="playergeo${newPlayerID}" type="text" value="${data.GEO.HD ? data.GEO.HD : ""}" />
      <input class="inpc" placeholder="ENG" id="playereng${newPlayerID}" type="text" value="${data.ENG.HD ? data.ENG.HD : ""}" />
    </div>
  `;

        playersRow.appendChild(newPlayerRow);

        const deleteButton = newPlayerRow.querySelector(".dl");
        deleteButton.addEventListener("click", function() {
            removePlayer(deleteButton, newPlayerID);
        });

        players[newPlayerID] = {
            GEO: {
                HD: data.GEO.HD ? data.GEO.HD : ""
            },
            ENG: {
                HD: data.ENG.HD ? data.ENG.HD : ""
            },
        };

        const geoInput = newPlayerRow.querySelector(`#playergeo${newPlayerID}`);
        const engInput = newPlayerRow.querySelector(`#playereng${newPlayerID}`);

        geoInput.addEventListener("input", function() {
            players[newPlayerID].GEO.HD = geoInput.value;
        });

        engInput.addEventListener("input", function() {
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
    </script>
    <script>
    const mg_ai_web_loader = document.querySelector(".mg_ai_web_loader");

    function verifyCheckings() {
        return true;
    }

    const upload_form = document.querySelector(".upload_form");
    upload_form.addEventListener("submit", (e) => {

        e.preventDefault();

        const formData = new FormData(upload_form);

        movie_genres.forEach((genre) => {
            formData.append("genres[]", genre);
        });
        formData.append("type", movie_type);
        formData.append("players", JSON.stringify(players));
        formData.append("addons", JSON.stringify(movie_addons));
        if (verifyCheckings()) {
            mg_ai_web_loader.classList.remove("mg_ai_web_loader_hidden");

            $.ajax({
                url: server_start + "movie_update.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    mg_ai_web_loader.classList.add("mg_ai_web_loader_hidden");
                    let data = JSON.parse(response);
                    if (data.status == 100) {
                        alert("წარმატებით განახლდა");
                        window.location = "./watch?id=" + data.movie;
                    } else {
                        alert(JSON.stringify(data));

                    }
                },
            });
        }
    });
    </script>
</body>

</html>