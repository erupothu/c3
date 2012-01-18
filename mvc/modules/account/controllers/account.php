<?php

class Account extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('account_model', 'account');
	}
	
	public function index() {
		echo 'account::index';
	}

	public function register() {

		if($this->form_validation->run('account-form')) {
			$this->account->create();
			die('STOP');
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