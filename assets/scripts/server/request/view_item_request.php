<?php
include '../database/database.php';
include '../model/item_model.php';
include '../model/user_model.php';
include '../model/rating_model.php';
include '../model/order_model.php';
include '../model/order_item_model.php';
include '../controller/view_item_controller.php';
include './check_token.php';

session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

//RESPONSE FOR SINGLE ITEM INFO REQUEST
if ($_POST['requestType'] == "load-item") {
    $item_id = $_POST['id'];
    $vic = new ViewItemController();

    if(isset($_SESSION['userId'])){
        echo json_encode($vic->itemData($item_id, $_SESSION['userId']));
        
        exit();
    }
    echo json_encode($vic->itemData($item_id));
}
//RESPONSE FOR RATE ITEM
if ($_POST['requestType'] == "rate-item") {
    $star = $_POST['star'];
    $comment = $_POST['comment'];
    $item_id = $_POST['itemId'];
    $user_id = $_SESSION['userId'];
    $rateLimit = 0;

    $vic = new ViewItemController();

    if(!$vic->submitRate($item_id, $comment, $star, $user_id)){
        echo 'failed';
        exit();
    }
    echo 'ok';
}
