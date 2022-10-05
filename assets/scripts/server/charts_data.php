<?php 
    include './database.php';

    if (isset($_POST['requestType']) && $_POST['requestType'] == "order-chart-data") {
        $orders = array();
        $sql = "SELECT * FROM orders";

        $total = 0;
        $checking = 0;
        $processing = 0;
        $cancelled = 0;
        $delivered = 0;
        $stocks = countStocks($conn, "SELECT * FROM items");
        $users = countUsers($conn, "SELECT * FROM user");

        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($rows = mysqli_fetch_assoc($result)){
                if($rows['status'] == "checking"){
                    $checking++;
                } else if($rows['status'] == "processing"){
                    $processing++;
                } else if($rows['status'] == "cancelled"){
                    $cancelled++;
                } else {
                    $delivered++;
                }
                $total++;
            }
        }

        $orders = array(
            "users" => $users,
            "stocks" => $stocks,
            "checking" => $checking,
            "processing" => $processing,
            "cancelled" => $cancelled,
            "delivered" => $delivered,
            "total" => $total
        );

        echo json_encode($orders);
    }

    function countStocks($conn, $sql){
        $stocks = 0;
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($rows = mysqli_fetch_assoc($result)){
                $stocks += $rows['stocks'];
            }
        }
        return $stocks;
    }

    function countUsers($conn, $sql){
        $users = 0;
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($rows = mysqli_fetch_assoc($result)){
                $users ++;
            }
        }
        return $users;
    }