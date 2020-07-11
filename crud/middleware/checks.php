<?php


require_once('database.php');
$conn = database();

function check_required($vars, $url) {
    foreach($vars as $var) {
        if(isset($_POST[$var]) && empty($_POST[$var])) {
            header("Location: $url");
        }
    }
}

function is_verified($url) {
    global $conn;
    $id = $_SESSION['examinee_id'];
    $sql = "select is_verified from examinee where id = '$id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['is_verified'] == 0) {
                $_SESSION["messages"] = "You are not verified yet!, Please wait untill an Admin verify you.";
                header("Location: $url"); // Redirect because unverified
            }
        }
    }
}

function set_check($var) {
    if(isset($var) && $var != '') {
        return "'$var'";
    } else {
        return 'NULL';
    }
}


?>