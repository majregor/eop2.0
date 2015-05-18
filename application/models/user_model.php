<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class User_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    function validate($username, $password){

        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $query = $this->db->get('eop_user');

        if($query->num_rows == 1)
        {
            return true;
        }
        else{
            return false;
        }

    }


    function addUser($userData){
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

    function update($data=''){
        if(is_array($data)){

            $this->db->where('user_id', $data['user_id']);
            $this->db->update('eop_user', $data);

            return $this->db->affected_rows();
        }
    }

    function getUser($id){

    }

    function getUsers($data=''){
        if($data==''){ // No filter set return all users
            $query = $this->db->get('eop_view_user');

            return $query->result_array();
        }
        elseif(is_array($data)){
            $query = $this->db_get_where('eop_view_user', $data);
            return $query->result_array();
        }
    }

    function blockUser($id){

    }

    function blockUsers($data){

    }

    function deleteUser($id){

    }

    function deleteUsers($data){

    }

    /**
     * Function getAllRoles
     *  Function to returns array of all roles from the database
     */
    function getAllRoles(){

        $query = $this->db->get('eop_user_roles');

        return $query->result_array();

    }

    /**
     * Function getDistricts
     * Returns all districts available in a particular state
     */
    function getDistricts($state){

        $query = $this->db->get_where('eop_district', array('state_val' => $state));
        return $query->result_array();

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

    /**
     * Function resetPwd
     * @method resetPwd user_id | new_password
     * @param string $user_id  The user id to reset the password for
     * @param string $new_password The new password to override the old one
     */
    function resetPwd($user_id, $new_password){
        $data = array(
            'password'  =>  $new_password
        );

        $this->db->where('user_id', $user_id);
        $this->db->update('eop_user', $data);

        return $this->db->affected_rows();
    }



}