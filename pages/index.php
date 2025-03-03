<?php
include_once "../server/connection.php";
include_once "../components/card.php";
include_once "../components/card_wide.php";
include_once "../components/assets/types.php";


$sql = "
(SELECT id, genres, description, poster_url, thumbnail_url, subtitle, name, name_eng, imdb, type, year, country, creator FROM movies WHERE type = 0 ORDER BY year DESC LIMIT 8 )
UNION ALL
(SELECT id, genres, description, poster_url, thumbnail_url, subtitle, name, name_eng, imdb, type, year, country, creator FROM movies WHERE type = 1 ORDER BY year DESC LIMIT 8 )
UNION ALL
(SELECT id, genres, description, poster_url, thumbnail_url, subtitle, name, name_eng, imdb, type, year, country, creator FROM movies WHERE type = 2 ORDER BY year DESC LIMIT 8 )
UNION ALL
(SELECT id, genres, description, poster_url, thumbnail_url, subtitle, name, name_eng, imdb, type, year, country, creator FROM movies WHERE type = 3 ORDER BY year DESC LIMIT 8 ) ;
";

$movies_fetch = mysqli_query($conn, $sql);
$movies_list = mysqli_fetch_all($movies_fetch, MYSQLI_ASSOC);
$movies_by_type = [];

foreach ($movies_list as $movie) {
    switch ($movie['type']) {
        case 0:
            $movies_by_type["movies"][] = $movie;
            break;
        case 1:
            $movies_by_type["series"][] = $movie;
            break;
        case 2:
            $movies_by_type["animations"][] = $movie;
            break;
        case 3:
            $movies_by_type["animes"][] = $movie;
            break;
    }
}



if (isset($_SESSION['watch_history']) && !empty($_SESSION['watch_history'])) {
    $watch_history = $_SESSION['watch_history'];
    $placeholders = implode(',', array_fill(0, count($watch_history), '?'));
    $sql = "SELECT id, genres, description, poster_url, thumbnail_url, subtitle, name, name_eng, imdb, type, year, country, creator FROM movies WHERE id IN ($placeholders) 
        ORDER BY FIELD(id, " . implode(',', array_fill(0, count($watch_history), '?')) . ")";
    $stmt_movies = $conn->prepare($sql);
    $types = str_repeat('i', count($watch_history) * 2);
    $params = array_merge($watch_history, $watch_history);
    $stmt_movies->bind_param($types, ...$params);
    $stmt_movies->execute();
    $watch_history = $stmt_movies->get_result();
}

?>


<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>ფილმები, სერიალები, ანიმეები ქართულად - MoviesGo</title>

    <link rel="stylesheet" href="../assets/css/components/colors.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/pages/home/home.css" />
    <link rel="stylesheet" href="../assets/css/components/nav.css" />
    <link rel="stylesheet" href="../assets/css/components/card.css" />
    <link rel="stylesheet" href="../assets/css/components/mg_cardslider.css" />
    <link rel="stylesheet" href="../assets/css/components/mg_slider.css" />
</head>

