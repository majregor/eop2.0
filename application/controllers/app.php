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
        if(null !== $this->session->userdata('is_installed'))
            $is_installed = $this->session->userdata('is_installed');


        if($is_installed){ // App is installed
            /** Check if user is logged in */
            if (null !== $this->session->userdata('is_logged_in'))
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

            //Call the insall action to start the installation process
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

        if($install_status == FALSE){

             $this->template->set('title', 'EOP Assist Installation');
             $data['screen']    =   'hosting_level';
             $data['step']      =   'hosting_level';
            
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
        
        $this->template->load('install/template', 'install/install_screen', $data);
    }

    /**
     * Echo PHP installation information on the server running the Web Application
     *
     * get to this by typing http://example.com/app/phpinfo in the browser.
     */
    public function phpinfo(){
        //phpinfo();
        $data['param']='foddo';
        $this->template->load('template', 'welcome_message', $data);
    }

}

/* End of file app.php */
/* Location: ./application/controllers/app.php */