<?php 
/**
* 
*/
class userModel extends CI_Model
{
	
	public function getUser()
	{	
		
		$query = $this->db->get_where('user','deleted_at IS NULL' );

		if($query->num_rows()>0){

			return $query->result();

		}else{

			echo "not found";exit();

		}

	}

	public function getUserDelete()
	{
		
		$query = $this->db->get_where('user','deleted_at IS NOT NULL' );

		if($query->num_rows()>0){

			return $query->result();

		}else{

			echo "not found";exit();

		}

	}

	public function getId($password)
	{
		$query = $this->db->query("SELECT `id` FROM user WHERE `password` = '$password'");

		if($query->num_rows()>0){

			return $query->row();

		}else{

			echo "not found";exit();

		}
	}

	public function doSignUp($data)
	{

		return $this->db->insert('user', $data);

	}

	public function editUser($id)
	{

		$query = $this->db->get_where('user', array('id' => $id));

		if($query->num_rows()>0){

			return $query->row();

		}else{

			echo "not found";exit();
			
		}

	}

	public function doEditUser($data,$id)
	{

		return $this->db->where('id', $id)->update('user', $data);

	}

	public function changePass($data)
	{
		return $this->db->where('password', $id)->update('user', $data);
	}

	public function deleteUser($id)
	{
		
		return $this->db->query("UPDATE `user` SET `deleted_at` = now() WHERE `id` = '$id'");

	}

	function search($keyword)
	{

		$result = array();

		$query = $this->db->query("SELECT * FROM user WHERE `email` LIKE '%$keyword%' ESCAPE '!' AND deleted_at IS NULL");

		if ($query->num_rows() > 0) {

			$result = $query->result();

		}else{

			echo "not found";exit();
			
		}

		return $result;

	}

	public function login($data) {

		$condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "' AND " . "deleted_at IS NULL";

		$this->db->select('*');

		$this->db->from('user');

		$this->db->where($condition);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;
			
		}

	}

	public function emailExists(){

		$email = $this->input->post('email');

		$query = $this->db->query("SELECT email, password FROM user WHERE email='$email'");  

		if($row = $query->row()){

			return TRUE;

		}else{

			return FALSE;

    	}

	}

	public function tempResetPassword($temp_pass){

		$data = array(
			'email' =>$this->input->post('email'),
			'password'=>$temp_pass);

		$email = $data['email'];

		if($data){

			$this->db->where('email', $email);

			$this->db->update('user', $data);

			return TRUE;

		}else{

			return FALSE;

		}

	}

	public function isTempPassValid($temp_pass){

		$this->db->where('password', $temp_pass);

		$query = $this->db->get('user');

		if($query->num_rows() == 1){

			return TRUE;

		}

		else return FALSE;

	}

}

 ?>