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

    /**
     * @method getEntities
     * @param $type the type of the entity to retrieve
     * @param string $data array of criteria
     * @param bool $recursive Defines whether to return entities recursively structured or to return simple entities list
     * @return associative array of entities
     */
    public function getEntities($type, $data='', $recursive=false){
        $conditions = array();

        if($type!='' || $type !='all'){
            $conditions['type_id'] = $this->getEntityTypeId($type);
        }

        if($data !='' && is_array($data)){
            $conditions = array_merge($conditions, $data);
        }

        $query = $this->db->get_where('eop_entity', $conditions);
        $resultsArray = $query->result_array();



        if($recursive){ // If recursive entity requested

            if(is_array($resultsArray) && count($resultsArray) >0){
                $detailedEntityArray = $this->getDetailedEntities($resultsArray);
            }

        }else{ // Return simple array list of entities
            return $resultsArray;
        }

    }

    /**
     * @param array $entityRowsArray simple list array of entities
     * @return array recursively structured array of entities
     */
    private function getDetailedEntities($entityRowsArray){

        $returnArray = array();

        //For each Entity record, get its children and organise array into proper hierarchy
        //Recursively arrange the directory structure of elements...


        return $returnArray;
    }

    public function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update('eop_entity', $data);

        return $this->db->affected_rows();

    }
}