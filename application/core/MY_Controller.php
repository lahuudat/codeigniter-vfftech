<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $data = array();

	function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

	public function isLogin()
	{
		
		if (!isset($this->session->userdata['logged_in'])) {

	  		redirect(site_url("usersController/login"));

		} else {

			$id = ($this->session->userdata['logged_in']['id']);
			
			$email = ($this->session->userdata['logged_in']['email']);

			$this->data['user_id'] = $id;

			$this->data['email'] = $email;

		}

	}



}
