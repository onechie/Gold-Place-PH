<?php

class CityListModel extends DbHelper
{
    use CityListTrait;
}

trait CityListTrait
{
    //CREATE

    //READ
    protected function getCityList()
    {
        $sql = 'SELECT * FROM city_list';
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute()) {
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
}
