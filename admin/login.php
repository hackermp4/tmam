<?php

session_start();
require_once('../crud/middleware/database.php');
$conn = database();

if(isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
}

if(isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
    $result = $conn->query("select * from administrator where email = '$email'") or die($conn->error);
    if($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if($admin['password'] == $_POST['password']) {
            $_SESSION['admin_id'] = $admin['id'];
            header('Location: dashboard.php');
        } else {
            $_SESSION['messages'] = "Password does not matched!";
        }
    } else {
        $_SESSION['messages'] = "Admin does not exists!";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login</title>

    <!-- theme css -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-blue">

    <div class="login">
        <div class="login-form">
            <h2 class="form-title">Admin Login</h2>
            <form action="login.php" method="post">
                <div class="input-items">
                    <label for="username">Username: </label>
                    <input type="email" id="username" name="email" placeholder="Username" required>
                </div>
                <div class="input-items">
                    <label for="password">Password: </label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>

                <div class="submits">
                    <button class="btn btn-blue">login</button>
                    <!-- <a href="password-recovery.html">Forgot password?</a> -->
                </div>
            </form>
        </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
</body>
</html>

<?php
    if(isset($_SESSION['messages'])) {
        $messages = $_SESSION['messages'];
        echo "<script type='text/javascript'>alert('$messages');</script>";
        unset($_SESSION['messages']);
    }
?>