<?php

class ProvinceListModel extends DbHelper
{
    use ProvinceListTrait;
}

trait ProvinceListTrait
{
    //CREATE

    //READ
    protected function getProvinceList()
    {
        $sql = 'SELECT * FROM province_list';
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
}
