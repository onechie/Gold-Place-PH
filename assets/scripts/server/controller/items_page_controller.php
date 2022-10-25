<?php

class ItemsPageController extends ItemModel
{
    use RatingTrait;

    public function itemsDataWithPage($page)
    {
        $itemWithRatingData = array();

        $items = $this->getItemsWithPage($page);
        foreach ($items as $item) {
            $id = $item['id'];
            $name = $item['name'];
            $price = $item['price'];

            $image = $this->getItemImage($id, false);
            $ratings = $this->getRatings($id);
            $ratingByUsers = array();

            foreach ($ratings as $rating) {
                $ratingByUsers[] = array(
                    "score" => $rating['score'],
                );
            }

            $itemWithRatingData[] = array(
                "id" => $id,
                "name" => $name,
                "price" => $price,
                "images" => $image,
                "ratings" => $ratingByUsers
            );
        }

        return $itemWithRatingData;
    }
    public function getItemsDataWithPageAndOption($page, $category, $sort, $price_option)
    {
        $itemWithRatingData = array();

        $items = $this->getItemsWithPageAndOption($page, $category, $sort, $price_option);
        
        foreach ($items as $item) {
            $id = $item['id'];
            $name = $item['name'];
            $price = $item['price'];

            $image = $this->getItemImage($id, false);
            $ratings = $this->getRatings($id);
            $ratingByUsers = array();

            foreach ($ratings as $rating) {
                $ratingByUsers[] = array(
                    "score" => $rating['score'],
                );
            }

            $itemWithRatingData[] = array(
                "id" => $id,
                "name" => $name,
                "price" => $price,
                "images" => $image,
                "ratings" => $ratingByUsers
            );
        }

        return $itemWithRatingData;
    }
}
