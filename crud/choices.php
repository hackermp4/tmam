<?php


include('middleware/database.php');
include('middleware/sanitize.php');

$conn = database();

function choice($question_id) {
    global $conn;
    $sql = "select id, option_no, choice from choices where question_id = $question_id";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_all(MYSQLI_ASSOC);
        return $row;
    }
}

if(isset($_GET['question_id'])) {
    $question_id = sanitize($_GET['question_id']);
    choice($question_id);
}




?>