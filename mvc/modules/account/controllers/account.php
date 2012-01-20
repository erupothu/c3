<?php

class Account extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('account_model', 'account');
		$this->load->config('countries');
	}
	
	public function index() {
		
		if(!$this->user->authenticated()) {
			return redirect('account/log-in');
		}
		
		$this->load->view('dashboard.view.php');
	}

	public function register() {

		if($this->form_validation->run('account-register-form')) {
			$account_id = $this->account->create();
			redirect('account');
		}

		$this->load->view('register/form.view.php', array());
	}

	public function recover() {
		$this->load->view('common/recover.view.php');
	}
	
	public function log_in() {

		if($this->form_validation->run('account-login-form')) {
			
			if(false !== User_Authenticated::login($this->form_validation->value('account_email'), $this->form_validation->value('account_password'))) {
				$this->session->set_flashdata('core/message', sprintf('Welcome back, %s!', $this->user->name()));
				return redirect('account');
			}
			
			$this->form_validation->add_error(null, 'account_email', true);
			$this->form_validation->add_error('Your login/password combination is incorrect. Please check your details and try again.', 'account_password');
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