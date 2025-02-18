<?php
include_once "../connection.php";
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['comment_id'])&& isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == true && isset($_SESSION['user_id'])){
    $stmt = $conn->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $_POST['comment_id'], $_SESSION['user_id']);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo json_encode(array('status' => 100, 'message' => 'Comment deleted'));
    } else {
        echo json_encode(array('status' => 0, 'message' => 'Comment not found or not owned by user'));
    }
    $stmt->close();

}else{
    echo json_encode(array('status'=> 0,'message'=> 'no enough info'));
}