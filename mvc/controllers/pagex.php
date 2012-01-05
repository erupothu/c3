<?php

class Page extends INSIGHT_Controller {
	
	public function __construct() {
	
		parent::__construct();
		$this->load->model('page_model', 'page');
	}
	
	public function index() {
		
		/*
		$this->load->spark('example-spark/1.0.0');
		$this->example_spark->printHello();
		*/
		
		//https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/wiki/Home
		
		

		if(!$this->page->load($this->uri->uri_string())) {
			return $this->_404();
		}
		
		$this->load->view('page/templates/default.view.php', array(
			'page' 		=> $page
		));
	}
	
	public function _404() {
		
		$this->output->set_status_header('404');
		$this->load->view('common/errors/404.view.php', array(
			'request'	=> $this->uri->uri_string()
		));
	}
}