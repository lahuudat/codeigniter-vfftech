<?php 
/**
* 
*/
class userModel extends CI_Model
{
	
	public function getUser()
	{	
		
		$query = $this->db->get('user');

		if($query->num_rows()>0){

			return $query->result();

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

		}

	}

	public function doEditUser($data,$id)
	{
		
		return $this->db->where('id', $id)->update('user', $data);

	}

	public function deleteUser($id)
	{
		
		return $this->db->where('id', $id)->delete('user');

	}

	function search($keyword)
	{

		$this->db->like('email',$keyword);

		$query = $this->db->get('user');

		if($query->num_rows()>0){

			return $query->result();

		}

	}

	public function login($data) {

		$condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "'";

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