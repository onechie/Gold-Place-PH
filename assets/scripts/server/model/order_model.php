<?php

class OrderModel extends DbHelper
{
    use OrderTrait;
}

trait OrderTrait
{
    //CREATE
    public function setOrder($user_id, $items, $status, $date_created)
    {
        $sql = "INSERT orders(user_id, items, status, date_created) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($user_id, $items, $status, $date_created))) {
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }
    //READ
    protected function getOrderByUidAndStatus($user_id, $status)
    {
        $sql = "SELECT * FROM orders WHERE user_id = ? AND status = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($user_id, $status))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }

    protected function getOrderId($user_id, $items, $status, $date_created){
        $sql = "SELECT * FROM orders WHERE user_id = ? AND items = ? AND status = ? AND date_created = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($user_id, $items, $status, $date_created))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        return $results;
    }
    //UPDATE

    //DELETE
}
