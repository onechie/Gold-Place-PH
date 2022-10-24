<?php

class RatingModel extends DbHelper
{
    use RatingTrait;
}

trait RatingTrait
{
    //CREATE
    protected function setRating($item_id, $message, $score, $user_id)
    {
        $sql = "INSERT rating(item_id, message, score, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($item_id, $message, $score, $user_id))) {
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }
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