<body class="bg-bodybg no-scroll">

    <?php include_once "../components/nav.php" ?>

    <!-- & MAIN SLIDER -->
    <?php include_once "../components/mg_slider.php" ?>
    <script src="../assets/engines/mg_slider.js"></script>

    <!-- & CARD SLIDERS -->
    <div class="container index_cont">

        <?php
        if (isset($watch_history)) {
        ?>
        <div class="mg_cardslider mg_cardslider_starter">
            <div class="mg_cardslider_info">
                <div class="mg_cardslider_start">

                    განაგრძე ყურება
                </div>
                <div class="mg_cardslider_end">
                    <div class="mg_cardslider_button cnt mg_cardslider_left">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.379685 8.62033L6.79762 15.0383C6.9173 15.158 7.05938 15.2529 7.21575 15.3177C7.37212 15.3824 7.53972 15.4158 7.70897 15.4158C8.05079 15.4158 8.37861 15.28 8.62032 15.0383C8.74 14.9186 8.83493 14.7765 8.8997 14.6201C8.96447 14.4638 8.99781 14.2962 8.99781 14.1269C8.99781 13.7851 8.86202 13.4573 8.62032 13.2156L3.10089 7.70899L8.62032 2.20239C8.74063 2.08306 8.83612 1.9411 8.90128 1.78468C8.96645 1.62826 9 1.46049 9 1.29104C9 1.12159 8.96645 0.953821 8.90128 0.797404C8.83612 0.640987 8.74063 0.499022 8.62032 0.379696C8.50099 0.259387 8.35902 0.163893 8.20261 0.0987262C8.04619 0.0335607 7.87842 1.14093e-05 7.70897 1.14093e-05C7.53952 1.14093e-05 7.37175 0.0335607 7.21533 0.0987262C7.05891 0.163893 6.91695 0.259387 6.79762 0.379696L0.379685 6.79764C0.259376 6.91697 0.163882 7.05893 0.0987154 7.21535C0.0335498 7.37177 5.36442e-07 7.53954 5.36442e-07 7.70899C5.36442e-07 7.87844 0.0335498 8.04621 0.0987154 8.20262C0.163882 8.35904 0.259376 8.50101 0.379685 8.62033Z"
                                fill="var(--main)" />
                        </svg>
                    </div>
                    <div class="mg_cardslider_button cnt mg_cardslider_right">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.62032 6.79544L2.20238 0.377493C2.0827 0.257813 1.94062 0.162878 1.78425 0.0981076C1.62788 0.0333372 1.46028 0 1.29103 0C0.94921 0 0.621387 0.135788 0.379683 0.377493C0.260003 0.497173 0.165067 0.639254 0.100297 0.795623C0.0355269 0.951992 0.00219149 1.11959 0.00219149 1.28884C0.00219149 1.63066 0.137979 1.95848 0.379683 2.20019L5.89911 7.70679L0.379683 13.2134C0.259374 13.3327 0.163883 13.4747 0.0987171 13.6311C0.033551 13.7875 0 13.9553 0 14.1247C0 14.2942 0.033551 14.462 0.0987171 14.6184C0.163883 14.7748 0.259374 14.9167 0.379683 15.0361C0.499009 15.1564 0.640976 15.2519 0.797393 15.317C0.95381 15.3822 1.12158 15.4158 1.29103 15.4158C1.46048 15.4158 1.62825 15.3822 1.78467 15.317C1.94109 15.2519 2.08305 15.1564 2.20238 15.0361L8.62032 8.61813C8.74062 8.49881 8.83612 8.35684 8.90129 8.20042C8.96645 8.04401 9 7.87623 9 7.70679C9 7.53734 8.96645 7.36956 8.90129 7.21315C8.83612 7.05673 8.74062 6.91476 8.62032 6.79544Z"
                                fill="var(--main)" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="mg_cardslider_row">
                <?php
                    while ($data = mysqli_fetch_assoc($watch_history)) {
                        echo card($data, $image_starter);
                    }
                    ?>
            </div>
        </div>
        <?php
        }
        ?>
        <!-- ჟანრები -->
        <!-- <div class="mg_cardslider">
            <div class="mg_cardslider_info">
                <div class="mg_cardslider_start">
                    ჟანრები
                </div>
                <div class="mg_cardslider_end">
                    <div class="mg_cardslider_button cnt mg_cardslider_left">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.379685 8.62033L6.79762 15.0383C6.9173 15.158 7.05938 15.2529 7.21575 15.3177C7.37212 15.3824 7.53972 15.4158 7.70897 15.4158C8.05079 15.4158 8.37861 15.28 8.62032 15.0383C8.74 14.9186 8.83493 14.7765 8.8997 14.6201C8.96447 14.4638 8.99781 14.2962 8.99781 14.1269C8.99781 13.7851 8.86202 13.4573 8.62032 13.2156L3.10089 7.70899L8.62032 2.20239C8.74063 2.08306 8.83612 1.9411 8.90128 1.78468C8.96645 1.62826 9 1.46049 9 1.29104C9 1.12159 8.96645 0.953821 8.90128 0.797404C8.83612 0.640987 8.74063 0.499022 8.62032 0.379696C8.50099 0.259387 8.35902 0.163893 8.20261 0.0987262C8.04619 0.0335607 7.87842 1.14093e-05 7.70897 1.14093e-05C7.53952 1.14093e-05 7.37175 0.0335607 7.21533 0.0987262C7.05891 0.163893 6.91695 0.259387 6.79762 0.379696L0.379685 6.79764C0.259376 6.91697 0.163882 7.05893 0.0987154 7.21535C0.0335498 7.37177 5.36442e-07 7.53954 5.36442e-07 7.70899C5.36442e-07 7.87844 0.0335498 8.04621 0.0987154 8.20262C0.163882 8.35904 0.259376 8.50101 0.379685 8.62033Z"
                                fill="var(--main)" />
                        </svg>
                    </div>
                    <div class="mg_cardslider_button cnt mg_cardslider_right">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.62032 6.79544L2.20238 0.377493C2.0827 0.257813 1.94062 0.162878 1.78425 0.0981076C1.62788 0.0333372 1.46028 0 1.29103 0C0.94921 0 0.621387 0.135788 0.379683 0.377493C0.260003 0.497173 0.165067 0.639254 0.100297 0.795623C0.0355269 0.951992 0.00219149 1.11959 0.00219149 1.28884C0.00219149 1.63066 0.137979 1.95848 0.379683 2.20019L5.89911 7.70679L0.379683 13.2134C0.259374 13.3327 0.163883 13.4747 0.0987171 13.6311C0.033551 13.7875 0 13.9553 0 14.1247C0 14.2942 0.033551 14.462 0.0987171 14.6184C0.163883 14.7748 0.259374 14.9167 0.379683 15.0361C0.499009 15.1564 0.640976 15.2519 0.797393 15.317C0.95381 15.3822 1.12158 15.4158 1.29103 15.4158C1.46048 15.4158 1.62825 15.3822 1.78467 15.317C1.94109 15.2519 2.08305 15.1564 2.20238 15.0361L8.62032 8.61813C8.74062 8.49881 8.83612 8.35684 8.90129 8.20042C8.96645 8.04401 9 7.87623 9 7.70679C9 7.53734 8.96645 7.36956 8.90129 7.21315C8.83612 7.05673 8.74062 6.91476 8.62032 6.79544Z"
                                fill="var(--main)" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="mg_cardslider_row">
                <?php
                if (isset($movies_by_type['series']) && !empty($movies_by_type['series'])) {
                    foreach ($movies_list as $data) {
                ?>
                <div class="genre_card">
                    <div class="darken"></div>
                    <img src="<?php echo $image_starter . $data['thumbnail_url'] ?>" alt="movie banner">
                    <p>სათავგადასავლო</p>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div> -->


    </div>



    <div class="news">
        <div class="container">
            <div class="head_starter">
                <p>სიახლე</p>
            </div>
            <div class="news_row">
                <div class="news_row_col">
                    <div class="news_card left_shadow">
                        <div class="news_shadow "></div>
                        <div class="news_card_info">
                            <p><?php echo $movies_by_type["animations"][0]['name'] ?></p>
                            <p><?php echo $movies_by_type["animations"][0]['name_eng'] ?></p>
                        </div>
                        <img src="<?php echo $image_starter.$movies_by_type["animations"][0]['thumbnail_url'] ?>"
                            alt="<?php echo $movies_by_type["animations"][0]['name_eng'] ?> banner">
                    </div>
                    <div class="news_card left_shadow">
                        <div class="news_shadow "></div>
                        <div class="news_card_info">
                            <p><?php echo $movies_by_type["animations"][1]['name'] ?></p>
                            <p><?php echo $movies_by_type["animations"][1]['name_eng'] ?></p>
                        </div>
                        <img src="<?php echo $image_starter.$movies_by_type["animations"][1]['thumbnail_url'] ?>"
                            alt="<?php echo $movies_by_type["animations"][1]['name_eng'] ?> banner">
                    </div>
                </div>
                <div class="news_row_center">
                    <div class="news_card bottom_shadow">
                        <div class="news_shadow "></div>
                        <img src="<?php echo $image_starter.$movies_by_type["animations"][2]['thumbnail_url'] ?>"
                            alt="<?php echo $movies_by_type["animations"][2]['name_eng'] ?> banner">
                        <div class="news_card_info">
                            <p><?php echo $movies_by_type["animations"][2]['name'] ?></p>
                            <p><?php echo $movies_by_type["animations"][2]['name_eng'] ?></p>
                        </div>
                    </div>

                </div>
                <div class="news_row_col">
                    <div class="news_card right_shadow">
                        <div class="news_shadow "></div>
                        <img src="<?php echo $image_starter.$movies_by_type["movies"][3]['thumbnail_url'] ?>"
                            alt="<?php echo $movies_by_type["movies"][3]['name_eng'] ?> banner">
                        <div class="news_card_info">
                            <p><?php echo $movies_by_type["movies"][3]['name'] ?></p>
                            <p><?php echo $movies_by_type["movies"][3]['name_eng'] ?></p>
                        </div>
                    </div>
                    <div class="news_card right_shadow">
                        <div class="news_shadow "></div>
                        <img src="<?php echo $image_starter.$movies_by_type["movies"][4]['thumbnail_url'] ?>"
                            alt="<?php echo $movies_by_type["movies"][4]['name_eng'] ?> banner">
                        <div class="news_card_info">
                            <p><?php echo $movies_by_type["movies"][4]['name'] ?></p>
                            <p><?php echo $movies_by_type["movies"][4]['name_eng'] ?></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container for_mbd">
        <div class="mg_cardslider">
            <div class="mg_cardslider_info">
                <div class="mg_cardslider_start">
                    სიახლე
                </div>
                <div class="mg_cardslider_end">
                    <div class="mg_cardslider_button cnt mg_cardslider_left">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.379685 8.62033L6.79762 15.0383C6.9173 15.158 7.05938 15.2529 7.21575 15.3177C7.37212 15.3824 7.53972 15.4158 7.70897 15.4158C8.05079 15.4158 8.37861 15.28 8.62032 15.0383C8.74 14.9186 8.83493 14.7765 8.8997 14.6201C8.96447 14.4638 8.99781 14.2962 8.99781 14.1269C8.99781 13.7851 8.86202 13.4573 8.62032 13.2156L3.10089 7.70899L8.62032 2.20239C8.74063 2.08306 8.83612 1.9411 8.90128 1.78468C8.96645 1.62826 9 1.46049 9 1.29104C9 1.12159 8.96645 0.953821 8.90128 0.797404C8.83612 0.640987 8.74063 0.499022 8.62032 0.379696C8.50099 0.259387 8.35902 0.163893 8.20261 0.0987262C8.04619 0.0335607 7.87842 1.14093e-05 7.70897 1.14093e-05C7.53952 1.14093e-05 7.37175 0.0335607 7.21533 0.0987262C7.05891 0.163893 6.91695 0.259387 6.79762 0.379696L0.379685 6.79764C0.259376 6.91697 0.163882 7.05893 0.0987154 7.21535C0.0335498 7.37177 5.36442e-07 7.53954 5.36442e-07 7.70899C5.36442e-07 7.87844 0.0335498 8.04621 0.0987154 8.20262C0.163882 8.35904 0.259376 8.50101 0.379685 8.62033Z"
                                fill="var(--main)" />
                        </svg>
                    </div>
                    <div class="mg_cardslider_button cnt mg_cardslider_right">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.62032 6.79544L2.20238 0.377493C2.0827 0.257813 1.94062 0.162878 1.78425 0.0981076C1.62788 0.0333372 1.46028 0 1.29103 0C0.94921 0 0.621387 0.135788 0.379683 0.377493C0.260003 0.497173 0.165067 0.639254 0.100297 0.795623C0.0355269 0.951992 0.00219149 1.11959 0.00219149 1.28884C0.00219149 1.63066 0.137979 1.95848 0.379683 2.20019L5.89911 7.70679L0.379683 13.2134C0.259374 13.3327 0.163883 13.4747 0.0987171 13.6311C0.033551 13.7875 0 13.9553 0 14.1247C0 14.2942 0.033551 14.462 0.0987171 14.6184C0.163883 14.7748 0.259374 14.9167 0.379683 15.0361C0.499009 15.1564 0.640976 15.2519 0.797393 15.317C0.95381 15.3822 1.12158 15.4158 1.29103 15.4158C1.46048 15.4158 1.62825 15.3822 1.78467 15.317C1.94109 15.2519 2.08305 15.1564 2.20238 15.0361L8.62032 8.61813C8.74062 8.49881 8.83612 8.35684 8.90129 8.20042C8.96645 8.04401 9 7.87623 9 7.70679C9 7.53734 8.96645 7.36956 8.90129 7.21315C8.83612 7.05673 8.74062 6.91476 8.62032 6.79544Z"
                                fill="var(--main)" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="mg_cardslider_row">
                <?php
                if (isset($movies_by_type['animations']) && !empty($movies_by_type['animations'])) {
                    foreach ($movies_by_type['animations'] as $data) {
                        echo card($data, $image_starter);
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!-- პოპულარულები -->
    <?php include_once "./home/popular_block.php" ?>
    <script src="../assets/engines/popular_slider.js"></script>



    <!-- კატეგორიები -->
    <div class="container">
        <div class="categories">
            <div class="head_starter">
                <p>კატეგორიები</p>
            </div>
            <div class="categories_row">

                <a href="search?type=0" class="category_card">
                    <div class="category_icon">

                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_297_1155)">
                                <path
                                    d="M31.5741 4.16663H39.537V31.8518C39.537 32.9629 39.1512 33.9043 38.3796 34.6759C37.608 35.4475 36.6667 35.8333 35.5556 35.8333H3.98148C2.87037 35.8333 1.92901 35.4475 1.15741 34.6759C0.385803 33.9043 0 32.9629 0 31.8518V8.14811C0 7.037 0.385803 6.09564 1.15741 5.32403C1.92901 4.55243 2.87037 4.16663 3.98148 4.16663H5.92593L9.90741 12.1296H15.8333L11.8519 4.16663H15.8333L19.7222 12.1296H25.6482L21.7593 4.16663H25.6482L29.6296 12.1296H35.5556L31.5741 4.16663Z"
                                    fill="white" fill-opacity="0.8" />
                            </g>
                            <defs>
                                <clipPath id="clip0_297_1155">
                                    <rect width="40" height="40" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>

                    </div>
                    <p>ფილმები</p>
                </a>

                <a href="search?type=1" class="category_card">
                    <div class="category_icon">

                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 6C6.93913 6 5.92172 6.42143 5.17157 7.17157C4.42143 7.92172 4 8.93913 4 10V22C4 23.0609 4.42143 24.0783 5.17157 24.8284C5.92172 25.5786 6.93913 26 8 26H24C25.0609 26 26.0783 25.5786 26.8284 24.8284C27.5786 24.0783 28 23.0609 28 22V10C28 8.93913 27.5786 7.92172 26.8284 7.17157C26.0783 6.42143 25.0609 6 24 6H8ZM8.536 28C8.88706 28.6081 9.392 29.113 10.0001 29.4641C10.6081 29.8151 11.2979 30 12 30H24C26.1217 30 28.1566 29.1571 29.6569 27.6569C31.1571 26.1566 32 24.1217 32 22V14C32 13.2979 31.8151 12.6081 31.4641 12.0001C31.113 11.392 30.6081 10.8871 30 10.536V22C30 23.5913 29.3679 25.1174 28.2426 26.2426C27.1174 27.3679 25.5913 28 24 28H8.536ZM12.536 32C12.8871 32.6081 13.392 33.113 14.0001 33.4641C14.6081 33.8151 15.2979 34 16 34H24C27.1826 34 30.2348 32.7357 32.4853 30.4853C34.7357 28.2348 36 25.1826 36 22V18C36 17.2979 35.8151 16.6081 35.4641 16.0001C35.113 15.392 34.6081 14.8871 34 14.536V22C34 24.6522 32.9464 27.1957 31.0711 29.0711C29.1957 30.9464 26.6522 32 24 32H12.536Z"
                                fill="white" fill-opacity="0.8" />
                        </svg>

                    </div>
                    <p>სერიალები</p>
                </a>

                <a href="search?type=2" class="category_card">
                    <div class="category_icon">


                        <svg width="30" height="29" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.0979 1.8541C13.6966 0.0114785 16.3034 0.0114793 16.9021 1.8541L19.0413 8.43769C19.309 9.26174 20.0769 9.81966 20.9434 9.81966H27.8658C29.8032 9.81966 30.6088 12.2989 29.0413 13.4377L23.441 17.5066C22.74 18.0159 22.4467 18.9186 22.7145 19.7426L24.8536 26.3262C25.4523 28.1689 23.3433 29.7011 21.7759 28.5623L16.1756 24.4934C15.4746 23.9841 14.5254 23.9841 13.8244 24.4934L8.22409 28.5623C6.65666 29.7011 4.5477 28.1689 5.14641 26.3262L7.28555 19.7426C7.5533 18.9186 7.25998 18.0159 6.559 17.5066L0.958665 13.4377C-0.608762 12.2989 0.19679 9.81966 2.13424 9.81966H9.05664C9.92309 9.81966 10.691 9.26174 10.9587 8.43769L13.0979 1.8541Z"
                                fill="white" fill-opacity="0.8" />
                        </svg>


                    </div>
                    <p>ანიმაციები</p>
                </a>

                <a href="search?type=3" class="category_card">
                    <div class="category_icon">


                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M33.7488 5H23.7488C23.5574 4.99998 23.3685 5.04393 23.1968 5.12845C23.025 5.21297 22.875 5.33581 22.7582 5.4875L12.7582 18.4891L11.2488 16.9828C11.0167 16.7504 10.7409 16.566 10.4374 16.4402C10.1339 16.3144 9.80863 16.2496 9.48009 16.2496C9.15155 16.2496 8.82624 16.3144 8.52274 16.4402C8.21925 16.566 7.94352 16.7504 7.71134 16.9828L5.72853 18.9672C5.49632 19.1993 5.31212 19.475 5.18645 19.7783C5.06078 20.0817 4.99609 20.4068 4.99609 20.7352C4.99609 21.0635 5.06078 21.3886 5.18645 21.692C5.31212 21.9953 5.49632 22.271 5.72853 22.5031L8.85353 25.6281L4.47853 30.0031C4.24632 30.2353 4.06212 30.5109 3.93645 30.8143C3.81078 31.1176 3.74609 31.4427 3.74609 31.7711C3.74609 32.0994 3.81078 32.4246 3.93645 32.7279C4.06212 33.0313 4.24632 33.3069 4.47853 33.5391L6.46134 35.5203C6.93014 35.9888 7.56577 36.252 8.22853 36.252C8.89129 36.252 9.52692 35.9888 9.99572 35.5203L14.3707 31.1453L17.4957 34.2703C17.7279 34.5028 18.0036 34.6871 18.3071 34.813C18.6106 34.9388 18.9359 35.0035 19.2645 35.0035C19.593 35.0035 19.9183 34.9388 20.2218 34.813C20.5253 34.6871 20.801 34.5028 21.0332 34.2703L23.016 32.2859C23.2482 32.0538 23.4324 31.7782 23.5581 31.4748C23.6838 31.1715 23.7485 30.8463 23.7485 30.518C23.7485 30.1896 23.6838 29.8645 23.5581 29.5611C23.4324 29.2578 23.2482 28.9822 23.016 28.75L21.5098 27.2438L34.5113 17.2438C34.6634 17.1267 34.7865 16.9761 34.8711 16.8038C34.9556 16.6314 34.9993 16.442 34.9988 16.25V6.25C34.9988 5.91848 34.8671 5.60054 34.6327 5.36612C34.3983 5.1317 34.0804 5 33.7488 5ZM8.23165 33.75L6.24884 31.7688L10.6238 27.3938L12.6051 29.375L8.23165 33.75ZM19.2645 32.5L7.49884 20.7359L9.48322 18.75L21.2488 30.5172L19.2645 32.5ZM32.4988 15.6344L19.727 25.4594L18.0176 23.75L25.8832 15.8844C26.1176 15.6498 26.2491 15.3318 26.249 15.0002C26.2488 14.6687 26.117 14.3508 25.8824 14.1164C25.6479 13.8821 25.3298 13.7505 24.9983 13.7506C24.6667 13.7508 24.3488 13.8826 24.1145 14.1172L16.2488 21.9812L14.541 20.2719L24.3645 7.5H32.4988V15.6344Z"
                                fill="white" fill-opacity="0.8" />
                        </svg>


                    </div>
                    <p>ანიმეები</p>
                </a>


            </div>
        </div>
    </div>


    <!-- ფილმები -->
    <div class="container">
        <div class="mg_cardslider">
            <div class="mg_cardslider_info">
                <div class="mg_cardslider_start">
                    ფილმები
                </div>
                <div class="mg_cardslider_end">
                    <div class="mg_cardslider_button cnt mg_cardslider_left">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.379685 8.62033L6.79762 15.0383C6.9173 15.158 7.05938 15.2529 7.21575 15.3177C7.37212 15.3824 7.53972 15.4158 7.70897 15.4158C8.05079 15.4158 8.37861 15.28 8.62032 15.0383C8.74 14.9186 8.83493 14.7765 8.8997 14.6201C8.96447 14.4638 8.99781 14.2962 8.99781 14.1269C8.99781 13.7851 8.86202 13.4573 8.62032 13.2156L3.10089 7.70899L8.62032 2.20239C8.74063 2.08306 8.83612 1.9411 8.90128 1.78468C8.96645 1.62826 9 1.46049 9 1.29104C9 1.12159 8.96645 0.953821 8.90128 0.797404C8.83612 0.640987 8.74063 0.499022 8.62032 0.379696C8.50099 0.259387 8.35902 0.163893 8.20261 0.0987262C8.04619 0.0335607 7.87842 1.14093e-05 7.70897 1.14093e-05C7.53952 1.14093e-05 7.37175 0.0335607 7.21533 0.0987262C7.05891 0.163893 6.91695 0.259387 6.79762 0.379696L0.379685 6.79764C0.259376 6.91697 0.163882 7.05893 0.0987154 7.21535C0.0335498 7.37177 5.36442e-07 7.53954 5.36442e-07 7.70899C5.36442e-07 7.87844 0.0335498 8.04621 0.0987154 8.20262C0.163882 8.35904 0.259376 8.50101 0.379685 8.62033Z"
                                fill="var(--main)" />
                        </svg>
                    </div>
                    <div class="mg_cardslider_button cnt mg_cardslider_right">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.62032 6.79544L2.20238 0.377493C2.0827 0.257813 1.94062 0.162878 1.78425 0.0981076C1.62788 0.0333372 1.46028 0 1.29103 0C0.94921 0 0.621387 0.135788 0.379683 0.377493C0.260003 0.497173 0.165067 0.639254 0.100297 0.795623C0.0355269 0.951992 0.00219149 1.11959 0.00219149 1.28884C0.00219149 1.63066 0.137979 1.95848 0.379683 2.20019L5.89911 7.70679L0.379683 13.2134C0.259374 13.3327 0.163883 13.4747 0.0987171 13.6311C0.033551 13.7875 0 13.9553 0 14.1247C0 14.2942 0.033551 14.462 0.0987171 14.6184C0.163883 14.7748 0.259374 14.9167 0.379683 15.0361C0.499009 15.1564 0.640976 15.2519 0.797393 15.317C0.95381 15.3822 1.12158 15.4158 1.29103 15.4158C1.46048 15.4158 1.62825 15.3822 1.78467 15.317C1.94109 15.2519 2.08305 15.1564 2.20238 15.0361L8.62032 8.61813C8.74062 8.49881 8.83612 8.35684 8.90129 8.20042C8.96645 8.04401 9 7.87623 9 7.70679C9 7.53734 8.96645 7.36956 8.90129 7.21315C8.83612 7.05673 8.74062 6.91476 8.62032 6.79544Z"
                                fill="var(--main)" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="mg_cardslider_row">
                <?php
                if (isset($movies_by_type['movies']) && !empty($movies_by_type['movies'])) {
                    foreach ($movies_by_type['movies'] as $data) {
                        echo card($data, $image_starter);
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- ანიმეები -->
    <div class="animes_row">
        <img src="../assets/images/animebg.jpg" class="decor_bg" />
        <div class="container">
            <div class="mg_cardslider">
                <div class="mg_cardslider_info">
                    <div class="mg_cardslider_start">

                        ანიმეები
                    </div>
                    <div class="mg_cardslider_end">
                        <div class="mg_cardslider_button cnt mg_cardslider_left">
                            <svg width="9" height="16" viewBox="0 0 9 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.379685 8.62033L6.79762 15.0383C6.9173 15.158 7.05938 15.2529 7.21575 15.3177C7.37212 15.3824 7.53972 15.4158 7.70897 15.4158C8.05079 15.4158 8.37861 15.28 8.62032 15.0383C8.74 14.9186 8.83493 14.7765 8.8997 14.6201C8.96447 14.4638 8.99781 14.2962 8.99781 14.1269C8.99781 13.7851 8.86202 13.4573 8.62032 13.2156L3.10089 7.70899L8.62032 2.20239C8.74063 2.08306 8.83612 1.9411 8.90128 1.78468C8.96645 1.62826 9 1.46049 9 1.29104C9 1.12159 8.96645 0.953821 8.90128 0.797404C8.83612 0.640987 8.74063 0.499022 8.62032 0.379696C8.50099 0.259387 8.35902 0.163893 8.20261 0.0987262C8.04619 0.0335607 7.87842 1.14093e-05 7.70897 1.14093e-05C7.53952 1.14093e-05 7.37175 0.0335607 7.21533 0.0987262C7.05891 0.163893 6.91695 0.259387 6.79762 0.379696L0.379685 6.79764C0.259376 6.91697 0.163882 7.05893 0.0987154 7.21535C0.0335498 7.37177 5.36442e-07 7.53954 5.36442e-07 7.70899C5.36442e-07 7.87844 0.0335498 8.04621 0.0987154 8.20262C0.163882 8.35904 0.259376 8.50101 0.379685 8.62033Z"
                                    fill="var(--main)" />
                            </svg>
                        </div>
                        <div class="mg_cardslider_button cnt mg_cardslider_right">
                            <svg width="9" height="16" viewBox="0 0 9 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.62032 6.79544L2.20238 0.377493C2.0827 0.257813 1.94062 0.162878 1.78425 0.0981076C1.62788 0.0333372 1.46028 0 1.29103 0C0.94921 0 0.621387 0.135788 0.379683 0.377493C0.260003 0.497173 0.165067 0.639254 0.100297 0.795623C0.0355269 0.951992 0.00219149 1.11959 0.00219149 1.28884C0.00219149 1.63066 0.137979 1.95848 0.379683 2.20019L5.89911 7.70679L0.379683 13.2134C0.259374 13.3327 0.163883 13.4747 0.0987171 13.6311C0.033551 13.7875 0 13.9553 0 14.1247C0 14.2942 0.033551 14.462 0.0987171 14.6184C0.163883 14.7748 0.259374 14.9167 0.379683 15.0361C0.499009 15.1564 0.640976 15.2519 0.797393 15.317C0.95381 15.3822 1.12158 15.4158 1.29103 15.4158C1.46048 15.4158 1.62825 15.3822 1.78467 15.317C1.94109 15.2519 2.08305 15.1564 2.20238 15.0361L8.62032 8.61813C8.74062 8.49881 8.83612 8.35684 8.90129 8.20042C8.96645 8.04401 9 7.87623 9 7.70679C9 7.53734 8.96645 7.36956 8.90129 7.21315C8.83612 7.05673 8.74062 6.91476 8.62032 6.79544Z"
                                    fill="var(--main)" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mg_cardslider_row">
                    <?php
                    if (isset($movies_by_type['animes']) && !empty($movies_by_type['animes'])) {
                        foreach ($movies_by_type['animes'] as $data) {
                            echo card($data, $image_starter);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- სერიალები -->
    <div class="container">
        <div class="mg_cardslider">
            <div class="mg_cardslider_info">
                <div class="mg_cardslider_start">
                    სერიალები
                </div>
                <div class="mg_cardslider_end">
                    <div class="mg_cardslider_button cnt mg_cardslider_left">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.379685 8.62033L6.79762 15.0383C6.9173 15.158 7.05938 15.2529 7.21575 15.3177C7.37212 15.3824 7.53972 15.4158 7.70897 15.4158C8.05079 15.4158 8.37861 15.28 8.62032 15.0383C8.74 14.9186 8.83493 14.7765 8.8997 14.6201C8.96447 14.4638 8.99781 14.2962 8.99781 14.1269C8.99781 13.7851 8.86202 13.4573 8.62032 13.2156L3.10089 7.70899L8.62032 2.20239C8.74063 2.08306 8.83612 1.9411 8.90128 1.78468C8.96645 1.62826 9 1.46049 9 1.29104C9 1.12159 8.96645 0.953821 8.90128 0.797404C8.83612 0.640987 8.74063 0.499022 8.62032 0.379696C8.50099 0.259387 8.35902 0.163893 8.20261 0.0987262C8.04619 0.0335607 7.87842 1.14093e-05 7.70897 1.14093e-05C7.53952 1.14093e-05 7.37175 0.0335607 7.21533 0.0987262C7.05891 0.163893 6.91695 0.259387 6.79762 0.379696L0.379685 6.79764C0.259376 6.91697 0.163882 7.05893 0.0987154 7.21535C0.0335498 7.37177 5.36442e-07 7.53954 5.36442e-07 7.70899C5.36442e-07 7.87844 0.0335498 8.04621 0.0987154 8.20262C0.163882 8.35904 0.259376 8.50101 0.379685 8.62033Z"
                                fill="var(--main)" />
                        </svg>
                    </div>
                    <div class="mg_cardslider_button cnt mg_cardslider_right">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.62032 6.79544L2.20238 0.377493C2.0827 0.257813 1.94062 0.162878 1.78425 0.0981076C1.62788 0.0333372 1.46028 0 1.29103 0C0.94921 0 0.621387 0.135788 0.379683 0.377493C0.260003 0.497173 0.165067 0.639254 0.100297 0.795623C0.0355269 0.951992 0.00219149 1.11959 0.00219149 1.28884C0.00219149 1.63066 0.137979 1.95848 0.379683 2.20019L5.89911 7.70679L0.379683 13.2134C0.259374 13.3327 0.163883 13.4747 0.0987171 13.6311C0.033551 13.7875 0 13.9553 0 14.1247C0 14.2942 0.033551 14.462 0.0987171 14.6184C0.163883 14.7748 0.259374 14.9167 0.379683 15.0361C0.499009 15.1564 0.640976 15.2519 0.797393 15.317C0.95381 15.3822 1.12158 15.4158 1.29103 15.4158C1.46048 15.4158 1.62825 15.3822 1.78467 15.317C1.94109 15.2519 2.08305 15.1564 2.20238 15.0361L8.62032 8.61813C8.74062 8.49881 8.83612 8.35684 8.90129 8.20042C8.96645 8.04401 9 7.87623 9 7.70679C9 7.53734 8.96645 7.36956 8.90129 7.21315C8.83612 7.05673 8.74062 6.91476 8.62032 6.79544Z"
                                fill="var(--main)" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="mg_cardslider_row">
                <?php
                if (isset($movies_by_type['series']) && !empty($movies_by_type['series'])) {
                    foreach ($movies_by_type['series'] as $data) {
                        echo card($data, $image_starter);
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- ანიმაციები -->
    <div class="container">
        <div class="mg_cardslider">
            <div class="mg_cardslider_info">
                <div class="mg_cardslider_start">
                    ანიმაციები
                </div>
                <div class="mg_cardslider_end">
                    <div class="mg_cardslider_button cnt mg_cardslider_left">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.379685 8.62033L6.79762 15.0383C6.9173 15.158 7.05938 15.2529 7.21575 15.3177C7.37212 15.3824 7.53972 15.4158 7.70897 15.4158C8.05079 15.4158 8.37861 15.28 8.62032 15.0383C8.74 14.9186 8.83493 14.7765 8.8997 14.6201C8.96447 14.4638 8.99781 14.2962 8.99781 14.1269C8.99781 13.7851 8.86202 13.4573 8.62032 13.2156L3.10089 7.70899L8.62032 2.20239C8.74063 2.08306 8.83612 1.9411 8.90128 1.78468C8.96645 1.62826 9 1.46049 9 1.29104C9 1.12159 8.96645 0.953821 8.90128 0.797404C8.83612 0.640987 8.74063 0.499022 8.62032 0.379696C8.50099 0.259387 8.35902 0.163893 8.20261 0.0987262C8.04619 0.0335607 7.87842 1.14093e-05 7.70897 1.14093e-05C7.53952 1.14093e-05 7.37175 0.0335607 7.21533 0.0987262C7.05891 0.163893 6.91695 0.259387 6.79762 0.379696L0.379685 6.79764C0.259376 6.91697 0.163882 7.05893 0.0987154 7.21535C0.0335498 7.37177 5.36442e-07 7.53954 5.36442e-07 7.70899C5.36442e-07 7.87844 0.0335498 8.04621 0.0987154 8.20262C0.163882 8.35904 0.259376 8.50101 0.379685 8.62033Z"
                                fill="var(--main)" />
                        </svg>
                    </div>
                    <div class="mg_cardslider_button cnt mg_cardslider_right">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.62032 6.79544L2.20238 0.377493C2.0827 0.257813 1.94062 0.162878 1.78425 0.0981076C1.62788 0.0333372 1.46028 0 1.29103 0C0.94921 0 0.621387 0.135788 0.379683 0.377493C0.260003 0.497173 0.165067 0.639254 0.100297 0.795623C0.0355269 0.951992 0.00219149 1.11959 0.00219149 1.28884C0.00219149 1.63066 0.137979 1.95848 0.379683 2.20019L5.89911 7.70679L0.379683 13.2134C0.259374 13.3327 0.163883 13.4747 0.0987171 13.6311C0.033551 13.7875 0 13.9553 0 14.1247C0 14.2942 0.033551 14.462 0.0987171 14.6184C0.163883 14.7748 0.259374 14.9167 0.379683 15.0361C0.499009 15.1564 0.640976 15.2519 0.797393 15.317C0.95381 15.3822 1.12158 15.4158 1.29103 15.4158C1.46048 15.4158 1.62825 15.3822 1.78467 15.317C1.94109 15.2519 2.08305 15.1564 2.20238 15.0361L8.62032 8.61813C8.74062 8.49881 8.83612 8.35684 8.90129 8.20042C8.96645 8.04401 9 7.87623 9 7.70679C9 7.53734 8.96645 7.36956 8.90129 7.21315C8.83612 7.05673 8.74062 6.91476 8.62032 6.79544Z"
                                fill="var(--main)" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="mg_cardslider_row">
                <?php
                if (isset($movies_by_type['animations']) && !empty($movies_by_type['animations'])) {
                    foreach ($movies_by_type['animations'] as $data) {
                        echo card($data, $image_starter);
                    }
                }
                ?>
            </div>
        </div>
    </div>



    <?php include_once "../components/footer.php" ?>
    <?php include_once "../components/endpage.php" ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="module" src="../ui/mg_engine.js"></script>
    <script src="../assets/engines/nav.js"></script>
    <script src="../assets/engines/home.js"></script>
    <script src="../assets/engines/mg_cardslider_wide.js"></script>
    <script src="../assets/engines/mg_cardslider.js"></script>
    <script src="../assets/engines/card.js"></script>
</body>

</html>