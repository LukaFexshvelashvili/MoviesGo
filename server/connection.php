<?php

$servername = 'localhost';
$dbname = 'moviesgo';
$username = 'root';
$password = '';
$conn = new mysqli($servername, $username, $password, $dbname);
$image_starter = "http://localhost/moviesgo/v1/";
$lifetime = 90 * 24 * 60 * 60; 
ini_set('session.gc_maxlifetime', $lifetime);
session_set_cookie_params($lifetime);
session_start();

function is_bookmark_exists($id) {
    if (!isset($_SESSION['bookmarks'])) {
        $_SESSION['bookmarks'] = [];
    }

    return in_array($id, $_SESSION['bookmarks']);
}
function cut_text($string, $length = 12) {
    return mb_strlen($string) > $length ? mb_substr($string, 0, $length) . "..." : $string;
}
function is_logged(){
    if(isset($_SESSION["is_logged"]) && $_SESSION["is_logged"] == true){
        return true;
    }else{
        return false;

    }
}
$admin_status = 10;

// Input date
function format_date($input_date){

$date = new DateTime($input_date);

$georgian_months = [
    1 => 'იან',   
    2 => 'თებ',  
    3 => 'მარ',    
    4 => 'აპრ',    
    5 => 'მაი',    
    6 => 'ივნ',    
    7 => 'ივლ',    
    8 => 'აგვ',   
    9 => 'სექ', 
    10 => 'ოქტ', 
    11 => 'ნოე',  
    12 => 'დეკ'  
];

$month_number = (int)$date->format('n');

$georgian_month = $georgian_months[$month_number];

$formatted_date = $date->format('Y ') . $georgian_month . $date->format(' d');
// $formatted_date = $date->format('Y ') . substr($georgian_month, 0,length: 9) . $date->format(' d');

return $formatted_date; 
}
?>