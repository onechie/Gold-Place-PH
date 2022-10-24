<?php

class AdminRecentOrderController extends OrderModel
{
    use UserTrait, ItemTrait, OrderItemTrait;
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
                "order_status" => $status

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

    public function updateOrder($order_id, $date, $status)
    {
        if (!$this->updateOrderStatus($status, $date, $order_id)) {
            return false;
        }

        if ($status == 'delivered') {
            if (!$this->updateOrderItemsBy_OID($order_id, 'yes')) {
                return false;
            }
        }
        return true;
    }
}
