<?php

include './database.php';

if (isset($_POST['requestType']) && $_POST['requestType'] == "load-users") {
    $sql = "SELECT * FROM user";
    $users = getUserData($sql, $conn);

    echo json_encode($users);
}

if (isset($_POST['requestType']) && $_POST['requestType'] == "view-users") {
    $id = $_POST['id'];
    $sql = "SELECT * FROM user WHERE id = '$id'";

    $user = getUserData($sql, $conn);
    echo json_encode($user);
}

function getUserData($sql, $conn){

    $result = mysqli_query($conn, $sql);
    $users = array();
    if (mysqli_num_rows($result) > 0) {
        //GET ALL USERS DATA FROM DATABASE
        while ($rows = mysqli_fetch_assoc($result)) {
            $id = $rows['id'];
            $name = $rows['firstname'] . ' ' . $rows['lastname'];
            $email = $rows['email'];
            $phone = $rows['phone'];
            $purchased = $rows['purchased'];

            $mainDirectory = "../../images/users";
            $specificDirectory = "../../images/users/" . $id;

            if (!is_dir($mainDirectory)) {
                mkdir($mainDirectory);
            }

            if (!is_dir($specificDirectory)) {
                mkdir($specificDirectory);
            }

            $files = array_diff(scandir($specificDirectory), array('..', '.'));
            $file = '';
            //GET THE FIRST FILE'S NAME
            foreach ($files as $key => $value) {
                $file = $value;
                break;
            }

            $totalOrders = 0;
            $cancelled = 0;
            $delivered = 0;
            $processing = 0;

            $sqlOrders = "SELECT * FROM orders WHERE user_id = '$id'";
            $resultOrders = mysqli_query($conn,$sqlOrders);
            if(mysqli_num_rows($resultOrders) > 0){
                while($rowsOrders = mysqli_fetch_assoc($resultOrders)){
                    $s = $rowsOrders['status'];
                    if($s == "cancelled")
                        $cancelled++;
                    else if($s == "delivered")
                        $delivered++;
                    else
                        $processing++;

                    $totalOrders++;
                }
            }

            $orders = array(
                "total" => $totalOrders,
                "cancelled" => $cancelled,
                "delivered" => $delivered,
                "processing" => $processing
            );

            //ADD THE DATA AS JSON FORMAT IN ARRAY
            $users[] = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "phone" => $phone,
                "purchased" => $purchased,
                "image" => $file,
                "orders" => $orders
            );
        }
        return $users;
        
    }
}
