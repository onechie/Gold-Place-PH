<?php
include './database.php';
include './User_manager.php';
date_default_timezone_set("Asia/Manila");

//ADD ITEM REQUEST
if (isset($_POST['requestType']) && $_POST['requestType'] == "add-item") {
    
    $name = mysqli_escape_string($conn, $_POST['name']);
    $category = mysqli_escape_string($conn, $_POST['category']);
    $price = (int)mysqli_escape_string($conn, $_POST['price']);
    $stocks = (int)mysqli_escape_string($conn, $_POST['stocks']);
    $description = mysqli_escape_string($conn, $_POST['description']);

    $readyToProcess = true;

    //VALIDATE IF THERE IS EMPTY VALUE
    if (empty($name)) $readyToProcess = false;
    if (empty($category)) $readyToProcess = false;
    if ($price <= 0) $readyToProcess = false;
    if ($stocks <= 0) $readyToProcess = false;
    if (empty($description)) $readyToProcess = false;

    //SET DIRECTORY NAME
    $mainDirectory = "../../images/items/";
    $directory = "";

    //CHECK IF THE FILE LIST IS EMPTY
    if ($_FILES["images"]["tmp_name"][0] == null && $readyToProcess) {
        echo 'noImage';
    } else {
        //RUN THE ADD ITEM FUNCTION TO ADD THE DATA INTO DATABASE AND CHECK IF SUCCESS
        if (addItem($conn, $readyToProcess, $name, $category, $price, $stocks, $description)) {
            //GET THE LAST ITEM IN THE DATABASE AND GET THE ID
            $sql = "SELECT * FROM items ORDER BY id DESC LIMIT 1";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                    //GET THE ID
                    $id = $rows['id'];
                    //MAKE THE ID AS A DIRECTORY NAME
                    $directory = $mainDirectory . $id . '/';
                }
            }

            if (editImage($directory, $mainDirectory)) {
                echo "addSuccess";
            }
        } else {
            echo "addFailed";
        }
    }
}

//EDIT ITEM REQUEST
if (isset($_POST['requestType']) && $_POST['requestType'] == "edit-item") {
    $id = mysqli_escape_string($conn, $_POST['id']);
    $name = mysqli_escape_string($conn, $_POST['name']);
    $category = mysqli_escape_string($conn, $_POST['category']);
    $price = (int)mysqli_escape_string($conn, $_POST['price']);
    $stocks = (int)mysqli_escape_string($conn, $_POST['stocks']);
    $description = mysqli_escape_string($conn, $_POST['description']);

    $readyToProcess = true;

    if (empty($name)) $readyToProcess = false;
    if (empty($category)) $readyToProcess = false;
    if ($price <= 0) $readyToProcess = false;
    if ($stocks <= 0) $readyToProcess = false;
    if (empty($description)) $readyToProcess = false;

    //IF NO FILE INSERTED JUST EDIT THE DATA EXCEPT FOR PHOTOS
    if ($_FILES["images"]["tmp_name"][0] == null) {
        if (editItem($conn, $readyToProcess, $id, $name, $category, $price, $stocks, $description)) {
            echo 'editSuccess';
        } else {
            echo 'editFailed';
        }
    } else {

        if (editItem($conn, $readyToProcess, $id, $name, $category, $price, $stocks, $description)) {

            //SET DIRECTORY NAME
            $main_dir = "../../images/items/";
            $target_dir = $main_dir . $id . '/';

            //GET EACH FILE NAME IN THE TARGET DIRECTORY
            $files = glob($target_dir . '/*');


            //LOOP THE FILE LIST
            foreach ($files as $file) {
                //CHECK IF TRUE FILE
                if (is_file($file)) {
                    //DELETE THE FILE
                    unlink($file);
                }
            }

            if (editImage($target_dir, $main_dir)) {
                echo 'editSuccess';
            }
        } else {
            echo 'editFailed';
        }
    }
}

//DELETE ITEM REQUEST
if (isset($_POST['requestType']) && $_POST['requestType'] == "delete-item") {
    $id =  mysqli_escape_string($conn, $_POST['id']);
    $sql = "DELETE FROM items WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        //SET DIRECTORY NAME
        $main_dir = "../../images/items/";
        $target_dir = $main_dir . $id . '/';

        //GET EACH FILE NAME IN THE TARGET DIRECTORY
        $files = glob($target_dir . '/*');

        //LOOP THE FILE LIST
        foreach ($files as $file) {
            //CHECK IF TRUE FILE
            if (is_file($file)) {
                //DELETE THE FILE
                unlink($file);
            }
        }
        echo 'deleteSuccess';
    } else {
        echo 'deleteFailed';
    }
}

