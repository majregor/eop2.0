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

class Team extends CI_Controller{


    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            $this->load->model('team_model');
            
        }
        else{
            redirect('/login');
        }
    }

    public function index(){

       $this->authenticate();
    }


    public function add(){
        if($this->input->post('ajax')){

            $data = array(
                'name'          =>  $this->input->post('name'),
                'title'         =>  $this->input->post('title'),
                'organization'  =>  $this->input->post('organization'),
                'email'         =>  $this->input->post('email'),
                'phone'         =>  $this->input->post('phone'),
                'interest'      =>  $this->input->post('interest'),
                'owner'         =>  $this->session->userdata('user_id')
            );



            if(null != $this->session->userdata['loaded_school']['id'] && isset($this->session->userdata['loaded_school']['id'])){
                $data['sid']    = $this->session->userdata['loaded_school']['id'];
            }

            if(null != $this->session->userdata['loaded_school']['district_id'] && isset($this->session->userdata['loaded_school']['district_id'])){
                $data['did']    = $this->session->userdata['loaded_school']['district_id'];
            }

            $savedRecs = $this->team_model->addMember($data);

            if(is_numeric($savedRecs) && $savedRecs>=1){
                $this->output->set_output(json_encode(array(
                    'saved' =>  TRUE
                )));
            }
            else{
                $this->output->set_output(json_encode(array(
                    'saved' =>  FALSE
                )));
            }

        }else{ // Redirect to plan step1_2
            redirect('plan/step1/2');
        }


    }

    /**
     * Show Action
     * Returns all team members that satisfy a given criteria
     * @method show
     * @param string param all|id of team member being requested
     *
     */
    public function show($param=''){
        if($this->input->post('ajax')){

            $memberData =null;
            $param = $this->input->post('param');

            if($param=='all' || $param==''){
                $memberData = $this->team_model->getMembers();
            }else{
                $p = array('id' =>$param);
                $memberData = $this->team_model->getMembers($p);
            }

            $data= array(
                'memberData' => $memberData
            );

            $this->load->view('ajax/team_members', $data);


        }else{
            redirect('plan/step1/2');
        }
    }

    /**
     *  Edit Action
     * @method update This method enables updates/edits of the user information
     *
     */
  
    public function update(){

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