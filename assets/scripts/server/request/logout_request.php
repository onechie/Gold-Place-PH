<?php
include '../controller/logout_controller.php';

$lc = new LogoutController();
$lc->logoutUser();
echo 'logout';