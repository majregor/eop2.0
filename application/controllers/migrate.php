<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {

    public $data = array();

    public function __construct(){
        parent::__construct();

        // Load  modules
        $this->load->model('migrate_model');
        $this->load->model('registry_model');
        $this->load->model('district_model');
        $this->load->model('school_model');
        $this->load->model('user_model');
        $this->load->model('plan_model');

    }


	/**
	 * Index Page for this controller.
	 *
	 */

	public function index()
	{

        $this->template->set('page_title', 'Data Migration');
        $data = array(
            'page'  =>  'home'
        );
        $this->template->load('migrate/template', 'migrate/home', $data);
	}

    /**
    *   run function action
    *   This action will execute the data migration
     * 1- Initialize a database instance with the passed data
     * 2- Copy table values from the old database into the new database
    */
    public function run(){

        $form_name = $this->input->post('form_name');
        $db_obj = null;

        $database_type  =   (!empty($this->input->post('database_type'))) ? $this->input->post('database_type') : 'mysql';
        $database_host  =   $this->input->post('database_host');
        $database_name  =   $this->input->post('database_name');
        $database_user_name =   $this->input->post('database_user_name');
        $database_password  =   $this->input->post('database_password');



        if($form_name =="database_form"){ // If it's the right submitted form

            // Set the database configuration
            try{
                $config['hostname'] = $database_host;
                $config['username'] = $database_user_name;
                $config['password'] = $database_password;
                $config['database'] = $database_name;
                $config['dbdriver'] = strtolower($database_type);
                $config['dbprefix'] = "";
                $config['pconnect'] = FALSE;
                $config['db_debug'] = FALSE;
                $config['cache_on'] = FALSE;
                $config['cachedir'] = "";
                $config['char_set'] = "utf8";
                $config['dbcollat'] = "utf8_general_ci";

                $db_obj = $this->load->database($config, TRUE); // Load the database

                $connected = $db_obj->initialize(); // Initialize the database connections

                if (!$connected) {                  //Test database connection before continuing

                    $message = <<<EOF
                    Database connection failure! make sure the database <strong><em>$database_name</em></strong> exists and that the
                    user <em>$database_user_name</em> with the entered password has access privileges on the database.

EOF;

                    $this->session->set_flashdata('error', $message);
                    redirect('migrate');

                }else{

                    header('Content-Type: text/octet-stream');
                    header('Cache-Control: no-cache');

                    //Migrate district data
                    //$this->migrate_district_data($db_obj);

                    //Migrate school data
                    //$this->migrate_school_data($db_obj);

                    //Migrate user data
                    //$this->migrate_user_data($db_obj);

                    //Migrate threats & hazard data
                    $this->migrate_th_data($db_obj);
                }

            }catch(Exception $e){

                echo $e->getMessage();
            }

        }else{
            redirect('migrate');
        }
    }

    /**
     * @param $db_obj
     */
    private function migrate_district_data($db_obj){

        $serverTime = time();

        $obsolete_district_data = $this->migrate_model->getObsoleteDistricts($db_obj);

        if(is_array($obsolete_district_data) && count($obsolete_district_data) > 0){ //If records are returned

            $num_recs = count($obsolete_district_data);
            $processedRecs = 0;

            $message = "Migrating Districts...";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach($obsolete_district_data as $key=>$record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                //Copy record data into new database
                $data = array(

                    'name'            =>  $record['code'],
                    'screen_name'     =>  $record['display_name'],
                    'state_val'       =>  $this->registry_model->getValue('host_state')
                );

                $savedRecs = $this->district_model->addDistrict($data);

                $status = (is_numeric($savedRecs) && $savedRecs >=1) ? 'Success' : 'Failure';
                $this->send_message($serverTime, $percentage . '% user data migration complete. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);
            }
        }else{

            // No data

        }
    }

    /**
     * @param $db_obj
     */
    private function migrate_school_data($db_obj){

        $serverTime = time();

        $obsolete_school_data = $this->migrate_model->getObsoleteSchools($db_obj);


        if(is_array($obsolete_school_data) && count($obsolete_school_data) > 0){ //If records are returned

            $num_recs = count($obsolete_school_data);
            $processedRecs = 0;

            $message = "Migrating Schools...";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach($obsolete_school_data as $key=>$record) {
                $processedRecs++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);
                $district = $this->district_model->getDistrictByName($record['district']);

                //Copy record data into new database
                $data = array(

                    'name'            =>  $record['code'],
                    'screen_name'     =>  $record['display_name'],
                    'district_id'     =>  (!empty($district) && is_array($district)) ? $district[0]['id']: null
                );

                $savedRecs = $this->school_model->addSchool($data);

                $status = (is_numeric($savedRecs) && $savedRecs >=1) ? 'Success' : 'Failure';
                $this->send_message($serverTime, $percentage . '% school data migration complete. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);
            }
        }else{

            // No data

        }
    }


    /**
     * @param $db_obj
     * @return void
     */
    private function migrate_user_data($db_obj){


        $serverTime = time();

        $obsolete_users_data = $this->migrate_model->getObsoleteUsers($db_obj);

        if(is_array($obsolete_users_data) && count($obsolete_users_data)>0){ //If records  are returned

            $num_recs = count($obsolete_users_data);
            $processedRecs = 0;

            $message = "Migrating Users...";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach($obsolete_users_data as $key=>$record){
                $processedRecs ++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $district = $this->district_model->getDistrictByName($record['district']);
                $school = $this->school_model->getSchoolByName($record['school']);

                //Copy record data into new database
                $data = array(
                    'role_id'       =>  ($record['user_role'] == '01A') ? 3 : (($record['user_role'] == '02A') ? 4 : 5),
                    'first_name'    =>  $record['first_name'],
                    'last_name'     =>  $record['last_name'],
                    'email'         =>  $record['email'],
                    'username'      =>  $record['user_id'],
                    'password'      =>  $record['password'],
                    'phone'         =>  $record['phone_number'],
                    'district'      =>  (!empty($district) && is_array($district)) ? $district[0]['id']: '',
                    'school'        =>  (!empty($school) && is_array($school)) ? $school[0]['id']: '',
                    'read_only'     =>  'n'
                );

                $savedRecs = $this->user_model->addUser($data);

                $status = (is_numeric($savedRecs) && $savedRecs >=1) ? 'Success' : 'Failure';


                $this->send_message($serverTime, $percentage . '% school data migration complete. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }


        }else{

            //No data
        }

    }

    private function migrate_th_data($db_obj){


        $serverTime = time();

        $obsolete_th_data = $this->migrate_model->getObsoleteThs($db_obj);

        if(is_array($obsolete_th_data) && count($obsolete_th_data)>0){ //If records  are returned

            $num_recs = count($obsolete_th_data);
            $processedRecs = 0;

            $message = "Migrating Threats and Hazards...";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach($obsolete_th_data as $key=>$record){
                $processedRecs ++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);

                //Copy record data into new database
                $data = array(
                    'name'      =>      $record['th_name'],
                    'title'     =>      $record['th_name'],
                    'owner'     =>      $this->session->userdata('user_id'),
                    'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                    'type_id'   =>      $this->plan_model->getEntityTypeId('th', 'name')
                );

                $savedRecs = $this->plan_model->addThreatAndHazard($data);

                $status = (is_numeric($savedRecs) && $savedRecs >=1) ? 'Success' : 'Failure';

                if(is_numeric($savedRecs) && $savedRecs >= 1){ //todo continue working on Threats and hazard migration

                    $condition = array('name'=>$record['name']);
                    $migrated_th = $this->plan_model->getEntities('th', $condition, true, array('orderby'=>'timestamp', 'type'=>'DESC'));

                    if(!empty($migrated_th) && is_array($migrated_th)) {

                        //Add field to newly migrated TH to indicate that it has been initiated
                        $fieldData = array(
                            'entity_id' => $migrated_th[0]['id'],
                            'name' => 'TH Field',
                            'title' => 'Threats and Hazards Default Field',
                            'weight' => 1,
                            'type' => 'text',
                            'body' => ''
                        );

                        $recs = $this->plan_model->addField($fieldData);
                    }
                }


                $this->send_message($serverTime, $percentage . '% school data migration complete. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }


        }else{

            //No data
        }

    }

    /*function test(){

        $config['hostname'] = 'localhost';
        $config['username'] = 'root';
        $config['password'] = 'glyde1';
        $config['database'] = 'eop';
        $config['dbdriver'] = strtolower('mysql');
        $config['dbprefix'] = "";
        $config['pconnect'] = FALSE;
        $config['db_debug'] = FALSE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = "";
        $config['char_set'] = "utf8";
        $config['dbcollat'] = "utf8_general_ci";

        $db_obj = $this->load->database($config, TRUE);
        $obsolete_users_data = $this->migrate_model->getObsoleteThs($db_obj);

        print_r($obsolete_users_data);
        $school = $this->school_model->getSchoolByName('aasdfas');
        echo('<br>');
        print_r($school);
    }*/

    /**
    Send a partial message
     */
    function send_message($id, $message, $progress)
    {
        $d = array('message' => $message , 'progress' => $progress);

        echo json_encode($d) . PHP_EOL;

        //PUSH THE data out by all FORCE POSSIBLE
        ob_flush();
        flush();
    }

}

/* End of file app.php */
/* Location: ./application/controllers/app.php */