<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class Migrate_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->dbforge();

    }

    /**
     *
     * @param $db_obj
     * @return mixed
     */
    public function getObsoleteUsers($db_obj){

        $db_obj->select('A.*, C.code AS district, E.code school')
            ->from('tbl_user A')
            ->join('tbl_user_district B',       'A.id = B.user_id',         'left')
            ->join('tbl_district C',            'B.district_id = C.id',     'left')
            ->join('tbl_user_sub_district D',   'A.id = D.user_id',         'left')
            ->join('tbl_sub_district E',        'D.sub_district_id = E.id', 'left');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteDistricts($db_obj){

        $query = $db_obj->get('tbl_district');

        return $query->result_array();
    }

    public function getObsoleteSchools($db_obj){

        $db_obj->select('A.*, B.code AS district')
            ->from('tbl_sub_district A')
            ->join('tbl_district B', 'A.district_id = B.id');

        $query = $db_obj->get();

        return $query->result_array();
    }

    public function getObsoleteThs($db_obj){

        $db_obj->select('A.*, C.code AS school')
            ->from('tbl_th A')
            ->join('tbl_user_sub_district B', 'A.modified_by = B.user_id')
            ->join('tbl_sub_district C', 'B.sub_district_id = C.id');

        $query = $db_obj->get();

        return $query->result_array();
    }



}