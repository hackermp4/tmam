<?php


require_once('crud/middleware/sessions.php');
$examinee_id = is_authenticated('login.php');

require_once('crud/middleware/database.php');
$conn = database();

function retrive_result($examinee_id) {
    global $conn;
    $sql = "select examinee_id, marks, passed, first_name, last_name from results inner join examinee on examinee.id = results.examinee_id where results.examinee_id = '$examinee_id' order by results.id desc limit 1";
    $result = $conn->query($sql) or die($conn->error);
    if($result->num_rows > 0) {
        $data = array();
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    } else {
        return false;
    }
}

$data = retrive_result($examinee_id);


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
                    Thank You
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
    <?php if($data != false) : ?>
    <?php foreach($data as $item) : ?>
    <div class="results-box">
        <div class="student-info">
            <h3 class="student-name"><?php echo $item['first_name'] . ' ' . $item['last_name']; ?></h3>
            <a href="#">See Details</a>
        </div>

        <div class="marks-sheet">
            <div class="wrapper flex flex-between flex-align-center">
                <h4>Result Details</h4>
                <div class="divider"></div>

                <div class="marks">
                <?php if($item['passed'] == 1) : ?>
                    <h5 class="result-marks text-green"><?php echo $item['marks']; ?></h5>
                <?php else : ?>
                <h5 class="result-marks text-danger"><?php echo $item['marks']; ?></h5>
                <?php endif; ?>

                    <p>Out Of</p>
                    <p class="total-marks">100</p>
                </div>
            </div>
        </div>

        <div class="results">
        <?php if($item['passed'] == 1) : ?>
            <a class="button btn-green btn-result pass" href="#">
                <span>Pass</span>
                <p>Get Your Certificate Now</p>
            </a>
        <?php else : ?>
            <a class="button btn-danger btn-result fail" href="examination.php">
                <span>Re-Take Exam</span>
            </a>
        <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
    <!-- question box end -->
</div>

    <script src="assets/js/jquery.min.js"></script>

</body>

</html>

<?php


?>