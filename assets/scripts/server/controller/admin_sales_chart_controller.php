<?php

class AdminSalesChartController extends OrderModel
{
    use OrderItemTrait;

    public function salesData($limit)
    {

        $min = date("Y-m-d H:i:s");
        $max = date("Y-m-d H:i:s");
        $temp = 0;
        $label = "";

        $salesData = array();

        for ($i = 0; $i < 7; $i++) {

            if ($limit == "daily") {
                $temp = strtotime("-1 day", strtotime($min));
                $label = date("D", strtotime($min));
            } else if ($limit == "weekly") {
                $temp = strtotime("-1 week", strtotime($min));
                $label = date("W", strtotime($min));
            } else if ($limit == "monthly") {
                $temp = strtotime("-1 month", strtotime($min));
                $label = date("M", strtotime($min));
            } else if ($limit == "annually") {
                $temp = strtotime("-1 year", strtotime($min));
                $label = date("Y", strtotime($min));
            } else {
                return false;
            }

            $min = date("Y-m-d H:i:s", $temp);
            $sales = 0;

            $orders = $this->getOrdersByDate($min, $max);

            if (count($orders) > 0) {
                foreach ($orders as $order) {
                    if ($order['status'] == 'delivered') {
                        $order_id = $order['id'];
                        $order_items = $this->getOrderItemBy_OID($order_id);
                        foreach ($order_items as $order_item) {
                            $sales += $order_item['quantity'];
                        }
                    }
                }
            }

            $salesData[] = array(
                "sales" => $sales,
                "label" => $label,
                "date" => $min . " - " . $max,
            );
            $max = $min;
        }

        return $salesData;
    }
}
