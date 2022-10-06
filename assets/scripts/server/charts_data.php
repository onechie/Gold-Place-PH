<?php 
    include './database.php';
    date_default_timezone_set("Asia/Manila");
    
    if (isset($_POST['requestType']) && $_POST['requestType'] == "line-chart-data") {;
        $orders = array();
        $limitText = $_POST['limit'];
        $min = date("Y-m-d H:i:s");
        $pointCount = 0;
        $max = date("Y-m-d H:i:s");
        $sql = "";
        $label = "";

        for($i = 0; $i < 7; $i++){
            
            if($limitText == "daily"){
                $temp = strtotime("-1 day", strtotime($min));
                $label = date("D", strtotime($min));
            }else if($limitText == "weekly"){
                $temp = strtotime("-1 week", strtotime($min));
                $label = date("W", strtotime($min));
            } else {
                $temp = strtotime("-1 month", strtotime($min));
                $label = date("M", strtotime($min));
            }

            $min = date("Y-m-d H:i:s", $temp);
            $sql = "SELECT * FROM orders WHERE date_created > '$min' AND date_created < '$max'";

            $delivered = 0;
    
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($rows = mysqli_fetch_assoc($result)){
                    if($rows['status'] == "delivered"){
                        $delivered++;
                    }
                   
                }
            }
    
            $orders[] = array(
               "delivered" => $delivered,
               "label" => $label, 
               "date" => $min." - ".$max,
            );
            $max = $min;

        }

        echo json_encode($orders);
        
    }

    if (isset($_POST['requestType']) && $_POST['requestType'] == "order-chart-data") {

        $orders = array();
        $limitText = $_POST['limit'];
        $limit = 0;
        $sql = "SELECT * FROM orders";

        if($limitText == "daily"){
            $limit = (int)strtotime("now -1 day");
        }else if($limitText == "weekly"){
            $limit = (int)strtotime("now -1 week");
        } else {
            $limit = (int)strtotime("now -1 month");
        }
        
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
                if((int)strtotime($rows['date_created']) > $limit){
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
        }

        $orders = array(
            "users" => $users,
            "stocks" => $stocks,
            "checking" => $checking,
            "processing" => $processing,
            "cancelled" => $cancelled,
            "delivered" => $delivered,
            "total" => $total,
        );

        echo json_encode($orders);
    };

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