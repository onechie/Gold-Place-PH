<?php
include './database.php';
include './validations.php';
include './User_manager.php';

include './database/database.php';
include './user_model.php';
include './item_model.php';
include './cart_model.php';
include './order_model.php';
include './address_model.php';



session_start();
date_default_timezone_set("Asia/Manila");
$user_id = '';
if (isset($_SESSION['userId'])) {
    $user_id = mysqli_escape_string($conn, $_SESSION['userId']);
}

//REGISTRATION VALIDATIONS

//EMAIL REG-VALIDATION CHECK IF EXISTS
if (isset($_POST['requestType']) && $_POST['requestType'] == "v-reg-email") {
    /*
    $email = mysqli_escape_string($conn, $_POST['email']);

    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "used";
    } else {
        echo 'ok';
    }
    */
    $email = $_POST['email'];
    $um = new UserModel();
    $um->getUserByEmail($email);

    if (count($um->getUserByEmail($email)) > 0) {
        echo "used";
        exit();
    }
    echo "ok";
}

//PHONE REG-VALIDATION CHECK IF EXISTS
if (isset($_POST['requestType']) && $_POST['requestType'] == "v-reg-phone") {
    /*
    $phone = $_POST['phone'];
    $tenDigitPhone = substr($phone, -10);
    $withZeroDigitPhone = '0' . $tenDigitPhone;
    $withPlusDigitPhone =  '+63' . $tenDigitPhone;

    $sql = "SELECT * FROM user WHERE phone = '$tenDigitPhone' OR phone = '$withZeroDigitPhone' OR phone = '$withPlusDigitPhone'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo 'used';
    } else {
        echo 'ok';
    }

    */

    $phone = $_POST['phone'];
    $um = new UserModel();
    $um->getUserByEmail($phone);

    if (count($um->getUserByPhone($phone)) > 0) {
        echo "used";
        exit();
    }
    echo "ok";
}

//FINAL REG-VALIDATION
if (isset($_POST['requestType']) && $_POST['requestType'] == "v-reg-final") {
    /*
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    //REGULAR EXPRESSIONS PATTERN
    $emailPattern = "/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/";
    $phonePattern = "/((^(\+63)(\d{10}))|(^(0)(\d{10}))|(^(9)(\d{9})))$/";
    $namePattern = "/^([a-zA-Z])+([-. ]([a-zA-Z])+)?([-. ]([a-zA-Z])+)?$/";

    //VALIDATE WITH PATTERN
    $testFname = (preg_match($namePattern, $firstname));
    $testLname = (preg_match($namePattern, $lastname));
    $testEmail = (preg_match($emailPattern, $email));
    $testPhone = (preg_match($phonePattern, $phone));

    //FORMAT PHONE NUMBER
    $tenDigitPhone = substr($phone, -10);
    $withZeroDigitPhone = '0' . $tenDigitPhone;
    $withPlusDigitPhone =  '+63' . $tenDigitPhone;

    //CHECK IF VALUES ARE VALID FROM PATTERN
    if ($testFname && $testLname && $testEmail && $testPhone) {
        
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        //CHECK IF EMAIL ALREADY EXISTS
        if (mysqli_num_rows($result) <= 0) {

            $testPhone = "SELECT * FROM user WHERE phone = '$tenDigitPhone' OR phone = '$withZeroDigitPhone' OR phone = '$withPlusDigitPhone'";
            $resultPhone = mysqli_query($conn, $testPhone);

            //CHECK PHONE NUMBER IN DIFFERENT FORMAT IF ALREADY EXISTS
            if (mysqli_num_rows($resultPhone) == 0) {
                $code = password_hash(randomString(), PASSWORD_DEFAULT);
                $sql = "INSERT INTO user (firstname, lastname, email, phone, password, verified, type, verification_code) VALUES('$firstname', '$lastname', '$email', '$phone', '$password', 'no', 'customer', '$code')";
                if (mysqli_query($conn, $sql)) {

                    if (sendEmail($email, $code)) {
                        echo 'ok';
                    }
                } else {
                    echoError('0ca4');
                }
            } else {
                echoError('0ca3');
            }
        } else {
            echoError('0ca2');
        }
    } else {
        echoError('0ca1');
    }
*/
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    if (!isNameValid($firstname)) {
        echo 'error';
        exit();
    }
    if (!isNameValid($lastname)) {
        echo 'error';
        exit();
    }
    if (!isEmailValid($email)) {
        echo 'error';
        exit();
    }
    if (!isPhoneValid($phone)) {
        echo 'error';
        exit();
    }
    if (!isPassValid($phone)) {
        echo 'error';
        exit();
    }

    $code = password_hash(randomString(), PASSWORD_DEFAULT);
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    $userData = [$firstname, $lastname, $email, $phone, $passwordHashed, 'no', 'customer', $code];

    $um = new UserModel();
    if (!$um->setUser($userData)) {
        echo 'error';
        exit();
    }
    if (sendEmail($email, $code)) {
        echo 'ok';
        exit();
    }
    echo 'error';
}


