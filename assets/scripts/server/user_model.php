<?php

class UserModel extends DbHelper
{
    //GET SINGLE USER DATA BY ID
    public function getUserById($id)
    {
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($id))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }

    //GET SINGLE USER DATA BY EMAIL
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($email))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }

    //GET SINGLE USER DATA BY PHONE
    public function getUserByPhone($phone)
    {
        $tenDigitPhone = substr($phone, -10);
        $withZeroDigitPhone = '0' . $tenDigitPhone;
        $withPlusDigitPhone =  '+63' . $tenDigitPhone;

        $sql = "SELECT * FROM user WHERE phone = ? OR phone = ? OR phone = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($tenDigitPhone, $withZeroDigitPhone, $withPlusDigitPhone))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }

    //GET SINGLE USER DATA BY EMAIL
    public function getUserByCode($code)
    {
        $sql = "SELECT * FROM user WHERE verification_code = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($code))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }

    //INSERT USER DATA
    public function setUser($userData)
    {
        $sql = "INSERT user(firstname, lastname, email, phone, password, verified, type, verification_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute($userData)) {
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }

    //UPDATE USER VERIFIED DATA BY ID
    public function setUserVerified($id)
    {
        $sql = "UPDATE user SET verified = 'yes' WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($id))) {
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }
    
    //GET USER IMAGE BY ID
    public function getUserImage($id)
    {
        $directory = '../../images/users/' . $id;
        $files = array_diff(scandir($directory), array('..', '.'));
        $file = array();
        foreach ($files as $value) {
            $file[] = $value;
            break;
        }
        return $file;
    }
}
