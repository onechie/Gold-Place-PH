<?php

class ItemModel extends DbHelper
{
    use ItemTrait;
}

trait ItemTrait
{
    //CREATE
    protected function setItem($name, $category, $price, $stocks, $description)
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
    //READ
    protected function getItems()
    {
        $sql = "SELECT * FROM items";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getItemsWithPage($page)
    {
        $offset = strval($page * 12 - 12);
        $sql = "SELECT * FROM items LIMIT 12 OFFSET :off";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(':off', $offset, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getItemsWithPageAndOption($page, $category, $sort, $price,)
    {
        $offset = strval($page * 12 - 12);
        $sql = "SELECT * FROM items ";
        if ($category != 'Default') {
            $sql .= 'WHERE category = :cat ';
        }

        if ($sort != 'Default' && $price != 'Default') {
            if($price == 'Low-to-high'){
                $sql .= 'ORDER BY price,';
            }else {
                $sql .= 'ORDER BY price DESC,';
            }
            if($sort == 'Latest'){
                $sql .= 'id DESC ';
            }else if($sort =='Top-sales'){
                $sql .= 'sold DESC ';
            }
            else{
                $sql .= 'id ';
            }

        } else if ($sort != 'Default') {
            if($sort == 'Latest'){
                $sql .= 'ORDER BY id DESC ';
            }else if($sort =='Top-sales'){
                $sql .= 'ORDER BY sold DESC ';
            }
            else{
                $sql .= 'ORDER BY id ';
            }
        } else if ($price != 'Default') {
            if($price == 'Low-to-high'){
                $sql .= 'ORDER BY price ';
            }else {
                $sql .= 'ORDER BY price DESC ';
            }
        } else {
            $sql .= '';
        }

        $sql .= 'LIMIT 12 OFFSET :off';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(':off', $offset, PDO::PARAM_INT);


        if ($category != 'Default') {
            $stmt->bindValue(':cat', $category, PDO::PARAM_STR);
        }
        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getItemById($id)
    {
        $sql = "SELECT * FROM items WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($id))) {
            $stmt = null;
            exit();
        }

        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }
    protected function getItemImage($id, $isMultiple)
    {
        $directory = '../../../images/items/' . $id;
        $files = array_diff(scandir($directory), array('..', '.'));
        $file = array();
        foreach ($files as $value) {
            $file[] = $value;
            if (!$isMultiple) break;
        }
        return $file;
    }

    protected function getItemId($name, $category, $price, $stocks, $description)
    {
        $sql = "SELECT * FROM items WHERE name = ? AND category = ? AND price = ? AND stocks = ? AND description = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($name, $category, $price, $stocks, $description))) {
            $stmt = null;
            return false;
        }

        $results = $stmt->fetchAll();
        return $results;
    }
    //UPDATE
    protected function updateItem($name, $category, $price, $stocks, $description, $id)
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
    protected function updateItemStocks($stocks, $id)
    {
        $sql = "UPDATE items set stocks = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($stocks, $id))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
    protected function updateItemSold($sold, $id)
    {
        $sql = "UPDATE items set sold = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($sold, $id))) {
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
    protected function updateItemImage($id)
    {

        $len = count($_FILES['images']['name']);

        $directory = "../../../images/items/" . $id . "/";

        if (!is_dir($directory)) {
            mkdir($directory);
        } else {
            $files = glob($directory . '*');
            foreach ($files as $file) {
                //CHECK IF TRUE FILE
                if (is_file($file)) {
                    //DELETE THE FILE
                    unlink($file);
                }
            }
        }

        for ($i = 0; $i < $len; $i++) {

            $target_file = $directory . basename($_FILES["images"]["name"][$i]);

            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            //CHECK IF TRUE IMAGE USING "getimagesize"
            $check = getimagesize($_FILES["images"]["tmp_name"][$i]);

            if ($check) {
            } else {
                //echo 'notImage';
                return false;
            }

            // CHECK IF FILE ALREADY EXISTS
            if (file_exists($target_file)) {
                //echo "existsImage";
                return false;
            }

            // CHECK FILE SIZE
            if ($_FILES["images"]["size"][$i] > 2000000) {
                //echo "largeImage";
                return false;
            }

            // CHECK FILE FORMAT
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                //echo "formatImage";
                return false;
            }
        }

        //VALIDATION PASSED NOW TRY TO INSERT INTO SERVER
        for ($i = 0; $i < $len; $i++) {

            $new_file_name = $directory . md5($_FILES["images"]["name"][$i]) . "." . strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            //INSERT FILE TO SERVER
            if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $new_file_name)) {
            } else {
                //echo 'failedImage';
                return false;
            }
        }

        return true;
    }

    //DELETE
    protected function deleteItemById($id)
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

    protected function deleteItemImage($id)
    {
        $directory = "../../../images/items/" . $id . "/";
        $files = glob($directory . '*');
        foreach ($files as $file) {
            //CHECK IF TRUE FILE
            if (is_file($file)) {
                //DELETE THE FILE
                unlink($file);
            }
        }
        return true;
    }
}
