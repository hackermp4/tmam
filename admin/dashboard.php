<?php
require_once('functions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login</title>

    <!-- fontawesome css -->
    <link rel="stylesheet" href="css/fontawesome.css">
    <!-- theme css -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- main start -->
    <div id="main">

        <?php get_template_part('templates/top-header'); ?>



        <!-- page wrapper start -->
        <div id="page-wrapper">
            <?php get_template_part('templates/sidebar'); ?>

            <div class="dashboard-area">
                <h3 class="section-heading">Dashboard</h3>
                <div class="wrapper">
                    <div class="card-wrapper">
                        <div class="card-item">
                            <a href="new-request.php">
                            <p>Registration Request</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page wrapper end -->
    </div>

    <!-- main end -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>