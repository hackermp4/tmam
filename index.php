<?php 
    include('crud/instructions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam System</title>

    <!-- owl css -->
    <link rel="stylesheet" href="assets/css/owl.min.css">

    <!-- core styles -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- banner start -->
    <div class="banner-area">
        <div class="container">
            <div class="banner-wrapper">
                <h1 class="section-title">
                    TRAINING OBJECTIVE
                </h1>
                <p class="section-content">
                    The following is section of articles of FibroScan and CAP
                    publish by the different gastroenterologists and hepatologists of
                    Canada and abroad.
                </p>
            </div>
        </div>
    </div>
    <!-- banner end -->


    <!-- instractions start -->
    <div class="instraction-area">
        <!-- slider -->
        <div class="instraction-slider owl-carousel">
            <div class="slider-img">
                <img src="assets/img/bg/medical02.jpeg" alt="">
            </div>

            <div class="slider-img">
                <img src="assets/img/bg/medical001.jpg" alt="">
            </div>

            <div class="slider-img">
                <img src="assets/img/bg/medical02.jpeg" alt="">
            </div>
        </div>
        <!-- slider end -->



        <div class="instraction-wrapepr">
            <div class="container">
                <!-- instraction contents -->
                <div class="instraction-contents">
                    <?php
                      $item =  instructions();
                      foreach($item as $item) {
                          echo $item['content'];
                      }
                    ?>
                </div>

                <div class="start-btn">
                    <a href="topics.php" class="button btn-orange">Start</a>
                </div>
                <!-- instraction contents end -->
            </div>

        </div>

    </div>
    <!-- instractions end -->


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/owl.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.instraction-slider').owlCarousel({
                loop: true,
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 2000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });
        })
    </script>
</body>

</html>