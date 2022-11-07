<?php
include '../database/database.php';
include '../model/user_model.php';
include '../model/user_address_model.php';
include '../model/item_model.php';
include '../model/order_model.php';
include '../model/order_item_model.php';
include '../model/order_handler_model.php';
include '../controller/driver_add_order_controller.php';
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


if ($_POST['requestType'] == "find-order") {
    $order_id = $_POST['order_id'];
    $user_id = $_SESSION['userId'];
    $daoc = new DriverAddOrderController();

    $orderData = $daoc->findOrder($order_id, $user_id);

    if(!$orderData){
        echo 'failed';
        exit();
    }
    echo json_encode($orderData);
};


if ($_POST['requestType'] == "add-order") {
    $order_id = $_POST['order_id'];
    $driver_id = $_SESSION['userId'];
    $daoc = new DriverAddOrderController();

    if(!$daoc->addOrder($driver_id, $order_id)){
        echo 'failed';
        exit();
    }
    echo 'ok';
};