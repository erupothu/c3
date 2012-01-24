<?php

class Product extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('product_model', 'product');
	}
	
	public function index() {
		
		// Dispatch page data to the required template.
		//$this->load->view('templates/' . $template . '.template.view.php', array(
		//	'page' 		=> $page
		//));
		
		$this->load->view('test.php');
	}
	
	private function _404() {
		
		// Send out a 404 header.
		//$this->output->set_status_header('404');
		
		// Load the 404 view.
		//$this->load->view('common/errors/404.view.php', array(
		//	'request'	=> $this->uri->uri_string()
		//));
	}
}