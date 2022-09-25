<?php
include './database.php';

$sql = "SELECT * FROM items";
$result = mysqli_query($conn, $sql);
$itemInfo = array();

if (mysqli_num_rows($result) > 0) {
    //GET ALL ITEMS DATA FROM DATABASE
    while ($rows = mysqli_fetch_assoc($result)) {
        $id = $rows['id'];
        $name = $rows['name'];
        $stocks = $rows['stocks'];
        $price = $rows['price'];
        $sold = $rows['sold'];

        //GET THE ID AND SET AS DIRECTORY
        $directory = 'images/' . $id;
        //SCAN THE FILES INSIDE THE DIRECTORY
        $files = array_diff(scandir($directory), array('..', '.'));
        $file = '';
        //GET THE FIRST FILE'S NAME
        foreach ($files as $key => $value) {
            $file = $value;
            break;
        }
        //ADD THE DATA AS JSON FORMAT IN ARRAY
        $itemInfo[] = array(
            "id" => $id,
            "name" => $name,
            "stocks" => $stocks,
            "price" => $price,
            "sold" => $sold,
            "image" => $file
        );
    }
    //ENCODE THE ARRAY TO JSON
    echo json_encode($itemInfo);
}
