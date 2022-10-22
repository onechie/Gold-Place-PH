<?php
include '../database/database.php';
include '../model/item_model.php';
include '../model/user_model.php';
include '../model/rating_model.php';
include '../model/order_model.php';
include '../model/order_item_model.php';
include '../controller/view_item_controller.php';

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
