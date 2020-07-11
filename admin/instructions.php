<?php

/* Admin seassion check */
session_start();
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
}

require_once('../crud/admin/instructionsAdmin.php');
require_once('functions.php');
if(instructionDisplay() != null) {
    foreach(instructionDisplay() as $item) {
        $id = $item['id'];
        $content = $item['content'];
    }
} else {
    $id = "";
    $content = "";
}

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
                <h3 class="section-heading">Set Instractions</h3>

                <!-- wrapper -->
                <div class="wrapper">
                    <p>Set your exam instractions here. Write your instractions more better way you can insert anything.</p>
                    <div class="form">
                        <form action="instructions.php" method="post">
                            <div class="input-items">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <textarea name="content" id="instructions" rows="10">
                                <?php echo $content; ?>
                                </textarea>
                                
                            </div>
                            <button class="btn btn-green">Set</button>
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
       selector: '#instructions',
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