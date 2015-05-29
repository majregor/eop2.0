<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Login
 *
 * A Controller Responsible for handling user authentication
 * - Access control (login and logout)
 */

class Login extends CI_Controller{

	public $data = array();

	public function __construct(){
		parent::__construct();
        $this->load->model('registry_model');
        $this->load->model('user_model');
        $this->load->model('school_model');
	}

	public function index(){

        $is_installed = $this->registry_model->getValue('install_status');

        if($is_installed){ // Check if app is installed
            if($this->session->userdata('is_logged_in')){
                // If the user has already logged in take them to the home page
                redirect('/home');
            }
            else{
                //Load the login form page
                $this->login_form();

            }
        }else{ // Redirect to app which will initiate the install process
            redirect('/app');
        }
        
	}

	public function validate(){
		$username 	= $this->input->post('username');
		$password 	= $this->input->post('password');

		$check	=	$this->user_model->validate($username, $password);

		if($check){ // Login credentials match

            $userStatus = $this->user_model->getStatus($username);

            if($userStatus == 'active'){ // User is active
                $sessionData = array(
                    'is_logged_in'	=>	TRUE,
                    'username'		=>	$username,
                    'role'          => $this->user_model->getUserRoleByUsername($username)
                );

                //Get the host state and add to session
                $this->session->set_userdata('host_state', $this->registry_model->getValue('host_state'));

                // Load user's school into session object for school users and school administrators
                if($sessionData['role']['level']>3){

                    $userRow = $this->user_model->getUser($username, 'username');
                    $this->school_model->attach_to_session($userRow[0]['school_id']);

                }


                $this->session->set_userdata($sessionData);

                //Redirect to the home page
                redirect('/home');
            }elseif($userStatus == 'blocked'){ // User is blocked

                //Create flash error message and send back to login page
                $this->session->set_flashdata('error', 'Your account has been blocked!');
                $this->login_form();
            }

		}
		else{ // Login failed

            //Create flash error message and send back to login page
            $this->session->set_flashdata('error', 'Login Failed: Invalid User Id or Password!');
            $this->login_form();
		}
	}

    /**
     * Action for loading the login form view
     */
    public function login_form(){

        $templateData = array(
            'page'          =>  'login',
            'page_title'    => 'Login'
        );

        $this->template->load('template', 'login_screen', $templateData);

    }

    /**
     * Action to signout/logout users
     * We will destroy the session object and redirect to login screen
     */
    public function signout(){

        // Destroy the entire session object
        $this->session->sess_destroy();

        if($this->input->post('ajax')){
            // Do something for ajax specific requests
        }
        else{
            // Do something for other non AJAX requests
        }


        // Redirect to home or login screen
        redirect('/login');

    }
}