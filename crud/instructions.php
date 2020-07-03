<?php


include('middleware/database.php');
$conn = database();

function instructions() {
    global $conn;
    $sql = "select id, content from instructions";  /* query: retrive instruction */
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $data = array();
        while($row=$result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}


?>
