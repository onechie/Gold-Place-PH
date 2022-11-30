<?php
include '../../../../database/database.php';
include '../model/province_list_model.php';
include '../model/city_list_model.php';
include '../model/barangay_list_model.php';
include '../controller/admin_location_list_controller.php';
include './check_token.php';

session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

if($_SESSION['userType'] == 'admin' || $_SESSION['userType'] == 'super_admin'){
    
} else {
    exit();
}

//RESPONSE FOR ORDERS CHART DATA
if ($_POST['requestType'] == "add-province") {

    $province = $_POST['province'];
    $allc = new AdminLocationListController();

    if($allc->isEmpty($province)){
        echo'empty';
        exit();
    }

    if($allc->isProvinceExist($province)){
        echo 'exist';
        exit();
    }

    if(!$allc->addProvince($province)){
        echo 'failed';
        exit();
    }
    echo 'ok';
};

//RESPONSE FOR ORDERS CHART DATA
if ($_POST['requestType'] == "province-list") {

    $allc = new AdminLocationListController();
    $provinceData = $allc->provincesData();
    if(!$provinceData){
        echo 'no record';
        exit();
    }

    echo json_encode($provinceData);
};

if ($_POST['requestType'] == "province-delete") {
    $id = $_POST['id'];
    $allc = new AdminLocationListController();
    
    if(!$allc->removeProvince($id)){
        echo 'failed';
        exit();
    }

    echo 'ok';
};

if ($_POST['requestType'] == "add-city") {
    $city = $_POST['city'];
    $province = $_POST['province'];
    $allc = new AdminLocationListController();

    if($allc->isEmpty($city)){
        echo'empty';
        exit();
    }

    if(!$allc->addCity($city, $province)){
        echo 'failed';
        exit();
    }

    echo 'ok';
};
if ($_POST['requestType'] == "city-list") {
    $allc = new AdminLocationListController();
    $citysData = $allc->citysData();
    if(!$citysData){
        echo 'no record';
        exit();
    }

    echo json_encode($citysData);
};

if ($_POST['requestType'] == "city-delete") {
    $id = $_POST['id'];
    $allc = new AdminLocationListController();
    
    if(!$allc->removeCity($id)){
        echo 'failed';
        exit();
    }

    echo 'ok';
};

if ($_POST['requestType'] == "add-brgy") {

    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $shipping_fee = $_POST['shipping_fee'];

    $allc = new AdminLocationListController();

    if($allc->isEmpty($barangay)){
        echo'empty';
        exit();
    }
    if($allc->isEmpty($shipping_fee)){
        echo'empty';
        exit();
    }

    if(!$allc->addBarangay($barangay, $city, $shipping_fee)){
        echo 'failed';
        exit();
    }
    echo 'ok';
    
};
if ($_POST['requestType'] == "brgy-list") {
    $allc = new AdminLocationListController();
    $barangayData = $allc->barangayData();
    if(!$barangayData){
        echo 'no record';
        exit();
    }

    echo json_encode($barangayData);
};

if ($_POST['requestType'] == "brgy-delete") {
    $id = $_POST['id'];
    $allc = new AdminLocationListController();
    
    if(!$allc->removeBarangay($id)){
        echo 'failed';
        exit();
    }

    echo 'ok';
};