<?php
include '../database/database.php';
include '../model/user_model.php';
include '../model/order_model.php';
include '../controller/admin_user_list_controller.php';
include '../controller/register_controller.php';

date_default_timezone_set("Asia/Manila");

//RESPONSE FOR LOAD ALL USERS
if ($_POST['requestType'] == "load-users") {
    $aulc = new AdminUserListController();
    echo json_encode($aulc->usersData());

}

//RESPONSE FOR LOAD SINGLE USER DATA
if ($_POST['requestType'] == "view-users") {
    $id = $_POST['id'];

    $aulc = new AdminUserListController();
    echo json_encode($aulc->userData($id));
}

//RESPONSE FOR ADD USER
if ($_POST['requestType'] == "add-user") {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user_type = $_POST['user_type'];
    $password = $_POST['password'];
    $verified = 'no';
    $verRequired = $_POST['verRequired'];

    $uc = new RegisterController();

    if($verRequired == 'no'){
        $verified = 'yes';
    }

    if (!$uc->createAccount($first_name, $last_name, $email, $phone, $password, $verified, 'customer')) {
        echo 'error';
        exit();
    }
    echo 'ok';

}