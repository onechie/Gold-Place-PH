<?php
include '../database/database.php';
include '../model/user_model.php';
include '../controller/login_controller.php';

if ($_POST['requestType'] == "validate_email") {
    $email = $_POST['email'];

    $lc = new LoginController();

    if (!$lc->isEmailExist($email)) {
        echo 'not_registered';
        exit();
    }
    if (!$lc->isEmailVerified($email)) {
        echo 'not_verified';
        exit();
    }
    echo 'ok';
}

if ($_POST['requestType'] == "login") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $lc = new LoginController();
    if (!$lc->login($email, $password)) {
        echo 'wrong_pass';
        exit();
    }
    echo 'ok';
}
