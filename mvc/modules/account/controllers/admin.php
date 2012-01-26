<?php

class Admin extends INSIGHT_Admin_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		// Temp
		$this->load->view('admin/dashboard/index.view.php');
	}
}