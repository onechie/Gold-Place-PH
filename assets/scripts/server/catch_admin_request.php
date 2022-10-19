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

include './file_model.php';

date_default_timezone_set("Asia/Manila");

//ADD ITEM REQUEST
if (isset($_POST['requestType']) && $_POST['requestType'] == "add-item") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stocks = $_POST['stocks'];
    $description = $_POST['description'];

    $im = new ItemModel();

    if (!checkAddItemInputs($name, $category, $price, $stocks, $description)) {
        echo 'addFailed';
        exit();
    }

    if ($_FILES["images"]["tmp_name"][0] == null) {
        echo 'noImage';
        exit();
    }

    if (!$im->setItem($name, $category, $price, $stocks, $description)) {
        echo 'addFailed';
        exit();
    }

    $lastItemId = $im->getLastItemId();

    if (editItemImage($lastItemId)) {
        echo "addSuccess";
        exit();
    }
    echo "addFailed";

    /*
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
    */
}

//EDIT ITEM REQUEST
if (isset($_POST['requestType']) && $_POST['requestType'] == "edit-item") {


    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stocks = $_POST['stocks'];
    $description = $_POST['description'];

    $im = new ItemModel();

    if (!checkAddItemInputs($name, $category, $price, $stocks, $description)) {
        echo 'editFailed';
        exit();
    }

    if ($_FILES["images"]["tmp_name"][0] == null) {
        if ($im->updateItem($name, $category, $price, $stocks, $description, $id)) {
            echo 'editSuccess';
            exit();
        }
        echo 'editFailed';
        exit();
    }

    if (!$im->updateItem($name, $category, $price, $stocks, $description, $id)) {
        echo 'editFailed';
        exit();
    }

    if (editItemImage($id)) {
        echo "editSuccess";
        exit();
    }
    echo "editFailed";

    /*

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
    */
}

//DELETE ITEM REQUEST
if (isset($_POST['requestType']) && $_POST['requestType'] == "delete-item") {

    $id = $_POST['id'];

    $im = new ItemModel();

    if (!$im->deleteItemById($id)) {
        echo 'deleteFailed';
        exit();
    }
    deleteItemImage($id);
    echo 'deleteSuccess';





    /*
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
    */
}

//RESPONSE FOR GETTING ALL TOTAL DATA
if (isset($_POST['requestType']) && $_POST['requestType'] == "all-total-data") {

    $om = new OrderModel();
    $im = new ItemModel();
    $um = new UserModel();

    $totalSales = $om->countOrderItems('delivered');
    $totalOrders = $om->countOrders();
    $totalStocks = $im->countItemStocks();
    $totalUsers = $um->countUsers();

    $totals = array(
        "sales" => $totalSales,
        "orders" => $totalOrders,
        "stocks" => $totalStocks,
        "users" => $totalUsers
    );

    echo json_encode($totals);
    /*
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
    */
}
//RESPONSE FOR SALES CHART DATA
if (isset($_POST['requestType']) && $_POST['requestType'] == "line-chart-data") {

    $limitText = $_POST['limit'];
    $min = date("Y-m-d H:i:s");
    $max = date("Y-m-d H:i:s");
    $temp = 0;
    $label = "";
    $ordersData = array();

    $om = new OrderModel();

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
        $sales = 0;

        $orders = $om->getOrdersByDate($min, $max);

        if (count($orders) > 0) {
            foreach ($orders as $order) {
                if ($order['status'] == 'delivered') {
                    $order_id = $order['id'];

                    $order_items = $om->getOrderItems($order_id);
                    foreach ($order_items as $order_item) {
                        $sales += $order_item['quantity'];
                    }
                }
            }
        }

        $ordersData[] = array(
            "sales" => $sales,
            "label" => $label,
            "date" => $min . " - " . $max,
        );
        $max = $min;
    }

    echo json_encode($ordersData);
    /*
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

        $sales = 0;

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
                if ($rows['status'] == "delivered") {
                    $order_id = $rows['id'];
                    $item_sql = "SELECT * FROM order_item WHERE order_id = '$order_id'";
                    $item_result = mysqli_query($conn, $item_sql);
                    if (mysqli_num_rows($item_result) > 0) {
                        while ($item_rows = mysqli_fetch_assoc($item_result)) {
                            $sales += $item_rows['quantity'];
                        }
                    }
                }
            }
        }

        $orders[] = array(
            "sales" => $sales,
            "label" => $label,
            "date" => $min . " - " . $max,
        );
        $max = $min;
    }

    echo json_encode($orders);
    */
}

