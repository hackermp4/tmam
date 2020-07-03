<?php


session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('crud/middleware/checks.php');
    $required = array('first_name', 'email');
    check_required($required, 'register.php'); // possible necessary redirect

    require_once('crud/middleware/database.php');
    $conn = database();

    $first_name = set_check($conn->real_escape_string($_POST['first_name']));
    $last_name = set_check($conn->real_escape_string($_POST['last_name']));
    $email = set_check($conn->real_escape_string($_POST['email']));
    $institution = set_check($conn->real_escape_string($_POST['institution']));
    $initial_training_date = set_check($conn->real_escape_string($_POST['initial_training_date']));
    $refresher_training_date = set_check($conn->real_escape_string($_POST['refresher_training_date']));
    $fibroscan_device_serial_no = set_check($conn->real_escape_string($_POST['fibroscan_device_serial_no']));
    $scan_done = set_check($conn->real_escape_string($_POST['scan_done']));
    $is_verified = 0; // By default unverified

    $sql = "insert into examinee (first_name, last_name, email, institution, initial_training_date, refresher_training_date, fibroscan_device_serial_no, scan_done, is_verified) values ($first_name, $last_name, $email, $institution, $initial_training_date, $refresher_training_date, $fibroscan_device_serial_no, $scan_done, $is_verified)";

    $result = $conn->query($sql);
    if($result) {
        header('Location: topics.php');
    }

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Examinee</title>

    <!-- theme css -->
    <link rel="stylesheet" href="admin/style.css">
</head>
<body class="bg-blue" style="overflow:auto;">

    <div class="login">
        <div class="login-form">
            <h2 class="form-title">Examinee Registration</h2>
            <form action="register.php" method="post">
                <div class="input-items">
                    <label for="first_name">First Name: </label>
                    <input type="text" id="username" name="first_name" placeholder="" required>
                </div>
                <div class="input-items">
                    <label for="last_name">Last Name: </label>
                    <input type="text" id="username" name="last_name" placeholder="">
                </div>
                <div class="input-items">
                    <label for="username">Email: </label>
                    <input type="email" id="username" name="email" placeholder="" required>
                </div>
                <div class="input-items">
                    <label for="institution">Institution: </label>
                    <input type="text" id="username" name="institution" placeholder="">
                </div>
                <div class="input-items">
                    <label for="initial_training_date">Initial Training Date: </label>
                    <input type="date" id="username" name="initial_training_date" placeholder="">
                </div>
                <div class="input-items">
                    <label for="refresher_training_date">Refresher_Training_Date: </label>
                    <input type="date" id="username" name="refresher_training_date" placeholder="">
                </div>
                <div class="input-items">
                    <label for="fibroscan_device_serial_no">Fibroscan Device Serial No: </label>
                    <input type="text" id="username" name="fibroscan_device_serial_no" placeholder="">
                </div>
                <div class="input-items">
                    <label for="scan_done">How Many Scan You Have Done?: </label>
                    <input type="text" id="username" name="scan_done" placeholder="">
                </div>
                <div class="submits">
                    <button class="btn btn-blue">login</button>
                </div>
            </form>
        </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
</body>
</html>