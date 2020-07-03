<?php


include('middleware/database.php');

$conn = database();

function processAnswer() {
    global $conn;
    $sql = "select id, question from questions order by id desc";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_all(MYSQLI_ASSOC);
        return $row;
    }
}

if(isset($_POST['$paper'])) {
    // under construction
}


?>