<?php
include './database.php';
$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$stocks = $_POST['stocks'];
$description = $_POST['description'];
$len = count($_FILES['images']['name']);
$readyToInsert = false;

//SET DIRECTORY NAME
$target_dir = "images/";
$new_dir = "";
//GET THE LAST PRODUCT IN THE DATABASE AND GET THE ID
$select = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC LIMIT 1") or die('query failed');
if (mysqli_num_rows($select) > 0) {
    while ($rows = mysqli_fetch_assoc($select)) {
        //GET THE ID AND CONVERT TO INT
        $id = (int)$rows['id'];
        //ADD 1 TO THE ID
        $id++;
        //MAKE THE ID AS A DIRECTORY NAME
        $new_dir = $target_dir . $id . '/';
    }
} else {
    //IF THERE IS NO PRODUCT IN THE DATABASE MAKE DIRECTORY "1"
    $new_dir = $target_dir . '1' . '/';
}


for ($i = 0; $i < $len; $i++) {

    $target_file = $new_dir . basename($_FILES["images"]["name"][$i]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //SKIP IF FILE IS NULL
    if ($_FILES["images"]["tmp_name"][$i] == null) {
        continue;
    }

    //CHECK IF TRUE IMAGE USING "getimagesize"
    $check = getimagesize($_FILES["images"]["tmp_name"][$i]);

    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // CHECK IF FILE ALREADY EXISTS
    if (file_exists($target_file)) {
        echo "File already exists.";
        $uploadOk = 0;
    }

    // CHECK FILE SIZE
    if ($_FILES["images"]["size"][$i] > 4000000) {
        echo "File is too large.";
        $uploadOk = 0;
    }

    // CHECK FILE FORMAT
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // CHECK IF $uploadOk IS SET TO 0 BY ERROR
    if ($uploadOk == 0) {
        echo "Product was not uploaded.";
        // UPLOAD THE FILE
    } else {
        if ($i == 0) {
            // CREATE MAIN DIRECTORY IF ITS NOT EXISTED
            if(is_dir($target_dir)){
                mkdir($new_dir);
            } else {
                mkdir($target_dir);
                mkdir($new_dir);
            }
        }
        //UPLOAD THE FILE AND SET READY TO INSERT TO DATABASE
        if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $target_file)) {
            $readyToInsert = true;
        }
    }
}
//IF READY, INSERT TO DATABASE
if ($readyToInsert) {
    mysqli_query($conn, "INSERT INTO products(name, stock, price, sold, category, description) 
    VALUES('$name','$stocks','$price', 0, '$category', '$description')") or die('query failed');
    echo 'done';
}
