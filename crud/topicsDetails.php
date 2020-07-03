<?php


include('middleware/database.php');
include('middleware/sanitize.php');

$conn = database();

function topicsDetails($topics_id) {
    global $conn;
    $sql = "select id, content from topics where id = $topics_id"; /* query: retrive one topics details */
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_all(MYSQLI_ASSOC);
        return $row;
    }
}

if(isset($_GET['topics_id'])) {
    $topics_id = sanitize($_GET['topics_id']);
    topicsDetails($topics_id);
}


?>