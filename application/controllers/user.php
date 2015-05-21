<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User Controller Class
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

class User extends CI_Controller{


    public function __construct(){
        parent::__construct();

        if($this->session->userdata('is_logged_in')){

            $this->load->model('registry_model');
            // Load the user_model that will handle most database operations
            $this->load->model('user_model');
            $this->load->model('school_model');

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
        $schools = $this->school_model->getSchools($this->session->userdata('host_state'));
        // Get all registered users
        $users = $this->user_model->getUsers();
         // Get the role access permissions for the logged in user
        $role = $this->user_model->getUserRole($this->session->userdata('user_id'));

        $templateData = array(
            'page'          =>  'users',
            'page_title'    =>  'User Management',
            'step_title'    =>  'Users',
            'users'          => $users,
            'roles'         =>  $roles,
            'districts'     =>  $districts,
            'schools'       =>  $schools,
            'role'          =>  $role

        );
        $this->template->load('template', 'users_screen', $templateData);
    }

    /**
     *  Function used to reload /user page on a ajax call
     */
     private function ajax_reload(){
        $templateData = array(
            'page'          =>  'users',
            'page_title'    =>  'User Management',
            'step_title'    =>  'Users'
        );
        return $this->template->load('template', 'users_screen', $templateData, true);
    }

    public function add(){

        // Check if there is data submitted
        $submitted = is_null($this->input->post('user_form_submit'))? FALSE : $this->input->post('user_form_submit');

        if($submitted){ // Form has been submitted
            // Process the data and add to the database

            $data = array(
                'role_id'       =>  $this->input->post('slctuserrole'),
                'first_name'    =>  $this->input->post('first_name'),
                'last_name'     =>  $this->input->post('last_name'),
                'email'         =>  $this->input->post('email'),
                'username'      =>  $this->input->post('username'),
                'password'      =>  md5($this->input->post('user_password')),
                'phone'         =>  $this->input->post('phone'),
                'district'      =>  ($this->input->post('sltdistrict') == FALSE) ? '' : $this->input->post('sltdistrict'),
                'school'        =>  ($this->input->post('sltschool') == FALSE) ? '' : $this->input->post('sltschool'),
                'read_only'     =>  $this->input->post('user_access_permission')
            );

            if($this->session->userdata['role']['level'] == 3){ //District admin is adding user, make the default user district be the same as the district admin
                $districtRow = $this->user_model->getUserDistrict($this->session->userdata('user_id'));
                $data['district'] = $districtRow[0]['did'];
            }
            if($this->session->userdata['role']['level'] == 4){ //School admin is adding user, make the default user school be the same as the school admin's
                $schoolRow = $this->user_model->getUserSchool($this->session->userdata('user_id'));
                $data['school'] = $schoolRow[0]['sid'];
            }

            $savedRecs = $this->user_model->addUser($data);

            if(is_numeric($savedRecs) && $savedRecs>=1){
                $this->session->set_flashdata('success', ' New User Added Successfully');
            }
            else{
                $this->session->set_flashdata('error', ' Failed to save user');
            }

            $templateData = array(
                'page'          =>  'users',
                'page_title'    =>  'User Management',
                'step_title'    =>  'Users'
            );

            redirect('/user');
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

            $templateData = array(
                'page'          =>  'users',
                'page_title'    =>  'User Management',
                'step_title'    =>  'Create User',
                'viewform'      =>  true,
                'roles'         =>  $roles,
                'districts'     =>  $districts,
                'schools'       =>  $schools,
                'users'         =>  $users,
                'role'          =>  $role
            );
            $this->template->load('template', 'users_screen', $templateData);
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
                'user_id'          =>   $this->input->post('user_id'),
                'first_name'       =>   $this->input->post('first_name'),
                'last_name'        =>   $this->input->post('last_name'),
                'email'            =>   $this->input->post('email'),
                'username'         =>   $this->input->post('username'),
                'phone'            =>   $this->input->post('phone'),
                'role_id'          =>   $this->input->post('role_id'),
                'school_id'        =>   $this->input->post('school_id'),
                'access'           =>   $this->input->post('access')
            );
            $savedRecs = $this->user_model->update($data);

            if(is_numeric($savedRecs) && $savedRecs>=1){ //Password reset successfully
                $this->session->set_flashdata('success', 'User profile updated successfully');
            }
            else{
                $this->session->set_flashdata('error', ' User profile update failed!');
            }

            $this->output->set_output($this->ajax_reload());
        }
        else{ // Do nothing

        }
    }


    /**
     * Reset Password Action
     * @method resetpwd Action that deals with resetting the user's password
     */
    public function resetpwd(){
        if($this->input->post('ajax')){ // If form was submitted using ajax

            $user_id        =   $this->input->post('user_id');
            $new_password   =   md5($this->input->post('new_password'));

            $savedRecs = $this->user_model->resetPwd($user_id, $new_password);

            if(is_numeric($savedRecs) && $savedRecs>=1){ //Password reset successfully
                $this->session->set_flashdata('success', 'Password was reset Successfully');
            }
            else{
                $this->session->set_flashdata('error', ' Password Reset Failed!');
            }

            $this->output->set_output($this->ajax_reload());

        }else{
            // Do nothing or return error prompt
        }
    }

    /**
    * Block user Action
    * @method block Action that blocks/deletes users
    */
    public function block(){
        if($this->input->post('ajax')){ // If the form was submitted using ajax

            $user_id    =   $this->input->post('user_id');

            $savedRecs = $this->user_model->block($user_id);

            if(is_numeric($savedRecs) && $savedRecs>=1){ //Password reset successfully
                $this->session->set_flashdata('success', 'User Blocked');
            }
            else{
                $this->session->set_flashdata('error', ' User blocking failed!');
            }

            $this->output->set_output($this->ajax_reload());
        }
        else{ // Do nothing

        }
    }

    /**
    * Unblock user Action
    * @method unblock Action that unblocks/restores users
    */
    public function unblock(){
        if($this->input->post('ajax')){ // If the form was submitted using ajax

            $user_id    =   $this->input->post('user_id');

            $savedRecs = $this->user_model->unblock($user_id);

            if(is_numeric($savedRecs) && $savedRecs>=1){ //Password reset successfully
                $this->session->set_flashdata('success', 'User Unblocked');
            }
            else{
                $this->session->set_flashdata('error', ' Operation failed!');
            }

            $this->output->set_output($this->ajax_reload());
        }
        else{ // Do nothing

        }
    }







}