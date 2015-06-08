<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function addThreadAndHazard($data){

        $this->db->insert('eop_entity', $data);
        $affected_rows = $this->db->affected_rows();

        return $affected_rows;

    }

    public function getEntityTypeId($param, $use='name'){
        $condition= array();
        if($use=='title'){
            $condition['title'] = $param;
        }else{
            $condition['name'] = $param;
        }

        $query = $this->db->get_where('eop_entity_types', $condition);

        $resultsArray = $query->result_array();

        return $resultsArray[0]['id'];
    }
}