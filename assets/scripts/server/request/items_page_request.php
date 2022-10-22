<?php
include '../database/database.php';
include '../model/item_model.php';
include '../model/user_model.php';
include '../model/rating_model.php';
include '../controller/items_page_controller.php';

//RESPONSE FOR SINGLE ITEM INFO REQUEST
if ($_POST['requestType'] == "load-items") {
    $page = $_POST['page'];

    $ic = new ItemsPageController();
    echo json_encode($ic->itemsDataWithPage($page));
}
