<?php

include_once "../connection.php";
include_once "../user/set_user.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['nickname'] && $_POST['email'] && $_POST['password']) {
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $ui_settings = isset($_POST['ui_settings']) ? json_encode($_POST['ui_settings']) : null;
    $watch_history = isset($_POST['watch_history']) ? json_encode($_POST['watch_history']) : null;
    $bookmarks = isset($_POST['bookmarks']) ? json_encode($_POST['bookmarks']) : null;

    $stmtCheckMail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmtCheckMail->bind_param("s",  $email);
    $stmtCheckMail->execute();
    $stmtCheckMail->store_result();

    if ($stmtCheckMail->num_rows > 0) {
        echo json_encode(["status" => 3, "message" => "Email already exists."]);
        $stmtCheckMail->close();
        $conn->close();
        exit; 
    }
    $stmtCheckNick = $conn->prepare("SELECT id FROM users WHERE nickname = ? ");
    $stmtCheckNick->bind_param("s", $nickname);
    $stmtCheckNick->execute();
    $stmtCheckNick->store_result();

    if ($stmtCheckNick->num_rows > 0) {
        echo json_encode(["status" => 4, "message" => "Nickname already exists."]);
        $stmtCheckNick->close();
        $conn->close();
        exit; 
    }

    $hashedPassword = $password;

    $stmt = $conn->prepare("INSERT INTO users (nickname, email, password, status, role, ui_settings, watch_history, bookmarks, create_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $status = 1;  
    $role = 1;   
    $createDate = date("Y-m-d H:i:s"); 
    
    $stmt->bind_param("sssiissss", $nickname, $email, $hashedPassword, $status, $role, $ui_settings, $watch_history, $bookmarks, $createDate);
    
    if ($stmt->execute()) {
       
        echo json_encode(["status" => 100, "message" => "User registered successfully!"]);

        // GET USER DATA AND SAVE IN SESSION
        $inserted_id = $conn->insert_id;
        $result = $conn->query("SELECT * FROM users WHERE id = $inserted_id");
        $data = $result->fetch_assoc();
        set_user($data);
    } else {
        echo json_encode(["status" => 2, "message" => "Error: " . $stmt->error]);
    }
    
    $stmt->close();
    $conn->close();
}else{
    echo json_encode(["status" => 0, "message" => "Not enough information"]);

}
?>