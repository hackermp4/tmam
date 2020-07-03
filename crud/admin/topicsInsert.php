<?php

require_once('../crud/middleware/database.php');
require_once('../crud/middleware/sanitize.php');
$conn = database();

function topicsInsert($title, $content) {
    global $conn;
    $sql = "insert into topics (title, content) values ('$title', '$content')";
    $result = $conn->query($sql) or die($conn->error);
    return header('Location: topics.php');
    header('Location: topics.php');
}

function topicsUpdate($id, $title, $content) {
    global $conn;
    $sql = "update topics set title = '$title', content = '$content' where id = $id";
    $result = $conn->query($sql) or die($conn->error);
    header('Location: topics.php');
}

function displayTopics($id) {
    global $conn;
    $sql = "select id, title, content from topics where id = $id";
    $result = $conn->query($sql);
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

function deleteTopics($id) {
    global $conn;
    $sql = "delete from topics where id = $id";
    $conn->query($sql) or die($conn->error);
    header('Location: topics.php');
}


if(isset($_POST['title']) && isset($_POST['contents']) && !isset($_POST['id'])) {
    topicsInsert($conn->real_escape_string($_POST['title']), $conn->real_escape_string($_POST['contents']));
}
elseif (isset($_POST['title']) && isset($_POST['contents']) && isset($_POST['id'])) {
    topicsUpdate($conn->real_escape_string($_POST['id']), $conn->real_escape_string($_POST['title']), $conn->real_escape_string($_POST['contents']));
}
elseif (isset($_POST['id'])) {
    displayTopics($conn->real_escape_string($_POST['id']));
}
elseif (isset($_GET['delete'])) {
    deleteTopics($conn->real_escape_string($_GET['delete']));
}
else {

}


?>