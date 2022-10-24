<?php

class UserModel extends DbHelper
{
    use UserTrait;
}

trait UserTrait
{
    //CREATE
    protected function setUser($userData)
    {
        $sql = "INSERT user(firstname, lastname, email, phone, password, verified, type, verification_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute($userData)) {
            $stmt = null;
            exit();
        }

        $stmt = null;
        return true;
    }
    //READ
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
    protected function getUserById($id)
    {
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($id))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getUserByEmail($email)
    {
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($email))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getUserByPhone($phone)
    {
        $sql = "SELECT * FROM user WHERE phone = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($phone))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getUserByCode($code)
    {
        $sql = "SELECT * FROM user WHERE verification_code = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($code))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getUserImage($id)
    {
        $directory = '../../../images/users/' . $id;
        if (!is_dir($directory)) {
            mkdir($directory);
        }
        $files = array_diff(scandir($directory), array('..', '.'));
        $file = array();
        foreach ($files as $value) {
            $file[] = $value;
            break;
        }
        return $file;
    }
    //UPDATE
    protected function updateUserVerById($id)
    {
        $sql = "UPDATE user set verified = 'yes' WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($id))) {
            $stmt = null;
            exit();
        }

        $stmt = null;
        return true;
    }
    protected function updateUserImage($id){
        if ($_FILES["images"]["tmp_name"][0] == null) {
            return true;
        }
    
        $specificDirectory = "../../../images/users/" . $id . "/";
        if (!is_dir($specificDirectory)) {
            mkdir($specificDirectory);
        } else {
            $files = glob($specificDirectory . '*');
            foreach ($files as $file) {
                //CHECK IF TRUE FILE
                if (is_file($file)) {
                    //DELETE THE FILE
                    unlink($file);
                }
            }
        }
    
        $target_file = $specificDirectory . basename($_FILES["images"]["name"][0]);
    
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        //CHECK IF TRUE IMAGE USING "getimagesize"
        $check = getimagesize($_FILES["images"]["tmp_name"][0]);
    
        if ($check) {
        } else {
            return false;
            return 'not_image';
        }
    
        // CHECK IF FILE ALREADY EXISTS
        if (file_exists($target_file)) {
            return false;
            return 'image_exists';
        }
    
        // CHECK FILE SIZE
        if ($_FILES["images"]["size"][0] > 2000000) {
            return false;
            return 'image_large';
        }
    
        // CHECK FILE FORMAT
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            return false;
            return 'invalid_format';
        }
    
        $new_file_name = $specificDirectory . md5($_FILES["images"]["name"][0]) . "." . strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        //INSERT FILE TO SERVER
        if (move_uploaded_file($_FILES["images"]["tmp_name"][0], $new_file_name)) {
            return true;
            return 'ok';
        } else {
            return false;
            return 'failed';
        }
    }
    //DELETE
}