<?php 
/**
* 
*/
class productModel extends CI_Model
{
	
	public function getNewsProduct()
	{	
		
		$query = $this->db->query("SELECT product.name AS product_name, author.name AS author_name, product.*  FROM `product` INNER JOIN author ON product.id_author = author.id_author ORDER BY product.id_product DESC");

		if($query->num_rows()>0){

			return $query->result();

		}else{

			// $this->session->set_flashdata('msg','not found');

			// return redirect('usersController/alert');

			die("loi nhe");

		}

	}

	public function getCategory()
	{	
		
		$query = $this->db->query("SELECT product.id_category, category.name, COUNT(*) AS total FROM `product` INNER JOIN category ON product.id_category = category.id_category GROUP BY category.id_category");

		if($query->num_rows()>0){

			return $query->result();

		}else{

			// $this->session->set_flashdata('msg','not found');

			// return redirect('usersController/alert');

			die("loi nhe");

		}

	}

	public function showCategoryIndex($id)
	{	
		
		$query = $this->db->query("SELECT product.name AS product_name, author.name AS author_name, product.*  FROM `product` INNER JOIN author ON product.id_author = author.id_author WHERE product.id_category = $id ORDER BY product.id_product DESC");

		if($query->num_rows()>0){

			return $query->result();

		}else{

			// $this->session->set_flashdata('msg','not found');

			// return redirect('usersController/alert');

			die("loi nhe");

		}

	}

}

 ?>