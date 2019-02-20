<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . "../storage/PHPMailer-master/src/PHPMailer.php";
include APPPATH . "../storage/PHPMailer-master/src/Exception.php";
include APPPATH . "../storage/PHPMailer-master/src/OAuth.php";
include APPPATH . "../storage/PHPMailer-master/src/POP3.php";
include APPPATH . "../storage/PHPMailer-master/src/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

	  		redirect(site_url("users/usersController/login"));

		} else {

			$id = ($this->session->userdata['logged_in']['id']);
			
			$email = ($this->session->userdata['logged_in']['email']);

			$role = ($this->session->userdata['logged_in']['role']);

			$this->data['user_id'] = $id;

			$this->data['email'] = $email;

			$this->data['role'] = $role;		

		}

	}

	public function isAdmin($ck)
	{

		$getUI = $this->data['user_id'];

		$getRole = $this->data['role'];

		if($getRole == 0 && $getUI != $ck ){

			$this->session->set_flashdata('msg','not found');

			return redirect('usersController');

		}

	}

	public function doForgotPass()
	{
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_credentials');

		$emailForgot = $this->input->post('email');

		$this->load->model('userModel');

		if($this->userModel->emailExists($emailForgot)){

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

			    $mail->addAddress($emailForgot);      

	    		$mail->isHTML(true);                                  
	    		$mail->Subject = 'Resset your password';

	    		$mail->Body    = "<p>This email has been sent as a request to reset our password</p><p><a href='".base_url()."index.php/usersController/resetPassword/$temp_pass'>Click here </a>if you want to reset your password,if not, then ignore</p>";

	    		if($mail->send()){

	    			 $this->load->model('userModel');

	    			 $data = array(
	    			 	'email' =>$this->input->post('email'),
	    			 	'key_pass'=>$temp_pass
	    			 );

                	if($this->userModel->tempResetPassword($data,$emailForgot)){

                    	$this->session->set_flashdata('msg2','check your email for instructions, thank you');

						return redirect('usersController/forgotPass');

                	}

	    		}else{

	    			$this->session->set_flashdata('msg','email was not sent, please contact your administrator');

					return redirect('usersController/forgotPass');

	    		}

			} catch (Exception $e) {

				echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

			}

		}else{

			$this->session->set_flashdata('msg','email is not exist');

			return redirect('usersController/forgotPass');

		}

	}

	




}
