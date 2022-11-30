<?php
include '../../../../database/database.php';
include '../model/user_model.php';
include '../model/item_model.php';
include '../model/order_model.php';
include '../model/order_item_model.php';
include '../controller/admin_total_values_controller.php';
include './check_token.php';

session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

if($_SESSION['userType'] == 'admin' || $_SESSION['userType'] == 'super_admin'){
    
} else {
    exit();
}

//RESPONSE FOR GETTING ALL TOTAL DATA
if ($_POST['requestType'] == "all-total-data") {

    $atvc = new AdminTotalValuesController();

    echo json_encode($atvc->totalValues());
}
