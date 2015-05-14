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

        $this->load->model('user_model');
	}

	public function index(){

        if($this->session->userdata('is_logged_in')){
            // If the user has already logged in take them to the home page
            redirect('/home');
        }
        else{
            $templateData = array(
                'page'          =>  'login',
                'page_title'    => 'Login'
            );
            //Load the login form page
            $this->template->load('template', 'login_screen', $templateData);
        }
	}

	public function validate(){
		$username 	= $this->input->post('username');
		$password 	= $this->input->post('password');

		$check	=	$this->user_model->validate($username, $password);

		if($check){ // Login credentials match
			$sessionData = array(
				'is_logged_in'	=>	TRUE,
				'username'		=>	$username
				);

			$this->session->set_userdata($sessionData);

			//$this->template->load('template', 'home_screen');
            //Redirect to the home page
            redirect('/home');
		}
		else{ // Login failed

		}
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