<?php
    include './database.php';

    $firstname = mysqli_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_escape_string($conn, $_POST['lastname']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $phone = mysqli_escape_string($conn, $_POST['phone']);
    $password = mysqli_escape_string($conn, md5($_POST['password']));
    
    //REGULAR EXPRESSIONS PATTERN
    $emailPattern = "/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/";
    $phonePattern = "/((^(\+63)(\d{10}))|(^(0)(\d{10}))|(^(9)(\d{9})))$/";
    $namePattern = "/^([a-zA-Z])+([-. ]([a-zA-Z])+)?([-. ]([a-zA-Z])+)?$/";

    //VALIDATE WITH PATTERN
    $testFname = (preg_match($namePattern, $firstname));
    $testLname = (preg_match($namePattern, $lastname));
    $testEmail = (preg_match($emailPattern, $email));
    $testPhone = (preg_match($phonePattern, $phone));

    //FORMAT PHONE NUMBER
    $tenDigitPhone = substr($phone,-10);
    $withZeroDigitPhone = '0'.$tenDigitPhone;
    $withPlusDigitPhone =  '+63'.$tenDigitPhone;

    //CHECK IF VALUES ARE VALID FROM PATTERN
    if ($testFname && $testLname && $testEmail && $testPhone) {
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        //CHECK IF EMAIL ALREADY EXISTS
        if(mysqli_num_rows($result) <= 0){
            $testPhone1 = "SELECT * FROM user WHERE phone = '$tenDigitPhone'";
            $testPhone2 = "SELECT * FROM user WHERE phone = '$withZeroDigitPhone'";
            $testPhone3 = "SELECT * FROM user WHERE phone = '$withPlusDigitPhone'";

            $resultPhone1 = mysqli_query($conn, $testPhone1);
            $resultPhone2 = mysqli_query($conn, $testPhone2);
            $resultPhone3 = mysqli_query($conn, $testPhone3);

            //CHECK PHONE NUMBER IN DIFFERENT FORMAT IF ALREADY EXISTS
            if(mysqli_num_rows($resultPhone1) == 0 && mysqli_num_rows($resultPhone2) == 0 && mysqli_num_rows($resultPhone3) == 0 ){

                $sql = "INSERT INTO user (firstname, lastname, email, phone, password) VALUES('$firstname', '$lastname', '$email', '$phone', '$password')";
                    
                    if(mysqli_query($conn, $sql)){
                        //ECHO SUCCESS MESSAGE WITH TOAST
                        echo'<div class="toast-header bg-dark">';
                        echo'    <img src="../assets/images/compressed/logo-only.png" height="30" class="rounded me-2" alt="...">';
                        echo'    <strong class="me-auto text-white-50">Gold Place PH</strong>';
                        echo'    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>';
                        echo'</div>';
                        echo'<div class="toast-body">';
                        echo'<span >', ucwords($firstname),' ',ucwords($lastname),'<span>', ' registered successfully! ';
                        echo'</div>';
                    } else {
                        echoError('0ca4');
                    }
                
            }else{
                echoError('0ca3');
            }

        }else{
            echoError('0ca2');
        }

    }else{
        echoError('0ca1');
    }

    //ECHO ERROR MESSAGE WITH TOAST
    function echoError($level){
        echo'<div class="toast-header bg-dark">';
        echo'    <img src="../assets/images/compressed/logo-only.png" height="30" class="rounded me-2" alt="...">';
        echo'    <strong class="me-auto text-white-50">Gold Place PH</strong>';
        echo'    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>';
        echo'</div>';
        echo'<div class="toast-body">';
        echo'Error occurred, Please reload the page! code : '. $level;
        echo'</div>';
    }
?>