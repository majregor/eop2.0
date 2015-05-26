<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * School Controller Class
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

class School extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){
            // Load the user_model that will handle most database operations
            $this->load->model('registry_model');
            $this->load->model('user_model');
            $this->load->model('school_model');
            $this->load->model('access_model');

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
        $districts = $this->user_model->getDistricts($this->session->userdata('host_state'));
        //Get the districts available in the state
        $schools = $this->school_model->getSchools($this->registry_model->getValue('host_state'));
        // Get all registered users
        $users = $this->user_model->getUsers();
         // Get the role access permissions for the logged in user
        $role = $this->user_model->getUserRole($this->session->userdata('user_id'));
        // Get the EOP access setting to the state
        $stateEOPAccess = $this->access_model->getStateAccess();

        if($role['level']<4){ // If not a Super, State or District admin don't load
            $templateData = array(
                'page'          =>  'school',
                'page_title'    =>  'School Management',
                'step_title'    =>  'Schools',
                'users'          => $users,
                'roles'         =>  $roles,
                'districts'     =>  $districts,
                'schools'       =>  $schools,
                'role'          =>  $role,
                'stateEOPAccess'=>  $stateEOPAccess
            );
            $this->template->load('template', 'school_screen', $templateData);
        }
        else{ // Redirect to user management with error message
            $this->session->set_flashdata('error', " Sorry you've been redirected here because you don't have access to School Management resource!");
            redirect('/user');
        }


    }

    /**
     *  Function used to reload /school page on a ajax call
     */
     private function ajax_reload(){
        $templateData = array(
            'page'          =>  'school',
            'page_title'    =>  'School Management',
            'step_title'    =>  'Schools'
        );
        return $this->template->load('template', 'school_screen', $templateData, true);
    }

    public function add(){

        // Check if there is data submitted
        $submitted = is_null($this->input->post('school_form_submit'))? FALSE : $this->input->post('school_form_submit');

        if($submitted){ // Form has been submitted
            // Process the data and add to the database
            $data = array(

                'name'            =>  $this->input->post('school_name'),
                'screen_name'     =>  $this->input->post('screen_name'),
                'district_id'     =>  $this->input->post('sltdistrict')
            );

            if($this->session->userdata['role']['level'] == 3){ //District admin is adding school, make the default  district be the same as the district admin
                $districtRow = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
                $data['district_id'] = $districtRow[0]['did'];
            }

            $savedRecs = $this->school_model->addSchool($data);

            if(is_numeric($savedRecs) && $savedRecs>=1){
                $this->session->set_flashdata('success', ' New School Added Successfully');
            }
            else{
                $this->session->set_flashdata('error', ' School creation failed!');
            }

            redirect('/school');
        }
        else{ // No form submitted, prompt with the user addition form

            //Get the User roles available
            $roles = $this->user_model->getAllRoles();
            //Get the districts available in the state
            $districts = $this->user_model->getDistricts($this->session->userdata('host_state'));
            //Get the districts available in the state
            $schools = $this->school_model->getSchools($this->session->userdata('host_state'));
            // Get all registered users
            $users = $this->user_model->getUsers();
             // Get the role access permissions for the logged in user
            $role = $this->user_model->getUserRole($this->session->userdata('user_id'));
            // Get the EOP access setting to the state
            $stateEOPAccess = $this->access_model->getStateAccess();

            $templateData = array(
                'page'          =>  'users',
                'page_title'    =>  'User Management',
                'step_title'    =>  'Create User',
                'viewform'      =>  true,
                'roles'         =>  $roles,
                'districts'     =>  $districts,
                'schools'       =>  $schools,
                'users'         =>  $users,
                'role'          =>  $role,
                'stateEOPAccess'=>  $stateEOPAccess
            );
            $this->template->load('template', 'school_screen', $templateData);
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
                'id'               =>   $this->input->post('school_id'),
                'name'             =>   $this->input->post('school_name'),
                'screen_name'      =>   $this->input->post('screen_name')
            );
            $savedRecs = $this->school_model->update($data);

            if(is_numeric($savedRecs) && $savedRecs>=1){
                $this->session->set_flashdata('success', 'School profile updated successfully');
            }
            else{
                $this->session->set_flashdata('error', ' School profile update failed!');
            }

            $this->output->set_output($this->ajax_reload());
        }
        else{ // Do nothing

        }
    }


}