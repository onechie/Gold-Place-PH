<?php

class LoginController extends UserModel
{
    public function isEmailExist($email)
    {
        if (count($this->getUserByEmail($email)) > 0) {
            return true;
        }
        return false;
    }

    public function isEmailVerified($email)
    {
        if ($this->getUserByEmail($email)[0]['verified'] == 'yes') {
            return true;
        }
        return false;
    }

    public function isBlocked($email)
    {
        if ($this->getUserByEmail($email)[0]['status'] == 'blocked') {
            return true;
        }
        return false;
    }

    public function login($email, $password)
    {
        if (!$this->isEmailExist($email)) {
            return false;
        }
        if (!$this->isEmailVerified($email)) {
            return false;
        }

        $user = $this->getUserByEmail($email)[0];

        if (!password_verify($password, $user['password'])) {
            return false;
        }
        if($this->isBlocked($email)){
            return false;
        }
        
        $_SESSION["userId"] = $user['id'];
        $_SESSION["userEmail"] = $user['email'];
        $_SESSION["userType"] = $user['type'];
        $_SESSION["userName"] = $user['firstname'] . " " . $user['lastname'];

        return true;
    }
}
