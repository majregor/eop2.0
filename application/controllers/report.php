<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Report Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Report Responsible for:
 *
 * - Creating EOP Report for export
 *
 *
 * Date: 6/26/15 02:34 PM
 *
 * (c) 2015 United States Department of Education
 */

class Report extends CI_Controller{


    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            //Load Libraries
            $this->load->library('simple_html_dom');
            $this->load->library('h2d_htmlconverter');
            $this->load->library('Html2Text');
            $this->load->librart('support_functions');

            //Load Models
            $this->load->model('school_model');
            $this->load->model('plan_model');
            $this->load->model('report_model');
        }
        else{
            redirect('/login');
        }
    }

    public function index(){

        $this->authenticate();
        $this->makeReport();

        $data = array();

        $templateData = array(
            'page'          =>  'myeop',
            'step_title'    =>  'MY EOP',
            'page_title'    =>  'My EOP',
            'page_vars'     =>  $data
        );
        $this->template->load('template', 'report_screen', $templateData);
    }

    public function makeReport(){

        //@todo Integrate h2d_htmlconverter

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