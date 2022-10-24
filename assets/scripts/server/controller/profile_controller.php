<?php

class ProfileController extends UserModel
{
    use UserAddressTrait, OrderTrait, OrderItemTrait, CityListTrait, ProvinceListTrait;
    public function profileData($user_id)
    {
        $userData = $this->getUserById($user_id);
        $userImage = $this->getUserImage($user_id);
        $userAddress = $this->getAddressBy_UID($user_id);
        $userOrders = $this->OrderCountData($user_id);
        $cityList = $this->getCityList();
        $provinceList = $this->getProvinceList();

        $user_info = array(
            "id" => $user_id,
            "name" => $userData[0]['firstname'] . " " .  $userData[0]['lastname'],
            "email" => $userData[0]['email'],
            "phone" => $userData[0]['phone'],
            "image" => $userImage
        );

        $user_address = array(
            "house" => $userAddress[0]['house_number'],
            "street" => $userAddress[0]['barangay'],
            "city" => $userAddress[0]['city'],
            "province" => $userAddress[0]['province'],
        );
        $address_option = array(
            "city_list" => $cityList,
            "province_list" => $provinceList
        );

        $profileData = array(
            "user_info" => $user_info,
            "user_address" => $user_address,
            "user_orders" => $userOrders,
            "address_option" => $address_option
        );

        return $profileData;
    }

    public function updateAddress($user_id, $number, $street, $city, $province)
    {
        if (!$this->isCityExists($city)) {
            return false;
        }
        if (!$this->isProvinceExists($province)) {
            return false;
        }

        if(!$this->updateUserAddress($number, $street, $city, $province, $user_id)){
            return false;
        }
        if(!$this->updateUserImage($user_id)){
            return false;
        }
        return true;
    }

    private function isCityExists($city)
    {
        if (count($this->getCity($city)) > 0) {
            return true;
        }
        return false;
    }
    private function isProvinceExists($province)
    {
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
