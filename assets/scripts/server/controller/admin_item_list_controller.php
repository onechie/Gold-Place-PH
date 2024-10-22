<?php

class AdminItemListController extends ItemModel
{
    use OrderItemTrait, OrderTrait;

    public function itemsData()
    {
        $itemsData = array();

        $items = $this->getItems();
        if(count($items) == 0){
            return false;
        }
        foreach ($items as $item) {
            $id = $item['id'];
            $name = $item['name'];
            $price = $item['price'];
            $stocks = $item['stocks'];
            $sold = $item['sold'];

            $image = $this->getItemImage($id, false);

            $itemsData[] = array(
                "id" => $id,
                "name" => $name,
                "stocks" => $stocks,
                "price" => $price,
                "sold" => $sold,
                "images" => $image,
            );  
        }

        return $itemsData;
    }

    public function itemData($id)
    {
        $itemData = array();

        $item = $this->getItemById($id)[0];

        $id = $item['id'];
        $name = $item['name'];
        $price = $item['price'];
        $stocks = $item['stocks'];
        $category = $item['category'];
        $description = $item['description'];
        $sold = $item['sold'];

        $image = $this->getItemImage($id, true);

        $itemData = array(
            "id" => $id,
            "name" => $name,
            "stocks" => $stocks,
            "price" => $price,
            "sold" => $sold,
            "category" => $category,
            "description" => $description,
            "images" => $image,
        );

        return $itemData;
    }

    public function createNewItem($name, $category, $price, $stocks, $description, $date_created)
    {
        if (!$this->checkAddItemInputs($name, $category, $price, $stocks, $description)) {
            return false;
        }
        if (!$this->setItem($name, $category, $price, $stocks, $description, $date_created)) {
            return false;
        }
        $item_id = $this->getItemId($name, $category, $price, $stocks, $description, $date_created)[0]['id'];

        if (!$this->updateItemImage($item_id)) {
            return false;
        }
        return true;
    }

    public function editItem($name, $category, $price, $stocks, $description, $id, $updateImage)
    {
        if (!$this->checkAddItemInputs($name, $category, $price, $stocks, $description)) {
            return false;
        }
        if (!$this->updateItem($name, $category, $price, $stocks, $description, $id)) {
            return false;
        }
        if ($updateImage) {
            if (!$this->updateItemImage($id)) {
                return false;
            }
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
            if ($_FILES["images"]["size"][$i] > 2000000) {
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

    public function removeItem($item_id)
    {
        if (!$this->deleteItemImage($item_id)) {
            return false;
        }
        if (!$this->deleteItemById($item_id)) {
            return false;
        }
        //get all associated orders
        $orderItems = $this->getOrderItemBy_IID($item_id);
        $orders = array();

        foreach($orderItems as $orderItem){
            $order_id = $orderItem['order_id'];
            if(in_array($order_id, $orders)){

            } else {
                array_push($orders, $order_id);
            }
        }

        foreach($orders as $order){
            $this->deleteOrderBy_ID($order);
        }

        return true;
    }
    private function checkAddItemInputs($name, $category, $price, $stocks, $description)
    {
        $checkName = $name;
        $checkCategory = $category;
        $checkPrice = (int)$price;
        $checkStocks = (int)$stocks;
        $checkDescription = $description;

        //VALIDATE IF THERE IS EMPTY VALUE
        if (empty($checkName)) return false;
        if (empty($checkCategory)) return false;
        if ($checkPrice <= 0) return false;
        if ($checkStocks <= 0) return false;
        if (empty($checkDescription)) return false;

        return true;
    }
}
