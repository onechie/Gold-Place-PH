<?php

class ViewItemController extends ItemModel
{
    use RatingTrait, UserTrait, OrderTrait, OrderItemTrait;

    public function itemData($item_id, $uid = '')
    {
        $itemWithRatingData = array();

        $item = $this->getItemById($item_id)[0];
        $item_name = $item['name'];
        $category = $item['category'];
        $stocks = $item['stocks'];
        $price = $item['price'];
        $sold = $item['sold'];
        $description = nl2br($item['description']);
        $canRate = "yes";

        if (!$this->isCanRate($item_id, $uid)) {
            $canRate = 'no';
        }

        $image = $this->getItemImage($item_id, true);
        $ratings = $this->getRatings($item_id);
        $ratingByUsers = array();

        foreach ($ratings as $rating) {
            $user_id = $rating['user_id'];
            $user = $this->getUserById($user_id)[0];
            $name = $user['firstname'] . " " . $user['lastname'];
            $userImage = $this->getUserImage($user_id);


            $ratingByUsers[] = array(
                "comment" => nl2br($rating['message']),
                "score" => $rating['score'],
                "name" => $name,
                "image" => $userImage,
                "uid" => $user_id
            );
        }

        $itemWithRatingData = array(
            "id" => $item_id,
            "name" => $item_name,
            "category" => $category,
            "stocks" => $stocks,
            "price" => $price,
            "sold" => $sold,
            "description" => $description,
            "images" => $image,
            "canRate" => $canRate,
            "ratings" => $ratingByUsers
        );

        return $itemWithRatingData;
    }

    public function submitRate($item_id, $comment, $star, $user_id)
    {
        $orderItemId = $this->isCanRate($item_id, $user_id);
        if(!$orderItemId){
            return false;
        }

        if(!$this->setRating($item_id, $comment, $star, $user_id)){
            return false;
        }

        if(!$this->updateOrderItem($orderItemId, 'no')){
           return false;
        }
    
        return true;

    }

    private function isCanRate($id, $user_id)
    {
        
        if ($user_id == '') {
            return false;
        }
        $orders = $this->getOrderByUidAndStatus($user_id, 'delivered');
        foreach ($orders as $order) {
            $order_item = $this->getOrderItem($order['id'], $id);
            
            if (count($order_item) > 0) {
                return $order_item[0]['id'];
            }
        }
        return false;
    }

}
