<?php

class ProvinceListModel extends DbHelper
{
    use ProvinceListTrait;
}

trait ProvinceListTrait
{
    //CREATE
    protected function setProvince($province){
        $sql = 'INSERT province_list(province) VALUES (?)';
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute(array($province))){
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }
    //READ
    protected function getProvinceList()
    {
        $sql = 'SELECT * FROM province_list ORDER BY province';
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getProvince($province)
    {
        $sql = 'SELECT * FROM province_list WHERE province = ?';
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($province))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    //UPDATE

    //DELETE
    protected function deleteProvince($id){
        $sql = "DELETE FROM province_list WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute(array($id))){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
}
