<?php 
	/**
	* 
	*/
	class userModel extends CI_Model
	{
		
		public function getUser()
		{	
			// mysql_set_charset('utf8', $con);
			$query = $this->db->get('user');

			if($query->num_rows()>0){

				return $query->result();

			}

		}

		public function doSignUp($data)
		{
			return $this->db->insert('user', $data);

		}
	}



 ?>