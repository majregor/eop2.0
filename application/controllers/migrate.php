<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {

    public $data = array();

    public function __construct(){
        parent::__construct();
        $this->load->dbforge();

        // Load the registry module
        $this->load->model('registry_model');

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
        $this->template->load('migrate/template', 'migrate/home_screen', $data);
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

        $database_type  =   (!empty($this->input->post('$database_type'))) ? $this->input->post('$database_type') : 'mysql';
        $database_host  =   $this->input->post('$database_host');
        $database_name  =   $this->input->post('$database_name');
        $database_user_name =   $this->input->post('$database_user_name');
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
               print_r($db_obj->conn_id);
                if($db_obj === FALSE) {
                    echo (' not connected');
                }else{
                    echo ('connected');
                    echo($db_obj->error());
                }

                //$connected = $db_obj->initialize(); // Initialize the database connections
                /*if (!$connected) {                  //Test database connection before continuing


                }*/

            }catch(Exception $e){

                echo $e->getMessage();
            }

        }else{
            redirect('migrate');
        }
    }


    /**
     * Function returns JSON formatted install progress information to AJAX calls
     */
    public function getInstallProgress()
    {
        if ($this->input->post('ajax')) {
            $data = array(
                'current'   =>      $this->session->userdata('install_step'),
                'step1'     =>      ($this->session->userdata('pref_hosting_level'))? 'done':'',
                'step2'     =>      ($this->session->userdata('requirements_verified'))? 'done':'',
                'step3'     =>      ($this->session->userdata('database_settings_set'))? 'done':'',
                'step4'     =>      ($this->session->userdata('admin_account_set'))? 'done':'',
                'step5'     =>      ($this->session->userdata('step_finished'))? 'done':''
            );

            $this->output->set_output(json_encode($data));
        }
    }
}

/* End of file app.php */
/* Location: ./application/controllers/app.php */