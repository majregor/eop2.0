<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function addThreadAndHazard($data){

        $this->db->insert('eop_entity', $data);
        $insertedId = $this->db->insert_id();
        $affected_rows = $this->db->affected_rows();

        /**
         * Add the default goal 1, 2 and 3 objectives as children to the new Threat & Hazard
         */
        $data = array(
            'name'      =>      'Goal 1',
            'title'     =>      'Goal 1 (Before)',
            'owner'     =>      $this->session->userdata('user_id'),
            'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
            'type_id'   =>      $this->getEntityTypeId('g1', 'name')
        );

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
    public function getEntities($type, $data='', $recursive=false, $sortOrder=array()){
        $conditions = array();

        if($type!='' || $type !='all'){
            $conditions['type_id'] = $this->getEntityTypeId($type);
        }

        if($data !='' && is_array($data)){
            $conditions = array_merge($conditions, $data);
        }

        if(count($sortOrder)>0){
            $orderBy = $sortOrder['orderby'];
            $sortType = $sortOrder['type'];
            $this->db->order_by($orderBy, $sortType);
        }

        $query = $this->db->get_where('eop_view_entities', $conditions);
        $resultsArray = $query->result_array();



        if($recursive){ // If recursive entity requested

            if(is_array($resultsArray) && count($resultsArray) >0){
                 return $this->arrangeEntities($resultsArray);
            }else{
                return array();
            }

        }else{ // Return simple array list of entities
            return $resultsArray;
        }

    }

    /**
     * @param array $entityRowsArray simple list array of entities
     * @return array recursively structured array of entities
     */
    private function arrangeEntities(&$entityRowsArray){


        //For each Entity record, get its children and organise array into proper hierarchy
        //Recursively arrange the directory structure of elements...
        foreach($entityRowsArray as $key => &$entityRow){
            $children = $this->getChildren($entityRow['id']);
            $fields = $this->getFields($entityRow['id']);

            if(!array_key_exists('children', $entityRow)){
                $entityRow['children'] = $children;
            }
            if(!array_key_exists('fields', $entityRow)){
                $entityRow['fields'] = $fields;
            }else{
                $entityRow['fields'] .= $fields;
            }
        }
        return $entityRowsArray;
    }

    private function getChildren($id){
        $children = array();

        $query = $this->db->get('eop_view_entities');

        $resultArray = $query->result_array();

        foreach($resultArray as $value){
            if($value['parent']==$id){

                if(!array_key_exists('children', $value)){
                    $value['children'] = $this->getChildren($value['id']);
                    $value['fields'] = $this->getFields($value['id']);
                }

                array_push($children, $value);
            }
        }

        return $children;
    }

    public function getFields($id){

        $query = $this->db->get_where('eop_field', array('entity_id'=>$id));
        return $query->result_array();
    }

    public function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update('eop_entity', $data);

        return $this->db->affected_rows();

    }
}