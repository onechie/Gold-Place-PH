<?php

class CartController extends ItemModel
{
    use CartTrait, UserAddressTrait, OrderTrait, OrderItemTrait;

    private function validateQuantity($item_id, $quantity)
    {
        $stocks = $this->getItemById($item_id)[0]['stocks'];
        $newQuantity = 0;
       
        if ($quantity <= $stocks && $quantity >= 1) $newQuantity = $quantity;
        else if ($quantity <= 0) $newQuantity = 0;
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

    public function isItemsOnStock($cart_items){
        foreach($cart_items as $cart_item){
            $item_id = $this->getCartBy_ID($cart_item)[0]['item_id'];
            if($this->getItemById($item_id)[0]['stocks'] <= 0){
                return false;
            }
        }
        return true;
    }
    public function isQuantityValid($cart_items){
        foreach($cart_items as $cart_item){
            if($this->getCartBy_ID($cart_item)[0]['quantity'] <= 0){
                return false;
            }
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

        if (count($carts) == 0) {
            return false;
        }

        foreach ($carts as $cart) {
            $item_id = $cart['item_id'];

            $qty = $cart['quantity'];
            $newQuantity = $this->validateQuantity($item_id, $qty);

            if($qty != $newQuantity){
                $this->updateCartQuantity($newQuantity, date("Y-m-d H:i:s"), $cart['id'], $user_id);
                $qty = $newQuantity;
            }

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

    public function checkOut($user_id, $items, $status, $date, $cart_items, $available)
    {
        if(!$this->setOrder($user_id,$items, $status, $date, $available)){
            return false;
        }

        $order_id = $this->getOrderId($user_id, $items, $status, $date)[0]['id'];
        $can_rate = 'no';

        foreach($cart_items as $cart_item){
            $cart = $this->getCartBy_ID($cart_item)[0];
            $item_id = $cart['item_id'];

            $quantity = $this->validateQuantity($item_id, $cart['quantity']);

            if(!$this->setOrderItems($order_id, $item_id, $quantity, $can_rate)){
                return false;
            }
            if(!$this->updateStocks($item_id, $quantity)){
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

    private function updateStocks($item_id, $quantity){
        $stocks = $this->getItemById($item_id)[0]['stocks'];
        $stocks -= $quantity;
        if(!$this->updateItemStocks($stocks, $item_id)){
            return false;
        }
        return true;
    }
}
