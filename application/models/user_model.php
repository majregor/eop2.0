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
            'read_only'     => isset($userData['read_only'])? $userData['read_only'] : 'n',
            'status'        => 'active'
        );

        $this->db->insert('eop_user', $data);
        $affected_rows = $this->db->affected_rows();
        $user_id = $this->db->insert_id();

        if(isset($userData['district'])){
            if($userData['district']!=''){ // Need to associate new user to the selected district

                $user2districtData = array(
                    'uid'   => $user_id,
                    'did'   =>  $userData['district']
                );
                $this->db->insert('eop_user2district', $user2districtData);
            }
        }

        if(isset($userData['school'])){
            if($userData['school']!=''){ // Need to associate new user to the selected school

                $user2schoolData = array(
                    'uid'   => $user_id,
                    'sid'   =>  $userData['school']
                );
                $this->db->insert('eop_user2school', $user2schoolData);
            }
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
            'phone'         =>  $data['phone'],
            'read_only'     =>  $data['access']
        );

        if(isset($data['school_id'])){
            if($data['school_id']){

                $user2schoolData = array(
                    'sid'   =>  $data['school_id']
                );
                $this->db->where('uid', $data['user_id']);
                $this->db->update('eop_user2school', $user2schoolData);
                $updatedSchoolRecs = $this->db->affected_rows();
            }
        }

        if(isset($data['district_id'])){
            if($data['district_id']){

                $user2districtData = array(
                    'did'   =>  $data['district_id']
                );
                $this->db->where('uid', $data['user_id']);
                $this->db->update('eop_user2district', $user2districtData);

                $updatedDistrictRecs = $this->db->affected_rows();
            }
        }


        $this->db->where('user_id', $data['user_id']);
        $this->db->update('eop_user', $updateData);

        $updatedRecs = $this->db->affected_rows();


        if(isset($updatedSchoolRecs) && is_numeric($updatedSchoolRecs) && $updatedSchoolRecs>=1){
            return $updatedSchoolRecs;
        }
        elseif(isset($updatedDistrictRecs) && is_numeric($updatedDistrictRecs) && $updatedDistrictRecs>=1){
            return $updatedDistrictRecs;
        }
        else{
            return $updatedRecs;
        }
    }

    function updatePersonalAccount($userId, $data){

        $this->db->where('user_id', $userId);
        $this->db->update('eop_user', $data);

        return $this->db->affected_rows();
        
    }

    /**
     * Function to return a user by either the user_id or username depending on whether the
     * second parameter is passed or not.
     *
     * @method getUser
     * @param $p The user_id or username passed to the function
     * @param string $key This parameter signals request by user_id or username if blank, default is user_id
     * @return mixed Returns an associative array of containing the user information from the database
     */
    function getUser($p, $key=''){
        if($key=='username'){
            $conditions = array('username'=>$p);
        }else{
            $conditions = array('user_id'=>$p);
        }

        $query = $this->db->get_where('eop_view_user', $conditions);

        return $query->result_array();
    }


    function getUserDistrict($id){
        $conditions = array('uid'=>$id);
        $query = $this->db->get_where('eop_user2district', $conditions);

        return $query->result_array();
    }

    function getUserSchool($id){
        $conditions = array('uid'=>$id);
        $query = $this->db->get_where('eop_user2school', $conditions);

        return $query->result_array();
    }

    function getUsers($data=''){
        if($data==''){ // No filter set return all users

            // For school admin return users associated with the school admin's school.
            if($this->session->userdata['role']['level'] == 4 ){
                $schoolDataRow = $this->getUserSchool($this->session->userdata('user_id'));
                $schoolId = isset($schoolDataRow[0]['sid']) ? $schoolDataRow[0]['sid']:null;

                if(null != $schoolId){
                    $this->db->select('A.*')
                        ->from('eop_view_user A')
                        ->where(array('school_id'=> $schoolId));

                    $query = $this->db->get();

                    return $query->result_array();
                }else{
                    $emptyArray = array();
                    return $emptyArray;
                }
            }
            // For District admin return users associated with the district admin's district.
            elseif($this->session->userdata['role']['level'] == 3 ){
                $districtDataRow = $this->getUserDistrict($this->session->userdata('user_id'));
                $districtId = isset($districtDataRow[0]['did']) ? $districtDataRow[0]['did']:null;

                if(null != $districtId){
                    $this->db->select('A.*')
                        ->from('eop_view_user A')
                        ->where(array('district_id'=> $districtId));

                    $query = $this->db->get();

                    return $query->result_array();
                }else{
                    $emptyArray = array();
                    return $emptyArray;
                }
            }
            // For School users return own user record
            elseif($this->session->userdata['role']['level'] == 5 ){

                $conditions = array('user_id' => $this->session->userdata('user_id') );
                $query = $this->db->get_where('eop_view_user', $conditions);

                return $query->result_array();
            }
            //For State admin return all users except Super admin and school user
            elseif($this->session->userdata['role']['level'] == 2){
                $excludedRoles = array('1', '5' );
                $this->db->where_not_in('role_id', $excludedRoles);
                $query = $this->db->get('eop_view_user');

                return $query->result_array();
            }
            // For Super Admins return all users
            else{
                $query = $this->db->get('eop_view_user');

                return $query->result_array();
            }

        }
        elseif(is_array($data)){
            $query = $this->db->get_where('eop_view_user', $data);
            return $query->result_array();
        }
    }

    function getStatus($username){
        $this->db->select('status');
        $query = $this->db->get_where('eop_user', array('username'=>$username));
        $results = $query->result_array();

        return  $results[0]['status'];

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

            //Add School Admin to list as an exception to enable school admins be able to add fellow school admins
            if($userRole['level'] == 4 && $value['level']==4){
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

    public function getUserRoleByUsername($username){

        $this->db->select('A.user_id, A.username, B.*')
            ->from('eop_user A')
            ->join('eop_user_roles B', 'A.role_id=B.role_id')
            ->where(array('A.username'=>$username));
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

    public function checkUsername($username){
        $this->db->select('username');
        $query = $this->db->get_where('eop_user', array('username'=>$username));
        $recs = $query->num_rows();

        if(is_numeric($recs) && $recs >0){
            return true;
        }
        else{
            return false;
        }
    }

    public function checkUseremail($email){
        $this->db->select('email');
        $query = $this->db->get_where('eop_user', array('email'=>$email));
        $recs = $query->num_rows();

        if(is_numeric($recs) && $recs >0){
            return true;
        }
        else{
            return false;
        }
    }

}