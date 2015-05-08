<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User Controller Class
 *
 * Developed by Synergy Enterprises, Inc. for the U.S. Department of Education
 *
 * Controller Responsible for:
 * 1- Access control (login and logout)
 * 2- User registration and management
 * 3- Permissions management
 * 4- User role management
 * 5- User session data management
 *
 *
 * Date: 5/01/15 11:47 AM
 * Author: Godfrey Majwega
 *
 * (c) 2015 United States Department of Education
 */

class User extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
    }



    function validate_credentials(){

        $username   =   $this->input->post('username');
        $password   =   $this->input->post('password');

        if($this->user_model->validate($username, $password)){

            $data = array(
              'username'    => $this->input->post('username'),
                'is_logged_in' => true
            );

            $this->session->set_userdata($data);
        }
        else{

            $this->load->view('login_screen');

        }


    }

}