<?php

class OrderModel extends DbHelper
{
    use OrderTrait;
}

trait OrderTrait
{
    //CREATE
    protected function setOrder($user_id, $items, $status, $date_created, $available, $user_address, $shipping_fee, $payment_method)
    {
        $sql = "INSERT orders(user_id, items, status, date_created, available, address, shipping_fee, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($user_id, $items, $status, $date_created, $available, $user_address, $shipping_fee, $payment_method))) {
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
    public function getOrderBy_REF($reference_number)
    {
        $sql = "SELECT * FROM orders WHERE ref_number = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($reference_number))) {
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
    protected function getOrderProofImage($order_id, $isMultiple)
    {
        $directory = '../../../images/proofs/' . $order_id;
        $files = array_diff(scandir($directory), array('..', '.'));
        $file = array();
        foreach ($files as $value) {
            $file[] = $value;
            if (!$isMultiple) break;
        }
        return $file;
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
    public function updateOrderRef($order_id, $reference_number)
    {
        $sql = "UPDATE orders SET ref_number = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($reference_number, $order_id))) {
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
    protected function updateOrderProofImage($order_id)
    {

        $len = count($_FILES['images']['name']);
        $directory = "../../../images/proofs/" . $order_id . "/";

        if (!is_dir($directory)) {
            mkdir($directory);
        } else {
            $files = glob($directory . '*');
            foreach ($files as $file) {
                //CHECK IF TRUE FILE
                if (is_file($file)) {
                    //DELETE THE FILE
                    unlink($file);
                }
            }
        }

        //VALIDATION PASSED NOW TRY TO INSERT INTO SERVER
        for ($i = 0; $i < $len; $i++) {

            $target_file = $_FILES["images"]["name"][$i];
            $new_file_name = $directory . md5($_FILES["images"]["name"][$i]) . "." . strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            //INSERT FILE TO SERVER
            if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $new_file_name)) {
            } else {
                //echo 'failedImage';
                return false;
            }
        }

        return true;
    }
    //DELETE
    protected function deleteOrderBy_ID($order_id){
        $sql = "DELETE FROM orders WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute(array($order_id))){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
}
