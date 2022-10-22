<?php

class VerifyController extends UserModel
{
    private function isCodeExist($code)
    {
        if (count($this->getUserByCode($code)) > 0) {
            return true;
        }
        return false;
    }

    public function verify($code)
    {
        if (!$this->isCodeExist($code)) {
            return false;
        }
        $user = $this->getUserByCode($code)[0];
        if ($this->updateUserVerById($user['id'])){
            return true;
        }
        return false;
    }
}
