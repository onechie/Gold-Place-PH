<?php

class AdminUserListController extends UserModel
{
    use OrderTrait;
    public function usersData($user_type)
    {
        $results = '';
        
        if($user_type == 'driver'){
            $results = $this->getUsersByType($user_type);
        } else if($user_type == 'admin' && $_SESSION['userType'] == 'super_admin'){
            $results = $this->getUsersByType($user_type);
        } else if($user_type == 'super_admin' && $_SESSION['userType'] == 'super_admin'){
            $results = $this->getUsersByType($user_type);
        } else {
            $results = $this->getUsersByType('customer');;
        }

        $usersData = array();

        foreach ($results as $result) {
            $usersData[] = array(
                "id" => $result['id'],
                "firstname" => $result['firstname'],
                "lastname" => $result['lastname'],
                "email" => $result['email'],
                "phone" => $result['phone'],
                "password" => $result['password'],
                "verified" => $result['verified'],
                "type" => $result['type'],
                "purchased" => $result['purchased'],
                "image" => $this->getUserImage($result['id'])
            );
        }
        return $usersData;
    }

    public function userData($user_id)
    {
        $userData = $this->getUserById($user_id);
        $userImage = $this->getUserImage($user_id);
        $userOrders = $this->OrderCountData($user_id);

        $user_info = array(
            "id" => $user_id,
            "name" => $userData[0]['firstname'] . " " .  $userData[0]['lastname'],
            "email" => $userData[0]['email'],
            "phone" => $userData[0]['phone'],
            "image" => $userImage
        );

        $profileData = array(
            "user_info" => $user_info,
            "user_orders" => $userOrders
        );

        return $profileData;
    }

    private function OrderCountData($user_id)
    {
        $orders = $this->getOrderBy_UID($user_id);

        $orders_count = 0;
        $cancelled_count = 0;
        $delivered_count = 0;
        $processing_count = 0;

        foreach ($orders as $order) {
            if ($order['status'] == 'cancelled') {
                $cancelled_count++;
            } else if ($order['status'] == 'processing' || $order['status'] == 'checking') {
                $processing_count++;
            } else {
                $delivered_count++;
            }
            $orders_count++;
        }
        $orderCountData = array(
            "orders" => $orders_count,
            "cancelled" => $cancelled_count,
            "delivered" => $delivered_count,
            "processing" => $processing_count
        );
        return $orderCountData;
    }

}
