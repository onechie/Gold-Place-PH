<?php
include '../../../../database/database.php';
include '../model/user_model.php';
include '../model/order_model.php';
include '../controller/system_admin_controller.php';
include '../controller/register_controller.php';
include './check_token.php';

session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

if($_SESSION['userType'] == 'admin' || $_SESSION['userType'] == 'super_admin'){

} else {
    exit();
}

//RESPONSE FOR LOAD ALL USERS   
if ($_POST['requestType'] == "load-users") {
    $user_type = $_POST['user_type'];
    $sac = new SystemAdminController();
    echo json_encode($sac->usersData($user_type));
}

//RESPONSE FOR LOAD SINGLE USER DATA
if ($_POST['requestType'] == "view-user") {
    $id = $_POST['id'];

    $sac = new SystemAdminController();
    echo json_encode($sac->userData($id));
}
//RESPONSE FOR LOAD SINGLE USER DATA
if ($_POST['requestType'] == "edit-user") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user_type = $_POST['user_type'];
    $verified = $_POST['verified'];
    $status = $_POST['status'];
    $id = $_POST['id'];

    $sac = new SystemAdminController();
    if(!$sac->editUser($id, $first_name, $last_name, $email, $phone, $user_type, $verified, $status)){
        echo 'failed';
        exit();
    }
    echo 'ok';

}
if ($_POST['requestType'] == "delete-user") {
    $id = $_POST['id'];
    $sac = new SystemAdminController();
    if(!$sac->deleteUser($id)){
        echo 'failed';
        exit();
    }
    echo 'ok';
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

    if (!$uc->createAccount($first_name, $last_name, $email, $phone, $password, $password, $verified, $user_type)) {
        echo 'error';
        exit();
    }
    echo 'ok';

}

if ($_POST['requestType'] == "all-total-data") {
    $sac = new SystemAdminController();
    echo json_encode($sac->totalValues());
}