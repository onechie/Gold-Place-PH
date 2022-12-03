<?php

include '../controller/contact_controller.php';
include './check_token.php';


session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

if ($_POST['requestType'] == "send-email") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $cc = new ContactController();
    if($cc->sendEmail($name, $email, $message)){
        echo 'ok';
        exit();
    }
    echo 'failed';
}