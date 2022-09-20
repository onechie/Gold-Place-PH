<?php
    include './database.php';

    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
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
                $verified = $row['verified'];
                if($verified == 'yes'){
                    if(password_verify($password, $checkPassword)) {

                        session_start();
                        $_SESSION["userId"] = $userid;
                        
                        echo'<input type="hidden" id="check" value="success">';
                        echo'Welcome, ', '<span >', ucwords($firstname),' ',ucwords($lastname),'!<span>';
                    } else {
                        wrongPassword();
                    }
                } else {
                    echoError('0l3');
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
        echo'Wrong password! Please try again.';
    }
    //ECHO ERROR MESSAGE WITH TOAST
    function echoError($level){
        echo'Error occurred, Please reload the page! code : '. $level;
    }
?>