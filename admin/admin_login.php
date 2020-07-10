<?php

include('../crud/middleware/database.php');
include('../crud/middleware/sanitize.php');

$conn = database();

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    /* Show Admin Login Page */

}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($email) && !empty($password)) {
        $sql = "select * from administrator where email = '$email'";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($row['password'] == $password) {
                        $_SESSION['admin_id'] = $row['id'];
                        print("Admin successfully logged in!");
                        header('Location: http://localhost/tmam/admin/dashboard.php');
                    } else {
                        print("password doesnot match");
                    }
                }
            } else {
                print("Admin not found");
            }
        } else {
            print("Some fields missing");
        }
}


?>