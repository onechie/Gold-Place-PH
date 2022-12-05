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

    private function isPasswordSame($password, $confirm_password){
        if($password == $confirm_password){
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

    public function createAccount($firstname, $lastname, $email, $phone, $password, $confirm_password, $verified, $type)
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
        if(!$this->isPasswordSame($password,$confirm_password)){
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
        include '../../../../email/sendmail.php';

        if (mail($to, $subject, $message, $headers)) {
            return true;
        }
        return false;
    }
}
