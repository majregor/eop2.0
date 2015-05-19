<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class District_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }


    function addDistrict($districtData){


        $this->db->insert('eop_district', $districtData);
        return $this->db->affected_rows();

    }
 
    function update($data=array()){

        $updateData = array(
            'name'           =>  $data['name'],
            'screen_name'    =>  $data['screen_name']
        );

        $this->db->where('id', $data['id']);
        $this->db->update('eop_district', $updateData);

        return $this->db->affected_rows();
    }

    /**
     * Function getDistricts
     * Returns all districts available in a particular state
     *
     * @param string $state   The state to which the districts belongs
     *
     */
    function getDistricts($state=''){
        if($state ==''){
            $conditions = array();
        }
        else{
            $conditions = array('state_val' => $state);
        }

        $query = $this->db->get_where('eop_district', $conditions);
        return $query->result_array();

    }

    function getDistrict($district_id){
        $conditions = array('id'=>$district_id);

        $query = $this->get_where('eop_district', $conditions);

        return $query->result_array();

    }


}