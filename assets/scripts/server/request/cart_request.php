<?php
include '../database/database.php';
include '../model/cart_model.php';
include '../model/item_model.php';
include '../model/user_address_model.php';
include '../model/order_model.php';
include '../model/order_item_model.php';
include '../model/province_list_model.php';
include '../model/city_list_model.php';
include '../model/barangay_list_model.php';
include '../controller/cart_controller.php';
include './check_token.php';

session_start();
date_default_timezone_set("Asia/Manila");
checkToken();

if ($_POST['requestType'] == "cart_add") {
    if (isset($_SESSION['userId'])) {
        $item_id = $_POST['id'];
        $quantity = $_POST['quantity'];
        $user_id = $_SESSION['userId'];
        $currentDate = date("Y-m-d H:i:s");

        $cc = new CartController();

        if ($cc->isOnCart($user_id, $item_id)) {
            echo 'already';
            exit();
        }

        if ($cc->addToCart($item_id, $user_id, $quantity, $currentDate)) {
            echo 'success';
            exit();
        }
        echo 'error';
    } else {
        echo "login_required";
    }
}

if ($_POST['requestType'] == "cart_info") {
    $user_id = $_SESSION['userId'];
    $cc = new CartController();

    $cartData = $cc->cartData($user_id);

    if (!$cartData) {
        exit();
    }
    echo json_encode($cartData);
}

if ($_POST['requestType'] == "cart_update") {

    $quantity = $_POST['value'];
    $cart_id = $_POST['cart_id'];
    $user_id = $_SESSION['userId'];
    $currentDate = date("Y-m-d H:i:s");

    $cc = new CartController();
    if ($cc->updateCartQuantity($quantity, $currentDate, $cart_id, $user_id)) {
        echo 'ok';
        exit();
    }
    echo 'failed';
}

if ($_POST['requestType'] == "cart_checkout") {

    $cartItems = $_POST['cartItems'];
    $user_id = $_SESSION['userId'];
    $currentDate = date("Y-m-d H:i:s");
    $status = 'checking';
    $available = 'yes';
    $cc = new CartController();
    $items = count($cartItems);

    if (!$cc->isAddressValid($user_id)) {
        echo 'invalid_address';
        exit();
    }

    if ($items == 0) {
        exit();
    }
    if (!$cc->isItemsOnStock($cartItems)) {
        echo 'out_of_stock';
        exit();
    }
    if (!$cc->isQuantityValid($cartItems)) {
        echo 'zero_value';
        exit();
    }

    if (!$cc->checkOut($user_id, $items, $status, $currentDate, $cartItems, $available)) {
        echo 'error';
        exit();
    }
    echo 'ok';
}

if ($_POST['requestType'] == "cart_remove") {
    $cartItems = $_POST['cartItems'];
    $user_id = $_SESSION['userId'];

    $cc = new CartController();

    if ($cc->removeItemsOnCart($cartItems, $user_id)) {
        echo 'ok';
        exit();
    }
    echo 'error';
}
if ($_POST['requestType'] == "user_shipping_fee") {

    $user_id = $_SESSION['userId'];
    $cc = new CartController();

    $fee = $cc->getShippingFee($user_id);

    if (!$fee) {
        echo 'Invalid Address!';
        exit();
    }
    echo $fee;
}
