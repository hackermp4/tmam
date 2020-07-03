<?php

require_once('crud/middleware/sessions.php');
$examinee_id = is_authenticated('topics.php');

require_once('crud/middleware/checks.php');
is_verified('topics.php');

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('Location: index.php');
}

if(isset($_POST)) {

    require_once('crud/middleware/database.php');
    $conn = database();

    $sql = "select question_id, answer from choices";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $data = array();
        while($row = $result->fetch_assoc()) {
            $data[] = $row; // saving qid and answer from database to an array
        }
    }

    // --------
    $marks = 0;

    foreach($_POST as $key=>$value) {
        foreach($value as $key=>$value) {
            foreach($data as $item) { // Matching mechanism
                if($item['question_id'] == $value['id']) {
                    if($item['answer'] == $value['answer']) {
                        $marks++; // answer matched and marks plus
                    }
                }
            }
        }
    }

    // -------
    $pass_marks = 1;
    $submit_date = date("Y-m-d");
    if($marks >= $pass_marks) {
        $passed = 1;
    } else {
        $passed = 0;
    }
    $sql = "insert into results (examinee_id, marks, passed, submit_date) values ('$examinee_id', '$marks', '$passed', '$submit_date')";
    $result = $conn->query($sql) or die($conn->error); // Result inserted

}







?>