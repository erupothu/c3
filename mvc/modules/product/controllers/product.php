<?php

class Product extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('product_model', 'product');
	}
	
	public function index() {
		$this->load->view('product-list.view.php');
	}
	
	public function test() {
		$this->load->view('test.php');
	}
}