//LOGIN VALIDATIONS

//EMAIL LOG-VALIDATION
if (isset($_POST['requestType']) && $_POST['requestType'] == "v-log-email") {

    $email = $_POST['email'];
    $um = new UserModel();
    $returnData = $um->getUserByEmail($email);

    if (count($returnData) == 0) {
        echo 'not_registered';
        exit();
    }
    if ($returnData[0]['verified'] == 'yes') {
        echo 'ok';
        exit();
    }
    echo 'not_verified';


    /*
    $email = mysqli_escape_string($conn, $_POST['email']);

    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        echo 'not_registered';
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $verified = $row['verified'];
            if ($verified == 'yes') {
                echo 'ok';
            } else {
                echo 'not_verified';
            }
        }
    }
    */
}
//FINAL LOG-VALIDATION
if (isset($_POST['requestType']) && $_POST['requestType'] == "v-log-final") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $um = new UserModel();
    $returnData = $um->getUserByEmail($email);

    if (count($returnData) == 0) {
        echo 'error';
        exit();
    }
    if ($returnData[0]['verified'] == 'no') {
        echo 'not_verified';
        exit();
    }
    if (password_verify($password,  $returnData[0]['password'])) {

        $_SESSION["userId"] = $returnData[0]['id'];
        $_SESSION["userEmail"] = $returnData[0]['email'];
        $_SESSION["userType"] = $returnData[0]['type'];
        $_SESSION["userName"] = $returnData[0]['firstname'] . " " . $returnData[0]['lastname'];
        echo "ok";
        exit();
    }
    echo 'wrong_pass';

    /*
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    //REGULAR EXPRESSIONS PATTERN
    $emailPattern = "/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/";

    //VALIDATE WITH PATTERN
    $testEmail = (preg_match($emailPattern, $email));

    //CHECK IF VALUE IS VALID FROM PATTERN
    if ($testEmail) {
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        //CHECK IF EMAIL IS EXISTS
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $checkPassword = $row['password'];
                $userfn = $row['firstname'];
                $userln = $row['lastname'];
                $userid = $row['id'];
                $userType = $row['type'];
                $verified = $row['verified'];
                if ($verified == 'yes') {
                    if (password_verify($password, $checkPassword)) {

                        $_SESSION["userId"] = $userid;
                        $_SESSION["userType"] = $userType;
                        echo "o_k" . $userfn . " " . $userln;
                    } else {
                        echo 'wrong_pass';
                    }
                } else {
                    echo 'not_verified';
                }
            }
        } else {
            echoError('0l2');
        }
    } else {
        echoError('0l1');
    }
    */
}

//EMAIL VERIFICATION
if (isset($_POST['requestType']) && $_POST['requestType'] == "verify-email") {

    $code = $_POST['code'];
    $um = new UserModel();
    $returnData = $um->getUserByCode($code);

    if (count($returnData) == 0) {
        echo 'error';
        exit();
    }

    if ($um->setUserVerified($returnData[0]['id'])) {
        echo 'Your account is successfully verified!';
        exit();
    }
    echo 'error';
    /*
    $code = mysqli_escape_string($conn, $_POST['code']);
    $sql = "SELECT * FROM verify WHERE code = '$code'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $user_email = $row['user_email'];
            $sql = "SELECT * FROM user WHERE id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['verified'] == 'yes') {
                        echo 'error';
                    } else {
                        $sql = "UPDATE user SET verified = 'yes' WHERE id = '$user_id' AND email ='$user_email'";
                        if (mysqli_query($conn, $sql)) {
                            echo 'Your account is successfully verified!';
                        } else {
                            echo 'error';
                        }
                    }
                }
            } else {
                echo 'error';
            }
        }
    } else {
        echo 'error';
    }
    */
}


