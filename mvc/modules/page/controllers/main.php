<?php

class Main extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->load->model('page_model', 'page');
	}
	
	public function index() {
		
		// Does this page exist?
		if(!$page = $this->page->load($this->uri->uri_string())) {
			return $this->_404();
		}
		
		// Protected page?
		// @TODO
		
		// Dispatch page data to the required template.
		$this->load->view('templates/default.template.view.php', array(
			'page' 		=> $page
		));
	}
	
	private function _404() {
		
		// Send out a 404 header.
		$this->output->set_status_header('404');
		
		// Load the 404 view.
		$this->load->view('common/errors/404.view.php', array(
			'request'	=> $this->uri->uri_string()
		));
	}
}