<?php

class UserAddressModel extends DbHelper{
    use UserAddressTrait;
}

trait UserAddressTrait
{
    //CREATE

    //READ
    protected function getAddressBy_UID($user_id)
    {
        $sql = "SELECT * FROM user_address WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($user_id))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    //UPDATE

    //DELETE
}

