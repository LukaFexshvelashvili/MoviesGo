<?php
include_once "../connection.php";
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['comment_input']) && isset($_POST['movie_id'])  && isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == true && isset($_SESSION['user_id'])){
    $reply_id = isset($_POST['reply_id']) && !empty($_POST['reply_id']) ? $_POST['reply_id'] : NULL;
    $stmt = $conn->prepare("INSERT INTO comments (user_id, movie_id, reply_id, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $_SESSION['user_id'], $_POST['movie_id'], $reply_id, $_POST['comment_input']);
    $stmt->execute();
    $stmt->close();
    echo json_encode(array('status'=> 100,'message'=> 'comment uploaded'));

}else{
    echo json_encode(array('status'=> 0,'message'=> 'no enough info'));
}