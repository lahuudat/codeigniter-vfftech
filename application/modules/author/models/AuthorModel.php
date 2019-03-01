<?php 
/**
* 
*/
class AuthorModel extends CI_Model
{
	
	public function getAuthor($id)
	{	
		
		$query = $this->db->query("SELECT author.name, author.information FROM author WHERE author.id_author = $id");

		if($query->num_rows()>0){

			return $query->result();

		}else{

			$this->session->set_flashdata('msg','not found');

			return redirect('product/productController');
			
		}

	}

	public function getProductAuthor($id)
	{		
		$query = $this->db->query("SELECT author.id_author, product.name AS product_name, author.name AS author_name, product.*  FROM `product` INNER JOIN author ON product.id_author = author.id_author WHERE author.id_author = $id ORDER BY product.id_product DESC");

		if($query->num_rows()>0){

			return $query->result();

		}else{

			$this->session->set_flashdata('msg','not found');

			return redirect('product/productController');
			
		}

	}

}

 ?>