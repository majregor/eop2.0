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

            $message = "Migrating Goals and Objectives for Threats and Hazards...";
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

                $fieldIds = array();
                $entityIds = array();
                $savedRecs = $this->plan_model->addThreatAndHazard($data, $entityIds, $fieldIds);

                $status = (is_numeric($savedRecs) && $savedRecs >=1) ? 'Success' : 'Failure';

                if(is_numeric($savedRecs) && $savedRecs >= 1){

                    $condition = array('name'=>$record['name']);
                    $migrated_th = $this->plan_model->getEntities('th', $condition, true, array('orderby'=>'timestamp', 'type'=>'DESC'));

                    if(!empty($migrated_th) && is_array($migrated_th)) {

                        $goalData = $this->migrate_model->getTHData($db_obj, $record['id']);

                        if(is_array($goalData) && count($goalData)>0){

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

                            foreach($goalData as $goalRecords){

                                //Deal with goal 1
                                $g1 = $goalRecords['g1'];
                                if(is_array($g1) && count($g1)>0){
                                    $parent = $g1['parent'];
                                    if(count($parent)>0){
                                        $this->plan_model->updateField($fieldIds['g1']['goal'], array('body'=>$parent[0]['g1']));

                                        //add goal's function
                                        $fndata = array(
                                            'name'      =>      $parent[0]['fn_name'],
                                            'title'     =>      $parent[0]['fn_name'],
                                            'parent'    =>      $entityIds['g1'],
                                            'owner'     =>      $this->session->userdata('user_id'),
                                            'sid'       =>      $school[0]['id'],
                                            'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                                        );
                                        $this->plan_model->addTHFn($fndata);
                                    }

                                    //Courses of action only existed for  goal 1
                                    $course_of_action = $goalRecords['ca'];
                                    if(count($course_of_action)>0){
                                        $this->plan_model->updateField($fieldIds['g1']['course_of_action'], array('body'=>$course_of_action[0]['action_text']));
                                    }

                                    //Loop through objectives and insert respective fields and function data
                                    $objectives = $g1['objectives'];
                                    if(is_array($objectives) && count($objectives)>0){
                                        foreach($objectives as $key => $objective){

                                            $entityId = null;

                                            if($key == 0){ //first goal objective should already exist
                                                $entityId = $entityIds['g1Obj'];
                                                $this->plan_model->updateField($fieldIds['g1']['objective'], array('body'=>$objective['obj']));
                                            }else{

                                                //Create new entity and field
                                                $entityData = array(
                                                    'name'      =>      'Goal 1 Objective',
                                                    'title'     =>      'Objective',
                                                    'owner'     =>      $this->session->userdata('user_id'),
                                                    'sid'       =>      $school[0]['id'],
                                                    'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                                                    'parent'    =>      $entityIds['g1'],
                                                    'weight'    =>      $key
                                                );
                                                $entityId = $this->plan_model->addEntity($entityData);

                                                $fieldData = array(
                                                    'entity_id' =>      $entityId,
                                                    'name'      =>      'Objective Field',
                                                    'title'     =>      'Objective',
                                                    'weight'    =>      1,
                                                    'type'      =>      'text',
                                                    'body'      =>      $objective['obj']
                                                );
                                                $this->plan_model->addField($fieldData);
                                            }

                                            //add objective's function
                                            $fnData = array(
                                                'name'      =>  $objective['fn_name'],
                                                'title'     =>  $objective['fn_name'],
                                                'parent'    =>  $entityId,
                                                'owner'     =>  $this->session->userdata('user_id'),
                                                'sid'       =>  $school[0]['id'],
                                                'type_id'   =>  $this->plan_model->getEntityTypeId('fn', 'name')
                                            );
                                            $this->plan_model->addTHFn($fnData);
                                        }
                                    }


                                }

                                //Deal with goal 2
                                $g2 = $goalRecords['g2'];
                                if(is_array($g2) && count($g2)>0){
                                    $parent = $g2['parent'];
                                    if(count($parent)>0){
                                        $this->plan_model->updateField($fieldIds['g2']['goal'], array('body'=>$parent[0]['g2']));

                                        //add goal's function
                                        $fndata = array(
                                            'name'      =>      $parent[0]['fn_name'],
                                            'title'     =>      $parent[0]['fn_name'],
                                            'parent'    =>      $entityIds['g2'],
                                            'owner'     =>      $this->session->userdata('user_id'),
                                            'sid'       =>      $school[0]['id'],
                                            'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                                        );
                                        $this->plan_model->addTHFn($fndata);
                                    }

                                    $objectives = $g2['objectives'];
                                    //Loop through objectives and insert respective fields and function data
                                    if(is_array($objectives) && count($objectives)>0){
                                        foreach($objectives as $key => $objective){

                                            $entityId = null;

                                            if($key == 0){ //first goal objective should already exist
                                                $entityId = $entityIds['g2Obj'];
                                                $this->plan_model->updateField($fieldIds['g2']['objective'], array('body'=>$objective['obj']));
                                            }else{

                                                //Create new entity and field
                                                $entityData = array(
                                                    'name'      =>      'Goal 2 Objective',
                                                    'title'     =>      'Objective',
                                                    'owner'     =>      $this->session->userdata('user_id'),
                                                    'sid'       =>      $school[0]['id'],
                                                    'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                                                    'parent'    =>      $entityIds['g2'],
                                                    'weight'    =>      $key
                                                );
                                                $entityId = $this->plan_model->addEntity($entityData);

                                                $fieldData = array(
                                                    'entity_id' =>      $entityId,
                                                    'name'      =>      'Objective Field',
                                                    'title'     =>      'Objective',
                                                    'weight'    =>      1,
                                                    'type'      =>      'text',
                                                    'body'      =>      $objective['obj']
                                                );
                                                $this->plan_model->addField($fieldData);
                                            }

                                            //add objective's function
                                            $fnData = array(
                                                'name'      =>  $objective['fn_name'],
                                                'title'     =>  $objective['fn_name'],
                                                'parent'    =>  $entityId,
                                                'owner'     =>  $this->session->userdata('user_id'),
                                                'sid'       =>  $school[0]['id'],
                                                'type_id'   =>  $this->plan_model->getEntityTypeId('fn', 'name')
                                            );
                                            $this->plan_model->addTHFn($fnData);
                                        }
                                    }

                                }

                                //Deal with goal 3
                                $g3 = $goalRecords['g3'];
                                if(is_array($g3) && count($g3)>0){
                                    $parent = $g3['parent'];
                                    if(count($parent)>0){
                                        $this->plan_model->updateField($fieldIds['g3']['goal'], array('body'=>$parent[0]['g3']));

                                        //add goal's function
                                        $fndata = array(
                                            'name'      =>      $parent[0]['fn_name'],
                                            'title'     =>      $parent[0]['fn_name'],
                                            'parent'    =>      $entityIds['g3'],
                                            'owner'     =>      $this->session->userdata('user_id'),
                                            'sid'       =>      $school[0]['id'],
                                            'type_id'   =>      $this->plan_model->getEntityTypeId('fn', 'name')
                                        );
                                        $this->plan_model->addTHFn($fndata);
                                    }



                                    $objectives = $g3['objectives'];
                                    //Loop through objectives and insert respective fields and function data
                                    if(is_array($objectives) && count($objectives)>0){
                                        foreach($objectives as $key => $objective){

                                            $entityId = null;

                                            if($key == 0){ //first goal objective should already exist
                                                $entityId = $entityIds['g3Obj'];
                                                $this->plan_model->updateField($fieldIds['g3']['objective'], array('body'=>$objective['obj']));
                                            }else{

                                                //Create new entity and field
                                                $entityData = array(
                                                    'name'      =>      'Goal 3 Objective',
                                                    'title'     =>      'Objective',
                                                    'owner'     =>      $this->session->userdata('user_id'),
                                                    'sid'       =>      $school[0]['id'],
                                                    'type_id'   =>      $this->plan_model->getEntityTypeId('obj', 'name'),
                                                    'parent'    =>      $entityIds['g3'],
                                                    'weight'    =>      $key
                                                );
                                                $entityId = $this->plan_model->addEntity($entityData);

                                                $fieldData = array(
                                                    'entity_id' =>      $entityId,
                                                    'name'      =>      'Objective Field',
                                                    'title'     =>      'Objective',
                                                    'weight'    =>      1,
                                                    'type'      =>      'text',
                                                    'body'      =>      $objective['obj']
                                                );
                                                $this->plan_model->addField($fieldData);
                                            }

                                            //add objective's function
                                            $fnData = array(
                                                'name'      =>  $objective['fn_name'],
                                                'title'     =>  $objective['fn_name'],
                                                'parent'    =>  $entityId,
                                                'owner'     =>  $this->session->userdata('user_id'),
                                                'sid'       =>  $school[0]['id'],
                                                'type_id'   =>  $this->plan_model->getEntityTypeId('fn', 'name')
                                            );
                                            $this->plan_model->addTHFn($fnData);
                                        }
                                    }

                                }
                            }
                        }
                    }
                }


                $this->send_message($serverTime, $percentage . '% school data migration complete. server time: ' . date("h:i:s", time()) . " [$status]", $percentage);

                sleep(1);

            }


        }else{

            //No data
            $message = "Migrating Threats and Hazards...";
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);

        }

    }

    private function migrate_fn_data($db_obj){


        $serverTime = time();

        $obsolete_fn_data = $this->migrate_model->getObsoleteFns($db_obj);


        if(is_array($obsolete_fn_data) && count($obsolete_fn_data)>0){ //If records  are returned

            $num_recs = count($obsolete_fn_data);
            $processedRecs = 0;

            $message = "Migrating Goals and Objectives for Functions... ";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            foreach($obsolete_fn_data as $key=>$record){
                $processedRecs ++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);

                $school = $this->school_model->getSchoolByName($record['school']);
                $migrated_fn = $this->plan_model->getEntities('fn', array('parent is not null'=> Null, 'name'=>$record['fn_name'],'sid'=>$school[0]['id']), false);


                if(is_array($migrated_fn) && count($migrated_fn)>0){

                    $migrated_fn_record = $migrated_fn[0]; //Get only the first record we need one unique function
                    $goalData = $this->migrate_model->getFNData($db_obj, $record['id']);

                    if(is_array($goalData) && count($goalData)>0){

                        foreach($goalData as $goalRecords){


                            //Deal with goal 1
                            $g1 = $goalRecords['g1'];


                            $goal1Data= array(
                                'name'      =>      'Goal 1',
                                'title'     =>      'Goal 1 (Before)',
                                'owner'     =>      $this->session->userdata('user_id'),
                                'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                                'type_id'   =>      $this->plan_model->getEntityTypeId('g1', 'name'),
                                'parent'    =>      $migrated_fn_record['id'],
                                'weight'    =>      1
                            );
                            $insertedGoalId = $this->plan_model->addEntity($goal1Data);

                            //Add Course of action entity for only goal 1
                            $course_of_action = $goalRecords['ca'];
                            $courseOfActionData = array(
                                'name'      =>      'Goal 1 FN Course of Action',
                                'title'     =>      'Course of Action',
                                'owner'     =>      $this->session->userdata('user_id'),
                                'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                                'type_id'   =>      $this->getEntityTypeId('ca', 'name'),
                                'parent'    =>      $insertedGoalId,
                                'weight'    =>      1
                            );

                            $newCourseofActionId = $this->plan_model->addEntity($courseOfActionData);

                            $fieldData = array(
                                'entity_id' =>      $newCourseofActionId,
                                'name'      =>      'Goal 1 FN Course of Action Field',
                                'title'     =>      'Goal 1 FN Course of Action Field',
                                'weight'    =>      1,
                                'type'      =>      'text',
                                'body'      =>      $course_of_action[0]['action_text']
                            );
                            $this->plan_model->addField($fieldData);

                            $parent = $g1['parent'];
                            if(count($parent)>0){
                                // add goal 1 field data
                                $goal1FieldData = array(
                                    'entity_id' =>      $insertedGoalId,
                                    'name'      =>      'Goal 1 Function Field',
                                    'title'     =>      'Goal 1 Function Field',
                                    'weight'    =>      1,
                                    'type'      =>      'text',
                                    'body'      =>      $parent[0]['g1']
                                );
                                $this->plan_model->addField($goal1FieldData);
                            }

                            //Objectives
                            //Loop through objectives and insert respective fields data
                            $objectives = $g1['objectives'];
                            if(is_array($objectives) && count($objectives)>0) {
                                foreach ($objectives as $key => $objective) {

                                    //Create new entity and field
                                    $entityData = array(
                                        'name' => 'Goal 1 Objective',
                                        'title' => 'Objective',
                                        'owner' => $this->session->userdata('user_id'),
                                        'sid' => $school[0]['id'],
                                        'type_id' => $this->plan_model->getEntityTypeId('obj', 'name'),
                                        'parent' => $insertedGoalId,
                                        'weight' => $key
                                    );
                                    $entityId = $this->plan_model->addEntity($entityData);

                                    $fieldData = array(
                                        'entity_id' => $entityId,
                                        'name' => 'Objective Field',
                                        'title' => 'Objective',
                                        'weight' => 1,
                                        'type' => 'text',
                                        'body' => $objective['obj']
                                    );
                                    $this->plan_model->addField($fieldData);

                                }
                            }



                            //Deal with goal 2
                            $g2 = $goalRecords['g2'];


                            $goal2Data= array(
                                'name'      =>      'Goal 2',
                                'title'     =>      'Goal 2 (Before)',
                                'owner'     =>      $this->session->userdata('user_id'),
                                'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                                'type_id'   =>      $this->plan_model->getEntityTypeId('g2', 'name'),
                                'parent'    =>      $migrated_fn_record['id'],
                                'weight'    =>      1
                            );
                            $insertedGoalId = $this->plan_model->addEntity($goal2Data);


                            $parent = $g2['parent'];
                            if(count($parent)>0){
                                // add goal 1 field data
                                $goal2FieldData = array(
                                    'entity_id' =>      $insertedGoalId,
                                    'name'      =>      'Goal 2 Function Field',
                                    'title'     =>      'Goal 2 Function Field',
                                    'weight'    =>      1,
                                    'type'      =>      'text',
                                    'body'      =>      $parent[0]['g2']
                                );
                                $this->plan_model->addField($goal2FieldData);
                            }

                            //Objectives
                            //Loop through objectives and insert respective fields data
                            $objectives = $g2['objectives'];
                            if(is_array($objectives) && count($objectives)>0) {
                                foreach ($objectives as $key => $objective) {

                                    //Create new entity and field
                                    $entityData = array(
                                        'name' => 'Goal 2 Objective',
                                        'title' => 'Objective',
                                        'owner' => $this->session->userdata('user_id'),
                                        'sid' => $school[0]['id'],
                                        'type_id' => $this->plan_model->getEntityTypeId('obj', 'name'),
                                        'parent' => $insertedGoalId,
                                        'weight' => $key
                                    );
                                    $entityId = $this->plan_model->addEntity($entityData);

                                    $fieldData = array(
                                        'entity_id' => $entityId,
                                        'name' => 'Objective Field',
                                        'title' => 'Objective',
                                        'weight' => 1,
                                        'type' => 'text',
                                        'body' => $objective['obj']
                                    );
                                    $this->plan_model->addField($fieldData);

                                }
                            }



                            //Deal with goal 3
                            $g3 = $goalRecords['g3'];


                            $goal3Data= array(
                                'name'      =>      'Goal 3',
                                'title'     =>      'Goal 3 (Before)',
                                'owner'     =>      $this->session->userdata('user_id'),
                                'sid'       =>      (!empty($school) && is_array($school)) ? $school[0]['id']: null,
                                'type_id'   =>      $this->plan_model->getEntityTypeId('g3', 'name'),
                                'parent'    =>      $migrated_fn_record['id'],
                                'weight'    =>      1
                            );
                            $insertedGoalId = $this->plan_model->addEntity($goal3Data);


                            $parent = $g3['parent'];
                            if(count($parent)>0){
                                // add goal 1 field data
                                $goal3FieldData = array(
                                    'entity_id' =>      $insertedGoalId,
                                    'name'      =>      'Goal 3 Function Field',
                                    'title'     =>      'Goal 3 Function Field',
                                    'weight'    =>      1,
                                    'type'      =>      'text',
                                    'body'      =>      $parent[0]['g3']
                                );
                                $this->plan_model->addField($goal3FieldData);
                            }

                            //Objectives
                            //Loop through objectives and insert respective fields data
                            $objectives = $g3['objectives'];
                            if(is_array($objectives) && count($objectives)>0) {
                                foreach ($objectives as $key => $objective) {

                                    //Create new entity and field
                                    $entityData = array(
                                        'name'      => 'Goal 3 Objective',
                                        'title'     => 'Objective',
                                        'owner'     => $this->session->userdata('user_id'),
                                        'sid'       => $school[0]['id'],
                                        'type_id'   => $this->plan_model->getEntityTypeId('obj', 'name'),
                                        'parent'    => $insertedGoalId,
                                        'weight'    => $key
                                    );
                                    $entityId = $this->plan_model->addEntity($entityData);

                                    $fieldData = array(
                                        'entity_id'     => $entityId,
                                        'name'          => 'Objective Field',
                                        'title'         => 'Objective',
                                        'weight'        => 1,
                                        'type'          => 'text',
                                        'body'          => $objective['obj']
                                    );
                                    $this->plan_model->addField($fieldData);
                                }
                            }
                        }
                    }
                }

                $this->send_message($serverTime, $percentage . '% school data migration complete. server time: ' . date("h:i:s", time()), $percentage);

                sleep(1);

            }


        }else{

            //No data
            $message = "Migrating Goals and Objectives for Functions...";
            $message .= "<br> Empty Data Set";
            $this->send_message($serverTime, $message, 0);
            sleep(1);

            $percentage = 100;
            $this->send_message($serverTime, $percentage . '% completed', $percentage);
            sleep(1);

        }

    }

    function test(){

        $config['hostname'] = 'localhost';
        $config['username'] = 'root';
        $config['password'] = 'glyde1';
        $config['database'] = 'db_sami_proj3';
        $config['dbdriver'] = strtolower('mysql');
        $config['dbprefix'] = "";
        $config['pconnect'] = FALSE;
        $config['db_debug'] = FALSE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = "";
        $config['char_set'] = "utf8";
        $config['dbcollat'] = "utf8_general_ci";

        $db_obj = $this->load->database($config, TRUE);
        $obsolete_th_data = $this->migrate_model->getObsoleteFns($db_obj);
        $newarr = array();

        foreach($obsolete_th_data as $key=>$record){

            $school = $this->school_model->getSchoolByName('First School');
            $newarr[] = $this->plan_model->getEntities('fn', array('parent is not null'=> Null, 'name'=>$school[0]['id'],'sid'=>$school[0]['id']), false);
            print_r($school);
        }

        //print_r($newarr);

    }

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