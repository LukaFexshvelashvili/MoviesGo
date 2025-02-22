<?php
include_once "assets/types.php";
function card_wide($data, $image_starter){

    $genres = json_decode($data["genres"], true);

    $genresText = is_array($genres) ? implode(", ", $genres) : "No genres available";
    return '<div class="mg_card_wide">
    <div class="mg_info_grab">
        <h3 id="mg_card_display_description">
            მოკლე აღწერა:
            <span class="mg_card_description_p">
               '.$data['description'].'
            </span>
        </h3>
        <p id="mg_card_display_genres">
            <span>ჟანრები:</span> '.$genresText.'
        </p>
    </div>
    <div class="mg_img_side">
    <div class="mg_card_loader">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="60"
                height="60"
                viewBox="0 0 24 24"
              >
                <path
                  fill="var(--main)"
                  d="M7 22H4.75s-.75 0-.94-1.35L2.04 3.81L2 3.5C2 2.67 2.9 2 4 2s2 .67 2 1.5C6 2.67 6.9 2 8 2s2 .67 2 1.5c0-.83.9-1.5 2-1.5c1.09 0 2 .66 2 1.5c0-.83.9-1.5 2-1.5s2 .67 2 1.5c0-.83.9-1.5 2-1.5s2 .67 2 1.5l-.04.31l-1.77 16.84C20 22 19.25 22 19.25 22H7M17.85 4.93C17.55 4.39 16.84 4 16 4c-.81 0-1.64.36-2 .87L13.78 20h2.88l1.19-15.07M10 4.87C9.64 4.36 8.81 4 8 4c-.84 0-1.55.39-1.85.93L7.34 20h2.88L10 4.87Z"
                />
              </svg>
            </div>
        <img class="mg_card_image" loading="lazy" src="'.$image_starter.$data['thumbnail_url'].'" alt="'.$data['name_eng'].' banner" />
        <a href="./watch?id='.$data['id'].'" class="mg_card_shadow"></a>
        <div data-movie="'.$data['id'].'" class="mg_card_bookmark cnt">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24">
                <path fill="none" stroke="var(--iconlow)" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z" />
            </svg>
        </div>
        <a href="./watch?id='.$data['id'].'" class="mg_card_info">
            <div class="starter">
            <div>'.$data['name_eng'].'</div>
            <div>'.$data['name'].'</div>
            </div>
            <div class="laster">
                <div class="mg_card_imdb">IMDB: '.$data['imdb'].'</div>
            </div>
        </a>
    </div>
</div>
     ';  
}