<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>
    <title>CS316-A2.php</title>
    <link rel="stylesheet" href="CS316-A2.css">
</head>

<body class = "header">
    <h1>Time to Bingo!</h1>
    <?php
    session_start();
    if (isset($_POST['session_clear'])) {
        // same as session_unset(); or $_SESSION=[];
        session_unset();
    }
    if (!isset($_SESSION["board"])) {
        $_SESSION["called_nums"] = [];
        $_SESSION["found_nums"] = [];
        $_SESSION["bingo_nums"] = [];
        $_SESSION["board"] = [];
        $_SESSION["found_a_num"] = 0;
        $_SESSION["found_a_bingo"] = 0;
        $_SESSION["12bingos"] = [];

        //create board
        for ($x = 0; $x < 5; $x++) {
            for ($y = 0; $y < 5; $y++) {
                //placeholder value
                $_SESSION["board"][$x][$y] = -1;
                //determine if $value is unique
                $value = rand(1, 15) + $x * 15;
                while (in_array($value, $_SESSION["board"][$x])) {
                    $value = rand(1, 15) + $x * 15;
                }
                $_SESSION["board"][$x][$y] = $value;
            }
        }
        //fill found_nums with 0
        for ($x = 0; $x < 5; $x++) {
            for ($y = 0; $y < 5; $y++) {
                $_SESSION["found_nums"][$x][$y] = 0;
            }
        }
        //fill bingo_found with 0
        for ($x = 0; $x < 5; $x++) {
            for ($y = 0; $y < 5; $y++) {
                //placeholder value
                $_SESSION["bingo_nums"][$x][$y] = 0;
            }
        }
        //set 12 bingos[] = 0
        for ($i = 0; $i < 12; $i++) {
            $_SESSION["12bingos"][$i] = 0;
        }
    }

    if (isset($_SESSION['call_num'])) {

        // Generate a random number between 1 and 75 that doesn't already exist in $_SESSION["called_nums"]
    
        do {
            $original_number = rand(1, 75);
        } while (in_array($original_number, $_SESSION["called_nums"]));

        // Add the original number to the $_SESSION["called_nums"] array
        $_SESSION["called_nums"][] = $original_number;

        //Determine if it on board
        if ($original_number <= 15) {
            for ($y = 0; $y < 5; $y++) {
                if ($original_number == $_SESSION["board"][0][$y]) {
                    $_SESSION["found_nums"][0][$y] = 1;
                    //echo "$original_number is in the array 0.";
                    $_SESSION["found_a_num"] = 1;
                }
            }
        } else if ($original_number <= 30) {
            for ($y = 0; $y < 5; $y++) {
                if ($original_number == $_SESSION["board"][1][$y]) {
                    $_SESSION["found_nums"][1][$y] = 1;
                    //echo "$original_number is in the array 1.";
                    $_SESSION["found_a_num"] = 1;
                }
            }
        } else if ($original_number <= 45) {
            for ($y = 0; $y < 5; $y++) {
                if ($original_number == $_SESSION["board"][2][$y]) {
                    $_SESSION["found_nums"][2][$y] = 1;
                    //echo "$original_number is in the array 2.";
                    $_SESSION["found_a_num"] = 1;
                }
            }
        } else if ($original_number <= 60) {
            for ($y = 0; $y < 5; $y++) {
                if ($original_number == $_SESSION["board"][3][$y]) {
                    $_SESSION["found_nums"][3][$y] = 1;
                    //echo "$original_number is in the array 3.";
                    $_SESSION["found_a_num"] = 1;
                }
            }
        } else {
            for ($y = 0; $y < 5; $y++) {
                if ($original_number == $_SESSION["board"][4][$y]) {
                    $_SESSION["found_nums"][4][$y] = 1;
                    //echo "$original_number is in the array 4.";
                    $_SESSION["found_a_num"] = 1;
                }
            }
        }
        //reset bingo when found a new num
        if ($_SESSION["found_a_num"] == 1 && $_SESSION["found_a_bingo"] == 1) {
            for ($x = 0; $x < 5; $x++) {
                for ($y = 0; $y < 5; $y++) {
                    //placeholder value
                    $_SESSION["bingo_nums"][$x][$y] = 0;

                }
            }
            $_SESSION["found_a_bingo"] = 0;
        }

        if ($_SESSION["found_a_num"] == 1) {
            //bingo order top-to-bottom
            //left-to right
            //check bingo1
            if ($_SESSION["12bingos"][0] == 0 && $_SESSION["found_nums"][0][0] == 1 && $_SESSION["found_nums"][1][0] == 1 && $_SESSION["found_nums"][2][0] == 1 && $_SESSION["found_nums"][3][0] == 1 && $_SESSION["found_nums"][4][0] == 1) {

                $_SESSION["found_a_bingo"] = 1;
                $_SESSION["bingo_nums"][0][0] = 1;
                $_SESSION["bingo_nums"][1][0] = 1;
                $_SESSION["bingo_nums"][2][0] = 1;
                $_SESSION["bingo_nums"][3][0] = 1;
                $_SESSION["bingo_nums"][4][0] = 1;
                $_SESSION["12bingos"][0] = 1;
            }
            if ($_SESSION["12bingos"][1] == 0 && $_SESSION["found_nums"][0][1] == 1 && $_SESSION["found_nums"][1][1] == 1 && $_SESSION["found_nums"][2][1] == 1 && $_SESSION["found_nums"][3][1] == 1 && $_SESSION["found_nums"][4][1] == 1) {

                $_SESSION["found_a_bingo"] = 1;
                $_SESSION["bingo_nums"][0][1] = 1;
                $_SESSION["bingo_nums"][1][1] = 1;
                $_SESSION["bingo_nums"][2][1] = 1;
                $_SESSION["bingo_nums"][3][1] = 1;
                $_SESSION["bingo_nums"][4][1] = 1;
                $_SESSION["12bingos"][1] = 1;
            }
            if ($_SESSION["12bingos"][2] == 0 && $_SESSION["found_nums"][0][2] == 1 && $_SESSION["found_nums"][1][2] == 1 && $_SESSION["found_nums"][2][2] == 1 && $_SESSION["found_nums"][3][2] == 1 && $_SESSION["found_nums"][4][2] == 1) {

                $_SESSION["found_a_bingo"] = 1;
                $_SESSION["bingo_nums"][0][2] = 1;
                $_SESSION["bingo_nums"][1][2] = 1;
                $_SESSION["bingo_nums"][2][2] = 1;
                $_SESSION["bingo_nums"][3][2] = 1;
                $_SESSION["bingo_nums"][4][2] = 1;
                $_SESSION["12bingos"][2] = 1;
            }
            if ($_SESSION["12bingos"][3] == 0 && $_SESSION["found_nums"][0][3] == 1 && $_SESSION["found_nums"][1][3] == 1 && $_SESSION["found_nums"][2][3] == 1 && $_SESSION["found_nums"][3][3] == 1 && $_SESSION["found_nums"][4][3] == 1) {

                $_SESSION["found_a_bingo"] = 1;
                $_SESSION["bingo_nums"][0][3] = 1;
                $_SESSION["bingo_nums"][1][3] = 1;
                $_SESSION["bingo_nums"][2][3] = 1;
                $_SESSION["bingo_nums"][3][3] = 1;
                $_SESSION["bingo_nums"][4][3] = 1;
                $_SESSION["12bingos"][3] = 1;
            }
            if ($_SESSION["12bingos"][4] == 0 && $_SESSION["found_nums"][0][4] == 1 && $_SESSION["found_nums"][1][4] == 1 && $_SESSION["found_nums"][2][4] == 1 && $_SESSION["found_nums"][3][4] == 1 && $_SESSION["found_nums"][4][4] == 1) {

                $_SESSION["found_a_bingo"] = 1;
                $_SESSION["bingo_nums"][0][4] = 1;
                $_SESSION["bingo_nums"][1][4] = 1;
                $_SESSION["bingo_nums"][2][4] = 1;
                $_SESSION["bingo_nums"][3][4] = 1;
                $_SESSION["bingo_nums"][4][4] = 1;
                $_SESSION["12bingos"][4] = 1;
            }
            if ($_SESSION["12bingos"][5] == 0 && $_SESSION["found_nums"][0][0] == 1 && $_SESSION["found_nums"][0][1] == 1 && $_SESSION["found_nums"][0][2] == 1 && $_SESSION["found_nums"][0][3] == 1 && $_SESSION["found_nums"][0][4] == 1) {

                $_SESSION["found_a_bingo"] = 1;
                $_SESSION["bingo_nums"][0][0] = 1;
                $_SESSION["bingo_nums"][0][1] = 1;
                $_SESSION["bingo_nums"][0][2] = 1;
                $_SESSION["bingo_nums"][0][3] = 1;
                $_SESSION["bingo_nums"][0][4] = 1;
                $_SESSION["12bingos"][5] = 1;
            }

            if ($_SESSION["12bingos"][6] == 0 && $_SESSION["found_nums"][1][0] == 1 && $_SESSION["found_nums"][1][1] == 1 && $_SESSION["found_nums"][1][2] == 1 && $_SESSION["found_nums"][1][3] == 1 && $_SESSION["found_nums"][1][4] == 1) {

                $_SESSION["found_a_bingo"] = 1;
                $_SESSION["bingo_nums"][1][0] = 1;
                $_SESSION["bingo_nums"][1][1] = 1;
                $_SESSION["bingo_nums"][1][2] = 1;
                $_SESSION["bingo_nums"][1][3] = 1;
                $_SESSION["bingo_nums"][1][4] = 1;
                $_SESSION["12bingos"][6] = 1;
            }

            if ($_SESSION["12bingos"][7] == 0 && $_SESSION["found_nums"][2][0] == 1 && $_SESSION["found_nums"][2][1] == 1 && $_SESSION["found_nums"][2][2] == 1 && $_SESSION["found_nums"][2][3] == 1 && $_SESSION["found_nums"][2][4] == 1) {

                $_SESSION["found_a_bingo"] = 1;
                $_SESSION["bingo_nums"][2][0] = 1;
                $_SESSION["bingo_nums"][2][1] = 1;
                $_SESSION["bingo_nums"][2][2] = 1;
                $_SESSION["bingo_nums"][2][3] = 1;
                $_SESSION["bingo_nums"][2][4] = 1;
                $_SESSION["12bingos"][7] = 1;
            }

            if ($_SESSION["12bingos"][8] == 0 && $_SESSION["found_nums"][3][0] == 1 && $_SESSION["found_nums"][3][1] == 1 && $_SESSION["found_nums"][3][2] == 1 && $_SESSION["found_nums"][3][3] == 1 && $_SESSION["found_nums"][3][4] == 1) {

                $_SESSION["found_a_bingo"] = 1;
                $_SESSION["bingo_nums"][3][0] = 1;
                $_SESSION["bingo_nums"][3][1] = 1;
                $_SESSION["bingo_nums"][3][2] = 1;
                $_SESSION["bingo_nums"][3][3] = 1;
                $_SESSION["bingo_nums"][3][4] = 1;
                $_SESSION["12bingos"][8] = 1;
            }
            if ($_SESSION["12bingos"][9] == 0 && $_SESSION["found_nums"][4][0] == 1 && $_SESSION["found_nums"][4][1] == 1 && $_SESSION["found_nums"][4][2] == 1 && $_SESSION["found_nums"][4][3] == 1 && $_SESSION["found_nums"][4][4] == 1) {

                $_SESSION["found_a_bingo"] = 1;
                $_SESSION["bingo_nums"][4][0] = 1;
                $_SESSION["bingo_nums"][4][1] = 1;
                $_SESSION["bingo_nums"][4][2] = 1;
                $_SESSION["bingo_nums"][4][3] = 1;
                $_SESSION["bingo_nums"][4][4] = 1;
                $_SESSION["12bingos"][9] = 1;
            }
            //diagonal left to right
            if ($_SESSION["12bingos"][10] == 0 && $_SESSION["found_nums"][0][0] == 1 && $_SESSION["found_nums"][1][1] == 1 && $_SESSION["found_nums"][2][2] == 1 && $_SESSION["found_nums"][3][3] == 1 && $_SESSION["found_nums"][4][4] == 1) {

                $_SESSION["found_a_bingo"] = 1;
                $_SESSION["bingo_nums"][0][0] = 1;
                $_SESSION["bingo_nums"][1][1] = 1;
                $_SESSION["bingo_nums"][2][2] = 1;
                $_SESSION["bingo_nums"][3][3] = 1;
                $_SESSION["bingo_nums"][4][4] = 1;
                $_SESSION["12bingos"][10] = 1;
            }
            if ($_SESSION["12bingos"][11] == 0 && $_SESSION["found_nums"][4][0] == 1 && $_SESSION["found_nums"][3][1] == 1 && $_SESSION["found_nums"][2][2] == 1 && $_SESSION["found_nums"][1][3] == 1 && $_SESSION["found_nums"][0][4] == 1) {

                $_SESSION["found_a_bingo"] = 1;
                $_SESSION["bingo_nums"][4][0] = 1;
                $_SESSION["bingo_nums"][3][1] = 1;
                $_SESSION["bingo_nums"][2][2] = 1;
                $_SESSION["bingo_nums"][1][3] = 1;
                $_SESSION["bingo_nums"][0][4] = 1;
                $_SESSION["12bingos"][11] = 1;
            }

            //reset found_a_num
            $_SESSION["found_a_num"] = 0;


        }


        // Display the updated array for demonstration purposes
        //print_r($_SESSION["called_nums"]);
    }
    ?>

    <!-- create ui -->

    <div class="full_ui">
        <div class="buttons_ui">
            <div class = button_header>Buttons Touchy!</div>
            <!-- Button for getting new Card. -->
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type=hidden name="session_clear">
                <button type="submit">Reset Session</button>
            </form>
            <!-- Button for getting new Number. -->
            <form method="GET" action="<?php $_SESSION['call_num'] = [] ?>">
                <input type=hidden name=call_num>
                <button>Call Number!</button>
            </form>
        </div>

        <!-- create board -->
        <div class="board_ui">
            <table class="board_table">
                <?php
                for ($y = 0; $y < 5; $y++) {
                    echo "<tr>";
                    for ($x = 0; $x < 5; $x++) {

                        echo '<td class = "board_element">';
                        if ($_SESSION["found_nums"][$x][$y] == 1) {

                            echo '<div class = "circle_num" ></div>';
                        }
                        if ($_SESSION["bingo_nums"][$x][$y] == 1) {
                            echo '<div class = "circle_bingo" ></div>';
                        }
                        echo $_SESSION["board"][$x][$y] . "</td>";
                        /*
                        $print = "<td class = 'board_element'>";
                        $print .= $_SESSION["board"][$x][$y];
                        $print .= "</td>";
                        echo $print;
                        */
                        // PHP code to generate a circle div
                
                    }
                    echo "</tr>";
                }
                echo "</table>";
                ?>
            </table>
        </div>
        <!-- create called_nums_list -->
        <div class="num_list_ui">
            <div>Called Numbers</div>
            <table class="called_nums_table">
                <?php
                
                $i = 0;
                foreach ($_SESSION["called_nums"] as $num) {
                    if ($i % 2 == 0) {
                        $called_num_block = "called_num_block_even";
                    } else {
                        $called_num_block = "called_num_block_odd";
                    }
                    echo "<tr><td class = '$called_num_block'>" . $num . "</td></tr>";
                    $i++;
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>