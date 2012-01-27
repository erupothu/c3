<?php

class Admin extends INSIGHT_Admin_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('product_model', 'product');
	}
	
	public function index() {

		$this->load->view('admin/product/index.view.php', array(
			'products'	=> $this->product->retrieve()
		));
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
		
		if($this->form_validation->run('admin-product-form')) {
			$product_id = $this->product->create();
			return redirect('admin/product');
		}
		
		$this->load->view('admin/product/create.view.php', array(
			'categories' => $this->category->retrieve()
		));
	}

	/*
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
	*/
}