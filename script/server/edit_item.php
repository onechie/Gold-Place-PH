<?php
include './database.php';

if (isset($_POST['dataRequest'])) {

    $id = $_POST['dataRequest'];

    $sql = "SELECT * FROM items WHERE id = '$id'";
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
            }
            //ADD THE DATA AS JSON FORMAT IN ARRAY
            $itemInfo = array(
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
        echo json_encode($itemInfo);
    }
}
