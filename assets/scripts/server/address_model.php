<?php

class AddressModel extends DbHelper
{
    //CHECK IF ADDRESS IS VALID
    public function isAddressValid($id)
    {
        $sql = "SELECT * FROM user_address WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($id))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        if ($results[0]['house_number'] == '' || $results[0]['barangay'] == '' || $results[0]['city'] == '' || $results[0]['province'] == '') {
            return false;
        }
        return true;
    }

    //GET ADDRESS BY USER ID
    public function getAddressById($id)
    {
        $sql = "SELECT * FROM user_address WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($id))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    
    //UPDATE ADDRESS OR INSERT IF NOT EXISTED
    public function updateAddress($user_id, $number, $street, $city, $province)
    {
        $sql = "INSERT INTO user_address (house_number, barangay, city, province) VALUES (?, ?, ?, ?)";
        if (count($this->getAddressById($user_id)) > 0) {
            $sql = "UPDATE user_address SET house_number = ?, barangay = ?, city = ?, province = ?";
        }
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($number, $street, $city, $province))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
    //GET THE LIST OF AVAILABLE CITIES
    public function getCityList()
    {
        $sql = "SELECT * FROM city_list";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute()) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        $city = array();
        foreach ($results as $result) {
            $city[] = $result['city'];
        }
        return $city;
    }

    //GET THE LIST OF AVAILABLE PROVINCES
    public function getProvinceList()
    {
        $sql = "SELECT * FROM province_list";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute()) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        $province = array();
        foreach ($results as $result) {
            $province[] = $result['province'];
        }
        return $province;
    }

    //CHECK IF CITY IS VALID
    public function isCityExists($city)
    {
        $sql = "SELECT * FROM city_list WHERE city = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($city))) {
            $stmt = null;
            return false;
        }

        if (count($stmt->fetchAll()) > 0) {
            $stmt = null;
            return true;
        }
        $stmt = null;
        return false;
    }

    //CHECK IF PROVICE IS VALID
    public function isProvinceExists($province)
    {
        $sql = "SELECT * FROM province_list WHERE province = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($province))) {
            $stmt = null;
            return false;
        }

        if (count($stmt->fetchAll()) > 0) {
            $stmt = null;
            return true;
        }
        $stmt = null;
        return false;
    }
}
