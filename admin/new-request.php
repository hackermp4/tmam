<?php

/* Admin seassion check */
session_start();
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
}

require_once('../crud/middleware/database.php');
$conn = database();

if(isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "update examinee set is_verified = 1 where id = '$id'";
    $result = $conn->query($sql);
    header('Location: new-request.php'); // Redirect to this same page freshly 
}

function unverified_user() {
    global $conn;
    $sql = "select id, email from examinee where is_verified = 0";
    $result = $conn->query($sql) or die($conn->error);
    $data = array();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    } else {
        return false;
    }
}

$unverified_user = unverified_user();


require_once('functions.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Examinee Request</title>

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
                <h3 class="section-heading">New Requests</h3>

                <!-- wrapper -->
                <div class="wrapper">
                    
                    <div class="topics-table">
                        <div class="tbl-head">
                            <strong>SL.</strong>
                            <strong>Email</strong>
                            <strong style="text-align: center;">Permission</strong>
                        </div>

                        <div class="tbl-body">
                        <?php if($unverified_user != null) : $x = 1; ?>
                        <?php foreach($unverified_user as $item) : ?>
                            <div class="tbl-row">
                                <p>
                                    <?php echo $x; ?>
                                </p>
                                <p>
                                <?php echo $item['email']; ?>
                                </p>

                                <div class="actions">
                                    <div class="actions-btn">
                                        <a href="new-request.php?id=<?php echo $item['id']; ?>" class="btn btn-green"><i class="fa fa-check"></i></a>
                                        <!-- <a class="btn btn-red" href="#"><i class="fa fa-times"></i></a> -->
                                    </div>
                                </div>
                            </div>
                        <?php $x++; endforeach; ?>
                        <?php endif; ?>                 
                        </div>
                    </div>
                </div>
                <!-- wrapper end -->
            </div>
            <!-- dashboard area end -->
        </div>
        <!-- page wrapper end -->
    </div>

    <div id="toast"></div>

    <!-- main end -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="js/main.js"></script>

 <!--    <script>
    $(document).ready(function(){
        // ajax request for permition

        $('.permit').click(function(e){
            let id = $(this).data('id');
            if($(this).prop("checked") == true){
                $.ajax({
                    url: '',
                    method: 'POST',
                    data:{permit:'access', id:id},
                    success:function(response){
                        if(response.indexOf('success') >= 0){
                            let toast = `<div class="toast-success">
                                            You have permited
                                        </div>`;
                            $('#toast').html(toast);
                            $('#toast').addClass('show-toast');
                        }


                        setTimeout(function(){
                            $('#toast').removeClass('show-toast');
                        },3000)
                    }
                })
            }else{
                $.ajax({
                    url: '',
                    method: 'POST',
                    data:{permit:'deny', id:id},
                    success:function(response){
                        if(response.indexOf('success') >= 0){
                            let toast = `<div class="toast-success">
                                            You have deny
                                        </div>`;
                            $('#toast').html(toast);
                            $('#toast').addClass('show-toast');
                        }


                        setTimeout(function(){
                            $('#toast').removeClass('show-toast');
                        },3000)
                    }
                })
            }
        })
    })
    </script> -->
</body>
</html>