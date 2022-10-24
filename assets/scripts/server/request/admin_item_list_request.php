<?php
include '../database/database.php';
include '../model/item_model.php';
include '../controller/admin_item_list_controller.php';

session_start();
date_default_timezone_set("Asia/Manila");


//RESPONSE FOR SINGLE ITEM INFO REQUEST
if ($_POST['requestType'] == "load-item") {
    $id =  $_POST['id'];

    $aitc = new AdminItemListController();

    $itemData = $aitc->itemData($id);

    if(!$itemData){
        exit();
    }
    
    echo json_encode($itemData);
}
//RESPONSE FOR MULTIPLE ITEM INFO REQUEST
if ($_POST['requestType'] == "load-items") {
    $aitc = new AdminItemListController();

    $itemsData = $aitc->itemsData();

    if(!$itemsData){
        exit();
    }

    echo json_encode($itemsData);
}

//ADD ITEM REQUEST
if ($_POST['requestType'] == "add-item") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stocks = $_POST['stocks'];
    $description = $_POST['description'];

    $aitc = new AdminItemListController();

    if ($_FILES["images"]["tmp_name"][0] == null) {
        echo 'noImage';
        exit();
    }

    if (!$aitc->createNewItem($name, $category, $price, $stocks, $description)) {
        echo 'addFailed';
        exit();
    }

    echo 'addSuccess';
}

//EDIT ITEM REQUEST
if ($_POST['requestType'] == "edit-item") {


    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stocks = $_POST['stocks'];
    $description = $_POST['description'];
    $shouldUpdateImage = true;

    $aitc = new AdminItemListController();

    if ($_FILES["images"]["tmp_name"][0] == null) {
        $shouldUpdateImage = false;
    }

    if (!$aitc->editItem($name, $category, $price, $stocks, $description, $id, $shouldUpdateImage)) {
        echo 'editFailed';
        exit();
    }
    echo "editSuccess";
}

//DELETE ITEM REQUEST
if ($_POST['requestType'] == "delete-item") {

    $id = $_POST['id'];
    $aitc = new AdminItemListController();

    if (!$aitc->removeItem($id)) {
        echo 'deleteFailed';
        exit();
    }
    echo 'deleteSuccess';
}
