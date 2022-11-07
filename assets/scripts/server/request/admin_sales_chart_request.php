<?php
include '../database/database.php';
include '../model/order_model.php';
include '../model/order_item_model.php';
include '../controller/admin_sales_chart_controller.php';
include './check_token.php';

session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

if($_SESSION['userType'] == 'admin' || $_SESSION['userType'] == 'super_admin'){
    
} else {
    exit();
}

//RESPONSE FOR SALES CHART DATA
if ($_POST['requestType'] == "line-chart-data") {

    $limitText = $_POST['limit'];
    $asc = new AdminSalesChartController();
    echo json_encode($asc->salesData($limitText));
}
