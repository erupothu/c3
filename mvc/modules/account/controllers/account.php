<?php

class Account extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->load->library('form_validation');
		
		$this->load->library('account/user');
		
		$this->load->model('account_model', 'account');
		
		$this->load->config('countries');
		
	}
	
	public function index() {
		echo 'account::index';
	}

	public function register() {

		if($this->form_validation->run('account-register-form')) {
			$account_id = $this->account->create();
			redirect('account');
		}

		$this->load->view('register/form.view.php', array());
	}

	public function log_in() {
		
		if($this->form_validation->run('account-login-form')) {
			
			if(!$this->user->login($this->form_validation->value('account_email'), $this->form_validation->value('account_password'))) {
				echo 'NO';
			}
			
			var_dump($this->user);
			
			var_dump($this->form_validation->all_values());
			die();
		}
		
		$this->load->view('common/login.view.php');
	}
	
	public function log_out() {
		echo 'account::log_out';
		
		redirect();
	}
}