//RESPONSE FOR SINGLE ITEM INFO REQUEST
if (isset($_POST['requestType']) && $_POST['requestType'] == "load-item") {

    $im = new ItemModel();

    if (isset($_SESSION['userId'])) {
        echo json_encode($im->getItemById($_POST['id'], $_SESSION['userId']));
        exit();
    }
    echo json_encode($im->getItemById($_POST['id']));

    /*
    $id = mysqli_escape_string($conn, $_POST['id']);
    $sql = "SELECT * FROM items WHERE id = '$id'";

    $item = getItemData($sql, $conn, true);
    echo json_encode($item);
    */
}

//RESPONSE FOR MULTIPLE ITEM INFO REQUEST
if (isset($_POST['requestType']) && $_POST['requestType'] == "load-items") {

    $im = new ItemModel();

    if (isset($_SESSION['userId'])) {
        echo json_encode($im->getItemS($_POST['page'], $_SESSION['userId']));
        exit();
    }
    echo json_encode($im->getItemS($_POST['page']));

    /*
    $sql = "SELECT * FROM items";

    if (isset($_POST['page'])) {
        $page = mysqli_escape_string($conn, $_POST['page']);
        $offset = $page * 8 - 8;
        $sql .= " LIMIT 8 OFFSET $offset";
    }

    $items = getItemData($sql, $conn, false);
    echo json_encode($items);

    */
}

//RESPONSE FOR ADD TO CART
if (isset($_POST['requestType']) && $_POST['requestType'] == "cart_add") {
    if (isset($_SESSION['userId'])) {

        $item_id = $_POST['id'];
        $quantity = $_POST['quantity'];
        $user_id = $_SESSION['userId'];
        $stocks = 0;
        $currentDate = date("Y-m-d H:i:s");

        $im = new ItemModel();
        $item = $im->getItemById($item_id);
        $stocks = $item[0]['stocks'];

        $cm = new CartModel();
        if (count($cm->getUserCart($user_id, $item_id)) > 0) {
            echo "already";
            exit();
        }

        $newQuantity = 0;

        if ($quantity <= 0) $newQuantity = 1;
        else if ($quantity <= $stocks) $newQuantity = $quantity;
        else $newQuantity = $stocks;

        if ($cm->setCart($item_id, $user_id, $newQuantity, $currentDate)) {
            echo 'success';
            exit();
        }
        echo 'error';

        /*
        //GET THE ITEM STOCKS
        $item_sql = "SELECT * FROM items WHERE id = '$item_id'";
        $item_response = mysqli_query($conn, $item_sql);
        if (mysqli_num_rows($item_response) > 0) {
            while ($item_rows = mysqli_fetch_assoc($item_response)) {
                $stocks = $item_rows['stocks'];
            }
        }

        $check_sql = "SELECT * FROM cart where user_id = '$user_id' and item_id = '$item_id'";
        $check_result = mysqli_query($conn, $check_sql);
        if (mysqli_num_rows($check_result) > 0) {
            echo "already";
        } else {
            $newQuantity = 0;

            if ($quantity <= 0) {
                $newQuantity = 1;
            } else if ($quantity <= $stocks) {
                $newQuantity = $quantity;
            } else {
                $newQuantity = $stocks;
            }

            $sql = "INSERT INTO cart(item_id, user_id, quantity, date_created) VALUES ('$item_id','$user_id','$newQuantity', '$currentDate')";
            if (mysqli_query($conn, $sql)) {
                echo "success";
            } else {
                echo "error";
            }
        }
        */
    } else {
        echo "login_required";
    }
}

