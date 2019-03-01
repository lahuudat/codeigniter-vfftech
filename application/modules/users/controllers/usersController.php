<?php
defined('BASEPATH') OR exit('No direct script access allowed');




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

		$this->isLogin();

		$this->load->helper('url');

		$this->load->model('userModel');

		$users = $this->userModel->getUser();

		$data = array_merge($this->data, ['users'=>$users]);
		
		$this->load->view('usersView/index_view2',$data);

	}

	public function alert()
	{

		$this->load->view('usersView/alert');

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

		$this->isLogin();

		$this->isAdmin($id);

		$this->load->model('userModel');

		if($this->userModel->editUser($id)!= null){

			$user = $this->userModel->editUser($id);

		}else{

			$this->session->set_flashdata('msg','not found');

			return redirect('users/usersController/alert');

		}

		$data = array_merge($this->data, ['user'=>$user]);

		$this->load->view('users/usersView/edit', $data);

	}

	public function doEdit($id)
	{

		$this->isLogin();

		$this->isAdmin($id);

		$this->load->helper('URL');

		$this->load->library('upload');

		$config['upload_path'] = './images/';

		$config['allowed_types'] = 'gif|jpg|png';

		$this->upload->initialize($config);

		$field_name = "userImg";

		$this->form_validation->set_rules('name', 'Name', 'required');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() && $this->upload->do_upload($field_name))
		{

			$name = $this->input->post('name');

			$email = $this->input->post('email');

			$gambar = $this->upload->data();

			$data = ([
				'name'=>$name,
				'email'=>$email,
				'img'=>$gambar['file_name']

			]);
			
			$this->load->model('users/userModel');

			if($this->userModel->doEditUser($data,$id)){

				$this->session->set_flashdata('msg','Edit successfully');

			}else{

				$this->session->set_flashdata('msg','Fail to edit');

			}

			return redirect('users/usersController');

		}
		else if($this->form_validation->run() && $this->upload->do_upload($field_name)==false){
			
			$name = $this->input->post('name');

			$email = $this->input->post('email');

			$data = ([
				'name'=>$name,
				'email'=>$email

			]);

			$this->load->model('users/userModel');

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

	public function editNameAjax()
	{

		$name = $_POST['namea'];

		$email = $_POST['emaila'];

		$id = $_POST['ida'];

			$data = ([
				'name'=>$name,
				'email'=>$email
			]);
			
			$this->load->model('users/userModel');

			if($this->userModel->doEditUser($data,$id)){

				echo " Edit successfully";

			}else{

				echo " Edit fail";

			}

	}

	public function uploadImgAjax()
	{

		if (isset($_POST) && !empty($_FILES['file'])) {

			$idd = $_POST['id']; 

    		$duoi = explode('.', $_FILES['file']['name']); 

    		$duoi = $duoi[(count($duoi) - 1)]; 

    		if ($duoi === 'jpg' || $duoi === 'png' || $duoi === 'jpeg') {

    			$temp = explode(".", $_FILES["file"]["name"]);

				$newfilename = round(microtime(true)) . '.' . end($temp);
       
    			if (move_uploaded_file($_FILES['file']['tmp_name'], './images/' . $newfilename)) {
            
            		$data = ([
					'img'=>$newfilename
					]);

					$this->load->model('users/userModel');

					if($this->userModel->doEditUser($data,$idd)){

					
						echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close'data-dismiss='alert' aria-hidden='true'>×</button>Upload successfully...</div>";

					}else{

						echo "<div class='alert alert-warning alert-dismissable'><button type='button' class='close'data-dismiss='alert' aria-hidden='true'>×</button>Fail to upload</div>";
					}

        		} else { 

            		echo "<div class='alert alert-warning alert-dismissable'><button type='button' class='close'data-dismiss='alert' aria-hidden='true'>×</button>Fail to upload</div>";

        		}

    		} else { 

        		echo "<div class='alert alert-warning alert-dismissable'><button type='button' class='close'data-dismiss='alert' aria-hidden='true'>×</button>Fail to upload</div>";
    		}

		} else {

    		echo "<div class='alert alert-warning alert-dismissable'><button type='button' class='close'data-dismiss='alert' aria-hidden='true'>×</button>Fail to upload</div>";
		}
	}

	public function editPass($id){

		$this->isLogin();

		$this->isAdmin($id);

		$this->load->model('userModel');

		if($this->userModel->editUser($id)!= null){

			$user=$this->userModel->editUser($id);

		}else{

			$this->session->set_flashdata('msg','not found');

			return redirect('usersController/alert');

		}

		$data = array_merge($this->data, ['user'=>$user]);

		$this->load->view('usersView/editPass', $data);

	}

	public function doEditPass($id)
	{

		$this->isLogin();

		$this->isAdmin($id);

		$this->load->helper(array('form', 'url'));

		$this->form_validation->set_rules('oldPassword', 'Password', 'trim|required|min_length[5]|md5');

		$this->form_validation->set_rules('oldPasswordCf', 'Password', 'trim|required|matches[oldPassword]',
			array('matches' => 'Incorrect password ')
		);

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|md5');

		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]|md5');

		if ($this->form_validation->run())
		{

			$password = $this->input->post('password');

			$data = ([
				'password'=>$password
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

			$data = array_merge($this->data, ['user'=>$user]);

			$this->load->view('usersView/editPass', $data);

		}

	}

	public function changePassAjax()
	{

		$id = $_POST['id'];

		$po = $_POST['oldPassword'];

		$md5po = md5($po);

		$pn = $_POST['password'];

		$md5pn = md5($pn);

		$pc = $_POST['passconf'];

		$md5pc = md5($pc);

		$this->load->model('userModel');

		if($this->userModel->passRequired($id,$md5po)==false){

			echo "<div class='alert alert-warning alert-dismissable'><button type='button' class='close'data-dismiss='alert' aria-hidden='true'>×</button>Password is incorrect..</div>";

		}else{

			if($md5pn != $md5pc){

				echo "<div class='alert alert-warning alert-dismissable'><button type='button' class='close'data-dismiss='alert' aria-hidden='true'>×</button>Please check that you've entered and confirmed your password!</div>";

			}else{

				$data = ([
					'password'=>$md5pn
				]);

				if($this->userModel->doEditUser($data,$id)){

					
					echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close'data-dismiss='alert' aria-hidden='true'>×</button>Edit successfully...</div>";

				}else{

					echo "<div class='alert alert-warning alert-dismissable'><button type='button' class='close'data-dismiss='alert' aria-hidden='true'>×</button>Fail to edit</div>";
				}
			}
		}

	}

	public function delete($id)
	{
		$this->isLogin();

		$this->isAdmin($id);

		$this->load->model('userModel');

		if($this->userModel->deleteUser($id)){

			$this->session->set_flashdata('msg','Delete successfully');

		}else{

			$this->session->set_flashdata('msg','Fail to delete');

		}

		return redirect('users/usersController');

	}

	public function searchUser()
	{
		
		$this->isLogin();

		$keyword=$this->input->get('keyword');

		$this->load->model('userModel');

        $users = $this->userModel->search($keyword);

        $data = array_merge($this->data, ['users'=>$users, 'keyword'=>$keyword]);
		
		$this->load->view('usersView/search',$data);

	}

	public function login()
	{

	if (isset($this->session->userdata['logged_in'])) {

  		redirect(site_url("usersController"));

	} 

		$this->load->view('users/usersView/signIn');

	}

	public function doLogin()
	{

		$this->load->model('userModel');

		$this->form_validation->set_rules('email', 'Email', 'trim|required');

		$this->form_validation->set_rules('password', 'Password', 'trim|required|md5');

		if ($this->form_validation->run() == FALSE) {

			if(isset($this->session->userdata['logged_in'])){
				$this->load->view('users/usersView/index_view2');

			}else{

				$this->load->view('users/usersView/signIn');

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
						'role' => $key->role
					);

				}


				$this->session->set_userdata('logged_in', $session_data);

				return redirect('users/usersController');

			} else {

					
				$this->session->set_flashdata('msg','Fail to sign in');

				return redirect('users/usersController/login');

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

	public function listDeleteUsers()
	{
		
		$this->isLogin();

		$this->load->helper('url');

		$this->load->model('userModel');

		$users = $this->userModel->getUserDelete();

		$data = array_merge($this->data, ['users'=>$users]);
		
		$this->load->view('usersView/listDeleteUsers',$data);

	}

	public function forgotPass()
	{
		
		if (isset($this->session->userdata['logged_in'])) {

			redirect(site_url("usersController"));

		} 

		$this->load->view('usersView/forgotPass');

	}

	public function resetPassword($temp_pass){

		$data = array(

				'password' => $temp_pass

			);

		if (isset($this->session->userdata['logged_in'])) {

			redirect(site_url("usersController"));

		} 

		$this->load->model('userModel');

		if($this->userModel->isTempPassValid($temp_pass)){

			$this->load->view('usersView/resetPassword', $data);

		}else{

			$this->session->set_flashdata('msg','the key is not valid');

			return redirect('usersController/alert');    
		}

	}

	public function doResetPassword($passwordf)
	{

		if (isset($this->session->userdata['logged_in'])) {

			redirect(site_url("users/usersController"));

		} 
		
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|md5');

		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]|md5');

		if ($this->form_validation->run())
		{

			$password = $this->input->post('password');

			$data = ([
				'password'=>$password
			]);
			
			$this->load->model('userModel');

			$getId = $this->userModel->getId($passwordf);

			if($this->userModel->doEditUser($data,$getId->id)){

				$this->session->set_flashdata('msg','Change password successfully');

				return redirect('users/usersController/login');

			}else{

				$this->session->set_flashdata('msg','Fail to change');

			}

		}
		else
		{
			$data = array(

				'password' => $passwordf

			);

			$this->load->view('usersView/resetPassword', $data);

		}

	}

}
