<?php

/* Admin seassion check */
session_start();
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
}

require_once('functions.php');
require_once('../crud/middleware/database.php');
$conn = database();

$result = $conn->query("select count(distinct(id)) as value from examinee") or die($conn->error);
$total_registered = $result->fetch_assoc();

$result = $conn->query("select count(distinct(examinee_id)) as value from results where passed = 0") or die($conn->error);
$total_failed = $result->fetch_assoc();

$result = $conn->query("select count(distinct(examinee_id)) as value from results where passed = 1") or die($conn->error);
$total_passed = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>

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
                <div class="wrapper dashboard">
                    <div class="card-wrapper">
                       
                        <div class="card-item wild">
                            <div class="card-top-items">
                                <div class="icon">
                                <i class="fas fa-folder"></i>
                                </div>
                                <div class="card-contents">
                                    <p>Registered</p>
                                    <h2><?php echo $total_registered['value']; ?></h2>
                                </div>
                            </div>
                            <div class="card-divider"></div>
                            <a class="details" href="registered-lists.php">See Details ...</a>
                        </div>

                        <div class="card-item wild">
                            <div class="card-top-items">
                                <div class="icon bg-green">
                                <i class="fas fa-users"></i>
                                </div>
                                <div class="card-contents">
                                    <p>Total Passed</p>
                                    <h2><?php echo $total_passed['value']; ?></h2>
                                </div>
                            </div>
                            <div class="card-divider"></div>
                            <a class="details" href="total-passed.php">See Details ...</a>
                        </div>


                        <div class="card-item wild">
                            <div class="card-top-items">
                                <div class="icon bg-red">
                                <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="card-contents">
                                    <p>Total Failed</p>
                                    <h2><?php echo $total_failed['value']; ?></h2>
                                </div>
                            </div>
                            <div class="card-divider"></div>
                            <a class="details" href="total-failled.php">See Details ...</a>
                        </div>

                        <div class="card-item special">
                            <a href="new-request.php">
                            <p>Student</p>
                            <h2>Requests</h2>
                            </a>
                        </div>
                    </div>

                    <div class="card-wrapper" style="margin-top: 30px;">
                        <div class="card-item wild widget">
                            <div class="card-top-items bg-green">
                                <div class="card-contents">
                                    <h2>Set</h2>
                                    <p>Instructions</p>
                                </div>
                            </div>
                            <div class="card-divider"></div>
                            <a class="details bg-green" href="instructions.php">Show All ...</a>
                        </div>

                        <div class="card-item wild widget">
                            <div class="card-top-items bg-orange">
                                <div class="card-contents">
                                    <h2>Set</h2>
                                    <p>Topics</p>
                                </div>
                            </div>
                            <div class="card-divider"></div>
                            <a class="details bg-orange" href="topics.php">Show All ...</a>
                        </div>

                        <div class="card-item wild widget">
                            <div class="card-top-items bg-red">
                                <div class="card-contents">
                                    <h2>Set</h2>
                                    <p>Questions</p>
                                </div>
                            </div>
                            <div class="card-divider"></div>
                            <a class="details bg-red" href="questions.php">Show All ...</a>
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