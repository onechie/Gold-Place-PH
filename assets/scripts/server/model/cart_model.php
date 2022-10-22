<?php

class CartModel extends DbHelper
{
    use CartTrait;
}
trait CartTrait
{
    //CREATE
    public function setCart($item_id, $user_id, $quantity, $date)
    {
        $sql = "INSERT INTO cart(item_id, user_id, quantity, date_created) VALUES (?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($item_id, $user_id, $quantity, $date))) {
            $stmt = null;
            exit();
        }
        $stmt = null;
        return true;
    }
    //READ
    protected function getCartBy_UID_IID($user_id, $item_id)
    {
        $sql = "SELECT * from cart WHERE user_id = ? and item_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($user_id, $item_id))) {
            $stmt = null;
            exit();
        }
        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getCartBy_UID($user_id)
    {
        $sql = "SELECT * from cart WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($user_id))) {
            $stmt = null;
            exit();
        }
        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getCartBy_ID($cart_id)
    {
        $sql = "SELECT * from cart WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($cart_id))) {
            $stmt = null;
            exit();
        }
        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    //UPDATE
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
    //DELETE
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
