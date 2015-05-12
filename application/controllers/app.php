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

        /**
         *  Check if the application installation completed successfully
         */
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

        // Load the registry module
        $this->load->model('registry_model');

        // installation progress variables
        $install_status = $this->registry_model->getValue('install_status');

        if($install_status == FALSE){ //Installation has never been started

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

                                $data['screen']    =   'database_settings';
                                $data['step']      =   'database_settings';

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