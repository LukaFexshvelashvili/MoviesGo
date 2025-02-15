<?php
if (!function_exists('get_movie_type')) {
    function get_movie_type($type) {
        switch ($type) {
            case 0:
                return "ფილმი";
            case 1:
                return "სერიალი";
            case 2:
                return "ანიმაცია";
            case 3:
                return "ანიმე";
            default:
                return "NULL";
        }
    }
}