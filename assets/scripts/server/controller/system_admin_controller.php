<?php

class SystemAdminController extends UserModel
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
                "status" => $result['status'],
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
            "firstname" => $userData[0]['firstname'],
            "lastname" => $userData[0]['lastname'],
            "email" => $userData[0]['email'],
            "type" => $userData[0]['type'],
            "phone" => $userData[0]['phone'],
            "verified" => $userData[0]['verified'],
            "status" => $userData[0]['status'],
            "image" => $userImage
        );

        $profileData = array(
            "user_info" => $user_info,
            "user_orders" => $userOrders
        );

        return $profileData;
    }

    public function editUser($user_id, $first_name, $last_name, $email, $phone, $user_type, $verified, $status){
        if(
            !$this->isNameValid($first_name) || 
            !$this->isNameValid($first_name) ||
            !$this->isEmailValid($email) ||
            !$this->isPhoneValid($phone) ||
            !$this->isTypeValid($user_type) ||
            !$this->isVerValid($verified) ||
            !$this->isStatValid($status)
        ){
            return false;
        }
        $userInfo = $this->getUserById($user_id)[0];
        $old_email = $userInfo['email'];
        $old_phone = $userInfo['phone'];

        if($this->isEmailExist($email)){
            if($email != $old_email){
                return false;
            }
        }
        if($this->isPhoneExist($phone)){
            if($phone != $old_phone){
                return false;
            }
        }

        if(!$this->updateUserInfo($user_id, $first_name, $last_name, $email, $phone, $user_type, $verified, $status)){
            return false;
        }
        return true;
    }

    public function deleteUser($user_id){
        if(count($this->getUserById($user_id)) <= 0 ){
            return false;
        }
        if(!$this->deleteUserById($user_id)){
            return false;
        }
        return true;
    }

    public function totalValues()
    {

        $totalValues = array(
            "total" => $this->countCustomers() + $this->countDrivers() + $this->countAdmins(),
            "customers" => $this->countCustomers(),
            "drivers" => $this->countDrivers(),
            "admins" => $this->countAdmins()
        );

        return $totalValues;
    }
    private function countCustomers()
    {
        $customers = $this->getUsersByType('customer');
        return count($customers);
    }
    private function countDrivers()
    {
        $drivers = $this->getUsersByType('driver');
        return count($drivers);
    }
    private function countAdmins()
    {
        $admins = $this->getUsersByType('admin');
        return count($admins);
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

    private function isNameValid($name)
    {
        $namePattern = "/^([a-zA-Z])+([-. ]([a-zA-Z])+)?([-. ]([a-zA-Z])+)?$/";
        if (preg_match($namePattern, $name) && strlen($name) <= 20) {
            return true;
        }
        return false;
    }

    private function isEmailValid($email)
    {
        $emailPattern = "/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/";
        if (preg_match($emailPattern, $email)) {
            return true;
        }
        return false;
    }

    private function isPhoneValid($phone)
    {
        $phonePattern = "/((^(\+63)(\d{10}))|(^(09)(\d{9}))|(^(9)(\d{9})))$/";
        if (preg_match($phonePattern, $phone)) {
            return true;
        }
        return false;
    }
    private function isEmailExist($email)
    {
        if (count($this->getUserByEmail($email)) > 0) {
            return true;
        }
        return false;
    }

    private function isPhoneExist($phone)
    {
        $tenDigitPhone = substr($phone, -10);
        $withZeroDigitPhone = '0' . $tenDigitPhone;
        $withPlusDigitPhone =  '+63' . $tenDigitPhone;

        if (count($this->getUserByPhone($tenDigitPhone)) > 0) {
            return true;
        }
        if (count($this->getUserByPhone($withZeroDigitPhone)) > 0) {
            return true;
        }
        if (count($this->getUserByPhone($withPlusDigitPhone)) > 0) {
            return true;
        }
        return false;
    }
    private function isTypeValid($user_type){
        if($user_type == 'customer' || $user_type == 'driver' || $user_type == 'admin'){
            return true;
        }
        return false;
    }
    private function isVerValid($verified){
        if($verified == 'yes' || $verified == 'no'){
            return true;
        }
        return false;
    }
    private function isStatValid($status){
        if($status == 'active' || $status == 'blocked'){
            return true;
        }
        return false;
    }
    

}