//RESPONSE FOR ORDERS CHART DATA
if (isset($_POST['requestType']) && $_POST['requestType'] == "order-chart-data") {

    $ordersData = array();
    $limitText =  mysqli_escape_string($conn, $_POST['limit']);
    $min = date("Y-m-d H:i:s");
    $max = date("Y-m-d H:i:s");
    $temp = 0;

    $om = new OrderModel();

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

        $orders = $om->getOrders();

        foreach ($orders as $order) {
            if ($order['status'] == "delivered") {
                if ($order['date_updated'] > $min && $order['date_updated'] < $max) {
                    $delivered++;
                }
            } else if ($order['status'] == "cancelled") {
                if ($order['date_updated'] > $min && $order['date_updated'] < $max) {
                    $cancelled++;
                }
            } else if ($order['status'] == "processing") {
                $processing++;
            } else {
                $checking++;
            }
            if ($order['date_created'] > $min && $order['date_created'] < $max) {
                $new++;
            }
        }

        $ordersData[] = array(
            "checking" => $checking,
            "processing" => $processing,
            "cancelled" => $cancelled,
            "delivered" => $delivered,
            "new" => $new,

        );
        $max = $min;
    }

    echo json_encode($ordersData);

    /*
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
                    if ($rows['date_updated'] > $min && $rows['date_updated'] < $max) {
                        $delivered++;
                    }
                } else if ($rows['status'] == "cancelled") {
                    if ($rows['date_updated'] > $min && $rows['date_updated'] < $max) {
                        $cancelled++;
                    }
                } else if ($rows['status'] == "processing") {
                    $processing++;
                } else {
                    $checking++;
                }
                if ($rows['date_created'] > $min && $rows['date_created'] < $max) {
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
    */
};

//RESPONSE FOR RECENT ORDERS DATA
if (isset($_POST['requestType']) && $_POST['requestType'] == "get-recent-orders") {

    $recentOrdersData = array();

    $om = new OrderModel();
    $um = new UserModel();

    $orders = $om->getOrders();

    foreach ($orders as $order) {
        $order_id = $order['id'];
        $user_id = $order['user_id'];
        $items = $order['items'];
        $date = $order['date_created'];
        $status = $order['status'];

        $users = $um->getUserById($user_id);
        $user = $users[0];
        $image = $um->getUserImage($user_id);

        array_unshift($recentOrdersData, array(
            "order_id" => $order_id,
            "user_id" => $user['id'],
            "user_name" => $user['firstname'] . " " . $user['lastname'],
            "user_email" => $user['email'],
            "user_image" => $image,
            "items" => $items,
            "date" => date("h:i:s A M d Y", strtotime($date)),
            "order_status" => $status

        ));
    }
    echo json_encode($recentOrdersData);

    /*
    $recent_orders = array();
    $user_manager = new User_manager();

    $sql = "SELECT * FROM orders ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {

            $order_id = $rows['id'];
            $user_manager->fetch_user($conn, $rows['user_id']);
            $items = $rows['items'];
            $date = $rows['date_created'];
            $status = $rows['status'];

            $recent_orders[] = array(
                "order_id" => $order_id,
                "user_id" => $user_manager->id,
                "user_name" => $user_manager->first_name . " " . $user_manager->last_name,
                "user_email" => $user_manager->email,
                "user_image" => $user_manager->image,
                "items" => $items,
                "date" => date("h:i:s A M d Y", strtotime($date)),
                "order_status" => $status
            );
        }
    }

    echo json_encode($recent_orders);
    */
}
//RESPONSE FOR ORDER ITEMS
if (isset($_POST['requestType']) && $_POST['requestType'] == "get-order-data") {

    $itemsData = array();
    $order_id = $_POST['order_id'];
    $om = new OrderModel();
    $im = new ItemModel();

    $order = $om->getOrderById($order_id)[0];
    $status = $order['status'];

    $order_items = $om->getOrderItems($order_id);
    foreach ($order_items as $order_item) {
        $item_id = $order_item['item_id'];
        $item_qty = $order_item['quantity'];

        $item = $im->getItemById($item_id)[0];
        $image = $im->getItemImage($item_id, false);

        $itemsData[] = array(
            "item_id" => $item_id,
            "status" => $status,
            "name" => $item['name'],
            "price" => $item['price'],
            "quantity" => $item_qty,
            "image" => $image
        );
    }

    echo json_encode($itemsData);
    /*
    $items = array();
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);

    $order_result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT status FROM orders WHERE id='$order_id'"));
    $status = $order_result['status'];

    $sql = "SELECT * FROM order_item WHERE order_id = '$order_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $item_id = $rows['item_id'];
            $item_qty = $rows['quantity'];

            $item_sql = "SELECT * FROM items WHERE id = '$item_id'";
            $item_result = mysqli_query($conn, $item_sql);
            if (mysqli_num_rows($item_result)) {
                while ($rows = mysqli_fetch_assoc($item_result)) {

                    //GET THE ID AND SET AS DIRECTORY
                    $directory = '../../images/items/' . $item_id;
                    //SCAN THE FILES INSIDE THE DIRECTORY
                    $files = array_diff(scandir($directory), array('..', '.'));
                    $file = array();
                    //GET THE FIRST FILE'S NAME
                    foreach ($files as $key => $value) {
                        $file = $value;
                        break;
                    }

                    $items[] = array(
                        "item_id" => $item_id,
                        "status" => $status,
                        "name" => $rows['name'],
                        "price" => $rows['price'],
                        "quantity" => $item_qty,
                        "image" => $file
                    );
                }
            }
        }
    }

    echo json_encode($items);
    */
}

