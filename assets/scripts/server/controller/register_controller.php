<?php

class RegisterController extends UserModel
{
    private function isEmpty($data)
    {
        if (empty($data) || $data == null) {
            return true;
        }
        return false;
    }

    private function isNameValid($name)
    {
        $namePattern = "/^([a-zA-Z])+([-. ]([a-zA-Z])+)?([-. ]([a-zA-Z])+)?$/";
        if (preg_match($namePattern, $name) && strlen($name) <= 20) {
            return true;
        }
        return false;
    }

    private function isEmailValid($email)
    {
        $emailPattern = "/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/";
        if (preg_match($emailPattern, $email)) {
            return true;
        }
        return false;
    }

    private function isPhoneValid($phone)
    {
        $phonePattern = "/((^(\+63)(\d{10}))|(^(0)(\d{10}))|(^(9)(\d{9})))$/";
        if (preg_match($phonePattern, $phone)) {
            return true;
        }
        return false;
    }

    private function isPassValid($password)
    {
        if (strlen($password) >= 8 &&  strlen($password) <= 100) {
            return true;
        }
        return false;
    }

    public function isEmailExist($email)
    {
        if (count($this->getUserByEmail($email)) > 0) {
            return true;
        }
        return false;
    }

    public function isPhoneExist($phone)
    {
        $tenDigitPhone = substr($phone, -10);
        $withZeroDigitPhone = '0' . $tenDigitPhone;
        $withPlusDigitPhone =  '+63' . $tenDigitPhone;

        if (count($this->getUserByPhone($tenDigitPhone)) > 0) {
            return true;
        }
        if (count($this->getUserByPhone($withZeroDigitPhone)) > 0) {
            return true;
        }
        if (count($this->getUserByPhone($withPlusDigitPhone)) > 0) {
            return true;
        }
        return false;
    }

    public function createAccount($firstname, $lastname, $email, $phone, $password, $verified, $type)
    {
        if (!$this->isNameValid($firstname)) {
            return false;
        }
        if (!$this->isNameValid($lastname)) {
            return false;
        }
        if (!$this->isEmailValid($email)) {
            return false;
        }
        if (!$this->isPhoneValid($phone)) {
            return false;
        }
        if (!$this->isPassValid($password)) {
            return false;
        }
        if ($this->isEmailExist($email)) {
            return false;
        }
        if ($this->isPhoneExist($phone)) {
            return false;
        }

        $code = $this->generateCode();
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

        if ($verified == 'no') {
            if (!$this->sendEmail($email, $code)) {
                return false;
            }
        }

        $userData = [$firstname, $lastname, $email, $phone, $passwordHashed, $verified, $type, $code];

        if (!$this->setUser($userData)) {
            return false;
        }
        return true;
    }

    private function generateCode()
    {
        return password_hash(md5(strtotime("now")), PASSWORD_DEFAULT);
    }

    private function sendEmail($email, $code)
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
}
