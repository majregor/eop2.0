<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan extends CI_Controller{

    public function __contruct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            $this->load->model('plan_model');

        }
        else{
            redirect('/login');
        }

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
     * Action to add new items
     *
     * @method add
     * @param string $param Optional Specifies nature of item to add default is entity
     * @param string $param2 Optional Specifies the type of the item or entity
     */
    public function add($param='entity', $param2=''){
        $this->authenticate();
        $this->load->model('plan_model');

        if($this->input->post('ajax')){
            $data = array(
                'name'      =>      $this->input->post('thname'),
                'title'     =>      $this->input->post('thname'),
                'owner'     =>      $this->session->userdata('user_id'),
                'sid'       =>      $this->session->userdata['loaded_school']['id']
                //'type_id'   =>      $this->plan_model->getEntityTypeId('th', 'name')
            );

            $savedRecs = $this->plan_model->addThreadAndHazard($data);

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

        }else{ //Redirect to step2_2
            redirect('plan/step2/2');
        }
    }

    public function showTh(){
        if($this->input->post('ajax')){
            $this->load->model('plan_model');

            $thData =null;
            $param = $this->input->post('param');

            if($param=='all' || $param==''){
                $memberData = $this->plan_model->getMembers();
            }else{
                $p = array('id' =>$param);
                $memberData = $this->plan_model->getMembers($p);
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