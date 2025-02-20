<?php
include_once "../server/connection.php";
include_once "../components/card.php";
ini_set('memory_limit', '512M');
if ($_GET["id"]) {
    include_once "../server/actions/save_history.php";
    $stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
    $stmt->bind_param("i", $_GET["id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows != 1) {

        header("Location: ./");
        exit;
    }

    $movie = $result->fetch_assoc();

    $players = json_decode($movie["players"], true);
    $genresget = json_decode($movie["genres"], true);

    $genres = is_array($genresget) ? implode(", ", $genresget) : "No genres available";

    $stmt_hearts = $conn->prepare("SELECT COUNT(*) as total_likes FROM movie_likes WHERE movie_id = ?");
    $stmt_hearts->bind_param("i", $_GET["id"]);
    $stmt_hearts->execute();
    $result = $stmt_hearts->get_result();
    $hearts_result = $result->fetch_assoc();
    $hearts = $hearts_result["total_likes"];
    if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == true) {

        $stmt_isliked = $conn->prepare("SELECT * FROM movie_likes WHERE movie_id = ? AND user_id = ?");
        $stmt_isliked->bind_param("ii", $_GET["id"], $_SESSION['user_id']);  // Bind movie_id and user_id as integers
        $stmt_isliked->execute();
        $userResult = $stmt_isliked->get_result();

        $user_liked = $userResult->num_rows > 0;
    } else {
        $user_liked = 0;
    }
    $same_movies = mysqli_query($conn, "SELECT * FROM movies");

    $is_movie = true;

    foreach ($players as $player) {
        if (is_array($player)) {
            foreach ($player as $seasons) {
                if (is_array($seasons)) {
                    foreach ($seasons as $episodes) {
                        if (is_array($episodes)) {
                            $is_movie = false;
                            break 3;
                        }
                    }
                }
            }
        }
    }
    function getNestedValue($array, $keys, $default = null)
    {
        $current = $array;
        foreach ($keys as $key) {
            if (!isset($current[$key])) {
                return $default;
            }
            $current = $current[$key];
        }
        return $current;
    }
    if ($is_movie) {
        $first_geo_src = getNestedValue($players, ['1', 'GEO', "HD"]);
        $first_eng_src = getNestedValue($players, ['1', 'ENG', "HD"]);
    } else {
        $first_geo_src = getNestedValue($players, [1, 1, 0, 'languages', 'GEO', 'HD']);
        $first_eng_src = getNestedValue($players, [1, 1, 0, 'languages', 'ENG', 'HD']);
    }
} else {
    header("Location: http://localhost/MoviesGoV2/pages/");
    exit();
}
?>



<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $movie['name'] . " - MoviesGo" ?></title>

    <link rel="stylesheet" href="../assets/css/components/colors.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/pages/watch/watch.css" />
    <link rel="stylesheet" href="../assets/css/mg_player.css" />
    <link rel="stylesheet" href="../assets/css/player/series_selector.css" />
    <link rel="stylesheet" href="../assets/css/components/nav.css" />
    <link rel="stylesheet" href="../assets/css/components/card.css" />
    <link rel="stylesheet" href="../assets/css/components/mg_cardslider.css" />
</head>

