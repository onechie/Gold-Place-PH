<?php
include '../database/database.php';
include '../model/item_model.php';
include '../model/user_model.php';
include '../model/rating_model.php';
include '../controller/items_page_controller.php';
include './check_token.php';

session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

//RESPONSE FOR SINGLE ITEM INFO REQUEST
if ($_POST['requestType'] == "load-items") {
    $page = $_POST['page'];
    $sort = $_POST['sort'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $ic = new ItemsPageController();

    if($sort != '' || $price != '' || $category != ''){
        echo json_encode($ic->getItemsDataWithPageAndOption($page, $category, $sort, $price));
        exit();
    }
    
    echo json_encode($ic->itemsDataWithPage($page));
}
