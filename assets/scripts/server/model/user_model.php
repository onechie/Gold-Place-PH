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
    //DELETE
}