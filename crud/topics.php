<?php


include('middleware/database.php');

$conn = database();

function topics() {
    global $conn;
    $sql = "select * from topics order by id desc"; /* query: retriving topics list */
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