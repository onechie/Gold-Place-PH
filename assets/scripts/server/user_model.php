<?php

class UserModel extends DbHelper
{
    public function getUsers()
    {

        $sql = "SELECT * FROM user";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute()) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;

        $usersData = array();

        foreach ($results as $result) {
            $usersData[] = array(
                "id" => $result['id'],
                "first_name" => $result['firstname'],
                "last_name" => $result['lastname'],
                "email" => $result['email'],
                "phone" => $result['phone'],
                "password" => $result['password'],
                "verified" => $result['verified'],
                "type" => $result['type'],
                "purchased" => $result['purchased'],
                "image" => $this->getUserImage($result['id'])
            );
        }
        return $usersData;
    }

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
        if(!is_dir($directory)){
            mkdir($directory);
            return '';
        }
        $files = array_diff(scandir($directory), array('..', '.'));
        $file = array();
        foreach ($files as $value) {
            $file[] = $value;
            break;
        }
        return $file;
    }
    public function countUsers()
    {
        $sql = "SELECT * FROM user";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute()) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $count = 0;
        foreach($results as $result){
            $count++;
        }
        $stmt = null;
        return $count;
    }
}