//RESPONSE FOR GET CART INFO
if (isset($_POST['requestType']) && $_POST['requestType'] == "cart_info") {
    $user_id = $_SESSION['userId'];

    $cartItems = array();
    $cm = new CartModel();
    $im = new ItemModel();
    $carts = $cm->getUserCartByUid($user_id);
    if (count($carts) > 0) {
        foreach ($carts as $cart) {
            $item_id = $cart['item_id'];
            $qty = $cart['quantity'];
            $cart_id = $cart['id'];

            $image = $im->getItemImage($item_id, false);
            $items = $im->getItemById($item_id);
            foreach ($items as $item) {
                $cartItems[] = array(
                    "id" => $item_id,
                    "cart_id" => $cart_id,
                    "name" => $item['name'],
                    "price" => $item['price'],
                    "quantity" => $qty,
                    "images" => $image
                );
            }
        }
        echo json_encode($cartItems);
    }
    /*
    $sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    $cartItems = array();

    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $item_id = $rows['item_id'];
            $qty = $rows['quantity'];
            $cart_id = $rows['id'];

            //GET THE ID AND SET AS DIRECTORY
            $directory = '../../images/items/' . $item_id;
            //SCAN THE FILES INSIDE THE DIRECTORY
            $files = array_diff(scandir($directory), array('..', '.'));
            $file = array();
            //GET THE FIRST FILE'S NAME
            foreach ($files as $key => $value) {
                $file[] = $value;
                break;
            }

            $sql_new = "SELECT * FROM items WHERE id = '$item_id'";
            $result_new = mysqli_query($conn, $sql_new);
            if (mysqli_num_rows($result_new) > 0) {
                while ($rows_new = mysqli_fetch_assoc($result_new)) {
                    $cartItems[] = array(
                        "id" => $item_id,
                        "cart_id" => $cart_id,
                        "name" => $rows_new['name'],
                        "price" => $rows_new['price'],
                        "quantity" => $qty,
                        "images" => $file
                    );
                }
            }
        }
        echo json_encode($cartItems);
    }
    */
}

