<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Team Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Team Responsible for:
 *
 * - Managing team members
 *
 *
 * Date: 6/02/15 02:34 PM
 *
 * (c) 2015 United States Department of Education
 */

class Upload extends CI_Controller{


    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){

        }
        else{
            redirect('/login');
        }
    }

    public function index(){
       $this->authenticate();

        $this->load->view('upload');
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