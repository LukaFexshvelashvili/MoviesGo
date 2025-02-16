<?php

function update_to_db( $conn, $watch_history, $user_id ) {
    $update_query = "UPDATE users SET watch_history = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $watch_history, $user_id);
    $stmt->execute();
    $stmt->close();
}
function add_history($conn, $id) {
    if (!isset($_SESSION['watch_history'])) {
        $_SESSION['watch_history'] = [];
    }

    $maxLength = 10;
    $saved_history = $_SESSION['watch_history'];

    if (!in_array($id, $saved_history)) {
        array_unshift($saved_history, $id); 
        
        if (count($saved_history) > $maxLength) {
            $saved_history = array_slice($saved_history, 0, $maxLength);
        }
        $_SESSION['watch_history'] = $saved_history; 
    } else {
        $index = array_search($id, $saved_history);
        unset($saved_history[$index]);
        array_unshift($saved_history, $id);
        $_SESSION['watch_history'] = $saved_history; 

    }
    if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == true && isset($_SESSION['user_id'])){
        $updated_history_json = json_encode($_SESSION['watch_history']);
        update_to_db($conn, $updated_history_json, $_SESSION['user_id']);
    }

}

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
     add_history($conn, $id);
}

?>