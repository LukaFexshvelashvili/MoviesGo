<?php

include_once "../connection.php"; 

if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == true && isset($_SESSION['user_id']) && isset($_POST['movie_id'])) {
    $user_id = $_SESSION['user_id'];
    $movie_id = $_POST['movie_id'];

    $stmt = $conn->prepare("SELECT * FROM movie_likes WHERE movie_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $movie_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("DELETE FROM movie_likes WHERE movie_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $movie_id, $user_id);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo json_encode(["status" => "success", "message" => "Like removed"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to remove like"]);
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO movie_likes (movie_id, user_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $movie_id, $user_id);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo json_encode(["status" => "success", "message" => "Like added"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to add like"]);
        }
    }
} else {
    echo json_encode(["status" => "error", "message" => "Missing user_id or movie_id"]);
}

?>