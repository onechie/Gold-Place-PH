<?php
include '../database/database.php';
include '../model/user_model.php';
include '../model/user_address_model.php';
include '../model/item_model.php';
include '../model/order_model.php';
include '../model/order_item_model.php';
include '../model/order_handler_model.php';
include '../controller/driver_done_order_list_controller.php';
include './check_token.php';

session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

/*
if($_SESSION['userType'] == 'admin' || $_SESSION['userType'] == 'super_admin'){
    
} else {
    exit();
}
*/
if ($_POST['requestType'] == "order-list") {
    $driver_id = $_SESSION['userId'];

    $ddolc = new DriverDoneOrderListController();
    $ordersData = $ddolc->orderHandlersData($driver_id);

    if(!$ordersData){
        echo 'failed';
        exit();
    }
    
    echo json_encode($ordersData);
};

if ($_POST['requestType'] == "view-order") {
    $driver_id = $_SESSION['userId'];
    $order_id = $_POST['order_id'];
    $ddolc = new DriverDoneOrderListController();
    $orderData = $ddolc->orderData($order_id, $driver_id);

    if(!$orderData){
        echo 'failed';
        exit();
    }
    
    echo json_encode($orderData);
};