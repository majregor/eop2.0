<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{

	public $data = array();

	public function __construct(){
		parent::__construct();

	}

	public function index(){

        if($this->session->userdata('is_logged_in')){

            // Load the home screen if the user is logged in
            $this->template->set('page_title', 'Home');
            $this->template->set('step_title', 'Getting Started');
            $data = array(
                'step'  =>  1
            );
            $this->template->load('template', 'home_screen', $data);
        }
        else{
            // Redirect to login for if not logged in
            redirect('/login');
        }

	}

    /**
     *  Action to load home steps pages
     * @method step
     * @param INT page number
     */
    public function step($step=1){
        if($this->session->userdata('is_logged_in')){

            $step = ($step<=3)? $step : 1;

            $this->template->set('page_title', 'Home');
            $this->template->set('step_title', 'Getting Started');
            $data = array(
                'step'  =>  $step
            );
            $this->template->load('template', 'home_screen', $data);
        }
        else{
            // Redirect to login for if not logged in
            redirect('/login');
        }
    }

}