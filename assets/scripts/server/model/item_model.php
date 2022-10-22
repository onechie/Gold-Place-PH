<?php

class ItemModel extends DbHelper
{
    use ItemTrait;
}

trait ItemTrait
{
    //CREATE

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
    //UPDATE

    //DELETE
}