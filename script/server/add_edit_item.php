<?php
include './database.php';

//ADD ITEM REQUEST
if ($_POST['requestType'] == "add") {
    $name = mysqli_escape_string($conn, $_POST['name']);
    $category = mysqli_escape_string($conn, $_POST['category']);
    $price = (int)mysqli_escape_string($conn, $_POST['price']);
    $stocks = (int)mysqli_escape_string($conn, $_POST['stocks']);
    $description = mysqli_escape_string($conn, $_POST['description']);

    $readyToProcess = true;

    //VALIDATE IF THERE IS EMPTY VALUE
    if (empty($name)) $readyToProcess = false;
    if (empty($category)) $readyToProcess = false;
    if ($price <= 0) $readyToProcess = false;
    if ($stocks <= 0) $readyToProcess = false;
    if (empty($description)) $readyToProcess = false;

    //SET DIRECTORY NAME
    $mainDirectory = "images/";
    $directory = "";

    //CHECK IF THE FILE LIST IS EMPTY
    if ($_FILES["images"]["tmp_name"][0] == null && $readyToProcess) {
        echo 'noImage';
    } else {
        //RUN THE ADD ITEM FUNCTION TO ADD THE DATA INTO DATABASE AND CHECK IF SUCCESS
        if (addItem($conn, $readyToProcess, $name, $category, $price, $stocks, $description)) {
            //GET THE LAST ITEM IN THE DATABASE AND GET THE ID
            $sql = "SELECT * FROM items ORDER BY id DESC LIMIT 1";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                    //GET THE ID
                    $id = $rows['id'];
                    //MAKE THE ID AS A DIRECTORY NAME
                    $directory = $mainDirectory . $id . '/';
                }
            }

            if (editImage($directory, $mainDirectory)) {
                echo "addSuccess";
            }
        } else {
            echo "addFailed";
        }
    }
}

//EDIT ITEM REQUEST
if ($_POST['requestType'] == "edit") {
    $id = mysqli_escape_string($conn, $_POST['id']);
    $name = mysqli_escape_string($conn, $_POST['name']);
    $category = mysqli_escape_string($conn, $_POST['category']);
    $price = (int)mysqli_escape_string($conn, $_POST['price']);
    $stocks = (int)mysqli_escape_string($conn, $_POST['stocks']);
    $description = mysqli_escape_string($conn, $_POST['description']);

    $readyToProcess = true;

    if (empty($name)) $readyToProcess = false;
    if (empty($category)) $readyToProcess = false;
    if ($price <= 0) $readyToProcess = false;
    if ($stocks <= 0) $readyToProcess = false;
    if (empty($description)) $readyToProcess = false;

    //IF NO FILE INSERTED JUST EDIT THE DATA EXCEPT FOR PHOTOS
    if ($_FILES["images"]["tmp_name"][0] == null) {
        if (editItem($conn, $readyToProcess, $id, $name, $category, $price, $stocks, $description)) {
            echo 'editSuccess';
        } else {
            echo 'editFailed';
        }
    } else {

        if (editItem($conn, $readyToProcess, $id, $name, $category, $price, $stocks, $description)) {

            //SET DIRECTORY NAME
            $main_dir = "images/";
            $target_dir = "images/" . $id . '/';

            //GET EACH FILE NAME IN THE TARGET DIRECTORY
            $files = glob($target_dir . '/*');


            //LOOP THE FILE LIST
            foreach ($files as $file) {
                //CHECK IF TRUE FILE
                if (is_file($file)) {
                    //DELETE THE FILE
                    unlink($file);
                }
            }

            if (editImage($target_dir, $main_dir)) {
                echo 'editSuccess';
            }
        } else {
            echo 'editFailed';
        }
    }
}

//DELETE ITEM REQUEST
if ($_POST['requestType'] == "delete-item") {
    $id = $_POST['id'];
    $sql = "DELETE FROM items WHERE id = '$id'";
    if(mysqli_query($conn, $sql)){
        //SET DIRECTORY NAME
        $main_dir = "images/";
        $target_dir = "images/" . $id . '/';

        //GET EACH FILE NAME IN THE TARGET DIRECTORY
        $files = glob($target_dir . '/*');

        //LOOP THE FILE LIST
        foreach ($files as $file) {
            //CHECK IF TRUE FILE
            if (is_file($file)) {
                //DELETE THE FILE
                unlink($file);
            }
        }
        echo 'deleteSuccess';
    } else {
        echo 'deleteFailed';
    }
}

function addItem($conn, $readyToProcess, $name, $category, $price, $stocks, $description) {
    if ($readyToProcess) {
        $sql = "INSERT INTO items(name, stocks, price, sold, category, description) 
        VALUES('$name','$stocks','$price', 0, '$category', '$description')";

        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
}
function editItem($conn, $readyToProcess, $id, $name, $category, $price, $stocks, $description) {
    if ($readyToProcess) {
        $sql = "UPDATE items SET 
        name = '$name', 
        category = '$category',
        price = '$price',
        stocks = '$stocks',
        description = '$description'
        WHERE id = '$id'";

        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
}
function editImage($directory, $mainDirectory) {

    $len = count($_FILES['images']['name']);

    // CREATE MAIN DIRECTORY IF ITS NOT EXISTED
    if (!is_dir($mainDirectory)) {
        mkdir($mainDirectory);
    }

    if (!is_dir($directory)) {
        mkdir($directory);
    }

    for ($i = 0; $i < $len; $i++) {

        $target_file = $directory . basename($_FILES["images"]["name"][$i]);

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //CHECK IF TRUE IMAGE USING "getimagesize"
        $check = getimagesize($_FILES["images"]["tmp_name"][$i]);

        if ($check) {
        } else {
            echo 'notImage';
            return false;
        }

        // CHECK IF FILE ALREADY EXISTS
        if (file_exists($target_file)) {
            echo "existsImage";
            return false;
        }

        // CHECK FILE SIZE
        if ($_FILES["images"]["size"][$i] > 2000000) {
            echo "largeImage";
            return false;
        }

        // CHECK FILE FORMAT
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "formatImage";
            return false;
        }
    }

    //VALIDATION PASSED NOW TRY TO INSERT INTO SERVER
    for ($i = 0; $i < $len; $i++) {

        $target_file = $directory . basename($_FILES["images"]["name"][$i]);

        //INSERT FILE TO SERVER
        if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $target_file)) {

        } else {
            echo 'failedImage';
            return false;
        }
    }

    return true;
}
