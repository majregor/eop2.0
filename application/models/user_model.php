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
        $result = $query->result_array();

        if($query->num_rows >= 1)
        {
            $this->session->set_userdata('user_id',$result[0]['user_id']);
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
        $affected_rows = $this->db->affected_rows();
        $user_id = $this->db->insert_id();


        if($userData['district']!=''){ // Need to associate new user to the selected district

            $user2districtData = array(
                'uid'   => $user_id,
                'did'   =>  $userData['district']
                );
            $this->db->insert('eop_user2district', $user2districtData);
        }

        if($userData['school']!=''){ // Need to associate new user to the selected school

            $user2schoolData = array(
                'uid'   => $user_id,
                'sid'   =>  $userData['school']
                );
            $this->db->insert('eop_user2school', $user2schoolData);
        }

        return $affected_rows;
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

    function block($user_id){

        $data   = array('status' => 'blocked');
        $this->db->where('user_id', $user_id);
        $this->db->update('eop_user', $data);

        return $this->db->affected_rows();
    }

    function unblock($user_id){

        $data   = array('status' => 'active');
        $this->db->where('user_id', $user_id);
        $this->db->update('eop_user', $data);

        return $this->db->affected_rows();
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

        $cleanRoleData = array();
        $userRole = $this->getUserRole($this->session->userdata('user_id'));

        foreach($query->result_array() as $key=>$value){
            if($value['level'] >$userRole['level']){
                array_push($cleanRoleData, $value);
            }
        }
        return $cleanRoleData;
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

    public function getUserRole($uid){
      
        $this->db->select('A.user_id, B.*')
                ->from('eop_user A')
                ->join('eop_user_roles B', 'A.role_id=B.role_id')
                ->where(array('A.user_id'=>$uid));
        $query = $this->db->get();

        $result = $query->result_array();

        $permissionsData = array(
            'role_id'               => $result[0]['role_id'],
            'role'                  => $result[0]['title'],
            'role_screen_name'      => $result[0]['screen_name'],
            'is_locked'             => $result[0]['is_locked'],
            'can_view'              => $result[0]['can_view'],
            'can_edit'              => $result[0]['can_edit'],
            'create_district'       => $result[0]['create_district'],
            'edit_district'         => $result[0]['edit_district'],
            'create_school'         => $result[0]['create_school'],
            'edit_school'           => $result[0]['edit_school'],
            'create_user'           => $result[0]['create_user'],
            'edit_user'             => $result[0]['edit_user'],
            'alter_state_access'    => $result[0]['alter_state_access'],
            'edit_entity'           => $result[0]['edit_entity'],
            'level'                 => $result[0]['level']
            );

        return $permissionsData;
    }



}