<?php
    date_default_timezone_set("Asia/Manila");
    echo date('l jS \of F Y h:i:s A');
    $min = date("Y-m-d");
    echo strtotime($min).' = = ';
    $min = strtotime("-1 day", strtotime($min));
    echo $min;
?>