<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
        $is_logged_in = FALSE;
        $is_installed = FALSE;

        /**
         *  Check if the application installation completed successfully
         */
        if(null !== $this->session->userdata('is_installed'))
            $is_installed = $this->session->userdata('is_installed');


        if($is_installed){
            /** Check if user is logged in */
            if (null !== $this->session->userdata('is_logged_in'))
                $is_logged_in = $this->session->userdata('is_logged_in');


            if($is_logged_in){
                //Set template data
                $this->template->set('title', 'About me');
                $this->template->load('template', 'intro');
            }
            else{
                $this->template->load('template', 'login_screen');
            }
        }
        else{

            // Walk user through installation process
            $this->template->set('title', 'EOP Assist Installation');
            $this->template->load('install/template', 'install/install_screen');
        }


	}

    /**
     * Echo PHP installation information on the server running the Web Application
     *
     * get to this by typing http://example.com/app/phpinfo in the browser.
     */
    public function phpinfo(){
        //phpinfo();
        $data['param']='foddo';
        $this->template->load('template', 'welcome_message', $data);
    }

}

/* End of file app.php */
/* Location: ./application/controllers/app.php */