<?php
include './database.php';

//RESPONSE FOR ITEM INFO REQUEST WITH ID
if(isset($_POST['requestType']) && $_POST['requestType'] == "load-item") {
    $id = $_POST['id'];
    $sql = "SELECT * FROM items WHERE id = '$id'";

    $item = getItemData($sql, $conn, true);
    echo json_encode($item);
}

if(isset($_POST['requestType']) && $_POST['requestType'] == "load-items") {
    $sql = "SELECT * FROM items";
    
    if(isset($_POST['page'])){
        $page = $_POST['page'];
        $offset = $page*8-8;
        $sql .= " LIMIT 8 OFFSET $offset";
    }

    $items = getItemData($sql, $conn, false);
    echo json_encode($items);

}

function getItemData($sql, $conn, $multiple){

    $result = mysqli_query($conn, $sql);
    $itemInfo = array();

    if (mysqli_num_rows($result) > 0) {
        //GET ALL ITEMS DATA FROM DATABASE
        while ($rows = mysqli_fetch_assoc($result)) {
            $id = $rows['id'];
            $name = $rows['name'];
            $category = $rows['category'];
            $stocks = $rows['stocks'];
            $price = $rows['price'];
            $sold = $rows['sold'];
            $description = $rows['description'];

            //GET THE ID AND SET AS DIRECTORY
            $directory = 'images/' . $id;
            //SCAN THE FILES INSIDE THE DIRECTORY
            $files = array_diff(scandir($directory), array('..', '.'));
            $file = array();
            //GET THE FIRST FILE'S NAME
            foreach ($files as $key => $value) {
                $file[] = $value;
                if(!$multiple)break;
            }
            //ADD THE DATA AS JSON FORMAT IN ARRAY
            $itemInfo[] = array(
                "id" => $id,
                "name" => $name,
                "category" => $category,
                "stocks" => $stocks,
                "price" => $price,
                "sold" => $sold,
                "description" => $description,
                "images" => $file
            );
        }
        //ENCODE THE ARRAY TO JSON
        return $itemInfo;
    }
}