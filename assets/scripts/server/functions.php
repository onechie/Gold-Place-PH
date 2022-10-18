<?php
//CHECK IF NAME IS VALID
function isNameValid($name)
{
    $namePattern = "/^([a-zA-Z])+([-. ]([a-zA-Z])+)?([-. ]([a-zA-Z])+)?$/";
    if (preg_match($namePattern, $name) && strlen($name) <= 20) {
        return true;
    }
    return false;
}
//CHECK IF EMAIL IS VALID
function isEmailValid($email)
{
    $emailPattern = "/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/";
    if (preg_match($emailPattern, $email)) {
        return true;
    }
    return false;
}
//CHECK IF PHONE IS VALID
function isPhoneValid($phone)
{
    $phonePattern = "/((^(\+63)(\d{10}))|(^(0)(\d{10}))|(^(9)(\d{9})))$/";
    if (preg_match($phonePattern, $phone)) {
        return true;
    }
    return false;
}
//CHECK IF PASSWORD IS VALID
function isPassValid($password)
{
    if (strlen($password) >= 8 &&  strlen($password) <= 100) {
        return true;
    }
    return false;
}
//GET RANDOM STRING FOR VERIFICATION CODE
function randomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
//SEND EMAIL VERIFICATION
function sendEmail($email, $code)
{
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
            border: 1px solid gray;
            border-radius: 10px;
        }
        .header{
            width: 100%;
            height: 50px;
            background-color: white;
            border-radius: 40px 40px 0 0;
        }
        .body{
            width: 100%;
            height: 120px;
            padding-top: 20px;
            align-items: center;
            background-color: #f8f9fa;
        }
        .body p{
            margin: 0;
            text-align: center;
        }
        .body h2{
            margin: 0;
            text-align: center;
            padding-bottom: 20px;
        }
        .footer{
            width: 100%;
            height: 50px;
            background-color: white;
            border-radius: 0 0 40px 40px;
        }
        a{
            margin: auto 0px;
            padding: 15px;
            text-decoration: none;
            color: black!important;
            background-color: #ffc107;
            border-radius: 7px;
        }
          
        </style>
    </head>
    <body>
        <div class='main'>
            <div class='header'></div>
            <div class='body'>
                <p>GOLD PLACE PH</p>
                <h2>Click to verify</h2>
                <p><a href='http://localhost/gold-place-ph/login.php?verify=" . $code . "' target='_blank'>VERIFY NOW</a></p>
            </div>
            <div class='footer'></div>
        </div>
    </body>
    </html>
    ";

    $headers = array(
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html;charset=UTF-8"
    );

    if (mail($to, $subject, $message, $headers)) {
        return true;
    }
    return false;
}

//UPDATE USER IMAGE
function update_image($id)
{
    if ($_FILES["images"]["tmp_name"][0] == null) {
        return "ok";
    }

    $specificDirectory = "../../images/users/" . $id . "/";
    if (!is_dir($specificDirectory)) {
        mkdir($specificDirectory);
    } else {
        $files = glob($specificDirectory . '*');
        foreach ($files as $file) {
            //CHECK IF TRUE FILE
            if (is_file($file)) {
                //DELETE THE FILE
                unlink($file);
            }
        }
    }

    $target_file = $specificDirectory . basename($_FILES["images"]["name"][0]);

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //CHECK IF TRUE IMAGE USING "getimagesize"
    $check = getimagesize($_FILES["images"]["tmp_name"][0]);

    if ($check) {
    } else {
        return 'not_image';
    }

    // CHECK IF FILE ALREADY EXISTS
    if (file_exists($target_file)) {
        return 'image_exists';
    }

    // CHECK FILE SIZE
    if ($_FILES["images"]["size"][0] > 2000000) {
        return 'image_large';
    }

    // CHECK FILE FORMAT
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        return 'invalid_format';
    }

    $new_file_name = $specificDirectory . md5($_FILES["images"]["name"][0]) . "." . strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //INSERT FILE TO SERVER
    if (move_uploaded_file($_FILES["images"]["tmp_name"][0], $new_file_name)) {
        return 'ok';
    } else {
        return 'failed';
    }
}
