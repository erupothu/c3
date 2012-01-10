<?php

class Admin extends INSIGHT_Admin_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('product_model', 'product');
	}
	
	public function index() {
		
		$this->load->view('admin/product/index.view.php', array(
			
		));
	}
}