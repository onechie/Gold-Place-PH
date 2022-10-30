<?php

function checkToken(){
    if(!isset($_POST['token'])){
        exit();
    }
    if($_POST['token'] != $_SESSION['token']){
        exit();
    }
    return true;
}
