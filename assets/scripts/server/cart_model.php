<?php

class CartModel extends DbHelper
{
    //GET USER CART BY USER ID AND ITEM ID
    public function getUserCart($uid, $item_id)
    {
        $sql = "SELECT * FROM cart WHERE user_id = ? AND item_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($uid, $item_id))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }

    //GET USER CART BY CART ID
    public function getUserCartById($id)
    {
        $sql = "SELECT * FROM cart WHERE id = ? ";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($id))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    //GET USER CART BY USER ID
    public function getUserCartByUid($uid)
    {
        $sql = "SELECT * FROM cart WHERE user_id = ? ";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($uid))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    //GET USER CART BY USER ID AND CART ID
    public function getUserCartByUC($uid, $cart_id)
    {
        $sql = "SELECT * FROM cart WHERE user_id = ? AND id = ? ";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($uid, $cart_id))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }

    //INSERT CART
    public function setCart($item_id, $uid, $quantity, $date)
    {
        $sql = "INSERT INTO cart(item_id, user_id, quantity, date_created) VALUES (?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($item_id, $uid, $quantity, $date))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
    //UPDATE CART QUANTITY
    public function updateCart($quantity, $date, $cart_id, $user_id)
    {
        $sql = "UPDATE cart SET quantity = ?, date_updated = ? WHERE id = ? and user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($quantity, $date, $cart_id, $user_id))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    //DELETE CART
    public function deleteCart($id, $user_id)
    {
        $sql = "DELETE FROM cart WHERE id = ? AND user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($id, $user_id))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
}
