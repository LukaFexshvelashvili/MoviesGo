<?php
include_once "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status'])) {
    $status = $_POST['status'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $user_id = NULL;
    


    function IdentifierStrRandom($length = 10) {
        // Define the characters to choose from
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        // Generate a random string
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        
        return $randomString;
    }

    

    if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == true){
        $user_id = $_SESSION['user_id'];
    }
    if(isset($_SESSION['device_identifier'])){
        $ip_address = $_SERVER['REMOTE_ADDR']."/".$_SESSION['device_identifier'];
    }else{
        $_SESSION['device_identifier'] = IdentifierStrRandom(16);
        $ip_address = $_SERVER['REMOTE_ADDR']."/".$_SESSION['device_identifier'];
    }
    if ($status === "enter") {
        $stmt = $conn->prepare("INSERT INTO sessions (ip_address, user_id, user_agent, is_active, create_date, last_active) 
            VALUES (?, ?, ?, TRUE, NOW(), NOW())
            ON DUPLICATE KEY UPDATE is_active = TRUE, last_active = NOW()
        ");
        $stmt->bind_param("sss", $ip_address, $user_id,  $user_agent);
        $stmt->execute();
    
    } else if ($status === "leave") {
        $stmt = $conn->prepare("UPDATE sessions SET is_active = FALSE WHERE ip_address = ?");
    $stmt->bind_param("s",$ip_address);
    $stmt->execute();
    }
    echo json_encode(["status" => 1, "message" => "Session updated successfully."]);

} else {
    echo json_encode(["status" => 0, "message" => "Invalid request."]);
}

?>