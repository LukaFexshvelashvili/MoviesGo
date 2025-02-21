<div class="mg_slider">
    <div class="mg_slider_left">
        <!-- <div class="span_block"><svg width="24" height="110" viewBox="0 0 24 110" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M22 2L2.13323 54.6469C2.04736 54.8745 2.04736 55.1255 2.13323 55.3531L22 108" stroke="white"
                    stroke-width="3" stroke-linecap="round"></path>
            </svg></div> -->
    </div>
    <div class="mg_slider_right">
        <!-- <div class="span_block"><svg width="24" height="110" viewBox="0 0 24 110" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M22 2L2.13323 54.6469C2.04736 54.8745 2.04736 55.1255 2.13323 55.3531L22 108" stroke="white"
                    stroke-width="3" stroke-linecap="round"></path>
            </svg></div> -->
    </div>
    <div class="mg_slider_row">
        <?php
$ind = 0;
$slider_array = array_slice($movies_list, 0, 5);
foreach ($slider_array as $movie) {
    $ind++;

    ?>
        <div class="mg_slider_card <?php echo $ind == 1 ? "mg_slider_card_active" : "" ?>">
            <div class="mg_slider_shadow"></div>

            <img loading="lazy" src="<?php echo $image_starter.$movie['thumbnail_url'] ?>"
                alt="<?php echo $image_starter.$movie['name_eng'] ?> thumbnail" class="mg_slider_img">
            <div class="mg_slider_info">

                <div class="slider_card_start">
                    <div class="slider_card_title"><?php echo $movie['name'] ?></div>
                    <div class="slider_card_title title_eng"><?php echo $movie['name_eng'] ?></div>

                </div>
                <div class="slider_main_row">

                    <div class="slider_card_row">
                        <div class="info_card_inline">
                            <div class="info_texter">
                                <span>ტიპი</span>
                                <p><?php echo get_movie_type($movie['type']) ?></p>
                            </div>
                        </div>
                        <div class="info_card_inline">
                            <div class="info_texter">
                                <span>წელი</span>
                                <p><?php echo $movie['year'] ?></p>
                            </div>
                        </div>

                        <div class="info_card_inline info_card_inline_imdb">
                            <div class="info_texter">
                                <span class="imdb">IMDB</span>
                                <p><?php echo number_format($movie['imdb'], 1) ?></p>
                            </div>
                        </div>
                        <div class="drop">

                            <div class="info_card_inline ">
                                <div class="info_texter">
                                    <span>რეჟისორი</span>
                                    <p><?php echo $movie['creator'] ?></p>
                                </div>
                            </div>
                            <div class="info_card_inline">
                                <div class="info_texter">
                                    <span>ქვეყანა</span>
                                    <p><?php echo $movie['country'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mg_slider_actions">
                <div data-movie="<?php echo $movie['id'] ?>"
                    class="mg_slider_icon mg_slider_bookmark <?php echo (is_bookmark_exists($movie['id']) ? "bookmarked" : "") ?> ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="none" stroke="var(--iconlow)" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z"></path>
                    </svg>
                </div>
                <a href="./watch?id=<?php echo $movie['id'] ?>" class="mg_slider_icon mg_slider_play">

                    <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.5 5.40192C14.5 6.55662 14.5 9.44338 12.5 10.5981L5 14.9282C3 16.0829 0.5 14.6395 0.5 12.3301V3.66987C0.5 1.36047 3 -0.0829034 5 1.0718L12.5 5.40192Z"
                            fill="white" />
                    </svg>

                </a>
            </div>
        </div>

        <?php
}
?>



    </div>
    <div class="mg_slider_indicators">
        <?php
for ($i = 0; $i < count($slider_array); $i++) {
        ?>
        <div class="mg_slider_indicator <?php echo $i==0 ? "mg_slider_indicator_active" : ""?>"></div>
        <?php

}
?>

    </div>
</div>