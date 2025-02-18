<?php

function set_user($data){
if($data['id']){
$_SESSION['is_logged'] = true;
$_SESSION['user_id'] = $data['id'];
$_SESSION['nickname'] = $data['nickname'];
$_SESSION['email'] = $data['email'];
$_SESSION['status'] = $data['status'];
$_SESSION['role'] = $data['role'];
$_SESSION['timespent'] = $data['timespent'];
$_SESSION['coins'] = $data['coins'];
if(isset($_SESSION['bookmarks']) && is_array($_SESSION['bookmarks'])){
 $new_bookmarks = isset($data['bookmarks']) ? json_decode($data['bookmarks']) : []; // Decoding the new bookmarks
 $_SESSION['bookmarks'] = array_unique(array_merge($_SESSION['bookmarks'], $new_bookmarks));
}else{
    $_SESSION['bookmarks'] = json_decode($data['bookmarks']);
}
if(isset($_SESSION['watch_history']) && is_array($_SESSION['watch_history'])){
    $new_watch_history = isset($data['bookmarks']) ? json_decode($data['bookmarks']) : [];; 
    $_SESSION['watch_history'] = array_unique(array_merge($_SESSION['watch_history'], $new_watch_history));
   }else{
       $_SESSION['watch_history'] = isset($data['watch_history']) ? json_decode($data['watch_history']) : [];
   }
$_SESSION['watch_history'] = isset($data['watch_history']) ? json_decode($data['watch_history']) : [];;
$_SESSION['ui_settings'] = isset($data['ui_settings']) ? json_decode($data['ui_settings']) : [];
$_SESSION['notifications'] =isset($data['notifications']) ? json_decode($data['notifications']) : [];;
$_SESSION['create_date'] = $data['create_date'];
}

}

?>