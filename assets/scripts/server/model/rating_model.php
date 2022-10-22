<?php

class RatingModel extends DbHelper{
    use RatingTrait;
}

trait RatingTrait
{
    //CREATE

    //READ
    protected function getRatings($id)
    {
        $sql = "SELECT * FROM rating WHERE item_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($id))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    //UPDATE

    //DELETE
}

