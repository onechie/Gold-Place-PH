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
                "payment_method" => $order['payment_method'],
                "status_message" => $order['status_message'],
                "date" => date("F d Y", strtotime($order['date_created'])),
                "shipping_fee" => $order['shipping_fee'],
                "total_price" => $total_price,
                "order_items" => $orderItemsData,
                "reference_number" => $order['ref_number']
            );
            $total_price += 0;
        }

        return $orderData;
    }

    public function updateRefNumber($order_id, $reference_number){
        if(!$this->isRefValid($reference_number)){
            return false;
        }
        if($this->isRefExists($reference_number)){
            return false;
        }
        if($this->isOrderHasRef($order_id)){
            return false;
        }
        if(!$this->updateOrderRef($order_id, $reference_number)){
            return false;
        }
        return true;
    }
    public function isRefValid($reference_number){
        $refPattern = "/^(\d{13})$/";
        if (preg_match($refPattern, $reference_number)) {
            return true;
        }
        return false;
    }
    public function isRefExists($reference_number){
        if(count($this->getOrderBy_REF($reference_number)) > 0){
            return true;
        }
        return false;
    }
    public function isOrderHasRef($order_id){
        if($this->getOrderBy_OID($order_id)[0]['ref_number'] > 0){
            return true;
        }
        return false;
    }
}
