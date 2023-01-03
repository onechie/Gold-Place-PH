<?php

class DriverOrderListController extends OrderModel
{
    use UserTrait, ItemTrait, OrderItemTrait, UserAddressTrait, OrderHandlerTrait;

    public function orderHandlersData($driver_id)
    {
        if (!$this->isUserDriver($driver_id)) {
            return false;
        }

        $orderHandlersData = array();
        $orders = $this->getOrderHandlerBy_DID($driver_id);

        if (count($orders) == 0) {
            return false;
        }

        foreach ($orders as $order) {
            $order_id = $order['order_id'];
            $status = $this->getOrderBy_OID($order_id)[0]['status'];
            if ($status == 'checking' || $status == 'processing') {
                array_unshift($orderHandlersData, array("id" => $order_id, "status"=>$status));
            }
        }
        return $orderHandlersData;
    }

    public function orderData($order_id, $driver_id)
    {
        if (!$this->isUserDriver($driver_id)) {
            return false;
        }

        $orderData = array();
        $itemsData = array();

        $order = $this->getOrderBy_OID($order_id)[0];
        $status = $order['status'];
        $user_id = $order['user_id'];
        $items_count = $order['items'];
        $status_message = $order['status_message'];
        $available = $order['available'];

        $user_data = $this->getUserById($user_id)[0];
        $order_items = $this->getOrderItemBy_OID($order_id);

        foreach ($order_items as $order_item) {
            $item_id = $order_item['item_id'];
            $item_qty = $order_item['quantity'];

            $item = $this->getItemById($item_id)[0];
            $image = $this->getItemImage($item_id, false);

            $itemsData[] = array(
                "item_id" => $item_id,
                "name" => $item['name'],
                "price" => $item['price'],
                "quantity" => $item_qty,
                "image" => $image
            );
        }

        $userInfo = array(
            "name" => $user_data['firstname'] . " " . $user_data['lastname'],
            "contact" => $user_data['phone']
        );

        $orderInfo = array(
            "id" => $order_id,
            "items_count" => $items_count,
            "items_data" => $itemsData,
            "status" => $status,
            "available" => $available
        );

        $orderData = array(
            "address" => $order['address'],
            "shipping_fee" => $order['shipping_fee'],
            "customer" => $userInfo,
            "order" => $orderInfo
        );

        return $orderData;
    }

    public function updateOrder($status, $status_message, $date, $order_id, $driver_id)
    {
        $current_status = $this->getOrderBy_OID($order_id)[0]['status'];

        if (!$this->isUserDriver($driver_id)) {
            return false;
        }
        if ($current_status  == 'delivered' || $current_status == 'cancelled'){
            return false;
        }

        if ($status == 'delivered') {
            $user_id = $this->getOrderBy_OID($order_id)[0]['user_id'];
            $current_purchased = $this->getUserById($user_id)[0]['purchased'];

            if(!$this->isImagesValid()){
                return false;
            }

            if (!$this->updateOrderItemsBy_OID($order_id, 'yes')) {
                return false;
            }
            $orderItems = $this->getOrderItemBy_OID($order_id);
            foreach ($orderItems as $orderItem) {
                $item_id = $orderItem['item_id'];
                $quantity = $orderItem['quantity'];
                $current_purchased += $quantity;
                $total_sold = $this->getItemById($item_id)[0]['sold'] + $quantity;
                if (!$this->updateItemSold($total_sold, $item_id)) {
                    return false;
                }
            }
            if(!$this->updateUserPurchased($current_purchased, $user_id)){
                return false;
            }
            if(!$this->updateOrderProofImage($order_id)){
                return false;
            }
            
        }
        if ($status == 'cancelled') {
            $orderItems = $this->getOrderItemBy_OID($order_id);
            foreach($orderItems as $orderItem){
                $item_id = $orderItem['item_id'];
                $quantity = $orderItem['quantity'];
                $item_stocks = $this->getItemById($item_id)[0]['stocks'] + $quantity;
                if(!$this->updateItemStocks($item_stocks, $item_id)){
                    return false;
                }
            }
        }

        if (!$this->updateOrderStatusAndMessage($status, $status_message, $date, $order_id)) {
            return false;
        }
        return true;
    }
    public function isImagesValid(){
        $len = count($_FILES['images']['name']);

        for ($i = 0; $i < $len; $i++) {

            $target_file = $_FILES["images"]["name"][$i];

            $fType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            //CHECK IF TRUE IMAGE USING "getimagesize"
            $check = getimagesize($_FILES["images"]["tmp_name"][$i]);

            if ($check) {
            } else {
                //echo 'notImage';
                return false;
            }

            // CHECK FILE SIZE
            if ($_FILES["images"]["size"][$i] > 10000000) {
                //echo "largeImage";
                return false;
            }

            // CHECK FILE FORMAT
            if ($fType != "jpg" && $fType != "png" && $fType != "jpeg" && $fType != "gif") {
                //echo "formatImage";
                return false;
            }
        }
        return true;
    }

    private function isUserDriver($user_id)
    {
        $user_type = $this->getUserById($user_id)[0]['type'];
        if ($user_type == 'driver') {
            return true;
        }
        return false;
    }
}
