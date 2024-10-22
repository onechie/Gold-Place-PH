<?php

class AdminRecentOrderController extends OrderModel
{
    use UserTrait, ItemTrait, OrderItemTrait, UserAddressTrait;
    public function recentOrdersData()
    {
        $recentOrdersData = array();
        $orders = $this->getOrders();

        if (count($orders) == 0) {
            return false;
        }

        foreach ($orders as $order) {
            $order_id = $order['id'];
            $user_id = $order['user_id'];
            $items = $order['items'];
            $date = $order['date_created'];
            $status = $order['status'];

            $user = $this->getUserById($user_id)[0];
            $image = $this->getUserImage($user_id);

            array_unshift($recentOrdersData, array(
                "order_id" => $order_id,
                "user_id" => $user['id'],
                "user_name" => $user['firstname'] . " " . $user['lastname'],
                "user_email" => $user['email'],
                "user_image" => $image,
                "items" => $items,
                "date" => date("h:i:s A M d Y", strtotime($date)),
                "order_status" => $status,
                "payment_method" => $order['payment_method'],
                "reference_number" => $order['ref_number']

            ));
        }
        return $recentOrdersData;
    }
    public function orderData($order_id)
    {
        $orderData = array();

        $order = $this->getOrderBy_OID($order_id)[0];
        $status = $order['status'];

        $order_items = $this->getOrderItemBy_OID($order_id);
        foreach ($order_items as $order_item) {
            $item_id = $order_item['item_id'];
            $item_qty = $order_item['quantity'];

            $item = $this->getItemById($item_id)[0];
            $image = $this->getItemImage($item_id, false);

            $orderData[] = array(
                "item_id" => $item_id,
                "status" => $status,
                "name" => $item['name'],
                "price" => $item['price'],
                "quantity" => $item_qty,
                "image" => $image
            );
        }

        return $orderData;
    }
    public function fullOrderData($order_id)
    {
        $orderData = array();
        $itemsData = array();

        $order = $this->getOrderBy_OID($order_id);

        if (count($order) > 0) {
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

    public function deliveryProofData($order_id){
        $proofImages = $this->getOrderProofImage($order_id, true);
        $images = array(
            "delivered_proof"=>$proofImages
        );
        return $images;
    }
    public function updateOrder($order_id, $date, $status)
    {
        $current_status = $this->getOrderBy_OID($order_id)[0]['status'];

        if (!$this->updateOrderStatus($status, $date, $order_id)) {
            return false;
        }
        
        if ($current_status  == 'delivered' || $current_status == 'cancelled'){
            return false;
        }

        if ($status == 'delivered') {
            $user_id = $this->getOrderBy_OID($order_id)[0]['user_id'];
            $current_purchased = $this->getUserById($user_id)[0]['purchased'];
            
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
            $this->updateOrderAvailable('no', $order_id);
        }
        if ($status == 'cancelled') {
            $orderItems = $this->getOrderItemBy_OID($order_id);
            foreach ($orderItems as $orderItem) {
                $item_id = $orderItem['item_id'];
                $quantity = $orderItem['quantity'];
                $item_stocks = $this->getItemById($item_id)[0]['stocks'] + $quantity;
                if (!$this->updateItemStocks($item_stocks, $item_id)) {
                    return false;
                }
            }
            $this->updateOrderAvailable('no', $order_id);
        }
        return true;
    }
}
