<?php

require_once('../crud/topics.php');
require_once('../crud/admin/topicsInsert.php');
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
            

            <!-- dashboard area -->
            <div class="dashboard-area">
                <h3 class="section-heading">Topics</h3>

                <!-- wrapper -->
                <div class="wrapper">
                    <div class="topics-heading">
                        <a href="add-topic.php" class="btn btn-blue">Add New Topic</a>
                    </div>
                    <div class="topics-table">
                        <div class="tbl-head">
                            <strong>SL.</strong>
                            <strong>Title</strong>
                            <strong>Contents</strong>
                            <strong style="text-align: center;">Actions</strong>
                        </div>

                        <div class="tbl-body">
                            <?php if(topics() != null) { foreach(topics() as $item) : ?>
                            <div class="tbl-row">
                                <p>
                                    <?php echo $item['id']; ?>
                                </p>
                                <p>
                                <?php echo substr(strip_tags($item['title']), 0, 60); ?>
                                </p>
                                <p>
                                    <?php echo substr(strip_tags($item['content']), 0, 60); ?>
                                </p>

                                <div class="actions">
                                    <div class="actions-btn">
                                        <a href="add-topic.php?id=<?php echo $item['id']; ?> " class="btn btn-green"><i class="far fa-edit"></i></a>
                                        <a href="topics.php?delete=<?php echo $item['id']; ?>" class="btn btn-red"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; }?>
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