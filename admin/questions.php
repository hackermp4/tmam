<?php

/* Admin seassion check */
session_start();
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
}

include('../crud/middleware/database.php');
require_once('functions.php');

$conn = database();

/* Question delete mechanism */
if(isset($_GET['delete']) && !empty($_GET['delete'])) {
    $qid = $_GET['delete'];
    $sql = "delete from questions where id = '$qid'";
    $result = $conn->query($sql);
    header('Location: questions.php'); // Redirect to this same page freshly
}


function questionRetrive() {
    global $conn;
    $sql = "select id, question from questions";
    $result = $conn->query($sql);
    $data = array();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}
function answerRetrive($question_id) {
    global $conn;
    $sql = "select answer from choices where question_id = '$question_id'";
    $result = $conn->query($sql);
    $data = array();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
} 

$questionRetrive = questionRetrive();


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
                <h3 class="section-heading">Questions</h3>

                <!-- wrapper -->
                <div class="wrapper">
                    <div class="topics-heading">
                        <a href="add-question.php" class="btn btn-blue">Add New Questions</a>
                    </div>
                    <div class="topics-table">
                        <div class="tbl-head">
                            <strong>SL.</strong>
                            <strong>Question Title</strong>
                            <strong>Answer</strong>
                            <strong style="text-align: center;">Actions</strong>
                        </div>

                        <div class="tbl-body">
                            <?php if($questionRetrive != null) { foreach(questionRetrive() as $item) :  ?>
                            <div class="tbl-row">
                                <p>
                                    <?php echo $item['id']; ?>
                                </p>
                                <p>
                                <?php echo substr(strip_tags($item['question']), 0, 60); ?>
                                </p>
                                <p>
                                <?php
                                    $answer = answerRetrive($item['id']);
                                    if($answer != null) {
                                    foreach($answer as $as) {
                                        echo substr(strip_tags($as['answer']), 0, 60);;
                                    }
                                }
                                ?>
                                </p>

                                <div class="actions">
                                    <div class="actions-btn">
                                        <a class="btn btn-blue" href="setAnswer.php?id=<?php echo $item['id']; ?>"><i class="fas fa-tasks"></i></a>
                                        <a href="edit-question.php?id=<?php echo $item['id']; ?>" class="btn btn-green"><i class="far fa-edit"></i></a>
                                        <a class="btn btn-red" href="questions.php?delete=<?php echo $item['id']; ?>"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; } ?>                            
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