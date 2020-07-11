<?php

/* Admin seassion check */
session_start();
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
}

include('../crud/admin/topicsInsert.php');
require_once('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Add Topic</title>

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
                <h3 class="section-heading">Add Topic and Contents</h3>

                <!-- wrapper -->
                <?php if(isset($_GET['id'])) {
                    $item = displayTopics($_GET['id']);
                    foreach($item as $item) {
                        $id = $item['id'];
                        $title = $item['title'];
                        $content = $item['content'];
                        }
                        $hidden_id = "<input type='hidden' name='id' value=".$item['id']. ">";
                    } else {
                        $id = "";
                        $title = "";
                        $content = "";
                        $hidden_id = "";
                    }
                ?>
                <div class="wrapper">
                    <div class="form">
                        <form action="add-topic.php" method="post">
                            <?php echo $hidden_id; ?>
                            <div class="input-items">
                                <label for="topic">Topic Name : </label>
                                <input type="text" name="title" id="topic" placeholder="Add topic title" value="<?php echo $title; ?>">
                            </div>
                            <div class="input-items">
                                <label for="contents">Topic Contents : </label>
                                <textarea name="contents" id="contents" rows="10">
                                <?php echo $content; ?>
                                </textarea>
                                
                            </div>
                            <button class="btn btn-green">Add</button>
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
       selector: '#contents',
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
</body>
</html>