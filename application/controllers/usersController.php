<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// session_start();

class usersController extends MY_Controller {

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

		if (!isset($this->session->userdata['logged_in'])) {

			redirect(site_url("usersController/login"));

		} 

		$this->load->helper('url');

		$this->load->model('userModel');

		$users = $this->userModel->getUser();
		// print_r($user);
		// die();
		// $this->load->view('welcome_message');
		$this->load->view('usersView/index_view2',['users'=>$users]);
	}

	public function create()
	{

		if (isset($this->session->userdata['logged_in'])) {

			redirect(site_url("usersController"));

		} 

		$this->load->view('usersView/signUp');

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
			
			$this->load->model('userModel');

			if($this->userModel->doSignUp($data)){

				$this->session->set_flashdata('msg','Sign up successfully');

				return redirect('usersController/login');

			}else{

				$this->session->set_flashdata('msg','Fail to sign up');

			}

			return redirect('usersController/create');

		}
		else
		{

			$this->load->view('usersView/signUp');

		}

	}

	public function edit($id)
	{

		/*if (!isset($this->session->userdata['logged_in'])) {

			redirect(site_url("usersController/login"));

		}*/ 

		$this->isLogin();

		$this->load->model('userModel');

		$user=$this->userModel->editUser($id);

		$data = array_merge($this->data, ['user'=>$user]);

		$this->load->view('usersView/edit', $data);

	}

	public function doEdit($id)
	{

		$this->load->helper('URL');

		$this->load->library('upload');

		$config['upload_path'] = './images/';

		$config['allowed_types'] = 'gif|jpg|png';

		$this->upload->initialize($config);

		$field_name = "userImg";

		$this->form_validation->set_rules('name', 'Name', 'required');

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|md5');

		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]|md5');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() && $this->upload->do_upload($field_name))
		{

			$name = $this->input->post('name');

			$email = $this->input->post('email');

			$password = $this->input->post('password');

			$gambar = $this->upload->data();

			$data = ([
				'name'=>$name,
				'email'=>$email,
				'password'=>$password,
				'img'=>$gambar['file_name']

			]);

			
			
			$this->load->model('userModel');

			if($this->userModel->doEditUser($data,$id)){

				$this->session->set_flashdata('msg','Edit successfully');

			}else{

				$this->session->set_flashdata('msg','Fail to edit');

			}

			return redirect('usersController');

		}
		else
		{

			$this->load->model('userModel');

			$user=$this->userModel->editUser($id);

			$this->load->view('usersView/edit',['user'=>$user]);

		}

	}

	public function editPass($id){

		if (!isset($this->session->userdata['logged_in'])) {

			redirect(site_url("usersController/login"));

		} 

		// $this->load->model('userModel');

		// $user=$this->userModel->editUser($id);

		$this->load->view('usersView/editPass');

	}

	public function delete($id)
	{
		if (!isset($this->session->userdata['logged_in'])) {

			redirect(site_url("usersController/login"));

		} 

		$this->load->model('userModel');

		if($this->userModel->deleteUser($id)){

			$this->session->set_flashdata('msg','Delete successfully');

		}else{

			$this->session->set_flashdata('msg','Fail to delete');

		}

		return redirect('usersController');

	}

	public function searchUser()
	{
		
		if (!isset($this->session->userdata['logged_in'])) {

			redirect(site_url("usersController/login"));

		} 

		$keyword=$this->input->post('keyword');

		$this->load->model('userModel');

        $users = $this->userModel->search($keyword);
		
		$this->load->view('usersView/search',['users'=>$users, 'keyword'=>$keyword]);

	}

	public function login()
	{

	if (isset($this->session->userdata['logged_in'])) {

  		redirect(site_url("usersController"));

	} 


		$this->load->view('usersView/signIn');

	}

	public function doLogin()
	{

		$this->load->model('userModel');

		$this->form_validation->set_rules('email', 'Email', 'trim|required');

		$this->form_validation->set_rules('password', 'Password', 'trim|required|md5');

		if ($this->form_validation->run() == FALSE) {

			if(isset($this->session->userdata['logged_in'])){
				$this->load->view('index_view2');

			}else{

				$this->load->view('usersView/signIn');

			}

		} else {

			$data = array(

				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')

			);

			$result = $this->userModel->login($data);

			if ($result != FALSE) {

				foreach ($result as $key) {

						$session_data = array(

						'id' => $key->id,
						'email' => $key->email,
					);

				}


				$this->session->set_userdata('logged_in', $session_data);

				return redirect('usersController');

			} else {

					
				$this->session->set_flashdata('msg','Fail to sign in');

				return redirect('usersController/login');

			}

		}

	}

	public function logout() {

		$sess_array = array(
			'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		
		$this->load->view('usersView/signIn');
		
	}

}
