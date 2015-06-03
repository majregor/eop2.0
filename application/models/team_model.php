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

    function deleteMember($id){
        $this->db->delete('eop_team', array('id'=>$id));
        return $this->db->affected_rows();
    }
 
    function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update('eop_team', $data);

        return $this->db->affected_rows();

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