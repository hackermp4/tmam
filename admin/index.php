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
            <form action="#">
                <div class="input-items">
                    <label for="username">Username: </label>
                    <input type="text" id="username" name="username" placeholder="Username">
                </div>
                <div class="input-items">
                    <label for="password">Password: </label>
                    <input type="password" id="password" name="password" placeholder="Password">
                </div>

                <div class="submits">
                    <button class="btn btn-blue">login</button>
                    <a href="password-recovery.html">Forgot password?</a>
                </div>
            </form>
        </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
</body>
</html>