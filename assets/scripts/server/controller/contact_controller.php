<?php

class ContactController{
    public function sendEmail($name, $email, $message){
        if(!$this->isNameValid($name)){
            return false;
        }
        if(!$this->isEmailValid($email)){
            return false;
        }
        if(!$this->isMessageValid($message)){
            return false;
        }
        if(!$this->tryToSendEmail($name, $email, $message)){
            return false;
        }
        return true;
    }
    private function isNameValid($name){
        $namePattern = "/^([a-zA-Z])+([-. ]([a-zA-Z])+)?([-. ]([a-zA-Z])+)?$/";
        if (preg_match($namePattern, $name) && strlen($name) <= 20) {
            return true;
        }
        return false;
    }
    private function isEmailValid($email){
        $emailPattern = "/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/";
        if (preg_match($emailPattern, $email)) {
            return true;
        }
        return false;
    }
    private function isMessageValid($message){
        if(strlen($message) > 0){
            return true;
        }
        return false;
    }
    private function tryToSendEmail($name, $email, $message){    
        
        $to = 'shop@goldplaceph.com';
        $subject = "Contact form - $name";

        $messageFormat = "

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
                </style>
            </head>
                <body>
                    <div class='main'>
                        <div class='container'>
                            <div class='heading'>
                                <img src='http://goldplaceph.com/assets/images/defaults/logo-only.png' alt='GPPH' height='60'>
                                <h2>Gold Place PH</h2>
                            </div>
                            <h1>Contact form</h1>
                            <h2>Name: $name</h2>
                            <h2>Email: $email</h2>
                            <p>Message: $message</p>
                        </div>
                    </div>
                </body>
            </html>
            ";


    
        $headers = array(
            "MIME-Version" => "1.0",
            "Content-Type" => "text/html;charset=UTF-8",
            "From" => "$email"
        );
        if (mail($to, $subject, $messageFormat, $headers)) {
            return true;
        }
        return false;

    }
}
