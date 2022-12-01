<?php

class OrderModel extends DbHelper
{
    use OrderTrait;
}

trait OrderTrait
{
    //CREATE
    protected function setOrder($user_id, $items, $status, $date_created, $available, $user_address, $shipping_fee)
    {
        $sql = "INSERT orders(user_id, items, status, date_created, available, address, shipping_fee) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($user_id, $items, $status, $date_created, $available, $user_address, $shipping_fee))) {
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }
    //READ
    public function getOrderBy_OID($order_id)
    {
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($order_id))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
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

    protected function getOrderId($user_id, $items, $status, $date_created)
    {
        $sql = "SELECT * FROM orders WHERE user_id = ? AND items = ? AND status = ? AND date_created = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($user_id, $items, $status, $date_created))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getOrderBy_UID($user_id)
    {
        $sql = "SELECT * FROM orders WHERE user_id = ?";

        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($user_id))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    public function getOrdersByDate($min_date, $max_date)
    {
        $sql = "SELECT * FROM orders WHERE date_updated > ? AND date_updated < ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($min_date, $max_date))) {
            $stmt = null;
            return false;
        }
        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    public function getOrders()
    {
        $sql = "SELECT * FROM orders ";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute()) {
            $stmt = null;
            return false;
        }
        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    //UPDATE
    public function updateOrderStatus($status, $date, $id)
    {
        $sql = "UPDATE orders SET status = ?, date_updated = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($status, $date, $id))) {
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }
    public function updateOrderStatusAndMessage($status, $status_message, $date, $id)
    {
        $sql = "UPDATE orders SET status = ?, status_message = ?, date_updated = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($status, $status_message, $date, $id))) {
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }
    public function updateOrderAvailable($available, $id)
    {
        $sql = "UPDATE orders SET available = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($available, $id))) {
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }
    //DELETE
}
