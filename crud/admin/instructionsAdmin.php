<?php


require_once('../crud/middleware/database.php');
$conn = database();

function instructionDisplay() {
    global $conn;
    $sql = "select id, content from instructions";  /* query: retrive instruction */
    $result = $conn->query($sql) or die($conn->error);
    if($result->num_rows > 0) {
        $data = array();
        while($row=$result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}

function instructionInsert($content) {
    global $conn;
    $sql = "insert into instructions (content) values ('$content')";
    $result = $conn->query($sql) or die($conn->error);
    header('Location: dashboard.php');
}

function instructionUpdate($id, $content) {
    global $conn;
    $sql = "update instructions set content = '$content' where id = '$id'";
    $result = $conn->query($sql) or die($conn->error);
    header('Location: dashboard.php');
}

if(isset($_POST['id']) && $_POST['id'] != "" && isset($_POST['content'])) {
    instructionUpdate($conn->real_escape_string($_POST['id']), $conn->real_escape_string($_POST['content']));
}
elseif(isset($_POST['content'])) {
    instructionInsert($conn->real_escape_string($_POST['content']));
}
else {

} 

?>
