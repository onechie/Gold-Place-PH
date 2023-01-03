<?php

class BarangayListModel extends DbHelper
{
    use BarangayListTrait;
}

trait BarangayListTrait
{
    //CREATE
    protected function setBarangay($barangay, $city, $city_id, $shipping_fee){
        $sql = 'INSERT barangay_list(barangay, city, city_id, shipping_fee) VALUES (?, ?, ?, ?)';
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute(array($barangay, $city, $city_id, $shipping_fee))){
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }
    //READ
    protected function getBarangayList()
    {
        $sql = 'SELECT * FROM barangay_list ORDER BY city, barangay';
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getBarangayListByCity($city)
    {
        $sql = 'SELECT * FROM barangay_list WHERE city = ? ORDER BY barangay';
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($city))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getBarangay($barangay)
    {
        $sql = 'SELECT * FROM barangay_list WHERE barangay = ?';
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($barangay))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getBarangayWithCity($barangay, $city)
    {
        $sql = 'SELECT * FROM barangay_list WHERE barangay = ? AND city = ?';
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($barangay, $city))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    //UPDATE

    //DELETE
    protected function deleteBarangay($id){
        $sql = "DELETE FROM barangay_list WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute(array($id))){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
}
