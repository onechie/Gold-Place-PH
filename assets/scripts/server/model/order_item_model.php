<?php

class OrderItemModel extends DbHelper
{
    use OrderItemTrait;
}

trait OrderItemTrait
{
    //CREATE
    protected function setOrderItems($order_id, $item_id, $quantity, $can_rate)
    {
        $sql = "INSERT order_item(order_id, item_id, quantity, can_rate) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($order_id, $item_id, $quantity, $can_rate))) {
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }
    //READ
    protected function getOrderItem($order_id, $item_id)
    {
        $sql = "SELECT * FROM order_item WHERE order_id = ? AND item_id = ? AND can_rate = 'yes'";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($order_id, $item_id))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }

    protected function getOrderItemBy_OID($order_id)
    {
        $sql = "SELECT * FROM order_item WHERE order_id = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($order_id))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    //UPDATE
    protected function updateOrderItem($orderItemId, $can_rate)
    {
        $sql = "UPDATE order_item SET can_rate = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($can_rate, $orderItemId))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
    protected function updateOrderItemsBy_OID($order_id, $can_rate)
    {
        $sql = "UPDATE order_item SET can_rate = ? WHERE order_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($can_rate, $order_id))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
    //DELETE
}
