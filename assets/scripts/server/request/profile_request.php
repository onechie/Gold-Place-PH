<?php
include '../database/database.php';

include '../model/user_model.php';
include '../model/city_list_model.php';
include '../model/province_list_model.php';
include '../model/user_address_model.php';
include '../model/order_model.php';
include '../model/order_item_model.php';
include '../controller/profile_controller.php';
include './check_token.php';

session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

//RESPONSE FOR GETTING PROFILE DATA
if ($_POST['requestType'] == "get_profile") {

    $user_id = $_SESSION['userId'];

    $pc = new ProfileController();

    echo json_encode($pc->profileData($user_id));
}

//RESPONSE FOR UPDATE PROFILE
if ($_POST['requestType'] == "update_profile") {

    $number = $_POST['number'];
    $street = $_POST['street'];
    $user_id = $_SESSION['userId'];
    $city = $_POST['city'];
    $province =  $_POST['province'];
    
    $pc = new ProfileController();

    if(!$pc->updateAddress($user_id, $number, $street, $city, $province)){
        echo 'error';
        exit();
    }
    echo 'ok';

}
