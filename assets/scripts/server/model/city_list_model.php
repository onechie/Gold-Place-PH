<?php

class CityListModel extends DbHelper
{
    use CityListTrait;
}

trait CityListTrait
{
    //CREATE
    protected function setCity($city, $province, $province_id){
        $sql = 'INSERT city_list(city, province, province_id) VALUES (?, ?, ?)';
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute(array($city, $province, $province_id))){
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }
    //READ
    protected function getCityList()
    {
        $sql = 'SELECT * FROM city_list ORDER BY province, city';
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getCityListByProvince($province)
    {
        $sql = 'SELECT * FROM city_list WHERE province = ? ORDER BY city';
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($province))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getCity($city)
    {
        $sql = 'SELECT * FROM city_list WHERE city = ?';
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($city))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    //UPDATE

    //DELETE
    protected function deleteCity($id){
        $sql = "DELETE FROM city_list WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute(array($id))){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
}
