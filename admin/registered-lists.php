<?php

/* Admin seassion check */
session_start();
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
}

require_once('../crud/middleware/database.php');
require_once('functions.php');
$conn = database();

$result = $conn->query("select * from examinee order by id desc");

if($result->num_rows > 0) {
    $data = [];    
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Registered</title>

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
            

            <!-- dashboard area -->
            <div class="dashboard-area">
                <h3 class="section-heading">Registered</h3>

                <!-- wrapper -->
                <div class="wrapper">
                    
                    <div class="topics-table">
                        <div class="tbl-head">
                            <strong>SL.</strong>
                            <strong>Name</strong>
                            <strong>Email</strong>
                            <strong style="text-align: center;">Actions</strong>
                        </div>

                        <div class="tbl-body">
                            <?php foreach($data as $item) : ?>
                            <div class="tbl-row">
                                <p>
                                    <?php echo $item['id']; ?>
                                </p>
                                <p>
                                <?php echo $item['first_name'] . " " . $item['last_name']; ?>
                                </p>
                                <p>
                                    <?php echo $item['email']; ?>
                                </p>

                                <div class="actions">
                                    <div class="actions-btn">
                                        <p><a href="student-details.php?id=<?php echo $item['id']; ?>" style="text-decoration: none">Details...</a></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
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