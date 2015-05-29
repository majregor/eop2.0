<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * District Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Controller Responsible for:
 * - Access control (login and logout)
 * - User registration and management
 * - Permissions management
 * - User role management
 * - User session data management
 *
 *
 * Date: 5/01/15 11:47 AM
 *
 * (c) 2015 United States Department of Education
 */

class District extends CI_Controller{


    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            // Load the user_model that will handle most database operations
            $this->load->model('registry_model');
            $this->load->model('user_model');
            $this->load->model('district_model');

            $host_state = $this->registry_model->getValue('host_state');
            $this->session->set_userdata('host_state', $host_state);
            
        }
        else{
            redirect('/login');
        }

    }

    public function index(){

        //Get the User roles available
        $roles = $this->user_model->getAllRoles();
        //Get the districts available in the state
        $districts = $this->district_model->getDistricts($this->registry_model->getValue('host_state'));
        // Get all registered users
        $users = $this->user_model->getUsers();
         // Get the role access permissions for the logged in user
        $role = $this->user_model->getUserRole($this->session->userdata('user_id'));

        if($role['level']<4) { // If not a Super, State or District admin don't load
            $templateData = array(
                'page' => 'district',
                'page_title' => 'District Management',
                'step_title' => 'Districts',
                'users' => $users,
                'roles' => $roles,
                'districts' => $districts,
                'role' => $role
            );
            $this->template->load('template', 'district_screen', $templateData);
        }else{
            $this->session->set_flashdata('error', " Sorry you've been redirected here because you don't have access to District Management resource!");
            redirect('/user');
        }
    }

    /**
     *  Function used to reload /district page on a ajax call
     */
     private function ajax_reload(){
        $templateData = array(
            'page'          =>  'district',
            'page_title'    =>  'District Management',
            'step_title'    =>  'Districts'
        );
        return $this->template->load('template', 'district_screen', $templateData, true);
    }

    public function add(){

        // Check if there is data submitted
        $submitted = is_null($this->input->post('district_form_submit'))? FALSE : $this->input->post('district_form_submit');

        if($submitted){ // Form has been submitted
            // Process the data and add to the database
            $data = array(

                'name'            =>  $this->input->post('district_name'),
                'screen_name'     =>  $this->input->post('screen_name'),
                'state_val'       =>  $this->registry_model->getValue('host_state')
            );

            $savedRecs = $this->district_model->addDistrict($data);

            if(is_numeric($savedRecs) && $savedRecs>=1){
                $this->session->set_flashdata('success', ' New District Added Successfully!');
            }
            else{
                $this->session->set_flashdata('error', ' District creation failed!');
            }

            redirect('/district');
        }
        else{ // No form submitted, prompt with the district addition form

            //Get the User roles available
            $roles = $this->user_model->getAllRoles();
            //Get the districts available in the state
            $districts = $this->district_model->getDistricts($this->registry_model->getValue('host_state'));
            // Get all registered users
            $users = $this->user_model->getUsers();
             // Get the role access permissions for the logged in user
            $role = $this->user_model->getUserRole($this->session->userdata('user_id'));

            $templateData = array(
                'page'          =>  'district',
                'page_title'    =>  'District Management',
                'step_title'    =>  'Districts',
                'viewform'      =>  true,
                'users'          => $users,
                'roles'         =>  $roles,
                'districts'     =>  $districts,
                'role'          =>  $role
            );
            $this->template->load('template', 'district_screen', $templateData);
        }

    }

    /**
     *  Edit Action
     * @method update This method enables updates/edits of the user information
     *
     */
  
    public function update(){
        if($this->input->post('ajax')) { // If form was submitted using ajax

            $data = array(
                'id'               =>   $this->input->post('district_id'),
                'name'             =>   $this->input->post('district_name'),
                'screen_name'      =>   $this->input->post('screen_name')
            );
            $savedRecs = $this->district_model->update($data);

            if(is_numeric($savedRecs) && $savedRecs>=1){
                $this->session->set_flashdata('success', 'District profile updated successfully!');
            }
            else{
                $this->session->set_flashdata('error', ' District profile update failed!');
            }

            $this->output->set_output($this->ajax_reload());
        }
        else{ // Do nothing

        }
    }


}