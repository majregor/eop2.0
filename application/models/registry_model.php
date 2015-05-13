<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class Registry_model extends CI_Model {

    private $id;
    private $variables = array();

    public function __construct(){
        parent::__construct();
    }

    function addVariable($key, $value){

    }

    function addVariables($data){
        $recordsArray=array();
        foreach($data as $key=>$value){
            array_push($recordsArray, array(
                'key'       =>  $key,
                'value'     =>  $value));
        }


        $this->db->insert_batch('eop_registry', $recordsArray);
        return $this->db->affected_rows();

    }

    function getAllVariables(){

    }

    function getVariable($id){

    }

    function getValue($key){
        $sql = "SELECT * FROM eop_registry WHERE `key` = ? LIMIT 1"; 
        $query = $this->db->query($sql, array($key));

        if ($query->num_rows() > 0){
            return $query->row()->value;
        }
        else{
            return False;
        }
    }


    function hasKey($key){

    }

    function hasValue($value){

    }

    function update($key, $value){

    }

    function updateValue($value){

    }
    function updateKey($key){

    }

    function delete($key){

    }


}