<?php
include_once "../server/connection.php";
include_once "../components/search_card.php";
if(isset($_GET["id"])){
    $user_id = $_GET["id"];
}else if(is_logged()){
    $user_id = $_SESSION["user_id"];
}else{
    header("Location: ./ ");
    exit();
}
    $stmt = $conn->prepare("SELECT id, nickname, status, role, timespent, coins, create_date FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt_likes = $conn->prepare("SELECT movie_id FROM movie_likes WHERE user_id = ?");
    $stmt_likes->bind_param("i", $user_id);
    $stmt_likes->execute();
    $result_likes = $stmt_likes->get_result();
    
    $movie_ids = [];
    while ($row = $result_likes->fetch_assoc()) {
        $movie_ids[] = $row['movie_id'];
    }
    $stmt_likes->close();
    if (!empty($movie_ids)) {
        $placeholders = implode(',', array_fill(0, count($movie_ids), '?'));
        $stmt_movies = $conn->prepare("SELECT id, genres, description, poster_url, thumbnail_url, subtitle, name, name_eng, imdb, type, year, country, creator FROM movies WHERE id IN ($placeholders)");
        $types = str_repeat('i', count($movie_ids)); 
        $stmt_movies->bind_param($types, ...$movie_ids);
        $stmt_movies->execute();
        $liked_movies = $stmt_movies->get_result();
    } 
    
  
?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>მომხმარებელი: <?php echo $user['nickname'] ?>- MoviesGo</title>

    <link rel="stylesheet" href="../assets/css/components/colors.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/pages/profile/profile.css" />
    <link rel="stylesheet" href="../assets/css/components/nav.css" />
    <link rel="stylesheet" href="../assets/css/components/card.css" />
</head>

<body>

    <?php include_once "../components/nav.php"?>

    <div class="container loved_movies">
        <div class="profile">
            <div class="p_starter">
                <div class="c_profile">
                    <div class="cnt c_profile_block">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 21V19C6 17.9391 6.42143 16.9217 7.17157 16.1716C7.92172 15.4214 8.93913 15 10 15H14C15.0609 15 16.0783 15.4214 16.8284 16.1716C17.5786 16.9217 18 17.9391 18 19V21M8 7C8 8.06087 8.42143 9.07828 9.17157 9.82843C9.92172 10.5786 10.9391 11 12 11C13.0609 11 14.0783 10.5786 14.8284 9.82843C15.5786 9.07828 16 8.06087 16 7C16 5.93913 15.5786 4.92172 14.8284 4.17157C14.0783 3.42143 13.0609 3 12 3C10.9391 3 9.92172 3.42143 9.17157 4.17157C8.42143 4.92172 8 5.93913 8 7Z"
                                stroke="white" stroke-opacity="0.9" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="c_profile_name"><?php echo $user['nickname'] ?></div>
                    <?php echo $user['status'] == $admin_status ? '<div class="cnt c_profile_badge dev_badge">დეველოპერი</div>' : "" ?>

                </div>
                <div class="profile_blocks">
                    <div class="profile_block">
                        <p>ვებგვერდზე გატარებული დრო</p>
                        <h3><?php echo $user['timespent'] ?>წთ</h3>
                    </div>
                    <div class="profile_block">
                        <p>კინომოყვარულის ქულა</p>
                        <h3><?php echo $user['coins'] ?></h3>
                    </div>
                    <div class="profile_block">
                        <p>შეფასებული ფილმები</p>
                        <h3><?php echo $result_likes->num_rows ?></h3>
                    </div>
                    <div class="profile_block">
                        <p>ვებგვერდზე მოღვაწეობს</p>
                        <h3><?php echo format_date($user['create_date']) ?> -დან</h3>
                    </div>
                </div>
            </div>
        </div>
        <h2>მოწონებული ფილმები:</h2>
        <div class="card_row">
            <?php 
            if(isset($liked_movies)) {
                while ($movie = $liked_movies->fetch_assoc()) {
                    echo search_card($movie, $image_starter);
                }
            }else{
                echo '<p class="info_result_desc">მოწონებული ფილმები არ არის</p>';
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