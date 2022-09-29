<?php
    include './database.php';
    if(isset($_POST['regPhone'])) {
        $phone = $_POST['regPhone'];
        $tenDigitPhone = substr($phone,-10);
        $withZeroDigitPhone = '0'.$tenDigitPhone;
        $withPlusDigitPhone =  '+63'.$tenDigitPhone;

        $test1 = "SELECT * FROM user WHERE phone = '$tenDigitPhone'";
        $test2 = "SELECT * FROM user WHERE phone = '$withZeroDigitPhone'";
        $test3 = "SELECT * FROM user WHERE phone = '$withPlusDigitPhone'";

        $result1 = mysqli_query($conn, $test1);
        $result2 = mysqli_query($conn, $test2);
        $result3 = mysqli_query($conn, $test3);


        //CHECK IF THERE ARE MATCHES
        if(!(mysqli_num_rows($result1) == 0 && mysqli_num_rows($result2) == 0 && mysqli_num_rows($result3) == 0 )) {
            echo ' is already used <i class="bi bi-exclamation-circle-fill"></i>';
        }else{
            echo '';
        }
    } else {
        echo '';
    }
?>