<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('url');
		$this->load->model('userModel');
		$users = $this->userModel->getUser();
		// print_r($user);
		// die();
		// $this->load->view('welcome_message');
		$this->load->view('index_view2',['users'=>$users]);
	}

	public function create()
	{
		$this->load->view('signUp');
	}

	public function doSignUp()
	{
		$this->load->helper('URL');

		$this->form_validation->set_rules('name', 'Name', 'required');

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|md5');

		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]|md5');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');

		if ($this->form_validation->run())
		{

			$data = $this->input->post();
			unset($data['passconf']);
			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";
			// exit();
			$this->load->model('userModel');
			if($this->userModel->doSignUp($data)){

				$this->session->set_flashdata('msg','Sign up successfully');

			}else{

				$this->session->set_flashdata('msg','Fail to sign up');

			}

			return redirect('welcome');

		}
		else
		{

			$this->load->view('signUp');

		}

	}

	public function edit()
	{

		$this->load->view('edit');

	}
}
