<?php

class Product extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('product_model', 'product');
	}
	
	public function index() {
		
		$this->load->view('templates/category.template.view.php', array(
			'category' => $this->category->retrieve_by_slug('example-category', true)
		));
	}
	
	public function view($product_slug) {
		
		$product = $this->product->retrieve_by_slug($product_slug);
		$this->load->view('templates/product.template.view.php', array('product' => $product));
	}
}