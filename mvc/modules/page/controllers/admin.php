<?php

class Admin extends INSIGHT_Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('page_model', 'page');
		$this->lang->load('module_validation');
	}
	
	
	public function index() {
		$this->load->view('admin/page/index.view.php', array());
	}
	
	
	public function retrieve($format = 'table-row', $args = array()) {
		
		// Load all pages into a Recurisve Iterator.
		$page_iterator = new RecursiveArrayIterator($this->page->retrieve_nested());
		
		// Load an empty chunk if there are 0 rows.
		if($page_iterator->count() === 0) {
			return $this->load->view('admin/page/chunks/' . $format . '.empty.chunk.php');
		}
		
		// Iterate over children.
		iterator_apply($page_iterator, array($this, '_render'), array($page_iterator, 0, $format, $args));
	}


	public function create() {
		
		if($this->form_validation->run('admin-page-form')) {
			$page_id = $this->page->create();
			return redirect('admin/page');
		}
		
		$this->load->view('admin/page/create.view.php', array());
	}

	
	public function update($page_id) {
		
		if($this->form_validation->run('admin-page-form')) {
			$this->page->update($page_id);
			return redirect('admin/page');
		}

		$this->load->view('admin/page/update.view.php', array(
			'page' 	=> $this->page->retrieve_by_id($page_id)	// , 'page_id', true
		));
	}
	
	
	public function delete($page_id) {
		
		if(!$this->page->delete($page_id))
			show_error('Could not delete page.');
			
		return redirect('admin/page');
	}
	
	
	public function settings() {
		echo 'settings for page';
	}
	

	private function _render($page_iterator, $limit = 0, $format = 'table-row', $args = array()) {
		
		while($page_iterator->valid()) {
			
			$page = $page_iterator->current();

			$this->load->view('admin/page/chunks/' . $format . '.chunk.php', array_merge(array('page' => $page), $args));
			
			if($page->hasChildren()) {
				$this->_render(new RecursiveArrayIterator($page->getChildren()), $limit, $format, $args);
			}
			
			$page_iterator->next();
		}
	}	
}