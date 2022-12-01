<?php

class OrderController extends ItemModel
{
    use OrderTrait, OrderItemTrait;
    public function orderData($user_id, $type)
    {
        $orderData = array();
        $orders = '';
        if($type=='default'){
            $orders = $this->getOrderBy_UID($user_id);
        } else {
            $orders = $this->getOrderByUidAndStatus($user_id, $type);
            
        }
        
        if (count($orders) == 0) {
            return false;
        }

        foreach ($orders as $order) {
            $orderItemsData = array();
            $order_id = $order['id'];
            $order_items = $this->getOrderItemBy_OID($order_id);
            $total_price = $order['shipping_fee'];
            foreach ($order_items as $order_item) {
                $item_id = $order_item['item_id'];
                $quantity = $order_item['quantity'];
                $image = $this->getItemImage($item_id, false);
                $itemData = $this->getItemById($item_id);

                $total_price += $quantity * $itemData[0]['price'];

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
                "status_message" => $order['status_message'],
                "date" => date("F d Y", strtotime($order['date_created'])),
                "shipping_fee" => $order['shipping_fee'],
                "total_price" => $total_price,
                "order_items" => $orderItemsData
            );
            $total_price += 0;
        }

        return $orderData;
    }
}
