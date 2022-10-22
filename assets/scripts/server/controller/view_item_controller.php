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
        $description = $item['description'];
        $canRate = "no";

        if ($this->isCanRate($item_id, $uid)) {
            $canRate = 'yes';
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

    private function isCanRate($id, $user_id)
    {
        if ($user_id == '') {
            return false;
        }

        $orders = $this->getOrderByUidAndStatus($user_id, 'delivered');
        foreach ($orders as $order) {
            if (count($this->getOrderItem($order['id'], $id)) > 0) {
                return true;
            }
        }
        return false;
    }
}