//RESPONSE FOR EDIT ORDER STATUS
if (isset($_POST['requestType']) && $_POST['requestType'] == "edit-order-status") {
    $status = $_POST['status'];
    $order_id = $_POST['order_id'];
    $date = date("Y-m-d H:i:s");

    $om = new OrderModel();

    if (!$om->updateOrderStatus($status, $date, $order_id)) {
        echo 'failed';
        exit();
    }

    if (!$om->updateOrderItemByOrderId($order_id, 'yes')) {
        echo 'failed';
        exit();
    }

    echo 'ok';

    /*
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $date = date("Y-m-d H:i:s");
    $sql = "UPDATE orders SET 
        status = '$status',
        date_updated = '$date' 
        WHERE id = '$order_id'";

    if (mysqli_query($conn, $sql)) {
        echo "ok";
        if ($status == "delivered") {
            $sql = "UPDATE order_item  SET can_rate = 'yes' WHERE order_id = '$order_id'";
            mysqli_query($conn, $sql);
        }
    } else {
        echo "failed";
    }
    */
}

//RESPONSE FOR SINGLE ITEM INFO REQUEST
if (isset($_POST['requestType']) && $_POST['requestType'] == "load-item") {
    $id =  $_POST['id'];
    $im = new ItemModel();
    echo json_encode($im->getItemById($id));

    /*
    $id =  mysqli_escape_string($conn, $_POST['id']);
    $sql = "SELECT * FROM items WHERE id = '$id'";

    $item = getItemData($sql, $conn, true);
    echo json_encode($item);
    */
}
//RESPONSE FOR MULTIPLE ITEM INFO REQUEST
if (isset($_POST['requestType']) && $_POST['requestType'] == "load-items") {
    $im = new ItemModel();
    echo json_encode($im->getItemS());

    /*
    $sql = "SELECT * FROM items";

    if (isset($_POST['page'])) {
        $page =  mysqli_escape_string($conn, $_POST['page']);
        $offset = $page * 8 - 8;
        $sql .= " LIMIT 8 OFFSET $offset";
    }

    $items = getItemData($sql, $conn, false);
    echo json_encode($items);
    */
}

//RESPONSE FOR LOAD ALL USERS
if (isset($_POST['requestType']) && $_POST['requestType'] == "load-users") {
    $um = new UserModel();
    echo json_encode($um->getUsers());

    /*
    $user_manager = new User_manager();
    $user_manager->fetch_users($conn);
    echo json_encode($user_manager->user_list);
    */
}

//RESPONSE FOR LOAD SINGLE USER DATA
if (isset($_POST['requestType']) && $_POST['requestType'] == "view-users") {
    $id = $_POST['id'];
    $um = new UserModel();
    $om = new OrderModel();

    $user = $um->getUserById($id)[0];
    $orders = $om->getOrdersByUID($id);

    $cancelled = count($om->getUserOrders($id, 'cancelled'));
    $delivered = count($om->getUserOrders($id, 'delivered'));
    $processing = count($om->getUserOrders($id, 'processing'));
    $totalOrders = $cancelled+$delivered+$processing;

    $user_info = array(
        "id" => $id,
        "name" => $user['firstname'] . " " . $user['lastname'],
        "email" => $user['email'],
        "phone" => $user['phone'],
        "image" => $um->getUserImage($id)
    );

    $user_orders = array(
        "orders" => $totalOrders,
        "cancelled" => $cancelled,
        "delivered" => $delivered,
        "processing" => $processing
    );

    $response_data = array(
        "user_info" => $user_info,
        "user_orders" => $user_orders,
    );

    echo json_encode($response_data);

    /*
    $id =  mysqli_escape_string($conn, $_POST['id']);
    $user_manager = new User_manager();
    $user_manager->fetch_user($conn, $id);
    $user_manager->fetch_orders($conn);

    $user_info = array(
        "id" => $id,
        "name" => $user_manager->first_name . " " . $user_manager->last_name,
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
    */
}

//RESPONSE FOR ADD USER
if (isset($_POST['requestType']) && $_POST['requestType'] == "add-user") {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    $password = $_POST['password'];


    $first_name = mysqli_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_escape_string($conn, $_POST['last_name']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $user_type = mysqli_escape_string($conn, $_POST['user_type']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $user_manager = new User_manager();
    $user_manager->first_name = $first_name;
    $user_manager->last_name = $last_name;
    $user_manager->email = $email;
    $user_manager->type = $user_type;
    $user_manager->password = $password;

    if ($user_manager->insert_user($conn)) {
        echo "ok";
    }
}
//RESPONSE FOR ADD USER
if (isset($_POST['requestType']) && $_POST['requestType'] == "add-user") {
    $first_name = mysqli_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_escape_string($conn, $_POST['last_name']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $user_type = mysqli_escape_string($conn, $_POST['user_type']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $user_manager = new User_manager();
    $user_manager->first_name = $first_name;
    $user_manager->last_name = $last_name;
    $user_manager->email = $email;
    $user_manager->type = $user_type;
    $user_manager->password = $password;

    if ($user_manager->insert_user($conn)) {
        echo "ok";
    }
}
