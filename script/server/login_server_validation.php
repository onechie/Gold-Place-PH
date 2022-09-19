<?php
    include './database.php';

    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = mysqli_escape_string($conn, md5($_POST['password']));
    
    //REGULAR EXPRESSIONS PATTERN
    $emailPattern = "/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/";

    //VALIDATE WITH PATTERN
    $testEmail = (preg_match($emailPattern, $email));

    //CHECK IF VALUE IS VALID FROM PATTERN
    if ($testEmail) {
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        //CHECK IF EMAIL IS EXISTS
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)) {
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $checkPassword = $row['password'];
                $userid = $row['id'];
                if($password == $checkPassword) {
                    
                    session_start();
                    $_SESSION["userId"] = $userid;
                    echo'<div class="toast-header bg-dark">';
                    echo'    <input type="hidden" id="check" value="success">';
                    echo'    <img src="../assets/images/compressed/logo-only.png" height="30" class="rounded me-2" alt="...">';
                    echo'    <strong class="me-auto text-white-50">Gold Place PH</strong>';
                    echo'    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>';
                    echo'</div>';
                    echo'<div class="toast-body">';
                    echo'Welcome, ', '<span >', ucwords($firstname),' ',ucwords($lastname),'!<span>';
                    echo'</div>';
                } else {
                    wrongPassword();
                }
            }
            
        } else {
            echoError('0l2');
        }

    } else {
        echoError('0l1');
    }
    //ECHO WRONG PASSWORD WITH TOAST
    function wrongPassword(){
        echo'<div class="toast-header bg-dark">';
        echo'    <input type="hidden" id="check" value="failed">';
        echo'    <img src="../assets/images/compressed/logo-only.png" height="30" class="rounded me-2" alt="...">';
        echo'    <strong class="me-auto text-white-50">Gold Place PH</strong>';
        echo'    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>';
        echo'</div>';
        echo'<div class="toast-body">';
        echo'Wrong password! Please try again.';
        echo'</div>';
    }
    //ECHO ERROR MESSAGE WITH TOAST
    function echoError($level){
        echo'<div class="toast-header bg-dark">';
        echo'    <input type="hidden" id="check" value="failed">';
        echo'    <img src="../assets/images/compressed/logo-only.png" height="30" class="rounded me-2" alt="...">';
        echo'    <strong class="me-auto text-white-50">Gold Place PH</strong>';
        echo'    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>';
        echo'</div>';
        echo'<div class="toast-body">';
        echo'Error occurred, Please reload the page! code : '. $level;
        echo'</div>';
    }
?>