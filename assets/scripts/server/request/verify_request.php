<?php
include '../../../../database/database.php';
include '../model/user_model.php';
include '../controller/verify_controller.php';

if ($_POST['requestType'] == "verify") {

    $code = $_POST['code'];
    $vc = new VerifyController();
    if (!$vc->verify($code)) {
        echo 'error';
        exit();
    }
    echo 'Your account is successfully verified!';
}
