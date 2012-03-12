<?php

class Product extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('product_model', 'product');
		$this->load->model('category_model', 'category');
	}
	
	public function index() {
		/*
		$cats = $this->category->retrieve_nested();
		echo '<pre>';
		print_r($cats);
		echo '</pre>';
		
		$this->load->view('templates/category.template.view.php', array(
			'category' => $this->category->retrieve_by_id(1, true)
		));
		* 
		* */
	}
	
	/* @TODO: do this properly... */
	public function route() {
		
		$category_slug = array_pop($this->uri->segment_array());
		if(!$category = $this->category->retrieve_by_slug($category_slug, true)) {
			return $this->output->set_output(Modules::run('page/_404'));
		}
		
		$this->load->view('templates/category.template.view.php', array(
			'category' => $category
		));
	}
	
	public function view($product_slug) {
		
		$product = $this->product->retrieve_by_slug($product_slug);
		$this->load->view('templates/product.template.view.php', array('product' => $product));
	}
}