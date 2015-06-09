<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan extends CI_Controller{

    public function __construct(){
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

        if($this->input->post('ajax')){
            $data = array(
                'name'      =>      $this->input->post('thname'),
                'title'     =>      $this->input->post('thname'),
                'owner'     =>      $this->session->userdata('user_id'),
                'sid'       =>      isset($this->session->userdata['loaded_school']['id']) ? $this->session->userdata['loaded_school']['id'] : null,
                'type_id'   =>      $this->plan_model->getEntityTypeId('th', 'name')
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

            $thData =null;
            $param = $this->input->post('param');

            if($param=='all' || $param==''){
                $thData = $this->plan_model->getEntities('th');
            }else{
                $p = array('id' =>$param);
                $thData = $this->plan_model->getEntities('th', $p);
            }

            $data= array(
                'thData' => $thData
            );

            $this->load->view('ajax/th', $data);


        }else{
            redirect('plan/step2/2');
        }
    }

    public function update($param='entity', $param2){

        if($param2=='th'){
            $id = $this->input->post('updateid');
            $data = array(
                'name'          =>  $this->input->post('updatetxtname')
            );

            $recs = $this->plan_model->update($id, $data);

            if(is_numeric($recs) && $recs>0){
                $this->session->set_flashdata('success','Record updated successfully!');
                redirect('plan/step2/2#errorDiv');
            }
            else{
                $this->session->set_flashdata('error','Update failed!');
                redirect('plan/step2/2#errorDiv');
            }
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