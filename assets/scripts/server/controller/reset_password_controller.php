<?php

class ResetPasswordController extends ForgotPasswordModel
{
    use UserTrait;

    public function isTokenValid($token)
    {
        if (count($this->getForgotPasswordBy_TK($token)) > 0) {
            return true;
        }
        return false;
    }
    public function resetPassword($reset_token, $new_password){
        if(!$this->isTokenValid($reset_token)){
            return false;
        }
        if(!$this->isTokenExpired($reset_token)){
            return false;
        }
        if(!$this->isLinkOpen($reset_token)){
            return false;
        }

        $user_id = $this->getForgotPasswordBy_TK($reset_token)[0]['user_id'];
        $status = 'close';

        if(!$this->updateUserPasswordBy_ID($user_id, $new_password)){
            return false;
        }
        $this->updateFPStatusBy_TK($reset_token, $status);
        return true;
    }

    public function isTokenExpired($token){
        $date_created = $this->getForgotPasswordBy_TK($token)[0]['date_created'];
        $date_expired = strtotime("+1 hour", strtotime($date_created));
        $currentDate = strtotime(date("Y-m-d H:i:s"));

        if($currentDate >= $date_expired){
            return false;
        }
        return true;
    }
    public function isLinkOpen($token){
        $status = $this->getForgotPasswordBy_TK($token)[0]['status'];
        if($status == 'open'){
            return true;
        }
        return false;
    }
}
