<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }


    function addMember($data){


        $this->db->insert('eop_team', $data);
        $affected_rows = $this->db->affected_rows();

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
            return $updatedRecs;
        }
        elseif(isset($updatedDistrictRecs) && is_numeric($updatedDistrictRecs) && $updatedDistrictRecs>=1){
            return $updatedDistrictRecs;
        }
        else{
            return $updatedRecs;
        }
    }


    /**
     * Function to return a member by their member_id
     *
     * @method getMember
     * @param $p The member_id
     * @return mixed Returns an associative array of containing the user information from the database
     */
    function getMember($p, $key=''){

        $conditions = array('id'=>$p);

        $query = $this->db->get_where('eop_team', $conditions);

        return $query->result_array();
    }

    function getMembers($data=''){
        if($data ==''){

            $this->db->order_by('created', 'DESC');
            $query = $this->db->get('eop_team');
            return $query->result_array();

        }else{

            $conditions=$data;
            $query = $this->db->get_where('eop_team', $conditions);

            return $query->result_array();

        }

    }

}