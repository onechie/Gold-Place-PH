<?php

class OrderController extends ItemModel
{
    use OrderTrait, OrderItemTrait;
    public function orderData($user_id, $type)
    {
        $orderData = array();
        $orders = $this->getOrderByUidAndStatus($user_id, $type);

        if (count($orders) == 0) {
            return false;
        }

        foreach ($orders as $order) {
            $orderItemsData = array();
            $order_id = $order['id'];
            $order_items = $this->getOrderItemBy_OID($order_id);
            foreach ($order_items as $order_item) {
                $item_id = $order_item['item_id'];
                $quantity = $order_item['quantity'];
                $image = $this->getItemImage($item_id, false);
                $itemData = $this->getItemById($item_id);

                $orderItemsData[] = array(
                    "id" => $item_id,
                    "name" => $itemData[0]['name'],
                    "price" => $itemData[0]['price'],
                    "quantity" => $quantity,
                    "image" => $image
                );
            }
            $orderData[] = array(
                "id" => $order_id,
                "status" => $order['status'],
                "date" => date("F d Y", strtotime($order['date_created'])),
                "order_items" => $orderItemsData
            );
        }

        return $orderData;
    }
}