//RESPONSE FOR CART CHANGING QUANTITY
if (isset($_POST['requestType']) && $_POST['requestType'] == "cart_update") {

    $quantity = $_POST['value'];
    $cart_id = $_POST['cart_id'];
    $user_id = $_SESSION['userId'];
    $item_id = '';
    $stocks = 0;
    $currentDate = date("Y-m-d H:i:s");

    $cm = new CartModel();
    $cart = $cm->getUserCartById($cart_id);
    $item_id = $cart[0]['item_id'];

    $im = new ItemModel();
    $item = $im->getItemById($item_id);
    $stocks = $item[0]['stocks'];

    $newQuantity = 0;

    if ($quantity <= 0) $newQuantity = 1;
    else if ($quantity <= $stocks) $newQuantity = $quantity;
    else $newQuantity = $stocks;

    if ($cm->updateCart($newQuantity, $currentDate, $cart_id, $user_id)) {
        echo 'ok';
        exit();
    }
    echo 'failed';


    /*
    $quantity = mysqli_escape_string($conn, $_POST['value']);
    $cart_id = mysqli_escape_string($conn, $_POST['cart_id']);
    $user_id = mysqli_escape_string($conn, $_SESSION['userId']);
    $item_id = '';
    $stocks = 0;
    $currentDate = date("Y-m-d H:i:s");

    //GET THE ITEM ID IN THE CART
    $cart_sql = "SELECT * FROM cart WHERE id = '$cart_id'";
    $cart_response = mysqli_query($conn, $cart_sql);
    if (mysqli_num_rows($cart_response) > 0) {
        while ($cart_rows = mysqli_fetch_assoc($cart_response)) {
            $item_id = $cart_rows['item_id'];

            //GET THE ITEM STOCKS
            $item_sql = "SELECT * FROM items WHERE id = '$item_id'";
            $item_response = mysqli_query($conn, $item_sql);
            if (mysqli_num_rows($item_response) > 0) {
                while ($item_rows = mysqli_fetch_assoc($item_response)) {
                    $stocks = $item_rows['stocks'];
                }
            }

            $newQuantity = 0;

            if ($quantity <= 0) {
                $newQuantity = 1;
            } else if ($quantity <= $stocks) {
                $newQuantity = $quantity;
            } else {
                $newQuantity = $stocks;
            }

            $sql = "UPDATE cart SET quantity = '$newQuantity', date_updated = '$currentDate' WHERE id = '$cart_id' and user_id = '$user_id'";
            if (mysqli_query($conn, $sql)) {
                echo "ok";
            } else {
                echo 'failed';
            }
        }
    } else {
        echo 'failed';
    }
    */
}
//RESPONSE FOR CHECK OUT
if (isset($_POST['requestType']) && $_POST['requestType'] == "cart_checkout") {

    $cartItems = $_POST['cartItems'];
    $items = count($cartItems);
    $user_id = $_SESSION['userId'];
    $currentDate = date("Y-m-d H:i:s");
    $status = 'checking';
    $can_rate = 'no';

    $am = new AddressModel();
    $om = new OrderModel();
    $cm = new CartModel();

    if ($items > 0 && $am->isAddressValid($user_id)) {

        $order_id = $om->setOrder($user_id, $items, $status, $currentDate);
        if ($order_id == false) {
            echo 'failed1';
            exit();
        }

        foreach ($cartItems as $item) {
            $cart = $cm->getUserCartByUC($user_id, $item);
            if (count($cart) > 0) {
                $item_id = $cart[0]['item_id'];
                $quantity = $cart[0]['quantity'];

                if (!$om->setOrderItems($order_id, $item_id, $quantity, $can_rate)) {
                    echo 'failed2';
                    exit();
                }
                if (!$cm->deleteCart($item, $user_id)) {
                    echo 'failed3';
                    exit();
                }
            } else {
                echo 'failed4';
                exit();
            }
        }
        echo 'ok';
        exit();
    }
    echo 'invalid_address';

    /*
    $cartItems = $_POST['cartItems'];
    $items = count($cartItems);
    $user_id = mysqli_escape_string($conn, $_SESSION['userId']);
    $currentDate = date("Y-m-d H:i:s");
    if ($items >  0 && checkUserAddress($conn, $user_id)) {

        $order_sql = "INSERT INTO orders(user_id, items, status, date_created) 
        VALUES ('$user_id', '$items','checking', '$currentDate')";
        mysqli_query($conn, $order_sql);
        $order_id = mysqli_insert_id($conn);

        foreach ($cartItems as $item) {
            $cartItem  = mysqli_escape_string($conn, $item);
            $sql = "SELECT * FROM CART where id = '$cartItem' and user_id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                    $item_id = $rows['item_id'];
                    $quantity = $rows['quantity'];

                    $sql = "INSERT INTO order_item(order_id, item_id, quantity) 
                    VALUES ('$order_id','$item_id','$quantity')";
                    mysqli_query($conn, $sql);

                    $cart_delete_sql = "DELETE FROM cart WHERE id = '$cartItem' and user_id = '$user_id'";
                    mysqli_query($conn, $cart_delete_sql);
                }
            } else {
                echo 'failed';
            }
        }
        echo 'ok';
    } else {
        echo 'invalid_address';
    }
    */
}
//RESPONSE FOR REMOVE ITEMS ON CART
if (isset($_POST['requestType']) && $_POST['requestType'] == "cart_remove") {
    $cartItems = $_POST['cartItems'];
    $user_id = $_SESSION['userId'];
    $cm = new CartModel();
    if (count($cartItems) > 0) {
        foreach ($cartItems as $item) {
            $cm->deleteCart($item, $user_id);
        }
        echo 'ok';
        exit();
    }
    echo 'failed';

    /*
    $cartItems = $_POST['cartItems'];
    $user_id = mysqli_escape_string($conn, $_SESSION['userId']);

    if (count($cartItems) > 0) {
        foreach ($cartItems as $item) {
            $cartItem = mysqli_escape_string($conn, $item);
            $cart_delete_sql = "DELETE FROM cart WHERE id = '$cartItem' and user_id = '$user_id'";
            mysqli_query($conn, $cart_delete_sql);
        }
        echo 'ok';
    } else {
        echo 'failed';
    }
    */
}

