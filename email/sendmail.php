<?php
    $to = $email;
    $subject = "Gold Place PH - Verification";

    $message = "
            <!DOCTYPE html>

            <html lang='en'>

            <head>
                <title>Gold Place PH - Verification</title>
                <style>
                    .main{
                        width: 100%;
                        min-height: 500px;
                        font-family: Arial, Helvetica, sans-serif;
                        background-color: #f8f9fa;
                        padding: 60px 0px;
                    }
                    .main h2{
                        font-weight: 400;
                    }
                    .heading{
                        margin: 0px auto;
                        max-width: 400px;
                        display: flex;
                    }
                    .heading img{
                        margin-right: 10px;
                    }
                    .container{
                        max-width: 400px;
                        min-height: 400px;
                        margin: 0px auto;
                        background-color: white;
                        padding: 40px 40px;
                    }
                    .container .button{
                        margin: 40px 0px;
                    }
                    .container a{
                        font-size: 15px;
                        padding: 20px 40px;
                        margin: 80px 0px;
                        text-decoration: none;
                        color: white!important;
                        background-color: #212529;
                    }
                </style>
            </head>
                <body>
                    <div class='main'>
                        <div class='container'>
                            <div class='heading'>
                                <img src='http://goldplaceph.com/assets/images/defaults/logo-only.png' alt='GPPH' height='60'>
                                <h2>Gold Place PH</h2>
                            </div>
                            <h1>Verify your email address to use your account.</h1>
                            <h2>Your email account has been used to sign up on our website. If you are not aware of this, please ignore this message.</h2>
                           <div class='button'>
                                <a href='http://localhost/gold-place-ph-testing/login.php?verify=$code' target='_blank'>Verify email now</a>
                           </div>
                            <p>we're simply making sure this registration request is yours.</p>
                        </div>
                    </div>
                </body>
            </html>
            ";

    $headers = array(
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html;charset=UTF-8",
        "From" => "Gold-Place-PH <shop@goldplaceph.com>"
    );