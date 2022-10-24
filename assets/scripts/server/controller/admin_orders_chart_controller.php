<?php

class AdminOrdersChartController extends OrderModel
{
    public function ordersData($limit)
    {
        $ordersData = array();

        $min = date("Y-m-d H:i:s");
        $max = date("Y-m-d H:i:s");
        $temp = 0;

        for ($i = 0; $i < 2; $i++) {

            if ($limit == "daily") {
                $temp = strtotime("-1 day", strtotime($min));
            } else if ($limit == "weekly") {
                $temp = strtotime("-1 week", strtotime($min));
            } else if ($limit == "monthly") {
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

            $orders = $this->getOrders();

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

        return $ordersData;
    }
}
