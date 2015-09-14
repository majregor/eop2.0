<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/8/15
 * Time: 1:03 PM
 */

class App_model extends CI_Model {

    var $tableFields = array();

    public function __construct(){
        parent::__construct();
        $this->load->dbforge();

        $this->tableFields= array(
            'eop_access_log'    =>  array(

                'id' => array(
                    'type'              => 'INT',
                    'constraint'        => 11,
                    'null'              => FALSE,
                    'auto_increment'    => TRUE
                ),
                'timestamp timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'body'      =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  256,
                    'default'       =>  NULL
                )
            ),
            'eop_activity_log'  =>  array(

                'id'    =>  array(
                    'type'              =>  'INT',
                    'constraint'        =>  11,
                    'null'              =>  FALSE,
                    'auto_increment'    =>  TRUE
                ),
                'timestamp timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'uid'           =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'entity_id'     =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'field_id'      =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  32,
                    'null'          =>  TRUE
                ),
                'activity'      =>  array(
                    'type'          =>  'INT',
                    'constraint'    =>  45,
                    'null'          =>  TRUE
                ),
                'body'          =>  array(
                    'type'          =>  'text',
                    'null'          =>  TRUE
                ),
                'description'   =>  array(
                    'type'          =>  'varchar',
                    'constraint'    =>  128,
                    'null'          =>  TRUE
                )
            ),
            'eop_calendar'      =>  array(
                'id'            =>  array(
                    'type'          =>  'INT',
                    ''
                ),
                'title',
                'body',
                'start_time',
                'end_time',
                'location',
                'modified_by',
                'modification_date',
                'allDay',
                'url',
                'className',
                'editable',
                'startEditable',
                'durationEditable',
                'rendering',
                'overlap',
                'source',
                'color',
                'backgroundColor',
                'borderColor',
                'textColor',
                'sid',
            ),

        );
    }

    /**
     *
     * @return mixed
     */
    public function createTable($table_name){

        switch ($table_name){

            case 'eop_access_log':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                var_dump($this->dbforge->create_table($table_name, TRUE));
                break;
            case 'eop_activity_log':
                $fields = $this->tableFields[$table_name];
                $this->dbforge->add_field($fields);
                $this->dbforge->add_key('id', TRUE);
                var_dump($this->dbforge->create_table($table_name, TRUE));
                break;
        }


        return array();
    }
}