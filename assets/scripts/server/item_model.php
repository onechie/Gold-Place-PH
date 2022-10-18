<?php

class ItemModel extends DbHelper
{
    //GET SINGLE ITEM DATA BY ID
    public function getItemById($id, $uid = '')
    {

        $itemInfo = array();
        $canRate = "no";

        $sql = "SELECT * FROM items WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($id))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();

        foreach ($results as $result) {
            $id = $result['id'];
            $name = $result['name'];
            $category = $result['category'];
            $stocks = $result['stocks'];
            $price = $result['price'];
            $sold = $result['sold'];
            $description = $result['description'];
            $canRate = "no";

            $file = $this->getItemImage($id, true);
            
            if($this->canRate($id, $uid) != 'no'){
                $canRate = 'yes';
            }
            
            $ratings = $this->getRatings($id);

            $itemInfo[] = array(
                "id" => $id,
                "name" => $name,
                "category" => $category,
                "stocks" => $stocks,
                "price" => $price,
                "sold" => $sold,
                "description" => $description,
                "images" => $file,
                "canRate" => $canRate,
                "ratings" => $ratings
            );
        }
        return $itemInfo;
    }

    //GET ALL ITEM DATA
    public function getItemS($page, $uid = '')
    {
        $offset = strval($page * 12 - 12);

        $itemInfo = array();
        $canRate = "no";

        $sql = "SELECT * FROM items LIMIT 12 OFFSET :off";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(':off', $offset, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();

        foreach ($results as $result) {
            $id = $result['id'];
            $name = $result['name'];
            $category = $result['category'];
            $stocks = $result['stocks'];
            $price = $result['price'];
            $sold = $result['sold'];
            $description = $result['description'];
            $canRate = "no";

            $file = $this->getItemImage($id, false);

            if($this->canRate($id, $uid) != 'no'){
                $canRate = 'yes';
            }

            $ratings = $this->getRatings($id);

            $itemInfo[] = array(
                "id" => $id,
                "name" => $name,
                "category" => $category,
                "stocks" => $stocks,
                "price" => $price,
                "sold" => $sold,
                "description" => $description,
                "images" => $file,
                "canRate" => $canRate,
                "ratings" => $ratings
            );
        }
        return $itemInfo;
    }
    //GET ITEM IMAGE BY ITEM ID CAN BE SINGLE OR MULTIPLE
    public function getItemImage($id, $isMultiple)
    {
        $directory = '../../images/items/' . $id;
        $files = array_diff(scandir($directory), array('..', '.'));
        $file = array();
        foreach ($files as $value) {
            $file[] = $value;
            if (!$isMultiple) break;
        }
        return $file;
    }

    //GET USER IMAGE BY USER ID
    public function getUserImage($id)
    {
        $directory = '../../images/users/' . $id;
        $files = array_diff(scandir($directory), array('..', '.'));
        $file = array();
        foreach ($files as $value) {
            $file[] = $value;
            break;
        }
        return $file;
    }

    //INSERT RATING BY ITEM ID
    public function setRate($item_id, $message, $score, $user_id)
    {
        $sql = "INSERT rating(item_id, message, score, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($item_id, $message, $score, $user_id))) {
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }

    //CHECK IF USER CAN RATE IN SPECIFIC ITEM
    public function canRate($item_id, $user_id = '')
    {

        if ($user_id != '') {
            $sql = "SELECT * FROM orders WHERE user_id = ? AND status = 'delivered'";
            $stmt = $this->connect()->prepare($sql);
            if (!$stmt->execute(array($user_id))) {
                $stmt = null;
                return 'no';
            }

            $results = $stmt->fetchAll();
            $stmt = null;

            foreach ($results as $result) {
                $order_id = $result['id'];
                $sql = "SELECT * FROM order_item WHERE order_id = ? AND item_id = ? AND can_rate = 'yes'";
                $stmt = $this->connect()->prepare($sql);


                if (!$stmt->execute(array($order_id, $item_id))) {
                    $stmt = null;
                    return 'no';
                }

                $can = $stmt->fetchAll();

                if (count($can) > 0) {
                    $stmt = null;
                    return $can[0]['id'];
                }
            }
        }
        return 'no';
    }

    //GET RATINGS OF SPECIFIC ITEM
    protected function getRatings($item_id)
    {

        $ratings = array();

        $sql = "SELECT * FROM rating WHERE item_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($item_id))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $stmt = null;

        foreach ($results as $result) {
            $uid = $result['user_id'];
            $sql = "SELECT * FROM user WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            if (!$stmt->execute(array($uid))) {
                $stmt = null;
                return false;
            }

            $results = $stmt->fetchAll();
            $stmt = null;
            $name = $results[0]['firstname'] . " " . $results[0]['lastname'];
            $image = $this->getUserImage($uid);

            $ratings[] = array(
                "comment" => $result['message'],
                "score" => $result['score'],
                "name" => $name,
                "image" => $image,
                "uid" => $uid

            );
        }

        return $ratings;
    }
}
