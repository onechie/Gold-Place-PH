<?php

class AdminTotalValuesController extends OrderModel
{
    use OrderItemTrait, ItemTrait, UserTrait;
    public function totalValues()
    {
        $totalValues = array(
            "sales" => $this->countSales(),
            "orders" => $this->countOrders(),
            "stocks" => $this->countStocks(),
            "users" => $this->countUsers()
        );
    
        return $totalValues;
    }

    private function countSales()
    {
        $orders = $this->getOrders();
        $salesCount = 0;

        if (count($orders) > 0) {
            foreach ($orders as $order) {
                if ($order['status'] == 'delivered') {
                    $order_id = $order['id'];
                    $order_items = $this->getOrderItemBy_OID($order_id);
                    foreach ($order_items as $order_item) {
                        $salesCount += $order_item['quantity'];
                    }
                }
            }
        }
        return $salesCount;
    }
    private function countOrders()
    {
        $orders = $this->getOrders();
        return count($orders);
    }
    private function countStocks()
    {
        $items = $this->getItems();
        $stocksCount = 0;

        if (count($items) > 0) {
            foreach ($items as $item) {
                $stocksCount += $item['stocks'];
            }
        }
        return $stocksCount;
    }
    private function countUsers()
    {
        $users = $this->getUsers();
        return count($users);
    }
}
