<?php
include '../../../../database/database.php';
include '../model/user_model.php';
include '../model/forgot_password_model.php';
include '../controller/forgot_password_controller.php';
include './check_token.php';

session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

if ($_POST['requestType'] == "forgot_password") {
    $email = $_POST['email'];
    $currentDate = date("Y-m-d H:i:s");
    $fpc = new ForgotPasswordController();

    if (!$fpc->isUserExists($email)) {
        echo 'not_valid';
        exit();
    }
    if (!$fpc->createLink($email, $currentDate)) {
        echo 'failed';
        exit();
    }
    echo 'ok';
}
