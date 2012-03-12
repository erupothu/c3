<?php

class Page extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('page_model', 'page');
	}
	
	
	/**
	 * index
	 *
	 * @return void
	 */
	public function index() {
		
		// Check to see if this page exists.
		if(!$page = $this->page->load($this->uri->uri_string())) {
			return $this->_404();
		}
		
		// Protected page?
		// @TODO Permissions module?
		
		// Select template.
		// @TODO This needs to come from the metadata.
		$page_template = $page->slug() == '/' ? 'home' : 'inner';
		
		// Dispatch page data to the required template.
		$this->output($page_template, array('page' => $page));
	}


	/**
	 * output
	 *
	 * @param string $template 
	 * @param array $data 
	 * @return void
	 */
	public function output($template, $data = array()) {
		
		$output = $this->load->view('templates/' . $template . '.template.view.php', $data, true);
		if(strlen($output) === 0) {
			return;
		}
		
		libxml_use_internal_errors(true);
		$dom = new DOMDocument();
		$dom->loadHTML($output);
		$xpath = new DOMXPath($dom);
		$nodes = $xpath->query('//widget');
		foreach($nodes as $n => $node) {
			
			if(!$node->hasAttribute('module')) {
				continue;
			}
			
			$module_call = sprintf('%s/%s', $node->getAttribute('module'), $node->hasAttribute('method') ? $node->getAttribute('method') : 'index');
			if(is_null($module_data = Modules::run($module_call))) {
				
				// It is a short tag.  We will likely want to just remove it.
				$nodes->item($n)->parentNode->removeChild($nodes->item($n));
				continue;
			}
			
			$out_element = new DOMDocument;
			$out_element->loadHTML($module_data);
			
			// Splice the new elements into the DOM Document.
			$create_node = $dom->importNode($out_element->documentElement, true);
			$nodes->item($n)->parentNode->replaceChild($create_node, $nodes->item($n));
		}
		
		if($nodes->length > 0) {
			$output = $dom->saveHTML();
		}
		
		// Output.
		$this->output->set_output($output);
	}

	
	public function children($parent) {

		$page_id = $parent->parent() == 0 || $parent->hasChildren() ? $parent->id() : $parent->parent();
		
		$page = $this->page->retrieve_nested($page_id, 1);
		if(!$page->hasChildren()) {
			return;
		}
		
		$this->load->view('chunks/page/child-pages.chunk.php', array(
			'parent'	=> $page,
			'pages' 	=> $page->getChildren()
		));
	}
	
	
	public function breadcrumb($parent) {

		$this->load->view('chunks/page/breadcrumb.chunk.php', array(
			'breadcrumbs' => $this->page->path($parent->id())
		));
	}


	/**
	 * _404
	 *
	 * Method to run upon a route not matching any
	 * page within the system.
	 * 
	 * @access public
	 * @return void
	 */
	public function _404() {

		// Send out a 404 header.
		$this->output->set_status_header('404');

		// Load the 404 view.
		$this->load->view('common/errors/404.view.php', array(
			'request'	=> $this->uri->uri_string()
		));
	}
}