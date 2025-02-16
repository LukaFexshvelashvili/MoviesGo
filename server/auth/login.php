<?php
include_once "../connection.php";
include_once "../user/set_user.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];

    if (empty($nickname) || empty($password)) {
        echo json_encode(["status" => 0, "message" => "nickname and password are required."]);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE nickname = ? AND password = ?");
    $stmt->bind_param("ss", $nickname, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
            echo json_encode(["status" => 100, "message" => "Login successful", ]);
            set_user($user);
       
    } else {
        echo json_encode(["status" => 0, "message" => "User not found."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => 0, "message" => "Invalid request."]);
}

?>