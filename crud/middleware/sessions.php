<?php


session_start();

function is_authenticated($url) {
    if(isset($_SESSION['examinee_id'])) {
        return $_SESSION['examinee_id'];
    } else {
        header("Location: $url");
    }
}


?>