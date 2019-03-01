<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class AuthorController extends MY_Controller {

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
	public function index($id)
	{

		$this->load->helper('url');

		$this->load->model('author/AuthorModel');

		$this->load->model('product/productModel');

		$author = $this->AuthorModel->getAuthor($id);

		$cate = $this->productModel->getCategory();

		$authorProduct = $this->AuthorModel->getProductAuthor($id);

		// var_dump($authorProduct); exit();

		$this->load->view('product/header');

		$this->load->view('product/sidebar',['cate'=>$cate]);

		$this->load->view('author/authorDetails',['author'=>$author]);

		$this->load->view('author/authorProduct',['authorProduct'=>$authorProduct]);

		$this->load->view('product/footer');

	}

}
