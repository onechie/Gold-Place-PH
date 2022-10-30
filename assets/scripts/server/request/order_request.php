<?php
include '../database/database.php';

include '../model/item_model.php';
include '../model/order_model.php';
include '../model/order_item_model.php';
include '../controller/order_controller.php';
include './check_token.php';

session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

//RESPONSE FOR GET ORDER INFO
if ($_POST['requestType'] == "order_info") {
    $user_id = $_SESSION['userId'];
    $type = $_POST['type'];

    $oc = new OrderController();
    $orderData = $oc->orderData($user_id, $type);

    if(!$orderData){
        exit();
    }
    echo json_encode($orderData);
}