//RESPONSE FOR GET ORDER INFO
if (isset($_POST['requestType']) && $_POST['requestType'] == "order_info") {
    $user_id = $_SESSION['userId'];
    $type = $_POST['type'];

    $orderData = array();

    $om = new OrderModel();
    $im = new ItemModel();

    $orders = $om->getUserOrders($user_id, $type);
    if (count($orders) > 0) {
        foreach ($orders as $order) {
            $order_items = array();
            $order_id = $order['id'];
            $orderItems = $om->getOrderItems($order_id);
            foreach ($orderItems as $item) {
                $item_id = $item['item_id'];
                $quantity = $item['quantity'];
                $image = $im->getItemImage($item_id, false);
                $itemData = $im->getItemById($item_id);

                $order_items[] = array(
                    "id" => $item_id,
                    "name" => $itemData[0]['name'],
                    "price" => $itemData[0]['price'],
                    "quantity" => $quantity,
                    "image" => $image
                );
            }
            $orderData[] = array(
                "id" => $order_id,
                "status" => $order['status'],
                "date" => date("F d Y", strtotime($order['date_created'])),
                "order_items" => $order_items
            );
        }
        echo json_encode($orderData);
    }

    /*

    $user_id = mysqli_escape_string($conn, $_SESSION['userId']);
    $sql = "SELECT * FROM orders WHERE user_id = '$user_id' and ";
    if ($_POST['type'] == "processing") {
        $sql .= "((status = 'checking') OR (status = 'processing'))";
    } else {
        $sql .= "(status = 'delivered')";
    }

    $result = mysqli_query($conn, $sql);
    $order = array();
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {


            $order_items = array();
            //GET ITEMS ON ORDER
            $order_id = $rows['id'];
            $order_result = mysqli_query($conn, "SELECT * FROM order_item WHERE order_id = '$order_id'");
            if (mysqli_num_rows($order_result) > 0) {
                while ($order_rows = mysqli_fetch_assoc($order_result)) {
                    //GET ITEM DATA
                    $item_id = $order_rows['item_id'];
                    $quantity = $order_rows['quantity'];
                    $item_result = mysqli_query($conn, "SELECT * FROM items WHERE id = '$item_id'");
                    if (mysqli_num_rows($item_result) > 0) {
                        while ($item_rows = mysqli_fetch_assoc($item_result)) {

                            $directory = '../../images/items/' . $item_id;
                            $files = array_diff(scandir($directory), array('..', '.'));
                            $file = array();
                            //GET THE FIRST FILE'S NAME
                            foreach ($files as $key => $value) {
                                $file = $value;
                                break;
                            }

                            $order_items[] = array(
                                "id" => $item_id,
                                "name" => $item_rows['name'],
                                "price" => $item_rows['price'],
                                "quantity" => $quantity,
                                "image" => $file
                            );
                        }
                    }
                }
            }

            $order[] = array(
                "id" => $order_id,
                "status" => $rows['status'],
                "date" => date("F d Y", strtotime($rows['date_created'])),
                "order_items" => $order_items
            );
        }
        echo json_encode($order);
    }
    */
}

//RESPONSE FOR GETTING PROFILE DATA
if (isset($_POST['requestType']) && $_POST['requestType'] == "get_profile") {

    $user_id = $_SESSION['userId'];
    $um = new UserModel();
    $am = new AddressModel();
    $om = new OrderModel();

    $userData = $um->getUserById($user_id);
    $userAddress = $am->getAddressById($user_id);
    $userOrders = $om->getOrderCount($user_id);
    $cityList = $am->getCityList();
    $provinceList = $am->getProvinceList();

    $user_info = array(
        "id" => $user_id,
        "name" => $userData[0]['firstname'] . " " .  $userData[0]['lastname'],
        "email" => $userData[0]['email'],
        "phone" => $userData[0]['phone'],
        "image" => $um->getUserImage($user_id)
    );

    $user_address = array(
        "house" => $userAddress[0]['house_number'],
        "street" => $userAddress[0]['barangay'],
        "city" => $userAddress[0]['city'],
        "province" => $userAddress[0]['province'],
    );
    $address_option = array(
        "city_list" => $cityList,
        "province_list" => $provinceList
    );

    $response_data = array(
        "user_info" => $user_info,
        "user_address" => $user_address,
        "user_orders" => $userOrders,
        "address_option" => $address_option
    );

    echo json_encode($response_data);

    /*
    $user_id = mysqli_escape_string($conn, $_SESSION['userId']);
    $user_manager = new User_manager();
    $user_manager->fetch_user($conn, $user_id);
    $user_manager->fetch_address($conn);
    $user_manager->fetch_orders($conn);

    $city = array();
    $province = array();

    $result = mysqli_query($conn, "SELECT * FROM city_list");
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $city[] = $rows['city'];
        }
    }

    $result = mysqli_query($conn, "SELECT * FROM province_list");
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $province[] = $rows['province'];
        }
    }

    $user_info = array(
        "id" => $user_id,
        "name" => $user_manager->first_name . " " . $user_manager->last_name,
        "email" => $user_manager->email,
        "phone" => $user_manager->phone,
        "image" => $user_manager->image
    );

    $user_address = array(
        "house" => $user_manager->house,
        "street" => $user_manager->street,
        "city" => $user_manager->city,
        "province" => $user_manager->province
    );

    $user_orders = array(
        "orders" => $user_manager->orders,
        "cancelled" => $user_manager->cancelled,
        "delivered" => $user_manager->delivered,
        "processing" => $user_manager->processing
    );

    $address_option = array(
        "city_list" => $city,
        "province_list" => $province
    );

    $response_data = array(
        "user_info" => $user_info,
        "user_address" => $user_address,
        "user_orders" => $user_orders,
        "address_option" => $address_option
    );

    echo json_encode($response_data);

    */
}

