<?php

class Page extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('page_model', 'page');
	}
	
	public function index() {
		
		// Static routes.
		//if(false !== ($method = $this->uri->segment(1)) && method_exists($this, $method)) {
		//	return call_user_func_array(array($this, $method), array_slice($this->uri->segment_array(), 1));
		//}
		
		// Does this page exist?
		if(!$page = $this->page->load($this->uri->uri_string())) {
			return $this->_404();
		}
		
		// Protected page?
		// @TODO
		
		// Dispatch page data to the required template.
		$this->output('home', array('page' => $page));
	}

	
	public function output($template, $data = array()) {
		$this->load->view('templates/' . $template . '.template.view.php', $data);
	}
	
	
	public function sitemap($format = null) {
		
		var_dump('Format:', $format);
		
		echo '<blockquote>
			- Static sitemap page is displayed, optional format for SEO.<br />
			- What about SEO module?  Can we hook this here?
		</blockquote>';
	}
	
	
	public function _404() {

		// Send out a 404 header.
		$this->output->set_status_header('404');

		// Load the 404 view.
		$this->load->view('common/errors/404.view.php', array(
			'request'	=> $this->uri->uri_string()
		));
	}
}