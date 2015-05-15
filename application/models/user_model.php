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

    function update(){

    }

    function getUser($id){

    }

    function getUsers($data){

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



}