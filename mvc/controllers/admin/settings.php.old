<?php

class Settings extends INSIGHT_Admin_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('settings_model', 'settings');
	}
	
	public function index() {
		
		if($this->form_validation->run('admin-settings')) {
			$this->settings->save();
		}
		
		$this->load->view('admin/settings/index.view.php');
	}
}