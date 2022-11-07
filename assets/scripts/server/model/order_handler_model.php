<?php

class OrderHandlerModel extends DbHelper
{
    use OrderHandlerTrait;
}

trait OrderHandlerTrait
{
    //CREATE
    protected function setOrderHandler($driver_id, $order_id){
        $sql = "INSERT order_handler(driver_id, order_id) VALUES (?, ?)";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($driver_id, $order_id))){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
    //READ
    protected function getOrderHandlerBy_OID($order_id)
    {
        $sql = "SELECT * FROM order_handler WHERE order_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($order_id))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getOrderHandlerBy_DID($driver_id)
    {
        $sql = "SELECT * FROM order_handler WHERE driver_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($driver_id))) {
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
