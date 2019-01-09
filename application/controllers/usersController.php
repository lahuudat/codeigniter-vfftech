<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . "../storage/PHPMailer-master/src/PHPMailer.php";
include APPPATH . "../storage/PHPMailer-master/src/Exception.php";
include APPPATH . "../storage/PHPMailer-master/src/OAuth.php";
include APPPATH . "../storage/PHPMailer-master/src/POP3.php";
include APPPATH . "../storage/PHPMailer-master/src/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


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

		$this->load->model('userModel');

		if($this->userModel->editUser($id)!= null){

			$user = $this->userModel->editUser($id);

		}else{

			echo "error 404 not found "; exit();

		}

		$data = array_merge($this->data, ['user'=>$user]);

		$this->load->view('usersView/edit', $data);

	}

	public function doEdit($id)
	{

		$this->isLogin();

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
			
			$this->load->model('userModel');

			if($this->userModel->doEditUser($data,$id)){

				$this->session->set_flashdata('msg','Edit successfully');

			}else{

				$this->session->set_flashdata('msg','Fail to edit');

			}

			return redirect('usersController');

		}
		else if($this->form_validation->run() && $this->upload->do_upload($field_name)==false){
			
			$name = $this->input->post('name');

			$email = $this->input->post('email');

			$data = ([
				'name'=>$name,
				'email'=>$email

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

		$this->isLogin();

		$this->load->model('userModel');

		if($this->userModel->editUser($id)!= null){

			$user=$this->userModel->editUser($id);

		}else{

			echo "error 404 not found "; exit();

		}

		$data = array_merge($this->data, ['user'=>$user]);

		$this->load->view('usersView/editPass', $data);

	}

	public function doEditPass($id)
	{

		$this->isLogin();

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

	public function delete($id)
	{
		$this->isLogin();

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
		
		$this->isLogin();

		$keyword=$this->input->post('keyword');

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

	public function doForgotPass()
	{
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_credentials');

		$this->load->model('userModel');

		if($this->userModel->emailExists()){

			$temp_pass = md5(uniqid());

	        $mail = new PHPMailer(true);                              
	        try {
			    
			    $mail->SMTPDebug = 0;                                
			    $mail->isSMTP();

			    $mail->Host = 'smtp.gmail.com';  

			    $mail->SMTPAuth = true;                               
			    $mail->Username = 'huudat055@gmail.com';                 
			    $mail->Password = 'huudat994';                           
			    $mail->SMTPSecure = 'tls';                            
			   	$mail->Port = 587;                                

			   	$mail->setFrom('huudat055@gmail.com', 'Vfftech');

			    $mail->addAddress('ladat66@gmail.com');      

	    		$mail->isHTML(true);                                  
	    		$mail->Subject = 'Resset your password';

	    		$mail->Body    = "<p>This email has been sent as a request to reset our password</p><p><a href='".base_url()."index.php/usersController/resetPassword/$temp_pass'>Click here </a>if you want to reset your password,if not, then ignore</p>";

	    		if($mail->send()){

	    			 $this->load->model('userModel');

                	if($this->userModel->tempResetPassword($temp_pass)){

                    	echo "check your email for instructions, thank you";

                	}

	    		}else{

	    			echo "email was not sent, please contact your administrator";

	    		}

			} catch (Exception $e) {

				echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

			}

		}else{

			die("email is not exist");

		}

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

			echo "the key is not valid";    
		}

	}

	public function doResetPassword($passwordf)
	{

		if (isset($this->session->userdata['logged_in'])) {

			redirect(site_url("usersController"));

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

				return redirect('usersController/login');

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
