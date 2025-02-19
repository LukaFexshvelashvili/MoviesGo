<?php

include_once "../server/connection.php";
include_once "../components/card.php";

if (isset($_SESSION['bookmarks']) && !empty($_SESSION['bookmarks'])) {
    $placeholders = implode(',', array_fill(0, count($_SESSION['bookmarks']), '?'));
    $stmt_movies = $conn->prepare("SELECT id, genres, description, poster_url, thumbnail_url, subtitle, name, name_eng, imdb, type, year, country, creator  FROM movies WHERE id IN ($placeholders)");
    $types = str_repeat('i', count($_SESSION['bookmarks'])); 
    $stmt_movies->bind_param($types, ...$_SESSION['bookmarks']);
    $stmt_movies->execute();
    $bookmarked_movies = $stmt_movies->get_result();
} 
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>ჩანიშნული ფილმები - MoviesGo</title>

    <link rel="stylesheet" href="../assets/css/components/colors.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/pages/watchlater/watchlater.css" />
    <link rel="stylesheet" href="../assets/css/components/nav.css" />
    <link rel="stylesheet" href="../assets/css/components/card.css" />
</head>

<body>

    <?php include_once "../components/nav.php"?>

    <div class="container watchlater_content">
        <h2>ჩანიშნული ფილმები:</h2>
        <div class="card_row">
            <?php 
            if(isset($bookmarked_movies)) {
                while ($movie = $bookmarked_movies->fetch_assoc()) {
                    echo card($movie, $image_starter);
                }
            }else{
                echo '<p class="info_result_desc">ჩანიშნული ფილმები არ არის</p>';
            }
            ?>
        </div>
    </div>
    <?php include_once "../components/footer.php" ?>
    <?php include_once "../components/endpage.php" ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="module" src="../ui/mg_engine.js"></script>
    <script src="../assets/engines/nav.js"></script>
    <script src="../assets/engines/card.js"></script>
</body>

</html>