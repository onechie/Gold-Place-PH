<?php

class ItemModel extends DbHelper
{
    public function setItem($name, $category, $price, $stocks, $description)
    {
        $sql = "INSERT items(name, category, price, stocks, description) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($name, $category, $price, $stocks, $description))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    public function updateItem($name, $category, $price, $stocks, $description, $id)
    {
        $sql = "UPDATE items set name = ?, category = ?, price = ?, stocks = ?, description = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($name, $category, $price, $stocks, $description, $id))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    public function deleteItemById($id)
    {
        $sql = "DELETE FROM items WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($id))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
    public function getLastItemId()
    {
        $sql = "SELECT * FROM items ORDER BY id DESC LIMIT 1";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute()) {
            $stmt = null;
            return false;
        }

        $result = $stmt->fetchAll();
        $stmt = null;
        return $result[0]['id'];
    }

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
            $description = nl2br($result['description']);
            $canRate = "no";

            $file = $this->getItemImage($id, true);

            if ($this->canRate($id, $uid) != 'no') {
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
    public function getItemS($page = 0, $uid = '')
    {

        $sql = "SELECT * FROM items";
        $offset = strval($page * 12 - 12);
        $itemInfo = array();
        $canRate = "no";
        $stmt = $this->connect()->prepare($sql);

        if ($page > 0) {
            $stmt = null;
            $sql = "SELECT * FROM items LIMIT 12 OFFSET :off";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(':off', $offset, PDO::PARAM_INT);
        }

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

            if ($this->canRate($id, $uid) != 'no') {
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
                "comment" => nl2br($result['message']),
                "score" => $result['score'],
                "name" => $name,
                "image" => $image,
                "uid" => $uid

            );
        }

        return $ratings;
    }
    public function countItemStocks()
    {
        $sql = "SELECT * FROM items";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute()) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        $count = 0;
        foreach ($results as $result) {
            $count += $result['stocks'];
        }
        $stmt = null;
        return $count;
    }
}
