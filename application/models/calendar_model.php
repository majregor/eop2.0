<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }


    function addEvent($data){

        $this->db->insert('eop_calendar', $data);
        $affected_rows = $this->db->affected_rows();

        return $affected_rows;
    }

    function deleteEvent($id){
        $this->db->delete('eop_calendar', array('id'=>$id));
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

    function getEvents($data=''){

        if($data ==''){

            $this->db->select("id, title, body,  start_time , end_time, location")
                ->from('eop_calendar');

            $query = $this->db->get();
            $resultsArray = $query->result_array();
        }else{

            $conditions=$data;
            $query = $this->db->get_where('eop_calendar', $conditions);

            $resultsArray = $query->result_array();
        }

        $eventsData = array();

        if(is_array($resultsArray) && count($resultsArray)>0){
            foreach($resultsArray as $result){
                $eventsData[] = array(
                    'id'        =>  $result['id'],
                    'title'     =>  $result['title'],
                    'body'      =>  $result['body'],
                    'start'     =>  $result['start_time'],
                    'end'       =>  $result['end_time'],
                    'location'  =>  $result['location']
                );
            }
        }
        return $eventsData;
    }

    function getEvent($id){
        if(!empty($id)){
            $this->db->select("id, title, body, start_time, end_time, location")
                ->from('eop_calendar')
                ->where(array('id'=>$id));

            $query = $this->db->get();

            $resultArray = $query->result_array();

            return $resultArray[0];
        }
        else{
            return array();
        }
    }

    function updateEvent($id, $data){
        $this->db->where('id', $id);
        $this->db->update('eop_calendar', $data);

        return $this->db->affected_rows();
    }

}