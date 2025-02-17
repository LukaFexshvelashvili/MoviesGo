<?php
include_once "../connection.php";
include_once "../../components/assets/types.php";
if($_GET["title"]){

    $stmt = $conn->prepare("SELECT * FROM movies WHERE name LIKE ? OR name_eng LIKE ? ORDER BY year DESC LIMIT 4");
    $searchTerm = "%" . $_GET["title"] . "%";  
    $stmt->bind_param("ss", $searchTerm, $searchTerm);  
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
    while ($data = $result->fetch_assoc()) {
     
        echo '  <a href="watch?id='.$data['id'].'" class="mg_nav_card">
                            <div class="mg_nav_image">
                                <img src="'.$image_starter.$data['poster_url'].'" alt="" />
                            </div>
                            <div class="mg_nav_info">
                                <div class="info_top">
                                    <h3>'.$data['name_eng'].'</h3>
                                    <h3>'.$data['name'].'</h3>
                                    <div class="p_info">
                                        <p>წელი: <span>'.$data['year'].'</span></p>
                                        <p>რეჟისორი: <span>'.$data['creator'].'</span></p>
                                        <div class="nav_card_imdb">IMDb: '.$data['imdb'].'</div>
                                    </div>
                                </div>
                                <div class="info_bottom">
                                    <div class="nav_card_type cnt">'.get_movie_type($data['type']).'</div>
                                </div>
                            </div>
                        </a>';
    }


}else{
    echo '<p class="no_results">შედეგი ვერ მოიძებნა</p>';
}
}else{
    echo '<p class="no_results">შედეგი ვერ მოიძებნა</p>';
}