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

function checkAddItemInputs($name, $category, $price, $stocks, $description)
{
    $checkName = $name;
    $checkCategory = $category;
    $checkPrice = (int)$price;
    $checkStocks = (int)$stocks;
    $checkDescription = $description;

    //VALIDATE IF THERE IS EMPTY VALUE
    if (empty($checkName)) return false;
    if (empty($checkCategory)) return false;
    if ($checkPrice <= 0) return false;
    if ($checkStocks <= 0) return false;
    if (empty($checkDescription)) return false;

    return true;
}
