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
    $inst_addr = set_check($conn->real_escape_string($_POST['inst_addr']));

    $sql = "insert into examinee (first_name, last_name, email, institution, initial_training_date, refresher_training_date, fibroscan_device_serial_no, scan_done, is_verified, inst_addr) values ($first_name, $last_name, $email, $institution, $initial_training_date, $refresher_training_date, $fibroscan_device_serial_no, $scan_done, $is_verified, $inst_addr)";

    $result = $conn->query($sql);
    if($result) {
        $id = $conn->insert_id;
        $_SESSION['examinee_id'] = $id;
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
        <div class="login-form register-form">
            <div class="form-banner">
                <img src="assets/img/bg/reg.jpeg" alt="">
            </div>
           
            <form action="register.php" method="post">
            <h2 class="form-title" style="text-align: left; margin-top:30px">Examinee Registration</h2>
                <div class="form-row">
                    <div class="input-items">
                        <input type="text" id="username" name="first_name" required placeholder="Firstname" required>
                    </div>
                    <div class="input-items">
                        <input type="text" id="username" name="last_name" placeholder="Lastname" required>
                    </div>
                </div>
                <div class="input-items">
                    <!-- <label for="username">Email: </label> -->
                    <input type="email" id="username" name="email" placeholder="Email" required required>
                </div>
                <div class="input-items">
                    <!-- <label for="institution">Institution: </label> -->
                    <input type="text" id="username" name="institution" placeholder="Name of the Hospital/Institution/Clinic" required>
                </div>
                <div class="input-items">
                    <!-- <label for="institution address">Institution Address: </label> -->
                    <input type="text" id="username" name="inst_addr" placeholder="Address of the Hospital/Institution/Clinic" required>
                </div>
                <div class="form-row">
                    <div class="input-items">
                        <label for="initial_training_date">Initial Training Date (Mandatory): </label>
                        <input type="date" id="username" name="initial_training_date" placeholder="" required>
                    </div>
                    <div class="input-items">
                        <label for="refresher_training_date">Refresher_Training_Date: </label>
                        <input type="date" id="username" name="refresher_training_date" placeholder="">
                    </div>
                </div>
                <div class="input-items">
                    <!-- <label for="fibroscan_device_serial_no">Fibroscan Device Serial No: </label> -->
                    <input type="text" id="username" name="fibroscan_device_serial_no" placeholder="Fibroscan Device Serial No">
                </div>
                <div class="input-items">
                    <!-- <label for="scan_done">How Many Scan You Have Done?: </label> -->
                    <input type="text" id="username" name="scan_done" placeholder="The approximate number of scans done in the last 6 months">
                </div>
                <div class="submits">
                    <button class="btn btn-green" style="text-transform: uppercase;">Register</button>
                    <p>Already have an Account? <a href="login.php">Click here to Login</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
</body>
</html>