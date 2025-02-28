<div class="populars">
    <div class="container">
        <div class="head_starter">
            <p>პოპულარული</p>
        </div>
        <div class="populars_block">
            <div class="popular_slider">
                <div class="popular_slider_row">



                    <?php
$ind = 0;
$slider_array = array_slice($movies_list, 0, 5);
foreach ($slider_array as $movie) {
    $ind++;

    ?>
                    <div class="popular_slider_card<?php echo $ind == 1 ? " popular_slider_card_active" : "" ?>">
                        <img class="popular_silder_card_img" src="<?php echo $image_starter.$movie['thumbnail_url'] ?>"
                            alt="<?php echo $movie['name_eng'] ?> banner">
                        <div class="popular_silder_card_shadow"></div>
                        <div class="popular_silder_card_info">

                            <div class="popular_title"><?php echo $movie['name'] ?></div>
                            <div class="popular_title_eng"><?php echo $movie['name_eng'] ?></div>
                            <div class="popular_description"><?php echo $movie['description'] ?></div>
                        </div>
                        <div class="popular_card_addons">
                            <div class="s_type"><?php echo get_movie_type($movie['type']) ?></div>
                            <div class="s_year"><?php echo $movie['year'] ?></div>
                            <div class="s_imdb">IMDb: <?php echo number_format($movie['imdb'], 1) ?></div>
                        </div>
                    </div>
                    <?php
}
?>
                </div>


                <div class=" popular_slider_indicators">
                    <?php
for ($i = 0; $i < count($slider_array); $i++) {
        ?>
                    <div class="popular_slider_indicator <?php echo $i==0 ? "popular_slider_indicator_active" : ""?>">
                    </div>
                    <?php

}
?>
                </div>
            </div>
            <div class="popular_side_cards">
                <div class="popular_card right_shadow">
                    <div class="popular_shadow "></div>
                    <div class="popular_card_info">
                        <p>სონიკი 3</p>
                        <p>SONIC 3</p>
                    </div>
                    <img src="http://localhost/moviesgo/v1/uploads/29/tW5lvdJ.webp" alt="sonic 3 banner">
                </div>
                <div class="popular_card right_shadow">
                    <div class="popular_shadow "></div>
                    <div class="popular_card_info">
                        <p>სონიკი 3</p>
                        <p>SONIC 3</p>
                    </div>
                    <img src="http://localhost/moviesgo/v1/uploads/36/tMCJ9Wv.webp" alt="sonic 3 banner">
                </div>
                <div class="popular_card right_shadow">
                    <div class="popular_shadow "></div>
                    <div class="popular_card_info">
                        <p>სონიკი 3</p>
                        <p>SONIC 3</p>
                    </div>
                    <img src="http://localhost/moviesgo/v1/uploads/42/t4hIIyT.webp" alt="sonic 3 banner">
                </div>
                <div class="popular_card right_shadow">
                    <div class="popular_shadow "></div>
                    <div class="popular_card_info">
                        <p>სონიკი 3</p>
                        <p>SONIC 3</p>
                    </div>
                    <img src="http://localhost/moviesgo/v1/uploads/28/tSO124n.webp" alt="sonic 3 banner">
                </div>
            </div>
        </div>
    </div>
</div>