//RESPONSE FOR GETTING ALL TOTAL DATA
if (isset($_POST['requestType']) && $_POST['requestType'] == "all-total-data") {
    $totalSales = countSales($conn);
    $totalOrders = countOrders($conn);
    $totalStocks = countStocks($conn);
    $totalUsers = countUsers($conn);

    $totals = array(
        "sales" => $totalSales,
        "orders" => $totalOrders,
        "stocks" => $totalStocks,
        "users" => $totalUsers
    );

    echo json_encode($totals);

}
//RESPONSE FOR SALES CHART DATA
if (isset($_POST['requestType']) && $_POST['requestType'] == "line-chart-data") {
    $orders = array();
    $limitText =  mysqli_escape_string($conn, $_POST['limit']);
    $min = date("Y-m-d H:i:s");
    $max = date("Y-m-d H:i:s");
    $temp = 0;
    $label = "";

    for ($i = 0; $i < 7; $i++) {

        if ($limitText == "daily") {
            $temp = strtotime("-1 day", strtotime($min));
            $label = date("D", strtotime($min));
        } else if ($limitText == "weekly") {
            $temp = strtotime("-1 week", strtotime($min));
            $label = date("W", strtotime($min));
        } else if ($limitText == "monthly") {
            $temp = strtotime("-1 month", strtotime($min));
            $label = date("W", strtotime($min));
        } else {
            $temp = strtotime("-1 year", strtotime($min));
            $label = date("Y", strtotime($min));
        }

        $min = date("Y-m-d H:i:s", $temp);
        $sql = "SELECT * FROM orders WHERE date_updated > '$min' AND date_updated < '$max'";

        $delivered = 0;

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
                if ($rows['status'] == "delivered") {
                    $delivered++;
                }
            }
        }

        $orders[] = array(
            "delivered" => $delivered,
            "label" => $label,
            "date" => $min . " - " . $max,
        );
        $max = $min;
    }

    echo json_encode($orders);
}

//RESPONSE FOR ORDERS CHART DATA
if (isset($_POST['requestType']) && $_POST['requestType'] == "order-chart-data") {


    $orders = array();
    $limitText =  mysqli_escape_string($conn, $_POST['limit']);
    $min = date("Y-m-d H:i:s");
    $max = date("Y-m-d H:i:s");
    $temp = 0;
    $sql = "SELECT * FROM orders";

    for ($i = 0; $i < 2; $i++) {

        if ($limitText == "daily") {
            $temp = strtotime("-1 day", strtotime($min));
        } else if ($limitText == "weekly") {
            $temp = strtotime("-1 week", strtotime($min));
        } else if ($limitText == "monthly") {
            $temp = strtotime("-1 month", strtotime($min));
        } else {
            $temp = strtotime("-1 year", strtotime($min));
        }

        $min = date("Y-m-d H:i:s", $temp);

        $new = 0;
        $checking = 0;
        $processing = 0;
        $cancelled = 0;
        $delivered = 0;

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
                if ($rows['status'] == "delivered") {
                    if($rows['date_updated'] > $min && $rows['date_updated'] < $max){
                        $delivered++;
                    }
                } else if ($rows['status'] == "cancelled") {
                    if($rows['date_updated'] > $min && $rows['date_updated'] < $max){
                        $cancelled++;
                    }
                } else if ($rows['status'] == "processing") {
                    $processing++;
                } else {
                    $checking++;
                }
                if($rows['date_created'] > $min && $rows['date_created'] < $max){
                    $new++;
                }
            }
        }

        $orders[] = array(
            "checking" => $checking,
            "processing" => $processing,
            "cancelled" => $cancelled,
            "delivered" => $delivered,
            "new" => $new,

        );
        $max = $min;
    }

    echo json_encode($orders);
};

//RESPONSE FOR RECENT ORDERS DATA
if (isset($_POST['requestType']) && $_POST['requestType'] == "get-recent-orders") {
    $recent_orders = array();
    $user_manager = new User_manager();

    $sql = "SELECT * FROM orders ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {

            $order_id = $rows['id'];
            $user_manager->fetch_user($conn, $rows['user_id']);

            $item_id = $rows['item_id'];
            $item_data = getItemInfo($conn, $item_id);

            $quantity = $rows['quantity'];
            $status = $rows['status'];

            $recent_orders[] = array(
                "order_id" => $order_id,
                "user_id" => $user_manager->id,
                "user_name" => $user_manager->first_name . " " . $user_manager->last_name,
                "user_email" => $user_manager->email,
                "user_image" => $user_manager->image,
                "item_id" => $item_id,
                "order_quantity" => $quantity,
                "item_price" => $item_data['price'],
                "order_status" => $status
            );
        }
    }

    echo json_encode($recent_orders);
}

//RESPONSE FOR SINGLE ITEM INFO REQUEST
if(isset($_POST['requestType']) && $_POST['requestType'] == "load-item") {
    $id =  mysqli_escape_string($conn, $_POST['id']);
    $sql = "SELECT * FROM items WHERE id = '$id'";

    $item = getItemData($sql, $conn, true);
    echo json_encode($item);
}
//RESPONSE FOR MULTIPLE ITEM INFO REQUEST
if(isset($_POST['requestType']) && $_POST['requestType'] == "load-items") {
    $sql = "SELECT * FROM items";
    
    if(isset($_POST['page'])){
        $page =  mysqli_escape_string($conn, $_POST['page']);
        $offset = $page*8-8;
        $sql .= " LIMIT 8 OFFSET $offset";
    }

    $items = getItemData($sql, $conn, false);
    echo json_encode($items);

}

