<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {

    public $data = array();

    public function __construct(){
        parent::__construct();

        // Load  modules
        $this->load->model('migrate_model');

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

                    $feedback = array();
                    $this->migrate_user_data($db_obj);
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
     * @return array
     */
    private function migrate_user_data($db_obj){
        header('Content-Type: text/octet-stream');
        header('Cache-Control: no-cache');

        $messages = array();
        $serverTime = time();

        $obsolete_users_data = $this->migrate_model->getObsoleteUsers($db_obj);

        if(is_array($obsolete_users_data) && count($obsolete_users_data)>0){ //If records  are returned
            $num_recs = count($obsolete_users_data);
            $processedRecs = 0;

            foreach($obsolete_users_data as $key=>$record){
                $processedRecs ++;

                $percentage = ceil(($processedRecs / $num_recs) * 100);
                //Copy record data into new database


                $this->send_message($serverTime, $percentage . '% user data migration complete. server time: ' . date("h:i:s", time()) , $percentage);

                sleep(1);

            }


        }else{

            $messages = array(
                'status'    =>  'error',
                'message'   =>  "User table 'tbl_user' was empty! No user data was migrated"
            );
        }

    }

    public function feed(){
        $this->template->set('page_title', 'Data Migration');
        $data = array(
            'page'  =>  'feedback'
        );
        $this->template->load('migrate/template', 'migrate/feedback', $data);
    }


    /**
     * Function returns JSON formatted install progress information to AJAX calls
     */
    public function stream()
    {
        //type octet-stream. make sure apache does not gzip this type, else it would get buffered
        //header('Content-Type: text/octet-stream');
        header('Cache-Control: no-cache'); // recommended to prevent caching of event data.



        $serverTime = time();

        //LONG RUNNING TASK
        for($i = 0; $i < 10; $i++)
        {
            //Hard work!!
            sleep(1);

            //send status message
            $p = ($i+1)*10; //Progress

            $this->send_message($serverTime, $p . '% complete. server time: ' . date("h:i:s", time()) , $p);
        }
        sleep(1);
        $this->send_message($serverTime, 'message','COMPLETE');

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