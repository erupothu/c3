<?php

class Admin extends INSIGHT_Admin_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('product_model', 'product');
	}
	
	public function index() {
		// temp
		$this->load->view('admin/dashboard/index.view.php');
	}
}