<?php

class Account extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		$this->load->library('form_validation');
		parent::__construct();
		
		$this->load->model('account_model', 'account');
	}
	
	public function index() {
		echo 'account::index';
	}

	public function register() {

		if($this->form_validation->run('account-form')) {
			var_dump($_POST);
			echo 'yes';
		}
		else {
			print_r($this->form_validation->all_values());
			echo 'no';
		}
		
		$this->load->view('register/form.view.php', array());
	}

	public function log_in() {
		echo 'account::log_in';
	}
	
	public function log_out() {
		echo 'account::log_out';
		
		redirect();
	}
}