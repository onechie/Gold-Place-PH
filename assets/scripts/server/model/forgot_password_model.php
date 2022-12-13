<?php

class ForgotPasswordModel extends DbHelper
{
    use ForgotPasswordTrait;
}

trait ForgotPasswordTrait
{
    //CREATE
    protected function setForgotPassword($email, $user_id, $token, $date_created, $status){
        $sql = 'INSERT forgot_password(email, user_id, token, date_created, status) VALUES (?,?,?,?,?)';
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute(array($email, $user_id, $token, $date_created, $status))){
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }
    //READ
    protected function getForgotPasswordBy_TK($token)
    {
        $sql = 'SELECT * FROM forgot_password WHERE token = ?';
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($token))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    //UPDATE
    protected function updateFPStatusBy_TK($reset_token, $status)
    {
        $sql = "UPDATE forgot_password set status = ? WHERE token = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($status, $reset_token))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    //DELETE
    protected function deleteProvince($id){
        $sql = "DELETE FROM province_list WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute(array($id))){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
}
