<?php

include_once "../connection.php"; 

if (isset($_POST['name_eng']) && isset($_POST['year'])) {
    $stmt = $conn->prepare("SELECT id FROM movies WHERE name_eng = ? AND year = ?");
    $stmt->bind_param("ss", $_POST['name_eng'], $_POST['year']);
    $stmt->execute();
    $result = $stmt->get_result();
if( $result->num_rows > 0) {
    echo json_encode(["status" => 100,"exists" => true]);
} else {  
    echo json_encode(["status" => 100,"exists" => false]);

}
}else{
    echo json_encode(["status" => 0,"exists" => true]);

}