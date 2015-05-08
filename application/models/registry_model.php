<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class Registry_model extends CI_Model {

    private $id;
    private $key, $value;

    public function __construct(){
        parent::__construct();
    }

    public function setKey($key){
        $this->key = $key;
    }
    public function setValue($value){
        $this->value = $value;
    }


    function addEntry($key, $value){

    }

    function getAllEntries(){

    }

    function get($id){

    }

    function getKey($value){

    }

    function getValue($key){

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