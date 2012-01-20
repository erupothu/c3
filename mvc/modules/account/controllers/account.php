<?php

class Account extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->load->library('form_validation');
		//$this->load->library('account/user_authenticated');
		$this->load->model('account_model', 'account');
		$this->load->config('countries');
		
	}
	
	public function index() {
		
		if(!$this->user->authenticated()) {
			return redirect('account/log-in');
		}
		
		var_dump($this->user);
		
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
		
		//var_dump($this->user->is_logged_in());
		
		if($this->form_validation->run('account-login-form')) {
			
			if(false !== User_Authenticated::login($this->form_validation->value('account_email'), $this->form_validation->value('account_password'))) {
				
				//die('l');
				return redirect('account');
			}
			
			$this->form_validation->add_error(null, 'account_email', true);
			$this->form_validation->add_error('Your login/password combination is incorrect. Please check your details and try again.', 'account_password');
			//var_dump($a);
			//var_dump($this->user);
			//$this->user->login($this->form_validation->value('account_email'), $this->form_validation->value('account_password'));
			//var_dump($this->user);
			//var_dump($this->session->get());
			
			//var_dump($this->user);
			
			var_dump($this->form_validation->all_values());
		}
		
		$this->load->view('common/login.view.php');
	}
	
	public function log_out() {
		
		if($this->user->authenticated()) {
			$this->user->logout();
		}
		
		redirect();
	}
}