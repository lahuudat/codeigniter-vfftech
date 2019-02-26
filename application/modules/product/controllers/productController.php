<?php
defined('BASEPATH') OR exit('No direct script access allowed');




class productController extends MY_Controller {

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

		$this->load->helper('url');

		$this->load->model('product/productModel');

		$product = $this->productModel->getNewsProduct();

		$cate = $this->productModel->getCategory();

		$productsCat = $this->productModel->showCategoryIndex(1);

		$data = array_merge($this->data, ['products'=>$product]);

		$this->load->view('product/header');

		$this->load->view('product/sidebar',['cate'=>$cate]);

		$this->load->view('product/index',$data);

		$this->load->view('product/getCate',[ 'productCat'=>$productsCat]);

		$this->load->view('product/footer');

	}

	public function productDetails($id)
	{

		$this->load->model('product/productModel');

		$product = $this->productModel->productDetails($id);

		$cate = $this->productModel->getCategory();

		$this->load->view('product/header');

		$this->load->view('product/sidebar',['cate'=>$cate]);

		$this->load->view('product/showDetails',['products'=>$product]);

		$this->load->view('product/footer');

	}

	public function category($id)
	{

		$this->load->model('product/productModel');

		$product = $this->productModel->showCategoryIndex($id);

		$catName = $this->productModel->getCatName($id);

		$cate = $this->productModel->getCategory();

		$this->load->view('product/header');

		$this->load->view('product/sidebar',['cate'=>$cate]);

		$this->load->view('product/breadcrumb',['catName'=>$catName]);

		$this->load->view('product/showCategory',['products'=>$product]);

		$this->load->view('product/footer');

	}

	public function searchProduct()
	{

		$keyword = $this->input->post('keyword');

		

		$this->load->model('product/productModel');

        $products = $this->productModel->search($keyword);

        var_dump($products); exit();

        $data = array_merge($this->data, ['users'=>$users, 'keyword'=>$keyword]);
		
		$this->load->view('usersView/search',$data);

	}

}
