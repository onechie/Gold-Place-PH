<?php
    
    $to = "louenrypeanut@gmail.com";
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
                <p><a href='http://localhost/gold-place-ph/login.php?verify=" . 'test-mail' . "' target='_blank'>VERIFY NOW</a></p>
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
    
    if(mail($to, $subject, $message, $headers)){
        echo 'success';
    } else {
        echo 'failed';
    }