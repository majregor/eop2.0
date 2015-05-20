<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/19/15
 * Time: 1:00 PM
 */

class Access extends CI_Controller{


    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            // Load the user_model that will handle most database operations
            $this->load->model('registry_model');
            $this->load->model('user_model');
            $this->load->model('district_model');
            $this->load->model('access_model');

            $host_state = $this->registry_model->getValue('host_state');
            $this->session->set_userdata('host_state', $host_state);

        }
        else{
            redirect('/login');
        }

    }

    public function index(){

        // Get the role access permissions for the logged in user
        $role = $this->user_model->getUserRole($this->session->userdata('user_id'));
        $stateWideStateAccess = $this->access_model->getStateWideStateAccess();

        $templateData = array(
            'page'                  =>  'district',
            'page_title'            =>  'District Management',
            'step_title'            =>  'Districts',
            'role'                  =>  $role,
            'stateWideStateAccess'  =>  $stateWideStateAccess
        );
        $this->template->load('template', 'state_access_screen', $templateData);
    }

    public function grant_statewide_access(){

        if($this->input->post('ajax')){
            $recs = $this->access_model->grantStatewideAccess();

            if(is_numeric($recs) && $recs>=1){ // We were successful
                $this->output->set_output('1');
            }else{
                $this->output->set_output('0');
            }

        }
        else{ // Do nothing

        }
    }

    public function revoke_statewide_access(){

        if($this->input->post('ajax')){
            $recs = $this->access_model->revokeStatewideAccess();

            if(is_numeric($recs) && $recs>=1){ // We were successful
                $this->output->set_output('1');
            }else{
                $this->output->set_output('0');
            }

        }
        else{ // Do nothing

        }
    }

}