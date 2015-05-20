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
        $this->db->insert('eop_school', $schoolData);
        return $this->db->affected_rows();
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

    function getSchool($id){

        $condition = array('id' => $id);
        $query = $this->db->get_where('eop_school', $condition);

        return $query->result_array();
    }


    function deleteSchool($id){

    }

    /**
     * Function getSchools
     * Returns all schools available in a particular state or district
     *
     * @param string $state   The state to which the schools belong
     * @param string $district Optional to filter district
     */
    function getSchools($state){
        $conditions = array('state_val' => $state);

        if($this->session->userdata['role']['level'] > 3 ){

            $this->db->select('A.*, B.uid')
                ->from('eop_view_school A')
                ->join('eop_user2school B', 'A.id = B.sid')
                ->where(array('uid'=> $this->session->userdata('user_id')));

            $query = $this->db->get();

            return $query->result_array();

        }
        else{
            $query = $this->db->get_where('eop_view_school', $conditions);
            return $query->result_array();
        }



    }


}