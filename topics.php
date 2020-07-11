<?php 
    session_start();
    include('crud/topics.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam System</title>
    <!-- core styles -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- banner start -->
    <div class="banner-area">
        <div class="container">
            <div class="banner-wrapper">
                <h1 class="section-title-big">
                    Topics
                </h1>
            </div>
        </div>
    </div>
    <!-- banner end -->


    <!-- topics start -->
    <div class="topics-area">
        <ul id="topics-wrapper">
            <?php if(topics() != null) { foreach(topics() as $item) : ?>
            <li>
                <p href="#" class="magic-topic"> <?php echo $item['title']; ?> </p>
                <div class="topic-popup">
                    <span class="close-topic" data-id="<?php echo $item['id']; ?>">X</span>
                    <div class="popup-contents">
                        <?php echo $item['content']; ?>
                    </div>
                </div>
            </li>
            <?php endforeach; } ?>

        </ul>

        <a href="examination.php" class="button btn-green proceed-btn">Training Evaluation</a>
    </div>
    <!-- topics end -->
    <script src="assets/js/jquery.min.js"></script>

    <!-- custom script -->
    <script>
        $(document).ready(function () {
            // popup the contents
            $('.magic-topic').click(function () {
                if ($(this).parent().children('.topic-popup').length > 0) {
                    $(this).parent().children('.topic-popup').addClass('show-popup');
                    let popup = $(this).parent().find('.popup-contents');
                    if(isScrollable(popup) == false){
                        $(this).parent().children('.topic-popup').children('.close-topic').addClass('show-popup');
                    }
                    $('html, body').addClass('overflow-control');
                } else {
                    alert('No topic contents!');
                }
            })


            // visible the close button

            $('.popup-contents').on('scroll', function () {
                if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                    $(this).parent().children('.close-topic').addClass('show-popup');
                }
            })


            // check a element is scrollable
            function isScrollable(el){
                return $(el)[0].scrollWidth > $(el)[0].clientWidth || $(el)[0].scrollHeight > $(el)[0].clientHeight;
            };


            // close the topic popup

            $('.close-topic').click(function (e) {
                e.preventDefault();
                $('.topic-popup').removeClass('show-popup');
                $('html, body').removeClass('overflow-control');
                const topic_id = $(this).data('id');
                setLocalTopics(topic_id);
                $(this).parent().parent().find('.magic-topic').addClass('topic-disable');
                checkReadTopics();
            })


            // store topics id in local storage
            function setLocalTopics(id = '') {
                let topics = [];
                let json = JSON.parse(localStorage.getItem('topics'));
                if (json != null) {
                    topics = json;
                    if (!topics.includes(id)) {
                        topics.push(id);
                    }
                    localStorage.setItem('topics', JSON.stringify(topics));
                } else {
                    topics.push(id);
                    localStorage.setItem('topics', JSON.stringify(topics));
                }
            }


            // set topics disable which already read
            function setTopicDisable() {
                let topics_read = JSON.parse(localStorage.getItem('topics'));
                if( topics_read != null){
                    let topics_ids = document.querySelectorAll('.close-topic');
                    topics_ids.forEach(function (item) {
                        if (topics_read.includes(parseInt(item.getAttribute('data-id')))) {
                            item.parentNode.parentNode.children[0].className += ' topic-disable';
                        }
                    })
                }
            }
            setTopicDisable();


            // check if all topics read and Visiable the button to proceed

            function checkReadTopics() {
                let all_topics = document.querySelectorAll('.magic-topic');
                let all_read_topics = document.querySelectorAll('.topic-disable');
                console.log(all_topics.length);

                if (all_topics.length <= 0) {
                    $('.proceed-btn').removeClass('show-popup');
                }else if(all_topics.length == all_read_topics.length){
                    $('.proceed-btn').addClass('show-popup');
                }
            }

            checkReadTopics();


        })
    </script>

</body>

</html>


<?php
    if(isset($_SESSION['messages'])) {
        $messages = $_SESSION['messages'];
        echo "<script type='text/javascript'>alert('$messages');</script>";
        unset($_SESSION['messages']);
    }
?>