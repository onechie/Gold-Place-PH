<?php

class ForgotPasswordController extends ForgotPasswordModel
{
    use UserTrait;

    public function isUserExists($email)
    {
        if (count($this->getUserByEmail($email)) > 0) {
            return true;
        }
        return false;
    }
    public function createLink($email, $date)
    {
        $user_id = $this->getUserByEmail($email)[0]['id'];

        $token = $email.(string)strtotime("now").(string)$user_id;
        $hashedToken = password_hash(md5($token), PASSWORD_DEFAULT);
        $status = 'open';


        //insert to database
        if(!$this->setForgotPassword($email, $user_id, $hashedToken, $date, $status)){
            return false;
        }
        //send link
        if(!$this->sendEmail($email, $hashedToken)){
            return false;
        }
        return true;
    }
    private function sendEmail($email, $code)
    {
        include '../../../../email/send_forgot_password.php';

        if (mail($to, $subject, $message, $headers)) {
            return true;
        }
        return false;
    }
}
