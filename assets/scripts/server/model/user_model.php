<?php

class UserModel extends DbHelper
{

    //GET ALL USER DATA
    protected function getUsers()
    {
        $sql = "SELECT * FROM user";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }

    //GET SINGLE USER DATA WITH ID
    protected function getUser($id)
    {
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute($id)) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }

    //INSERT USER DATA
    protected function setUser($userData)
    {
        $sql = "INSERT user(firstname, lastname, email, phone, password, verified, type) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute($userData)) {
            $stmt = null;
            exit();
        }

        $stmt = null;
    }

    //CHECK USER EMAIL IF EXISTS
    protected function isEmailExists($email)
    {
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            exit();
        }

        if ($stmt->rowCount() > 0) {
            return true;
        }
        $stmt = null;
        return false;
    }

    //CHECK USER PHONE IF EXISTS
    protected function isPhoneExists($phone)
    {
        $tenDigitPhone = substr($phone, -10);
        $withZeroDigitPhone = '0' . $tenDigitPhone;
        $withPlusDigitPhone =  '+63' . $tenDigitPhone;

        $sql = "SELECT * FROM user WHERE phone = ? OR phone = ? OR phone = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($tenDigitPhone, $withZeroDigitPhone, $withPlusDigitPhone))) {
            $stmt = null;
            exit();
        }

        if ($stmt->rowCount() > 0) {
            return true;
        }
        $stmt = null;
        return false;
    }

    //UPDATE USER VERIFIED COLUMN
    protected function setVerified($email)
    {
        $sql = "UPDATE user SET verified='yes' WHERE email= ? ";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($email))) {
            $stmt = null;
            exit();
        }

        $stmt = null;
        return true;
    }
}
