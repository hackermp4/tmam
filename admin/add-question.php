<?php

/* Admin seassion check */
session_start();
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
}

include('../crud/middleware/database.php');
require_once('functions.php');

$conn = database();

function questionInsert($question) {
    global $conn;
    $sql = "insert into questions (question) value ('$question')";
    $result = $conn->query($sql) or die($conn->error);
    if($result == True) {
        return $conn->insert_id;
    }
}

if(isset($_POST['question']) && $_POST['question'] != null) {
    $question_id = questionInsert($_POST['question']);
}

/* For inserting choices */
if(isset($question_id)) {
    if(isset($_POST['choice_1']) && $_POST['choice_1'] != null) {
        $choice_1 = $_POST['choice_1'];
    } else {
        $choice_1 = null;
    }
    if(isset($_POST['choice_2']) && $_POST['choice_2'] != null) {
        $choice_2 = $_POST['choice_2'];
    } else {
        $choice_2 = null;
    }
    if(isset($_POST['choice_3']) && $_POST['choice_3'] != null) {
        $choice_3 = $_POST['choice_3'];
    } else {
        $choice_3 = null;
    }
    if(isset($_POST['choice_4']) && $_POST['choice_4'] != null) {
        $choice_4 = $_POST['choice_4'];
    } else {
        $choice_4 = null;
    }
    if(isset($_POST['choice_5']) && $_POST['choice_5'] != null) {
        $choice_5 = $_POST['choice_5'];
    } else {
        $choice_5 = null;
    }
    if(isset($_POST['choice_6']) && $_POST['choice_6'] != null) {
        $choice_6 = $_POST['choice_6'];
    } else {
        $choice_6 = null;
    }
    
    global $conn;
    $sql = "insert into choices (question_id, choice_1, choice_2, choice_3, choice_4, choice_5, choice_6) values ('$question_id', '$choice_1', '$choice_2', '$choice_3', '$choice_4', '$choice_5', '$choice_6')";
    $conn->query($sql) or die($conn->error);
    header('Location: questions.php');
}
/* ends */



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
                <h3 class="section-heading">Add Questions and Choices</h3>

                <!-- wrapper -->
                <div class="wrapper">
                    <div class="form">
                        <form action="add-question.php" method="post">
                            <div class="input-items">
                                <label for="topic">Question : </label>
                                <textarea name="question" id="question" rows="10"></textarea>
                            </div>

                            <div class="input-items">
                                <label for="answer">Choice 1 : </label>
                                <input type="text" name="choice_1" id="answer">
                            </div>
                            <div class="input-items">
                                <label for="answer">Choice 2 : </label>
                                <input type="text" name="choice_2" id="answer">
                            </div>
                            <div class="input-items">
                                <label for="answer">Choice 3 : </label>
                                <input type="text" name="choice_3" id="answer">
                            </div>
                            <div class="input-items">
                                <label for="answer">Choice 4 : </label>
                                <input type="text" name="choice_4" id="answer">
                            </div>
                            <div class="input-items">
                                <label for="answer">Choice 5 : </label>
                                <input type="text" name="choice_5" id="answer">
                            </div>
                            <div class="input-items">
                                <label for="answer">Choice 6 : </label>
                                <input type="text" name="choice_6" id="answer">
                            </div>

<!--                             <div class="add-choicess">
                                <p>Add your choices</p>
                                <a href="#" id="add-choices"><i class="fas fa-plus-square"></i></a>
                            </div> -->

                            <div class="choices"></div>
                            <button class="btn btn-green">Save</button>
                        </form>
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

       <!-- editor js -->
   <script src="https://cdn.tiny.cloud/1/6dc2047lfaf839fs13foob9zg4wz13zaoxqo6mtpdfdy39nk/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
   
   <script>

     tinymce.init({
       selector: '#question',
       height:500,
       plugins: [
       'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
       'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
       'table emoticons template paste help'
       ],
       toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
       'bullist numlist outdent indent | link image | print preview media fullpage | ' +
       'forecolor backcolor emoticons | help',
       menu: {
       favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | spellchecker | emoticons'}
       },
       menubar: 'favs file edit view insert format tools table help',
       images_upload_url: 'upload_images.php',
        relative_urls : false,
        remove_script_host : false,
        convert_urls : true,
       
     });
   </script>
   
<!--     <script>
        $(document).ready(function(){


            // choices add 
            var count = 0;
            $('#add-choices').click(function(e){
                e.preventDefault();
                count += 1;
                let input = `
                <p class="input-items">
                    ${count}. <input type="text" name="choice[]" placeholder="Enter option">
                </p>
                `;
                
                $('.choices').append(input);
            })
        })
    </script> -->
</body>
</html>