<?php

class ProfileController extends UserModel
{
    use UserAddressTrait, OrderTrait, OrderItemTrait, CityListTrait, ProvinceListTrait, BarangayListTrait;
    public function profileData($user_id)
    {
        $userData = $this->getUserById($user_id);
        $userImage = $this->getUserImage($user_id);
        $userAddress = $this->getAddressBy_UID($user_id);
        $userOrders = $this->OrderCountData($user_id);
        $cityList = $this->getCityList();
        $provinceList = $this->getProvinceList();
        $barangayList = $this->getBarangayList();


        $user_info = array(
            "id" => $user_id,
            "name" => $userData[0]['firstname'] . " " .  $userData[0]['lastname'],
            "email" => $userData[0]['email'],
            "phone" => $userData[0]['phone'],
            "image" => $userImage
        );
        $user_address = array();
        if (count($userAddress) > 0) {
            $user_address = array(
                "house" => $userAddress[0]['house_number'],
                "street" => $userAddress[0]['barangay'],
                "city" => $userAddress[0]['city'],
                "province" => $userAddress[0]['province'],
            );
        }

        $address_option = array(
            "city_list" => $cityList,
            "province_list" => $provinceList,
            "barangay_list" => $barangayList,

        );

        $profileData = array(
            "user_info" => $user_info,
            "user_address" => $user_address,
            "user_orders" => $userOrders,
            "address_option" => $address_option
        );

        return $profileData;
    }
    public function updateImage($user_id){
        if (!$this->updateUserImage($user_id)) {
            return false;
        }
        return true;
    }
    public function updateAddress($user_id, $number, $street, $city, $province)
    {
        $shipping_fee = 0;

        if (!$this->isBarangayValid($street)) {
            return false;
        }
        if (!$this->isCityValid($city)) {
            return false;
        }
        if (!$this->isProvinceValid($province)) {
            return false;
        }
        if($street != ''){
            $shipping_fee = $this->getBarangay($street)[0]['shipping_fee'];
        }
        
        if (count($this->getAddressBy_UID($user_id)) == 0) {
            if (!$this->setUserAddress($number, $street, $city, $province, $user_id, $shipping_fee)) {
                return false;
            }
        } else {
            if (!$this->updateUserAddress($number, $street, $city, $province, $user_id, $shipping_fee)) {
                return false;
            }
        }
        
        return true;
    }
    public function isPasswordCorrect($old_password, $user_id){
        $orig_password = $this->getUserById($user_id)[0]['password'];
        if(!password_verify($old_password, $orig_password)){
            return false;
        }
        return true;
    }
    public function updatePassword($new_password, $confirm_new, $user_id){
        if($new_password != $confirm_new){
            return false;
        }
        if(!$this->updateUserPasswordBy_ID($user_id, $new_password)){
            return false;
        }
        return true;
    }
    public function cityList($province){
        $cityList = $this->getCityListByProvince($province);
        $returnData = array();
        foreach($cityList as $city){
            array_push($returnData, $city['city']);
        }
        return $returnData;
    }
    public function brgyList($city){
        $brgyList = $this->getBarangayListByCity($city);
        $returnData = array();
        foreach($brgyList as $brgy){
            array_push($returnData, $brgy['barangay']);
        }
        return $returnData;
    }
    private function isBarangayValid($street)
    {
        if($street == ''){
            return true;
        }
        if (count($this->getBarangay($street)) > 0) {
            return true;
        }
        return false;
    }
    private function isCityValid($city)
    {
        if($city == ''){
            return true;
        }
        if (count($this->getCity($city)) > 0) {
            return true;
        }
        return false;
    }
    private function isProvinceValid($province)
    {
        if($province == ''){
            return true;
        }
        if (count($this->getProvince($province)) > 0) {
            return true;
        }
        return false;
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
