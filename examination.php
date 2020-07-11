<?php

    require_once('crud/middleware/sessions.php');
    require_once('admin/app/base_url.php');
    $examinee_id = is_authenticated(SITE_URL.'login.php'); // Redirect if not registered

    require_once('crud/middleware/checks.php');
    is_verified('topics.php'); // Redirect if not verified

    require_once('crud/middleware/database.php');
    $conn = database();


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

    
    function retriveChoice($question_id) {
        global $conn;
        $sql = "select id, choice_1, choice_2, choice_3, choice_4, choice_5, choice_6 from choices where question_id = '$question_id'";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                global $choice_1, $choice_2, $choice_3, $choice_4, $choice_5, $choice_6;
                $choice_1 = $row['choice_1'];
                $choice_2 = $row['choice_2'];
                $choice_3 = $row['choice_3'];
                $choice_4 = $row['choice_4'];
                $choice_5 = $row['choice_5'];
                $choice_6 = $row['choice_6'];
            }
        }
    }
    $questions = questionRetrive();

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
                    25 MULTIPLE CHOICE QUESTIONS
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


<div class="container">
    <!-- question box -->
    <div class="question-box">

        <ol id="question-list">
            <?php $c = 1; foreach($questions as $ques) : ?>
            <li class="question-tab" data-id="<?php echo $ques['id']; ?>">
                <div class="question">
                    <h4 class="q-title"><?php echo $ques['question']; ?></h4>
                </div>

                <?php retriveChoice($ques['id']) ?>
                <div class="question-choices">
                    <ul class="choices">

                        <?php if($choice_1 != null) : ?>
                        <li>
                            <input type="radio" name="<?php echo "choice_".$c; ?>" value="<?php echo $choice_1; ?>" class="answer">
                            <label><?php echo $choice_1; ?></label>
                        </li>
                        <?php endif; ?>

                        <?php if($choice_2 != null) : ?>
                        <li>
                            <input type="radio" name="<?php echo "choice_".$c; ?>" value="<?php echo $choice_2; ?>" class="answer">
                            <label><?php echo $choice_2; ?></label>
                        </li>
                        <?php endif; ?>

                        <?php if($choice_3 != null) : ?>
                        <li>
                            <input type="radio" name="<?php echo "choice_".$c; ?>" value="<?php echo $choice_3; ?>" class="answer">
                            <label><?php echo $choice_3; ?></label>
                        </li>
                        <?php endif; ?>

                        <?php if($choice_4 != null) : ?>
                        <li>
                            <input type="radio" name="<?php echo "choice_".$c; ?>" value="<?php echo $choice_4; ?>" class="answer">
                            <label><?php echo $choice_4; ?></label>
                        </li>
                        <?php endif; ?>

                        <?php if($choice_5 != null) : ?>
                        <li>
                            <input type="radio" name="<?php echo "choice_".$c; ?>" value="<?php echo $choice_5; ?>" class="answer">
                            <label><?php echo $choice_5; ?></label>
                        </li>
                        <?php endif; ?>

                        <?php if($choice_6 != null) : ?>
                        <li>
                            <input type="radio" name="<?php echo "choice_".$c; ?>" value="<?php echo $choice_6; ?>" class="answer">
                            <label><?php echo $choice_6; ?></label>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </li>
            <?php $c ++; endforeach; ?>
        </ol>


        <div class="results">
            <p class="counts">
                <span id="total-ans">0 </span>
                /
                <span id="total-ques"></span>
            </p>
            <button class="button btn-disable btn-result">Result</button>
        </div>
    </div>
    <!-- question box end -->
</div>

    <script src="assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.answer').on('change', function(){
                let ans = $(this).val();
                let ID = $(this).parent().parent().parent().parent().data('id');
                let obj = { id: ID, answer: ans }
                setQuestion(obj);
                answeredQuestionCount();
                activateResultButton();
            })

            // active the result button

            function activateResultButton(){
                let questions = $('.question-tab');
                let answered  = JSON.parse( localStorage.getItem('questions') );
                if( answered != null){
                    if( questions.length == answered.length ){
                        $('.btn-result').removeClass('btn-disable');
                        $('.btn-result').addClass('btn-green');

                        return true;
                    }else{
                        $('.btn-result').removeClass('btn-green');
                        $('.btn-result').addClass('btn-disable');
                        return false;
                    }
                }else{
                    $('.btn-result').removeClass('btn-green');
                    $('.btn-result').addClass('btn-disable');
                }
            }

            activateResultButton();

            // checked the answered question
            function checkTheAnswered(){
                let questions = $('.question-tab');
                let answered  = JSON.parse( localStorage.getItem('questions') );
                for( ques of questions){
                    if( answered != null ){
                        for( ans of answered ){
                       
                            if( ques.getAttribute('data-id') == ans.id ){
                                $('input:radio[value='+ans.answer+']').prop('checked', true);
                            }
                        }
                    }
                }
            }
            checkTheAnswered();

            // get answered question count
            function answeredQuestionCount(){
                let getAnswers = JSON.parse( localStorage.getItem('questions') );
                if( getAnswers != null ){
                    getAnswers.length > 9 ? $('#total-ans').text( getAnswers.length ) : $('#total-ans').text( '0' + getAnswers.length );
                }
            }
            answeredQuestionCount();


            // total question count

            function totalQuestionCount(){
                let questionCount = document.querySelectorAll('.question-tab');
                if(questionCount.length == 0){
                    $('#total-ques').text('0');
                }else{
                    questionCount.length > 9 ? $('#total-ques').text(questionCount.length) :
                    $('#total-ques').text('0'+questionCount.length)
                }
                
            }

            totalQuestionCount();


            //store local and check if data exists

            function setQuestion(obj=''){
                let arr = [];
                let questions = JSON.parse( localStorage.getItem('questions') );
                if( questions != null ){
                    let bool = false;
                    arr = questions;
                    for( el of arr ){
                        if( el.id == obj.id ){
                            el.answer = obj.answer;
                            bool = false;
                            localStorage.setItem( 'questions', JSON.stringify(arr) );
                            break;
                        }else{
                            bool = true;
                        }
                    }

                    if( bool ){
                        arr.push(obj)
                        localStorage.setItem( 'questions', JSON.stringify(arr) );
                    }
                    
                }else{
                    arr.push(obj);
                    localStorage.setItem( 'questions', JSON.stringify(arr) );
                }

                
            }


            $('.btn-result').click(function(){
                if(activateResultButton() == true){
                    let getTheAnswers = JSON.parse(localStorage.getItem('questions'));
                  
                    $.ajax({
                        url: 'exam_process.php',
                        method: 'POST',
                        data:{
                            answers:getTheAnswers
                        },
                        success:function(response){
                            localStorage.removeItem('questions');
                            window.location.href = 'result.php';
                        }
                    })

                    localStorage.removeItem('questions');
                }
            })
        })
    </script>
</body>

</html>