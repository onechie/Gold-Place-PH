<?php

//UPDATE USER IMAGE
function update_image($id)
{
    if ($_FILES["images"]["tmp_name"][0] == null) {
        return "ok";
    }

    $specificDirectory = "../../images/users/" . $id . "/";
    if (!is_dir($specificDirectory)) {
        mkdir($specificDirectory);
    } else {
        $files = glob($specificDirectory . '*');
        foreach ($files as $file) {
            //CHECK IF TRUE FILE
            if (is_file($file)) {
                //DELETE THE FILE
                unlink($file);
            }
        }
    }

    $target_file = $specificDirectory . basename($_FILES["images"]["name"][0]);

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //CHECK IF TRUE IMAGE USING "getimagesize"
    $check = getimagesize($_FILES["images"]["tmp_name"][0]);

    if ($check) {
    } else {
        return 'not_image';
    }

    // CHECK IF FILE ALREADY EXISTS
    if (file_exists($target_file)) {
        return 'image_exists';
    }

    // CHECK FILE SIZE
    if ($_FILES["images"]["size"][0] > 2000000) {
        return 'image_large';
    }

    // CHECK FILE FORMAT
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        return 'invalid_format';
    }

    $new_file_name = $specificDirectory . md5($_FILES["images"]["name"][0]) . "." . strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //INSERT FILE TO SERVER
    if (move_uploaded_file($_FILES["images"]["tmp_name"][0], $new_file_name)) {
        return 'ok';
    } else {
        return 'failed';
    }
}

function deleteItemImage($id)
{
    $directory = "../../images/items/" . $id . "/";
    $files = glob($directory . '*');
    foreach ($files as $file) {
        //CHECK IF TRUE FILE
        if (is_file($file)) {
            //DELETE THE FILE
            unlink($file);
        }
    }
}

function editItemImage($id)
{

    $len = count($_FILES['images']['name']);

    $directory = "../../images/items/" . $id . "/";

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

    /*
    // CREATE MAIN DIRECTORY IF ITS NOT EXISTED
    if (!is_dir($mainDirectory)) {
        mkdir($mainDirectory);
    }

    if (!is_dir($directory)) {
        mkdir($directory);
    }
*/
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

        $new_file_name = $directory . md5($_FILES["images"]["name"][$i]) . "." . strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //INSERT FILE TO SERVER
        if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $new_file_name)) {
        } else {
            echo 'failedImage';
            return false;
        }
    }

    return true;
}
