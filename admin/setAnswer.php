<?php

/* Admin seassion check */
session_start();
if(!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
}

include('../crud/middleware/database.php');
require_once('functions.php');

$conn = database();

if(isset($_GET['id'])) {
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

    $question_id = $_GET['id'];
    global $conn;
    $sql = "select id, choice_1, choice_2, choice_3, choice_4, choice_5, choice_6 from choices where question_id = '$question_id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $choice_1 = $row['choice_1'];
            $choice_2 = $row['choice_2'];
            $choice_3 = $row['choice_3'];
            $choice_4 = $row['choice_4'];
            $choice_5 = $row['choice_5'];
            $choice_6 = $row['choice_6'];
        }
    }
    /* ends */


    $questionSingle = questionSingle($_GET['id']);
} /* get ends */

if(isset($_POST['id']) && isset($_POST['answer']) && $_POST['answer'] != '-') {
    $answer = $_POST['answer'];
    $qidi = $_POST['id']; 
    $sql = "update choices set answer = '$answer' where question_id = '$qidi'";
    $conn->query($sql) or die($conn->error);
    header('Location: questions.php');
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
                <h3 class="section-heading">Set Answer</h3>

                <!-- wrapper -->
                <div class="wrapper set-answer">
                   
                    <div class="set-answer-title"><?php foreach($questionSingle as $item) { echo $item['question']; } ?></div>
                    <form action="setAnswer.php" method="post">
                    <input type="hidden" name = "id" value="<?php echo $question_id; ?>">
                        <div class="input-items custom-select">
                        <p>Set your answer for this question.</p>
                            <select name="answer" id="answer">
                                <option value="-">Select an answer</option>

<?php if($choice_1 != null) : ?> <option value="<?php echo $choice_1; ?>"><?php echo $choice_1; ?></option><?php endif; ?>

    <?php if($choice_2 != null) : ?> <option value="<?php echo $choice_2; ?>"><?php echo $choice_2; ?></option><?php endif; ?>

        <?php if($choice_3 != null) : ?> <option value="<?php echo $choice_3; ?>"><?php echo $choice_3; ?></option><?php endif; ?>

            <?php if($choice_4 != null) : ?> <option value="<?php echo $choice_4; ?>"><?php echo $choice_4; ?></option><?php endif; ?>

                <?php if($choice_5 != null) : ?> <option value="<?php echo $choice_5; ?>"><?php echo $choice_5; ?></option><?php endif; ?>

                    <?php if($choice_6 != null) : ?> <option value="<?php echo $choice_6; ?>"><?php echo $choice_6; ?></option><?php endif; ?>

    </select>
                        </div>
                        <button class="btn btn-green">Save</button>
                    </form>
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
    <script>
        var x, i, j, l, ll, selElmnt, a, b, c;
        /* Look for any elements with the class "custom-select": */
        x = document.getElementsByClassName("custom-select");
        l = x.length;
        for (i = 0; i < l; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            ll = selElmnt.length;
            /* For each element, create a new DIV that will act as the selected item: */
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);
            /* For each element, create a new DIV that will contain the option list: */
            b = document.createElement("DIV");
            b.setAttribute("class", "select-items select-hide");
            for (j = 1; j < ll; j++) {
                /* For each option in the original select element,
                create a new DIV that will act as an option item: */
                c = document.createElement("DIV");
                c.innerHTML = selElmnt.options[j].innerHTML;
                c.addEventListener("click", function (e) {
                    /* When an item is clicked, update the original select box,
                    and the selected item: */
                    var y, i, k, s, h, sl, yl;
                    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                    sl = s.length;
                    h = this.parentNode.previousSibling;
                    for (i = 0; i < sl; i++) {
                        if (s.options[i].innerHTML == this.innerHTML) {
                            s.selectedIndex = i;
                            h.innerHTML = this.innerHTML;
                            y = this.parentNode.getElementsByClassName("same-as-selected");
                            yl = y.length;
                            for (k = 0; k < yl; k++) {
                                y[k].removeAttribute("class");
                            }
                            this.setAttribute("class", "same-as-selected");
                            break;
                        }
                    }
                    h.click();
                });
                b.appendChild(c);
            }
            x[i].appendChild(b);
            a.addEventListener("click", function (e) {
                /* When the select box is clicked, close any other select boxes,
                and open/close the current select box: */
                e.stopPropagation();
                closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active");
            });
        }

        function closeAllSelect(elmnt) {
            /* A function that will close all select boxes in the document,
            except the current select box: */
            var x, y, i, xl, yl, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            xl = x.length;
            yl = y.length;
            for (i = 0; i < yl; i++) {
                if (elmnt == y[i]) {
                    arrNo.push(i)
                } else {
                    y[i].classList.remove("select-arrow-active");
                }
            }
            for (i = 0; i < xl; i++) {
                if (arrNo.indexOf(i)) {
                    x[i].classList.add("select-hide");
                }
            }
        }

        /* If the user clicks anywhere outside the select box,
        then close all select boxes: */
        document.addEventListener("click", closeAllSelect);
    </script>
</body>

</html>