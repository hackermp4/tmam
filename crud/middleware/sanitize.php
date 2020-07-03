<?php


function sanitize($data) {
    $restricted = ["'", "\"", ";", " ", ">", "<", "/", "-"];
    foreach($restricted as $str) {
        $data = str_replace($str, "", $data);
    }
    return $data;
}


?>