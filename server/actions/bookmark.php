<?php
include_once "../connection.php";

function update_to_db( $conn, $bookmarks, $user_id ) {
    $update_query = "UPDATE users SET bookmarks = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $bookmarks, $user_id);
    $stmt->execute();
    $stmt->close();
}
function toggle_bookmark($conn, $id) {
    if (!isset($_SESSION['bookmarks'])) {
        $_SESSION['bookmarks'] = [];
    }

    $maxLength = 20;
    $saved_bookmarks = $_SESSION['bookmarks'];

    if (!in_array($id, $saved_bookmarks)) {
        array_unshift($saved_bookmarks, $id); 
        
        if (count($saved_bookmarks) > $maxLength) {
            $saved_bookmarks = array_slice($saved_bookmarks, 0, $maxLength);
        }
        $_SESSION['bookmarks'] = $saved_bookmarks; 
    } else {
        $_SESSION['bookmarks'] = array_values(array_diff($saved_bookmarks, [$id]));
    }
    if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == true && isset($_SESSION['user_id'])){
        $updated_bookmarks_json = json_encode($_SESSION['bookmarks']);
        update_to_db($conn, $updated_bookmarks_json, $_SESSION['user_id']);
    }

}

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    echo toggle_bookmark($conn, $id);
}

?>