<?php
include '../database/database.php';
include '../model/user_model.php';
include '../model/item_model.php';
include '../model/order_model.php';
include '../model/order_item_model.php';
include '../model/user_address_model.php';
include '../controller/admin_recent_order_controller.php';
include './check_token.php';

session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

if($_SESSION['userType'] == 'admin' || $_SESSION['userType'] == 'super_admin'){
    
} else {
    exit();
}

//RESPONSE FOR RECENT ORDERS DATA
if ($_POST['requestType'] == "get-recent-orders") {

    $aroc = new AdminRecentOrderController();
    $recentOrdersData = $aroc->recentOrdersData();
    if (!$recentOrdersData) {
        exit();
    }

    echo json_encode($recentOrdersData);
}
//RESPONSE FOR ORDER ITEMS
if ($_POST['requestType'] == "get-order-data") {

    $order_id = $_POST['order_id'];

    $aroc = new AdminRecentOrderController();
    $orderData = $aroc->orderData($order_id);
    echo json_encode($orderData);

}

if ($_POST['requestType'] == "get-full-order-data") {

    $order_id = $_POST['order_id'];

    $aroc = new AdminRecentOrderController();
    $fullOrderData = $aroc->fullOrderData($order_id);
    echo json_encode($fullOrderData);

}

//RESPONSE FOR EDIT ORDER STATUS
if ($_POST['requestType'] == "edit-order-status") {
    $status = $_POST['status'];
    $order_id = $_POST['order_id'];
    $date = date("Y-m-d H:i:s");

    $aroc = new AdminRecentOrderController();

    if(!$aroc->updateOrder($order_id, $date, $status)){
        echo 'failed';
        exit();
    }
    echo 'ok';
}
