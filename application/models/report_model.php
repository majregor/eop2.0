<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model {

    public function __construct(){
        parent::__construct();

        $this->load->model('school_model');
    }

    public function getSchoolsWithData(){

        $schools = null;

        $this->db->select('sid')
            ->distinct('sid')
            ->from('eop_view_entities')
            ->where(array('sid is not null'=>Null));

        $query = $this->db->get();

        $school_ids =  $query->result_array();

        if(is_array($school_ids) && count($school_ids)>0){
            foreach($school_ids as $key=>$school_id){
                $school = $this->school_model->getSchool($school_id['sid']);
                $school[0]['last_modified'] = $this->getLastModifiedDate($school_id['sid']);
                $schools[$key]= $school;
            }
        }

        return $schools;
    }

    public function getLastModifiedDate($sid){
        $this->db->select_max('timestamp')
                    ->from('eop_entity')
                    ->where(array('sid'=>$sid));
        $query = $this->db->get();

        return $query->result_array()[0]['timestamp'];

    }

    public function hasData($sid){
        $this->db->select('sid')
                ->distinct('sid')
                ->from('eop_view_entities')
                ->where(array('sid'=>$sid));
        $query = $this->db->get();

        $ret = count($query->result_array());

        if($ret>0)
            return true;
        else
            return false;
    }



}