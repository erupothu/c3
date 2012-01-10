<?php

class Admin extends INSIGHT_Admin_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('page_model', 'page');
	}
	
	public function index() {
		
		$this->load->view('admin/page/index.view.php', array(
			'pages' => $this->page->retrieve()
		));
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
			'page' 	=> $this->page->load($page_id, 'page_id', true)
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
}