<?php

/* Admin seassion check */
session_start();
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
}

include('../crud/middleware/database.php');
require_once('functions.php');
$conn = database();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $result = $conn->query("select * from examinee where id = '$id'") or die($conn->error);
    $student = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Student Details</title>

    <!-- fontawesome css -->
    <link rel="stylesheet" href="css/fontawesome.css">

    <!-- editor css -->
    
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
            

            <!-- dashboard area -->
            <div class="dashboard-area">
                <h3 class="section-heading"><?php echo $student['first_name'] . " " . $student['last_name'];  ?></h3>
                <div class="wrapper">
                    <table>
                        <tr>
                            <th>Name: </th>
                            <td><?php echo $student['first_name'] . " " . $student['last_name'];  ?></td>
                        </tr>

                        <tr>
                            <th>Email: </th>
                            <td><?php echo $student['email']; ?></td>
                        </tr>

                        <tr>
                            <th>Institution: </th>
                            <td><?php echo $student['institution']; ?></td>
                        </tr>
                        <tr>
                            <th>Institution Address: </th>
                            <td><?php echo $student['inst_addr']; ?></td>
                        </tr>
                        <tr>
                            <th>Initial Training Date: </th>
                            <td><?php echo $student['initial_training_date']; ?></td>
                        </tr>

                        <tr>
                            <th>Refesher Training Date: </th>
                            <td><?php echo $student['refresher_training_date']; ?></td>
                        </tr>

                        <tr>
                            <th>Approx scan done in last 6 months: </th>
                            <td><?php echo $student['scan_done']; ?></td>
                        </tr>


                        <tr>
                            <th>Fibroscan Device Serial No: </th>
                            <td><?php echo $student['fibroscan_device_serial_no']; ?></td>
                        </tr>


                        <tr>
                            <th>Is Verified: </th>
                            <td>
                            <?php if($student['is_verified'] == 1) : ?>
                                <?php echo "<i class='fas fa-user-check text-green'></i>"; ?>
                                <?php else : ?>
                                <?php echo "<i class='fas fa-exclamation-circle text-red'></i>"; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- wrapper end -->
            </div>
            <!-- dashboard area end -->
        </div>
        <!-- page wrapper end -->
    </div>

    <!-- main end -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>