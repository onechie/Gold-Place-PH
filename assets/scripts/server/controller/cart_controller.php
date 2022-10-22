<?php

class CartController extends ItemModel
{
    use CartTrait, UserAddressTrait, OrderTrait, OrderItemTrait;

    private function validateQuantity($item_id, $quantity)
    {
        $stocks = $this->getItemById($item_id)[0]['stocks'];
        $newQuantity = 0;
        if ($quantity <= 0) $newQuantity = 1;
        else if ($quantity <= $stocks) $newQuantity = $quantity;
        else $newQuantity = $stocks;

        return $newQuantity;
    }

    public function isAddressValid($user_id){
        $address = $this->getAddressBy_UID($user_id);

        if(count($address) == 0){
            return false;
        }

        if ($address[0]['house_number'] == '' || $address[0]['barangay'] == '' || $address[0]['city'] == '' || $address[0]['province'] == '') {
            return false;
        }
        return true;
    }

    public function addToCart($item_id, $user_id, $quantity, $date)
    {
        $newQuantity = $this->validateQuantity($item_id, $quantity);
        if ($this->setCart($item_id, $user_id, $newQuantity, $date)) {
            return true;
        }
        return false;
    }

    public function isOnCart($user_id, $item_id)
    {
        if (count($this->getCartBy_UID_IID($user_id, $item_id)) > 0) {
            return true;
        }
        return false;
    }

    public function cartData($user_id)
    {
        $cartData = array();
        $carts = $this->getCartBy_UID($user_id);
        foreach ($carts as $cart) {
            $item_id = $cart['item_id'];
            $qty = $cart['quantity'];
            $cart_id = $cart['id'];

            $image = $this->getItemImage($item_id, false);
            $items = $this->getItemById($item_id);
            foreach ($items as $item) {
                $cartData[] = array(
                    "id" => $item_id,
                    "cart_id" => $cart_id,
                    "name" => $item['name'],
                    "price" => $item['price'],
                    "quantity" => $qty,
                    "images" => $image
                );
            }
        }
        return $cartData;
    }

    public function updateCartQuantity($quantity, $date, $cart_id, $user_id)
    {
        $item_id = $this->getCartBy_ID($cart_id)[0]['item_id'];
        $newQuantity = $this->validateQuantity($item_id, $quantity);
        if ($this->updateCart($newQuantity, $date, $cart_id, $user_id)) {
            return true;
        }
        return false;
    }

    public function checkOut($user_id, $items, $status, $date, $cart_items)
    {
        if(!$this->setOrder($user_id,$items, $status, $date)){
            return false;
        }

        $order_id = $this->getOrderId($user_id, $items, $status, $date)[0]['id'];
        $can_rate = 'no';

        foreach($cart_items as $cart_item){
            $cart = $this->getCartBy_ID($cart_item)[0];
            $item_id = $cart['item_id'];
            $quantity = $cart['quantity'];

            if(!$this->setOrderItems($order_id, $item_id, $quantity, $can_rate)){
                return false;
            }
            if(!$this->deleteCart($cart_item, $user_id)){
                return false;
            }
        }
        return true;
    }

    public function removeItemsOnCart($cart_items, $user_id){
        foreach($cart_items as $cart_item){
            if(!$this->deleteCart($cart_item, $user_id)){
                return false;
            }
        }
        return true;
    }
}
