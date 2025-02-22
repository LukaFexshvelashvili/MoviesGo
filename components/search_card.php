<?php
include_once "assets/types.php";
function search_card($data, $image_starter){

    return ' <div class="mg_search_card">
                <div class="mg_img_side">
                    <a href="./watch?id='.$data['id'].'">
                        <img class="mg_card_image" loading="lazy"
                            src="'.$image_starter.$data['thumbnail_url'].'" alt="'.$data['name_eng'].' banner">
                        <div class="mg_card_shadow ">
                            <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.5 5.40192C14.5 6.55662 14.5 9.44338 12.5 10.5981L5 14.9282C3 16.0829 0.5 14.6395 0.5 12.3301V3.66987C0.5 1.36047 3 -0.0829034 5 1.0718L12.5 5.40192Z"
                                    stroke="var(--icon)" />
                            </svg>
                        </div>

                        <div class="mg_card_type cnt">'.get_movie_type($data['type']).'</div>
                        <div class="mg_card_year cnt">'.$data['year'].'</div>
                        <div class="mg_card_imdb cnt">IMDB: '.number_format($data['imdb'], 1).'</div>
                    </a>

                </div>
                <div class="mg_card_info">
                    <div class="mg_card_info_f">
                        <a href="./watch?id='.$data['id'].'" class="card_info_text">'.$data['name'].'</a>
                        <a href="./watch?id='.$data['id'].'" class="card_info_text">'.$data['name_eng'].'</a>
                    </div>
                    <div class="mg_card_info_e">
                        <div data-movie="'.$data['id'].'" class="mg_card_bookmark  cnt">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24">
                                <path fill="none" stroke="var(--iconlow)" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
          ';
}