//RESPONSE FOR UPDATE PROFILE
if (isset($_POST['requestType']) && $_POST['requestType'] == "update_profile") {


    $number = $_POST['number'];
    $street = $_POST['street'];
    $user_id = $_SESSION['userId'];
    $city = $_POST['city'];
    $province =  $_POST['province'];

    $am = new AddressModel();
    if(!$am->isCityExists($city)) $city = '';
    if(!$am->isProvinceExists($province)) $province = '';
    
    $am->updateAddress($user_id, $number, $street, $city, $province);
    update_image($user_id);
    /*
    $number = mysqli_escape_string($conn, $_POST['number']);
    $street = mysqli_escape_string($conn, $_POST['street']);
    $user_id = mysqli_escape_string($conn, $_SESSION['userId']);
    $city = '';
    $province = '';

    if (isset($_POST['city'])) {
        $city = mysqli_escape_string($conn, $_POST['city']);
        if (!isCityExists($conn, $city)) {
            $city = '';
        }
    }
    if (isset($_POST['province'])) {
        $province = mysqli_escape_string($conn, $_POST['province']);
        if (!isProvinceExists($conn, $province)) {
            $province = '';
        }
    }

    $user_manager = new User_manager();
    $user_manager->fetch_user($conn, $user_id);
    $user_manager->fetch_address($conn);

    $user_manager->house = $number;
    $user_manager->street = $street;
    $user_manager->city = $city;
    $user_manager->province = $province;

    $result = mysqli_query($conn, "SELECT * FROM user_address where user_id = '$user_id'");

    if (mysqli_num_rows($result) > 0) {
        $user_manager->update_address($conn);
    } else {
        $user_manager->insert_address($conn);
    }

    $user_manager->update_user($conn);
    */
}

//RESPONSE FOR RATE ITEM
if (isset($_POST['requestType']) && $_POST['requestType'] == "rate-item") {
    $star = $_POST['star'];
    $comment = $_POST['comment'];
    $item_id = $_POST['itemId'];
    $user_id = $_SESSION['userId'];
    $rateLimit = 0;

    $im = new ItemModel();
    $om = new OrderModel();

    $canRate = $im->canRate($item_id, $user_id);

    if($canRate == "no"){
        echo 'failed';
        exit();
    }

    if(!$im->setRate($item_id, $comment, $star, $user_id)){
        echo 'failed';
        exit();
    }

    if(!$om->updateOrderItem($canRate, 'no')){
        echo 'failed';
        exit();
    }

    echo 'ok';



    /*
    $star = mysqli_escape_string($conn, $_POST['star']);
    $comment = mysqli_escape_string($conn, $_POST['comment']);
    $item_id = mysqli_escape_string($conn, $_POST['itemId']);
    $user_id = mysqli_escape_string($conn, $_SESSION['userId']);
    $rateLimit = 0;

    //CHECK IF CAN RATE 
    $sql = "SELECT * FROM orders WHERE user_id = '$user_id' AND status = 'delivered'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {

            $order_id = $rows['id'];
            $sql_rate = "SELECT * FROM order_item WHERE order_id = '$order_id' AND item_id = '$item_id' AND can_rate = 'yes'";
            $result_rate = mysqli_query($conn, $sql_rate);
            if (mysqli_num_rows($result_rate) > 0) {
                $rows_rate = mysqli_fetch_assoc($result_rate);
                $order_item_id = $rows_rate['id'];

                if ($rateLimit >= 1) {
                    break;
                }

                $sql = "INSERT rating(item_id, message, score, user_id)
                VALUES('$item_id', '$comment', '$star', '$user_id')";
                if (mysqli_query($conn, $sql)) {
                    echo 'ok';
                    $sql = "UPDATE order_item SET can_rate = 'no' WHERE id = '$order_item_id' AND order_id = '$order_id'";
                    mysqli_query($conn, $sql);
                    $rateLimit++;
                } else {
                    echo 'failed';
                }
            }
        }
    }
    */
}
