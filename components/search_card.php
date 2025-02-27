<?php
include_once "assets/types.php";
function search_card($data, $image_starter){

    return ' <div class="mg_search_card">
                <div class="mg_img_side">
                    <a href="./watch?id='.$data['id'].'">
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
                        <div data-movie="'.$data['id'].'" class="mg_card_bookmark cnt">
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