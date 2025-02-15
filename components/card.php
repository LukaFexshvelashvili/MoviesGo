<?php
include_once "assets/types.php";
function card($data, $image_starter){

    $genres = json_decode($data["genres"], true);

    $genresText = is_array($genres) ? implode(", ", $genres) : "No genres available";
    echo '<div class="mg_card">
    <div class="mg_info_grab">
     <h3 id="mg_card_display_description">
        მოკლე აღწერა:
        <span class="mg_card_description_p">'
          .$data["description"].
        '</span>
      </h3>
      <p id="mg_card_display_genres"><span>ჟანრები:</span> '
          .$genresText.
        '</p>
    </div>
            <a href="./watch?id='.$data['id'].'" class="mg_img_side">

                
              <div class="mg_card_play">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path
                    fill="currentColor"
                    d="M133 440a35.37 35.37 0 0 1-17.5-4.67c-12-6.8-19.46-20-19.46-34.33V111c0-14.37 7.46-27.53 19.46-34.33a35.13 35.13 0 0 1 35.77.45l247.85 148.36a36 36 0 0 1 0 61l-247.89 148.4A35.5 35.5 0 0 1 133 440Z"
                  />
                </svg>
              </div>
              <img loading="lazy" src="'.$image_starter.$data['poster_url'].'" />
              <div class="mg_card_shadow "></div>
              <div class="mg_card_bookmark cnt">
                           <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24"><path fill="none" stroke="var(--iconlow)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z"/></svg>

              </div>
              <div class="mg_card_type cnt">'.get_movie_type($data["type"]).'</div>
              <div class="mg_card_year cnt">'
          .$data["year"].
        '</div>
              <div class="mg_card_imdb cnt">IMDB: '.$data["imdb"].'</div>

            </a>
            <div class="mg_card_info">
                <div class="mg_card_info_f">
                  <div class="card_info_text">'.$data["name"].'</div>
                  <div class="card_info_text">'.$data["name_eng"].'</div>
                  </div>
                  <div class="mg_card_info_e">
                  <div data-movie="'.$data["id"].'" class="mg_card_bookmark cnt">
             <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24"><path fill="none" stroke="var(--iconlow)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z"/></svg>
            </div>
          </div>
        </div>
        </div>
          ';
}