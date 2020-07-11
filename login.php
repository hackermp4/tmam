<?php


session_start();

require_once('crud/middleware/database.php');
$conn = database();

if(isset($_POST['email'])) {
    $email = $_POST['email'];

    $sql = "Select id, email, is_verified from examinee where email = '$email'";
    $result = $conn->query($sql) or die($conn->error);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($email == $row['email']) {
                $_SESSION['examinee_id'] = $row['id'];
                header('Location: topics.php'); // logged in
            }
        }
    } else {
        $_SESSION['messages'] = "Email not registered!";
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Examinee</title>

    <!-- theme css -->
    <link rel="stylesheet" href="admin/style.css">
</head>
<body class="bg-blue">

    <div class="login">
        <div class="login-form">
            <h2 class="form-title">Examinee Login</h2>
            <form action="login.php" method="post">
                <div class="input-items">
                    <label for="username">Enter You Email: </label>
                    <input type="email" id="username" name="email" placeholder="Enter email here">
                </div>
                <div class="submits">
                    <button class="btn btn-blue">login</button> <p>Not Registered? <a href="register.php">Click Here to Register</a></p>
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