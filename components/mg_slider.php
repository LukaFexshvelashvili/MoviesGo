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
            <div class="mg_slider_shadow_side"></div>

            <img loading="lazy" src="<?php echo $image_starter.$movie['thumbnail_url'] ?>"
                alt="<?php echo $image_starter.$movie['name_eng'] ?> banner" class="mg_slider_img">
            <div class="mg_slider_info container">
                <div class="slider_card_start">
                    <div class="slider_card_addons">
                        <div class="s_type"><?php echo get_movie_type($movie['type']) ?></div>
                        <div class="s_year"><?php echo $movie['year'] ?></div>
                        <div class="s_imdb">IMDb: <?php echo number_format($movie['imdb'], 1) ?></div>
                    </div>
                    <div class="slider_card_title"><?php echo $movie['name'] ?></div>
                    <div class="slider_card_title s_title_eng"><?php echo $movie['name_eng'] ?></div>
                    <div class="slider_card_description"><?php echo $movie['description'] ?></div>
                    <div class="mg_slider_actions ">
                        <a href="./watch?id=<?php echo $movie['id'] ?>" class="mg_slider_icon mg_slider_play">
                            ყურება
                        </a>
                        <div data-movie="<?php echo $movie['id'] ?>"
                            class="mg_slider_icon mg_slider_bookmark <?php echo (is_bookmark_exists($movie['id']) ? "bookmarked" : "") ?> ">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="none" stroke="var(--iconlow)" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z"></path>
                            </svg>
                        </div>

                    </div>
                </div>
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