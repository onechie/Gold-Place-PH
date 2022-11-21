<?php

class DriverAddOrderController extends OrderModel
{
    use UserTrait, ItemTrait, OrderItemTrait, UserAddressTrait, OrderHandlerTrait;
    public function findOrder($order_id, $driver_id)
    {

        if(!$this->isUserDriver($driver_id)){
            return false;
        }

        $orderData = array();
        $itemsData = array();

        $order = $this->getOrderBy_OID($order_id);

        if(count($order) > 0){
            $order = $order[0];
        } else {
            return false;
        }

        $status = $order['status'];
        $user_id = $order['user_id'];
        $items_count = $order['items'];
        $available = $order['available'];

        $user_address = $this->getAddressBy_UID($user_id)[0];
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

    public function addOrder($driver_id, $order_id){
        if(!$this->isUserDriver($driver_id)){
            return false;
        }

        if(!$this->isOrderAvailable($order_id)){
            return false;
        }
        if(!$this->isOrderExist($order_id)){
            return false;
        }
        if(!$this->setOrderHandler($driver_id, $order_id)){
            return false;
        }

        $this->updateOrderAvailable('no', $order_id);
        return true;
    }

    private function isOrderAvailable($order_id){
        if(count($this->getOrderHandlerBy_OID($order_id)) > 0){
            return false;
        }
        return true;
    }
    private function isOrderExist($order_id){
        if(count($this->getOrderBy_OID($order_id)) > 0){
            return true;
        }
        return false;
    }
    private function isUserDriver($user_id){
        $user_type = $this->getUserById($user_id)[0]['type'];
        if($user_type == 'driver'){
            return true;
        }
        return false;
    }
}
