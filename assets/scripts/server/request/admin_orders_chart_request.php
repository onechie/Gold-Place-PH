<?php
include '../../../../database/database.php';
include '../model/order_model.php';
include '../controller/admin_orders_chart_controller.php';
include './check_token.php';

session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

if($_SESSION['userType'] == 'admin' || $_SESSION['userType'] == 'super_admin'){
    
} else {
    exit();
}

//RESPONSE FOR ORDERS CHART DATA
if ($_POST['requestType'] == "order-chart-data") {

    $limitText =  $_POST['limit'];
    $aoc = new AdminOrdersChartController();
    echo json_encode($aoc->ordersData($limitText));
};