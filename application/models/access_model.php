<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class Access_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function getStateWideStateAccess(){

        return $this->registry_model->getValue('state_permission');
    }

    public function getDistrictWideStateAccess($district){


        $districtRow = $this->district_model->getDistrict($district);

        return $districtRow['state_permission'];
    }

    public function getSchoolWideStateAccess(){
        /*$districts = $this->district_model->getDistricts($this->registry_model->getValue('host_state'));
        foreach($districts as $key=>$value){

        }*/
    }

    public function grantStatewideAccess(){
        return $this->registry_model->update('state_permission', 'write');
    }

    public function revokeStatewideAccess(){
       return $this->registry_model->update('state_permission', 'deny');
    }



}