<?php
include '../../../../database/database.php';
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

if ($_POST['requestType'] == "submit-ref-number") {
    $order_id = $_POST['order_id'];
    $reference_number = $_POST['reference_number'];

    $oc = new OrderController();

    if(!$oc->isRefValid($reference_number)){
        echo 'invalid';
        exit();
    }
    if($oc->isRefExists($reference_number)){
        echo 'exists';
        exit();
    }
    if($oc->isOrderHasRef($order_id)){
        echo 'already';
        exit();
    }
    if(!$oc->updateRefNumber($order_id, $reference_number)){
        echo 'failed';
        exit();
    }
    echo 'ok';
}
