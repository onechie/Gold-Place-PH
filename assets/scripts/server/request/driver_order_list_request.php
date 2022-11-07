<?php
include '../database/database.php';
include '../model/user_model.php';
include '../model/user_address_model.php';
include '../model/item_model.php';
include '../model/order_model.php';
include '../model/order_item_model.php';
include '../model/order_handler_model.php';
include '../controller/driver_order_list_controller.php';
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

    $dolc = new DriverOrderListController();
    $ordersData = $dolc->orderHandlersData($driver_id);

    if(!$ordersData){
        echo 'failed';
        exit();
    }
    
    echo json_encode($ordersData);
};

if ($_POST['requestType'] == "view-order") {
    $driver_id = $_SESSION['userId'];
    $order_id = $_POST['order_id'];
    $dolc = new DriverOrderListController();
    $orderData = $dolc->orderData($order_id, $driver_id);

    if(!$orderData){
        echo 'failed';
        exit();
    }
    
    echo json_encode($orderData);
};

if ($_POST['requestType'] == "update-order") {
    $driver_id = $_SESSION['userId'];
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $status_message = $_POST['status_message'];
    $date = date("Y-m-d H:i:s");
    $dolc = new DriverOrderListController();

    if(!$dolc->updateOrder($status, $status_message, $date, $order_id, $driver_id)){
        echo 'failed';
        exit();
    }
    echo 'ok';
};
