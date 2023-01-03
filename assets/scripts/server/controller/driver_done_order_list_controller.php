<?php

class DriverDoneOrderListController extends OrderModel
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
            if ($status == 'cancelled' || $status == 'delivered') {
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
        $proofImages = $this->getOrderProofImage($order_id, true);
        
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
            "status_message" => $status_message,
            "available" => $available
        );

        $orderData = array(
            "address" => $order['address'],
            "shipping_fee" => $order['shipping_fee'],
            "customer" => $userInfo,
            "order" => $orderInfo,
            "delivered_proof" => $proofImages
        );

        return $orderData;
    }

    public function updateOrder($status, $status_message, $date, $order_id, $driver_id)
    {
        if (!$this->isUserDriver($driver_id)) {
            return false;
        }
        if (!$this->updateOrderStatusAndMessage($status, $status_message, $date, $order_id)) {
            return false;
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
