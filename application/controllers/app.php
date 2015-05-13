<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App extends CI_Controller {

    public $data = array();

	/**
	 * Index Page for this controller.
	 *
	 */

	public function index()
	{
        $is_logged_in = FALSE;
        $is_installed = FALSE;
//        $this->session->sess_destroy();


        /**
         *  Check if the application installation completed successfully
         */
        if($this->db->conn_id === FALSE){

            //echo $this->db->_error_message();
           //var_dump( $this->db->conn_id);
            echo 'Database not setup';
            echo $this->db->username;

        }
        else{
            // Load the registry module
            $this->load->model('registry_model');
        }


        if($this->session->userdata('is_installed'))
            $is_installed = $this->session->userdata('is_installed');


        if($is_installed){ // App is installed
            /** Check if user is logged in */
            if ($this->session->userdata('is_logged_in'))
                $is_logged_in = $this->session->userdata('is_logged_in');


            if($is_logged_in){
                //Set template data
                $this->template->set('title', 'Home');
                $this->template->load('template', 'intro');
            }
            else{
                $this->template->set('title', 'Login');
                $this->template->load('template', 'login_screen');
            }
        }
        else{ //App has never been installed

            //Call the install action to start the installation process
           $this->install();
        }
	}

    /**
    *   Install function action
    *   This action will walk the user through the app installation and config process
    */
    public function install(){


        // installation progress variables
        $install_started = $this->session->userdata('install_started');

        if($install_started === FALSE){ //Installation has never been started

            if(!$this->session->userdata('install_status')){ //Installation not started
                //Load the initial install screen view and set the session data status to install_started
                $this->template->set('title', 'EOP Assist Installation');
                $data['screen']    =   'hosting_level';
                $data['step']      =   'hosting_level';
                $this->session->set_userdata(array(
                    'install_status'        => 'started',
                    'install_step'          => 'hosting_level',
                    'install_step_status'   => 'initiated'
                ));

                $this->template->load('install/template', 'install/install_screen', $data);
            }
            else{

                $install_step = $this->session->userdata('install_step');

                switch($install_step){
                    case "hosting_level":
                        $install_step_status = $this->session->userdata('install_step_status');
                        if($install_step_status == 'initiated'){

                            if($this->input->post('ajax')){ // If form was submitted using ajax request

                                $data['screen'] =   'verify_requirements';
                                $data['step']   =   'verify_requirements';
                                $this->session->set_userdata(array(
                                    'pref_hosting_level'    => $this->input->post('pref_hosting_level'),
                                    'install_step'          => 'verify_requirements',
                                    'install_step_status'   => 'initiated'
                                ));

                                //$this->output->set_output(json_encode($data));
                                $d=$this->load->view('install/embeds/verify_requirements', $data, TRUE);
                                $this->output->set_output($d);
                            }
                            else{
                                $data['screen']     =   'hosting_level';
                                $data['step']       =   'hosting_level';
                                $this->template->set('title', 'EOP Assist Installation');
                                $this->template->load('install/template', 'install/install_screen', $data);

                            }
                        }
                        break;
                    case "verify_requirements":
                        $install_step_status = $this->session->userdata('install_step_status');

                        if($install_step_status == 'initiated'){
                            if($this->input->post('ajax')){ // If form is submitted using ajax

                                /**
                                 * Call method to inspect host system
                                 * The method will return an array of status messages
                                 */
                                //$statusMsgs = checkRequirements();


                                $data['screen'] =   'database_settings';
                                $data['step']   =   'database_settings';
                                $this->session->set_userdata(array(
                                    'requirements_verified'    => 'yes',
                                    'install_step'          => 'database_settings',
                                    'install_step_status'   => 'initiated'
                                ));

                                //$this->output->set_output(json_encode($data));
                                $this->output->set_output($this->load->view('install/embeds/database_settings', $data, TRUE));

                            }
                            else{
                                $data['screen']    =   'verify_requirements';
                                $data['step']      =   'verify_requirements';
                                $this->template->set('title', 'EOP Assist Installation');
                                $this->template->load('install/template', 'install/install_screen', $data);
                            }
                        }
                        else{

                        }
                        break;
                    case "database_settings":
                        $install_step_status = $this->session->userdata('install_step_status');

                        if($install_step_status == 'initiated'){
                            if($this->input->post('ajax')){ // If form is submitted using ajax

                                //Get form input and add to session
                                  $configs = array(
                                        'database' => array(
                                        'hostname'  =>  $this->input->post('host_name'),
                                        'username'  =>  $this->input->post('database_username'),
                                        'password'  =>  $this->input->post('database_password'),
                                        'database'  =>  $this->input->post('database_name')
                                        )
                                    );
                                  
                                  $this->session->set_userdata($configs);

                                /**
                                 * Write database settings into config file
                                 */
                                  $dbsetup = $this->mkconfig($configs);

                                  if(!$dbsetup['error']){ // If successfully written to config file

                                    // Load
                                    $data['screen'] =   'admin_account';
                                    $data['step']   =   'admin_account';
                                    $this->session->set_userdata(array(
                                        'database_settings_set'    => 'yes',
                                        'install_step'          => 'admin_account',
                                        'install_step_status'   => 'initiated'
                                    ));

                                    //$this->output->set_output(json_encode($data));
                                    $this->output->set_output($this->load->view('install/embeds/admin_account', $data, TRUE));

                                  }
                                  else{ // If saving to config file failed

                                    //Set  error message and reload step
                                    //$this->session->set_flashdata('error', $dbsetup['msg']);
                                    $data['screen']    =   'database_settings';
                                    $data['step']      =   'database_settings';
                                    $data['error']     =    $dbsetup['msg'];

                                    $this->output->set_output($this->load->view('install/embeds/database_settings', $data, TRUE));
                                  }

                            }
                            else{

                                $data['screen']    =   'database_settings';
                                $data['step']      =   'database_settings';

                                $this->template->set('title', 'EOP Assist Installation');
                                $this->template->load('install/template', 'install/install_screen', $data);
                            }
                        }
                        else{

                        }
                        break;
                    case "admin_account":
                        $install_step_status = $this->session->userdata('install_step_status');

                        if($install_step_status == 'initiated'){
                            if($this->input->post('ajax')){ // If form is submitted using ajax

                                /**
                                 * Connect to database and save the super admin settings
                                 *
                                 */
                                //$statusMsgs = checkRequirements();


                                $data['screen'] =   'finished';
                                $data['step']   =   'finished';
                                $this->session->set_userdata(array(
                                    'admin_account_set'    => 'yes',
                                    'install_step'          => 'finished',
                                    'install_step_status'   => 'initiated',
                                    'user_name'             => $this->input->post('user_name'),
                                    'user_email'            => $this->input->post('user_email'),
                                    'user_password'         => $this->input->post('user_password')
                                ));

                                //$this->output->set_output(json_encode($data));
                                $this->output->set_output($this->load->view('install/embeds/finished', $data, TRUE));

                            }
                            else{

                                $data['screen']    =   'admin_account';
                                $data['step']      =   'admin_account';

                                $this->template->set('title', 'EOP Assist Installation');
                                $this->template->load('install/template', 'install/install_screen', $data);
                            }
                        }
                        else{

                        }
                        break;
                    case "finished":
                        $install_step_status = $this->session->userdata('install_step_status');

                        if($install_step_status == 'initiated'){
                            if($this->input->post('ajax')){ // If form is submitted using ajax

                                /**
                                 * Connect to database and save the super admin settings
                                 *
                                 */
                                //$statusMsgs = checkRequirements();


                                $data['screen'] =   'finished';
                                $data['step']   =   'finished';
                                $this->session->set_userdata(array(
                                    'admin_account_set'    => 'yes',
                                    'install_step'          => 'finished',
                                    'install_step_status'   => 'initiated',
                                    'user_name'             => $this->input->post('user_name'),
                                    'user_email'            => $this->input->post('user_email'),
                                    'user_password'         => $this->input->post('user_password')
                                ));

                                //$this->output->set_output(json_encode($data));
                                $this->output->set_output($this->load->view('install/embeds/finished', $data, TRUE));

                            }
                            else{

                                $data['screen']    =   'finished';
                                $data['step']      =   'finished';

                                $this->template->set('title', 'EOP Assist Installation');
                                $this->template->load('install/template', 'install/install_screen', $data);
                            }
                        }
                        else{

                        }
                        break;
                }
            }


        }
        else{

            switch ($install_status) {
                case '':
                    # code...
                    break;
                
                default:
                    # code...
                    break;
            }


            $this->template->set('title', 'EOP Assist Installation Resumed');
        }
    }


    /**
     * Function that uses the file helper to make a config file from the preferred settings
     */

    public function mkconfig($configs){
        $this->load->helper('file');

          
        return make_config_file($configs);

    }
    /**
     * Echo PHP installation information on the server running the Web Application
     *
     * get to this by typing http://example.com/app/phpinfo in the browser.
     */
    public function phpinfo(){
        phpinfo();
    }

}

/* End of file app.php */
/* Location: ./application/controllers/app.php */