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


    function addSchool($schoolData){

        if(!isset($schoolData['state_val'])){
            $schoolData['state_val'] =  $this->registry_model->getValue('host_state');
        }

        if($schoolData['district_id'] == FALSE || !isset($schoolData['district_id']) || $schoolData['district_id']==''){
            $schoolData['district_id'] = null;
        }

        if($this->session->userdata('user_id')){
            $schoolData['owner'] = $this->session->userdata('user_id');
        }

        $this->db->insert('eop_school', $schoolData);
        $school_id = $this->db->insert_id();
        $affected_rows = $this->db->affected_rows();


        if($this->session->userdata['role']['level'] == 4){ // If school is being added by School admin, associate them to the school
            $user2schoolData = array(
                'uid'   =>  $this->session->userdata('user_id'),
                'sid'   =>  $school_id
            );
            $this->db->insert('eop_user2school', $user2schoolData);
        }

        return $affected_rows;
    }
 
    function update($data=array()){

        $updateData = array(
            'name'       =>  $data['name'],
            'screen_name'    =>  $data['screen_name']
        );
 
        $this->db->where('id', $data['id']);
        $this->db->update('eop_school', $updateData);

        return $this->db->affected_rows();
    }

    function updateSchool($sid, $data){
        
        $this->db->where('id', $sid);
        $this->db->update('eop_school', $data);

        return $this->db->affected_rows();
    }

    function getSchool($id){

        $condition = array('id' => $id);
        $query = $this->db->get_where('eop_view_school', $condition);

        return $query->result_array();
    }


    function deleteSchool($id){

    }

    /**
     * Function getSchools
     * Returns all schools available in a particular state or district
     *
     * @param string $state   The state to which the schools belong
     */
    function getSchools($state){
        $conditions = array('state_val' => $state);

        // For school admin and school user, return schools associated with an individual user
        if($this->session->userdata['role']['level'] > 3 ){

            $this->db->select('A.*, B.uid')
                ->from('eop_view_school A')
                ->join('eop_user2school B', 'A.id = B.sid')
                ->where(array('uid'=> $this->session->userdata('user_id')));

            $query = $this->db->get();

            return $query->result_array();

        }
        // For District administrators, return all schools associated to their district
        elseif($this->session->userdata['role']['level'] == 3 ){

            $this->db->select('A.*, B.uid')
                        ->from('eop_view_school A')
                        ->join('eop_user2district B', 'A.district_id = B.did')
                        ->where(array('uid' => $this->session->userdata('user_id')));
            $query = $this->db->get();

            return $query->result_array();
        }
        //For Super user and district User, simply return all the schools in the state
        else{
            $query = $this->db->get_where('eop_view_school', $conditions);
            return $query->result_array();
        }

    }

    /**
     * Function getDistrictSchools
     * Returns all schools available in a particular district
     *
     * @param string $district   The state to which the schools belong
     * @return array results array of records
     */
    function getDistrictSchools($district){
        $conditions = array('district_id' => $district);

        $query = $this->db->get_where('eop_view_school', $conditions);

        return $query->result_array();

    }

    /**
     * Function getSchoolDistrict
     * Returns a given school's district if any returns false if not
     *
     * @param string $school_id   The school id for whose district is needed
     * @return int|null district id or null if none found
     */
    function getSchoolDistrict($school_id){
        $returnVal = null;
        $conditions = array('id' => $school_id);
        $this->db->select('district_id');
        $query = $this->db->get_where('eop_school', $conditions);

        if($query->num_rows()>0){
            $returnVal =  $query->result_array()[0]['district_id'];
        }else{
            $returnVal = null;
        }

        return $returnVal;
    }


    /**
     *  Function attaches a school to the session object
     * @method attach_to_session
     * @param int school_id The school id
     * @return void
     */
    public function attach_to_session($school_id){
        //Clear loaded_school session data
        $this->session->unset_userdata('loaded_school');

        $schoolData = $this->getSchool($school_id);
        $data = array(
            'loaded_school' => array(
                'id'                =>  $schoolData[0]['id'],
                'district_id'       =>  $schoolData[0]['district_id'],
                'state_val'         =>  $schoolData[0]['state_val'],
                'name'              =>  $schoolData[0]['name'],
                'screen_name'       =>  $schoolData[0]['screen_name'],
                'description'       =>  $schoolData[0]['description'],
                'created_date'      =>  $schoolData[0]['created_date'],
                'modified_date'     =>  $schoolData[0]['modified_date'],
                'owner'             =>  $schoolData[0]['owner'],
                'state_permission'  =>  $schoolData[0]['state_permission'],
                'district'          =>  $schoolData[0]['district'],
                'state'             =>  $schoolData[0]['state']
            )

        );

        $this->session->set_userdata($data);

    }

}