//RESPONSE FOR LOAD ALL USERS
if (isset($_POST['requestType']) && $_POST['requestType'] == "load-users") {
    $user_manager = new User_manager();
    $user_manager->fetch_users($conn);
    echo json_encode($user_manager->user_list);
}

//RESPONSE FOR LOAD SINGLE USER DATA
if (isset($_POST['requestType']) && $_POST['requestType'] == "view-users") {
    $id =  mysqli_escape_string($conn, $_POST['id']);
    $user_manager = new User_manager();
    $user_manager->fetch_user($conn, $id);
    $user_manager->fetch_orders($conn);

    $user_info = array(
        "id" => $id,
        "name" => $user_manager->first_name. " ". $user_manager->last_name,
        "email" => $user_manager->email,
        "phone" => $user_manager->phone,
        "image" => $user_manager->image
    );

    $user_orders = array(
        "orders" => $user_manager->orders,
        "cancelled" => $user_manager->cancelled,
        "delivered" => $user_manager->delivered,
        "processing" => $user_manager->processing
    );

    $response_data = array(
        "user_info" => $user_info,
        "user_orders" => $user_orders,
    );

    echo json_encode($response_data);
}

function countSales($conn)
{
    
    $sales = 0;
    $result = mysqli_query($conn, "SELECT * FROM orders WHERE status = 'delivered'");
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $sales++;
        }
    }
    return $sales;
}
function countOrders($conn)
{
    
    $orders = 0;
    $result = mysqli_query($conn, "SELECT * FROM orders");
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $orders++;
        }
    }
    return $orders;
}

function countStocks($conn)
{
    $stocks = 0;
    $result = mysqli_query($conn,"SELECT * FROM items");
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $stocks += $rows['stocks'];
        }
    }
    return $stocks;
}

function countUsers($conn)
{
    $users = 0;
    $result = mysqli_query($conn,"SELECT * FROM user");
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $users++;
        }
    }
    return $users;
}

function getItemInfo($conn, $id)
{
    $itemInfo = array();
    $sql = "SELECT * FROM items WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $itemInfo = array(
                "name" => $rows['name'],
                "category" => $rows['category'],
                "price" => $rows['price'],
                "stocks" => $rows['price'],
                "sold" => $rows['sold']
            );
        }
    }
    return $itemInfo;
}
function addItem($conn, $readyToProcess, $name, $category, $price, $stocks, $description)
{
    if ($readyToProcess) {
        $sql = "INSERT INTO items(name, stocks, price, sold, category, description) 
        VALUES('$name','$stocks','$price', 0, '$category', '$description')";

        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
}
function editItem($conn, $readyToProcess, $id, $name, $category, $price, $stocks, $description)
{
    if ($readyToProcess) {
        $sql = "UPDATE items SET 
        name = '$name', 
        category = '$category',
        price = '$price',
        stocks = '$stocks',
        description = '$description'
        WHERE id = '$id'";

        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
}
function editImage($directory, $mainDirectory)
{

    $len = count($_FILES['images']['name']);

    // CREATE MAIN DIRECTORY IF ITS NOT EXISTED
    if (!is_dir($mainDirectory)) {
        mkdir($mainDirectory);
    }

    if (!is_dir($directory)) {
        mkdir($directory);
    }

    for ($i = 0; $i < $len; $i++) {

        $target_file = $directory . basename($_FILES["images"]["name"][$i]);

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //CHECK IF TRUE IMAGE USING "getimagesize"
        $check = getimagesize($_FILES["images"]["tmp_name"][$i]);

        if ($check) {
        } else {
            echo 'notImage';
            return false;
        }

        // CHECK IF FILE ALREADY EXISTS
        if (file_exists($target_file)) {
            echo "existsImage";
            return false;
        }

        // CHECK FILE SIZE
        if ($_FILES["images"]["size"][$i] > 2000000) {
            echo "largeImage";
            return false;
        }

        // CHECK FILE FORMAT
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "formatImage";
            return false;
        }
    }

    //VALIDATION PASSED NOW TRY TO INSERT INTO SERVER
    for ($i = 0; $i < $len; $i++) {

        $new_file_name = $directory . md5($_FILES["images"]["name"][$i]) . "." . strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //INSERT FILE TO SERVER
        if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $new_file_name)) {
        } else {
            echo 'failedImage';
            return false;
        }
    }

    return true;
}

//GET ITEMS WITH SINGLE OR MULTIPLE IMAGE
function getItemData($sql, $conn, $multiple){

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
                if(!$multiple)break;
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
        //ENCODE THE ARRAY TO JSON
        return $itemInfo;
    }
}