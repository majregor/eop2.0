<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

	public $data = array();

	public function __construct(){
		parent::__construct();

	}

	public function index(){

		$this->template->load('template', 'login_screen');
	}

	public function validate(){
		$username 	= $this->input->post('username');
		$password 	= $this->input->post('password');

		$this->load->model('user_model');
		$check	=	$this->user_model->validate($username, $password);

		if($check){ // Login credentials match
			$sessionData = array(
				'is_logged_in'	=>	TRUE,
				'username'		=>	$username
				);

			$this->session->set_userdata($sessionData);
			$this->template->load('template', 'home_screen');
		}
		else{ // Login failed

		}
	}
}