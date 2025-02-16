<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>upload</title>

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
        <h1>ფილმის ატვირთვა</h1>

        <div class="ai_help">
            <input type="text" id="ai_input" placeholder="ფილმის სახელი ინგლისურად" />
            <input type="text" id="ai_input_year" placeholder="ფილმის წელი" />
            <button class="ai_button">გენერირება</button>
            <a href="" target="_blank" class="poster_suggestion"></a>
        </div>
        <form class="upload_form" enctype="multipart/form-data">
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
                <input class="inpc" type="text" id="name_eng" name="name_eng" />
            </div>
            <div class="labeled">
                <p>სახელი</p>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <input class="inpc" type="text" id="name" name="name" />
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
                <input class="inpc" type="text" id="subtitle" name="subtitle" />
            </div>
            <div class="labeled">
                <p>წელი</p>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <input class="inpc" type="text" id="year" name="year" />
            </div>
            <div class="labeled">
                <p>ქვეყანა</p>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <input class="inpc" type="text" id="country" name="country" />
            </div>
            <div class="labeled">
                <p>IMDb</p>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <input class="inpc" type="text" id="imdb" name="imdb" />
            </div>
            <div class="labeled">
                <p>რეჟისორი</p>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <input class="inpc" type="text" id="creator" name="creator" />
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
                <input class="inpc" type="text" id="actors" name="actors" />
            </div>
            <div class="labeled">
                <p>მოკლე სიუჟეტი</p>
                <div class="clear_inp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="m289.94 256l95-95A24 24 0 0 0 351 127l-95 95l-95-95a24 24 0 0 0-34 34l95 95l-95 95a24 24 0 1 0 34 34l95-95l95 95a24 24 0 0 0 34-34Z" />
                    </svg>
                </div>
                <textarea class="inpc" id="description" name="description"></textarea>
            </div>
            <div class="labeled">
                <p>ჟანრები</p>
                <p id="ai_suggestion"></p>
                <div class="genres_listing"></div>
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
                    <input name="poster" type="file" class="fileInput" id="image1Upload" accept="image/*" />

                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 384 384">
                        <path fill="var(--triplecolor)"
                            d="M384 341q0 18-12.5 30.5T341 384H43q-18 0-30.5-12.5T0 341V43q0-18 12.5-30.5T43 0h298q18 0 30.5 12.5T384 43v298zM117 224l-74 96h298l-96-128l-74 96z" />
                    </svg>
                </div>
                <div class="pictureshow">
                    <img id="image1UploadPreview" class="imagePreviewer" />
                </div>
            </div>
            <div class="labeled">
                <p>ფოტო მსხვილი (THUMBNAIL)</p>
                <div class="custom_file cnt">
                    <input name="thumbnail" type="file" class="fileInput" id="image2Upload" accept="image/*" />

                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 384 384">
                        <path fill="var(--triplecolor)"
                            d="M384 341q0 18-12.5 30.5T341 384H43q-18 0-30.5-12.5T0 341V43q0-18 12.5-30.5T43 0h298q18 0 30.5 12.5T384 43v298zM117 224l-74 96h298l-96-128l-74 96z" />
                    </svg>
                </div>
                <div class="pictureshow">
                    <img id="image2UploadPreview" class="imagePreviewer" />
                </div>
            </div>
            <div class="checkings">
                <p id="type_check">ტიპი</p>
                <p id="name_eng_check">სახელი ინგლისურად</p>
                <p id="name_check">სახელი</p>
                <p id="subtitle_check" class="optional">subtitle</p>
                <p id="year_check">წელი</p>
                <p id="country_check">ქვეყანა</p>
                <p id="imdb_check">imdb</p>
                <p id="creator_check">რეჟისორი</p>
                <p id="actors_check" class="optional">როლებში</p>
                <p id="description_check">მოკლე სიუჟეტი</p>
                <p id="genres_check">ჟანრები</p>
                <p id="image_check">ფოტო 1</p>
                <p id="image2_check">ფოტო 2</p>
            </div>
            <button class="dbt">ატვირთვა</button>
        </form>
    </div>

    <?php include_once "../components/endpage.php" ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
    let players = {
        1: {
            GEO: "",
            ENG: ""
        }
    };
    let movie_type = -1;
    let movie_genres = [];
    // changing in upload.js
    </script>
    <script type="module" src="../ui/mg_engine.js"></script>
    <script src="../assets/engines/nav.js"></script>
    <script type="module" src="../assets/engines/upload.js"></script>
    <script src="../assets/engines/mg_cardslider.js"></script>
    <script>
    const mg_ai_web_loader = document.querySelector(".mg_ai_web_loader");

    function verifyCheckings() {
        if (
            name_eng_check.classList.contains("checked") &&
            name_check.classList.contains("checked") &&
            year_check.classList.contains("checked") &&
            country_check.classList.contains("checked") &&
            imdb_check.classList.contains("checked") &&
            creator_check.classList.contains("checked") &&
            description_check.classList.contains("checked")
        ) {
            return true;
        } else {
            alert("შეავსე ყველა სავალდებულო ველი !");
            return false;
        }
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

        if (verifyCheckings()) {
            mg_ai_web_loader.classList.remove("mg_ai_web_loader_hidden");

            $.ajax({
                url: server_start + "movie_upload.php",
                type: "POST",
                data: formData,
                processData: false, // Don't process the data (important for file uploads)
                contentType: false, // Don't set content type (important for file uploads)
                success: function(response) {
                    mg_ai_web_loader.classList.add("mg_ai_web_loader_hidden");
                    let data = JSON.parse(response);
                    if (data.status == 100) {
                        alert("წარმატებით აიტვირთა");
                        window.location.reload();
                    } else {
                        alert("წარმოიშვა შეცდომა მიმართეთ დეველოპერს");
                    }
                },
            });
        }
    });
    </script>
</body>

</html>