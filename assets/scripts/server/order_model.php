<?php

class OrderModel extends DbHelper
{
    //GET USER ORDERS BY ID AND STATUS
    public function getUserOrders($user_id, $status)
    {
        $sql = "SELECT * FROM orders WHERE user_id = ? AND status = ?";
        if ($status == 'processing') {
            $sql = "SELECT * FROM orders WHERE user_id = ? AND (status = ? OR status = 'checking')";
        }

        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($user_id, $status))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }

    //INSERT ORDER
    public function setOrder($user_id, $items, $status, $date_created)
    {
        $sql = "INSERT orders(user_id, items, status, date_created) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($user_id, $items, $status, $date_created))) {
            $stmt = null;
            return false;
        }

        $stmt = null;

        $sql = "SELECT * FROM orders WHERE user_id = ? AND items = ? AND status = ? AND date_created = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($user_id, $items, $status, $date_created))) {
            $stmt = null;
            return false;
        }

        $order_id = $stmt->fetchAll()[0]['id'];
        return $order_id;
    }

    //INSERT ITEMS OF SPECIFIC ORDER
    public function setOrderItems($order_id, $item_id, $quantity, $can_rate)
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

    //GET ORDER ITEMS BY ORDER ID
    public function getOrderItems($order_id)
    {
        $sql = "SELECT * FROM order_item WHERE order_id = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($order_id))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }

    //GET ORDER COUNT BY USER ID
    public function getOrderCount($user_id)
    {
        $sql = "SELECT * FROM orders WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($user_id))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;

        $orders = 0;
        $cancelled = 0;
        $delivered = 0;
        $processing = 0;

        foreach ($results as $result) {
            if ($result['status'] == 'cancelled') {
                $cancelled++;
            } else if ($result['status'] == 'processing' || $result['status'] == 'checking') {
                $processing++;
            } else {
                $delivered++;
            }
            $orders++;
        }
        $orderCount = array(
            "orders" => $orders,
            "cancelled" => $cancelled,
            "delivered" => $delivered,
            "processing" => $processing
        );
        return $orderCount;
    }

    //UPDATE CAN_RATE STATUS OF ORDER ITEM
    public function updateOrderItem($orderItemId, $status)
    {
        $sql = "UPDATE order_item SET can_rate = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($status, $orderItemId))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
}
