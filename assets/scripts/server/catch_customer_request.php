<?php
include './database.php';

session_start();

//REGISTRATION VALIDATIONS

//EMAIL REG-VALIDATION CHECK IF EXISTS
if (isset($_POST['requestType']) && $_POST['requestType'] == "v-reg-email") {
    $email = mysqli_escape_string($conn, $_POST['email']);

    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "used";
    } else {
        echo 'ok';
    }
}

//PHONE REG-VALIDATION CHECK IF EXISTS
if (isset($_POST['requestType']) && $_POST['requestType'] == "v-reg-phone") {
    $phone = mysqli_escape_string($conn, $_POST['phone']);
    $tenDigitPhone = substr($phone, -10);
    $withZeroDigitPhone = '0' . $tenDigitPhone;
    $withPlusDigitPhone =  '+63' . $tenDigitPhone;

    $sql = "SELECT * FROM user WHERE phone = '$tenDigitPhone' OR phone = '$withZeroDigitPhone' OR phone = '$withPlusDigitPhone'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        echo 'used';
    } else {
        echo 'ok';
    }
}

//FINAL REG-VALIDATION
if (isset($_POST['requestType']) && $_POST['requestType'] == "v-reg-final") {

    $firstname = mysqli_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_escape_string($conn, $_POST['lastname']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $phone = mysqli_escape_string($conn, $_POST['phone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

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

                $sql = "INSERT INTO user (firstname, lastname, email, phone, password, verified, type) VALUES('$firstname', '$lastname', '$email', '$phone', '$password', 'no', 'customer')";

                if (mysqli_query($conn, $sql)) {
                    $sql = "SELECT * FROM user WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {
                            $user_id = $row['id'];
                            $code = password_hash(randomString(), PASSWORD_DEFAULT);
                            $sql = "INSERT INTO verify (code, user_id) VALUES('$code', '$user_id')";

                            if (mysqli_query($conn, $sql)) {
                                sendEmail($email, $code);
                                echo 'ok';
                            } else {
                                echoError('0ca6');
                            }
                        }
                    } else {
                        echoError('0ca5');
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
}


//LOGIN VALIDATIONS

//EMAIL LOG-VALIDATION
if (isset($_POST['requestType']) && $_POST['requestType'] == "v-log-email") {
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
}
//FINAL LOG-VALIDATION
if (isset($_POST['requestType']) && $_POST['requestType'] == "v-log-final") {
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
                $verified = $row['verified'];
                if ($verified == 'yes') {
                    if (password_verify($password, $checkPassword)) {

                        $_SESSION["userId"] = $userid;  
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
}

//EMAIL VERIFICATION
if (isset($_POST['requestType']) && $_POST['requestType'] == "verify-email") {

    $code = mysqli_escape_string($conn, $_POST['code']);
    $sql = "SELECT * FROM verify WHERE code = '$code'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $sql = "SELECT * FROM user WHERE id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['verified'] == 'yes') {
                        echo 'error';
                    } else {
                        $sql = "UPDATE user SET verified = 'yes' WHERE id = '$user_id'";
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
}

//RESPONSE FOR SINGLE ITEM INFO REQUEST
if (isset($_POST['requestType']) && $_POST['requestType'] == "load-item") {
    $id = mysqli_escape_string($conn, $_POST['id']);
    $sql = "SELECT * FROM items WHERE id = '$id'";

    $item = getItemData($sql, $conn, true);
    echo json_encode($item);
}
//RESPONSE FOR MULTIPLE ITEM INFO REQUEST
if (isset($_POST['requestType']) && $_POST['requestType'] == "load-items") {
    $sql = "SELECT * FROM items";

    if (isset($_POST['page'])) {
        $page = mysqli_escape_string($conn, $_POST['page']);
        $offset = $page * 8 - 8;
        $sql .= " LIMIT 8 OFFSET $offset";
    }

    $items = getItemData($sql, $conn, false);
    echo json_encode($items);
}

//RESPONSE FOR ADD TO CART
if (isset($_POST['requestType']) && $_POST['requestType'] == "cart_add") {
    if (isset($_SESSION['userId'])) {
        $item_id = mysqli_escape_string($conn, $_POST['id']);
        $quantity = mysqli_escape_string($conn, $_POST['quantity']);
        $user_id = mysqli_escape_string($conn, $_SESSION['userId']);
        $stocks = 0;

        //GET THE ITEM STOCKS
        $item_sql = "SELECT * FROM items WHERE id = '$item_id'";
        $item_response = mysqli_query($conn, $item_sql);
        if(mysqli_num_rows($item_response) > 0){
            while($item_rows = mysqli_fetch_assoc($item_response)){
                $stocks = $item_rows['stocks'];
            }
        }

        $check_sql = "SELECT * FROM cart where user_id = '$user_id' and item_id = '$item_id'";
        $check_result = mysqli_query($conn, $check_sql);
        if(mysqli_num_rows($check_result) > 0){
            echo "already";
        } else {
            $newQuantity = 0;

            if($quantity <= 0){
                $newQuantity = 1;
            } else if($quantity <= $stocks){
                $newQuantity = $quantity;
            } else {
                $newQuantity = $stocks;
            }

            $sql = "INSERT INTO cart(item_id, user_id, quantity) VALUES ('$item_id','$user_id','$newQuantity')";
            if (mysqli_query($conn, $sql)) {
                echo "success";
            } else {
                echo "error";
            }
        }

    } else {
        echo "login_required";
    }
}

//RESPONSE FOR GET CART INFO
if (isset($_POST['requestType']) && $_POST['requestType'] == "cart_info") {
    $user_id = mysqli_escape_string($conn, $_SESSION['userId']);
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
            if (mysqli_num_rows($result_new) > 0){
                while($rows_new = mysqli_fetch_assoc($result_new)){
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
    
}

//RESPONSE FOR CART CHANGING QUANTITY
if (isset($_POST['requestType']) && $_POST['requestType'] == "cart_update") {
    $quantity = mysqli_escape_string($conn, $_POST['value']);
    $cart_id = mysqli_escape_string($conn, $_POST['cart_id']);
    $user_id = mysqli_escape_string($conn, $_SESSION['userId']);
    $item_id = '';
    $stocks = 0;

    //GET THE ITEM ID IN THE CART
    $cart_sql = "SELECT * FROM cart WHERE id = '$cart_id'";
    $cart_response = mysqli_query($conn, $cart_sql);
    if(mysqli_num_rows($cart_response) > 0){
        while($cart_rows = mysqli_fetch_assoc($cart_response)){
            $item_id = $cart_rows['item_id'];
            
            //GET THE ITEM STOCKS
            $item_sql = "SELECT * FROM items WHERE id = '$item_id'";
            $item_response = mysqli_query($conn, $item_sql);
            if(mysqli_num_rows($item_response) > 0){
                while($item_rows = mysqli_fetch_assoc($item_response)){
                    $stocks = $item_rows['stocks'];
                }
            }

            $newQuantity = 0;

            if($quantity <= 0){
                $newQuantity = 1;
            } else if($quantity <= $stocks){
                $newQuantity = $quantity;
            } else {
                $newQuantity = $stocks;
            }

            $sql = "UPDATE cart SET quantity = '$newQuantity' WHERE id = '$cart_id' and user_id = '$user_id'";
            if(mysqli_query($conn, $sql)){
                echo "ok";
            } else {
                echo 'failed';
            }

        }
    } else {
        echo 'failed';
    }
}
//RESPONSE FOR CHECK OUT
if (isset($_POST['requestType']) && $_POST['requestType'] == "cart_checkout") {
    $cartItems = $_POST['cartItems'];
    $user_id = mysqli_escape_string($conn, $_SESSION['userId']);

    if(count($cartItems) > 0 ){
        foreach($cartItems as $item){
            $cartItem = mysqli_escape_string($conn, $item);
            $sql = "SELECT * FROM CART where id = '$cartItem' and user_id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($rows = mysqli_fetch_assoc($result)){
                    $item_id = $rows['item_id'];
                    $quantity = $rows['quantity'];
    
                    $order_sql = "INSERT INTO orders(user_id, item_id, quantity, status) 
                    VALUES ('$user_id','$item_id','$quantity','checking')";
                    mysqli_query($conn, $order_sql);
    
                    $cart_delete_sql = "DELETE FROM cart WHERE id = '$cartItem' and user_id = '$user_id'";
                    mysqli_query($conn, $cart_delete_sql);
                }
            } else {
                echo 'failed';
            }
        }
        echo 'ok';
    } else {
        echo 'failed';
    }
}
//RESPONSE FOR REMOVE ITEMS ON CART
if (isset($_POST['requestType']) && $_POST['requestType'] == "cart_remove") {
    $cartItems = $_POST['cartItems'];
    $user_id = mysqli_escape_string($conn, $_SESSION['userId']);

    if(count($cartItems) > 0 ){
        foreach($cartItems as $item){
            $cartItem = mysqli_escape_string($conn, $item);
            $cart_delete_sql = "DELETE FROM cart WHERE id = '$cartItem' and user_id = '$user_id'";
            mysqli_query($conn, $cart_delete_sql);
        }
        echo 'ok';
    } else {
        echo 'failed';
    }
}

//RESPONSE FOR GET ORDER INFO
if (isset($_POST['requestType']) && $_POST['requestType'] == "order_info") {
    $user_id = mysqli_escape_string($conn, $_SESSION['userId']);
    $sql = "SELECT * FROM orders WHERE (user_id = '$user_id' and status = 'checking') OR (status = 'processing')";
    $result = mysqli_query($conn, $sql);
    $orderItems = array();
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $item_id = $rows['item_id'];
            $qty = $rows['quantity'];
            $order_id = $rows['id'];
            $status = $rows['status'];

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
            if (mysqli_num_rows($result_new) > 0){
                while($rows_new = mysqli_fetch_assoc($result_new)){
                    $orderItems[] = array(
                        "id" => $item_id,
                        "order_id" => $order_id,
                        "name" => $rows_new['name'],
                        "price" => $rows_new['price'],
                        "quantity" => $qty,
                        "status" => $status,
                        "images" => $file
                    );
                }
            }
        }
        echo json_encode($orderItems);
    }
    
}

//RESPONSE FOR GET ORDER DELIVERED INFO
if (isset($_POST['requestType']) && $_POST['requestType'] == "order_delivered_info") {
    $user_id = mysqli_escape_string($conn, $_SESSION['userId']);
    $sql = "SELECT * FROM orders WHERE user_id = '$user_id' and status = 'delivered'";
    $result = mysqli_query($conn, $sql);
    $orderItems = array();
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $item_id = $rows['item_id'];
            $qty = $rows['quantity'];
            $order_id = $rows['id'];
            $status = $rows['status'];

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
            if (mysqli_num_rows($result_new) > 0){
                while($rows_new = mysqli_fetch_assoc($result_new)){
                    $orderItems[] = array(
                        "id" => $item_id,
                        "order_id" => $order_id,
                        "name" => $rows_new['name'],
                        "price" => $rows_new['price'],
                        "quantity" => $qty,
                        "status" => $status,
                        "images" => $file
                    );
                }
            }
        }
        echo json_encode($orderItems);
    }
    
}

//FUNCTION TO GET ITEMS WITH SINGLE OR MULTIPLE IMAGE
function getItemData($sql, $conn, $multiple)
{
    $result = mysqli_query($conn, $sql);
    $itemInfo = array();

    if (mysqli_num_rows($result) > 0) {
        //GET ALL ITEMS DATA FROM DATABASE
        while ($rows = mysqli_fetch_assoc($result)) {
            $id = $rows['id'];
            $name = $rows['name'];
            $category = $rows['category'];
            $stocks = $rows['stocks'];
            $price = $rows['price'];
            $sold = $rows['sold'];
            $description = $rows['description'];

            //GET THE ID AND SET AS DIRECTORY
            $directory = '../../images/items/' . $id;
            //SCAN THE FILES INSIDE THE DIRECTORY
            $files = array_diff(scandir($directory), array('..', '.'));
            $file = array();
            //GET THE FIRST FILE'S NAME
            foreach ($files as $key => $value) {
                $file[] = $value;
                if (!$multiple) break;
            }
            //ADD THE DATA AS JSON FORMAT IN ARRAY
            $itemInfo[] = array(
                "id" => $id,
                "name" => $name,
                "category" => $category,
                "stocks" => $stocks,
                "price" => $price,
                "sold" => $sold,
                "description" => $description,
                "images" => $file
            );
        }
        return $itemInfo;
    }
}

//ECHO ERROR MESSAGE
function echoError($level)
{
    echo 'Error occurred, Please reload the page! code : ' . $level;
}
//GET RANDOM STRING FOR VERIFICATION CODE
function randomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
//SEND EMAIL VERIFICATION
function sendEmail($email, $code)
{
    $to = $email;
    $subject = "Gold Place PH - Verification";

    $message = "
    <!DOCTYPE html>

    <html lang='en'>

    <head>
        <title>Gold Place PH - Verification</title>
        <style>
            .main{
                width: 500px;
                height: 250px;
                font-family: Arial, Helvetica, sans-serif;
            }
            .header{
                width: 100%;
                height: 50px;
                background-color: #ffc107;
                border-radius: 40px 40px 0 0;
            }
            .body{
                width: 100%;
                height: 150px;
                display: flex;
                flex-direction: column;
                padding-top: 20px;
                align-items: center;
                background-color: white;
            }
            .body p{
                margin: 0;
            }
            .footer{
                width: 100%;
                height: 50px;
                background-color: #212529;
                border-radius: 0 0 40px 40px;
            }
            a{
                padding: 15px;
                text-decoration: none;
                color: #212529;
                background-color: #ffc107;
                border-radius: 10px;
            }
        </style>
    </head>
    <body>
        <div class='main'>
            <div class='header'></div>
            <div class='body'>
                <p>GOLD PLACE PH</p>
                <h2>Click to verify</h2>
                <a href='http://localhost/gold-place-ph/login.php?verify=" . $code . "' target='_blank'>VERIFY NOW</a>
            </div>
            <div class='footer'></div>
        </div>
    </body>
    </html>
    ";
    //CONTENT TYPE
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    //HEADERS
    $headers .= 'From: <admin@goldplaceph.com>' . "\r\n";

    mail($to, $subject, $message, $headers);
}