<body>
    <?php
    include_once "../components/nav.php";
    ?>
    <div class="watch_bg cnt">
        <img src="<?php echo $image_starter . $movie['thumbnail_url'] ?>"
            alt="<?php echo $movie['name_eng'] ?> thumbnail" />
        <div class="watch_bg_shadow"></div>
    </div>
    <div class="container cnt watch_block">
        <div class="watch_place">


            <?php
            $firstRend = true;
            $players_length = count($players);

            if ($is_movie) {
                for ($i = 1; $i <= $players_length; $i++) {
                    if (!empty($players[$i]) && is_array($players[$i])) {
                        if ($i == 1) {
                            if ($first_geo_src || $first_eng_src) {
                                echo '<div data-player="' . $i . '" class="mg_player player_box video_players"></div>';
                                $firstRend = true;
                            } elseif (!empty($players[$i]["GEO"]["HD"])) {
                                echo '<div data-player="' . $i . '" class="iframe_players player_box iframe_player_box">
                                  <iframe sandbox="allow-scripts allow-same-origin" data-player="' . $i . '" 
                                      class="iframe_players video_players" 
                                      src="' . htmlspecialchars($players[$i]["GEO"]["HD"], ENT_QUOTES, 'UTF-8') . '" 
                                      frameborder="0" allowfullscreen>
                                  </iframe>
                              </div>';
                                $firstRend = true;
                            }
                        } elseif (!$firstRend) {

                            echo '<div data-player="' . $i . '" class="iframe_players player_box iframe_player_box">
                              <iframe sandbox="allow-scripts allow-same-origin" data-player="' . $i . '" 
                                  class="iframe_players video_players" 
                                  src="' . htmlspecialchars($players[$i]["GEO"]["HD"], ENT_QUOTES, 'UTF-8') . '" 
                                  frameborder="0" allowfullscreen>
                              </iframe>
                          </div>';
                            $firstRend = true;
                        } elseif (!empty($players[$i]["GEO"]["HD"])) {
                            echo '<div data-player="' . $i . '" class="iframe_players player_box iframe_player_box hidden_player">
                              <iframe sandbox="allow-scripts allow-same-origin" data-player="' . $i . '" 
                                  class="iframe_players video_players" 
                                  src="' . htmlspecialchars($players[$i]["GEO"]["HD"], ENT_QUOTES, 'UTF-8') . '" 
                                  frameborder="0" allowfullscreen>
                              </iframe>
                          </div>';
                        }
                    }
                }
            } else {

                for ($i = 1; $i <= $players_length; $i++) {
                    if (!empty($players[$i]) && is_array($players[$i])) {
                        $startSeason = $players[$i][array_keys($players[$i])[0]];
                        if ($i == 1) {
                            if ($first_geo_src || $first_eng_src) {
                                echo '<div data-player="' . $i . '" class="mg_player player_box video_players"></div>';
                            } else {

                                echo '<div data-player="' . $i . '" class="iframe_players player_box iframe_player_box">';
                                include "../components/player/series_selector.php";
                                echo '<iframe sandbox="allow-scripts allow-same-origin" class="video_players"
                                  src="' . htmlspecialchars($startSeason[0]["languages"]["GEO"]["HD"] ?? '', ENT_QUOTES, 'UTF-8') . '"
                                  frameborder="0" allowfullscreen></iframe>
                              </div>';
                            }
                            $firstRend = false;
                        } elseif (!empty($startSeason[0]["languages"]["GEO"]["HD"])) {
                            echo '<div data-player="' . $i . '" class="' . ($firstRend ? "" : "hidden_player") . ' iframe_players player_box iframe_player_box">';
                            include "../components/player/series_selector.php";
                            echo '<iframe sandbox="allow-scripts allow-same-origin" class="video_players"
                              src="' . htmlspecialchars($startSeason[0]["languages"]["GEO"]["HD"] ?? '', ENT_QUOTES, 'UTF-8') . '"
                              frameborder="0" allowfullscreen></iframe>
                          </div>';
                            $firstRend = false;
                        }
                    }
                }
            }

            ?>
        </div>
        <div class="watch_logs">
            <div class="players">
                <?php

                $firstRend = true;

                if ($is_movie) {
                    for ($i = 1; $i <= $players_length; $i++) {
                        if (!empty($players[$i]) && is_array($players[$i])) {
                            if ($i == 1) {
                                if ($first_geo_src || $first_eng_src) {
                                    echo '<div data-player-button="' . $i . '" class="cnt players_change_button active_player">ფლეიერი 1</div>';
                                    $firstRend = true;
                                } elseif (!empty($players[$i]["GEO"]["HD"]) || !empty($players[$i]["ENG"]["HD"])) {
                                    echo '<div data-player-button="' . $i . '" class="cnt players_change_button active_player">ფლეიერი ' . $i . '</div>';
                                    $firstRend = true;
                                }
                            } elseif (!$firstRend) {
                                echo '<div data-player-button="' . $i . '" class="cnt players_change_button active_player">ფლეიერი ' . $i . '</div>';
                                $firstRend = true;
                            } elseif (!empty($players[$i]["GEO"]["HD"]) || !empty($players[$i]["ENG"]["HD"])) {
                                echo '<div data-player-button="' . $i . '" class="cnt players_change_button">ფლეიერი ' . $i . '</div>';
                            }
                        }
                    }
                } else {

                    for ($i = 1; $i <= $players_length; $i++) {
                        if (!empty($players[$i]) && is_array($players[$i])) {
                            $startSeason = $players[$i][array_keys($players[$i])[0]];
                            if ($i == 1) {
                                if ($first_geo_src || $first_eng_src) {
                                    echo '<div data-player-button="' . $i . '" class="cnt players_change_button active_player">ფლეიერი 1</div>';
                                } else {

                                    echo '<div data-player-button="' . $i . '" class="cnt players_change_button active_player">ფლეიერი ' . $i . '</div>';
                                }
                                $firstRend = false;
                            } elseif (!empty($startSeason[0]['languages']['GEO']['HD'])) {

                                echo '<div data-player-button="' . $i . '" class="cnt players_change_button ' . ($firstRend ? "active_player" : "") . '">ფლეიერი ' . $i . '</div>';
                                $firstRend = false;
                            }
                        }
                    }
                }

                ?>
            </div>
            <div class="movie_actions">
                <div class="movie_l_info">
                    <div class="movie_views">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                            <path fill="var(--iconlower)"
                                d="M21.92 11.6C19.9 6.91 16.1 4 12 4s-7.9 2.91-9.92 7.6a1 1 0 0 0 0 .8C4.1 17.09 7.9 20 12 20s7.9-2.91 9.92-7.6a1 1 0 0 0 0-.8ZM12 18c-3.17 0-6.17-2.29-7.9-6C5.83 8.29 8.83 6 12 6s6.17 2.29 7.9 6c-1.73 3.71-4.73 6-7.9 6Zm0-10a4 4 0 1 0 4 4a4 4 0 0 0-4-4Zm0 6a2 2 0 1 1 2-2a2 2 0 0 1-2 2Z" />
                        </svg>

                        <p><?php echo $movie['views'] ?></p>
                    </div>
                    <div class="movie_hearts">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M1.633 2.79602C2.395 1.95902 3.483 1.49902 4.76 1.49902C5.924 1.49902 7.167 2.04902 8 3.12502C8.828 2.05002 10.066 1.49902 11.24 1.49902C12.514 1.49902 13.6 1.95702 14.364 2.79202C15.12 3.62002 15.5 4.75402 15.5 6.01202C15.5 8.17802 14.387 9.92102 12.978 11.276C11.573 12.628 9.808 13.659 8.345 14.416C8.23784 14.4715 8.1189 14.5002 7.99826 14.4999C7.87761 14.4995 7.75883 14.4701 7.652 14.414C6.189 13.649 4.424 12.626 3.019 11.281C1.61 9.93002 0.5 8.19302 0.5 6.01302C0.5 4.75802 0.878 3.62402 1.633 2.79602ZM2.742 3.80602C2.287 4.30602 2 5.05302 2 6.01302C2 7.63702 2.816 9.00902 4.057 10.197C5.203 11.295 6.657 12.182 8.002 12.902C9.337 12.192 10.792 11.298 11.939 10.195C13.182 8.99802 14 7.62002 14 6.01302C14 5.05002 13.712 4.30302 13.256 3.80302C12.808 3.31402 12.14 3.00002 11.24 3.00002C10.264 3.00002 9.147 3.62802 8.713 4.95002C8.66392 5.10044 8.56852 5.23148 8.44046 5.3244C8.31239 5.41732 8.15822 5.46736 8 5.46736C7.84178 5.46736 7.68761 5.41732 7.55954 5.3244C7.43148 5.23148 7.33608 5.10044 7.287 4.95002C6.854 3.63002 5.725 3.00002 4.76 3.00002C3.857 3.00002 3.19 3.31402 2.742 3.80602Z"
                                fill="var(--main)" />
                            <path
                                d="M8.00023 4.99998C8.83356 2.99998 12 2 14 4.5C16.9141 8.14257 10.8336 11.6667 8.00023 13C5.50023 12.1667 0.800228 9.50001 2.00023 5.50001C3.20023 1.50001 6.50023 3.49999 8.00023 4.99998Z"
                                fill="var(--main)" stroke="var(--main)" />
                        </svg>

                        <p class="movie_love_counter"><?php echo $hearts ?></p>
                    </div>
                </div>
                <div data-movie="<?php echo $movie['id'] ?>"
                    class="movie_love <?php echo $user_liked ? "movie_love_active" : "" ?> movie_action_button cnt">
                    <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.04125 3.49503C2.99375 2.44878 4.35375 1.87378 5.95 1.87378C7.405 1.87378 8.95875 2.56128 10 3.90628C11.035 2.56253 12.5825 1.87378 14.05 1.87378C15.6425 1.87378 17 2.44628 17.955 3.49003C18.9 4.52503 19.375 5.94253 19.375 7.51503C19.375 10.2225 17.9837 12.4013 16.2225 14.095C14.4662 15.785 12.26 17.0738 10.4313 18.02C10.2973 18.0893 10.1486 18.1253 9.99782 18.1248C9.84702 18.1244 9.69854 18.0876 9.565 18.0175C7.73625 17.0613 5.53 15.7825 3.77375 14.1013C2.0125 12.4125 0.625 10.2413 0.625 7.51628C0.625 5.94753 1.0975 4.53003 2.04125 3.49503ZM3.4275 4.75753C2.85875 5.38253 2.5 6.31628 2.5 7.51628C2.5 9.54628 3.52 11.2613 5.07125 12.7463C6.50375 14.1188 8.32125 15.2275 10.0025 16.1275C11.6712 15.24 13.49 14.1225 14.9237 12.7438C16.4775 11.2475 17.5 9.52503 17.5 7.51628C17.5 6.31253 17.14 5.37878 16.57 4.75378C16.01 4.14253 15.175 3.75003 14.05 3.75003C12.83 3.75003 11.4338 4.53503 10.8913 6.18753C10.8299 6.37555 10.7107 6.53935 10.5506 6.6555C10.3905 6.77165 10.1978 6.8342 10 6.8342C9.80222 6.8342 9.60951 6.77165 9.44943 6.6555C9.28935 6.53935 9.1701 6.37555 9.10875 6.18753C8.5675 4.53753 7.15625 3.75003 5.95 3.75003C4.82125 3.75003 3.9875 4.14253 3.4275 4.75753Z"
                            fill="var(--iconlow)" />
                    </svg>
                </div>
                <div data-movie="<?php echo $movie['id'] ?>"
                    class="movie_bookmark <?php echo is_bookmark_exists($movie['id']) ? "bookmarked" : "" ?> movie_action_button cnt">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="none" stroke="var(--iconlow)" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M16 3H8a2 2 0 0 0-2 2v16l6-3l6 3V5a2 2 0 0 0-2-2Z" />
                    </svg>

                </div>
                <div class="movie_share movie_action_button cnt">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="none" stroke="var(--iconlow)" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 1 1 0-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 1 0 5.367-2.684a3 3 0 0 0-5.367 2.684Zm0 9.316a3 3 0 1 0 5.368 2.684a3 3 0 0 0-5.368-2.684Z" />
                    </svg>
                </div>
                <div class="movie_error_button movie_action_button cnt">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M8.429 2.746a.5.5 0 0 0-.858 0L1.58 12.743a.5.5 0 0 0 .429.757h11.984a.5.5 0 0 0 .43-.757L8.428 2.746Zm-2.144-.77C7.06.68 8.939.68 9.715 1.975l5.993 9.996c.799 1.333-.161 3.028-1.716 3.028H2.008C.453 15-.507 13.305.292 11.972l5.993-9.997ZM9 11.5a1 1 0 1 1-2 0a1 1 0 0 1 2 0Zm-.25-5.75a.75.75 0 0 0-1.5 0v3a.75.75 0 0 0 1.5 0v-3Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="movie_info">
            <div class="movie_poster">
                <img src="<?php echo $image_starter . $movie['poster_url'] ?>"
                    alt="<?php echo $movie['name_eng'] ?> poster" />
            </div>
            <div class="movie_card_info">
                <div class="movie_card_start">
                    <div class="movie_card_subtitle"><?php echo $movie['subtitle'] ?></div>
                    <div class="movie_card_title"><?php echo $movie['name_eng'] ?></div>
                    <div class="movie_card_imdb">IMDB: <?php echo $movie['imdb'] ?></div>

                </div>
                <div class="movie_card_end">
                    <div class="movie_card_addons">
                        <div class="movie_card_addon"><span>წელი:</span> <?php echo $movie['year'] ?></div>

                        <div class="movie_card_addon">
                            <span>ჟანრები:</span> <?php echo $genres ?>
                        </div>
                        <div class="movie_card_addon">
                            <span>რეჟისორი:</span> <?php echo $movie['creator'] ?>
                        </div>
                        <div class="movie_card_addon for_pc">
                            <span>როლებში:</span> <?php echo $movie['actors'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (is_logged() && $_SESSION['status'] == $admin_status) {

        ?>
        <div class="adm_in">
            <p class="">ადმინისტრატორის სივრცე</p>
            <div class="row">
                <a href="updatemovie?id=<?php echo $movie['id']; ?>"><button class="dbts">რედაქტირება</button></a>
                <button id="delete_movie" class="dbt">წაშლა</button>
            </div>
        </div>
        <?php
        }

        ?>


        <div class="movie_description">

            <h3>მოკლე სიუჟეტი:</h3>
            <p>
                <?php echo $movie['description'] ?>
            </p>
        </div>

        <?php
        include_once "../components/comments.php";
        ?>
        <div class="mg_cardslider">
            <div class="mg_cardslider_info">
                <div class="mg_cardslider_start">მსგავსი ფილმები:</div>
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
                while ($data = mysqli_fetch_assoc($same_movies)) {
                    echo card($data, $image_starter);
                }
                ?>
            </div>
        </div>
    </div>
    <?php include_once "../components/footer.php" ?>
    <?php include_once "../components/endpage.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <?php
    if ($is_movie) {
    ?>
    <script>
    let IFRAME_PLAYERS = null
    </script>

    <?php
    } else {
    ?>
    <script>
    IFRAME_PLAYERS = {
        PLAYER_ID: <?php echo $movie['id'] ?>,
        PLAYERS: <?php echo json_encode($players, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>,
    }
    </script>
    <?php
    }
    ?>
    <?php if ($first_geo_src || $first_eng_src): ?>
    <script>
    let MG_PLAYER = {
        type: "<?php echo $is_movie ? 'MOVIE' : 'SERIES'; ?>",
        id: "<?php echo htmlspecialchars($movie['id'], ENT_QUOTES, 'UTF-8'); ?>",
        image: "<?php echo htmlspecialchars($image_starter . $movie['thumbnail_url'], ENT_QUOTES, 'UTF-8'); ?>",
        languages: {},
        <?php if (!$is_movie && isset($players[1])): ?>
        seasons: <?php echo json_encode($players[1], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
        <?php endif; ?>
    };
    <?php if ($first_geo_src): ?>
    MG_PLAYER.languages["GEO"] = {
        HD: "<?php echo $first_geo_src; ?>",
    };
    <?php endif; ?>
    <?php if ($first_eng_src): ?>
    MG_PLAYER.languages["ENG"] = {
        HD: "<?php echo $first_eng_src; ?>",
    };
    <?php endif; ?>
    </script>
    <script type="module" src="../assets/engines/MGVIDEOPLAYERMINIFIED.js"></script>
    <?php endif; ?>

    <?php

    include_once "../components/iframe_adblocks.php"

    ?>
    <?php
    if (is_logged() && $_SESSION['status'] == $admin_status) {

    ?>

    <script>
    $("#delete_movie").click(() => {
        if (confirm("ნამდვილად გსურს ფილმის წაშლა?")) {
            $.ajax({
                url: server_start + "movie_delete.php",
                type: "POST",
                data: {
                    movie_id: <?php echo $movie['id'] ?>
                },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status == 100) {
                        alert("წაიშალა");
                        window.location.reload()
                    } else {
                        alert(JSON.stringify(data));

                    }
                }
            })
        }
    })
    </script>
    <?php


    }

    ?>
    <script>
    $(".players_change_button").click(function() {
        if (!$(this).hasClass("active_player")) {

            let player_id = $(this).attr("data-player-button");

            $(".player_box").addClass("hidden_player");
            $("video").each(function() {
                this.pause();
            });

            $(' .player_box[data-player="' + player_id + '" ]').removeClass("hidden_player");
            $(".players_change_button").removeClass("active_player");
            $(this).addClass("active_player");
        }
    });
    $(".movie_love").click(() => {
        if ($(".movie_love").hasClass("movie_love_active")) {
            $(".movie_love").removeClass("movie_love_active");
            let currentCount = parseInt($(".movie_love_counter").text());
            $(".movie_love_counter").text(currentCount - 1);
        } else {
            $(".movie_love").addClass("movie_love_active");
            let currentCount = parseInt($(".movie_love_counter").text());
            $(".movie_love_counter").text(currentCount + 1);
        }
        $.post(server_start_local + "movie/like.php", {
            movie_id: $(".movie_love").attr("data-movie")
        })
    });
    </script>
    <script type="module" src="../ui/mg_engine.js"></script>
    <script src="../assets/engines/nav.js"></script>
    <script src="../assets/engines/iframe_players.js"></script>
    <script src="../assets/engines/card.js"></script>
    <script src="../assets/engines/mg_cardslider.js"></script>
</body>

</html>