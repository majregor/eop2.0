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

    function updateDistrict($did, $data){
        
        $this->db->where('id', $did);
        $this->db->update('eop_district', $data);

        return $this->db->affected_rows();
    }

    /**
     * Function getDistricts
     * Returns all districts available in a particular state
     *
     * @param string $state   The state to which the districts belongs
     *
     *  If returns all districts if requested by super or state admins but it will return only the districts associated
     *  with other users when requested by district or school admins or school users
     */
    function getDistricts($state=''){
        if($state ==''){
            $conditions = array();
        }
        else{
            $conditions = array('state_val' => $state);
        }

        //For District admin, School admin and School user, return districts associated with the user
        if($this->session->userdata['role']['level'] >= 3 ){

            $this->db->select('A.*, B.uid')
                        ->from('eop_district A')
                        ->join('eop_user2district B', 'A.id = B.did')
                        ->order_by('A.name', 'ASC')
                        ->where(array('uid'=> $this->session->userdata('user_id')));

            $query = $this->db->get();

            return $query->result_array();
        }
        // For Super and State admins return all districts in the state or EOP installation
        else{
            $query = $this->db->order_by('name', 'ASC')->get_where('eop_district', $conditions);
            return $query->result_array();
        }
    }

    function getDistrict($district_id){
        $conditions = array('id'=>$district_id);

        $query = $this->db->get_where('eop_district', $conditions);

        return $query->result_array();

    }

    function getDistrictByName($name){

        $conditions = array('name'=>$name);

        $query = $this->db->get_where('eop_district', $conditions);

        return $query->result_array();

    }


}