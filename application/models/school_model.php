<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class School_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }



    function addSchool($userData){
        $data = array(
            'role_id'       => isset($userData['role_id'])? $userData['role_id']: 1,
            'first_name'    => isset($userData['first_name'])? $userData['first_name']:'',
            'last_name'     => isset($userData['last_name'])? $userData['last_name']:'',
            'email'         => isset($userData['email'])? $userData['email']:'',
            'username'      => isset($userData['username'])? $userData['username']:'',
            'password'      => isset($userData['password'])? $userData['password']:'',
            'phone'         => isset($userData['phone'])? $userData['phone'] : '',
            'status'        => 'active'
        );

        $this->db->insert('eop_user', $data);
        return $this->db->affected_rows();
    }
 
    function update($data=array()){

        $updateData = array(
            'role_id'       =>  $data['role_id'],
            'first_name'    =>  $data['first_name'],
            'last_name'     =>  $data['last_name'],
            'email'         =>  $data['email'],
            'username'      =>  $data['username'],
            'phone'         =>  $data['phone']
        );

        $this->db->where('user_id', $data['user_id']);
        $this->db->update('eop_user', $updateData);

        return $this->db->affected_rows();
        
    }

    function getSchool($id){

    }


    function deleteSchool($id){

    }

    /**
     * Function getSchools
     * Returns all schools available in a particular state or district
     *
     * @param string $state   The state to which the schools belongs
     * @param string $district Optional to filter district
     */
    function getSchools($state, $district=''){
        $conditions = array('state_val' => $state);
        if($district!=''){
            $conditions['district_id'] = $district;
        }

        $query = $this->db->get_where('eop_school', $conditions);
        return $query->result_array();

    }


}