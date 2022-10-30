<?php
    if(!isset($_SESSION['token'])){
        $_SESSION['token'] = bin2hex(random_bytes(35));
    }
    $token = $_SESSION['token'];
    echo "<input type='hidden' class='token' name='token' value='$token'>"
?>