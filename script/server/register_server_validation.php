<?php
    include './database.php';

    $firstname = mysqli_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_escape_string($conn, $_POST['lastname']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $phone = mysqli_escape_string($conn, $_POST['phone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
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

                $sql = "INSERT INTO user (firstname, lastname, email, phone, password, verified) VALUES('$firstname', '$lastname', '$email', '$phone', '$password', 'no')";
                    
                    if(mysqli_query($conn, $sql)){
                        $sql = "SELECT * FROM user WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0){

                            while($row = mysqli_fetch_assoc($result)) {
                              $user_id = $row['id'];
                              $code = password_hash(randomString(), PASSWORD_DEFAULT);
                              $sql = "INSERT INTO verify (code, user_id) VALUES('$code', '$user_id')";

                              if(mysqli_query($conn, $sql)){
                                //ECHO SUCCESS MESSAGE WITH TOAST
                                echo 'Check your email for verification.';
                                //echo'<span >', ucwords($firstname),' ',ucwords($lastname),'<span>', ' registered successfully! ';
                                sendEmail($email, $code);
                              }else{
                                echoError('0ca6');
                              }
                            }
                          }else{
                            echoError('0ca5');
                          }
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
        echo'Error occurred, Please reload the page! code : '. $level;
    }
    function randomString(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function sendEmail($email, $code){
        $to = $email;
        $subject = "Gold Place PH - Verification";

        $message = "
        <!DOCTYPE html>

        <html lang='en'>

        <head>
            <title>Gold Place PH - Verification</title>
            <style>
                .main{
                    width: 500px;
                    height: 250px;
                    font-family: Arial, Helvetica, sans-serif;
                }
                .header{
                    width: 100%;
                    height: 50px;
                    background-color: #ffc107;
                    border-radius: 40px 40px 0 0;
                }
                .body{
                    width: 100%;
                    height: 150px;
                    display: flex;
                    flex-direction: column;
                    padding-top: 20px;
                    align-items: center;
                    background-color: white;
                }
                .body p{
                    margin: 0;
                }
                .footer{
                    width: 100%;
                    height: 50px;
                    background-color: #212529;
                    border-radius: 0 0 40px 40px;
                }
                a{
                    padding: 15px;
                    text-decoration: none;
                    color: #212529;
                    background-color: #ffc107;
                    border-radius: 10px;
                }
            </style>
        </head>
        <body>
            <div class='main'>
                <div class='header'></div>
                <div class='body'>
                    <p>GOLD PLACE PH</p>
                    <h2>Click to verify</h2>
                    <a href='http://localhost/gold-place-ph/user-panel/login.php?verify=".$code."' target='_blank'>VERIFY NOW</a>
                </div>
                <div class='footer'></div>
            </div>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <admin@goldplaceph.com>' . "\r\n";

        mail($to,$subject,$message,$headers);
    }
?>