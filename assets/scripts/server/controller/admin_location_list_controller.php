<?php

class AdminLocationListController extends ProvinceListModel
{
    use CityListTrait, BarangayListTrait;

    public function addProvince($province)
    {
        if(!$this->setProvince($province)){
            return false;
        }
        return true;
    }
    public function addCity($city, $province)
    {
        if(!$this->isProvinceExist($province)){
            return false;
        }
        if(!$this->setCity($city, $province)){
            return false;
        }
        return true;
    }
    public function addBarangay($barangay, $city, $shipping_fee)
    {
        if(!$this->isCityExist($city)){
            return false;
        }
        if(!$this->setBarangay($barangay, $city, $shipping_fee)){
            return false;
        }
        return true;
    }

    public function provincesData()
    {
        $returnData = $this->getProvinceList();
        if(count($returnData) > 0){
            return $returnData;
        }
        return false;
    }
    public function citysData()
    {
        $returnData = $this->getCityList();
        if(count($returnData) > 0){
            return $returnData;
        }
        return false;
    }
    public function barangayData()
    {
        $returnData = $this->getBarangayList();
        if(count($returnData) > 0){
            return $returnData;
        }
        return false;
    }
    public function removeProvince($id){
        if(!$this->deleteProvince($id)){
            return false;
        }
        return true;
    }
    public function removeCity($id){
        if(!$this->deleteCity($id)){
            return false;
        }
        return true;
    }
    public function removeBarangay($id){
        if(!$this->deleteBarangay($id)){
            return false;
        }
        return true;
    }

    public function isProvinceExist($province){
        if(count($this->getProvince($province)) > 0){
            return true;
        }
        return false;
    }
    public function isCityExist($city){
        if(count($this->getCity($city)) > 0){
            return true;
        }
        return false;
    }
    public function isEmpty($data){
        if($data == ''){
            return true;
        }
        return false;
    }
}
