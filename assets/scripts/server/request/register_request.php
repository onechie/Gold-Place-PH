<?php
include '../database/database.php';
include '../model/user_model.php';
include '../controller/register_controller.php';

if ($_POST['requestType'] == "validate_email") {
    $email = $_POST['email'];

    $uc = new RegisterController();
    if ($uc->isEmailExist($email)) {
        echo 'used';
        exit();
    }
    echo "ok";
}

if ($_POST['requestType'] == "validate_phone") {
    $phone = $_POST['phone'];

    $uc = new RegisterController();
    if ($uc->isPhoneExist($phone)) {
        echo 'used';
        exit();
    }
    echo "ok";
}

if ($_POST['requestType'] == "create_account") {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $uc = new RegisterController();

    if (!$uc->createAccount($firstname, $lastname, $email, $phone, $password, 'no', 'customer')) {
        echo 'error';
        exit();
    }
    echo 'ok';
}
