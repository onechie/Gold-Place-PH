<?php

class UserAddressModel extends DbHelper
{
    use UserAddressTrait;
}

trait UserAddressTrait
{
    //CREATE
    protected function setUserAddress($number, $street, $city, $province, $user_id, $shipping_fee)
    {
        $sql = "INSERT user_address(user_id, house_number, barangay, city, province, shipping_fee) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array( $user_id, $number, $street, $city, $province, $shipping_fee))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
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
    protected function updateUserAddress($number, $street, $city, $province, $user_id, $shipping_fee)
    {
        $sql = "UPDATE user_address SET house_number = ?, barangay = ?, city = ?, province = ?, shipping_fee = ? WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($number, $street, $city, $province, $shipping_fee, $user_id))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
    //DELETE
}
