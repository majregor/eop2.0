<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan extends CI_Controller{

    public function __contruct(){
        parent::__construct();

        // Load the user_model that will handle most database operations
        $this->load->model('registry_model');
        $this->load->model('user_model');
        $this->load->model('district_model');
        $this->load->model('access_model');
        $this->load->model('school_model');

    }

    public function index(){
        //Make sure user is logged in
        $this->authenticate();

        $this->step1();
    }

    public function step1($step=1){

        $this->authenticate();

        $templateData = array(
            'page'          =>  'step1',
            'step'          =>  $step,
            'page_title'    =>  'step1',
            'step_title'    =>  'Planning Process',
        );
        $this->template->load('template', 'plan_screen', $templateData);
    }


    public function step2($step=1){

        $this->authenticate();

        $templateData = array(
            'page'          =>  'step2',
            'step'          =>  $step,
            'page_title'    =>  'step2',
            'step_title'    =>  'Planning Process',
        );
        $this->template->load('template', 'plan_screen', $templateData);
    }

    /**
     * Function checks if user is logged in, redirects to login page if not.
     * @method authenticate
     * @return void
     */
    function authenticate(){
        if($this->session->userdata('is_logged_in')){
            //do nothing
        }
        else{
            redirect('/login');
        }
    }
}