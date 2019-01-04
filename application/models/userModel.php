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

}

 ?>