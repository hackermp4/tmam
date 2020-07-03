<?php


require_once('../crud/middleware/database.php');
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

function questionSingle($id) {
    global $conn;
    $sql = "select id, question from questions where id = '$id'";
    $result = $conn->query($sql);
    $data = array();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}

function choiceSingle($id) {
    global $conn;
    $sql = "select id, choice from choices where question_id = '$id'";
    $result = $conn->query($sql);
    $data = array();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}

function choiceRetrive($question_id) {
    global $conn;
    $sql = "select id, option_no, choice from choices where question_id = '$id'";
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
    $sql = "select choices.id, choices.choice from choices where id = (select choice_id from answers where question_id = '$question_id')";
    $result = $conn->query($sql);
    $data = array();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
} 

function questionInsert($question) {
    global $conn;
    $sql = "insert into questions (question) value ('$question')";
    $result = $conn->query($sql) or die($conn->error);
    if($result == True) {
        return $conn->insert_id;
    }
}

function questionUpdate($id, $question) {
    global $conn;
    $sql = "update questions set question = '$question' where id = '$id'";
    $result = $conn->query($sql);
}

function choiceInsert($question_id, $choice) {
    global $conn;
    $sql = "insert into choices (question_id, choice) values ('$question_id', '$choice')  ";
    $result = $conn->query($sql);
}

function choiceUpdate($id, $question_id, $option_no, $choice) {
    global $conn;
    $sql = "update choices set option_no = '$option_no', choice = '$choice' where id = '$id'";
    $result = $conn->query($sql);
}

function answerInsert($question_id, $choice_id) {
    global $conn;
    $sql = "insert into answers (question_id, choice_id) values ('$question_id', '$choice_id')";
    $result = $conn->query($sql);
}

function answerUpdate($id, $question_id, $answer_id) {
    global $conn;
    $sql = " update answers set question_id = '$question_id',  answer_id = '$answer_id' where id = '$id'";
    $result = $conn->query($sql);
}



if( isset($_POST['question']) && !isset($_POST['id']) ) {
    $question_id = questionInsert($_POST['question']);
}
if( isset($_POST['choice_1']) && !isset($_POST['id']) ) {
    for($x=1; $x<=6; $x++) {
        if($_POST["choice_$x"] != '') {
            choiceInsert($question_id, $_POST["choice_$x"]);
        }
    }
}
if ( isset($_GET['id']) ) {
    $singleQuestion = questionSingle($_GET['id']);
    $singleChoice = choiceSingle($_GET['id']);

}































?>