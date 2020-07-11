<?php

/* Admin seassion check */
session_start();
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
}

include('../crud/middleware/database.php');
include('../crud/middleware/sanitize.php');

$conn = database();

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "select * from administrator where type='admin'";
    $result = $conn->query($sql) or die($conn->error);
    if($result->num_rows > 0) {
        $data = [];
        while($row=$result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    /* Displaying all admin of type admin, not superadmin. superadmin is hidden and only one accout */
    foreach($data as $item) {
        print($item['full_name']);
        print($item['email']);
    }

}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = sanitize($_POST['full_name']);
    $email = sanitize($_POST['email']);
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    if(!empty($email) && !empty($password1) && !empty($password2)) {
        if($password1 == $password2) {
            $sql = "select id from administrator where email = '$email'";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                print("User already registered with this email!");
            } else {
                $sql = "insert into administrator (full_name, email, password, type) values('$full_name', '$email', '$password1', 'admin')";
                $result = $conn->query($sql) or die($conn->error);
                print("Admin successfully registered");
            }
        } else {
            print("Two password does not matched!");
        }
    }
}


?>