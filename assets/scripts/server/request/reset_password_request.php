<?php
include '../../../../database/database.php';
include '../model/user_model.php';
include '../model/forgot_password_model.php';
include '../controller/reset_password_controller.php';
include './check_token.php';

session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

if ($_POST['requestType'] == "verify-reset-request") {
    $reset_token = $_POST['reset_token'];
    $rpc = new ResetPasswordController();

    if(!$rpc->isTokenValid($reset_token)){
        echo 'invalid';
        exit();
    }
    if(!$rpc->isTokenExpired($reset_token)){
        echo 'expired';
        exit();
    }
    if(!$rpc->isLinkOpen($reset_token)){
        echo 'closed';
        exit();
    }
    echo 'ok';
}

if ($_POST['requestType'] == "reset_password") {
    $reset_token = $_POST['reset_token'];
    $new_password = $_POST['password'];

    $rpc = new ResetPasswordController();

    if(!$rpc->resetPassword($reset_token, $new_password)){
        echo 'failed';
        exit();
    }
    echo 'ok';
}