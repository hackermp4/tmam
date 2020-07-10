<?php

include('../crud/middleware/database.php');
include('../crud/middleware/sanitize.php');

$conn = database();

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    /* Show password change field */

}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $admin_id = $_SESSION['admin_id'];
    if(!empty($new_password) && !empty($confirm_password)) {
        if($new_password == $confirm_password) {
            $sql = "select id from administrator where id = '$admin_id' and type = 'admin'";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                $sql = "update administrator set password = '$new_password' where id = '$admin_id'";
                $result = $conn->query($sql) or die($conn->error);
                print("Password Changed!");
            } else {
                print("Admin not found");
            }
        } else {
            print("Two password not matched");
        }
    } else {
        print("Please fillup all data!");
    }
}


?>